@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Role Information
            <small>Preview</small>
            <a href="{{ route('adminrole.index') }}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Role</a>
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
            {{--        END BẮT ERROR            --}}

            {{--        FORM           --}}
            <form role="form" action="{{ route('adminrole.update',$role->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-md-6 col-lg-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Update Role</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$role->name}}">
                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="edit btn btn-primary">Update Now</button>
                            <a href="javascript:history.go(-1)" class="btn btn-default pull-right">Back</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>


            </form>
            {{--        END FORM           --}}
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/edit.js')}}"></script>
@endsection


