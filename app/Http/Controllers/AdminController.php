<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
    	return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        $customer = DB::table('tbl_customers')
                     ->select(DB::raw('count(customer_id) as value'))
                     ->get();
         $news = DB::table('tbl_news')
                     ->select(DB::raw('count(news_id) as value'))
                     ->get();
        $range = \Carbon\Carbon::now();
      $stats = DB::table('tbl_order')
    ->where('created_at', '>=', $range)
    ->groupBy('date')
    ->orderBy('date', 'ASC')
    ->get([
      DB::raw('Date(created_at) as date'),
      DB::raw('COUNT(*) as value')
    ]);
    $stats1 = DB::table('tbl_order_details')
    ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
    ->where([['tbl_order_details.created_at', '>=', $range],['tbl_order.order_status','<>','4']])
    ->groupBy('date')
    ->orderBy('date', 'ASC')
    ->get([
      DB::raw('Date(tbl_order_details.created_at) as date'),
      DB::raw('SUM(product_sales_price*product_sales_quantity) as value')
    ]);
    	return view('admin.dashboard')->with('stats',$stats)->with('stats1',$stats1)->with('customer',$customer)->with('news',$news);
    }
    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);

    	$result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
    	if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản bị sai.Làm ơn nhập lại');
            return Redirect::to('/admin');
        }

    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }
}
