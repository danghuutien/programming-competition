<?

use App\Models\CategoryProduct;
?>
@extends('layout.admin')

@section('admin')
@if (session()->has('sucess'))
            <div class="alert alert-success">
                {{ session()->get('sucess') }}
            </div>
            @endif
<form class="row g-3" action="{{route('product.inser')}}" method="POST" enctype="multipart/form-data">
@csrf
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá</label>
                            <input class="form-control" type="text" name="price" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Giá cũ</label>
                            <input class="form-control" type="text" name="price_old" id="name">
                        </div>
                        
                    </div>
                    
                    <div class="col-6">
                    <div class="form-group">
                            <label for="name">Ảnh</label>
                            <input class="form-control" type="file" name="file" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Số lượng sản phẩm</label>
                            <input class="form-control" type="text" name="qty" id="name">
                        </div>
                        <div class="form-group">
                            <label for="name">Điểm sản phẩm</label>
                            <input class="form-control" type="text" name="score" id="name">
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="intro">Chi tiết sản phẩm</label>
                    <textarea name="" class="form-control" id="intro" cols="30" rows="5" name="detail"></textarea>
                </div>


                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="">
                        <option>Chọn danh mục</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nhãn hàng</label>
                    <select class="form-control" id="">
                        <option>Chọn danh mục</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
                        </label>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
</form>

@endsection