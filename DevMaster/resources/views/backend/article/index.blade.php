@extends('backend.layout.index')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Articles Management
            <small>All Articles in Website.</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Articles</h3>
                        <a href="{{route('adminarticles.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span>Add New Article</a>

                        {{--        SEARCH                --}}
                        <div class="box-tools">
                            <form action="{{route('adminarticles.index')}}" method="get">
                                <div class="d-flex justify-content-center h-100">
                                    <div class="searchbar">
                                        <input class="search_input" type="text" name="title" id="title" placeholder="Search by title" value="{{$title}}">
                                        <button type="submit" class="search_icon"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--        END SEARCH                --}}
                    </div>

                    @include('sweetalert::alert')
                    {{--        BẢNG RECORD            --}}
                    <form id="idForm" action="{{route('admindeleteArticle')}}" method="get">
                        @csrf
                        @method('DELETE')
                        <button type="submit"  class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete all selected</button>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th><input type="checkbox" id="check" name="check"></th>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>URL</th>
                                    <th>Type</th>
                                    <th>Position</th>
                                    <th>User Add</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @if(!empty($lsArticle))
                                    @foreach($lsArticle as $items)
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
                                            <td>{{$items->url}}</td>
                                            <td>
                                                @if($items->type==1)  Tin tức
                                                @elseif($items->type==2) Tin khuyến mại
                                                @else Tin nổi bật
                                                @endif
                                            </td>
                                            <td>{{$items->position}}</td>
                                            <td>
                                                {{$items->user->name}}
                                            </td>
                                            <td>
                                                @if($items->is_active==1)
                                                    <span style="color: green">Display</span>
                                                @else
                                                    <span style="color: red">No Display</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{route('adminarticles.show',$items->id)}}"  class="size btn btn-warning"><span class="glyphicon glyphicon-th-list"></span> Details</a>
                                                <a class="size btn btn-primary" href="{{route('adminarticles.edit',$items->id)}}"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </form>
                    {{--       HẾT BẢNG RECORD            --}}
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        {{--PHÂN TRANG--}}
        <div style="text-align: center">
            {{$lsArticle->appends(['title'=>$title])->links("pagination::bootstrap-4")}}
        </div>
        {{--HẾT PHÂN TRANG--}}
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
        body,html{
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            background: #e74c3c !important;
        }

        .searchbar{
            margin-bottom: auto;
            margin-top: auto;
            height: 60px;
            background-color: #EEEEEE;
            border-radius: 30px;
            padding: 10px;
        }

        .search_input{
            color: black;
            border: 0;
            outline: 0;
            background: none;
            width: 0;
            caret-color:transparent;
            line-height: 40px;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_input{
            padding: 0 10px;
            width: 450px;
            caret-color:red;
            transition: width 0.4s linear;
        }

        .searchbar:hover > .search_icon{
            background: white;
            color: #e74c3c;
        }

        .search_icon{
            height: 40px;
            width: 40px;
            float: right;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color:black;
            text-decoration:none;
        }

        .size{
            width: 100px;
        }
    </style>
@endsection
