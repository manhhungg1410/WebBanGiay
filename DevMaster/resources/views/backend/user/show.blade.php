@extends('backend.layout.index')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Profile User
        <small>Preview</small>
        @can('admin_manager')
        <small><a href="{{route('adminuser.index')}}" class="btn btn-success"><span class="glyphicon glyphicon-menu-hamburger"></span> List Users</a></small>
            @endcan
    </h1>

</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset($user->avatar)}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{$user->name}}</h3>

                    <p class="text-muted text-center">{{$user->education}}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Number of Products added: </b> <a class="pull-right">
                                @if(count($products)==0)
                                    0
                                @else
                                @foreach($products as $items)
                                {{$items->soluong}}
                                @endforeach
                                    @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Number of Post posted: </b> <a class="pull-right">
                                @if(count($articles)==0)
                                    0
                                @else
                                @foreach($articles as $items)
                                    {{$items->soluong}}
                                @endforeach
                                    @endif
                            </a>
                        </li>
                        <li class="list-group-item">
                            <b>Friends</b> <a class="pull-right">13,287</a>
                        </li>
                    </ul>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About <b>{{$user->name}}</b></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i>Education</strong>

                    <p class="text-muted">
                        {{empty($user->education)?'No Information':$user->education}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i>Locaiton</strong>

                    <p class="text-muted">
                        {{empty($user->address)?'No Information':$user->address}}
                    </p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i>Skill</strong>

                    <p>
                      @if(empty($user->skill)==false)
                        <span class="label label-info">
                            @switch($user->skill)
                                @case(1)
                                    UI Design
                                    @break
                                @case(2)
                                    Coding
                                    @break
                                @case(3)
                                    Master PHP
                                    @break
                                @case(4)
                                    Javascript
                                    @break
                                @case(5)
                                    Node.js
                                    @break
                                @case(6)
                                    React Native
                                    @break
                                @case(7)
                                    Master C#
                                    @break
                            @endswitch
                        </span>
                      @endif
                    </p>

                    <hr>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        @include('sweetalert::alert')
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#activity" data-toggle="tab">Personal Information</a></li>
                    @if($user->id == Auth::user()->id)
                    <li><a href="#settings" data-toggle="tab">Update Personal Information</a></li>
                        @endif
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">


                        <!-- Post -->
                        <div class="post clearfix">
                         <div class="row">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">User Name: </label>
                                <div class="col-sm-10">
                                 {{$user->name}}
                                </div>
                            </div>
                        </div>

                            <br>

                            <div class="row">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Email: </label>
                                <div class="col-sm-10">
                                   {{$user->email}}
                                </div>
                            </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label for="avatar" class="col-sm-2 control-label">Avatar:</label>
                                    <div class="col-sm-10">
                                        @if(empty($user->avatar)==false)
                                        <img src="{{asset($user->avatar)}}" alt="" style="margin-top: 15px; max-width: 200px;">
                                            @else Haven't updated image yet
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Gender: </label>
                                    <div class="col-sm-10">
                                        @if(empty($user->avatar)==false)
                                           @if($user->gender==1) Nam
                                               @else Nữ
                                            @endif
                                        @else Haven't updated gender yet
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Personal Phone Number: </label>
                                    <div class="col-sm-10">
                                        @if(empty($user->phone)==false)
                                        {{$user->phone}}
                                            @else Haven't updated personal phone yet
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Date of Birth: </label>
                                    <div class="col-sm-10">
                                        @if(empty($user->date)==false)
                                            {{$user->date}}
                                        @else Haven't updated date of birth yet
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Description: </label>
                                    <div class="col-sm-10">
                                        @if(empty($user->description)==false)
                                            {{$user->description}}
                                        @else Haven't updated description yet
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Favorite Sayings: </label>
                                    <div class="col-sm-10">
                                        @if(empty($user->sayings)==false)
                                            {{$user->sayings}}
                                        @else Haven't updated description yet
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">


                        </div>
                        <!-- /.post -->
                    </div>

                    <div class="tab-pane" id="settings">
                        <form id="myForm" class="form-horizontal"  action="{{route('adminuser.update',$user->id)}}"  method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                <label for="inputName" class="col-sm-2 control-label">Skills: </label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="skill" id="skill">
                                        <option value="1" {{$user->skill==1?'selected':''}}>UI Design</option>
                                        <option value="2" {{$user->skill==2?'selected':''}}>Coding</option>
                                        <option value="3" {{$user->skill==3?'selected':''}}>Master PHP</option>
                                        <option value="4" {{$user->skill==4?'selected':''}}>Javascript</option>
                                        <option value="5" {{$user->skill==5?'selected':''}}>Node.js</option>
                                        <option value="6" {{$user->skill==6?'selected':''}}>React Native</option>
                                        <option value="7" {{$user->skill==7?'selected':''}}>Master C#</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">DOB: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="date" id="date"  value="{{$user->date}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Address: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="address" id="address"  value="{{$user->address}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Education: </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="education" id="education" value="{{$user->education}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Description: </label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" id="description" rows="10">{{$user->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Favorite Sayings: </label>
                                <div class="col-sm-10">
                                    <textarea name="sayings" class="form-control" id="sayings" rows="10">{{$user->sayings}}</textarea>
                                </div>
                            </div>



                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="update_data btn btn-danger" >Cập nhật thông tin</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->

@endsection
