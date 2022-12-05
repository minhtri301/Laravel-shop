<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
        public function AuthLogin(){
        $admin_id = Session::get('admin_id'); 
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
             return Redirect::to('admin')->send();

        }

    }
    public function add_category_product(){
         $this->AuthLogin();
    	return view('admin.add_category_product');

    }
    public function all_category_product(){
         $this->AuthLogin();
    	$all_category_product = DB::table('tbl_category_product')->get();
    	$manager_category_product = view('admin.all_category_product')->with('all_category',$all_category_product);
    	return view('admin_layout')->with('all',$manager_category_product);
    }
    public function save_category_product(Request $request){
         $this->AuthLogin();
    	$data = array(); 
    	//ten cột                  //tên name lấy ra
    	$data['category_name'] = $request->category_product_name;
    	$data['category_desc'] = $request->category_product_desc;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['meta_keywords'] = $request->category_product_keywords;
    	$data['category_status'] = $request->category_product_status;

    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category-product');
    	

    }
    public function unactive_category_product($category_product_id){
         $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
         $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
         $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get(); //first();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category',$edit_category_product);
        return view('admin_layout')->with('edit',$manager_category_product);

    }
    public function update_category_product(Request $request,$category_product_id){
         $this->AuthLogin();
       $data = array();
           $data['slug_category_product'] = $request->slug_category_product;
        $data['meta_keywords'] = $request->category_product_keywords;
       $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function delete_category_product($category_product_id){
         $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
         return Redirect::to('all-category-product');

    }


    //end function Admin fage 

    public function show_category_home(Request $request ,$slug_category_product){
          

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

         $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->get();

        foreach($category_by_id as $key => $val){

                $meta_desc = $val->category_desc;
                $meta_keywords = $val->meta_keywords; 
                $meta_title = $val->category_desc; 
                $url_canonical = $request->url();

        }

        $category_name = DB::table('tbl_category_product')->where('slug_category_product',$slug_category_product)->limit(1)->get();
        
        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);

    }
  
} 
