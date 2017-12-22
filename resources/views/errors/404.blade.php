@extends('layouts.index')
@section('content')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>404 Вы попали в НЕТУДА!</title>
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://getbootstrap.com/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="background: #000000;padding: 0">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">

                <div style="font-size:360px;font-family: Verdana;color:red;text-shadow: 0px 0px 6px #670200;margin-top: -100px;padding: 0;">
                    404</div>
            </div>

        <div class="col-md-6">

            <div style="margin-top: 0px">
                <p class="lead">Вы попали в <br><span style="transform: rotate(180deg) scale(1, 1) skew(0deg, 0deg) translate(0px, 0px);display:block;float:left">НЕТУДА</span>!</p>
                <p class="lead">А в ТУДА вы не попали!</p>
                <p><a href="/">На главную</a></p>
            </div>
        </div>
    </div>
</div>


</footer>
<style>
    .lead {
        font-size:   60px;
        font-family: Verdana;

        }
</style>
</body>

@endsection