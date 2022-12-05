<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Mail;
use App\Customer;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
  
 
    public function send_mail(){
        $to_name = "Huy Minh";
        $to_email = "mhuy81352@gmail.com"; //send to this email

        $data = array("name" => "Mail từ tài khoản khách hàng","body" => "Mail gửi về vấn đề hàng hóa" );

        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

          $message->to($to_email)->subject('Test thử gửi mail gg');
          $message->from($to_email,$to_name);

        });

         return Redirect('/')->with('message','');
    }


    public function index(Request $request){

        $meta_desc = "Hơn 15.000 đồng hồ hàng hiệu đẹp tại cửa hàng Đồng Hồ Hải Triều gần đây. Shop đồng hồ Hải Triều cam kết 100% chính hãng, BH 5 năm, góp 0%,...";
        $meta_keywords = "15.000+ Đồng hồ nam, đồng hồ nữ chính hãng"; 
        $meta_title = "15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ MT"; 
        $url_canonical = $request->url();

    	  $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
      
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(12)->get();

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
        //cach 2 return view('pages.home')->with(compact('cate_product','brand_product','all_product'));
    }
    public function layout(){
    	return view('layout2');
    }
    public function search(Request $request){
          $meta_desc = "Hơn 15.000 đồng hồ hàng hiệu đẹp tại cửa hàng Đồng Hồ Hải Triều gần đây. Shop đồng hồ Hải Triều cam kết 100% chính hãng, BH 5 năm, góp 0%,...";
        $meta_keywords = "15.000+ Đồng hồ nam, đồng hồ nữ chính hãng"; 
        $meta_title = "15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ MT"; 
        $url_canonical = $request->url();

    	$keywords = $request->keyword_submit;

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('search_name',$keywords);

    }
}
