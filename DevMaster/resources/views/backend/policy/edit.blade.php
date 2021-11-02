@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Policy Information
            <small>Preview</small>
            <small><a href="{{route('adminpolicies.index')}}" class="btn btn-success"> <span class="glyphicon glyphicon-menu-hamburger"></span> List Policies</a></small>
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
            {{--       END BẮT ERROR            --}}

            {{--        FORM           --}}
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Policy</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminpolicies.update',$policy->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Name of Policy (<span style="color: red;">*</span>):</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$policy->name}}">
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active" {{$policy->is_active==1?'checked':''}}> <b>Display</b>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Description: </label>
                                <textarea id="editor1" name="description" class="form-control" rows="10" >{!! $policy->description !!}</textarea>
                            </div>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="edit btn btn-primary">Update Now</button>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>

                    </form>

                </div>
                <!-- /.box -->

            </div>
            {{--       END FORM           --}}

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

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
