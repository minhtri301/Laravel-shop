<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests;
use Session;
use App\Customer;
use Illuminate\Support\Facades\Redirect;
session_start();


class CustomerController extends Controller
{
     public function AuthLogin(){
        if(Session::get('login_normal')){
            
        $admin_id = Session::get('admin_id'); 
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
             return Redirect::to('admin')->send();

        }

    }
}

    public function all_customer(){
        $this->AuthLogin();
    	// $all_brand_product = DB::table('tbl_brand')->get(); :: la trong static huong doi tuong

        $all_customer = Customer::get();
    	$manager_customer = view('admin.all_customer')->with('all_customer',$all_customer);
    	return view('admin_layout')->with('all',$manager_customer);
    }

    public function delete_csutomer($customer_id){
    
         $this->AuthLogin();
        Customer::where('customer_id',$customer_id)->delete();
        Session::put('message','Xóa tài khoản thành công');
         return Redirect::to('all-customer');

}
    
}
