@extends('layout')
@section('content')
<section id="form"><!--form-->
    <div class="container"  style=" margin-top: 200px !important;
    margin-bottom: 400px !important;">
    <div class="register-req">
        <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán giỏ hàng và xem lại lịch sử mua hàng</p>
      </div><!--/register-req-->

      <div class="row">
        <div class="col-sm-4 col-sm-offset-1">
          <div class="login-form"><!--login form-->
            <h2>Đăng nhập tài khoản</h2>
            <form action="{{URL::to('/login-customer')}}" method="POST">
              {{csrf_field()}}
              <input type="text" name="email_account" placeholder="Tài khoản" />
              <input type="password" name="password_account" placeholder="Password" />
              <span>
                <input type="checkbox" class="checkbox"> 
                Ghi nhớ đăng nhập
              </span>
              <button type="submit" class="btn btn-default">Đăng nhập</button>
            </form>
          </div><!--/login form-->
        </div>
        <div class="col-sm-1" style="padding-top: 94px;">
          <h2 class="or">Hoặc</h2>
        </div>
        <div class="col-sm-4">
          <div class="signup-form"><!--sign up form-->
            <h2>Đăng ký</h2>
            <form action="{{URL::to('/add-customer')}}" method="POST">
              {{ csrf_field() }}
              <input type="text" name="customer_name" placeholder="Họ và tên"/>
              <input type="email" name="customer_email" placeholder="Địa chỉ email"/>
              <input type="password" name="customer_password" placeholder="Mật khẩu"/>
              <input type="text" name="customer_phone" placeholder="Phone"/>
              <button type="submit" class="btn btn-default">Đăng ký</button>
            </form>
          </div><!--/sign up form-->
        </div>
      </div>
    </div>
  </section><!--/form-->

@endsection