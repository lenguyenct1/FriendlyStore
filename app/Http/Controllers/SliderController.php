<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Session;
use DB;
use Illuminate\Support\Facades\Redirect;
session_start();

class SliderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }

    public function all_slider(){
        $all_slide=Slider::orderby('slider_id','DESC')->get();
        return view('admin.slider.list_slide')->with(compact('all_slide'));
    }
      public function edit_slider($slider_id){
        $edit_slider=Slider::find($slider_id);
       return view('admin.slider.edit_slide')->with(compact('edit_slider'));
    }
    public function add_slider(){
       
        return view('admin.slider.add_slide');
    }
       public function save_slider(Request $request){
       $data= $request->all();
        $get_image = $request->file('slider_image');
        if($data['slider_desc']!=''){
         if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/slider',$new_image);
            $slide=new Slider();
            $slide->slider_name=$data['slider_name'];
            $slide->slider_image=$new_image;
            $slide->slider_status=$data['slider_status'];
            $slide->slider_desc=$data['slider_desc'];
            $slide->save();
            Session::put('message','Thêm slider thành công');
            return Redirect::to('add-slider');
        }
        else{
             Session::put('message','Làm ơn thêm hình ảnh');
             return view('admin.slider.add_slide');
            }

    }

else{
     Session::put('message','Làm ơn nhập mô tả');
             return view('admin.slider.add_slide');
}
	
}
     public function unactive_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>1]);
        Session::put('message','Không kích hoạt slider sản phẩm thành công');
        return Redirect::to('all-slider');

    }
    public function active_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update(['slider_status'=>0]);
        Session::put('message','Kích hoạt slider thành công');
        return Redirect::to('all-slider');

    }
    public function update_slider(Request $request,$slider_id){
         $this->AuthLogin();
        $data = array();
        $data['slider_name'] = $request->slider_name;  
        $data['slider_desc'] = $request->slider_desc;
        $data['slider_status'] = $request->slider_status;
        $get_image = $request->file('slider_image');
        if($data['slider_name'] !=''&& $data['slider_desc'] !='' )
        {
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/slider',$new_image);
                    $data['slider_image'] = $new_image;
                    DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
                    Session::put('message','Cập nhật slider thành công');
                    return Redirect::to('all-slider');
        }
            
        DB::table('tbl_slider')->where('slider_id',$slider_id)->update($data);
        Session::put('message','Cập nhật slider thành công');
        return Redirect::to('all-slider');
    }
    else{
        Session::put('message','Cập nhật slider không thành công');
        return Redirect::to('all-slider');
        }

    }
        public function delete_slider($slider_id){
        $this->AuthLogin();
        DB::table('tbl_slider')->where('slider_id',$slider_id)->delete();
        Session::put('message','Xóa slider thành công');
        return Redirect::to('all-slider');
    }
    
}
