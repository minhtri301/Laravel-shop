<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use App\Customer;
session_start();
use Illuminate\Support\Facades\Redirect;

class Checklogin extends Controller
{
	public function login(){
		return view('pages.checkout.login');
	}
     public function login_layout(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result= Customer::where('customer_email',$email)->where('customer_password',$password)->first();
        
        if($result){
        	$customer_name = $result->customer_name;
            Session::put('customer_id',$result->customer_id);
            Session::put('customer_name',$customer_name);
            return Redirect::to('/trang-chu')  ;
        }else{
        	Session::put('message','tài khoản hoặc mật khẩu sai');
           return Redirect()->back();
        }
     
    }

    public function login_dangky(Request $request){
    		$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
    	$customer_email = Customer::where('customer_email',$request->customer_email)->first(); 
    	$customer_phone = Customer::where('customer_phone',$request->customer_phone)->first();
    	if($customer_email||$customer_phone){
    	     Session::put('message','Email hoặc phone đã tồn tại');
           return Redirect()->back();
        }else{
        	$customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);

    	return Redirect::to('/trang-chu');
        }
    }


}
