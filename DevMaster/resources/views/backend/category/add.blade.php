@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Category Information
            <small>Preview</small>
            <small><a href="{{route('admincategories.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Categories</a></small>
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
                        <h3 class="box-title">Add New Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" method="post" action="{{route('admincategories.store')}}" enctype="multipart/form-data">
                        @csrf
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="name">Name of Category(<span style="color: red;">*</span>):</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name of Category...">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="parent_id">Parent Category(<span style="color: red;">*</span>):</label>
                                            <select name="parent_id"  class="form-control" id="parent_id">
                                                <option value="0">-- choose Parent id --</option>
                                                @foreach($lsCategories as $items)
                                                    <option value="{{$items->id}}">{{$items->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image">Logo of Category:</label>
                                            <input type="file" name="image" id="image">
                                            <p class="help-block">Let's post logo of Category!!</p>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="position">Position:</label>
                                            <input type="number" class="form-control" name="position" id="position" min="1" value="1" placeholder="Nhập vào vị trí">
                                        </div>
                                    </div>

                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="is_active"> Display
                                    </label>
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
