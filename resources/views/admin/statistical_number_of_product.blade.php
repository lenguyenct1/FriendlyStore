@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thống kê số lượng hàng đã bán
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
           <?php  
                  $total=0;

             ?>  
      <table class="table table-striped b-t b-light" id="dataTables-example">
        
        <thead>
          <tr>
            
            <th>Tên sản phẩm</th>
            <th>Tổng lượng sản phẩm đã bán</th>
            <th>Tổng tiền thu được</th>

            
         
          </tr>
        </thead>
        <tbody>
         @foreach($order_details as $key => $order_d)
          <tr>  
            <td>{{ $order_d->product_name }}</td>
            <?php  
            $number = DB::table('tbl_order_details')
                     ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
                     ->where('tbl_order.order_status','<>','4')
                     ->select(DB::raw('sum(product_sales_quantity) as quantity, product_name,sum(product_sales_price*product_sales_quantity) as total'))
                     ->where('product_name',$order_d->product_name)
                     ->groupBy('product_name')
                     ->get();

             ?>
             @foreach($number as $key => $order)
            <td>{{ $order->quantity }}</td>
             <?php  
                  $total=$total+$order->total;

             ?>  
            <td>{{number_format($order->total).' '.'VNĐ'}}  </td>     
           
          @endforeach
            @endforeach
        </tbody>
       
      </table>
      
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-4 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Tổng Tiền: </small>
          
          <small>{{number_format($total).' '.'VNĐ'}} </small>
        
        </div>
         <?php  
            $number1 = DB::table('tbl_order_details')
                     ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
                     ->where('tbl_order.order_status','<>','4')
                     ->select(DB::raw('sum(product_sales_quantity) as quantity, product_name'))
                     ->groupBy('product_name')
                     ->orderby('quantity','desc')
                     ->limit(1)->get();

             ?>
   <div class="col-sm-8 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Sản phẩm bán chạy nhất: </small>
            @foreach($number1 as $key => $order1)
          <small>{{$order1->product_name}} </small>
          @endforeach
        
        </div>
      </div>
     
      
    </footer>
  </div>
</div>
@endsection