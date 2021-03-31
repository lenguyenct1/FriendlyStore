@extends('layout')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>
	@if(Session::get('customer_id'))
 <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                    $customer_name=DB::table('tbl_customers')->where('customer_id',$customer_id)->limit(1)->get();
                                    foreach ($customer_name as $key => $value) {
                                        $name=$value->customer_name;
                                        $email=$value->customer_email;
                                        $phone=$value->customer_phone;
                                    }
}

                                 ?> @endif

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin gửi hàng</p>
							<div class="form-one">
								<form method="POST">
									@csrf
									<input type="text" name="shipping_email" class="shipping_email" value="{{$email}}" placeholder="Điền email">
									<input type="text" name="shipping_name" class="shipping_name" value="{{$name}}" placeholder="Họ và tên người gửi">
									<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ gửi hàng">
									<input type="text" name="shipping_phone" class="shipping_phone" value="{{$phone}}" placeholder="Số điện thoại">
									<textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>
									
									

									@if(Session::get('coupon'))
										@foreach(Session::get('coupon') as $key => $cou)
											<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else 
										<input type="hidden" name="order_coupon" class="order_coupon" value="no">
									@endif
									
									
									
									<div class="">
										 <div class="form-group">
		                                    <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
		                                      <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
		                                            <option value="0">Qua chuyển khoản</option>
		                                            <option value="1">Tiền mặt</option>   
		                                    </select>
		                                </div>
									</div>
									<input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
							

							</div>
							
						</div>
					</div>
					<div class="col-sm-12 clearfix">
						  @if(session()->has('message'))
			                    <div class="alert alert-success">
			                        {{ session()->get('message') }}
			                    </div>
			                @elseif(session()->has('error'))
			                     <div class="alert alert-danger">
			                        {{ session()->get('error') }}
			                    </div>
			                @endif
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
						@if(Session::get('cart')==true)
						@foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}" width="90" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: {{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
									{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}"  readonly="">
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
									<?php
									$subtotal = $v_content->price * $v_content->qty;
									$total+=$subtotal;
									echo number_format($subtotal).' '.'vnđ';
									?>
								</p>
							</td>
							
						</tr>
						@endforeach
					
										
				
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
							
							
						</ul>
						{{-- 	<a class="btn btn-default update" href="">Update</a> --}}
							 
                                
							

					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
					</div>
									
				</div>
			</div>
		

			
			
		</div>
	</section> <!--/#cart_items-->

@endsection