@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm loại sản phẩm 
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
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại sản phẩm</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên loại sản phẩm" required="">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả loại sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="ckeditor3"  placeholder="Mô tả loại sản phẩm" ></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                      <select name="id" class="form-control input-sm m-bot15">
                                        @foreach($category as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="category_product_status" class="form-control input-sm m-bot15">
                                      <option value="0">Hiển thị</option>
                                      <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm loại sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection