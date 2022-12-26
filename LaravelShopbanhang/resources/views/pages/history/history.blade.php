 @extends('layout')
  @section('content')
<div class="table-agile-info" style="margin-top: 100px;margin-bottom: 200px;">
<div class="panel panel-default" style="width: 70%;margin-left: 15%;">
  <div class="panel-heading">
    Lịch sử đơn hàng
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
          <th>Mã đơn hàng</th>
          <th>Ngày tháng đặt hàng</th>
          <th>Tình trạng đơn hàng</th>
          <th>Thay đổi</th>
          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 0 ?>
        @foreach($order as $key => $ord)
        <tr>
          <td><label class="i-checks m-b-none"><i>{{$i++}}</i></label></td>
          <td>{{ $ord->order_code}}</td>
          <td>{{$ord->created_at}}</td>
          <td>@if($ord->order_status==1)
            Đơn hàng mới
            @elseif($ord->order_status==2)
            Đã xử lý - Đã giao hàng
            @else
            Đã hủy
            @endif




          </td>
     
          <td>
            <a href="{{URL::to('/view-history-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i>Xem đơn hàng</a>
            @if($ord->order_status==1)
            <a onclick="return confirm('Bạn có hủy đơn này không?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">  
              <i class="fa fa-times text-danger text"></i>Hủy đơn</a>
            @endif
          </td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>
  <footer class="panel-footer">
    <div class="row">
      <div class="col-sm-5 text-center"></div>
      <div class="col-sm-7 text-right text-center-xs" >
        <ul class="pagination pagination-sm-m-t-none-m-b-none">
          {!!$order->links()!!}
        </ul>
      </div>
    </div>
  </footer>

</div>
</div>
@endsection