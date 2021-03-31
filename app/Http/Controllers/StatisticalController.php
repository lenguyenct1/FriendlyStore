<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Cart;
session_start();
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
class StatisticalController extends Controller
{
	 public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
     public function statistical_number_of_product(){
        
        $this->AuthLogin();
        $order_details = DB::table('tbl_order_details')
                        ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
                        ->where('tbl_order.order_status','<>','4')
                        ->select('product_name')->distinct()->get();
       return view('admin.statistical_number_of_product')->with('order_details',$order_details);
    }
      public function revenue_statistics(){
        
        $this->AuthLogin();

     $range = \Carbon\Carbon::now()->subDays(7);
     $stats = DB::table('tbl_order_details')
    ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
    ->where([['tbl_order_details.created_at', '>=', $range],['tbl_order.order_status','<>','4']])
    ->orderBy('date', 'ASC')
    ->groupBy('date')
    ->get([
      DB::raw('Date(tbl_order_details.created_at) as date'),
      DB::raw('SUM(product_sales_price*product_sales_quantity) as value')
    ]);


      return view('admin.revenue_statistics')->with('stats',$stats);
    }
    public function revenue_statistics_month(){
        
        $this->AuthLogin();
       

     $range = \Carbon\Carbon::now()->subMonths(12);
     $stats = DB::table('tbl_order_details')
    ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
    ->where([['tbl_order_details.created_at', '>=', $range],['tbl_order.order_status','<>','4']])
    ->orderBy('date', 'ASC')
    ->groupBy('date')
    ->get([
      DB::raw('Month(tbl_order_details.created_at) as date'),
      DB::raw('SUM(product_sales_price*product_sales_quantity) as value')
    ]);

   


       return view('admin.revenue_statistics_months')->with('stats',$stats);
    }
    public function revenue_statistics_5_years(){
        
        $this->AuthLogin();
       

     $range = \Carbon\Carbon::now()->subYears(5);
     $stats = DB::table('tbl_order_details')
     ->join('tbl_order','tbl_order.order_code','=','tbl_order_details.order_code')
    ->where([['tbl_order_details.created_at', '>=', $range],['tbl_order.order_status','<>','4']])
    ->orderBy('date', 'ASC')
    ->groupBy('date')
    ->get([
      DB::raw('year(tbl_order_details.created_at) as date'),
      DB::raw('SUM(product_sales_price*product_sales_quantity) as value')
    ]);

   


       return view('admin.revenue_statistics_5_years')->with('stats',$stats);
    }
}
