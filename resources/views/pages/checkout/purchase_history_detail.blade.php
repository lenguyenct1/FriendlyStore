@extends('layout')
@section('content')

	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Chi tiết đơn hàng</li>
				</ol>
			</div>
				
<?php $total=0;?>			
			<div class="table-responsive cart_info">

		
				
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
						
							@foreach($cus as $key =>$v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->product_image)}}" width="90" alt="" /></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->product_name}}</a></h4>
								<p>Web ID:{{$v_content->product_id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->product_sales_price).' '.'VNĐ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->product_sales_quantity}}"  readonly="">
									
								
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									
									<?php
									$subtotal = $v_content->product_sales_price * $v_content->product_sales_quantity;
									$total+=$subtotal;
									echo number_format($subtotal).' '.'VNĐ';
									?>
								</p>
							</td>
							
						</tr>
						@endforeach

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
							
				<?php
				$order_details_product=DB::table('tbl_order_details')->where('order_code', $v_content->order_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = DB::table('tbl_coupon')->where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.');
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}
		 if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
	                if( $total_coupon==0){
	                	$total_coupon=0;
	                }
				}else{
                  	$total_coupon = $total - $coupon_number;
                  	if($total_coupon<=0){
                  		$total_coupon=0;
                  	}
				}
				 ?>			
						<li>Tổng giảm:<span>{{$coupon_echo}} VNĐ</span></li>
						@if($total_coupon<=0)	
						<li>Thành tiền:<span>Đơn hàng miễn phí</span></li>
						@else
						<li>Thành tiền:<span>{{number_format($total_coupon,0,',','.')}} VNĐ</span></li>	@endif


							
							
							
					

					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->


@endsection