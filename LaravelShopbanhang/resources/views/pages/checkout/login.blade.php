<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LOGIN</title>
  <link rel="stylesheet" href="{{asset('public/frontend/css2/style.css')}}">
  <link rel="stylesheet" href="{{asset('public/frontend/css2/login.css')}}">
  <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>
<body>
  <div id="container-login">
   <div id="container-login-left">
      <div id="header-top-left" class="header-login">
          <span id="text-logo">Wellcome</span> </br> <span id="hint-text-logo">Hãy
          tạo nên phong cách của bạn bằng đồng hồ sang trọng</span>
        </div>

        <div id="header-bottom-left">
          <p>
            <span>Luôn luôn cập nhật đồng hồ mới</span>
          </p>
          <p>
            <span>Giảm hơn 50% tất cả các mặt hàng dành cho khách vip</span>
          </p>
          <p>
            <span>Tận tình tư vấn tạo nên phong cách của bạn</span>
          </p>
        </div>
    </div>
   <div id="container-login-right">
<div class="wrapper">
      <div class="title-text">
        <div class="title login">Login Form</div>
        <div class="title signup">Signup Form</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Login</label>
          <label for="signup" class="slide signup">Signup</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="{{URL::to('/login-layout')}}" class="login" method="post">
            {{ csrf_field() }}
            <pre>
            </pre>
            <?php
            $message = Session::get('message');
             if($message){
              echo '<span class="thongbao">'.$message.'</span>';
              Session::put('message',null);
            } ?>
            <div class="field">
              <input type="text" name="email_account"  placeholder="Email" data-validation="email"  data-validation-error-msg="Vui lòng nhập email" id="exampleInputEmail1" >
            </div>
            <div class="field">
              <input type="password" name="password_account" placeholder="Mật khẩu" data-validation="length" data-validation-length="min2" data-validation-error-msg="Vui lòng nhập mật khẩu" id="exampleInputEmail1">
            </div>
           
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="dangnhap" value="Login">
            </div>
            <div class="signup-link">Create an account <a href="">Signup now</a></div>
          </form>

          <form action="{{URL::to('/login-dangky')}}" method="post" class="signup">
            {{ csrf_field() }}
            
            <div class="field">
              <input type="text" name="customer_name" placeholder="Họ và tên" data-validation="length" data-validation-style="color:red" data-validation-length="min2" data-validation-error-msg="Vui lòng nhập tên" id="exampleInputEmail1">
            </div>
            <div class="field">
              <input type="text" name="customer_email" placeholder="Địa chỉ email" data-validation="email"  data-validation-error-msg="Vui lòng nhập email" id="exampleInputEmail1">
            </div>
            <div class="field">
              <input type="password" name="customer_password" placeholder="Mật khẩu" data-validation="length" data-validation-length="min2" data-validation-error-msg="Vui lòng nhập mật khẩu" id="exampleInputEmail1">
            </div>
            <div class="field">
              <input type="text" name="customer_phone" placeholder="Phone" data-validation="number" data-validation-error-msg="Vui lòng điền số điện thoại" id="exampleInputEmail1">
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit"  value="Signup">
            </div>
            <div class="signup-link">Already have an account? <a href="">Login</a></div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  <script  src="{{asset('public/frontend/js2/script.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('public/backend/js/jqueryform-validator.min.js')}}"></script>
<script type="text/javascript">
    $.validate({

    });
</script>
</body>
</html>