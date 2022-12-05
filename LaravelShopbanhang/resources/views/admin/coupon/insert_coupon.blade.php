@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm danh mục sản phẩm
            </header>
               <?php 
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                    Session::put('message',null);
                }

                ?>
            <div class="panel-body">
             
                <div class="position-center">
                    <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mã giảm giá</label>
                            <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Số lượng mã</label>
                           <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tính năng mã</label>
                            <select name="coupon_condition" class="form-control input-sm m-bot15">
                                <option value="0">-----Chọn------</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nhập số % hoặc số tiền giảm</label>
                            <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" >
                        </div>
                        

                        <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection