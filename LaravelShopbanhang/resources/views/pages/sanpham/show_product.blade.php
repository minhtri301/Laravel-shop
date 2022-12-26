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
                                     <h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate2->slug_category_product)}}">{{$cate2->category_name}}</a></h4>
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
                                     <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand2->slug_brand_product)}}"> <span class="pull-right"></span>{{$brand2->brand_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div><!--/brands_products-->

                         <div class="brands_products"><!--yeeu thich-->
                            <h2>Sản phẩm yêu thích</h2>
                            <div class="brands-name">
                              <div id="row_wishlist" class="row"></div>
                            </div>
                        </div><!--/yeu thich-->
                        
                     
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
 
<!-- batdat -->

                 <div class="product-section mt-150 mb-150">
		<div class="container ctai2">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Sản phẩm</span> Hiện có</h3>
						<p>{{$meta_keywords}}</p>
						
					</div>
				</div>
			</div>

			<div class="row">
			@foreach($all_product as $key => $product)
			<div class="col-lg-3 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug_product)}}"><img  id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt=""></a>
						</div>
						<div style="height: 60px"><h3>{{$product->product_name}}</h3></div>
						<p class="product-price"><span><img src="{{('./public/frontend/images/img/star-active.jpg')}}">
						<img src="{{('./public/frontend/images/img/star-active.jpg')}}">
					<img src="{{('./public/frontend/images/img/star-active.jpg')}}">
				<img src="{{('./public/frontend/images/img/star-active.jpg')}}">
			<img src="{{('./public/frontend/images/img/star-active.jpg')}}"></span>{{number_format($product->product_price,'0',',','.').' '.'VND'}}</p>
						
						<form  class="fas fa-shopping-cart">
							@csrf
					       <input type="hidden" class="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}">
						   <input type="hidden" id="wishlist_productname{{$product->product_id}}" class="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}">
							<input type="hidden"  class="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}">
							<input type="hidden" id="wishlist_productprice{{$product->product_id}}" class="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}">
							<input type="hidden" class="cart_product_qty_{{$product->product_id}}" value="1">
              <a id="wishlist_producturl{{$product->product_id}}"  href="{{URL::to('/san-pham/')}}">
               
              </a>
							
								<button type="button" class="add-to-cart" data-id_product="{{$product->product_id}}" >Thêm giỏ hàng</button>
                  {{-- <button class="button_wishlist" id="{{$product->product_id}}" onclick="add_wistlist(this.id);"><span>Yêu thích</span></button>			 --}}			

								</form>
					</div>
				</div>
             @endforeach
               
               

			</div>
			 <footer class="panel-footer" style="background: white;">
    <div class="row">
      <div class="col-sm-5 text-center"></div>
      <div class="col-sm-7 text-right text-center-xs" >
        <ul class="pagination pagination-sm-m-t-none-m-b-none">
          {!!$all_product->links()!!}
        </ul>
      </div>
    </div>
  </footer>
		</div>

	</div>

                    <!-- ketthuc -->
                </div>
            </div>
        </div>
    </section>



@endsection