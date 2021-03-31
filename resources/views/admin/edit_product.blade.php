@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật sản phẩm
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">

                            <div class="position-center">
                                @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                </div>
                                 
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" value="{{$pro->product_price}}" name="product_price" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="text" value="{{$pro->product_number}}" name="product_number" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thời hạn (hạn sử dụng, bảo hành, đổi sản phẩm)</label>
                                    <input type="text"   name="expiry_date" class="form-control" id="exampleInputEmail1" placeholder="Thời hạn" value="{{$pro->expiry_date}}" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Khuyến mãi theo phần trăm</label>
                                    <input type="text"   name="promotion" class="form-control" id="exampleInputEmail1"  value="{{$pro->promotion}}" placeholder="Khuyến mãi" >
                                </div>
                               
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_desc" id="ckeditor10">{{$pro->product_desc}}</textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="ckeditor11" >{{$pro->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="producer_id" class="form-control input-sm m-bot15">
                                        @foreach($producer as $key => $po)
                                            @if($po->producer_id==$pro->producer_id)
                                            <option selected value="{{$po->producer_id}}">{{$po->producer_name}}</option>
                                            @else
                                            <option value="{{$po->producer_id}}">{{$po->producer_name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nguồn gốc</label>
                                      <select name="product_origin_id" class="form-control input-sm m-bot15">
                                       @foreach($product_origin as $key => $p)
                                            @if($p->product_origin_id==$pro->product_origin_id)
                                            <option selected value="{{$p->product_origin_id}}">{{$p->product_origin_name}}</option>
                                            @else
                                            <option value="{{$p->product_origin_id}}">{{$p->product_origin_name}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <?php 
                               $cate_product1= DB::table('tbl_category_product')->where('category_id',$pro->category_id)->get(); 
                               foreach ($cate_product1 as $key => $value3) {
                              $cate_product2= $value3->category_id;
                              $c=$value3->id;
                               }
                              
                                $id=DB::table('tbl_category_product')
                                ->join('tbl_category','tbl_category_product.id','=','tbl_category_product.id')
                                ->join('tbl_product','tbl_product.category_id','=','tbl_category_product.category_id')
                                ->where([['tbl_product.category_id',$cate_product2],['tbl_category.id',$c]])->limit(1)->get();
                            
                                ?>
                                @foreach($id as $key =>$value)
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                      <select name="cate_id" id="cate_id" class="form-control input-sm m-bot15 choose cate_id">
                                       @foreach($category as $key => $ci)
                                        @if($ci->id==$value->id)
                                            <option selected value="{{$ci->id}}">{{$ci->name}}</option> 
                                            @else
                                            <option value="{{$ci->id}}">{{$ci->name}}</option> @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại sản phẩm</label>
                                      <select name="product_cate" id="product_cate" class="form-control input-sm m-bot15 product_cate choose">
                                           @foreach($cate_product as $key => $cate)
                                             @if($cate->category_id==$pro->category_id)
                                            <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option> 
                                             
                                           @endif
                                            
                                        @endforeach
                                           
                                    </select>
                                </div>
                                @endforeach
                                
                                
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                             @if($brand->brand_id==$pro->brand_id)
                                            <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                             @else
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                             @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            @if($pro->product_status==0)
                                             <option selected value="{{$pro->product_status}}">Hiển thị</option>@else
                                          <option value="0">Hiển thị</option>
                                         @endif
                                        @if($pro->product_status==1)
                                              <option selected value="{{$pro->product_status}}">Ẩn</option>
                                          @else
                                             <option value="1">Ân</option>
                                         @endif
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                                </form>
                                @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection