@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min10"  data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" >
                                </div>
                               
                                     <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số tiền" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn nhập số lượng" name="product_number" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm" >
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Thời hạn (hạn sử dụng, bảo hành, đổi sản phẩm)</label>
                                    <input type="text"   name="expiry_date" class="form-control" id="exampleInputEmail1" placeholder="Thời hạn" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Khuyến mãi theo phần trăm</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn nhập phần trăm khuyến mãi" name="promotion" class="form-control" id="exampleInputEmail1" placeholder="Khuyến mãi" >
                                </div>
                                
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control"
                               name="product_desc" id="ckeditor" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="product_content" id="ckeditor1" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                               
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="producer_id" class="form-control input-sm m-bot15">
                                        @foreach($producer as $key => $po)
                                            <option value="{{$po->producer_id}}">{{$po->producer_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nguồn gốc</label>
                                      <select name="product_origin_id" class="form-control input-sm m-bot15">
                                        @foreach($product_origin as $key => $p)
                                            <option value="{{$p->product_origin_id}}">{{$p->product_origin_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                              
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục</label>
                                      <select name="cate_id" id="cate_id" class="form-control input-sm m-bot15 choose cate_id">
                                    
                                            <option value="">--Chọn loại danh mục--</option>
                                        @foreach($cate_product as $key => $ci)
                                            <option value="{{$ci->id}}">{{$ci->name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại sản phẩm</label>
                                      <select name="product_cate" id="product_cate" class="form-control input-sm m-bot15 product_cate choose">
                                            <option value="">--Chọn loại sản phẩm--</option>
                                           
                                    </select>
                                </div>
                                
                              
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Thương hiệu</label>
                                      <select name="product_brand" class="form-control input-sm m-bot15">
                                        @foreach($brand_product as $key => $brand)
                                            <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Hiển thị</option>
                                            <option value="1">Ẩn</option>
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection