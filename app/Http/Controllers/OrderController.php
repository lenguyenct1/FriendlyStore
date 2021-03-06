<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use PDF;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class OrderController extends Controller
{
	 public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	public function print_order($checkout_code){
		 $this->AuthLogin();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($this->print_order_convert($checkout_code));
		return $pdf->stream();
	}
	public function print_order_convert($checkout_code){
		 $this->AuthLogin();
		 $i = 1;
		$order_details = OrderDetails::where('order_code',$checkout_code)->get();
		$order = Order::where('order_code',$checkout_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
			$ord=$ord->created_at;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $checkout_code)->get();

		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();

			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;

			if($coupon_condition==1){
				$coupon_echo = $coupon_number.'%';
			}elseif($coupon_condition==2){
				$coupon_echo = number_format($coupon_number,0,',','.');
			}
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;

			$coupon_echo = '0';
		
		}

		$output = '';

		$output.='<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border:1px solid #000;
		}
		.table-styling tbody tr td{
			border:1px solid #000;
		}
		</style>
		<h1><center>B??ch h??a th??n thi???n Friendly-Store</center></h1>
		<h4><center>H??a ????n thanh to??n</center></h4>
		<p>Ng?????i ?????t h??ng</p>
		<table class="table-styling">
				<thead>
					<tr>
						<th>T??n kh??ch h??ng</th>
						<th>S??? ??i???n tho???i</th>
						<th>Email</th>
						<th>Ng??y ?????t h??ng</th>
					</tr>
				</thead>
				<tbody>';
				
		$output.='		
					<tr>
						<td>'.$customer->customer_name.'</td>
						<td>'.$customer->customer_phone.'</td>
						<td>'.$customer->customer_email.'</td>
						<td>'.$ord.'</td>
						  
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>Ship h??ng t???i</p>
			<table class="table-styling">
				<thead>
					<tr>
						
						<th>T??n ng?????i nh???n</th>
						<th>?????a ch???</th>
						<th>S??t</th>
						<th>Email</th>
						<th>Ghi ch??</th>
					</tr>
				</thead>
				<tbody>';
			
		$output.='		
					<tr>
						
						<td>'.$shipping->shipping_name.'</td>
						<td>'.$shipping->shipping_address.'</td>
						<td>'.$shipping->shipping_phone.'</td>
						<td>'.$shipping->shipping_email.'</td>
						<td>'.$shipping->shipping_notes.'</td>
						
					</tr>';
				

		$output.='				
				</tbody>
			
		</table>

		<p>????n h??ng ?????t</p>
			<table class="table-styling">
				<thead>
					<tr>
						<th>Stt</th>
						<th>T??n s???n ph???m</th>
						<th>M?? gi???m gi??</th>
						<th>S??? l?????ng</th>
						<th>Gi?? s???n ph???m</th>
						<th>Th??nh ti???n</th>
					</tr>
				</thead>
				<tbody>';
			
				$total = 0;

				foreach($order_details_product as $key => $product){

					$subtotal = $product->product_sales_price*$product->product_sales_quantity;
					$total+=$subtotal;

					if($product->product_coupon!='no'){
						$product_coupon = $product->product_coupon;
					}else{
						$product_coupon = 'kh??ng m??';
					}		

		$output.='		
					<tr>
						<td>'.$i++.'</td>
						<td>'.$product->product_name.'</td>
						<td>'.$product_coupon.'</td>
						<td>'.$product->product_sales_quantity.'</td>
						<td>'.number_format($product->product_sales_price,0,',','.').' VN??'.'</td>
						<td>'.number_format($subtotal,0,',','.').' VN??'.'</td>
						
					</tr>';
				}

				if($coupon_condition==1){
					$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon;
	                if( $total_coupon==0){
	                	$total_coupon=0;
	                }
				}else{
                  	$total_coupon = $total - $coupon_number;
                  	if($total_coupon<=0){
                  		$total_coupon=0;
                  	}
				}

		$output.= '<tr>
				<td colspan="6">
					<p>T???ng ti???n: '.number_format($total,0,',','.').' VN??'.'</p>
					<p>T???ng gi???m: '.$coupon_echo.' VN??'.'</p>
					<p>Thanh to??n: '.number_format($total_coupon,0,',','.').' VN??'.'</p>
				</td>
		</tr>';
		$output.='				
				</tbody>
			
		</table>

		<center><br><p>C??m ??n qu?? kh??ch ???? mua h??ng t???i Friendly-Store</br></p></center>
		<p>-------------------------------------------------------------------------------------------------------------------------</p>
			<table>
				<thead>
					<tr>
						<th width="200px">Ng?????i l???p phi???u</th>
						<th width="800px">Ng?????i nh???n</th>
						
					</tr>
				</thead>
				<tbody>';
						
		$output.='				
				</tbody>
			
		</table>

		';


		return $output;

	}
	public function view_order($order_code){
		 $this->AuthLogin();
		$order_details = OrderDetails::where('order_code',$order_code)->get();
		$order = Order::where('order_code',$order_code)->get();
		foreach($order as $key => $ord){
			$customer_id = $ord->customer_id;
			$shipping_id = $ord->shipping_id;
		}
		$customer = Customer::where('customer_id',$customer_id)->first();
		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

		$order_details_product = OrderDetails::with('product')->where('order_code', $order_code)->get();
// echo '<pre>';
// print_r($order);
// echo '</pre>';
		foreach($order_details_product as $key => $order_d){

			$product_coupon = $order_d->product_coupon;
		}
		if($product_coupon != 'no'){
			$coupon = Coupon::where('coupon_code',$product_coupon)->first();
			$coupon_condition = $coupon->coupon_condition;
			$coupon_number = $coupon->coupon_number;
		}else{
			$coupon_condition = 2;
			$coupon_number = 0;
		}
		
		return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number'));

	}
    public function manage_order(){
    	 $this->AuthLogin();
    	$order = Order::orderby('created_at','DESC')->get();
    	return view('admin.manage_order')->with(compact('order'));
    }
     public function order_status_product(Request $request,$order_code){
     	 $this->AuthLogin();
    	 $data = array();
        $data['order_status'] = $request->order_status;
         DB::table('tbl_order')->where('order_code',$order_code)->update($data);
        Session::put('message','???? x??c nh???n x??? l?? ????n h??ng th??nh c??ng');
        return Redirect::to('manage-order');
    }
      public function complete_the_order(Request $request,$order_code){
     	 $this->AuthLogin();
    	 $data = array();
        $data['order_status'] = $request->order_status;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data['updated_at'] = now();
        DB::table('tbl_order')->where('order_code',$order_code)->update($data);
        Session::put('message','???? x??c nh???n ????n h??ng th??nh c??ng');
        date_default_timezone_set('Asia/Ho_Chi_Minh');  
        return Redirect::to('manage-order');
    }
}
