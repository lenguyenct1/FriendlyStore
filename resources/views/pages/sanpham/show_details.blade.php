@extends('layout')
@section('content')
<?php $price=0; ?>
<div class="product-details"><!--product-details-->
	<?php
                            $message = Session::get('message');
                            if($message){
                                echo '<div class="alert alert-danger">'.$message.'</div>';
                                Session::put('message',null);
                            }
                            ?>
	@foreach($product_details as $key => $value)
						<div class="col-sm-5">
							<div class="view-product">
								<span class='zoom' id='ex1'>
								<img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
								</span>
								<h3>ZOOM</h3>
							</div>
							

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>Mã ID: {{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
								 <?php 
                                             $product_promotion=($value->product_price*$value->promotion)/100;
                                            $price=$value->product_price- $product_promotion;
                                            ?>
								<form action="{{URL::to('/save-cart/'.$value->product_slug)}}" method="POST">
									{{ csrf_field() }}
									  @if($value->promotion!='0')
								<span>
									<span style="font-size: 15px  color: #b10e0e;">{{number_format($price).' VNĐ'}}</span>
									<span style="text-decoration: line-through;font-size: 18px;  color: #757575;">{{number_format($value->product_price).' VNĐ'}}</span>
									<span>
										<label style=" display: inline-block;
											    vertical-align: middle;
											    font-size: 12px;
											    color: #fff;
											    font-weight: 600;
											    border-radius: 3px;
											    background: #de2000;
											    width: 32px;
											    height: 20px;
											    line-height: 20px;
											    text-align: center;">-{{$value->promotion}}%</label>
									</span>	
								</span>
								@else
								<span>
								<span style="font-size: 25px">{{number_format($value->product_price).'VNĐ'}}</span></span>@endif
								<span>
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1"  value="1" />
									<input name="productid_hidden" type="hidden"  value="{{$value->product_id}}" />
								<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
										</span>
								</form>
								<br/>
								<p><b>Tình trạng hàng:</b> {{$value->product_condition_name}}</p>
								<p><b>Nhà cung cấp:</b> {{$value->producer_name}}</p>
								<p><b>Xuất xứ:</b> {{$value->product_origin_name}}</p>
								<p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
								<p><b>Loại sản phẩm:</b> {{$value->category_name}}</p>
								<p><b>Kho còn:</b> {{$value->product_number}}</p>
								<?php
								$type=DB::table('tbl_category')->where('id',$value->id)->limit(1)->get();
								 ?>
								 @foreach($type as $key => $ty)
								 <p><b>Danh mục:</b> {{$ty->name}}</p>
								@if($ty->type==0)
								<p><b>Hạn sử dụng:</b> {{$value->expiry_date}}</p>
								@elseif($ty->type==1)
								<p><b>Hạn bảo hành:</b> {{$value->expiry_date}}</p>
								@elseif($ty->type==2)
								<p><b>Hạn đổi sản phẩm:</b> {{$value->expiry_date}} kể từ ngày nhận hàng</p>@endif
								@endforeach
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>
							
								<li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_desc!!}</p>
								
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>{!!$value->product_content!!}</p>
								
						
							</div>
							
							<div class="tab-pane fade" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>ADMIN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>29 2 2020</a></li>
									</ul>
									<p>FRIENDLY_STORE.</p>
									<p><b>BÀI VIẾT</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Nhập tên của bạn"/>
											<input type="email" placeholder="Nhập email của bạn"/>
										</span>
										<textarea name="" ></textarea>
										<b>Đánh giá: </b> <img src="public/frontend/images/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Xác nhận
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
	@endforeach
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
							@foreach($relate as $key => $lienquan)
									<div class="col-sm-3">
										<div class="product-image-wrapper">
											<a href="{{URL::to('/details-product-home/'.$lienquan->product_slug)}}">
											 <div class="single-products">
		                                        <div class="productinfo text-center">
		                                            <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
		                                            <h2>{{number_format($lienquan->product_price).' '.'VNĐ'}}</h2>
		                                            <p>{{$lienquan->product_name}}</p>
		                                            <a href="{{URL::to('/details-product-home/'.$lienquan->product_slug)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Chọn mua</a>
		                                        </div>
		                                      
                                			</div>
										</div>
									</div>
							@endforeach		

								
								</div>
									
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@endsection
