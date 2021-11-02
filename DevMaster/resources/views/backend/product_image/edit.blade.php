@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Product Images
            <small><a href="{{route('adminproduct_images.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Product Images</a></small>
        </h1>

    </section>

    <!-- Main content -->
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
            {{--        END BẮT ERROR            --}}

            {{--        FORM            --}}
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Product Images</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminproduct_images.update',$product_images->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_id">Product (<span style="color: red;">*</span>):</label>
                                        <select name="product_id"  class="form-control" id="product_id">
                                           @foreach($lsProduct as $items)
                                                <option value="{{$items->id}}" {{$items->id==$product_images->product_id ? 'selected' : ''}}>{{$items->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Position:</label>
                                        <input type="number" class="form-control" name="position" id="position" value="{{$product_images->position}}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image:</label>
                                        <input type="file" name="image" id="image">
                                        <img src="{{asset($product_images->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url">URL:</label>
                                        <input type="text" class="form-control" name="url" id="url" value="{{$product_images->url}}">
                                    </div>
                                </div>


                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_active" value="1" {{$product_images->is_active==1 ? 'checked' : ''}}> Display
                                </label>
                            </div>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="edit btn btn-primary">Update Now</button>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            {{--        END FORM           --}}
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/edit.js')}}"></script>
@endsection
