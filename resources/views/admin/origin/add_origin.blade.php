@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm xuất xứ 
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
                                <form role="form" action="{{URL::to('/save-origin')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên xuất xứ</label>
                                    <input type="text" name="product_origin_name" class="form-control" id="exampleInputEmail1" placeholder="Tên xuất xứ" required="">
                                </div>
                                
                               
                               
                                <button type="submit" name="add_origin" class="btn btn-info">Thêm xuất xứ</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection