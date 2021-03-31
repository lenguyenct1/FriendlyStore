@extends('layout')
@section('content')
<style type="text/css">
    
label{
  display: inline-block;
    vertical-align: middle;
    font-size: 12px;
    color: #fff;
    font-weight: 600;
    border-radius: 3px;
    background: #de2000;
    width: 32px;
    height: 20px;
    line-height: 20px;
    text-align: center;
}
strong {
    display: inline-block;
    vertical-align: middle;
    font-size: 20px;
    color: #b10e0e;
    font-weight: bold;
    font-weight: normal;
}
</style>

<div class="features_items"><!--features_items-->
                        
                       

                          @foreach($co as $key => $or)
                        <h2 class="title text-center">Đơn hàng của {{$or->customer_name}}</h2>
                          @endforeach
                      
                    <?php 
                       $pt=DB::table('tbl_order')
                             ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
                             ->join('tbl_order_status','tbl_order.order_status','=','tbl_order_status.order_status_id')
                             ->where('tbl_customers.customer_id',$or->customer_id)
                             ->orderby('tbl_order.created_at','desc')
                             ->paginate(6);
                    ?>
                       @if(!$pt->isEmpty()) 
                      @foreach($pt as $key => $product)
                        <a href="{{URL::to('/purchase-history-detail/'.$product->order_code)}}">
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">

                                <div class="single-products" style="height: 500px;">
                                        <div class="productinfo text-center">
                                            <img src="{{('public/frontend/images/order.jpg')}}"  alt="" />
                                          
                                           
                                            
                                            <strong>Mã đơn hàng : {{$product->order_code}}</strong>
                                            <p>Ngày đặt hàng :{{$product->created_at}}</p>
                                            <p>Trạng thái :{{$product->status_name}}</p>
                                            @if($product->order_status ==3)
                                            <p>Thời gian xác nhận:{{$product->updated_at}}</p>
                                          @endif
                                          <a href="{{URL::to('/purchase-history-detail/'.$product->order_code)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết đơn hàng</a>
                                          @if($product->order_status==1)
                                                        <form method="POST">
                                                          @csrf
                             
                                 
                              
                               <input type="hidden" name="order_code" class="order_code" value="{{$product->order_code}}">
                              
                              
                              <input type="button" value="Hủy đơn hàng" name="cancel_order" class="btn btn-primary btn-sm cancel_order">
                                                           </form>
                                                           @endif
                                        </div>
                                      
                                </div>
                                 <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                      </a>
                       @endforeach
                @else
                  <div style="font-size: 30px; text-align: center;">Bạn chưa đặt hàng</div>
                @endif
                    </div><!--features_items-->
        <!--/recommended_items-->

          {!!$pt->links()!!}
@endsection