@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm tin tức
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
                                <form role="form" action="{{URL::to('/save-news')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tin tức</label>
                                    <input type="text" data-validation="length" data-validation-length="min10"  data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="news_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tin tức" >
                                </div>
                                
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh tin tức</label>
                                    <input type="file" name="news_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả tin tức</label>
                                    <textarea style="resize: none" rows="8" class="form-control"
                               name="news_desc" id="ckeditor4" placeholder="Mô tả tin tức"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung tin tức</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="news_content" id="ckeditor5" placeholder="Nội dung tin tức"></textarea>
                                </div>
                                
                              
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="news_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_news" class="btn btn-info">Thêm tin tức</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection