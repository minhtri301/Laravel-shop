@extends('layout')
@section('content')
@if(Session::get('cart')==true)
<div class="cart-section mt-150 mb-150">
	<div class="container"  style=" margin-top: 100px !important;
    margin-bottom: 400px !important;" >
		<div class="row" >
			<div class="col-lg-8 col-md-12" >
				<?php if(Session()->has('message')){ ?>
					<div class="alert alert-success">
						{{ Session()->get('message')}}
					</div>
				<?php }if(Session()->has('error')){ ?>	
					<div class="alert alert-success">
						{{ Session()->get('erro')}}
					</div>
				<?php } ?>
				<div class="cart-table-wrap" >
					<form action="{{URL::to('/update-cart')}}" method="post">
						@csrf
						<table class="cart-table">

							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-remove"></th>
									<th class="product-image">Hình ảnh</th>
									<th class="product-name">Tên sản phẩm</th>
									<th class="product-price">Giá sản phẩm</th>
									<th class="product-quantity">Sô lượng</th>
									<th class="product-total">Thành tiền</th>
									<th class="product-remove"></th>
								</tr>
							</thead>
							<tbody>

								<?php $total = 0;  ?>
								@foreach(Session::get('cart') as $key => $cart)
								<?php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total += $subtotal;

								?>
								<tr>
									<td></td>
									<td><img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" style="width: 70px"></td>
									<td>{{$cart['product_name']}}</td>

									<td>{{$cart['product_price']}}.VND</td>
									<td class="cart_quantity">
										<div style="display: flex; justify-content:space-evenly ;align-items: center !important;">



											<div class="cart_quantity_button">

												<!-- <a class="cart_quantity_up" href=""> + </a> -->
												<input class="cart_quantity_" type="number" min="1"  name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}" > 
												<!-- <a class="cart_quantity_down" href=""> - </a> -->
												<input type="hidden"  name="rowId_cart" value="" > 


											</div>	



									<!-- <input type="submit" style="height: 44px;
										font-size: 11px;" value="xóa"></input> -->


									</div>
								</td>
								<td> {{number_format($subtotal,0,',','.')}}</td>
								<td><a class="cart_quantity_delete" href="{{url::to('/del-product/'.$cart['session_id'])}}">
									<i class="fa fa-times"></i>
								</a></td>


							</tr>
							@endforeach
							<str>
								<td colspan="7"><input type="submit" style=" font-size: 11px;color: #ffffff;padding: 10px 15px;" value="Cập nhật giỏ hàng" name="update_qty"  ></td>
								<td></td> 
							</str>


						</tbody>
					</form>
				</table>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="total-section">
				<table class="total-table">
					<thead class="total-table-head">
						<tr class="table-total-row">
							<th>Total</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<tr class="total-data">
							<td><strong>Tổng: </strong></td>
							<td>{{number_format($total,0,',','.')}}</td>
						</tr>
					<!-- 	@if(Session::get('coupon'))
								@foreach(Session::get('coupon') as $key => $cou)
						<tr class="total-data">
							<td><strong>Mã coupon: {{$cou['coupon_code']}} </strong></td>
							<td>
								@if($cou['coupon_condition']==2)
								 Giảm: {{number_format($cou['coupon_number'])}}vnd

								 @else
								 Giảm: {{number_format($cou['coupon_number'])}}%
								 @endif
								

							</td>
						</tr>
						<tr class="total-data">
							<td><strong>Thành tiền: </strong></td>
							<td>@if($cou['coupon_condition']==2)
								 {{number_format($total-$cou['coupon_number'])}}vnd
								 @else
								 {{number_format($total-($total*$cou['coupon_number']/100))}}vnd
								 @endif</td>
						</tr>
						@endforeach
						@endif -->

						
						<!-- <tr class="total-data">
							<td><strong>Phí vận chuyển: </strong></td>
							<td>Free</td>
						</tr> -->

					</tbody>
				</table>
				<div class="cart-buttons">
			<!-- <a href="cart.html" class="boxed-btn">
				<form action="cart.php">
					<input type="hidden" name="action" value="update">
					<input type="hidden" name="ProductId" value="">
					<input type="hidden" name="quantity" value=""> 
					<button type="submit">Cập nhật</button>
				</form>
			</a> -->

			<?php
			$customer_id = Session('customer_id');
			if($customer_id!=null){ ?>
				<a href="{{URL::to('/checkout')}}" class="boxed-btn black">Thanh toán</a>
			<?php }else{ ?> 
			<a href="{{URL::to('/login-checkout')}}" class="boxed-btn black">Thanh toán</a>
			<?php } ?>
			<a href="{{URL::to('/del-all-product')}}" class="boxed-btn black">Xóa tất cả</a>
	


			
		</div>
	</div>

<!-- 	<div class="coupon-section">
		<h3>Apply Coupon</h3>
		<div class="coupon-form-wrap">
			<form action="{{url('/check-coupon')}}" method="post">
				@csrf
				<p><input type="text" name="coupon" placeholder="Coupon"></p>
				<p><input type="submit" value="Apply"></p>
				@if(Session::get('coupon')==true)
				<a href="{{URL::to('/unset-coupon')}}" class="boxed-btn black">Xóa coupon</a>
				@endif
			</form>

		</div>
	</div> -->
</div>
</div>
</div>
</div>

@else
<div class="cart-section mt-150 mb-150">
	<div class="container" style=" margin-top: 100px !important;
    margin-bottom: 400px !important;">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				
				<div class="cart-table-wrap">						
					<table class="cart-table">
						
						<thead class="cart-table-head">
							<tr class="table-head-row">
								<th class="product-remove"></th>
								<th class="product-image">Hình ảnh</th>
								<th class="product-name">Tên sản phẩm</th>
								<th class="product-price">Giá sản phẩm</th>
								<th class="product-quantity">Sô lượng</th>
								<th class="product-total">Thành tiền</th>
								<th class="product-remove"></th>
							</tr>
						</thead>
						<tbody>

							
							<str>
								<td colspan="7">
									@php
									echo 'Làm ơn thêm sản phẩm vào giỏ hàng'

									@endphp

								</td>
							</str>


						</tbody>
					</form>
				</table>
			</div>
		</div>
			</div>
		</div>
		@endif
		@endsection