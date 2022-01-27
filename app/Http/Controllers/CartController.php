<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request){
        

        $product_id  = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();

        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        // Cart::destroy();
        $data['id']=$product_info->product_id;
        $data['qty']=$quantity;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['weight']=$product_info->product_id;
        $data['options']['image']=$product_info->product_image;

        Cart::add($data);
        //sét thuế 10%
        Cart::setGlobalTax(0);
        // Cart::destroy();
        return Redirect::to('show-cart');
    }

    public function show_cart(){
        $cat_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category',$cat_product)->with('brand',$brand_product);
    }
    //xóa sản phẩm trong giỏ hàng
    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('show-cart');
    }

    //update số lượng sản phẩm trong giỏ hàng 
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowid_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('show-cart');
    }
}
