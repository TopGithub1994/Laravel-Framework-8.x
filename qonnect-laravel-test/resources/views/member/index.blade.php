<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Member</title>
</head>
<body>
    <h1>Hello Member</h1>

    <p>Address :: {{$address}}</p>
    <p>Tel :: {{$tel}}</p>
    <p>Email :: {{$email}}</p>
    <p>{{$error}}</p>
    <p>{{$status}}</p>
    <a href="{{url('/')}}">Home</a>
    <a href="{{url('/admin/?user=topl3ack')}}">Admin</a>
    <a href="{{url('/admin')}}">Member</a>
    <a href="{{route('about')}}">About</a>
</body>
</html>