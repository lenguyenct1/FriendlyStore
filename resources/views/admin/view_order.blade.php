@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin đăng nhập
    </div>
    
    <div class="table-responsive">
                      
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin vận chuyển hàng
    </div>
    
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        
          <tr>
           
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
             <td>{{$shipping->shipping_phone}}</td>
             <td>{{$shipping->shipping_email}}</td>
             <td>{{$shipping->shipping_notes}}</td>
             <td>@if($shipping->shipping_method==0) Chuyển khoản @else Tiền mặt @endif</td>
            
          
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br><br>

<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Stt</th>
            <th>Tên sản phẩm</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 0;
          $total = 0;
          @endphp
        @foreach($order_details as $key => $details)

          @php 
          $i++;
          $subtotal = $details->product_sales_price*$details->product_sales_quantity;
          $total+=$subtotal;
          @endphp
          <tr>
           
            <td>{{$i}}</td>
            <td>{{$details->product_name}}</td>
            <td>@if($details->product_coupon!='no')
                  {{$details->product_coupon}}
                @else 
                  Không mã
                @endif
            </td>
            <td>{{$details->product_sales_quantity}}</td>
            <td>{{number_format($details->product_sales_price ,0,',','.')}} VNĐ</td>
            <td>{{number_format($subtotal ,0,',','.')}} VNĐ</td>
          </tr>
        @endforeach
          <tr>
            <td colspan="2">  
               Tổng tiền: {{number_format($total,0,',','.')}} VNĐ </br>
            @php 
                $total_coupon = 0;
              @endphp

              @if($coupon_condition==1)
                  @php
                  $total_after_coupon = ($total*$coupon_number)/100;
                  echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').' VNĐ'.'</br>';
                  $total_coupon = $total - $total_after_coupon ;
                  @endphp
              @else 
                  @php
                  echo 'Tổng giảm: '.number_format($coupon_number,0,',','.').' VNĐ'.'</br>';
                  $total_coupon = $total - $coupon_number ;

                  @endphp
              @endif
              @if($total_coupon<=0)
              Miễn phí : Đơn hàng miễn phí
              @else
             Thanh toán: {{number_format($total_coupon,0,',','.')}} VNĐ @endif
            </td>
          </tr>
        </tbody>
      </table>
      <?php  $os=DB::table('tbl_order')
                  ->where('tbl_order.order_code',$details->order_code)
                  ->get();
                  ?>
                  @foreach($os as $key => $value2)
                  @if($value2->order_status==1)
       <form role="form" action="{{URL::to('/order-status-product/'.$details->order_code)}}" method="post">
                                    {{ csrf_field() }}
          <input type="hidden" name="order_status" value="2">
        <button type="submit" name="order_status_product" class="btn btn-info">Xác nhận xử lý đơn hàng</button>@endif
      </form>
       @if($value2->order_status==2)
       <form role="form" action="{{URL::to('/complete-the-order/'.$details->order_code)}}" method="post">
                                    {{ csrf_field() }}
          <input type="hidden" name="order_status" value="3">
        <button type="submit" name="order_status_product" class="btn btn-info">Xác nhận hoàn tất</button>@endif @endforeach
      </form>

      <a target="_blank" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
    </div>
   
  </div>
</div>
@endsection