<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class OriginController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_origin(){
        $this->AuthLogin();
    	return view('admin.origin.add_origin');
    }
    public function all_origin(){
        $this->AuthLogin();
    	$all_origin = DB::table('tbl_product_origin')->get();
    	$manager_origin  = view('admin.origin.all_origin')->with('all_origin',$all_origin);
    	return view('admin_layout')->with('admin.origin.all_origin', $manager_origin);
   

    }
    public function save_origin(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['product_origin_name'] = $request->product_origin_name;
       
        if($data['product_origin_name'] !=''){
    	DB::table('tbl_product_origin')->insert($data);
    	Session::put('message','Thêm xuất xứ thành công');
    	return Redirect::to('add-origin');}
        else{

        Session::put('message','Thêm danh mục không thành công');
        return Redirect::to('add-origin');
        }
    }
  
    public function edit_origin($product_origin_id){
        $this->AuthLogin();
        $edit_origin = DB::table('tbl_product_origin')->where('product_origin_id',$product_origin_id)->get();

        $manager_origin  = view('admin.origin.edit_origin')->with('edit_origin',$edit_origin);

        return view('admin_layout')->with('admin.origin.edit_origin', $manager_origin);
    }
    public function update_origin(Request $request,$product_origin_id){
        $this->AuthLogin();
        $data = array();
        $data['product_origin_name'] = $request->product_origin_name;
      
        if($data['product_origin_name'] !='' ){
        DB::table('tbl_product_origin')->where('product_origin_id',$product_origin_id)->update($data);
        Session::put('message','Cập nhật xuất xứ thành công');
        return Redirect::to('all-origin');
    }
    else{
        Session::put('message','Cập nhật xuất xứ không thành công');
        return Redirect::to('all-origin');
    }
    }
    public function delete_origin($product_origin_id){
        $this->AuthLogin();
        DB::table('tbl_product_origin')->where('product_origin_id',$product_origin_id)->delete();
        Session::put('message','Xóa xuất xứ thành công');
        return Redirect::to('all-origin');
    }

  

}
