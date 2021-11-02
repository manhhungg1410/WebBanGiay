@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product Information <a href="{{ route('adminproducts.index') }}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Products</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            {{--        BẮT ERROR            --}}
            <div class="col-md-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            {{--       END BẮT ERROR            --}}

            {{--        FORM            --}}
            <form role="form" action="{{ route('adminproducts.update',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-9 col-lg-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Product Update</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name of product (<span style="color: red">*</span>):</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image: </label>
                                        <input type="file" class="" id="image" name="image">
                                        <img src="{{asset($product->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Quantity: </label>
                                        <input style="width: 100px" type="number" class="form-control" id="stock" name="stock" value="{{$product->stock}}" min="1">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Price($) (<span style="color: red">*</span>): </label>
                                        <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}"  min="0">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Price Sale($) (<span style="color: red">*</span>)</label>
                                        <input type="number" class="form-control" id="sale" value="{{$product->sale}}" name="sale"  min="0">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category of Product (<span style="color: red">*</span>): </label>
                                        <select class="form-control w-50" name="category_id">
                                            @foreach($lsCategory as $item)
                                                <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand of Product (<span style="color: red">*</span>): </label>
                                        <select class="form-control w-50" name="brand_id">
                                            @foreach($lsBrand as $item)
                                                <option value="{{ $item->id }}" {{$item->id == $product->brand_id ? 'selected' : ''}}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" id="position" name="position" value="{{$product->position}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Color: </label>
                                        <input type="text" class="form-control w-50" id="color" name="color" value="{{$product->color}}">
                                    </div>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" {{$product->is_active==1 ? 'checked' : ''}}> <b>Display</b>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_hot" {{$product->is_hot==1 ? 'checked' : ''}}> <b>No Display</b>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">URL of Product: </label>
                                <input type="text" class="form-control" id="url" name="url" value="{{$product->url}}">
                            </div>
                            <div class="form-group">
                                <label>Summary of Product</label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" >{{$product->summary}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" >{{$product->description}}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="edit btn btn-primary">Update Now</button>
                            <a href="{{route('adminproducts.show',$product->id)}}"  class="btn btn-warning">Details about this Product</a>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title:</label>
                        <textarea name="meta_title" class="form-control" rows="3" >{{$product->meta_title}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description: </label>
                        <textarea name="meta_description" class="form-control" rows="5" >{{$product->meta_description}}</textarea>
                    </div>
                </div>
            </form>
            {{--        END FORM            --}}

        </div>
        <!-- /.row -->
    </section>
@endsection

@section('my_js')
    <script type="text/javascript">
        // hcdung
        $(document).ready(function() {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor1 = CKEDITOR.replace('summary');
            _ckeditor1.config.height = 200; // thiết lập chiều cao
            var _ckeditor2 = CKEDITOR.replace('description');
            _ckeditor2.config.height = 650; // thiết lập chiều cao
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/edit.js')}}"></script>

@endsection
