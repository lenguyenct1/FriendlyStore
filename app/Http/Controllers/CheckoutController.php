<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
class CheckoutController extends Controller
{   
 
 public function confirm_order(Request $request){
         $data = $request->all();
if($data!=''){
         $shipping = new Shipping();
         $shipping->shipping_name = $data['shipping_name'];
         $shipping->shipping_email = $data['shipping_email'];
         $shipping->shipping_phone = $data['shipping_phone'];
         $shipping->shipping_address = $data['shipping_address'];
         $shipping->shipping_notes = $data['shipping_notes'];
         $shipping->shipping_method = $data['shipping_method'];
         $shipping->save();
         $shipping_id = $shipping->shipping_id;

         $checkout_code = substr(md5(microtime()),rand(0,26),5);

  
         $order = new Order;
         $order->customer_id = Session::get('customer_id');
         $order->shipping_id = $shipping_id;
         $order->order_status = 1;
         $order->order_code = $checkout_code;

         date_default_timezone_set('Asia/Ho_Chi_Minh');
         $order->created_at = now();
         $order->save();

            $content = Cart::content();
             $content1 = Cart::content();
             $total=0;
             foreach($content as $v_content){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $v_content->id;
                $order_details->product_name =$v_content->name;
                $order_details->product_sales_price = $v_content->price;
                $order_details->product_sales_quantity =$v_content->qty;
                $total+=$v_content->price*$v_content->qty;
                $order_details->product_coupon =  $data['order_coupon'];

                if($order_details->product_coupon !='no'){
             
                $coupon1= DB::table('tbl_coupon')->where('coupon_code', $order_details->product_coupon)->get();
                 $data1 = array();
                 foreach ($coupon1 as $key => $value1) {
                 $value1=$value1->coupon_time-1;
                 }
                   $data1['coupon_time'] =$value1;
                     DB::table('tbl_coupon')->where('coupon_code', $order_details->product_coupon )->update($data1);
            }
             
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $order->created_at = now();
                $order_details->save();
            }
foreach ($content1 as $key => $v_content1) {
   
$id=$v_content1->id;
$qty=$v_content1->qty;
      $product= DB::table('tbl_product')->where('product_id',$id)->get();
            
             foreach ($product as $key => $value) {
                 $value=$value->product_number-$qty;
             
               
             $data = array();
             $data['product_number'] =$value;
             if($value<=5 && $value>0){
                 $data['product_condition_id']=2;
             }
             if($value==0){
                 $data['product_condition_id']=3;
                 $data['product_status']=1;
             }
             if($value>5){
                 $data['product_condition_id']=1;
                 $data['product_status']=0;
             }
            DB::table('tbl_product')->where('product_id', $id )->update($data);  }}
            
           
       
         Session::forget('coupon');
          Session::forget('cart');}
         

       
    }
     public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->where('tbl_order_details.order_id',$orderId)
        ->first();

        $manager_order_by_id  = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
        
    }
    public function login_checkout(){

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
 $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
       
               $category_menu="";
            foreach ($category_product as $key => $cat) {
               $category_menu.="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->slug."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                           ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->slug."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                            $sub_category = DB::table('tbl_category_product')->where([['category_status','0'],['id',$cat->id]])->orderby('category_id','desc')->get(); 
                                            foreach ($sub_category  as $key => $subcat) {
                                               $category_menu.=" <li><a href='show-category-home/$subcat->slug_category_product'>".$subcat->category_name."</a></li>";
                                            }

                                          $category_menu.="  </ul>
                                            
                                      
                                    </div>
                                </div>";
                }
             
    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('category_menu',$category_menu);
    }
    public function add_customer(Request $request){

    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);
        if($data['customer_name'] !="" &&$data['customer_phone'] !=""&&$data['customer_email'] !=""&&$data['customer_password']!="" ){
    	$customer_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customer_id',$customer_id);
    	Session::put('customer_name',$request->customer_name);
    	return Redirect::to('/home');
    }
    else {
            return Redirect::to('/login-checkout');
        }


    }
    public function checkout(){
       if(Session::get('customer_id')){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
 $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
      
               $category_menu="";
            foreach ($category_product as $key => $cat) {
               $category_menu.="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->slug."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                           ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->slug."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                            $sub_category = DB::table('tbl_category_product')->where([['category_status','0'],['id',$cat->id]])->orderby('category_id','desc')->get(); 
                                            foreach ($sub_category  as $key => $subcat) {
                                               $category_menu.=" <li><a href='show-category-home/$subcat->slug_category_product'>".$subcat->category_name."</a></li>";
                                            }

                                          $category_menu.="  </ul>
                                            
                                      
                                    </div>
                                </div>";
                } 
    	return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('category_menu',$category_menu);}
        else{
            return Redirect::to('/login-checkout');
        }

    }
    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	
    	return Redirect::to('/payment');
    }
    public function payment(){
 $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
      
               $category_menu="";
            foreach ($category_product as $key => $cat) {
               $category_menu.="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->slug."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                           ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->slug."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                            $sub_category = DB::table('tbl_category_product')->where([['category_status','0'],['id',$cat->id]])->orderby('category_id','desc')->get(); 
                                            foreach ($sub_category  as $key => $subcat) {
                                               $category_menu.=" <li><a href='show-category-home/$subcat->slug_category_product'>".$subcat->category_name."</a></li>";
                                            }

                                          $category_menu.="  </ul>
                                            
                                      
                                    </div>
                                </div>";
                } 
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product)->with('category_menu',$category_menu);

    }
    public function order_place(Request $request){
        //insert payment_method
      $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
       
               $category_menu="";
            foreach ($category_product as $key => $cat) {
               $category_menu.="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->slug."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                           ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->slug."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                            $sub_category = DB::table('tbl_category_product')->where([['category_status','0'],['id',$cat->id]])->orderby('category_id','desc')->get(); 
                                            foreach ($sub_category  as $key => $subcat) {
                                               $category_menu.=" <li><a href='show-category-home/$subcat->slug_category_product'>".$subcat->category_name."</a></li>";
                                            }

                                          $category_menu.="  </ul>
                                            
                                      
                                    </div>
                                </div>";
                } 
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product)->with('category_menu',$category_menu);

      
        
        //return Redirect::to('/payment');
    }
    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customer_email',$email)->where('customer_password',$password)->first();
    	
    	
    	if($result){
    		Session::put('customer_id',$result->customer_id);
    		return Redirect::to('/home');
    	}else{
             Session::put('message','Bạn nhập không đúng email hoặc mật khẩu');
    		return Redirect::to('/login-checkout');
    	}
    	
   
    	

    }
    public function manage_order(){
        
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id','desc')->paginate(5);
        $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    
    public function purchase_history(){
       if(Session::get('customer_id')){
        $customer_id=Session::get('customer_id');
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $co=DB::table('tbl_customers')
         ->where('tbl_customers.customer_id',$customer_id)
         ->limit(1)->get();
     $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
        
               $category_menu="";
            foreach ($category_product as $key => $cat) {
               $category_menu.="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->slug."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                           ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->slug."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                            $sub_category = DB::table('tbl_category_product')->where([['category_status','0'],['id',$cat->id]])->orderby('category_id','desc')->get(); 
                                            foreach ($sub_category  as $key => $subcat) {
                                               $category_menu.=" <li><a href='show-category-home/$subcat->slug_category_product'>".$subcat->category_name."</a></li>";
                                            }

                                          $category_menu.="  </ul>
                                            
                                      
                                    </div>
                                </div>";
                }     
      
     
         return view('pages.checkout.purchase_history')->with('category',$cate_product)->with('brand',$brand_product)->with('co',$co)->with('category_menu',$category_menu);
     }
     else{

     
       Session::put('message','Mời bạn đăng nhập để xem lịch sử mua hàng');
    return Redirect::to('/login-checkout');}
     }
     public function purchase_history_detail($order_code){
        if(Session::get('customer_id')){
        $customer_id=Session::get('customer_id');
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $cus=DB::table('tbl_order_details')
         ->join('tbl_product','tbl_order_details.product_id','=','tbl_product.product_id')
         ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
         ->where('tbl_order.order_code',$order_code)
         ->get();
        
         $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
        
               $category_menu="";
            foreach ($category_product as $key => $cat) {
               $category_menu.="<div class='panel-heading'>
                                    <h4 class='panel-title'>
                                        <a data-toggle='collapse' data-parent='#accordian' href='#".$cat->slug."'>
                                            <span class='badge pull-right'><i class='fa fa-plus'></i></span>
                                           ".$cat->name."
                                        </a>
                                    </h4>
                                </div>
                                <div id='".$cat->slug."' class='panel-collapse collapse'>
                                    <div class='panel-body'>
                                        <ul>";
                                            $sub_category = DB::table('tbl_category_product')->where([['category_status','0'],['id',$cat->id]])->orderby('category_id','desc')->get(); 
                                            foreach ($sub_category  as $key => $subcat) {
                                               $category_menu.=" <li><a href='show-category-home/$subcat->slug_category_product'>".$subcat->category_name."</a></li>";
                                            }

                                          $category_menu.="  </ul>
                                            
                                      
                                    </div>
                                </div>";
                } 
     
         return view('pages.checkout.purchase_history_detail')->with('category',$cate_product)->with('brand',$brand_product)->with('cus',$cus)->with('category_menu',$category_menu);
     }
       
        else{
            return Redirect::to('/login-checkout');
        }
     }
        public function cancel_order(Request $request){
      $data = $request->all();
      $order_code=$request->order_code;
         $order_details=DB::table('tbl_order_details')->where('order_code',$order_code)->get();
         foreach ($order_details as $key => $value) {
            $o_dq= $value->product_sales_quantity;
            $o_pi=$value->product_id;
         
          $product= DB::table('tbl_product')->where('product_id',$o_pi)->get();
            
             foreach ($product as $key => $value1) {
                 $p_new=$value1->product_number+$o_dq;
             
              $data2 = array();
                  $data2['product_number'] =$p_new;
                  if($p_new<=5 && $p_new>0){
                 $data2['product_condition_id']=2;
             }
             if($p_new==0){
                 $data2['product_condition_id']=3;
                 $data2['product_status']=1;
             }
             if($p_new>5){
                 $data2['product_condition_id']=1;
                 $data2['product_status']=0;
             }
               DB::table('tbl_product')->where('product_id',$o_pi)->update($data2);  }}
                 $data1 = array();
                 $data1['order_status'] = 4;
                 DB::table('tbl_order')->where('order_code',$order_code)->update($data1);
     }
}
