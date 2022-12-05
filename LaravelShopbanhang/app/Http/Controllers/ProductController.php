<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Product;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
        public function AuthLogin(){
        $admin_id = Session::get('admin_id'); 
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
             return Redirect::to('admin')->send();

        }

    }
    public function danh_muc_san_pham(Request $request){
           $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $all_product = DB::table('tbl_product')->get();

        

                $meta_desc = '15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ Hải Triều';
                $meta_keywords = 'Hơn 15.000 đồng hồ hàng hiệu đẹp tại cửa hàng Đồng Hồ Hải Triều gần đây. Shop đồng hồ Hải Triều cam kết 100% chính hãng, BH 5 năm, góp 0%,...'; 
                $meta_title = '15.000+ Đồng hồ nam, đồng hồ nữ chính hãng | Đồng hồ Hải Triều'; 
                $url_canonical = $request->url();

       

        return view('pages.sanpham.show_product')->with('category',$cate_product)->with('brand',$brand_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('all_product',$all_product);

    }
    

      public function add_product(){
         $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
   

    }
    public function all_product(){
         $this->AuthLogin();
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
    	$manager_product = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('all',$manager_product);
    }
    public function save_product(Request $request){
         $this->AuthLogin();
    	$data = array(); 
    	//ten cột                  //tên name lấy ra
    	$data['product_name'] = $request->product_name;
    	$data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_desc'] = $request->product_desc;
        $data['slug_product'] = $request->slug_product;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('add-product');

        } 
        $data['product_image'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('add-product');
    	

    }
    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
         $this->AuthLogin();
          $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
       
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get(); //first();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brand_product',$brand_product);
        return view('admin_layout')->with('edit',$manager_product); 
    }
    public function update_product(Request $request,$product_id){
         $this->AuthLogin();
       $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_desc'] = $request->product_desc;
        $data['slug_product'] = $request->slug_product;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if($get_image){
             $this->AuthLogin();
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');

        } 
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
         return Redirect::to('all-product');

    }

    //end function Admin fage 

    public function details_product(Request $request ,$slug_product){
          $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();

        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_product.slug_product',$slug_product)->get();

        foreach($details_product as $key => $val){
                $product_id = $val->product_id;
                $category_id = $val->category_id;
                $brand_id = $val->brand_id;
                $meta_desc = $val->product_desc;
                $meta_keywords = $val->product_name; 
                $meta_title = $val->product_desc; 
                $url_canonical = $request->url();

        }

        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.slug_product',[$slug_product])->limit(3)->get();
        if(Session::get('cart')==true){
        foreach(Session::get('cart') as $key => $ca){
               if($ca['product_id'] == $product_id ){
                $aa = $ca['session_id'];
               }else{
                $aa = 0;
               };
        }
        }else{
            $aa = 0;
        }
        



        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('related',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('aa',$aa);
    }
}
