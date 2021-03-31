<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
	public function unset_coupon(){
         $this->AuthLogin();
		$coupon = Session::get('coupon');
        if($coupon==true){
          
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
	}
    public function insert_coupon(){
         $this->AuthLogin();
    	return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id){
         $this->AuthLogin();
    	$coupon = Coupon::find($coupon_id);
    	$coupon->delete();
    	Session::put('message','Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon(){
         $this->AuthLogin();
    	$coupon = Coupon::orderby('coupon_id','DESC')->get();
    	return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function insert_coupon_code(Request $request){
         $this->AuthLogin();
    	$data = $request->all();

    	$coupon = new Coupon;

    	$coupon->coupon_name = $data['coupon_name'];
    	$coupon->coupon_number = $data['coupon_number'];
    	$coupon->coupon_code = $data['coupon_code'];
    	$coupon->coupon_time = $data['coupon_time'];
    	$coupon->coupon_condition = $data['coupon_condition'];
        if($coupon->coupon_name!=''&&$coupon->coupon_number!=''&&$coupon->coupon_code!=''&&$coupon->coupon_time!=''&&$coupon->coupon_condition!='' )
        {
    	$coupon->save();
    	Session::put('message','Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');
    }
    else{
        Session::put('message','Thêm mã giảm giá không thành công');
        return Redirect::to('insert-coupon');
    }


    }
    public function edit_coupon($coupon_id){
        $this->AuthLogin();
           $coupon=Coupon::find($coupon_id);
        return view('admin.coupon.edit_coupon',['coupon'=>$coupon]);
    }
       public function update_coupon(Request $request,$coupon_id){
         $this->AuthLogin();
        $coupon=Coupon::find($coupon_id);
        $coupon->coupon_name = $request->coupon_name;
        $coupon->coupon_number =  $request->coupon_number;
        $coupon->coupon_code =  $request->coupon_code;
        $coupon->coupon_time =  $request->coupon_time;
        $coupon->coupon_condition =  $request->coupon_condition;
        if($coupon->coupon_name!=''&&$coupon->coupon_number!=''&&$coupon->coupon_code!=''&&$coupon->coupon_time!=''&&$coupon->coupon_condition!='' )
        {
        $coupon->save();
        Session::put('message','Cập nhật mã giảm giá thành công');
        return Redirect::to('list-coupon');}
        else{
            Session::put('message','Cập nhật mã giảm giá không thành công');
        return Redirect::to('list-coupon');
        }
    }

}
