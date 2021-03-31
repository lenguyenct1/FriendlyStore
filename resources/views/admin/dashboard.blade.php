@extends('admin_layout')
@section('admin_content')
<h3>Chào mừng bạn đến với Admin</h3>

	<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			@foreach($news as $key => $value3)
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2" style="height: 230px;">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye" ></i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Số lượng bài viết đã thêm vào</h4>
					<h3>{{$value3->value}} bài viết</h3>
					<p>thời điểm hiện tại</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			@endforeach
			@foreach($customer as $key => $value2)
			<div class="col-md-3 market-update-gd"  >
				<div class="market-update-block clr-block-1" style="height: 230px;">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Số lượng tài khoản người dùng</h4>
						<h3>{{$value2->value}} người dùng</h3>
						<p>thời điểm hiện tại</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			@endforeach
@foreach($stats1 as $key => $value1)
			<div class="col-md-3 market-update-gd"  >
				<div class="market-update-block clr-block-3" style="height: 230px;">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-usd"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tồng tiền thu được trong ngày</h4>
						<h3>{{number_format($value1->value).' '.'VNĐ'}}</h3>
						<p>thời điểm hiện tại</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			@endforeach
			@foreach($stats as $key => $value)
			<div class="col-md-3 market-update-gd" >
				<div class="market-update-block clr-block-4" style="height: 230px;">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Đơn đặt hàng trong ngày</h4>
						<h3>{{$value->value}} đơn hàng</h3>
						<p>thời điểm hiện tại</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		@endforeach
		<!-- //market-->
<br/>
		<div class="agil-info-calendar">
		<!-- calendar -->
		<div class="col-md-12 agile-calendar">
			<div class="calendar-widget">
                <div class="panel-heading ui-sortable-handle">
					<span class="panel-icon">
                      <i class="fa fa-calendar-o"></i>
                    </span>
                    <span class="panel-title">Lịch</span>
                </div>
				<!-- grids -->
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">
									
								</div>
								<div class="monthly" id="mycalendar"></div>
							</div>
							
							<div class="clearfix"> </div>
						</div>
					</div>
			</div>
		</div>
	
	
</section>


@endsection