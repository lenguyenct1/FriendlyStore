<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){

    	$cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 
        $category_product=DB::table('tbl_category')->where('status','0')->orderby('id','desc')->get(); 
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
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
         $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(9)->get(); 

    	return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)->with('cate_pro',$category_product)->with('category_menu',$category_menu);
    }
    public function search(Request $request){
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
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        $search_product = DB::table('tbl_product')->where([['product_name','like','%'.$keywords.'%'],['tbl_product.product_status', '=', '0'],])->get(); 


        return view('pages.sanpham.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)->with('category_menu',$category_menu);

    }
     public function all_product(){

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
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
          $product_detail = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->paginate(12); 

        return view('pages.sanpham.product')->with('category',$cate_product)->with('brand',$brand_product)->with('product_detail',$product_detail)->with('category_menu',$category_menu);
    }
     public function getcontact(){

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
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
       
        return view('pages.sanpham.contact')->with('category',$cate_product)->with('brand',$brand_product)->with('category_menu',$category_menu);
    }
     public function show_news(){

        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get(); 
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get(); 

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
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
         $all_news = DB::table('tbl_news')->where('news_status','0')->orderby('news_id','desc')->paginate(3); 

        return view('pages.tintuc.news')->with('category',$cate_product)->with('brand',$brand_product)->with('all_news',$all_news)->with('category_menu',$category_menu);
    }
     public function show_promotion(){

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
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        
          $promotion = DB::table('tbl_product')->where([['product_status','0'],['promotion','<>','0']])->orderby('product_id','desc')->paginate(12); 

        return view('pages.sanpham.promotion')->with('category',$cate_product)->with('brand',$brand_product)->with('promotion',$promotion)->with('category_menu',$category_menu);
    }
}
