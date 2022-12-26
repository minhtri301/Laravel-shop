<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class LienheController extends Controller
{
	 
    public function view_lienhe_baohanh(Request $request){
    	      $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->orderby('product_id','desc')->paginate(8);

        

                $meta_desc = '15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ Hải Triều';
                $meta_keywords = 'Hơn 15.000 đồng hồ hàng hiệu đẹp tại cửa hàng Đồng Hồ Hải Triều gần đây. Shop đồng hồ Hải Triều cam kết 100% chính hãng, BH 5 năm, góp 0%,...'; 
                $meta_title = '15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ Hải Triều'; 
                $url_canonical = $request->url();

    	
    	$baohanh = DB::table('tbl_lienhe')->first();
    	return view('pages.lienhe.baohanh')->with('data',$baohanh)->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('all_product',$all_product);
    }
       public function view_lienhe_content(Request $request){
              $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->orderby('product_id','desc')->paginate(8);

        

                $meta_desc = '15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ Hải Triều';
                $meta_keywords = 'Hơn 15.000 đồng hồ hàng hiệu đẹp tại cửa hàng Đồng Hồ Hải Triều gần đây. Shop đồng hồ Hải Triều cam kết 100% chính hãng, BH 5 năm, góp 0%,...'; 
                $meta_title = '15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ Hải Triều'; 
                $url_canonical = $request->url();

      
        $baohanh = DB::table('tbl_lienhe')->first();
        return view('pages.lienhe.lienhe')->with('data',$baohanh)->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('all_product',$all_product);
    }

        public function lienhe_baohanh(){
       
        	$data = DB::table('tbl_lienhe')->first();
        	return view('admin.add_baohanh')->with('data',$data);
        }
        //  public function lienhe_content(){
        //  	$this->AuthLogin();
        //     $data = DB::table('tbl_lienhe')->first();
        // 	return view('admin.add_lienhe')->with('data',$data);
        // }


    
    public function save_lienhe_baohanh(Request $request){
       
          	$data = array(); 
        // $kiemtra = DB::table('tbl_lienhe')->get();
    	// foreach ($kiemtra as $key => $va) {
     //      if(($va->lienhe_baohanh==$request->lienhe_baohanh)||($va->lienhe_content==$request->lienhe_content){
     //        $data['lienhe_baohanh'] = $request->lienhe_baohanh;
     //        $data['lienhe_content'] = $request->lienhe_content;
     //        DB::table('tbl_lienhe')->where('lienhe_baohanh',$data)->update($data);
     //         DB::table('tbl_lienhe')->where('lienhe_content',$data)->update($data);
     //      }
     //    }
    	$data['lienhe_baohanh'] = $request->lienhe_baohanh;
        $data['lienhe_content'] = $request->lienhe_content;
   

    	DB::table('tbl_lienhe')->insert($data);
    	Session::put('message','Thêm thông tin bảo hành thành công');
    	return Redirect::to('lienhe-baohanh');
    }
    public function save_lienhe_content(Request $request){
      
            $data = array(); 
        
        $data['lienhe_content'] = $request->lienhe_content;
   

        DB::table('tbl_lienhe')->insert($data);
        Session::put('message','Thêm thông tin liên hệ');
        return Redirect::to('lienhe-content');
    }
}
