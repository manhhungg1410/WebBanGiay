@extends('frontend.index')
@section('content')
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" >
        <h2 class="ltext-105 title txt-center">
            Information Guest - {{$user->name}}
        </h2>
    </section>

    @include('sweetalert::alert')

    <div class="container information">
        <div class="row">
            <div class="col-md-6">
                <p>Name : {{$user->name}}</p>
                <br>
                <p>Email: {{$user->email}}</p>
                <br>
                <p>Gender: @if($user->gender==1)
                               Nam
                            @elseif($user->gender==2)
                               Nữ
                    @else
                               Nothing
                    @endif
                </p>
                <br>
                <p>Phone: {{$user->phone}}</p>
                <br>
                <p>Date of birth: {{$user->date}}</p>
                <br>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ChangePass">
                    Change Password
                </button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Update">
                    Update Information
                </button>
            </div>

    @if($user->avatar!=null)
            <div class="col-md-6">
                <img src="{{asset($user->avatar)}}" width="100%" height="100%" alt="">
            </div>

            @endif
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="ChangePass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('change_pass_guests',$user->id)}}" method="post">
                        @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Current Password (<span style="color:red;">*</span>)</label>
                                        <input class="form-control" type="password" name="current_password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">New Password (<span style="color:red;">*</span>)</label>
                                        <input class="form-control" id="toggle_password" type="password" name="password" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Confirm New Password (<span style="color:red;">*</span>)</label>
                                        <input class="form-control" id="toggle_confirm" type="password" name="confirm_password">
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">  <button class="btn btn-success"> Change Now </button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('update_guest',$user->id)}}" method="post"  enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">User Name: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name"  value="{{$user->name}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Email: </label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email"  value="{{$user->email}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="avatar" class="col-sm-2 control-label">Avatar:</label>
                            <div class="col-sm-10">
                                <input type="file" name="avatar" id="avatar">
                                <img src="{{asset($user->avatar)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Gender: </label>
                            <div class="col-sm-10">
                                <select class="form-control" name="gender" id="gender">
                                    <option value="1" {{$user->gender==1?'selected':''}}>Nam</option>
                                    <option value="2" {{$user->gender==2?'selected':''}}>Nữ</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Personal Phone Number: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$user->phone}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">DOB: </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="date" id="date"  value="{{$user->date}}">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">  <button class="btn btn-success"> Update Now </button>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('my_css')
    <style>
        .information{
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('my_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
