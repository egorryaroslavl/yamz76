@extends('layouts.admin.index')
@section('content')
<p>Не выбран раздел...</p>
@endsection


@section('pageheadler')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Главная страница
            <small>административной части</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-home"></i> Главная</a></li>
            {{--  <li class="active">Here</li>--}}
        </ol>
    </section>
@endsection