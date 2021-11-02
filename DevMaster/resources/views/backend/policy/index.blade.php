@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Policies Management
            <small>All Policies in Website.</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Policies</h3>
                        <a href="{{route('adminpolicies.create')}}" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add New Policy</a>
                    </div>

                @include('sweetalert::alert')

                {{--        BẢNG RECORD            --}}
                <!-- Modal -->

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Action</th>

                            </tr>
                            @foreach($lsPolicies as $items)
                                <tr>
                                    <td>{{$items->id}}</td>
                                    <td>{{$items->name}}</td>
                                    <td>
                                        @if($items->is_active == 0)
                                            <span style="color:red;">Not Display</span>
                                        @else
                                            <span style="color:green;">Display</span>
                                        @endif
                                    </td>
                                    <td>{{$items->created_at}}</td>
                                    <td>

                                    @can('admin_manager')
                                        <!-- Button trigger modal -->
                                            <a class="size btn btn-primary" href="{{route('adminpolicies.edit',$items->id)}}"> <span class="glyphicon glyphicon-edit"></span> Edit</a>

                                            <a class="delete btn btn-danger"
                                               data-url="{{route('admindeletePolicy',$items->id)}}"><span class="glyphicon glyphicon-trash"></span> Delete
                                            </a>
                                        @endcan

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
            {{$lsPolicies->links("pagination::bootstrap-4")}}
        </div>
        {{--  HẾT PHÂN TRANG   --}}


    </section>
    <!-- /.content -->
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
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'GET',
                            url: urlRequest,
                            success: function (data) {
                                console.log(data);
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
