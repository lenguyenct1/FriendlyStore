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
<?php $price=0; ?>
<div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Kết quả tìm kiếm</h2>
                           @if(!$search_product->isEmpty()) 
                       @foreach($search_product as $key => $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                             <a href="{{URL::to('/details-product-home/'.$product->product_slug)}}">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                                             <?php 
                                             $product_promotion=($product->product_price*$product->promotion)/100;
                                            $price=$product->product_price- $product_promotion;
                                            ?>
                                          @if($product->promotion!='0')
                                            <strong>{{number_format($price).' '.'VNĐ'}}</strong>
                                            <span 
                                             style="
                                                    display: inline-block;
                                                    vertical-align: middle;
                                                    font-size: 13px;
                                                    color: #757575;
                                                    text-decoration: line-through;
                                                    font-weight: 300;"
                                            >{{number_format($product->product_price).' '.'VNĐ'}}</span>
                                            <label>-{{$product->promotion}}%</label>
                                            @else
                                            <strong>{{number_format($product->product_price).' '.'VNĐ'}}</strong>@endif
                                            <p>{{$product->product_name}}</p>
                                            <a href="{{URL::to('/details-product-home/'.$product->product_slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chọn mua</a>
                                        </div>
                                      
                                </div>
                            </a>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                         @else
                             <div style="font-size: 30px; text-align: center;">Không có sản phẩm</div>
                             @endif   
                    </div><!--features_items--> 
        <!--/recommended_items-->
@endsection