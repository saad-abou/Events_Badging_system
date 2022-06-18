<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user barcode</title>
    <style>
        .row{
            margin: 50px;
        }
    </style>
</head>
<body>
    <div class="row">
        <div>
            {!! DNS1D::getBarcodeHTML($user->barecode,'C128A',5,55) !!}
        </div>
        <h2>{{$user->barecode}}</h2>
    </div>

</body>
</html>