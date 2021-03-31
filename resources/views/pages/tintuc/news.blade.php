@extends('layout')
@section('content')
<div class="blog-post-area">
						<h2 class="title text-center">Mẹo hay mới</h2>
						@if(!$all_news->isEmpty()) 
						@foreach($all_news as $key => $news)
						<div class="single-blog-post">
							<h3>{{$news->news_name}}</h3>
							<div class="post-meta">
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="#">
								   <img width="100px" src="{{URL::to('public/uploads/news/'.$news->news_image)}}" alt="" />
							</a>
							<p>{!!$news->news_desc!!}</p>
							<a  class="btn btn-primary" href="{{URL::to('/show-details-news/'.$news->news_slug)}}">Xem thêm</a>
						</div>
							@endforeach	
							 @else
                             <div style="font-size: 30px; text-align: center;">Chưa có mẹo hay mới</div>
                             @endif  					
						<div class="pagination-area">
							<ul class="pagination">
								 {!!$all_news->links()!!}
								
							</ul>
						</div>
								
					</div>
			
	
@endsection