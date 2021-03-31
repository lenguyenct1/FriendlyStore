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
                                <form role="form" action="{{URL::to('/save-category')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục sản phẩm" required="">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Phân loại</label>
                                      <select name="type" class="form-control input-sm m-bot15">
                                      <option value="0">Có hạn dùng</option>
                                      <option value="1">Có hạn bảo hành</option>
                                      <option value="2">Có hạn đổi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                      <option value="0">Hiển thị</option>
                                      <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_category" class="btn btn-info">Thêm danh mục sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection