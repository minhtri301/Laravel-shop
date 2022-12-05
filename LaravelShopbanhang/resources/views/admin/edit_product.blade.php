@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật sản phẩm
            </header>
               <?php 
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }

                ?>
            <div class="panel-body">
             
                <div class="position-center">
                    @foreach($edit_product as $key => $edit_product)
                    <form role="form" action="{{URL::to('/update-product/'.$edit_product->product_id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="product_name" value="{{$edit_product->product_name}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input type="text" name="product_price" value="{{$edit_product->product_price}}" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input type="text" data-validation="number" data-validation-error-msg="lam ơn điền số lượng" name="product_quantity" class="form-control" id="exampleInputEmail1" value="{{$edit_product->product_quantity}}" >
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                            
                           <input type="file" name="product_image"  class="form-control" id="exampleInputEmail1" >
                           <img src="{{URL::to('public/uploads/product/'.$edit_product->product_image)}}" height="100" width="100">
                       </input>
    
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">slug</label>
                            <input type="text" value="{{$edit_product->slug_product}}" name="slug_product" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none"  rows="8" class="form-control" name="product_desc" placeholder="Mô tả sản phẩm">{{$edit_product->product_desc}}</textarea>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="ckeditor3" placeholder="Nội dung sản phẩm">{{$edit_product->product_content}}</textarea>
                        </div>
            
                          <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach($cate_product as $key => $cate)
                                @if($cate->category_id==$edit_product->category_id)
                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endif
                 
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                  @foreach($brand_product as $key => $brand)
                                  @if($brand->brand_id==$edit_product->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                @endif
                 
                                @endforeach

                            </select>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>

                            </select>
                        </div>


                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    @endforeach

                </div>

            </div>
        </section>

    </div>
    @endsection