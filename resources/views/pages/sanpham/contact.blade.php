@extends('layout')
@section('content')
 <div id="contact-page" class="container">
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-10">    			   			
					<h3 style="color: #008848;"class="title text-center">Liên Hệ <strong>Chúng tôi</strong></h3>    			    				    		
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-5">
	    			<div class="contact-form">
	    				<h3 style="color: #008848;" class="title text-center">Giữ liên lạc</h3>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" method="post">
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Nhập Tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Nhập Địa chỉ Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Nhập Chủ đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Nhập Thông tin tại đây"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Xác Nhận">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-5">
	    			<div class="contact-info">
	    				<h3 style="color: #008848;" class="title text-center">Thông tin liên lạc</h3>
	    				<address>
	    					<p>Friendly-Store</p>
							<p>Bách Hóa Thân Thiện</p>
							<p>Điện thoại: +091234566</p>
							<p>Fax: 1-123-456-789</p>
							<p>Email:  friendly_store@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h3 style="color: #008848;" class="title text-center">Mạng xã hội</h3>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
    @endsection