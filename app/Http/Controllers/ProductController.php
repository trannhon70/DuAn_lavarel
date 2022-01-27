<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
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
    public function add_product()
    {
        $this->AuthLogin();
        $cat_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cat_product',$cat_product)->with('brand_product',$brand_product);
    }
    //hiển thị toàn bộ thương hiệu ra giao diện 
    public function all_product()
    {
        $this->AuthLogin();
        $all_product =  DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product', $all_product);

        return view('admin_layout')->with('admin.all_product', $manager_product);
    }
    //hàm thêm thương hiệu vào CSDL
    public function save_product(Request $request)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_image;
        //hình ảnh
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =$name_image.rand(0,99999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']= $new_image;

            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm  sản phẩm thành công');
            return  redirect('add-product');
        }
        $data['product_image']= '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Thêm  sản phẩm thành công');
        return  redirect('add-product');
    }

    //chức năng ẩn hiển danh mục sản phẩm
    public function unactive_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('massage', '<span class="text-danger ml-2"> Sản phẩm đã được ẩn</span>');
        return Redirect::to('all-product');
    }

    public function active_product($product_id)
    {
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('massage', '<span class="text-success ml-2"> Sản phẩm đã được hiện</span>');
        return Redirect::to('all-product');
    }

    //chức năng sửa danh mục 
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cat_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product =  DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cat_product',$cat_product)->with('brand_product',$brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    //hàm xử lý chức năng update danh mục 
    public function update_product(Request $request ,$product_id){
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        //hình ảnh
        $get_image = $request->file('product_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =$name_image.rand(0,99999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']= $new_image;

            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return  redirect('all-product');
        }
        
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message', 'Cập nhật sản phẩm thành công');
        return  redirect('all-product');
    }

    //hàm xử lý xóa danh mục 
    public function delete_product($product_id){
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('massage', '<span class="text-danger"> Sản phẩm đã được xóa</span>');
        return Redirect::to('all-product');
    }

    //end admin pages
    //trang người dùng user
    public function details_product($product_id){
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $details_product =  DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();

        //sản phẩm liên quan 
        
        foreach($details_product as $key => $value){
            $category_id = $value->category_id;
        }
        $related_product =  DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();


        return view('pages.sanpham.show_details')->with('category',$cat_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product);
    }
}
