<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class VendorController extends Controller
{
    public function add_vendor_post(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required',
            'vendor_gstin' => 'required',
            'vendor_mobile' => 'required',
            'vendor_email' => 'required',
            'vendor_address' => 'required'
        ]);

        DB::table('vendor')->insert([
            'vendor_name' => $request->vendor_name,
            'vendor_gstin' => $request->vendor_gstin,
            'vendor_mobile' => $request->vendor_mobile,
            'vendor_email' => $request->vendor_email,
            'vendor_address' => $request->vendor_address,
            'vendor_created_on' => Carbon::now(),
            'vendor_updated_on' => Carbon::now(),
            'vendor_status' => 1
        ]);

        return redirect(url('list_vendor'))->with("success", "Vendor Added successfully!");
    }

    public function list_vendor()
    {
        $list_vendor = DB::table('vendor')->get();
        return view('list_vendor', compact('list_vendor'));
    }

    public function get_vendor(Request $request)
    {

        $vendor['vendor'] = DB::table('vendor')
            ->where("id", $request->id)
            ->get()
            ->first();
        $purchase_list['purchase'] = DB::table('purchase')
            ->where("vendor_id", $request->id)
            ->get();
        return response()->json(['vendor' => $vendor, 'purchase_list' => $purchase_list]);

    }

    public function edit_vendor(Request $request)
    {
        $get_vendor_ajax['vendor'] = DB::table('vendor')
            ->where("id", $request->id)
            ->get()
            ->first();
        return response()->json($get_vendor_ajax);
    }


    public function edit_vendor_post(Request $request)
    {
        $request->validate([
            'vendor_name' => 'required',
            'vendor_gstin' => 'required',
            'vendor_mobile' => 'required',
            'vendor_email' => 'required',
            'vendor_address' => 'required'
        ]);

        $edit = DB::table('vendor')->where('id', $request->vendor_id)
            ->update([
                'vendor_name' => $request->vendor_name,
                'vendor_gstin' => $request->vendor_gstin,
                'vendor_mobile' => $request->vendor_mobile,
                'vendor_email' => $request->vendor_email,
                'vendor_address' => $request->vendor_address,
                'vendor_updated_on' => Carbon::now()
            ]);

        if (!$edit) {
            return redirect(url('list_vendor'))->with("error", "Vendor adding Failed,try again");
        }
        return redirect(url('list_vendor'))->with("success", "Vendor updated successfully");
    }
}
