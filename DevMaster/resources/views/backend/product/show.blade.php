@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product Detail <a href="{{ route('adminproducts.index') }}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Products</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- FORM -->
            <form role="form" action="{{ route('adminproducts.update',$product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-9 col-lg-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Products Details</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name of Product: </label>
                                <input type="text" class="form-control"  value="{{$product->name}}" disabled>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <img src="{{asset($product->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Quantity: </label>
                                        <input style="width: 100px; " type="number" class="form-control" disabled value="{{$product->stock}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Price ($): </label>
                                        <input type="number" class="form-control"  value="{{$product->price}}"  disabled>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Price sale ($): </label>
                                        <input type="number" class="form-control" value="{{$product->sale}}" disabled>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category of Product: </label>
                                        <input type="text" class="form-control" disabled value="{{ $product->category->name }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Brand of Product: </label>
                                        <input type="text" class="form-control" disabled value="{{ $product->brand->name }}">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" disabled value="{{$product->position}}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Color: </label>
                                        <input type="text" class="form-control w-50" disabled value="{{$product->color}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Created at: </label>
                                        <input type="text" class="form-control w-50" disabled value="{{$product->created_at}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Updated at: </label>
                                        <input type="text" class="form-control w-50" disabled value="{{$product->updated_at}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">URL of Product: </label>
                                <input type="text" class="form-control" disabled value="{{$product->url}}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">User add: </label>
                                @foreach($user as $items)
                                    @if($items->id == $product->user_id)
                                     <input type="text" class="form-control" disabled value="{{$items->name}}">
                                    @endif
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label>Summary</label>
                                <textarea id="editor2" name="summary" class="form-control" disabled rows="10" >{!! $product->summary !!}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea id="editor1" name="description" class="form-control" disabled rows="10" >{!! $product->description!!}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('adminproducts.edit',$product->id)}}"  class="btn btn-primary">Update this Product</a>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title:</label>
                        <textarea name="meta_title" class="form-control" disabled rows="3" >{!! $product->meta_title !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description:</label>
                        <textarea name="meta_description" class="form-control" disabled rows="5" >{!! $product->meta_description !!}</textarea>
                    </div>
                </div>
            </form>
            <!-- END FORM -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('my_js')
    <script type="text/javascript">
        $(document).ready(function() {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor1 = CKEDITOR.replace('summary');
            _ckeditor1.config.height = 250; // thiết lập chiều cao
            var _ckeditor2 = CKEDITOR.replace('description');
            _ckeditor2.config.height = 250; // thiết lập chiều cao
        });
    </script>
@endsection


