<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    //hiển thị toàn bộ thương hiệu ra giao diện 
    public function all_brand_product()
    {
        $this->AuthLogin();
        $all_brand_product =  DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);

        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }
    //hàm thêm thương hiệu vào CSDL
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_Name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return  redirect('add-brand-product');
    }

    //chức năng ẩn hiển thương hiệu sản phẩm
    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('massage', '<span class="text-danger">thương hiệu sản phẩm đã được ẩn</span>');
        return Redirect::to('all-brand-product');
    }

    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('massage', 'thương hiệu sản phẩm đã được hiện');
        return Redirect::to('all-brand-product');
    }

    //chức năng sửa thương hiệu 
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $edit_brand_product =  DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    //hàm xử lý chức năng update thương hiệu 
    public function update_brand_product(Request $request ,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_Name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        Session::put('massage', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //hàm xử lý xóa thương hiệu 
    public function delete_brand_product($brand_product_id){
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Session::put('massage', '<span class="text-danger">thương hiệu sản phẩm đã được xóa</span>');
        return Redirect::to('all-brand-product');
    }

    //end function pages admin
    //
    //hiển thị thương hiệu sản phẩm trên user
    public function show_brand_home($brand_id){
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $brand_by_id= DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category',$cat_product)->with('brand',$brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name',$brand_name) ;
    }
}
