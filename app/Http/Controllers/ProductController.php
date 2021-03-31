<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category')->orderby('id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 
        $product_origin = DB::table('tbl_product_origin')->orderby('product_origin_id','asc')->get();
        $producer= DB::table('tbl_producer')->orderby('producer_id','asc')->get(); 
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product)->with('producer', $producer)->with('product_origin', $product_origin);
    	

    }
    public function all_product(){
        $this->AuthLogin();
    	$all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
    	$manager_product  = view('admin.all_product')->with('all_product',$all_product);
    	return view('admin_layout')->with('admin.all_product', $manager_product);

    }
    public function save_product(Request $request){
         $this->AuthLogin();
    	$data = array();
    	$data['product_name'] = $request->product_name;
        $data['product_slug'] =  str_slug($request->product_name,'-') ;
    	$data['product_price'] = $request->product_price;
        $data['product_number'] = $request->product_number;
        $data['expiry_date'] = $request->expiry_date;
        $data['product_origin_id'] = $request->product_origin_id;
        $data['producer_id'] = $request->producer_id;
        $data['promotion'] = $request->promotion;
        if( $data['product_number'] <=5 && $data['product_number'] >0){
        $data['product_condition_id'] = 2;
        }
        if($data['product_number']==0){
        $data['product_condition_id'] = 3;
        }
        if($data['product_number']>5){
        $data['product_condition_id'] = 1;
        $data['product_status']=0;
        }
    	$data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        if($data['product_number']==0){
        $data['product_status'] = 1;
        }else{
         $data['product_status'] = $request->product_status;}
        $data['product_image'] = $request->product_status;
        $get_image = $request->file('product_image');
      if($data['product_desc'] !=''&&$data['product_content'] !='' && $data['expiry_date'] !='' && $data['product_origin_id'] !='' && $data['producer_id'] !='' && $data['promotion'] !='' && $data['category_id'] !='' ){
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
    	DB::table('tbl_product')->insert($data);
    	Session::put('message','Thêm sản phẩm thành công');
    	return Redirect::to('all-product');

    }
     else{
       
        Session::put('message','Thêm không thành công');
        return Redirect::to('add-product');
        }

    }
    public function unactive_product($product_id){
         $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');

    }
    public function active_product($product_id){
         $this->AuthLogin();
         $pro= DB::table('tbl_product')->where('product_id',$product_id)->get();
          foreach ($pro as $key => $value) {
           $pro_num=$value->product_number;
          }
          if($pro_num>0){
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','kích hoạt sản phẩm thành công');
        return Redirect::to('all-product');}
        else{
         Session::put('message','kích hoạt sản phẩm không thành công');
        return Redirect::to('all-product');
        }
    }
    public function edit_product($product_id){
         $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get(); 
        $product_origin = DB::table('tbl_product_origin')->orderby('product_origin_id','asc')->get();
      $category=DB::table('tbl_category')->orderby('id','asc')->get();
        $producer= DB::table('tbl_producer')->orderby('producer_id','asc')->get(); 
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product)->with('producer', $producer)->with('product_origin', $product_origin)->with('category',$category);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }
    public function update_product(Request $request,$product_id){
         $this->AuthLogin();
         if($request->product_number>0){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_slug'] = str_slug($request->product_name,'-') ;
        $data['product_price'] = $request->product_price;
        $data['product_number'] = $request->product_number;
        $data['expiry_date'] = $request->expiry_date;
        $data['product_origin_id'] = $request->product_origin_id;
        $data['producer_id'] = $request->producer_id;
        $data['promotion'] = $request->promotion;
        if( $data['product_number'] <=5 && $data['product_number'] >0){
        $data['product_condition_id'] = 2;
        }
        if($data['product_number']==0){
        $data['product_condition_id'] = 3;
        }
        if($data['product_number']>5){
        $data['product_condition_id'] = 1;
        $data['product_status']=0;
        }
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        if($data['product_number']==0){
        $data['product_status'] = 1;
        }else{
         $data['product_status'] = $request->product_status;}
        $get_image = $request->file('product_image');
        if($data['product_name'] !=''&& $data['product_slug'] !=''&& $data['product_price'] !=''&& $data['product_desc'] !='' &&  $data['product_content'] !='' && $data['product_number'] !='' && $data['expiry_date'] !='' && $data['product_origin_id'] !='' && $data['producer_id'] !='' && $data['promotion'] !='' && $data['category_id'] !='')
        {
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/product',$new_image);
                    $data['product_image'] = $new_image;
                    DB::table('tbl_product')->where('product_id',$product_id)->update($data);
                    Session::put('message','Cập nhật sản phẩm thành công');
                    return Redirect::to('all-product');
        }
            
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-product');
    }
    else{
        Session::put('message','Cập nhật không thành công');
        return Redirect::to('all-product');
        }
    }
     else{
        Session::put('message','Không thể kích hoạt sản phẩm do số lượng bằng 0');
        return Redirect::to('all-product');
        }

    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-product');
    }
    public function inventory_management(){
          $this->AuthLogin();
          $inventory = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_product_condition','tbl_product_condition.product_condition_id','=','tbl_product.product_condition_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product  = view('admin.all_inventory_management')->with('inventory', $inventory);
        return view('admin_layout')->with('admin.all_inventory_management', $manager_product);

    }
    public function update_number(Request $request, $product_id){
         $this->AuthLogin();
          $data1=$request->product_number;
           $product= DB::table('tbl_product')->where('product_id', $product_id )->get();
            
             foreach ($product as $key => $value) {
                 $value=$value->product_number+ $data1;
             }
               
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
            DB::table('tbl_product')->where('product_id', $product_id )->update($data);  
        Session::put('message','Đã thêm số lượng sản phẩm thành công');
        return Redirect::to('/inventory-management');
    }
    //End Admin Page
    public function details_product($product_slug){
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
      $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->join('tbl_product_origin','tbl_product_origin.product_origin_id','=','tbl_product.product_origin_id')
        ->join('tbl_product_condition','tbl_product_condition.product_condition_id','=','tbl_product.product_condition_id')
        ->join('tbl_producer','tbl_producer.producer_id','=','tbl_product.producer_id')
        ->where([['tbl_product.product_slug',$product_slug],['tbl_product.product_status', '=', '0'],])->get();

        foreach($details_product as $key => $value){
            $category_id = $value->category_id;       
        }
       
       
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where([['tbl_category_product.category_id',$category_id],['tbl_product.product_status', '=', '0'],])->whereNotIn('tbl_product.product_slug',[$product_slug])->get();
       

        return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('category_menu',$category_menu);

    }

}
