<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use App\Models\Log;

class SaleController extends Controller
{
    public function add_sale()
    {

        $user_type = Session::get('session_user_type');
        if ($user_type == 'admin') {
            $customer = DB::table('customer')->get();
            $item = DB::table('item')->where('item_status', 1)->where('item_stock', '>', 0)->get();
            // Fetch the last sale bill number
            $lastSale = DB::table('sale')->orderBy('sale_bill', 'desc')->first();
            $nextBillNumber = $this->generateNextBillNumber($lastSale ? $lastSale->sale_bill : null);
            return view('add_sale', compact('customer', 'item', 'nextBillNumber'));
        } else {
            return redirect(url('index'))->with("fail", "Only Admin's can do Sales");
        }
    }
    private function generateNextBillNumber($lastBillNumber)
    {
        // Define your prefix and suffix
        $prefix = 'SALE/24-25/';

        if ($lastBillNumber) {
            // Extract the numeric part
            $lastNumber = (int) substr($lastBillNumber, strlen($prefix));
            // Increment the number
            $nextNumber = $lastNumber + 1;
        } else {
            // Start with 1 if no previous bill number
            $nextNumber = 1;
        }

        // Format the number with leading zeros if needed
        $nextBillNumber = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $nextBillNumber;
    }

    public function add_sale_post(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'sale_bill' => 'required',
            'sale_date' => 'required|date',
            'item_id' => 'required|array',
            'item_name' => 'required|array',
            'item_hsn' => 'required|array',
            'item_mrp' => 'required|array',
            'item_qty' => 'required|array',
            'item_sale' => 'required|array',
            'item_amount' => 'required|array',
            'item_totalAmount' => 'required|numeric',
        ]);
        try {
            $user_type = Session::get('session_name');

            $sale = DB::table('sale')->insert([
                'customer_id' => $request->customer_id,
                'customer_name' => $request->customer_name,
                'user_name' => $user_type,
                'customer_mobile' => $request->customer_mobile,
                'sale_bill' => $request->sale_bill,
                'sale_date' => $request->sale_date,
                'total_amount' => $request->item_totalAmount,
                'sale_created_at' => Carbon::now(),
                'sale_updated_at' => Carbon::now()
            ]);

            $saleID = DB::table('sale')
                ->where('sale_bill', $request->sale_bill)
                ->get('id')
                ->first();

            foreach ($request->item_id as $index => $itemId) {
                DB::table('sale_item')->insert([
                    'sale_id' => $saleID->id,
                    'sale_bill' => $request->sale_bill,
                    'sale_date' => $request->sale_date,
                    'customer_name' => $request->customer_name,
                    'item_id' => $itemId,
                    'item_hsn' => $request->item_hsn[$index],
                    'item_name' => $request->item_name[$index],
                    'item_mrp' => $request->item_mrp[$index],
                    'item_qty' => $request->item_qty[$index],
                    'item_sale_price' => $request->item_sale[$index],
                    'item_amount' => $request->item_amount[$index],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                Log::create([
                    'level' => 'info',
                    'message' => 'Sale added to inventory',
                    'context' => [
                        'item_name' => $request->sale_bill,
                        'user_type' => Session::get('session_user_type'),
                        'user_name' => Session::get('session_name'),
                    ],
                ]);

                $getstock = DB::table('item')
                    ->where('id', $itemId)
                    ->get('item_stock')
                    ->first();

                if (!$getstock->item_stock) {
                    return redirect(url('add_sale'))->with("error", "Out Of Stock");
                } else {
                    $updatedstock = $getstock->item_stock - $request->item_qty[$index];
                    DB::table('item')->where('id', $itemId)
                        ->update([
                            'item_stock' => $updatedstock,
                            'item_updated_at' => Carbon::now()
                        ]);
                }
            }
            return redirect(url('add_sale'))->with("success", "Sale added successfully");

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

            return redirect(url('add_item'))->with("fail", "Sale adding Failed, try again");
        }

    }

    public function fetch_customer_details(Request $request)
    {
        $get_vendor_ajax['customer'] = DB::table('customer')
            ->where("id", $request->id)
            ->get()
            ->first();
        return response()->json($get_vendor_ajax);
    }

    public function list_sale()
    {
        $list_sale = DB::table('sale')->get();
        return view('list_sale', compact('list_sale'));
    }
}
