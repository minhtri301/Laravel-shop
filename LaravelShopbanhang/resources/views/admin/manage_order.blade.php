@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
<div class="panel panel-default">
  <div class="panel-heading">
    Liệt kê hóa đơn
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
            Chưa xử lý
            @elseif($ord->order_status==2)
            Đã xử lý
            @else
            Đã hủy
            @endif




          </td>
     
          <td>
            <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa fa-pencil-square-o text-success text-active"></i></a>
            <a onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active styling-edit" ui-toggle-class="">  
              <i class="fa fa-times text-danger text"></i></a>
          </td>
        </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>

</div>
</div>
@endsection