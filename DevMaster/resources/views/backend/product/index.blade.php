@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Products Management
            <small>All Products in  Website.</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Products in Website</h3>
                        <a href="{{route('adminproducts.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Product</a>
                        {{--SEARCH--}}
                            <div class="box-tools">
                            <form action="{{route('adminproducts.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Search by name">
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <select class="form-control" name="is_active">
                                                    <option value="-">All</option>
                                                    <option value="0"
                                                        {{$is_active==0?'selected':''}}>No Display</option>
                                                    <option value="1"
                                                        {{$is_active==1?'selected':''}}>Display</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <select class="form-control" name="is_hot">
                                                    <option value="-">All</option>
                                                    <option value="0"
                                                        {{$is_hot==0?'selected':''}}>No Hot</option>
                                                    <option value="1"
                                                        {{$is_hot==1?'selected':''}}>Hot</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                                <button type="submit" class="btn btn-info wrn-btn"><span class="glyphicon glyphicon-search"></span> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--END SEARCH--}}
                    </div>
                    {{--THÔNG BÁO TRANG--}}
                    @include('sweetalert::alert')
                    {{--HẾT THÔNG BÁO TRANG--}}

                    {{--BẢNG RECORD--}}
                    <form id="idForm" action="{{route('admindeleteProduct')}}" method="get">
                    @csrf
                    @method('DELETE')
                        @can('admin_manager')
                        <button type="submit"  class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete all selected</button>
                        @endcan
                <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                @can('admin_manager')
                                <th><input type="checkbox" id="check" name="check"></th>
                                @endcan
                                <th>ID</th>
                                <th>Name of Product</th>
                                <th>Slug</th>
                                <th>Image Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Is Hot?</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            @if(!empty($lsProduct))
                            @foreach($lsProduct as $items)
                                <tr>
                                    @can('admin_manager')
                                    <td>
                                        <input type="checkbox" class="checkDelete" name="checkDelete[]" value="{{$items->id}}">
                                    </td>
                                    @endcan
                                    <td>{{$items->id}}</td>
                                    <td>{{$items->name}}</td>
                                    <td>{{$items->slug}}</td>
                                    <td>
                                        <img width="80" src="{{asset($items->image)}}" alt="">
                                    </td>
                                    <td>{{$items->stock}}</td>
                                    <td>{{$items->price}}</td>
                                    <td>{{$items->sale}}</td>
                                    <td>{{$items->position}}</td>
                                    <td>
                                        @if($items->is_active==1)
                                            <span style="color: green">Display</span>
                                        @else
                                            <span style="color: red">No Display</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($items->is_hot==1)
                                            <span style="color: green">Hot</span>
                                        @else
                                            <span style="color: red">No Hot</span>
                                        @endif
                                    </td>
                                    <td>{{$items->category->name}}</td>
                                    <td>
                                        <a href="{{route('adminproducts.show',$items->id)}}"  class="size btn btn-warning"><span class="glyphicon glyphicon-th-list"></span> Details</a>
                                        <a class="size btn btn-primary" href="{{route('adminproducts.edit',$items->id)}}"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                                        <a href="{{route('adminadd_images',$items->id)}}" class="btn btn-success" style="width: 205px"><span class="glyphicon glyphicon-plus"></span> Add Images for this product</a>
                                    </td>
                                </tr>
                            @endforeach
                                @endif
                        </table>
                    </div>
                    </form>
                    {{--HẾT BẢNG RECORD--}}
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        {{--  PHÂN TRANG   --}}
        <div style="text-align: center">
            {{$lsProduct->appends(['name'=>$name,'is_active'=>$is_active,'is_hot'=>$is_hot])->links("pagination::bootstrap-4")}}
        </div>
        {{--  HẾT PHÂN TRANG   --}}
    </section>
    <!-- /.content -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"> </script>
    <script>
        $("#check").click(function () {
            $('.checkDelete').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/delete_ajax.js')}}"></script>
@endsection
@section('my_css')
    <style>
        .size{
            width: 100px;
        }
    </style>
@endsection

