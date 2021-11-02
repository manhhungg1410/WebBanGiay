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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New User</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminuser.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">



                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name">User Name (<span style="color: red">*</span>):</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="User Name...">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="role_id">Role (<span style="color: red">*</span>):</label>
                                        <select name="role_id"  class="form-control" id="role_id">
                                            <option value="0">-- choose Role --</option>
                                           @foreach($lsRole as $items)
                                                <option value="{{$items->id}}">{{$items->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="avatar">Avatar:</label>
                                        <input type="file" name="avatar" id="avatar">
                                        <p class="help-block">Let's post avatar!!</p>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Email (<span style="color: red">*</span>): </label>
                                        <input type="email" class="form-control" name="email" id="email"  placeholder="Nhập vào email">
                                    </div>
                                </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Password (<span style="color: red">*</span>): </label>
                                        <input type="password" class="form-control" name="password" id="password"  placeholder="Password...">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position">Confirm Password (<span style="color: red">*</span>): </label>
                                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  placeholder="Confirm Password...">
                                    </div>
                                </div>

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
            {{--        END FORM            --}}
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

@endsection
