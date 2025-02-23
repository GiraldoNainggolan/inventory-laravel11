<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function add_customer_post(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_address' => 'required'
        ]);

        DB::table('customer')->insert([
            'customer_name' => $request->customer_name,
            'customer_mobile' => $request->customer_mobile,
            'customer_address' => $request->customer_address,
            'customer_created_on' => Carbon::now(),
            'customer_updated_on' => Carbon::now(),
            'customer_status' => 1
        ]);

        return redirect(url('list_customer'))->with("success", "Customer Added successfully!");
    }

    public function list_customer()
    {
        $list_customer = DB::table('customer')->get();
        return view('list_customer', compact('list_customer'));
    }

    public function get_customer(Request $request)
    {
        $customer['customer'] = DB::table('customer')
            ->where("id", $request->id)
            ->get()
            ->first();
        $sale_list['sale'] = DB::table('sale')
            ->where("customer_id", $request->id)
            ->get();
        return response()->json(['customer' => $customer, 'sale_list' => $sale_list]);
    }

    public function edit_customer(Request $request)
    {
        $get_customer_ajax['customer'] = DB::table('customer')
            ->where("id", $request->id)
            ->get()
            ->first();
        return response()->json($get_customer_ajax);
    }

    public function edit_customer_post(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_mobile' => 'required',
            'customer_address' => 'required'
        ]);

        $edit = DB::table('customer')->where('id', $request->customer_id)
            ->update([
                'customer_name' => $request->customer_name,
                'customer_mobile' => $request->customer_mobile,
                'customer_address' => $request->customer_address,
                'customer_updated_on' => Carbon::now()
            ]);

        if (!$edit) {
            return redirect(url('list_customer'))->with("error", "Customer adding Failed,try again");
        }
        return redirect(url('list_customer'))->with("success", "Customer updated successfully");

    }
}
