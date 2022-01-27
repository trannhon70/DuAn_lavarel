
@extends('admin_layout')
@section('admin_content')
    
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa sản phẩm
            </header>
            <div class="panel-body">
                <?php 
            $message = Session::get('message');
            if($message){
                echo '<span class="text-success w-100"> '.$message.'</span>';
                Session::put('message',null);
            }
        ?>
                <div class="position-center">
                    @foreach ($edit_product as $key => $pro)
                    <form role="form" action="{{ URL::to('/update-product/'.$pro->product_id) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm </label>
                            <input type="text" value="{{ $pro->product_name }}" name="product_name" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm </label>
                            <input type="text" value="{{ $pro->product_price }}" name="product_price" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm </label>
                            <input type="file" name="product_image" class="form-control" id="exampleInputEmail1">
                            <img src="{{ URL::to('public/upload/product/'.$pro->product_image) }}" style="width:100px; height:auto;" alt="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm </label>
                            <textarea style="resize: none"  rows="10" type="text" name="product_desc" class="form-control" id="exampleInputPassword1">{{ $pro->product_desc }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nội dung sản phẩm </label>
                            <textarea style="resize: none" rows="10" type="text" name="product_content" class="form-control" id="exampleInputPassword1">{{ $pro->product_content }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                                @foreach ( $cat_product as $key => $cate)
                                @if ($cate->category_id == $pro->category_id)
                                <option selected value="{{$cate->category_id }}">{{ $cate->category_Name }}</option>
                                @else
                                <option value="{{$cate->category_id }}">{{ $cate->category_Name }}</option>
                                @endif
                                
                                @endforeach
                                
                                
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                            <select name="product_brand" class="form-control input-sm m-bot15">
                                @foreach ( $brand_product as $key => $brand)
                                @if ($brand->brand_id == $pro->brand_id)
                                <option selected value="{{$brand->brand_id }}">{{ $brand->brand_Name }}</option>
                                @else
                                <option value="{{$brand->brand_id }}">{{ $brand->brand_Name }}</option>
                                @endif
                                @endforeach>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Hiển thị</label>
                            <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">Ẩn</option>
                                <option value="1">Hiển thị</option>
                                
                            </select>
                        </div>
                        
                        <button type="submit" name="save-product" class="btn btn-info">Sửa sản phẩm  </button>
                    </form>
                    @endforeach
                    
                </div>

            </div>
        </section>
    </div>
</div>
@endsection
