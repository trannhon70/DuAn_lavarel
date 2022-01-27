@extends('welcome')
@section('content')
    <section id="cart_items">
        <div class="container" style="width:100%;">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                    <li class="active">Giỏ hàng của bạn</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <?php
                $content = Cart::content();
                
                ?>
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Hình ảnh</td>
                            <td class="description">Mô tả</td>
                            <td class="price">Giá</td>
                            <td class="quantity">Số lượng</td>
                            <td class="total">Tổng tiền</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $v_content)
                            <tr>
                                <td class="cart_product">
                                    <img style="width: 60px; height:70px;"
                                        src="{{ URL::to('public/upload/product/' . $v_content->options->image) }}"
                                        alt="" />
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $v_content->name }}</a></h4>
                                    <p> Mã ID: {{ $v_content->id }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>{{ number_format($v_content->price) . ' ' . 'VNĐ' }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <form action="{{ URL::to('/update-cart-quantity') }}" method="post">
                                            {{ csrf_field() }}
                                            <input class="cart_quantity_input" type="number" name="cart_quantity"
                                                value="{{ $v_content->qty }}" autocomplete="off" size="1" min="1" max="10">
                                            <input type="hidden" value="{{ $v_content->rowId }}" name="rowid_cart"
                                                class="form-control">
                                            <input type="submit" value="Cập nhật" name="update_qty"
                                                class="btn btn-default btn-sm">
                                        </form>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        <?php
                                        $subtotal = $v_content->qty * $v_content->price;
                                        echo number_format($subtotal) . ' ' . 'VNĐ';
                                        ?>
                                    </p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete"
                                        href="{{ URL::to('/delete-to-cart/' . $v_content->rowId) }}"><i
                                            class="fa fa-times"></i></a>
                                </td>
                            </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
    <section id="do_action">
        <div class="container " style="width:100%">
           
            <div class="row">
                
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng <span>{{ Cart::subtotal(0,',','.') . ' ' . 'VNĐ' }}</span></li>
                            <li>Thuế <span>{{ Cart::tax(0,',','.') . ' ' . 'VNĐ' }}</span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span>{{ Cart::total(0,',','.') . ' ' . 'VNĐ' }}</span></li>
                        </ul>
                        {{-- <a class="btn btn-default update" href="">Update</a> --}}
                       
                        <?php 
								 	$customer_id = Session::get('customer_id');
									 if($customer_id !=null){
								?>
									 <a class="btn btn-default check_out" href="{{ URL::to('/checkout') }}">Thanh toán</a>

								<?php 
									 }else{
								?>
									 <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Thanh toán</a>
								<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->
<style>
    .breadcrumbs .breadcrumb li a:after {
        left: 77px;
    }
</style>
@endsection
