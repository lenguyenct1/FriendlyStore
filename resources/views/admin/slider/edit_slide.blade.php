@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật slider 
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
                                <form role="form" action="{{URL::to('/update-slider/'.$edit_slider->slider_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên slider</label>
                                    <input type="text" name="slider_name" value="{{$edit_slider->slider_name}}"class="form-control" id="exampleInputEmail1" placeholder="Tên tiêu đề chính" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="slider_image"  class="form-control" id="exampleInputEmail1" placeholder="Slide" >
                                     <img src="{{URL::to('public/uploads/slider/'.$edit_slider->slider_image)}}" height="100%" width="100%">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <input type="text" name="slider_desc" value="{{$edit_slider->slider_desc}}"class="form-control" id="exampleInputEmail1" placeholder="Tên tiêu đề phụ" required="">
                                </div>
                                     <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="slider_status" class="form-control input-sm m-bot15">
                                            @if($edit_slider->slider_status==0)
                                             <option selected value="{{$edit_slider->slider_status}}">Hiển thị</option>@else
                                          <option value="0">Hiển thị</option>
                                         @endif
                                        @if($edit_slider->slider_status==1)
                                              <option selected value="{{$edit_slider->slider_status}}">Ẩn</option>
                                          @else
                                             <option value="1">Ân</option>
                                         @endif
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="update_slider" class="btn btn-info">Cập nhật Slidẻ</button>
                                </form>
                            </div>
                             
                        </div>
                    </section>

            </div>
@endsection