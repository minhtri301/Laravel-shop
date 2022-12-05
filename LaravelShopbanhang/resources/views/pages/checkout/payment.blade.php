@extends('layout')
@section('content')
<?php 
$content = Cart::content();

?>

	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
						  <div class="card single-accordion">
						    <div class="card-header" id="headingOne">
						      <h5 class="mb-0">
						        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						          Điền thông tin gửi hàng
						        </button>
						      </h5>
						    </div>

						    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="billing-address-form">
						        	<form action="{{URL::to('/save-checkout-customer')}}" method="post">
						        		{{csrf_field()}}
						        		<p><input type="text" name="shipping_email" placeholder="Email"></p>
						        		<p><input type="text" name="shipping_name" placeholder="Họ và tên"></p>
						        		<p><input type="text" name="shipping_address" placeholder="Địa chỉ"></p>
						        		<p><input type="text" name="shipping_phone" placeholder="Phone"></p>
						        		<p><textarea name="shipping_notes" id="bill" cols="30" rows="10" placeholder="Ghi chú gửi hàng"></textarea></p>
						        		<input type="submit" style="height: 44px; font-size: 11px;" value="Gửi" name="send_order"  >
						        	</form>
						        </div>
						      </div>
						    </div>
						  </div>
						  <div class="card single-accordion">
						    <div class="card-header" id="headingTwo">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						          Chọn hình thức thanh toán
						        </button>
						      </h5>
						    </div>
						    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="shipping-address-form">
						        	<table>
						        		<thead >
						        		<tr >
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
						             <form method="post" action="{{URL::to('/order-place')}}">
						             	{{ csrf_field() }}
						        	<span><label><input type="checkbox" value="1" name="payment_option"> Trả bằng thẻ ATM</label></span>
						        	<span><label><input type="checkbox" value="2" name="payment_option"> Nhận tiền mặt</label></span>
						        	<span><label><input type="checkbox" value="3" name="payment_option"> Thanh toán thẻ ghi nợ</label></span>
						        	<input type="submit" name="" value="Đặt hàng" name="send_order_place">
						        	</form>
						        </div>
						      </div>
						    </div>
						  </div>
						  <div class="card single-accordion">
						    <div class="card-header" id="headingThree">
						      <h5 class="mb-0">
						        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						          Card Details
						        </button>
						      </h5>
						    </div>
						    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
						      <div class="card-body">
						        <div class="card-details">
						        	<p>Your card details goes here.</p>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>

					</div>
				</div>

				<div class="col-lg-4">
					<div class="order-details-wrap">
						<table class="order-details">
							<thead>
								<tr>
									<th>Your order Details</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody class="order-details-body">
								<tr>
									<td>Product</td>
									<td>Total</td>
								</tr>
								<tr>
									<td>Strawberry</td>
									<td>$85.00</td>
								</tr>
								<tr>
									<td>Berry</td>
									<td>$70.00</td>
								</tr>
								<tr>
									<td>Lemon</td>
									<td>$35.00</td>
								</tr>
							</tbody>
							<tbody class="checkout-details">
								<tr>
									<td>Subtotal</td>
									<td>$190</td>
								</tr>
								<tr>
									<td>Shipping</td>
									<td>$50</td>
								</tr>
								<tr>
									<td>Total</td>
									<td>$240</td>
								</tr>
							</tbody>
						</table>
						<a href="#" class="boxed-btn">Place Order</a>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection