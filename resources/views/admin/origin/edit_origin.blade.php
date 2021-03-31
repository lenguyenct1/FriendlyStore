@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật xuất xứ 
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_origin as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-origin/'.$edit_value->product_origin_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên xuất xứ</label>
                                    <input type="text" value="{{$edit_value->product_origin_name}}" name="product_origin_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                               
                                <button type="submit" name="update_origin" class="btn btn-info">Cập nhật xuất xứ</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
@endsection