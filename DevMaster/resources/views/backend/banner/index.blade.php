@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Banners Management
            <small>Banner in Website.</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Banners</h3>
                        <a href="{{route('adminbanner.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Banner</a>
                        {{--        SEARCH RECORD            --}}
                            <div class="box-tools">
                            <form action="{{route('adminbanner.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                                <select class="form-control" name="is_active">
                                                    <option value="-">All</option>
                                                    <option value="0" {{$is_active==0?'selected':''}}>No Display</option>
                                                    <option value="1" {{$is_active==1?'selected':''}}>Display</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                                <select class="form-control" name="type">
                                                    <option value="-">All</option>
                                                    <option value="0" {{$type==0?'selected':''}}>Slide</option>
                                                    <option value="1" {{$type==1?'selected':''}}>Trái</option>
                                                    <option value="2" {{$type==2?'selected':''}}>Phải</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 form-group">
                                                <button type="submit" class="btn btn-info wrn-btn"><span class="glyphicon glyphicon-search"></span> Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--        END SEARCH RECORD            --}}
                    </div>

                    @include('sweetalert::alert')

                    {{--        BẢNG RECORD            --}}
                    <form id="idForm" action="{{route('admindeleteBanners')}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete all selected</button>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th><input type="checkbox" id="check" name="check"></th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Position</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                    @foreach($lsBanner as $items)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="checkDelete" name="checkDelete[]" value="{{$items->id}}">
                                            </td>
                                            <td>{{$items->id}}</td>
                                            <td>{{$items->title}}</td>
                                            <td>{{$items->slug}}</td>
                                            <td>
                                                <img width="80" src="{{asset($items->image)}}" alt="">
                                            </td>
                                            <td>{{$items->position}}</td>
                                            <td>
                                                @if($items->type == 0)
                                                    Slide
                                                    @elseif($items->type == 1)
                                                    Trái
                                                    @else Phải
                                                    @endif
                                            </td>
                                            <td>
                                                @if($items->is_active==1)
                                                    <span style="color: green">Display</span>
                                                @else
                                                    <span style="color: red">No Display</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('adminbanner.show',$items->id)}}"  class="size btn btn-warning"><span class="glyphicon glyphicon-th-list"></span> Details</a>
                                                <a class="size btn btn-primary" href="{{route('adminbanner.edit',$items->id)}}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>
                    </form>
                    {{--       HẾT BẢNG RECORD            --}}

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        {{--  PHÂN TRANG   --}}
        <div style="text-align: center">
            {{$lsBanner->appends(['is_active'=>$is_active,'type'=>$type])->links("pagination::bootstrap-4")}}
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
@section('my_css')
    <style>
        .size{
            width: 100px;
        }
    </style>
@endsection
@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('backend/admin/js/delete_ajax.js')}}"></script>
@endsection

