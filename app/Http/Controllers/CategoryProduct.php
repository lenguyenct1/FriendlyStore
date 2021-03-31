<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        $category=DB::table('tbl_category')->get();
    	return view('admin.add_category_product')->with('category',$category);
    }
    public function all_category_product(){
        $this->AuthLogin();
    	$all_category_product = DB::table('tbl_category_product')
                                ->join('tbl_category','tbl_category_product.id','=','tbl_category.id')->get();
    	$manager_category_product  = view('admin.all_category_product')->with('all_category_product',$all_category_product);
    	return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
   

    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
    	$data = array();
    	$data['category_name'] = $request->category_product_name;
        $data['slug_category_product'] = str_slug($request->category_product_name,'-') ;
    	$data['category_desc'] = $request->category_product_desc;
    	$data['category_status'] = $request->category_product_status;
        $data['id'] = $request->id;
        if($data['category_desc'] !=''){
    	DB::table('tbl_category_product')->insert($data);
    	Session::put('message','Thêm loại sản phẩm thành công');
    	return Redirect::to('add-category-product');}
        else{
        Session::put('message','Bạn chưa nhập mô tả');
        return Redirect::to('add-category-product');
        }
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Không kích hoạt loại sản phẩm thành công');
        return Redirect::to('all-category-product');

    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Kích hoạt loại sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $cate_id=DB::table('tbl_category')->orderby('id','asc')->get(); 
        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product)->with('cate_id',$cate_id);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['slug_category_product'] =  str_slug($request->category_product_name,'-') ;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_status;
        $data['id'] = $request->id;
        if($data['category_name'] !='' &&$data['slug_category_product'] !=''&&$data['category_desc']!=''){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật loại sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    else{
        Session::put('message','Cập nhật loại sản phẩm không thành công');
        return Redirect::to('all-category-product');
    }
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa loại sản phẩm thành công');
        return Redirect::to('all-category-product');
    }

    //End Function Admin Page
    public function show_category_home($slug_category_product){
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
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where([['tbl_category_product.slug_category_product',$slug_category_product],['tbl_product.product_status', '=', '0'],])->get();
        
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();

        return view('pages.category.show_category')->with('category',$cate_product)->with('brand',$brand_product)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('category_menu',$category_menu);
    }

}
