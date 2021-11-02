@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Brand Information
            <small><a href="{{route('adminbrands.index')}}" class="btn btn-success"> <span class="glyphicon glyphicon-menu-hamburger"></span> List Brands</a></small>
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
                        <h3 class="box-title">Brand Update</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminbrands.update',$brands->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="box-body">

                            <div class="form-group">
                                <label for="name">Name of Brand (<span style="color: red;">*</span>):</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{$brands->name}}" >
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="web">Website of Brand:</label>
                                        <input type="text" class="form-control" name="website" id="web" value="{{$brands->website}}"  >
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="image">Logo:</label>
                                        <input type="file" name="image" id="image">
                                        {{--                                <p class="help-block">Vui lòng post logo thương hiệu!!</p>--}}
                                        <img src="{{asset($brands->image)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="position">Position:</label>
                                        <input type="number" class="form-control" name="position" id="position" min="1" value="{{$brands->position}}" >
                                    </div>
                                </div>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_active" value="1" {{$brands->is_active==1 ? 'checked' : ''}}> Display
                                </label>
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
            {{--        END FORM          --}}

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/edit.js')}}"></script>
@endsection
