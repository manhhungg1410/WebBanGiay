<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form role="form" method="post" action="{{route('confirmsign_up')}}" enctype="multipart/form-data">
    @csrf
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="name">User Name (<span style="color: red">*</span>):</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="User Name...">
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="role_id">Role (<span style="color: red">*</span>):</label>
                    <select name="role_id"  class="form-control" id="role_id">
                        <option value="0">-- choose Role --</option>
                        @foreach($lsRole as $items)
                            <option value="{{$items->id}}">{{$items->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <label for="avatar">Avatar:</label>
                    <input type="file" name="avatar" id="avatar">
                    <p class="help-block">Let's post avatar!!</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="position">Email (<span style="color: red">*</span>): </label>
                    <input type="email" class="form-control" name="email" id="email"  placeholder="Nhập vào email">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="position">Password (<span style="color: red">*</span>): </label>
                    <input type="password" class="form-control" name="password" id="password"  placeholder="Password...">
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="position">Confirm Password (<span style="color: red">*</span>): </label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation"  placeholder="Confirm Password...">
                </div>
            </div>

        </div>

    </div>
    <!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Create Now</button>
    </div>

</form>
</body>
</html>
