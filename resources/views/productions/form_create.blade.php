@extends('layouts.admin.form')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    {!! Form::open( [ 'url' =>  '/admin/productions/store'    ] ) !!}
    <?php if( isset( $data->category->id ) ){ ?> <input type="hidden" name="yamz_category_id"  value="<?php echo $data->category->id ?>">   <?php } ?>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#tab-1" onclick="return false"> Основные данные</a>
            </li>
            <li class=""><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">Ошибка! {{ $error }}</div>
                    @endforeach
                    @include('admin.common.name_alias_articul')
                    <div class="hr-line-dashed"></div>
                    @include('admin.common.description_short_description')
                    <div class="hr-line-dashed"></div>
                    @include('admin.common.price')
                    <div class="hr-line-dashed"></div>
                    @include('admin.common.public_anons_hit')
                    <div class="hr-line-dashed"></div>
                </div>
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    @include('admin.common.metatag_title_metatag_description_metatag_keywords')
                </div>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="row">
        <div class="col-xs-6">
            {!! Form::submit('Готово!',['class'=>'btn btn-primary','style'=>'padding:3px  50px;font-size:1.5rem']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
@section('ibox_title')
      [  <a href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ] > Новая запись
@endsection

@section('title')
    <h2> [ <a href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ]
         > Новая запись </h2>
@endsection
@section('breadcrumb')
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Главная</a>
            </li>
            <li>
                <strong> Категория [ <a
                            href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ]
                </strong>
            </li>
            <li>
                <strong><a href="/admin/product/categories">Продукция</a></strong>
            </li>
            <li>
               Новая запись
            </li>
        </ol>
@endsection

