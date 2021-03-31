@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê nhà cung cấp 
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
            
            <th>Tên nhà cung cấp</th>
            <th>Địa chỉ nhà cung cấp</th>
            <th>Điện thoại cung cấp</th>
            <th>Địa chỉ email nhà cung cấp</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_producer as $key => $cate_pro)
          <tr>
           
            <td>{{ $cate_pro->producer_name }}</td>
            <td>{{ $cate_pro->producer_address }}</td>
            <td>{{ $cate_pro->producer_phone }}</td>
            <td>{{ $cate_pro->producer_email}}</td>
     
            <td>
              <a href="{{URL::to('/edit-producer/'.$cate_pro->producer_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa nhà cung cấp này ko?')" href="{{URL::to('/delete-producer/'.$cate_pro->producer_id)}}" class="active styling-edit" ui-toggle-class="">
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