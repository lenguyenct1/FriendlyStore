<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class NewsController extends Controller
{
       public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_news(){
        $this->AuthLogin();
       
        return view('admin.add_news');
    	

    }
    public function all_news(){
    	$this->AuthLogin();
    	$all_news = DB::table('tbl_news')->get();
    	$manager_news  = view('admin.all_news')->with('all_news',$all_news);
    	return view('admin_layout')->with('admin.all_news', $manager_news);
   

    }
    public function save_news(Request $request){
         $this->AuthLogin();
    	$data = array();
    	$data['news_name'] = $request->news_name;
        $data['news_slug'] = str_slug($request->news_name,'-') ;
    	$data['news_desc'] = $request->news_desc;
        $data['news_content'] = $request->news_content;
        $data['news_status'] = $request->news_status;
        $data['news_image'] = $request->news_status;
        $get_image = $request->file('news_image');
      if($data['news_desc'] !=''&&$data['news_content'] !='' ){
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/news',$new_image);
            $data['news_image'] = $new_image;
            DB::table('tbl_news')->insert($data);
            Session::put('message','Thêm tin tức thành công');
            return Redirect::to('add-news');
        }
        $data['news_image'] = '';
    	DB::table('tbl_news')->insert($data);
    	Session::put('message','Thêm tin tức thành công');
    	return Redirect::to('all-news');
    }
     else{
        Session::put('message','Thêm không thành công');
        echo"<pre>";
        echo print_r($data);
        echo"</pre>";
     //   return Redirect::to('add-news');
        }

    }
    public function unactive_news($news_id){
         $this->AuthLogin();
        DB::table('tbl_news')->where('news_id',$news_id)->update(['news_status'=>1]);
        Session::put('message','Không kích hoạt tin tức thành công');
        return Redirect::to('all-news');

    }
    public function active_news($news_id){
         $this->AuthLogin();
        DB::table('tbl_news')->where('news_id',$news_id)->update(['news_status'=>0]);
        Session::put('message','kích hoạt tin tức thành công');
        return Redirect::to('all-news');
    }
    public function edit_news($news_id){
         $this->AuthLogin();
        $edit_news = DB::table('tbl_news')->where('news_id',$news_id)->get();

        $manager_news  = view('admin.edit_news')->with('edit_news',$edit_news);

        return view('admin_layout')->with('admin.edit_news', $manager_news);
    }
    public function update_news(Request $request,$news_id){
         $this->AuthLogin();
        $data = array();
        $data['news_name'] = $request->news_name;  
        $data['news_slug'] = str_slug($request->news_name,'-') ;
        $data['news_desc'] = $request->news_desc;
        $data['news_content'] = $request->news_content;
        $data['news_status'] = $request->news_status;
        $get_image = $request->file('news_image');
        if($data['news_name'] !=''&& $data['news_slug'] !=''&& $data['news_desc'] !='' &&  $data['news_content'] !='' )
        {
        if($get_image){
                    $get_name_image = $get_image->getClientOriginalName();
                    $name_image = current(explode('.',$get_name_image));
                    $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
                    $get_image->move('public/uploads/news',$new_image);
                    $data['news_image'] = $new_image;
                    DB::table('tbl_news')->where('news_id',$news_id)->update($data);
                    Session::put('message','Cập nhật tin tức thành công');
                    return Redirect::to('all-news');
        }
            
        DB::table('tbl_news')->where('news_id',$news_id)->update($data);
        Session::put('message','Cập nhật tin tức thành công');
        return Redirect::to('all-news');
    }
    else{
        Session::put('message','Cập nhật không thành công');
        return Redirect::to('all-news');
        }

    }
    public function delete_news($news_id){
        $this->AuthLogin();
        DB::table('tbl_news')->where('news_id',$news_id)->delete();
        Session::put('message','Xóa tin tức thành công');
        return Redirect::to('all-news');
    }
      //End Function Admin Page
    public function show_details_news($news_slug){
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
        $news_by_id = DB::table('tbl_news')->where('tbl_news.news_slug',$news_slug)->get();
       

        return view('pages.tintuc.show_details_news')->with('category',$cate_product)->with('brand',$brand_product)->with('news_by_id',$news_by_id)->with('category_menu',$category_menu);
    }

}
