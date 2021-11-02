@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Product Images Management
            <small>List Product Images.</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    {{--        TIÊU ĐỀ TRANG            --}}
                    <div class="box-header">
                        <h3 class="box-title">List Product Images in Website</h3>
                        <a href="{{route('adminproduct_images.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Product Image</a>
                        @if(count($lsDifferent)>0)
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalScrollable">
                                <span class="glyphicon glyphicon-eye-open"></span> Attention
                            </button>
                        @endif
                        {{--        SEARCH                --}}
                        <div class="box-tools">
                            <form action="{{route('adminproduct_images.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Search by name">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                <select class="form-control" name="is_active">
                                                    <option value="-">All</option>
                                                    <option value="0" {{$is_active==0 ? 'selected' : ''}}>No Display</option>
                                                    <option value="1" {{$is_active==1 ? 'selected' : ''}}>Display</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                <button type="submit" class="btn btn-info wrn-btn"><span class="glyphicon glyphicon-search"></span> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--        END SEARCH                --}}
                    </div>
                    {{--        END            --}}

                    {{--          HẾT THÔNG BÁO TRANG          --}}
                    @include('sweetalert::alert')
                    {{--         HẾT THÔNG BÁO TRANG          --}}

                    {{--          THÔNG BÁO SỐ LƯỢNG SẢN PHẨM CHƯA ĐƯỢC THÊM ẢNH         --}}
                        <!-- Button trigger modal -->


                        <!-- Modal -->
                    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalScrollableTitle">Products don't have images.</h2>
                                </div>
                                <div class="modal-body">

                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-hover">
                                            <tr>
                                                <th>ID Product</th>
                                                <th>Name of Product</th>
                                                <th>Main Image</th>
                                                <th>Action</th>
                                            </tr>
                                            @foreach($lsDifferent as $items)
                                                <tr>
                                                    <form action="{{route('adminproduct_images.create')}}" method="get">
                                                        @csrf
                                                        <td><input class="ok" type="text" name="product_id" value="{{$items->id}}" readonly></td>
                                                        <td>{{$items->name}}</td>
                                                        <td>
                                                            <img src="{{asset($items->image)}}" alt="" width="80">
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Now</button>
                                                        </td>
                                                    </form>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Confirm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--        HẾT THÔNG BÁO SỐ LƯỢNG SẢN PHẨM CHƯA ĐƯỢC THÊM ẢNH         --}}

                    {{--          BẢNG RECORD         --}}
                        <!-- /.box-header -->
                        <form id="idForm" action="{{route('admindeleteProductImage')}}" method="get">
                            @csrf
                            @method('DELETE')
                            @can('admin_manager')
                            <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete all selected</button>
                            @endcan
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    @can('admin_manager')
                                    <th><input type="checkbox" id="check" name="check"></th>
                                    @endcan
                                    <th>ID</th>
                                    <th>Name of Product</th>
                                    <th>Image</th>
                                    <th>URL</th>
                                    <th>Position</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($lsProductImage as $items)
                                    <tr>
                                        @can('admin_manager')
                                        <td>
                                            <input type="checkbox" class="checkDelete" name="checkDelete[]" value="{{$items->id}}">
                                        </td>
                                        @endcan
                                        <td>{{$items->id}}</td>
                                        <td>{{$items->product->name}}</td>
                                        <td>
                                            <img width="80" src="{{asset($items->image)}}" alt="">
                                        </td>
                                        <td>{{$items->url}}</td>
                                        <td>{{$items->position}}</td>
                                        <td>
                                            @if($items->is_active==1)
                                                <span style="color: green">Display</span>
                                            @else
                                                <span style="color: red">No Display</span>
                                            @endif
                                        </td>
                                        <td>{{$items->created_at}}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{route('adminproduct_images.edit',$items->id)}}"> <span class="glyphicon glyphicon-edit"></span> Edit</a>

    {{--                                        <form action="{{route('adminproduct_images.destroy',$items->id)}}" method="post">--}}
    {{--                                            @csrf--}}
    {{--                                            @method('DELETE')--}}
    {{--                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn chắc chắn khóa')">Xóa</button>--}}
    {{--                                        </form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </form>
                     {{--         HẾT BẢNG RECORD           --}}
                </div>
                <!-- /.box -->
            </div>
        </div>
        {{--   PHÂN TRANG     --}}
        <div style="text-align: center">
            {{$lsProductImage->appends(['name'=>$name,'is_active'=>$is_active])->links("pagination::bootstrap-4")}}
        </div>
        {{--  HẾT PHÂN TRANG     --}}
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
        .ok{
            background-color: white;
            border: none;
           width: 80px;
            padding-left: 30px;
            cursor: pointer;
        }

    </style>
@endsection

