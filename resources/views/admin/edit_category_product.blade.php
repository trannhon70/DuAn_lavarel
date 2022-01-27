
@extends('admin_layout')
@section('admin_content')
    
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Sửa danh mục sản phẩm
            </header>
            <div class="panel-body">
                <?php 
            $message = Session::get('message');
            if($message){
                echo '<span class="text-success w-100"> '.$message.'</span>';
                Session::put('message',null);
            }
        ?>
                @foreach ($edit_category_product as $key => $edit_value)
                <div class="position-center">
                    <form role="form" action="{{ URL::to('/update-category-product/'.$edit_value->category_id) }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{ $edit_value->category_Name }}" name="category_product_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea  style="resize: none" rows="10" type="text" name="category_product_desc" class="form-control" id="exampleInputPassword1"> {{ $edit_value->category_desc }}</textarea>
                        </div>
                        
                        
                        <button type="submit" name="update-category-product" class="btn btn-info">Sửa danh mục </button>
                    </form>
                </div>
                @endforeach
                

            </div>
        </section>
    </div>
</div>
@endsection
