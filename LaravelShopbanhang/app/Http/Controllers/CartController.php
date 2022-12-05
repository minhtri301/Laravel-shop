<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Coupon;
session_start();

class CartController extends Controller
{
   public function check_coupon(Request $request){
   $data = $request->all(); 
   $coupon = Coupon::where('coupon_code',$data['coupon'])->first(); 
   if($coupon==true){
    
       $cou[] = array(
            'coupon_code' => $coupon->coupon_code,
            'coupon_condition' => $coupon->coupon_condition,
            'coupon_number' => $coupon->coupon_number,
        );
        Session::put('coupon',$cou);
        Session::save();
         return Redirect()->back()->with('message','them ma thanh cong');

      // $coupon_session = Session::get('coupon'); 
      // if($coupon_session==true){
      //   $cou[] = array(
      //       'coupon_code' => $coupon->coupon_code,
      //       'coupon_condition' => $coupon->coupon_condition,
      //       'coupon_number' => $coupon->coupon_number,
      //   );
      //   Session::put('coupon',$cou);

      //   }else{
      //         $cou[] = array(
      //       'coupon_code' => $coupon->coupon_code,
      //       'coupon_condition' => $coupon->coupon_condition,
      //       'coupon_number' => $coupon->coupon_number,
      //   );
      //   Session::put('coupon',$cou);
      //   };
      //   Session::save();
      //    return Redirect()->back()->with('message','them ma thanh cong');
        
      }else{
      return Redirect()->back()->with('message','them ma ko thanh cong');
   

   }
}

    public function gio_hang(Request $request){
         $meta_desc = "đồng hồ xịn";
        $meta_keywords = "đồng hồ xịn"; 
        $meta_title = "Giỏ hàng - Đồng Hồ MT"; 
        $url_canonical = $request->url();

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
         return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart'); 
        if($cart==true){
            $is_avaiable = 0;   
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                  $cart[$key]['product_qty']+=1;
                    
                     
                    //   $cart[] = array(
                    // 'session_id' => $val['session_id'],
                    // 'product_name' => $val['product_name'],
                    // 'product_id' => $val['product_id'],
                    // 'product_image' => $val['product_image'],
                    // 'product_qty' => $val['product_qty']+$data['cart_product_qty'],
                    // 'product_price' => $val['product_price']
                    //     );
                    //    Session::put('cart',[]);
                    $is_avaiable++;
                }

            }Session::put('cart',$cart);
           
         
            if($is_avaiable == 0){
                $cart[] = array(
                    
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'] ,
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
             Session::put('cart',$cart);
        }
       
        Session::save();

    }
    public function del_product($session_id){

        $cart = Session::get('cart');
        if($cart==true){
            foreach ($cart as $key => $val) {
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return Redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
             return Redirect()->back()->with('error','Xóa sản phẩm that bai');
        }
    }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach ($cart as $session => $val) {
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty']=$qty;

                    }
                }
            }
            Session::put('cart',$cart); 
            return Redirect()->back()->with('message','Cap nhat phẩm thành công');
        }else{
             return Redirect()->back()->with('error','cap nhat phẩm that bai');

    }
}
    public function del_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            Session::forget('cart'); 
            Session::forget('coupon');
            return Redirect()->back()->with('message','Xoa thành công');
        }
    }



    public function save_cart(Request $request){  	
    	$data = $request->all();
         $cart = Session::get('cart');
          $session_id = substr(md5(microtime()),rand(0,26),5);
        if($cart==true){
          $is_avaiable2 = 0;
            
                foreach ($cart as $session => $val) {
                    if($val['product_id']==$data['cart_product_id']){
                        $cart[$session]['product_qty']+=$data['cart_qty'];
                        $is_avaiable2++;
                        Session::put('cart',$cart); 

                    }
                   
                     
                }
            
            if($is_avaiable2==0){
               $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_qty'],
                    'product_price' => $data['cart_product_price'],
                                   );
                    Session::put('cart',$cart); 
            }
            
           
        }else{
          $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_qty'],
                    'product_price' => $data['cart_product_price'],
                                   );
                    Session::put('cart',$cart); 
    }

    return Redirect::to('/gio-hang');
    	// $quantity = $request->qty;
    	// $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();

    	// Cart::add('293ad', 'Product 1', 1, 9.99, 550);

    	// Cart::destroy();
    	// $data['id'] = $product_info->product_id; 
    	// $data['qty'] = $quantity; 
    	// $data['name'] = $product_info->product_name; 
    	// $data['price'] = $product_info->product_price; 
    	// $data['weight'] = $product_info->product_price; 
    	// $data['options']['image'] = $product_info->product_image; 
    	// Cart::add($data); 
    	// Cart::setGlobalTax(10);


    	
     
    	
    }
    public function show_cart(Request $request){
                  $meta_desc = "đồng hồ xịn";
        $meta_keywords = "đồng hồ xịn"; 
        $meta_title = "Giỏ hàng - Đồng Hồ MT"; 
        $url_canonical = $request->url();



    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
    	 return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function delete_to_cart($rowId){
    	Cart::update($rowId,0);

    	return Redirect::to('/show-cart');

    }
    public function update_cart_quantity(Request $request){
    	$rowId = $request->rowId_cart;
    	$qty = $request->cart_quantity;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show-cart');
    }
}
