<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;
use Session;
use Illuminate\Support\Arr;


class UserController extends Controller
{
    public function index()
    {
        if (Session::has('session_id')) {
            $sum_qty = DB::table('sale_item')
                ->selectRaw('SUM(CAST("item_qty" AS numeric)) as total_qty')
                ->value('total_qty');
            $customer = DB::table('customer')
                ->count();
            $total_amount = DB::table('sale_item')
                ->selectRaw('SUM(CAST("item_amount" AS numeric)) as total_amount')
                ->value('total_amount');
            $logs = DB::table('logs')->get();
            $items = DB::table('item')->where('item_stock', '<', 10)->orderBy('item_stock', 'asc')->get();
            return view('index', compact('sum_qty', 'total_amount', 'customer', 'logs', 'items'));
        } else {
            return view('login');
        }
    }
    public function login()
    {
        $data = DB::table('user_details')->select('*')->get();
        if (count($data) > 0) {
            return view('login');
        } else {
            return view('registration');
        }
    }
    function logout()
    {
        if (Session::has('session_id')) {
            Session::pull('session_id');
            Session::flush();
            return redirect('login');
        }
        return redirect('login');
    }


    public function login_post(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'pwd' => 'required'
        ]);

        $user = DB::table('user_details')->where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->pwd, $user->pwd)) {
                $sess_array = [
                    'session_id' => $user->id,
                    'session_name' => $user->fname,
                    'session_email' => $user->email,
                    'session_user_type' => $user->type,
                    'loggedin' => 'UserLoggedIn'
                ];
                $request->session()->put($sess_array);
                return redirect('index');
            } else {
                return back()->with('fail', 'Password not match!');
            }
        } else {
            return back()->with('fail', 'This email is not register.');
        }
    }
    public function registration()
    {
        return view('registration');
    }
    public function emp_registration()
    {

        $user_type = Session::get('session_user_type');
        if ($user_type == 'suadmin') {
            return view('emp_registration');
        } else {
            return redirect(url('index'))->with("fail", "Only SuAdmin can do Employee Registration.");
        }
    }
    public function emp_list()
    {
        $user_type = Session::get('session_user_type');
        if ($user_type == 'suadmin') {
            $emp_list = DB::table('user_details')->where('type', 'admin')->get();
            return view('emp_list', compact('emp_list'));//
        } else {
            return redirect(url('index'))->with("fail", "Only SuAdmin can view Employee Details.");
        }
    }
    public function registration_post(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'pwd' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required'
        ]);

        $user = DB::table('user_details')->insert([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'email' => $request->email,
            'pwd' => Hash::make($request->pwd),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 1
        ]);

        if (!$user) {
            return redirect(url('registration'))->with("error", "Registration Failed,try again");
        }
        return redirect(url('login'))->with("success", "Registration success, Login to access the app");

    }
    public function emp_registration_post(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'mobile' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'pwd' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'type' => 'required',
        ]);

        $user = DB::table('user_details')->insert([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'dob' => $request->dob,
            'email' => $request->email,
            'pwd' => Hash::make($request->pwd),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 1
        ]);

        if (!$user) {
            return redirect(url('emp_registration'))->with("error", "Registration Failed,try again");
        }
        return redirect(url('emp_registration'))->with("success", "Registration success, Login to access the app");

    }
}