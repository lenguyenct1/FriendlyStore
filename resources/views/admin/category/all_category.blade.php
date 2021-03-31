@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm 
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light" id="dataTables-example">
        <thead>
          <tr>
            
            <th>Tên danh mục sản phẩm</th>
            <th>Slug</th>
            <th>Phân loại</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_category as $key => $cate_pro)
          <tr>
           
            <td>{{ $cate_pro->name }}</td>
            <td>{{ $cate_pro->slug }}</td>
            <td>{{ $cate_pro->type_name }}</td>
            <td><span class="text-ellipsis">
              <?php
               if($cate_pro->status==0){
                ?>
                <a href="{{URL::to('/unactive-category/'.$cate_pro->id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                <?php
                 }else{
                ?>  
                 <a href="{{URL::to('/active-category/'.$cate_pro->id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                <?php
               }
              ?>
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-category/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục sản phẩm này ko?')" href="{{URL::to('/delete-category/'.$cate_pro->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection