@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Details Banner <a href="{{ route('adminbanner.index') }}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Banners</a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- FORM -->
                <div class="col-md-12 col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Details Banner</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title of Banner: </label>
                                        <input type="text" class="form-control" id="title" name="title" disabled value="{{$banner->title}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image: </label>
                                        <img src="{{asset($banner->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">URL: </label>
                                        <input type="text" class="form-control" disabled id="url" name="url" value="{{$banner->url}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Target: </label>
                                        <input type="text" class="form-control" disabled value="{{$banner->target}}">
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Type: </label>
                                        <select class="form-control w-50" disabled name="type">
                                            <option value="0" {{$banner->type==0?'selected':''}}>Slide</option>
                                            <option value="1" {{$banner->type==1?'selected':''}}>Trái</option>
                                            <option value="2" {{$banner->type==2?'selected':''}}>Phải</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" id="position" disabled name="position" value="{{$banner->position}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Created at: </label>
                                        <input  class="form-control w-50" disabled  value="{{$banner->created_at}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Updated at: </label>
                                        <input class="form-control w-50"  disabled  value="{{$banner->updated_at}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea id="editor1" name="description" disabled class="form-control" rows="10" >{{$banner->description}}</textarea>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <a href="{{route('adminbanner.edit',$banner->id)}}"  class="btn btn-primary">Update this Banner</a>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
            <!-- END FORM -->
        </div>
        <!-- /.row -->
    </section>
@endsection

@section('my_js')
    <script type="text/javascript">
        // hcdung
        $(document).ready(function() {
            // setup textarea sử dụng plugin CKeditor
            var _ckeditor2 = CKEDITOR.replace('description');
            _ckeditor2.config.height = 650; // thiết lập chiều cao
        });
    </script>
@endsection
