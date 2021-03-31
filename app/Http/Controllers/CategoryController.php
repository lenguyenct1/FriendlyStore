<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category(){
        $this->AuthLogin();
    	return view('admin.category.add_category');
    }
    public function all_category(){
        $this->AuthLogin();
    	$all_category = DB::table('tbl_category')
                        ->join('tbl_type','tbl_category.type','=','tbl_type.type_id')->get();
    	$manager_category  = view('admin.category.all_category')->with('all_category',$all_category);
    	return view('admin_layout')->with('admin.category.all_category', $manager_category);
   

    }
    public function save_category(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['name'] = $request->name;
        $data['slug'] = str_slug($request->name,'-') ;
    	$data['status'] = $request->status;
        $data['type'] = $request->type;
        if($data['name'] !='' && $data['type'] !=''){
    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Thêm danh mục sản phẩm thành công');
    	return Redirect::to('add-category');}
        else{

        Session::put('message','Thêm danh mục không thành công');
        return Redirect::to('add-category');
        }
    }
    public function unactive_category($id){
        $this->AuthLogin();
        DB::table('tbl_category')->where('id',$id)->update(['status'=>1]);
        Session::put('message','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category');

    }
    public function active_category($id){
        $this->AuthLogin();
        DB::table('tbl_category')->where('id',$id)->update(['status'=>0]);
        Session::put('message','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category');
    }
    public function edit_category($id){
        $this->AuthLogin();
        $edit_category = DB::table('tbl_category')->where('id',$id)->get();

        $manager_category  = view('admin.category.edit_category')->with('edit_category',$edit_category);

        return view('admin_layout')->with('admin.category.edit_category', $manager_category);
    }
    public function update_category(Request $request,$id){
        $this->AuthLogin();
        $data = array();
        $data['name'] = $request->name;
        $data['slug'] =  str_slug($request->name,'-') ;
        $data['status'] = $request->status;
        $data['type'] = $request->type;
        if($data['name'] !='' && $data['type'] !=''){
        DB::table('tbl_category')->where('id',$id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category');
    }
    else{
        Session::put('message','Cập nhật danh mục sản phẩm không thành công');
        return Redirect::to('all-category');
    }
    }
    public function delete_category($id){
        $this->AuthLogin();
        DB::table('tbl_category')->where('id',$id)->delete();
        Session::put('message','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category');
    }

    public function get_category(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="cate_id"){
                $select_province = DB::table('tbl_category_product')->where('id',$data['ma_id'])->orderby('id','ASC')->get();
                    $output.='<option value="" >---Chọn loại sản phẩm---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->category_id.'">'.$province->category_name.'</option>';
                }

            }
            echo $output;
        }
        
    }

}
