<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProducerController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_producer(){
        $this->AuthLogin();
    	return view('admin.producer.add_producer');
    }
    public function all_producer(){
        $this->AuthLogin();
    	$all_producer = DB::table('tbl_producer')->get();
    	$manager_producer  = view('admin.producer.all_producer')->with('all_producer',$all_producer);
    	return view('admin_layout')->with('admin.producer.all_producer', $manager_producer);
   

    }
    public function save_producer(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['producer_name'] = $request->producer_name;
        $data['producer_address'] = $request->producer_address;
    	$data['producer_phone'] = $request->producer_phone;
        $data['producer_email'] = $request->producer_email;
        if($data['producer_name'] !=''&&$data['producer_address'] !=''&& $data['producer_phone'] !=''&&  $data['producer_email'] !=''){
    	DB::table('tbl_producer')->insert($data);
    	Session::put('message','Thêm nhà cung cấp thành công');
    	return Redirect::to('add-producer');}
        else{
        Session::put('message','Thêm nhà cung cấp không thành công');
        return Redirect::to('add-producer');
        }
    }
    public function edit_producer($producer_id){
        $this->AuthLogin();
        $edit_producer = DB::table('tbl_producer')->where('producer_id',$producer_id)->get();

        $manager_producer  = view('admin.producer.edit_producer')->with('edit_producer',$edit_producer);

        return view('admin_layout')->with('admin.producer.edit_producer', $manager_producer);
    }
    public function update_producer(Request $request,$producer_id){
        $this->AuthLogin();
        $data = array();
        $data['producer_name'] = $request->producer_name;
        $data['producer_address'] = $request->producer_address;
        $data['producer_phone'] = $request->producer_phone;
        $data['producer_email'] = $request->producer_email;
        if($data['producer_name'] !=''&&$data['producer_address'] !=''&& $data['producer_phone'] !=''&&  $data['producer_email'] !=''){
        DB::table('tbl_producer')->where('producer_id',$producer_id)->update($data);
        Session::put('message','Cập nhật nhà cung cấp thành công');
        return Redirect::to('all-producer');
    }
    else{
        Session::put('message','Cập nhật nhà cung cấp không thành công');
        return Redirect::to('all-producer');
    }
    }
    public function delete_producer($producer_id){
        $this->AuthLogin();
        DB::table('tbl_producer')->where('producer_id',$producer_id)->delete();
        Session::put('message','Xóa nhà cung cấp thành công');
        return Redirect::to('all-producer');
    }

    

}
