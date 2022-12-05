@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
<div class="panel panel-default">
  <div class="panel-heading">
    Thông tin khách hàng
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
          <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
          
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
    <div class="col-sm-5 m-b-xs">
      <select class="input-sm form-control w-sm inline v-middle">
        <option value="0">Bulk action</option>
        <option value="1">Delete selected</option>
        <option value="2">Bulk edit</option>
        <option value="3">Export</option>
      </select>
      <button class="btn btn-sm btn-default">Apply</button>                
    </div>
    <div class="col-sm-4">
    </div>
    <div class="col-sm-3">
      <div class="input-group">
        <input type="text" class="input-sm form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn btn-sm btn-default" type="button">Go!</button>
        </span>
      </div>
    </div>
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

            <input type="number" min="1" {{$order_status==2 ? 'disabled' : '' }}  class="order_qty_{{$detail->product_id}}" name="product_sales_quantity"  value="{{$detail->product_sales_quantity}}">

            <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$detail->product_id}}" value="{{$detail->product->product_quantity}}"> 

            <input type="hidden" name="order_product_id" class="order_product_id" value="{{$detail->product_id}}">
            @if($order_status!=2)
            <input type="button"  class="btn btn-default update_quantity_order"  data-product_id="{{$detail->product_id}}" value="cap nhat">
            @endif
          
          </td>
          <td>{{number_format($detail->product_price,0,',','.')}}</td>
          <td>{{number_format($subtotal,0,',','.')}}</td>
          
          
        </tr>
        @endforeach
        <?php $number = 0 ?>

        <tr><td colspan="4">
                @if($coupon_condition==2)
                <?php $number = $total-$coupon_number; ?>
                Tổng mã giảm: {{$coupon_number}}Đ;
                @else 
                <?php $number = $total-($total*$coupon_number/100); ?>
                Tổng mã giảm: {{$coupon_number}}%;
                @endif
          Phí ship: {{$detail->product_feeship}};
          <strong>Thanh toán: {{number_format($number-($detail->product_feeship),0,',','.')}}</strong></td> </tr>
      <tr><td colspan="6">
        @foreach($order as $key => $or)
        @if($or->order_status==1)
        <form>
          @csrf
        <label>Tình trạng</label>
        <select class="form-control order_details ">
          <option value="0">-----Chọn hình thức đơn hàng-----</option>
          <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
          <option id="{{$or->order_id}}" value="2">Đã xử lý - đã giao hàng</option>
          <option id="{{$or->order_id}}" value="3">Hủy đơn hàng - tạm giữ</option>
        </select>
        </form>
        @elseif($or->order_status==2)
         <form>
          @csrf
        <label>Tình trạng</label>
        <select class="form-control order_details ">
           <option value="0">-----Chọn hình thức đơn hàng-----</option>
          <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
          <option id="{{$or->order_id}}" selected value="2">Đã xử lý - đã giao hàng</option>
          <option id="{{$or->order_id}}" value="3">Hủy đơn hàng - tạm giữ</option>
        </select>
        </form>
        @else
         <form>
          @csrf
        <label>Tình trạng</label>
        <select class="form-control order_details ">
           <option value="0">-----Chọn hình thức đơn hàng-----</option>
          <option id="{{$or->order_id}}" value="1">Chưa xử lý</option>
          <option id="{{$or->order_id}}" value="2">Đã xử lý - đã giao hàng</option>
          <option id="{{$or->order_id}}" selected  value="3">Hủy đơn hàng - tạm giữ</option>
        </select>
        </form>
        @endif
        @endforeach

      </td></tr>
        
      </tbody>
    </table>
    <a href="{{url('/print-order/'.$detail->order_code)}}">In đơn hàng</a>
  </div>
 
</div>
</div>
@endsection