<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | Friendly-Store</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <style>
       
        /* these styles are for the demo, but are not required for the plugin */
        .zoom {
            display:inline-block;
            position: relative;
        }
        
        /* magnifying glass icon */
        .zoom:after {
            content:'';
            display:block; 
            width:33px; 
            height:33px; 
            position:absolute; 
            top:0;
            right:0;
            background:url(icon.png);
        }

        .zoom img {
            display: block;
        }

        .zoom img::selection { background-color: transparent; }

        #ex2 img:hover { cursor: url(grab.cur), default; }
        #ex2 img:active { cursor: url(grabbed.cur), default; }
    </style>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{('public/frontend/images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <base href="{{asset('')}}">
</head><!--/head-->

<body>

    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +0901234566</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> friendly_store@gmai.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href=""><img width="100%" height="100%" src="{{('public/frontend/images/logo.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            
                            
                            
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                               
                             <li><a href="{{URL::to('/purchase-history')}}"><i class="fa fa-star"></i>L???ch s??? mua h??ng</a></li>
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   $shipping_id = Session::get('shipping_id');
                                   if($customer_id!=NULL && $shipping_id==NULL){ 
                                 ?>
                                  <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                
                                <?php
                                 }elseif($customer_id!=NULL && $shipping_id!=NULL){
                                 ?>
                                 <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                 <?php 
                                }else{
                                ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh to??n</a></li>
                                <?php
                                 }
                                ?>
                                

                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Gi??? h??ng</a></li>
                                <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                    $customer_name=DB::table('tbl_customers')->where('customer_id',$customer_id)->limit(1)->get();
                                    foreach ($customer_name as $key => $value) {
                                        $name=$value->customer_name;
                                    }

                                 ?>
                                  <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> ????ng xu???t</a></li>
                                  <br/>
                                  <br/>
                                  <li style="float:right; color: red; font-size: 18px;"><b>Ch??o {{$name}} ???? ????ng nh???p th??nh c??ng</b><li>
                                
                                <?php
                            }else{
                                 ?>
                                 <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> ????ng nh???p</a></li>
                                 <?php 
                             }
                                 ?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left" style="width: 800px;">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/home')}}" class="active">Trang ch???</a></li>
                                <li ><a href="{{URL::to('/product')}}">S???n ph???m</a></li> 
                                <li><a href="{{URL::to('/show-promotion')}}">H??ng gi???m gi??</a></li>               
                                <li><a href="{{URL::to('/show-cart')}}">Gi??? h??ng</a></li>
                                <li><a href="{{URL::to('/show-news')}}">M???o hay m???i</a></li> 
                                <li><a href="{{URL::to('/contact')}}">Li??n h???</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action="{{URL::to('/search')}}" method="POST">
                            {{csrf_field()}}
                        <div class="search_box pull-right">
                            <input type="text" name="keywords_submit" placeholder="T??m ki???m s???n ph???m"/>
                            <input type="submit" style="margin-top:0;color:yellow;font-size:100%" name="search_items" class="btn btn-primary btn-sm" value="T??m ki???m">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <?php
                            $i=0;
                            $slider=DB::table('tbl_slider')->where('slider_status','0')->orderby('slider_id','desc')->take(4)->get();
                            ?>
                            @foreach($slider as $key =>$slide)
                            @php
                            $i++;
                            @endphp
                            <div class="item {{ $i==1 ? 'active' :''}}">
                                <div class="col-sm-4">
                                    <h1><span>Friendly</span>-Store</h1>
                                    <h2>{{$slide->slider_name}}</h2>
                                    <p>{{$slide->slider_desc}}</p>
                                     <a href="{{URL::to('/product')}}">
                                    <button type="button" class="btn btn-default get">H??y mua ngay</button></a>

                                </div>
                                <div class="col-sm-8">
                                       <img  src="{{URL::to('public/uploads/slider/'.$slide->slider_image)}}"  class="girl img-responsive" style="height:fit-content " alt="">
                                </div>
                                   
                                   
                                </div>
                                 @endforeach
                            </div>
                           
                          
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                       
                        <h2>Danh m???c s???n ph???m</h2>
                        @if($category_menu!='')
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                             <?php echo $category_menu; ?>
                        </div><!--/category-products-->
                             @else
                              <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">Kh??ng c?? danh m???c s???n ph???m</h4>
                                </div>
                            </div>
                            @endif
                        <div class="brands_products"><!--brands_products-->
                            <h2>Th????ng hi???u s???n ph???m</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @if(!$brand->isEmpty())
                                    @foreach($brand as $key => $brand)
                                    <li><a href="{{URL::to('/show-brand-home/'.$brand->brand_slug)}}"> <span class="pull-right"></span>{{$brand->brand_name}}</a></li>
                                    @endforeach
                                    @else
                                    <li style="text-align: center;">Kh??ng c?? th????ng hi???u s???n ph???m</li>
                                    @endif
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        <br/>
                  
                       <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/gif1.gif')}}" alt="" />
                                </div>
                            </div>
                             <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="300px" src="{{('public/frontend/images/gif2.gif')}}" alt="" />
                                </div>
                           
                       
                        </div><!--/category-products--> 
                    </div>
                       <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/giaohang.jpg')}}" alt="" />
                                </div>
                                 <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/giaohang1.gif')}}" alt="" />
                                </div>
                            </div>
                             
                       
                        </div><!--/category-products--> 
                        <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc7.jpg')}}" alt="" />
                                </div>
                                 <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc6.gif')}}" alt="" />
                                </div>
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc8.jpg')}}" alt="" />
                                </div>
                            </div>
                             
                       
                        </div><!--/category-products--> 
                        <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc1.jpg')}}" alt="" />
                                </div>
                                 <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc2.jpg')}}" alt="" />
                                </div>
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc.gif')}}" alt="" />
                                </div>
                            </div>
                             
                       
                        </div><!--/category-products--> 
                         <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc9.jpg')}}" alt="" />
                                </div>
                                 <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc10.jpg')}}" alt="" />
                                </div>
                               
                                
                            </div>

                             
                       
                        </div><!--/category-products--> 
                          <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc11.jpg')}}" alt="" />
                                </div>
                                 <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc12.jpg')}}" alt="" />
                                </div>
                               
                                
                            </div>
                            
                             
                       
                        </div><!--/category-products--> 
                         <div class="panel-group category-products" ><!--category-productsr-->
                         
                           
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc3.jpg')}}" alt="" />
                                </div>
                                 <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc4.jpg')}}" alt="" />
                                </div>
                                <div class="panel-heading">
                                    <img width="200px" height="200px" src="{{('public/frontend/images/qc5.jpg')}}" alt="" />
                                </div>
                                
                            </div>
                             
                       
                        </div><!--/category-products--> 
                    
                    </div>

                </div>
                
                <div class="col-sm-9 padding-right">

                   @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>Friendly</span>-Store</h2>
                            <p>H??n h???nh ph???c v??? qu?? kh??ch</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{('public/frontend/images/mi.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>M?? ??n li???n</p>
                                <h2>29 2 2020</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                         <img src="{{('public/frontend/images/chao.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Ch??o ??n li???n</p>
                                <h2>29 2 2020</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                         <img src="{{('public/frontend/images/pho.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Ph??? ??n li???n</p>
                                <h2>29 2 2020</h2>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                         <img src="{{('public/frontend/images/sua.jpg')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>S???a</p>
                                <h2>29 2 2020</h2>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>D???CH V???</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Tr??? gi??p tr???c tuy???n</a></li>
                                <li><a href="#">Li??n h??? ch??ng t??i</a></li>
                                <li><a href="#">T??nh tr???ng ?????t h??ng</a></li>
                                <li><a href="#">Thay ?????i ?????a ??i???m</a></li>
                                <li><a href="#">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>MUA H??NG NHANH</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">M??</a></li>
                                <li><a href="#">Ch??o</a></li>
                                <li><a href="#">Ph???</a></li>
                                <li><a href="#">Th??? qu?? t???ng</a></li>
                                <li><a href="#">S???a</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>CH??NH S??CH</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">??i???u kho???n s??? d???ng</a></li>
                                <li><a href="#">Ch??nh s??ch ?????c quy???n</a></li>
                                <li><a href="#">Ch??nh s??ch ho??n ti???n</a></li>
                                <li><a href="#">H??? th???ng thanh to??n</a></li>
                                <li><a href="#">Ch??nh s??ch ?????i tr???</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>GI???I THI???U V??? C???A H??NG</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Th??ng tin c??ng ty</a></li>
                                <li><a href="#">Tuy???n d???ng</a></li>
                                <li><a href="#">V??? tr?? c???a h??ng</a></li>
                                <li><a href="#">B???n quy???n</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Th??ng tin c???a h??ng</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Nh???p ?????a ch??? email c???a b???n" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                              
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Friendy-Store</p>
                    <p class="pull-right">C???a h??ng th??n thi???n</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/zoom-master/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('public/frontend/zoom-master/jquery.zoom.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#ex1').zoom();
            $('#ex2').zoom({ on:'grab' });
            $('#ex3').zoom({ on:'click' });          
            $('#ex4').zoom({ on:'toggle' });
        });
    </script>
     <script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "X??c nh???n ????n h??ng",
                  text: "????n h??ng s??? kh??ng ???????c ho??n tr??? khi ?????t,b???n c?? mu???n ?????t kh??ng?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "C???m ??n, Mua h??ng",

                    cancelButtonText: "????ng,ch??a mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_notes = $('.shipping_notes').val();
                        var shipping_method = $('.payment_select').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_notes:shipping_notes,_token:_token,order_coupon:order_coupon,shipping_method:shipping_method},
                            success:function(){
                               swal("????n h??ng", "????n h??ng c???a b???n ???? ???????c g???i th??nh c??ng", "success");
                              
                                window.location.href = "{{url('/order-place')}}";
                                  
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);

                      } else {
                        swal("????ng", "????n h??ng ch??a ???????c g???i, l??m ??n ho??n t???t ????n h??ng", "error");

                      }
              
                });

               
            });
        });
    

    </script>
    <script type="text/javascript">

          $(document).ready(function(){
            $('.cancel_order').click(function(){
                swal({
                  title: "X??c nh???n h???y ????n h??ng",
                  text: "B???n s??? m???t m?? gi???m gi?? khi h???y ????n h??ng?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "H???y ????n h??ng",

                    cancelButtonText: "????ng,ch??a h???y",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                    if (isConfirm) {
                        
                        var order_code = $('.order_code').val();
                        var _token = $('input[name="_token"]').val();

                   
                               $.ajax({
                            url: '{{url('/cancel-order')}}',
                            method: 'POST',
                            data:{_token:_token,order_code:order_code},
                            success:function(){
                               swal("????n h??ng", "????n h??ng c???a b???n ???? ???????c g???i th??nh c??ng", "success");
                              
                               
                                  
                            }
                        });

                        window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);

                       

                      } else {
                        swal("????ng", "????n h??ng ch??a ???????c h???y", "error");

                      }
              
                });

               
            });
        });
    

    </script>
</body>
</html>