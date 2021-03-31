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
                        <h2 class="title text-center">Sản phẩm mới nhất</h2>
                        @if(!$all_product->isEmpty())
                        @foreach($all_product as $key => $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                             <a href="{{URL::to('/details-product-home/'.$product->product_slug)}}">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img width="100px" src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
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
        @foreach($category as $key => $cate)
        <div class="features_items"><!--features_items-->
             
              <h2 class="title text-center"> {{$cate->category_name}}</a> </h2> 
              <?php   $all_product1 = DB::table('tbl_product')
              ->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')
              ->where([  ['tbl_category_product.category_id',$cate->category_id],
                         ['tbl_product.product_status', '=', '0'],])->limit(3)->get();            
               ?>
                    
                        @if(!$all_product1->isEmpty()) 
                        @foreach($all_product1 as $key => $product1)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                             <a href="{{URL::to('/details-product-home/'.$product1->product_slug)}}">
                                <div class="single-products">
                                    
                                        <div class="productinfo text-center">
                                            <img width="100px" src="{{URL::to('public/uploads/product/'.$product1->product_image)}}" alt="" />
                                             <?php 
                                             $product_promotion1=($product1->product_price*$product1->promotion)/100;
                                            $price1=$product1->product_price-$product_promotion1;
                                            ?>
                                           @if($product1->promotion!='0')
                                            <strong>{{number_format($price1).' '.'VNĐ'}}</strong>
                                            <span style="
                                                        display: inline-block;
                                                        vertical-align: middle;
                                                        font-size: 13px;
                                                        color: #757575;
                                                        text-decoration: line-through;
                                                        font-weight: 300;">{{number_format($product1->product_price).' '.'VNĐ'}}</span>
                                            <label>-{{$product1->promotion}}%</label>
                                            @else
                                            <strong>{{number_format($product1->product_price).' '.'VNĐ'}}</strong>@endif
                                            <p>{{$product1->product_name}}</p>
                                           <a href="{{URL::to('/details-product-home/'.$product1->product_slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chọn mua</a>
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
                             <div style="font-size: 30px; text-align: center;">Sản phẩm đã bán hết</div>
                             @endif           
                    </div><!--features_items-->
                                    <a href="{{URL::to('/show-category-home/'.$cate->slug_category_product)}}">
                                      <h3 style="text-align: center;">Xem Thêm</h3></a>
                                  </br>
                                
        <!--/recommended_items-->
         @endforeach
@endsection