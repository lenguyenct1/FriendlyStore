@extends('layout')
@section('content')
			
					<div class="blog-post-area">
						<h2 class="title text-center">Mẹo hay mới</h2>
						<div class="single-blog-post">
							@foreach($news_by_id as $key => $nbi)
							<h3>{{$nbi->news_name}}</h3>						
							<a href="">
								  <img width="100px" src="{{URL::to('public/uploads/news/'.$nbi->news_image)}}" alt="" />
							</a>
							<p>
								{!!$nbi->news_content!!}
							</p>
							
						</div>
						@endforeach
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Đánh giá:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 bình chọn)</li>
						</ul>
						
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="public/frontend/images/socials.png" alt=""></a>
					</div><!--/socials-share-->

					
					
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-4">
								<h2>Mời bạn phản hồi</h2>
								<form>
									<div class="blank-arrow">
										<label>Tên của bạn</label>
									</div>
									<span>*</span>
									<input type="text" placeholder="Nhập tên bạn...">
									<div class="blank-arrow">
										<label>Địa chỉ email</label>
									</div>
									<span>*</span>
									<input type="email" placeholder="Nhập địa chỉ email của bạn...">
									<div class="blank-arrow">
										<label>Trang Web</label>
									</div>
									<input type="email" placeholder="Nhập địa chỉ trang web...">
								</form>
							</div>
							<div class="col-sm-8">
								<div class="text-area">
									<div class="blank-arrow">
										<label>Bình luận của bạn</label>
									</div>
									<span>*</span>
									<textarea name="message" rows="11"></textarea>
									<a class="btn btn-primary" href="">Đăng bình luận</a>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->			
@endsection