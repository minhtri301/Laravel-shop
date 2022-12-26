@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm thông liên hệ
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
                    <form role="form" action="{{URL::to('/save-lienhe-content')}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                      
                    
                         <div class="form-group">
                            <label for="exampleInputPassword1">thông tin liên hệ</label>
                            <textarea style="resize: none" rows="8" class="form-control" name="lienhe_content" id="ckeditor" placeholder="Nội dung sản phẩm"></textarea>
                        </div>
            

                        <button type="submit" name="add_product" class="btn btn-info">Thêm bảo hành</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection