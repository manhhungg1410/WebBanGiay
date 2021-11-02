@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Users Management
            <small>Users in Website.</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Users</h3>
                        @can('admin')
                        <a href="{{route('adminuser.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New User</a>
                        @endcan
                        <a href="{{route('adminrole.index')}}" class="btn btn-warning "><span class="glyphicon glyphicon-eye-open"></span> List Roles</a>

                        {{--        SEARCH                --}}
                        <div class="box-tools">
                            <form action="{{route('adminuser.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                <input type="text" class="form-control" name="name" value="{{$name}}" placeholder="Search by name">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                <select class="form-control" name="role_id">
                                                    <option value="-">All</option>
                                                    @foreach($lsRole as $items)
                                                        <option value="{{$items->id}}" {{$items->id==$role_id?'selected':''}}>{{$items->name}}</option>
                                                    @endforeach
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


                    @include('sweetalert::alert')

                    {{--        BẢNG RECORD            --}}
                    <form id="idForm" action="{{route('admindeleteUsers')}}" method="get">
                    @csrf
                    @method('DELETE')
                    <!-- /.box-header -->
                        @can('admin')
                        <button type="submit"  class="delete btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete all selected</button>
                        @endcan
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    @can('admin_manager')
                                    <th><input type="checkbox" id="check" name="check"></th>
                                    @endcan
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Avatar</th>
                                    <th>Email</th>
                                    <th>Created_at</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    @can('admin_manager')
                                    <td></td>
                                        @endcan
                                    <td>{{Auth::user()->id}}</td>
                                    <td>{{Auth::user()->name}}</td>
                                    <td><img width="80" src="{{asset(Auth::user()->avatar)}}" ></td>
                                    <td>{{Auth::user()->email}}</td>
                                    <td>{{Auth::user()->created_at}}</td>
                                    <td>{{Auth::user()->role->name}}</td>
                                    <td>
                                            <a  href="{{route('adminuser.show',Auth::user()->id)}}"  class="size btn btn-warning"><span class="glyphicon glyphicon-th-list"></span> Details</a>
                                        <a href="{{route('adminchange_pass',Auth::user()->id)}}" class="size btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Change Password</a>
                                    </td>
                                </tr>
                                @foreach($lsUser as $items)
                                    @if($items->id!=Auth::user()->id)
                                    <tr>
                                        @can('admin_manager')
                                        <td>
                                            @if($items->id != Auth::user()->id)
                                            <input type="checkbox" class="checkDelete" name="checkDelete[]" value="{{$items->id}}">
                                                @endif
                                        </td>
                                        @endcan
                                        <td>{{$items->id}}</td>
                                        <td>{{$items->name}}</td>

                                        <td>
                                            <img width="80" src="{{asset($items->avatar)}}" >
                                        </td>
                                        <td>{{$items->email}}</td>
                                        <td>
                                          {{$items->created_at}}
                                        </td>
                                        <td>
                                            {{$items->role->name}}
                                        </td>
                                        <td>
                                                <a  href="{{route('adminuser.show',$items->id)}}"  class="size btn btn-warning"><span class="glyphicon glyphicon-th-list"></span> Details</a>
                                            @can('admin')
                                                <a href="{{route('adminuser.edit',$items->id)}}"  class="size btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                                @endcan

                                        </td>
                                    </tr>
                                    @endif
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
            {{$lsUser->appends(['name'=>$name,'role_id'=>$role_id])->links("pagination::bootstrap-4")}}
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
