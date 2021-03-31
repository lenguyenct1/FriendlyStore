@extends('admin_layout')
@section('admin_content')
<style>
  .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button1 {background-color: #4CAF50;} /* Green */
.button2 {background-color: #008CBA; width: 65%;} /* Blue */
.button3 {background-color: #f44336;} /* Red */
  </style>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Quản Lý hàng tồn
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
           
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Hình sản phẩm</th>
            <th width="200px">Tình trạng</th>
            <th width="150px">Nhập thêm sản phẩm</th>
          </tr>
        </thead>
        <tbody>
          @foreach($inventory as $key => $pro)
          <tr>
            
            <td>{{ $pro->product_name }}</td>
            <td style="color: black;"><b>{{ $pro->product_number }}</b></td>

            <td><img src="public/uploads/product/{{ $pro->product_image }}" height="100" width="100"></td>
            @if($pro->product_condition_id==1)
        <td><button class="button button1">{{ $pro->product_condition_name}}</button></td>@endif
                               @if($pro->product_condition_id==2)
        <td><button  class="button button2">{{ $pro->product_condition_name}}</button></td>@endif
                          @if($pro->product_condition_id==3)
        <td><button class="button button3">{{ $pro->product_condition_name}}</button></td>@endif

                        <td>
                          <form action="{{URL::to('/update-number/'.$pro->product_id)}}" method="POST">
                            {{ csrf_field() }}
                         <input style="width: 73px;text-align: center;" name="product_number" type="number" min="1"  value="1" />
                         <input type="hidden" name="qty" value="{{$pro->product_number}}" />
                        <button type="submit">Thêm</button>
                    </form>
                         </td>

           
        
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
   
  </div>
</div>
@endsection