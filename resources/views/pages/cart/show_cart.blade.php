@extends('layout')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng của bạn</li>
				</ol>
			</div>
				<?php
                            $message = Session::get('message');
                            $error = Session::get('error');
                            if($message){
                                echo '<div class="alert alert-success">'.$message.'</div>';
                                Session::put('message',null);
                            }
                            elseif($error){
                            	echo '<div  class="alert alert-danger">'.$error.'</div>';
                                Session::put('error',null);
                            }
                            ?>
			
			<div class="table-responsive cart_info">

				<?php
				$content = Cart::content();
				$total=0;
			
				?>
				
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sp</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						   @if(!$content->isEmpty()) 
						@if(Session::get('cart')==true)
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="90" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID:{{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}"  >
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									<input type="hidden" value="{{$v_content->id}}" name="Id_cart" class="form-control">
									<input type="submit" value="Cập nhật" name="update_qty" class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
									<?php
									$subtotal = $v_content->price * $v_content->qty;
									$total+=$subtotal;
									echo number_format($subtotal).' '.'VNĐ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							
							<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
							<td>
								@if(Session::get('coupon'))
	                          	<a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
								@endif
							</td>

						
						</tr>
										
					<tr>
						<td>

							<form method="POST" action="{{url('/check-coupon')}}">
								@csrf
									<input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
	                          		<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
	                          	
                          		</form>
                          	</td>
					</tr>
				@else 
						<tr>
							<td colspan="5"><center>
							@php 
							echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
							@endphp
							</center></td>
						</tr>
				@endif
					@else 
						<tr>
							<td colspan="5"><center>
							@php 
							echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
							@endphp
							</center></td>
						</tr>
				@endif

					</tbody>

				</table>
				

			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
		
			<div class="row">
			
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{number_format($total,0,',','.')}} VNĐ</span></li>
							
							@if(Session::get('coupon'))
							
							
									@foreach(Session::get('coupon') as $key => $cou)
										@if($cou['coupon_condition']==1)
											<li>Mã giảm : <span>{{$cou['coupon_number']}} %</span></li>
											
												@php 
												$total_coupon = ($total*$cou['coupon_number'])/100;
												@endphp
											<li>Tổng giảm:<span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></li>
											@if($total-$total_coupon==0)
												<li>Miễn phí:<span>Đơn hàng miễn phí</span></li>
											@else
											<li>Thành tiền:<span>{{number_format($total-$total_coupon,0,',','.')}} VNĐ</span></li>@endif
										@elseif($cou['coupon_condition']==2)
											<li>Mã giảm:<span>{{number_format($cou['coupon_number'],0,',','.')}} VNĐ</span></li>
										
												@php 
												$total_coupon = $total - $cou['coupon_number'];
								
												@endphp
											@if($total_coupon<=0)
											<li>Miễn phí:<span>Đơn hàng miễn phí</span></li>
											@else
											<li>Thành tiền:<span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></li>@endif
										@endif
									@endforeach
								


							
							@endif 
							
					@if(!$error &&!$content->isEmpty())
						</ul>
						{{-- 	<a class="btn btn-default update" href="">Update</a> --}}
							  <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 ?>
                                  
                                <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
                                <?php
                            }else{
                                 ?>
                                 
                                 <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
                                 <?php 
                             }
                                 ?>
                      @endif          
						

					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->


@endsection