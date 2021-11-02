@extends('backend.layout.index')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Role Management
            <small>Role in Website.</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Role</h3>
                        @can('admin')
                        <a href="{{route('adminrole.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Role</a>
                        @endcan
                        <a href="{{route('adminuser.index')}}" class="btn btn-warning"><span class="glyphicon glyphicon-menu-hamburger"></span> List User</a>


                    </div>

                    @include('sweetalert::alert')

                    {{--        BẢNG RECORD            --}}

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Created_at</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($lsRole as $items)
                                    <tr>

                                        <td>{{$items->id}}</td>
                                        <td>{{$items->name}}</td>
                                        <td>{{$items->created_at}}</td>
                                        <td>
                                            @can('admin')
                                            <a class="btn btn-primary" href="{{route('adminrole.edit',$items->id)}}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                                            <a class="delete btn btn-danger"
                                               data-url="{{route('admindelete_role',$items->id)}}"><span class="glyphicon glyphicon-trash"></span> Delete
                                            </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                {{--       HẾT BẢNG RECORD            --}}
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

        {{--  PHÂN TRANG   --}}
        <div style="text-align: center">
            {{$lsRole->links("pagination::bootstrap-4")}}
        </div>
        {{--  HẾT PHÂN TRANG   --}}

    </section>

@endsection
@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){
            $('.delete').click(function () {
                let urlRequest = $(this).data('url');
                let that = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'GET',
                            url: urlRequest,
                            success: function (data) {
                                if (data.code == 200) {
                                    that.parent().parent().remove();
                                }
                            },
                            error: function () {

                            }
                        });
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                });
            });
        });


    </script>
@endsection

