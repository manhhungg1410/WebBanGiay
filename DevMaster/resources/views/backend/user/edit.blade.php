@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Information
            <small>Preview</small>
            <small><a href="{{route('adminuser.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Users</a></small>
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

            {{--        FORM            --}}
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Update Role User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminrole_change',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">

                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role_id">Role: (<span style="color:red;">Bạn chỉ được sửa mục này</span>)</label>
                                        <select name="role_id"  class="form-control" id="role_id">
                                            @foreach($lsRole as $items)
                                            <option value="{{$items->id}}" {{$user->role_id==$items->id?'selected':''}}>{{$items->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


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
            {{--        END FORM            --}}
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection

@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/edit.js')}}"></script>
@endsection
