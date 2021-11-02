@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Article Information
            <a href="{{route('adminarticles.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Article</a>
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
            <form role="form" action="{{route('adminarticles.update',$article->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-9 col-lg-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Article</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Title of Article (<span style="color: red">*</span>): </label>
                                <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}">
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image: </label>
                                        <input type="file" class="" id="image" name="image">
                                        <img src="{{asset($article->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type: </label>
                                        <select class="form-control w-50" name="type">
                                            <option value="1" {{$article->type==1?'selected':''}}>Tin tức</option>
                                            <option value="2" {{$article->type==2?'selected':''}}>Tin khuyến mại</option>
                                            <option value="3" {{$article->type==3?'selected':''}}>Tin nổi bật</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" id="position" name="position" value="{{$article->position}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">URL: </label>
                                <input type="text" class="form-control" id="url" name="url" value="{{$article->url}}">
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" {{$article->is_active==1 ? 'checked' : ''}}> <b>Hiển Thị</b>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Summary: </label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" >{{$article->summary}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" >{{$article->description}}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="edit btn btn-primary">Update Now</button>
                            <a href="{{route('adminarticles.show',$article->id)}}"  class="btn btn-warning">Details about this Article</a>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title: </label>
                        <textarea name="meta_title" class="form-control" rows="3" >{{$article->meta_title}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description: </label>
                        <textarea name="meta_description" class="form-control" rows="5" >{{$article->meta_description}}</textarea>
                    </div>
                </div>
            </form>
            {{--        END FORM           --}}
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
