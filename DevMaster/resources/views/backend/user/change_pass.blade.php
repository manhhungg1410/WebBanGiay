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
                        <h3 class="box-title">Update new password for <b>{{$user->name}}</b></h3>
                    </div>
                @include('sweetalert::alert')
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('adminconfirm_change',$user->id)}}" >
                        @csrf
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Current Password (<span style="color:red;">*</span>)</label>
                                        <input class="form-control" type="password" name="current_password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">New Password (<span style="color:red;">*</span>)</label>
                                        <input class="form-control" id="toggle_password" type="password" name="password" > <span toggle="#toggle_password" class="show js_show fa fa-fw fa-eye"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Confirm New Password (<span style="color:red;">*</span>)</label>
                                        <input class="form-control" id="toggle_confirm" type="password" name="confirm_password"> <span toggle="#toggle_confirm" class="show confirm_pass fa fa-fw fa-eye"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="edit btn btn-primary">Change Password</button>
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
    <script>
        $(function (){
           $('.js_show').click(function (){
               $(this).toggleClass("fa-eye fa-eye-slash");
            //   $(this).toggleClass("glyphicon glyphicon-warning-sign");
               let x = document.getElementById('toggle_password');
               if(x.type==='password'){
                   x.type='text';
               }else{
                   x.type='password';
               }
           }) ;

           $('.confirm_pass').click(function(){
               $(this).toggleClass("fa-eye fa-eye-slash");
               let x = document.getElementById('toggle_confirm');
               if(x.type==='password'){
                   x.type='text';
               }else x.type='password';
           });
        });
    </script>
@endsection
@section('my_css')

    <style>
        .show{
            float: right;
            margin-left: -50px;
            margin-top: -25px;
            cursor: pointer;
        }
    </style>
@endsection

