@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product Images Information
            <small>Preview</small>
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
                        <h3 class="box-title">Add New Product Image</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminproduct_images.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_id">Product (<span style="color: red;">*</span>):</label>
                                        @if(isset($product_id))
                                            <select name="product_id" class="form-control" id="product_id">
                                                @foreach($lsProduct as $items)
                                                    <option value="{{$items->id}}" {{$items->id == $product_id ? 'selected' : ''}}>{{$items->name}}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="product_id"  class="form-control" id="product_id">
                                                <option value="0">-- choose Product --</option>
                                                @foreach($lsProduct as $items)
                                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image (<span style="color: red;">*</span>):</label>
                                        <input type="file" name="image" id="image">
                                        <p class="help-block">Let's post image for product now!!</p>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Position:</label>
                                        <input type="number" class="form-control" name="position" id="position" min="1" value="1" placeholder="Position...">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="url">URL:</label>
                                        <input type="text" class="form-control" name="url" id="url" placeholder="URL...">
                                    </div>
                                </div>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="is_active"> Display
                                </label>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create Now</button>

                            <input type="reset" class="btn btn-default pull-right" value="Reset">
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->

            </div>
            {{--        END FORM          --}}
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
