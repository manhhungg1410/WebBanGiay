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
    <h1>Hello {{$datas['name']}}!!</h1>
    <br>
    <p>Thank you for asking us questions !!</p>
    <br>
    <p style="font-weight: bold;">This is our answer:</p>
    <br>
    <p>{{$datas['msg']}}</p>
    <br>
    <p>Thank you {{$datas['name']}} and see you again!!!</p>
</body>
</html>
