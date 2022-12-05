@extends('layout')
@section('content')
    <section style="    margin-top: 150px;
    margin-left: -70px;">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục sản phẩm</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                          @foreach($category as $key2 => $cate2)
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                     <h4 class="panel-title"><a href="{{URL::to('/danh-muc/'.$cate2->slug_category_product)}}">{{$cate2->category_name}}</a></h4>
                                </div>
                            </div>
                        @endforeach
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu sản phẩm</h2>
                            <div class="brands-name">
                            	<ul class="nav nav-pills nav-stacked" style="display: flex;
                            	flex-direction: column;">
                                    @foreach($brand as $key3 => $brand2)
                                     <li><a href=""> <span class="pull-right"></span>{{$brand2->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                     
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
 
<!-- batdat -->

                 <div class="product-section mt-150 mb-150">
		<div class="container ctai2">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	@foreach($brand_name as $key => $brand_name)
						<h3><span class="orange-text">Thương hiệu</span> {{$brand_name->brand_name}}</h3>
						<p>{{$brand_name->meta_keywords_brand}}</p>
						 @endforeach
					</div>
				</div>
			</div>

			<div class="row">
			@foreach($brand_by_id as $key => $product)
			<div class="col-lg-3 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug_product)}}"><img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt=""></a>
						</div>
						<div style="height: 60px"><h3>{{$product->product_name}}</h3></div>
						<p class="product-price"><span><img src="{{('../public/frontend/images/img/star-active.jpg')}}">
						<img src="{{('../public/frontend/images/img/star-active.jpg')}}">
					<img src="{{('../public/frontend/images/img/star-active.jpg')}}">
				<img src="{{('../public/frontend/images/img/star-active.jpg')}}">
			<img src="{{('../public/frontend/images/img/star-active.jpg')}}"></span>{{number_format($product->product_price,'0',',','.').' '.'VND'}}</p>
						
						<form  class="fas fa-shopping-cart">
							@csrf
					       <input type="hidden" class="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}">
						   <input type="hidden" class="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}">
							<input type="hidden" class="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}">
							<input type="hidden" class="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}">
							<input type="hidden" class="cart_product_qty_{{$product->product_id}}" value="1">
							
									 <?php if($product->product_quantity>0){ ?>
     <button type="button" class="add-to-cart" data-id_product="{{$product->product_id}}" >Thêm giỏ hàng</button>
   <?php }else{ ?> 
    <button type="button" style="color: #696763;
    font-family: 'Roboto', sans-serif;
    font-size: 15px;
    border: none;">Hết hàng</button>
  <?php }   ?>

								</form>
					</div>
				</div>
             @endforeach
               
               

			</div>
		</div>
	</div>
                    <!-- ketthuc -->
                </div>
            </div>
        </div>
    </section>



@endsection