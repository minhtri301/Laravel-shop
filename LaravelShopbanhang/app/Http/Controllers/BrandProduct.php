<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
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
      public function add_brand_product(){
        $this->AuthLogin();
    	return view('admin.add_brand_product');

    }
    public function all_brand_product(){
        $this->AuthLogin();
    	// $all_brand_product = DB::table('tbl_brand')->get(); :: la trong static huong doi tuong

        $all_brand_product = Brand::orderby('brand_id','desc')->get();
    	$manager_brand_product = view('admin.all_brand_product')->with('all_brand',$all_brand_product);
    	return view('admin_layout')->with('all',$manager_brand_product);
    }
    public function save_brand_product(Request $request){
         $this->AuthLogin();

         $data = $request->all();
         $brand = new Brand();
         $brand->brand_name = $data['brand_product_name'];
         $brand->meta_keywords_brand = $data['brand_product_keywords'];
         $brand->slug_brand_product = $data['slug_brand_product'];
         $brand->brand_desc = $data['brand_product_desc'];
         $brand->brand_status = $data['brand_product_status'];
         $brand->save();


    	// $data = array(); 
    	// $data['brand_name'] = $request->brand_product_name;
    	// $data['brand_desc'] = $request->brand_product_desc;
     //      $data['slug_brand_product'] = $request->slug_brand_product;
     //    $data['meta_keywords_brand'] = $request->brand_product_keywords;
    	// $data['brand_status'] = $request->brand_product_status;
    	// DB::table('tbl_brand')->insert($data);

    	Session::put('message','Thêm thương hiệu sản phẩm thành công');
    	return Redirect::to('add-brand-product');
    	

    }
    public function unactive_brand_product($brand_product_id){
         $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function active_brand_product($brand_product_id){
         $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
         $this->AuthLogin();
        // cach 1 $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get(); //first();
          //cach 2 $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
         // dùng find() ko cần dùng foreach nhưng chỉ in ra 1 kết quả thoi

         $edit_brand_product = Brand::find($brand_product_id); 
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('edit',$manager_brand_product);

    }
    public function update_brand_product(Request $request,$brand_product_id){
         $this->AuthLogin();

               $data = $request->all();
               $brand = Brand::find($brand_product_id);
         $brand->brand_name = $data['brand_product_name'];
         $brand->meta_keywords_brand = $data['brand_product_keywords'];
         $brand->slug_brand_product = $data['slug_brand_product'];
         $brand->brand_desc = $data['brand_product_desc'];
        
         $brand->save();



       // $data = array();
       //  $data['slug_brand_product'] = $request->slug_brand_product;
       //  $data['meta_keywords_brand'] = $request->brand_product_keywords;
       // $data['brand_name'] = $request->brand_product_name;
       //  $data['brand_desc'] = $request->brand_product_desc;
       //  DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);

        Session::put('message','Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');

    }
    public function delete_brand_product($brand_product_id){
         $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu sản phẩm thành công');
         return Redirect::to('all-brand-product');

    }

    //end function Admin fage 

    
       public function show_brand_home(Request $request ,$slug_brand_product){
          $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $brand_name = DB::table('tbl_brand')->where('slug_brand_product',$slug_brand_product)->limit(1)->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_brand.slug_brand_product',$slug_brand_product)->get();

         foreach($brand_by_id as $key => $val){

                $meta_desc = $val->brand_desc;
                $meta_keywords = $val->meta_keywords_brand; 
                $meta_title = $val->brand_desc; 
                $url_canonical = $request->url();

        }

        return view('pages.brand.show_brand')->with('category',$cate_product)->with('brand',$brand_product)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical); 

    }
}
