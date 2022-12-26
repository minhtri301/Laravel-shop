 @extends('layout')
  @section('content')
  <div class="container" style="margin-top: 70px;width: 68%; margin-bottom: 200px;">
<div class="table-agile-info">
<div class="panel panel-default">
  <div class="panel-heading">
    Xem chi tiết đơn hàng
  </div>
  
  <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
      echo '<span>'.$message.'</span>';
      Session::put('message',null);
    }

    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>
          <th>Tên khách hàng</th>
          <th>Số điện thoại</th>
          <th>Email</th>
    
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          
          <td>{{$customer->customer_name}}</td>
          <td>{{$customer->customer_phone}}</td>
          <td>{{$customer->customer_email}}</td>
          
        </tr>
      
        
      </tbody>
    </table>
  </div>
  
</div>
</div>
<br>
<div class="table-agile-info">
<div class="panel panel-default">
  <div class="panel-heading">
    Thông tin vận chuyển
  </div>
  
  <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
      echo '<span>'.$message.'</span>';
      Session::put('message',null);
    }

    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>
          <th>Tên người vận chuyển</th>
          <th>Địa chỉ</th>
          <th>Số điện thoại</th>
          <th>Email</th>
          <th>Ghi chú</th>
          <th>Hình thức thanh toán</th>
    
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          
          <td>{{$shipping->shipping_name}}</td>
          <td>{{$shipping->shipping_address}}</td>
          <td>{{$shipping->shipping_phone}}</td>
          <td>{{$shipping->shipping_email}}</td>
          <td>{{$shipping->shipping_notes}}</td>
          <td>@if($shipping->shipping_method==0) Chuyển khoản @elseif($shipping->shipping_method==1) Tiền mặt @else Thanh toán Paypal @endif</td>
          
        </tr>
      
        
      </tbody>
    </table>
  </div>
  
</div>
</div>
<br><br>

<div class="table-agile-info">
<div class="panel panel-default">
  <div class="panel-heading">
    Liệt kê chi tiết đơn hàng
  </div>
  <div class="row w3-res-tb">
   
  </div>
  <div class="table-responsive">
    <?php
    $message = Session::get('message');
    if($message){
      echo '<span>'.$message.'</span>';
      Session::put('message',null);
    }

    ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>
          <th>stt</th>
          <th>Tên sản phẩm</th>
          <th>Số lượng kho còn</th>
          <th>Mã giảm giá</th>
          <th>Phí ship hàng</th>
          <th>Số lượng</th>
           <th>Giá</th>
            <th>Tổng tiền</th>

          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0; 
        $total = 0?>

        @foreach($order_details_product as $key => $detail)

        <?php $i++;
        $subtotal=$detail->product_price*$detail->product_sales_quantity ;
        $total += $subtotal  ?>
        <tr class="maudo_{{$detail->product_id}}">

          <td><label class="i-checks m-b-none"><i>{{$i}}</i></label></td>
          <td>{{$detail->product_name}}</td>
          <td>{{$detail->product->product_quantity}}</td>
          <td>@if($detail->product_coupon!='no')
            {{$detail->product_coupon}}
            @else
             Không có mã giảm giá
             @endif

          </td>
          <td>{{$detail->product_feeship}}</td>
          <td>
           
            <input type="hidden" name="order_code" class="order_code" value="{{$detail->order_code}}">

            <input type="number" min="1" readonly="" {{$order_status==2 ? 'disabled' : '' }}  class="order_qty_{{$detail->product_id}}" name="product_sales_quantity"  value="{{$detail->product_sales_quantity}}">

            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$detail->product_id}}" value="{{$detail->product->product_quantity}}"> 

            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$detail->product_id}}">
        
          
          </td>
          <td>{{number_format($detail->product_price,0,',','.')}}</td>
          <td>{{number_format($subtotal,0,',','.')}}</td>
          
          
        </tr>
        @endforeach
        <?php $number = 0 ?>

        <tr><td colspan="4">
                @if($coupon_condition==2)
                <?php $number = $total-$coupon_number; ?>
                Tổng mã giảm: {{number_format($coupon_number,0,',','.')}}Đ</br>
                @else 
                <?php $number = $total-($total*$coupon_number/100); ?>
                Tổng mã giảm: {{number_format($coupon_number,0,',','.')}}%</br>
                @endif
          Phí ship: {{number_format($detail->product_feeship,0,',','.')}}</br>
          <strong>Thanh toán: {{number_format($number+($detail->product_feeship),0,',','.')}}</strong></br>
          
        @if($shipping->shipping_method==2)
           Đã thanh toán online: Còn 0đ
          @endif
        </td> </tr>





        
      </tbody>
    </table>
    
  </div>
 
</div>
</div>
</div>
@endsection