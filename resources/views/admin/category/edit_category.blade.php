@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật danh mục sản phẩm 
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_category as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category/'.$edit_value->id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                                    <input type="text" value="{{$edit_value->name}}" name="name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Phân loại</label>
                                      <select name="type" class="form-control input-sm m-bot15">
                                            @if($edit_value->type==0)
                                             <option selected value="{{$edit_value->type}}">Có hạn dùng</option>
                                             @else
                                          <option value="0">Có hạn dùng</option>
                                           @endif
                                        @if($edit_value->type==1)
                                              <option selected value="{{$edit_value->type}}">Có hạn bảo hành</option>
                                          @else
                                             <option value="1">Có hạn bảo hành</option>
                                         @endif
                                             @if($edit_value->type==2)
                                              <option selected value="{{$edit_value->type}}">Có hạn đổi</option>
                                          @else
                                             <option value="2">Có hạn đổi</option>
                                         @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="status" class="form-control input-sm m-bot15">
                                            @if($edit_value->status==0)
                                             <option selected value="{{$edit_value->status}}">Hiển thị</option>@else
                                          <option value="0">Hiển thị</option>
                                         @endif
                                        @if($edit_value->status==1)
                                              <option selected value="{{$edit_value->status}}">Ẩn</option>
                                          @else
                                             <option value="1">Ân</option>
                                         @endif
                                            
                                    </select>
                                </div>
                                <button type="submit" name="update_category" class="btn btn-info">Cập nhật danh mục sản phẩm</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection