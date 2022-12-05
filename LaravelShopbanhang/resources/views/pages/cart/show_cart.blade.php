@extends('layout')
@section('content')

<div class="cart-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-12">
				<div class="cart-table-wrap">
					<?php 
					$content = Cart::content();

					 ?>
					<table class="cart-table">
						<thead class="cart-table-head">
							<tr class="table-head-row">
								<th class="product-remove"></th>
								<th class="product-image">Product Image</th>
								<th class="product-name">Name</th>
								<th class="product-price">Price</th>
								<th class="product-quantity">Quantity</th>
								<th class="product-total">Total</th>
								<th class="product-remove"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($content as $v_content)
							<tr>
								<td></td>
								<td><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" style="width: 70px"></td>
								<td>{{$v_content->name}}</td>

								<td>{{number_format($v_content->price).' '.'vnđ'}}</td>
								<td class="cart_quantity">
									<div style="display: flex; justify-content:space-evenly ;align-items: center !important;">

									

									<div class="cart_quantity_button">
										<form action="{{URL::to('/update-cart-quantity')}}" method="post">
											{{ csrf_field() }}
									<!-- <a class="cart_quantity_up" href=""> + </a> -->
									<input class="cart_quantity_input" type="number" min="1"  name="cart_quantity" value="{{$v_content->qty}}" > 
									<!-- <a class="cart_quantity_down" href=""> - </a> -->
									<input type="hidden"  name="rowId_cart" value="{{$v_content->rowId}}" > 
									
									
									</div>	
									<input type="submit" style="height: 44px; font-size: 11px;" value="Cập nhật" name="update_qty"  >
									</form>
									
									<!-- <input type="submit" style="height: 44px;
									font-size: 11px;" value="xóa"></input> -->
									
						
							         </div>
						        </td>
						<td><?php $subtotal = $v_content->price * $v_content->qty;
						echo number_format($subtotal).' '.'vnđ';

						 ?></td>
						 <td><a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}">
										<i class="fa fa-times"></i>
									</a></td>
						

					</tr>
					@endforeach
			</tbody>
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
					<td>{{Cart::priceTotal(0,',','.').' '.'vnđ'}}</td>
				</tr>
				<tr class="total-data">
					<td><strong>Thuế: </strong></td>
					<td>{{Cart::tax(0,',','.').' '.'vnđ'}}</td>
				</tr>
				<tr class="total-data">
					<td><strong>Phí vận chuyển: </strong></td>
					<td>Free</td>
				</tr>
				<tr class="total-data">
					<td><strong>Thành tiền: </strong></td>
					<td>{{Cart::total(0,',','.').' '.'vnđ'}}</td>
				</tr>
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
			
		</div>
	</div>

	<div class="coupon-section">
		<h3>Apply Coupon</h3>
		<div class="coupon-form-wrap">
			<form action="index.php">
				<p><input type="text" placeholder="Coupon"></p>
				<p><input type="submit" value="Apply"></p>
			</form>
		</div>
	</div>
</div>
</div>
</div>
</div>


@endsection