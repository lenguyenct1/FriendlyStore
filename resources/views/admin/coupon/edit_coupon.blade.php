@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật mã giảm giá
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
                                <form  role="form" action="{{URL::to('/update-coupon/'.$coupon->coupon_id)}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" value="{{$coupon->coupon_name}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1"  value="{{$coupon->coupon_code}}" readonly="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng mã</label>
                                      <input type="text" name="coupon_time" value="{{$coupon->coupon_time}}"class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính năng mã</label>
                                     <select name="coupon_condition"  class="form-control input-sm m-bot15">
                                        
                                       @if($coupon->coupon_condition==1)
                                             <option selected value="{{$coupon->coupon_condition}}">Giảm theo phần trăm</option>@else
                                            <option value="1">Giảm theo phần trăm</option>
                                         @endif
                                        @if($coupon->coupon_condition==2)
                                              <option selected value="{{$coupon->coupon_condition}}">Giảm theo tiền</option>
                                          @else
                                            <option value="2">Giảm theo tiền</option>
                                         @endif

                                         
                                          
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                                     <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" value="{{$coupon->coupon_number}}">
                                </div>
                               
                               
                                <button type="submit" name="update_coupon" class="btn btn-info">Cập nhật mã</button>
                                </form>
                            </div>
                         

                        </div>
                    </section>

            </div>
@endsection