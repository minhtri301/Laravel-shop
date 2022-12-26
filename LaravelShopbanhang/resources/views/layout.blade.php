<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}"/>
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link  rel="canonical" href="{{$url_canonical}}" />
    <meta name="author" content="">
    <link  rel="icon" type="image/x-icon" href="" />

      <!--     <meta property="og:image" content="" /> -->
      <meta property="og:site_name" content="http://localhost:8083/LaravelShopbanhang/" />
      <meta property="og:description" content="{{$meta_desc}}" />
      <meta property="og:title" content="{{$meta_title}}" />
      <meta property="og:url" content="{{$url_canonical}}" />
      <meta property="og:type" content="website" />




    <!-- title -->
    <title>{{$meta_title}}</title>

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{asset('public/frontend/images/img/favicon.png')}}">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/all.min.css')}}">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.css')}}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
    <!-- mean menu css -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/meanmenu.min.css')}}">
    <!-- main style -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/main.css')}}">
    <!-- responsive -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/responsive.css')}}">

   <!--  Eshopper -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/sweetalert.css')}}">

<link href="{{asset('public/frontend/css2/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css2/font-awesome.min.css')}}" rel="stylesheet">
 <link href="{{asset('public/frontend/css2/prettyPhoto.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css2/price-range.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css2/animate.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css2/main.css')}}" rel="stylesheet">
<link href="{{asset('public/frontend/css2/responsive.css')}}" rel="stylesheet">

</head>
<body>

<!--PreLoader-->
<!-- <div class="loader">
    <div class="loader-inner">
        <div class="circle"></div>
    </div>
</div> -->
<!--PreLoader Ends-->

<!-- header -->
<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index_2.php">
                            <img src="" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="{{URL::to('/trang-chu')}}">Trang chủ</a>

                            </li>
                            <li><a href="#" >Danh mục</a>
                                 <ul class="sub-menu2">
                                    @foreach($category as $key => $cate)
                                    <li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->slug_category_product)}}">{{$cate->category_name}}</a></li>
                                    @endforeach
                                   
                                </ul>
                            </li>
                            <li><a href="#" >Thương hiệu</a>
                                <ul class="sub-menu2">
                                     @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->slug_brand_product)}}">{{$brand->brand_name}}</a></li>
                                    
                                     @endforeach
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/san-pham')}}">Sản phẩm</a>
                                
                            </li>
                            <li><a >Dịch vụ</a>
                             <ul class="sub-menu2">
                                    <li><a href="{{URL::to('/view-lienhe-baohanh')}}">Bảo hành - Sửa chữa</a></li>
                                    
                                </ul>
                            </li>
                            <li><a href="{{URL::to('/view-lienhe-content')}}">Liên hệ</a>
                               
                            </li>

                            <li style="float: right;">
                                <?php 
                                $customer_id = Session::get('customer_id');
                                if($customer_id!=null){ ?>
                                    <a >Tài khoản</a>
                                    <ul class="sub-menu2">
                                    <li><a><i class="fa fa-user"></i>   Hi {{Session::get('customer_name')}}</a></li>
                                    <li><a href="{{URL::to('/history')}}" ><i class="fa fa-bell"></i>  Lịch sử đơn hàng</a></li>
                                    <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-power-off"> </i> Đăng xuất</a></li>
                                </ul>
                                    

                                <?php }else{ ?>
                                     <a href="{{URL::to('/login')}}">đăng nhập</a>
                                <?php } ?>    

                                

                               
                                


                            </li>
                            <li>
                                <div class="header-icons">
                                    <!-- gio hang -->
                                    <a class="shopping-cart" href="{{URL::to('/gio-hang')}}"><i class="fas fa-shopping-cart"></i> </a>
                                    <!-- tim kiem -->
                                    <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end header -->

<!-- search area -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <span class="close-btn"><i class="fas fa-window-close"></i></span>
                <div class="search-bar">
                    <div class="search-bar-tablecell">
                        <h3>Search For:</h3>
                        <form action="{{URL::to('/tim-kiem')}}" method="post">
                            {{ csrf_field() }}
                        <input type="text" name="keyword_submit" placeholder="Keywords">
                        <button type="submit">Tìm kiếm <i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end search area -->

<!-- home page slider -->
<div class="homepage-slider">
    <!-- single home slider -->
    
</div>
<!-- end home page slider -->


<!-- end features list section -->

<!-- product section -->
@yield('content')
<!-- end product section -->

<!-- cart banner section -->

<!-- end cart banner section -->

<!-- testimonail-section -->

<!-- end testimonail-section -->

<!-- advertisement section -->

<!-- end advertisement section -->

<!-- shop banner -->

<!-- end shop banner -->

<!-- latest news -->

<!-- end latest news -->

<!-- logo carousel -->
<div class="logo-carousel-section">

    <div class="container">
<div style="display: flex;flex-direction: row;justify-content: center;font-size: 24px;color: #555c5c; margin-bottom: 40px;
    font-weight: 600;"><span>-------- Khách hàng của chúng tôi --------</span></div>
 <div class="a" style="display: flex;width: 1380px;flex-direction: row;justify-content: space-evenly;margin-left: -137px;">
              
                  
                        <img src="{{('public/frontend/images/img/UNILEVER-1.jpg')}}" alt="">
                
                 
                        <img src="{{('public/frontend/images/img/POCA-1.jpg')}}" alt="">
                  
                    
                        <img src="{{('public/frontend/images/img/PETRO-1.jpg')}}" alt="">
                   
                 
                        <img src="{{('public/frontend/images/img/Bosch_logo-1.jpg')}}" alt="">
                   
                   
                        <img src="{{('public/frontend/images/img/NESTLE-1.jpg')}}" alt="">
                  
                        <img src="{{('public/frontend/images/img/NUMBER-1-1.jpg')}}" alt="">
                   
                        <img src="{{('public/frontend/images/img/LAVIE-1.jpg')}}" alt="">
                  
                        <img src="{{('public/frontend/images/img/EVN-1.jpg')}}" alt="">
                 
                  
     </div>
    

    </div>
</div>
<!-- end logo carousel -->

<!-- footer -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-box about-widget">
                    <h2 class="widget-title">About us</h2>
                    <p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium
                        doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box get-in-touch">
                    <h2 class="widget-title">Get in Touch</h2>
                    <ul>
                        <li>34/8, East Hukupara, Gifirtok, Sadan.</li>
                        <li>support@fruitkha.com</li>
                        <li>+00 111 222 3333</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box pages">
                    <h2 class="widget-title">Pages</h2>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="services.html">Shop</a></li>
                        <li><a href="news.html">News</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box subscribe">
                    <h2 class="widget-title">Subscribe</h2>
                    <p>Subscribe to our mailing list to get the latest updates.</p>
                    <form action="index.php">
                        <input type="email" placeholder="Email">
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end footer -->

<!-- copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <p>Copyrights &copy; 2019 - <a href="https://imransdesign.com/">Imran Hossain</a>, All Rights Reserved.
                </p>
            </div>
            <div class="col-lg-6 text-right col-md-12">
                <div class="social-icons">
                    <ul>
                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end copyright -->

<!-- jquery -->

<script src="{{asset('public/frontend/js/jquery-1.11.3.min.js')}}"></script>
<!-- bootstrap -->
<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
<!-- count down -->
<script src="{{asset('public/frontend/js/jquery.countdown.js')}}"></script>
<!-- isotope -->
<script src="{{asset('public/frontend/js/jquery.isotope-3.0.6.min.js')}}"></script>
<!-- waypoints -->
<script src="{{asset('public/frontend/js/waypoints.js')}}"></script>
<!-- owl carousel -->
<script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
<!-- magnific popup -->
<script src="{{asset('public/frontend/js/jquery.magnific-popup.min.js')}}"></script>
<!-- mean menu -->
<script src="{{asset('public/frontend/js/jquery.meanmenu.min.js')}}"></script>
<!-- sticker js -->
<script src="{{asset('public/frontend/js/sticker.js')}}"></script>
<!-- main js -->
<script src="{{asset('public/frontend/js/main.js')}}"></script>
<script src="{{asset('public/frontend/js/sanphamchitiet.js')}}"></script>

<script src="{{asset('public/frontend/js2/jquery.js')}}"></script>
<script src="{{asset('public/frontend/js2/price-range.js')}}"></script>
<script src="{{asset('public/frontend/js2/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('public/frontend/js2/bootstrap.min.js')}}"></script>
<script src="{{asset('public/frontend/js2/jquery.prettyPhoto.js')}}"></script>
<script src="{{asset('public/frontend/js2/main.js')}}"></script>
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script src="{{asset('public/backend/js/jqueryform-validator.min.js')}}"></script>
<script type="text/javascript">
    $.validate({

    });
</script>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="Xi5uOpoc"></script>

<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.add-to-cart').click(function(){
        var dataid = $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + dataid).val();
        var cart_product_name = $('.cart_product_name_' + dataid).val();
        var cart_product_image = $('.cart_product_image_' + dataid).val();
        var cart_product_price = $('.cart_product_price_' + dataid).val();
        var cart_product_qty = $('.cart_product_qty_' + dataid).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: '{{url('/add-cart-ajax')}}',
            method: 'post',
            data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token}, 
            success:function(data){
                  swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

            }
        })
    })

  


  })

</script>
<script type="text/javascript">
    $(document).ready(function(){
           $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            // alert(matp);
            // alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-cart')}}',
                method : 'post',
                data:{action:action,ma_value:ma_value,_token:_token},
                success:function(data){
                    $('#'+result).html(data);   
                }
            });

        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.calculate-delivery').click(function(){
            var matp = $('.city').val();
            var maqh = $('.province').val();
            var xaid = $('.wards').val();
            var _token = $('input[name="_token"]').val();
            if(matp == '' || maqh == '' || xaid == ''){
                alert('Làm ơn chọn để tính phí vận chuyển');
            }else{ 
                $.ajax({
                url : '{{url('/calculate-fee')}}',
                method : 'post',
                data: {matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                susscess:function(){
                    // location.reload();
                    
                }         

        });
                 window.setTimeout(function(){
                       location.reload();
                   },1);
         };
          
        }); 
    })

</script>
<script type="text/javascript">
     $(document).ready(function(){
    $('.send_order').click(function(){
                var shipping_email2 = $('.shipping_email' ).val();
                   var shipping_name2 = $('.shipping_name' ).val();
                   var shipping_address2 = $('.shipping_address').val();
                   var shipping_phone2 = $('.shipping_phone' ).val();
                   var shipping_notes2 = $('.shipping_notes' ).val();
        if(shipping_email2 == '' || shipping_name2 == '' || shipping_address2 == '' || shipping_phone2 == ''){
          
                alert('Vui lòng nhập đầy đủ thông tin');
            
         }else{
        swal({
          title: "Xác nhận đơn hàng?",
          text: "Đơn hàng sẽ không được hoàn trả khi đặt, bạn có muốn đặt không",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
         confirmButtonText: "Cảm ơn, mua hàng",
          cancelButtonText: "Không, chưa mua",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {

                   var shipping_email = $('.shipping_email' ).val();
                   var shipping_name = $('.shipping_name' ).val();
                   var shipping_address = $('.shipping_address').val();
                   var shipping_phone = $('.shipping_phone' ).val();
                   var shipping_notes = $('.shipping_notes' ).val();
                   var shipping_method = $('.payment_select' ).val();
                   var order_fee = $('.order_fee' ).val();
                   var order_coupon = $('.order_coupon' ).val();
                   var _token = $('input[name="_token"]').val();
                   $.ajax({
                    url: '{{url('/confirm-order')}}',
                    method: 'post',
                    data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,shipping_method:shipping_method,order_fee:order_fee,order_coupon:order_coupon,_token:_token}, 
                    success:function(){
                     swal("Đơn hàng", "của bạn đã được gửi thành công", "success");
                 }
             });
                   window.setTimeout(function(){
                       window.location.href = "{{url('/history')}}";
                   },3000);

              } else {
                swal("Đóng", "đơn hàng chưa được gửi, làm ơn hoàn tất đơn hàng", "error");
              }
        });
        } 
     
    });

  


  })
</script>


<script type="text/javascript">
    function view(){
       if(localStorage.getItem('data')!=null){
        var data = JSON.parse(localStorage.getItem('data')); 

        for(i=0;i<data.length;i++){
            var name = data[i].name; 
            var price = data[i].price; 
            var image = data[i].image; 
            var url = data[i].url; 
               $('#row_wishlist').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="'+image+'"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p>'+price+'</p><a href="'+url+'">dat hang</a></div></div>');
        }
       }

    }
    view();

    function add_wistlist(clicked_id){
        var id = clicked_id;
        var name = document.getElementById('wishlist_productname'+id).value; 
        var price =  document.getElementById('wishlist_productprice'+id).value; 
        var image =  document.getElementById('wishlist_productimage'+id).src; 
        var url = document.getElementById('wishlist_producturl'+id).href; 
    // alert(id);
    // alert(name); 
    // alert(price); 
    // alert(image);
    // alert(url);
        var newItem = {
            'url' :url, 
            'id' :id, 
            'name' :name; 
            'price' :price; 
            'image' :image
        }
            if(localStorage.getItem('data')==null){
                localStorage.setItem('data','[]');
            }

            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data, function(obj){return obj.id == id;})

            if(matches.length){
                 alert('Sản phẩm bạn đã yêu thích, nên không thể thêm');
            }else{
                old_data.push(newItem); 
                $('#row_wishlist').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="'+newItem.image+'"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p>'+newItem.price+'</p><a href="'+newItem.url+'">dat hang</a></div>');

            }
            localStorage.setItem('data', JSON.stringify(old_data));


 }
</script>






</body>
</html>
