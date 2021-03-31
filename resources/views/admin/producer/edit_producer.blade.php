@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật nhà cung cấp 
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_producer as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-producer/'.$edit_value->producer_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" value="{{$edit_value->producer_name}}" name="producer_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ nhà cung cấp</label>
                                    <input type="text" name="producer_address"  value="{{$edit_value->producer_address}}" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại nhà cung cấp</label>
                                    <input data-validation="number" data-validation-error-msg="Làm ơn điền số điện thoại " value="{{$edit_value->producer_phone}}" name="producer_phone" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ email nhà cung cấp</label>
                                    <input type="email" value="{{$edit_value->producer_email}}" name="producer_email" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                              

                                <button type="submit" name="update_producer" class="btn btn-info">Cập nhật nhà cung cấp</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection