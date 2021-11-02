@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Role Information
            <small>Preview</small>
            <a href="{{ route('adminrole.index') }}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Roles</a>
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
            <form role="form" action="{{ route('adminrole.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-6 col-lg-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add New Role</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name: </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name Role...">
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


            </form>
            {{--        END FORM           --}}
        </div>
        <!-- /.row -->
    </section>
@endsection


