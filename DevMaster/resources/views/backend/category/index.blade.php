@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories Management
            <small>Categories in Website.</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Categories in Website</h3>
                        <a href="{{route('admincategories.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Category</a>

                        {{--        SEARCH                --}}
                        <div class="box-tools">
                            <form action="{{route('admincategories.index')}}" method="get">
                            <div class="d-flex justify-content-center h-100">
                                <div class="searchbar">
                                    <input class="search_input" type="text" name="name" id="name" placeholder="Search by name" value="{{$name}}">
                                   <button type="submit" class="search_icon"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                        {{--        END SEARCH                --}}
                    </div>

                    @include('sweetalert::alert')

                    {{--        BẢNG RECORD            --}}
                    <form id="idForm" action="{{route('admindeleteCategory')}}">
                    @csrf
{{--                    @method('DELETE')--}}
                    <!-- /.box-header -->
                    <button type="submit"  class="delete btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete all selected</button>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th><input type="checkbox" id="check" name="check"></th>
                                <th>ID</th>
                                <th>Name of Category</th>
                                <th>Slug</th>
                                <th>Logo</th>
                                <th>Parent Category</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @foreach($lsCategories as $items)
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkDelete" name="checkDelete[]" value="{{$items->id}}">
                                </td>
                                <td>{{$items->id}}</td>
                                <td>{{$items->name}}</td>
                                <td>{{$items->slug}}</td>
                                <td>
                                    <img width="80" src="{{asset($items->image)}}" alt="">
                                </td>
                                <td>
                                    <?php
                                            $check = true;
                                     ?>
                                    @foreach($lsFull as $items2)
                                        @if($items->parent_id == $items2->id)
                                                {{$items2->name}}
                                            <?php
                                                $check = false;
                                            ?>
                                            @endif
                                    @endforeach
                                <?php
                                    if($check == true) echo "<span>Nothing</span>"
                               ?>
                                </td>
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
                                    <a class="btn btn-primary" href="{{route('admincategories.edit',$items->id)}}"><span class="glyphicon glyphicon-edit"></span> Edit</a>

{{--                                    <form action="{{route('admincategories.destroy',$items->id)}}" method="post">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn chắc chắn khóa')">Xóa</button>--}}
{{--                                    </form>--}}
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
        {{$lsCategories->appends(['name'=>$name])->links("pagination::bootstrap-4")}}
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
    </style>
@endsection
