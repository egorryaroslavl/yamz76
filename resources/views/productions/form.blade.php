@extends('layouts.admin.form')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{!! Session::get('message') !!}   </div>
        <div class="alert alert-danger">{!! Session::get('flash_message') !!}   </div>
    @endif
    {{ Form::open( [ 'action' =>'Productions\ProductionsController@'. $data->act,'enctype'=>'multipart/form-data' ] ) }}
    <?php if( isset( $data->id ) ){ ?> {{ Form::hidden('id',$data->id )}} <?php } ?>
    <input type="hidden" name="icon" id="icon" value="{{$data->icon}}"/>
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1" onclick="return false">Основные данные</a>
            </li>
            <li class=""><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
                    @if( count($errors->all()) > 0 )
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">Ошибка! {{ $error }}</div>
                        @endforeach
                    @endif
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

    @if( $data->act == 'update')
        [
        <a href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ] > {{$data->name}}  @if(!empty($data->articul))
            <small>( артикул - {{$data->articul}} )</small>@endif
    @else
        [
        <a href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ] > Новая запись
    @endif

@endsection
@section('title')

    @if(  $data->act == 'update' )
        <h2> [ <a href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ]
             > {{$data->name,''}} @if(!empty($data->articul))
                <small>( артикул - {{$data->articul}} )</small>@endif</h2>
    @else
        <h2> [ <a href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a> ]
             > Новая запись </h2>

    @endif
@endsection


@section('breadcrumb')
    @if(isset($data->id))
        <ol class="breadcrumb">
            <li>
                <a href="/admin">Главная</a>
            </li>

            <li>
                <strong>Категория [ <a
                            href="/admin/category/{{$data->category->id}}/productions">{{$data->category->name}}</a>
                        ]</strong>
            </li>

            <li>
                <strong> Продукция</strong>
            </li>
            <li>
                <strong>{{$data->name}} @if(!empty($data->articul))
                        <small>( артикул - {{$data->articul}} )</small>@endif</strong>
            </li>

        </ol>
    @endif
    <style>
        label {
            margin-top: 15px;
            }

        .nav-tabs li a {
            /* font-size: 18px !important;*/
            font-weight: bold !important;
            color:       rgba(64, 80, 187, 0.7) !important;
            }
    </style>
@endsection

