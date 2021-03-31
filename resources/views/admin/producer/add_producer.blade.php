@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm nhà cung cấp 
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
                                <form role="form" action="{{URL::to('/save-producer')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" name="producer_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ nhà cung cấp</label>
                                    <input type="text" name="producer_address" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điện thoại nhà cung cấp</label>
                                    <input data-validation="number" data-validation-error-msg="Làm ơn điền số điện thoại " name="producer_phone" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ email nhà cung cấp</label>
                                    <input type="email" name="producer_email" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp" required="">
                                </div>
                              

                               
                               
                                <button type="submit" name="add_producer" class="btn btn-info">Thêm nhà cung cấp</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection