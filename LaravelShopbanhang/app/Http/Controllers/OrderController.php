<?php

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\City;
use App\Wards;
use App\Province;
use App\FeeShip;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use App\Product;
use PDF;

session_start();
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function delete_order($order_code){
		 
         $order = DB::table('tbl_order')->join('tbl_shipping','tbl_shipping.shipping_id','=','tbl_order.shipping_id')->where('order_code',$order_code)->get();
         foreach ($order as $key => $order) {
         	$shipping_id = $order->shipping_id; 
         }
         DB::table('tbl_order_details')->where('order_code',$order_code)->delete(); 
         DB::table('tbl_shipping')->where('shipping_id',$shipping_id)->delete();
         DB::table('tbl_order')->where('order_code',$order_code)->delete();

         return Redirect()->back();
	}

	public function update_detail_order(Request $request){
		$data = $request->all(); 
		$quanty = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first(); 
		$quanty->product_sales_quantity = $data['order_qty']; 
		$quanty->save();
	}

	public function update_order_qty(Request $request){
		//update status order
		$data = $request->all(); 
		$order = Order::find($data['order_id']); 
		$order->order_status = $data['order_status'];
		$order->save();  
		//update quantity,sold product
		if($order->order_status==2){
           foreach($data['order_product_id'] as $key => $product_id) {
           	$product = Product::find($product_id);
           	$quanty = $product->product_quantity ;
            $sold = $product->product_sold ;
           	   foreach ($data['quantity'] as $key2 => $qty) {
           	   	  if($key==$key2){
           	   	  	$pro_remain = $quanty - $qty;
           	   	  	$product->product_quantity = $pro_remain; 
           	   	  	$product->product_sold = $sold + $qty; 
           	   	  	$product->save();
           	   	  }
           	   }
           }
		}elseif($order->order_status!=2 && $order->order_status!=3){
			 foreach($data['order_product_id'] as $key => $product_id) {
           	$product = Product::find($product_id);
           	$quanty = $product->product_quantity ;
            $sold = $product->product_sold ;
           	   foreach ($data['quantity'] as $key2 => $qty) {
           	   	  if($key==$key2){
           	   	  	$pro_remain = $quanty + $qty;
           	   	  	$product->product_quantity = $pro_remain; 
           	   	  	$product->product_sold = $sold - $qty; 
           	   	  	$product->save();
           	   	  }
           	   }
           }
		}
	}


	public function print_order($checkout_code){
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach ($order as $key => $ord) {
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first(); 

		$order_details_product = OrderDetails::with('product')->where('order_code',$checkout_code)->get();

		$output = '';

		
	}


	public function view_order($order_code){
		// $order_details = OrderDetails::where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach ($order as $key => $ord) {
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$order_status = $ord->order_status;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first(); 
        //cach 2 ko dung roreach
		// $order = Order::where('order_code',$order_code)->first();
		// $customer = Customer::where('customer_id',$order->customer_id)->first();
		// $shipping = Shipping::where('shipping_id',$order->shipping_id)->first(); 


		$order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();
        
        foreach($order_details_product as $key => $orderr){
        	$order_coupon = $orderr->product_coupon;
        }

        if($order_coupon!='no'){
		$coupon = Coupon::where('coupon_code',$order_coupon)->first();
		$coupon_number = $coupon->coupon_number;
		$coupon_condition = $coupon->coupon_condition;
	    }else{
        $coupon_number = '0';
		$coupon_condition = '2';
		}


		return view('admin.view_order')->with(compact('customer','shipping','order_details_product','coupon_number','coupon_condition','order','order_status'));
	}
    public function manage_order(){
    	$order = Order::orderby('created_at',"desc")->get(); 
    	return view('admin.manage_order')->with(compact('order'));

    }
}
