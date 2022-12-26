@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container" style=" margin-top: 100px !important;
    margin-bottom: 400px !important;">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			
			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">


						<a class="btn btn-primary m-3" href="{{ route('processTransaction') }}"> </a>
						@if(\Session::has('error'))
						<div class="alert alert-danger">{{ \Session::get('error') }}</div>
						{{ \Session::forget('error') }}
						@endif
						@if(\Session::has('success'))
						<div class="alert alert-success">{{ \Session::get('success') }}</div>
						{{ \Session::forget('success') }}
						@endif

						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one" style="display: flex;flex-direction: row;justify-content: space-between; width: 100%;">
								<form method="POST" style="    width: 50%;">
									@csrf
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Điền email">
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên người nhận" >
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ gửi hàng">
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
									<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
									
									@if(Session::get('fee'))
										<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else 
										<input type="hidden" name="order_fee" class="order_fee" value="20000">
									@endif

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif
									
									
									
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                                    @if(!Session::get('thanhcong_paypal')==true)
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                            <option value="0">Qua chuyển khoản</option>
		                                            <option value="1">Tiền mặt</option>   
		                                      </select>
		                                    @else
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                            <option value="2">Đã thanh toán thành công bằng Paypal</option> 
		                                      </select>
		                                    @endif
		                                </div>
									</div>
									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order" >
								</form>
								<form method="post" style="width: 43%;">
                                    @csrf 
                             
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                      <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    
                                            <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                      <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                            <option value="">--Chọn quận huyện--</option>
                                           
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                      <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                            <option value="">--Chọn xã phường--</option>   
                                    </select>
                                </div>
                               
                               
                              	<input type="button" name="calculate_order" class="btn btn-primary btn-sm calculate-delivery" value="Tính phí vận chuyển">


                                </form>
                              
							</div>
							
						</div>
					</div>
					<div class="col-sm-12 clearfix">
						  @if(session()->has('message'))
			                    <div class="alert alert-success">
			                        {!! session()->get('message') !!}
			                    </div>
			                @elseif(session()->has('error'))
			                     <div class="alert alert-danger">
			                        {!! session()->get('error') !!}
			                    </div>
			                @endif
						<div class="table-responsive cart_info">

							<form action="{{url('/update-cart')}}" method="POST">
								@csrf
							<table class="table table-condensed">
								<thead>
									<tr class="cart_menu">
										<td class="image">Hình ảnh</td>
										<td class="description">Tên sản phẩm</td>
										<td class="price">Giá sản phẩm</td>
										<td class="quantity">Số lượng</td>
										<td class="total">Thành tiền</td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									@if(Session::get('cart')==true)
									@php
											$total = 0;
									@endphp
									@foreach(Session::get('cart') as $key => $cart)
										@php
											$subtotal = $cart['product_price']*$cart['product_qty'];
											$total+=$subtotal;
										@endphp

									<tr>
										<td class="cart_product">
											<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
										</td>
										<td class="cart_description">
											<h4><a href=""></a></h4>
											<p>{{$cart['product_name']}}</p>
										</td>
										<td class="cart_price">
											<p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
										</td>
										<td class="cart_quantity">
											<div class="cart_quantity_button">
											
											
												<input class="cart_quantity" type="number" 
												@if(Session::get('thanhcong_paypal')==true)
                                                readonly 
												@endif
												 min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
											
												
											</div>
										</td>
										<td class="cart_total">
											<p class="cart_total_price">
												{{number_format($subtotal,0,',','.')}}đ
												
											</p>
										</td>
										<td class="cart_delete">
											@if(!Session::get('thanhcong_paypal')==true)
											<a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
											@endif 
										</td>
									</tr>
									
									@endforeach
									<tr>
										@if(!Session::get('thanhcong_paypal')==true)
										<td>
											<input type="submit" style="padding: 6px 15px;color: #ffffff;font-weight: 500;font-size: 13px;" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm">
										</td>
										<td>
											<a style="border-radius: 20px;" class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a>					
										</td>
										{{-- <td>
											 <a class="btn btn-primary m-3" href="{{ route('processTransaction') }}">Thanh toán bằng Paypal</a>
										</td> --}}
										<td>
											@if(Session::get('coupon'))
				                          	<a style="border-radius: 20px;" class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
											@endif
										</td>
										@endif

										
										<td colspan="2">
										<li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
										@if(Session::get('coupon'))
										<li>
											
												@foreach(Session::get('coupon') as $key => $cou)
													@if($cou['coupon_condition']==1)
														Mã giảm : {{$cou['coupon_number']}} %
														<p>
															@php 
															$total_coupon = ($total*$cou['coupon_number'])/100;
														
															@endphp
														</p>
														<p>
														@php 
															$total_after_coupon = $total-$total_coupon;
														@endphp
														</p>
													@elseif($cou['coupon_condition']==2)
														Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
														<p>
															@php 
															$total_coupon = $total - $cou['coupon_number'];
														
															@endphp
														</p>
														@php 
															$total_after_coupon = $total_coupon;
														@endphp
													@endif
												@endforeach
											
											

										</li>
										@endif

										@if(Session::get('fee'))
										<li>	
											<a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>

											Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></li> 
											<?php $total_after_fee = $total + Session::get('fee'); ?>
										@endif 
										<li>Tổng còn:
										@php 
											if(Session::get('fee') && !Session::get('coupon')){
												$total_after = $total_after_fee;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												echo number_format($total_after,0,',','.').'đ';
											}elseif(Session::get('fee') && Session::get('coupon')){
												$total_after = $total_after_coupon;
												$total_after = $total_after + Session::get('fee');
												echo number_format($total_after,0,',','.').'đ';
											}elseif(!Session::get('fee') && !Session::get('coupon')){
												$total_after = $total;
												echo number_format($total_after,0,',','.').'đ';
											}

										@endphp
										</li>
										<div class="col-md-12">
											@php 
											$vnd_to_usd = $total_after/23083;
											$totalpaypal = round($vnd_to_usd,2);
											\Session::put('total_paypal',$totalpaypal)
											@endphp
											
											
										 </div>
										
									</td>
									</tr>
									@else 
									<tr>
										<td colspan="5"><center>
										@php 
										echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
										@endphp
										</center></td>
									</tr>
									@endif
								</tbody>

								

							</form>
								@if(Session::get('cart'))
								<tr><td>
									@if(!Session::get('thanhcong_paypal')==true)
										<form method="POST" action="{{url('/check-coupon')}}">
											@csrf
												<input type="text" style="margin-top: 19px;" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
				                          		<input type="submit" style="padding: 6px 15px;color: #ffffff;font-weight: 500;font-size: 13px;margin-top: -16px;" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
				                          	
			                          		</form>
			                         
			                          	</td>

			                          	<td>

											 <a class="btn btn-primary m-3" style="border-radius: 20px;" class="btn btn-default check_out" href="{{ route('processTransaction') }}">Thanh toán bằng Paypal</a>
								
			                          		<form action="{{url('/vnpay-payment')}}" method="post">
												@csrf
											<input type="hidden" name="total_vnpay" value="{{$total_after}}">
											<button type="submit" style="border-radius: 20px;" class="btn btn-default check_out" name="redirect">Thanh toán VNPAY </button>
											</form>


											<form action="{{url('/momo-payment')}}" method="post">
												@csrf
											<input type="hidden" name="total_momo" value="{{$total_after}}">
											<button type="submit" style="border-radius: 20px;" class="btn btn-default check_out" name="payUrl">Thanh toán MOMO </button>
											</form>
			                          	</td>
			                          	@endif
								</tr>
								@endif

							</table>

						</div>
					</div>
									
				</div>
			</div>
		

			
			
		</div>
	</section> <!--/#cart_items-->

@endsection