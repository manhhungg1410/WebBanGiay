@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Article Information
            <small>Preview</small>
            <a href="{{route('adminarticles.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Articles</a>
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
            {{--        END BẮT ERROR             --}}

            {{--        FORM         --}}
            <form role="form" action="{{route('adminarticles.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-9 col-lg-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add New Article</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="form-group">
                                <label for="title">Title of Article (<span style="color: red">*</span>): </label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Name of Article...">
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image">Image: </label>
                                        <input type="file" class="" id="image" name="image">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Type (<span style="color: red">*</span>): </label>
                                        <select class="form-control w-50" name="type">
                                            <option value="0">-- choose Type --</option>
                                            <option value="1">Tin tức</option>
                                            <option value="2">Tin khuyến mại</option>
                                            <option value="3">Tin nổi bật</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" id="position" name="position" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">URL: </label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="Nhập vào url">
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" checked> <b>Display</b>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Summary: </label>
                                <textarea id="editor2" name="summary" class="form-control" rows="10" ></textarea>
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" ></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Create Now</button>
                            <input type="reset" class="btn btn-default pull-right" value="Reset">
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Meta Title: </label>
                        <textarea name="meta_title" class="form-control" rows="3" ></textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta Description: </label>
                        <textarea name="meta_description" class="form-control" rows="5" ></textarea>
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
@endsection
