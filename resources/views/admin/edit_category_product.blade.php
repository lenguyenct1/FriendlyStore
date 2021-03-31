@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật loại sản phẩm 
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại sản phẩm</label>
                                    <input type="text" value="{{$edit_value->category_name}}" name="category_product_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                  
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả loại sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="category_product_desc" id="ckeditor7" >{{$edit_value->category_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                      <select name="id" class="form-control input-sm m-bot15">
                                       @foreach($cate_id as $key => $p)
                                            @if($p->id==$edit_value->id)
                                            <option selected value="{{$p->id}}">{{$p->name}}</option>
                                            @else
                                            <option value="{{$p->id}}">{{$p->name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="category_status" class="form-control input-sm m-bot15">
                                            @if($edit_value->category_status==0)
                                             <option selected value="{{$edit_value->category_status}}">Hiển thị</option>@else
                                          <option value="0">Hiển thị</option>
                                         @endif
                                        @if($edit_value->category_status==1)
                                              <option selected value="{{$edit_value->category_status}}">Ẩn</option>
                                          @else
                                             <option value="1">Ân</option>
                                         @endif
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật loại sản phẩm</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection