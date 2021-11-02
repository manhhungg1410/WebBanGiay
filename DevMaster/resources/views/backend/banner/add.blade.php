@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Banner Information
            <small>Preview</small>
            <a href="{{ route('adminbanner.index') }}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Banners</a>
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
            <form role="form" action="{{ route('adminbanner.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-12 col-lg-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add New Banner</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title of Banner (<span style="color: red">*</span>): </label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title of Banner..">
                            </div>
                    </div>
                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image: </label>
                                        <input type="file"  id="image" name="image">
                                    </div>
                    </div>
                </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">URL: </label>
                                        <input type="text" class="form-control" id="url" name="url" placeholder="URL of Banner...">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Target: </label>
                                        <select class="form-control w-50" name="target">
                                            <option value="_blank">_blank</option>
                                            <option value="_self">_self</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Type: </label>
                                        <select class="form-control w-50" name="type">
                                            <option value="0">Slide</option>
                                            <option value="1">Trái</option>
                                            <option value="2">Phải</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Position: </label>
                                        <input type="number" class="form-control w-50" id="position" name="position" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" checked> <b>Display</b>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" ></textarea>
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
                </div>
            </form>
            {{--        END ERROR            --}}
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
