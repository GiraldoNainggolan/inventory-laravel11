<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use App\Models\Log;
class PurchaseController extends Controller
{
    public function add_purchase()
    {

        $user_type = Session::get('session_user_type');
        if ($user_type == 'admin') {
            $vendor = DB::table('vendor')->get();
            $item = DB::table('item')->get();
            return view('add_purchase', compact('vendor', 'item'));
        } else {
            return redirect(url('index'))->with("fail", "Only Admin's can do Purchase Order");
        }
    }

    public function add_purchase_post(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required',
            'vendor_name' => 'required',
            'vendor_mobile' => 'required',
            'vendor_gstin' => 'required',
            'purchase_bill' => 'required',
            'purchase_date' => 'required|date',
            'item_id' => 'required|array',
            'item_name' => 'required|array',
            'item_hsn' => 'required|array',
            'item_mrp' => 'required|array',
            'item_qty' => 'required|array',
            'item_purchase' => 'required|array',
            'item_amount' => 'required|array',
            'item_totalAmount' => 'required|numeric',
        ]);
        try {
            $user_type = Session::get('session_name');

            $purchase = DB::table('purchase')->insert([
                'vendor_id' => $request->vendor_id,
                'vendor_name' => $request->vendor_name,
                'user_name' => $user_type,
                'vendor_mobile' => $request->vendor_mobile,
                'vendor_gstin' => $request->vendor_gstin,
                'purchase_bill' => $request->purchase_bill,
                'purchase_date' => $request->purchase_date,
                'total_amount' => $request->item_totalAmount,
                'purchase_created_at' => Carbon::now(),
                'purchase_updated_at' => Carbon::now()
            ]);

            $purchaseID = DB::table('purchase')
                ->where('purchase_bill', $request->purchase_bill)
                ->get('id')
                ->first();

            foreach ($request->item_id as $index => $itemId) {
                DB::table('purchase_item')->insert([
                    'purchase_id' => $purchaseID->id,
                    'vendor_name' => $request->vendor_name,
                    'purchase_bill' => $request->purchase_bill,
                    'purchase_date' => $request->purchase_date,
                    'item_id' => $itemId,
                    'item_hsn' => $request->item_hsn[$index],
                    'item_name' => $request->item_name[$index],
                    'item_mrp' => $request->item_mrp[$index],
                    'item_qty' => $request->item_qty[$index],
                    'item_purchase_price' => $request->item_purchase[$index],
                    'item_amount' => $request->item_amount[$index],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                Log::create([
                    'level' => 'info',
                    'message' => 'Purchase added to inventory',
                    'context' => [
                        'item_name' => $request->purchase_bill,
                        'user_type' => Session::get('session_user_type'),
                        'user_name' => Session::get('session_name'),
                    ],
                ]);

                $getstock = DB::table('item')
                    ->where('id', $itemId)
                    ->get('item_stock')
                    ->first();

                if (!$getstock->item_stock) {
                    DB::table('item')->where('id', $itemId)
                        ->update([
                            'item_stock' => $request->item_qty[$index],
                            'item_updated_at' => Carbon::now()
                        ]);
                } else {
                    $updatedstock = $getstock->item_stock + $request->item_qty[$index];
                    DB::table('item')->where('id', $itemId)
                        ->update([
                            'item_stock' => $updatedstock,
                            'item_updated_at' => Carbon::now()
                        ]);
                }
            }
            return redirect(url('add_purchase'))->with("success", "Purchase added successfully");

        } catch (\Exception $e) {
            // Log the failure
            Log::create([
                'level' => 'error',
                'message' => 'Failed to add item to inventory',
                'context' => [
                    'error_message' => $e->getMessage(),
                    'user_type' => Session::get('session_user_type'),
                    'user_name' => Session::get('session_name'),
                ],
            ]);

            return redirect(url('add_item'))->with("fail", "Purchase adding Failed, try again");
        }

    }

    public function fetch_vendor_details(Request $request)
    {
        $get_vendor_ajax['vendor'] = DB::table('vendor')
            ->where("id", $request->id)
            ->get()
            ->first();
        return response()->json($get_vendor_ajax);
    }

    public function fetch_item_details(Request $request)
    {

        $get_vendor_ajax['item'] = DB::table('item')
            ->where("id", $request->id)
            ->get()
            ->first();
        return response()->json($get_vendor_ajax);
    }

    public function list_purchase()
    {
        $list_purchase = DB::table('purchase')->get();
        return view('list_purchase', compact('list_purchase'));
    }
}
