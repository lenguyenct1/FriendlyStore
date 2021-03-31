@extends('layout')
@section('content')
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
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tài khoản</h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{csrf_field()}}
							<input type="email" name="email_account" required="" placeholder="Tài khoản" />
							<input type="password" name="password_account" required="" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
							{{ csrf_field() }}
							<input type="text" name="customer_name" required="" placeholder="Họ và tên"/>
							<input type="email" name="customer_email" required="" placeholder="Địa chỉ email"/>
							<input type="password" name="customer_password" required="" placeholder="Mật khẩu"/>
							<input type="text" name="customer_phone" required="" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

@endsection