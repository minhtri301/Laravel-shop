@extends('layout')
@section('content')
<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title" style="margin-top: 100px;">	
						<h3><span class="orange-text">Kết quả</span> tìm kiếm: {{$search_name}}</h3>
						<p>Hơn 15.000 đồng hồ hàng hiệu đẹp tại cửa hàng Đồng Hồ Hải Triều gần đây. Shop đồng hồ Hải Triều cam kết 100% chính hãng, BH 5 năm, góp 0%,....</p>
					</div>
				</div>
			</div>

			<div class="row">
				     @foreach($search_product as $key => $product)
				<div class="col-lg-3 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug_product)}}"><img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt=""></a>
						</div>
						<div style="height: 60px"><h3>{{$product->product_name}}</h3></div>
						<p class="product-price"><span><img src="{{('public/frontend/images/img/star-active.jpg')}}">
						<img src="{{('public/frontend/images/img/star-active.jpg')}}">
					<img src="{{('public/frontend/images/img/star-active.jpg')}}">
				<img src="{{('public/frontend/images/img/star-active.jpg')}}">
			<img src="{{('public/frontend/images/img/star-active.jpg')}}"></span>{{number_format($product->product_price,'0',',','.').' '.'VND'}}</p>
						
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


@endsection