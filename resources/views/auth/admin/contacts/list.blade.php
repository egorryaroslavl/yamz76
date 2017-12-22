@extends('layouts.admin.index')
@section('content')

@include('admin.contacts.form')

@endsection

@section('pageheadler')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Контакт</h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-home"></i> Главная</a></li>
             <li class="active">Контакт</li>
        </ol>
    </section>
@endsection