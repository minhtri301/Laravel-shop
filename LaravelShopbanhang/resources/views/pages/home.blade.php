  @extends('layout')
  @section('content')
  <!-- features list section -->
  <div class="list-section pt-80 pb-80">
  <div class="container ctai2" >

    <div class="row" >
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="list-box d-flex align-items-center">
          <div class="list-icon">
            <strong><img src="{{('public/frontend/images/img/icon_mat-xa-cu.jpg')}}"></strong>
          </div>
          <div class="list-icon">
            <a href="#"><img src="{{('public/frontend/images/img/icon_phien-ban-gioi-han.jpg')}}"></a>
          </div>
          <div class="list-icon">
            <a href="#"><img src="{{('public/frontend/images/img/icon_sieu-mong.jpg')}}"></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="list-box d-flex align-items-center">
          <div class="list-icon">
            <a href="#"><img src="{{('public/frontend/images/img/icon_skeleton.jpg')}}"></a>
          </div>
          <div class="list-icon">
            <a href="#"><img src="{{('public/frontend/images/img/icon_vang-18k.jpg')}}"></a>
          </div>
          <div class="list-icon">
            <a href="#"><img src="{{('public/frontend/images/img/icon_vat-lieu-hiem.jpg')}}"></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="list-box d-flex justify-content-start align-items-center">
         <div class="list-icon">
          <a href="#"><img src="{{('public/frontend/images/img/icon_day-da-hirsch.jpg')}}"></a>
        </div>
        <div class="list-icon">
          <a href="#"><img src="{{('public/frontend/images/img/icon_kim-cuong.jpg')}}"></a>
        </div>
        <div class="list-icon">
          <a href="#"><img src="{{('public/frontend/images/img/trang-suc-icon.jpg')}}"></a>
        </div>
      </div>
    </div>
  </div>

  </div>
  </div>

  <div class="list-section pt-80 pb-80">
  <div class="container" style="    margin-top: -85px;">

    <div class="row">
      <div class="col-lg-8 col-md-6 mb-4 mb-lg-0">
         

          
        <a href="#"><img src="{{('public/frontend/images/img/banner-trang-chu-doxa-grandemetre.jpg')}}"></a>

      </div>
      <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
        <div class="chia4">
          <div class="chia2">
            <a href="#"><img src="{{('public/frontend/images/img/banner-dong-ho-nam.jpg')}}"></a>
            <a href="#"><img src="{{('public/frontend/images/img/banner-dong-ho-nu.jpg')}}"></a>
          </div>
          <div class="chia2">
            <a href="#"><img src="{{('public/frontend/images/img/banner-dong-ho-doi.jpg')}}"></a>
            <a href="#"><img src="{{('public/frontend/images/img/banner-dong-ho-tre-em.jpg')}}"></a>
          </div>
        </div>
      </div>

    </div>

  </div>
  </div>

  <!-- san pham -->
  <div class="product-section mt-150 mb-150">
  <div class="container">
   <div class="row">
    <div class="col-lg-8 offset-lg-2 text-center">
     <div class="section-title">	
      <h3><span class="orange-text">Sản phẩm</span> của chúng tôi</h3>
      <p><strong>TOP ĐỒNG HỒ BÁN CHẠY</strong></p>
    </div>
  </div>
  </div>

  <div class="row">
  @foreach($all_product as $key => $product)
  <div class="col-lg-3 col-md-6 text-center">
   <div class="single-product-item">
    <div class="product-image">
     <a href="{{URL::to('/chi-tiet-san-pham/'.$product->slug_product)}}"><img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt=""></a>
   </div>
   <div style="height: 60px"><h3>{{$product->product_name}}</h3></div>
   <p class="product-price"><span><img src="{{('public/frontend/images/img/star-active.jpg')}}">
    <img src="{{('public/frontend/images/img/star-active.jpg')}}">
    <img src="{{('public/frontend/images/img/star-active.jpg')}}">
    <img src="{{('public/frontend/images/img/star-active.jpg')}}">
    <img src="{{('public/frontend/images/img/star-active.jpg')}}"></span>{{number_format($product->product_price,'0',',','.').' '.'VND'}}</p>

    <form  class="fas fa-shopping-cart">
     @csrf
     <input type="hidden" class="cart_product_id_{{$product->product_id}}" value="{{$product->product_id}}">
     <input type="hidden" class="cart_product_name_{{$product->product_id}}" value="{{$product->product_name}}">
     <input type="hidden" class="cart_product_image_{{$product->product_id}}" value="{{$product->product_image}}">
     <input type="hidden" class="cart_product_price_{{$product->product_id}}" value="{{$product->product_price}}">
     <input type="hidden" class="cart_product_qty_{{$product->product_id}}" value="1">
     <?php if($product->product_quantity>0){ ?>
     <button type="button" class="add-to-cart" data-id_product="{{$product->product_id}}" >Thêm giỏ hàng</button>
   <?php }else{ ?> 
    <button type="button" style="color: #696763;
    font-family: 'Roboto', sans-serif;
    font-size: 15px;
    border: none;">Hết hàng</button>
  <?php }   ?>


   </form>
 </div>
</div>
  @endforeach


  </div>
  </div>
  </div>


  @endsection