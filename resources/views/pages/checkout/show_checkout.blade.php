@extends('welcome')
@section('content')

<section id="cart_items">
    <div class="container" style="width:100%;">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->

        

        <div class="register-req">
            <p>Bạn vui lòng đăng ký tài khoản hoặc đăng nhập để thanh toán đơn hàng và xem lại lịch sử đơn hàng </p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="form-one" style="width:100%">
                            <form action="{{ URL::to('/save-checkout-customer') }}" method="POST">
                                {{ csrf_field() }}
                                <input type="email" name="shipping_email" placeholder=" địa chỉ email">
                                <input type="text" name="shipping_name" placeholder="Họ và tên*">
                                <input type="text" name="shipping_address" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_notes"   placeholder="ghi chú cho đơn hàng" rows="16"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary ">
                            </form>
                        </div>
                        
                    </div>
                </div>
                			
            </div>
        </div>
        <div class="review-payment">
            <h2>Xem lại giỏ hàng</h2>
        </div>

        <div class="table-responsive cart_info">
            
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->
<style >
    .breadcrumbs .breadcrumb li a:after {
        left: 77px;
    }
</style>
@endsection