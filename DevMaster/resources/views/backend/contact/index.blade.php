@extends('backend.layout.index')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Contacts Management
            <small>All Contacts in Website.</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Contacts</h3>
                        {{--        SEARCH                --}}
                        <div class="box-tools">
                            <form action="{{route('admincontacts.index')}}" method="get">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-12 p-0">
                                                <select class="form-control" name="status">
                                                    <option value="-">All</option>
                                                    <option value="0" {{$status==0?'selected':''}}>Not Answer</option>
                                                    <option value="1" {{$status==1?'selected':''}}>Answer</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                <button type="submit" class="btn btn-info wrn-btn"><span class="glyphicon glyphicon-search"></span></button>
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
                <!-- Modal -->

                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>User Name</th>
                                    <th>Phone</th>
                                    <th>Content</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>

                                </tr>
                                @foreach($lsContact as $items)
                                    <tr>
                                        <td>{{$items->id}}</td>
                                        <td>{{$items->email}}</td>
                                        <td>{{$items->name}}</td>
                                        <td>{{$items->phone}}</td>
                                        <td>{{$items->content}}</td>
                                        <td>
                                            @if($items->status == 0)
                                                <span style="color:red;">Not Answered</span>
                                            @else
                                                <span style="color:green;">Answered</span>
                                            @endif
                                        </td>
                                        <td>{{$items->created_at}}</td>
                                        <td>

                                            @can('admin_manager')
                                                <!-- Button trigger modal -->
                                                    <a class="submitform btn btn-success">
                                                        <span class="glyphicon glyphicon-envelope"></span> Reply
                                                    </a>

                                            <a class="delete btn btn-danger"
                                               data-url="{{route('admindeleteContact',$items->id)}}"><span class="glyphicon glyphicon-trash"></span> Delete
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
                <div class="modal fade" id="formSend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="exampleModalLabel">Send Email for Guest</h2>
                            </div>
                            <form id="formSubmit">
                                @csrf
                                <div class="modal-body">

                                    <input type="hidden" class="form-control" id="id"   name="id" readonly>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email: </label>
                                        <input type="email" class="form-control" id="email"  readonly name="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Question: </label>
                                        <textarea class="form-control" readonly id="question" name="question" cols="30" rows="5"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Answer: </label>
                                        <textarea class="form-control" id="msg" name="msg" cols="30" rows="10"></textarea>
                                    </div>

                                    <style>
                                        .loader {
                                            border: 16px solid #f3f3f3;
                                            border-radius: 50%;
                                            border-top: 16px solid blue;
                                            border-bottom: 16px solid blue;
                                            width: 70px;
                                            height: 70px;
                                            -webkit-animation: spin 2s linear infinite;
                                            animation: spin 2s linear infinite;
                                            display: none;
                                        }

                                        .ok{
                                            padding-left: 45%;
                                        }

                                        @-webkit-keyframes spin {
                                            0% { -webkit-transform: rotate(0deg); }
                                            100% { -webkit-transform: rotate(360deg); }
                                        }

                                        @keyframes spin {
                                            0% { transform: rotate(0deg); }
                                            100% { transform: rotate(360deg); }
                                        }
                                    </style>
                                    <div class="row ok">
                                        <div class="loader"></div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="sendGuest btn btn-primary">Send</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  PHÂN TRANG   --}}
        <div style="text-align: center">
            {{$lsContact->appends(['status'=>$status])->links("pagination::bootstrap-4")}}
        </div>
        {{--  HẾT PHÂN TRANG   --}}


    </section>
    <!-- /.content -->
@endsection

@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function (){
           $('.submitform').click(function(e){
                 $('#formSend').modal('show');
                $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function(){
                      return $(this).text();
                }).get();
               // console.log(data);
               $('#id').val(data[0]);
               $('#email').val(data[1]);
               $('#question').val(data[4]);
           }) ;
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.sendGuest').click(function(e){
                e.preventDefault();
                $('.loader').show();
                var datas = {
                    "id" : $('#id').val(),
                    "email" : $('#email').val(),
                    "_token": "{{ csrf_token() }}",
                    "msg" : $('#msg').val()
                };
               // console.log(datas);
                $.ajax({
                    type: "POST",
                    url: "/api/send-guest",
                    data: datas,
                    success: function (response){
                        $('.loader').hide();
                        Swal.fire({
                            title: 'Success',
                            text: "Your message has been sent.",
                            icon: 'success',
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if(result.isConfirmed){
                                window.location = '/admin/contacts';
                            }
                        });

                    },
                    error: function (response){
                        $('.loader').hide();
                        Swal.fire(
                            'Error!',
                            'Your message can not send.' +
                            'Please fill out the form!!!',
                            'error'
                        )
                    }
                });
            });
        });
    </script>
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
