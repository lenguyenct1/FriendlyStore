@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê xuất xứ 
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
            
            <th>Tên xuất xứ</th>    
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_origin as $key => $cate_pro)
          <tr>
           
            <td>{{ $cate_pro->product_origin_name}}</td>
            
    
           
            <td>
              <a href="{{URL::to('/edit-origin/'.$cate_pro->product_origin_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa xuất xứ này ko?')" href="{{URL::to('/delete-origin/'.$cate_pro->product_origin_id)}}" class="active styling-edit" ui-toggle-class="">
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