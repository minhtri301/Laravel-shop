@extends('layout')
@section('content')
@foreach($product_details as $key => $value )
<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row" style="margin-top: 150px !important;">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}"  id="hinhchu">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3>{{$value->product_name}}</h3>
						<p class="single-product-pricing"><span>Mã id: {{$value->product_id}}</span>{{number_format($value->product_price,'0',',','.').' '.'đ'}}</p>

						<p></p>
						<div class="single-product-form">
							<form action="{{URL::to('/save-cart')}}" method="POST">
								@csrf
								<!-- <input type="number" min="1" name="qty" value="1"> -->

								   <input type="hidden" name="cart_product_id" value="{{$value->product_id}}">
						   <input type="hidden" name="cart_product_name"  value="{{$value->product_name}}">
							<input type="hidden" name="cart_product_image"   value="{{$value->product_image}}">
							<input type="hidden" name="cart_product_price"   value="{{$value->product_price}}">
						
								    <input type="number" min="1" name="cart_qty"  value="1">
		
								<input type="hidden" name="productid_hidden" value="{{$value->product_id}}">
								<?php if($value->product_quantity>0){ ?>
								<a href="" class="cart-btn"><i class="fas fa-shopping-cart"></i><input type="submit" value="Thêm giỏ hàng" style="    color: #ffffff;
    font-weight: 500;"  ></a> <?php } ?>
								
							</form>
							
							<p><strong>Tình trạng: </strong><?php if($value->product_quantity>0){ ?>
							Còn hàng
						     <?php }else{ ?>
						    Hết hàng <?php } ?></p>
							<p><strong>Điều kiện: </strong>Mới 100%</p>
							<p><strong>Thương hiệu: </strong>{{$value->brand_name}}</p>
							<p><strong>Danh mục: </strong>{{$value->category_name}}</p>
						</div>
						<h4>Share:</h4>
						<ul class="product-share">
							<div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row" >
				<div class="col-md-5 chitiet3">

					<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" onclick="changeImage('one')" id="one"/>
					<img src="{{URL::to('/public/uploads/product/5_C4591-148.webp')}}" onclick="changeImage('two')" id="two"/>
					<img src="{{URL::to('/public/uploads/product/69_RE-AV0001S00B-699x69975.webp')}}" onclick="changeImage('three')" id="three"/>
				</div>
				<div class="col-md-7"></div>
			</div>
		</div>
	</div>


	
		<div class="container">
			<div class="row" style="display: flex;
    flex-direction: column;">
				
				
		
					<!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Chi tiết sản phẩm</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Mô tả</a></li>
						
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_content!!}</p>		
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->product_desc!!}</p>
								
							</div>
							
							
							<div class="tab-pane fade " id="reviews" >
								<div class="col-sm-12">
									<!-- <ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form> -->
									<div class="fb-comments" data-href="{{$url_canonical}}" data-width="" data-numposts="20"></div>

								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
@endforeach
					
						<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
							@foreach($related as $key => $lienquan)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											 <div class="single-products">
		                                        <div class="productinfo text-center">
		                                            <a href="{{URL::to('/chi-tiet-san-pham/'.$lienquan->slug_product)}}">
		                                            	<img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt=""  style="    width: 44%;" />
		                                            </a>
		                                            <h2 style="font-size: 20px;">{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
		                                            <p style="font-size: 12px;">{{$lienquan->product_name}}</p>
		                                            <a href="#" class="btn btn-default add-to-cart" style="font-size: 13px;"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
		                                        </div>
		                                      
                                			</div>
										</div>
									</div>
							@endforeach		

								
								</div>
									
							</div>
									
						</div>
					</div><!--/recommended_items-->
					

			</div>
		</div>

	
	
		</div>
		</div>
	</div>




@endsection
