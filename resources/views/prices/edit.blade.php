@extends('layouts.admin.form')
@section('content')
    <form method="post" class="form-horizontal">
        <div class="form-group">

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <label for="cat">Категория</label>
                        <select
                                id="cat"
                                class="form-control m-b"
                                name="id">
                            @if(count($data->all)>0)
                                @foreach($data->all as $option)
                                    <option value="{{$option->id}}"
                                            @if($option->id == $data->id) selected="selected" @endif>{{$option->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="cat">Как изменить</label>
                        <select
                                id="action"
                                class="form-control m-b"
                                name="action">
                            <option value="0">Выбрать действие</option>
                            <option value="up">Увеличить</option>
                            <option value="down">Уменьшить</option>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="font-bold">На <span id="hm"></span> %</label>

                        <input
                                type="number"
                                step="1"
                                max="100"
                                min="1"
                                class="form-control percents"
                                id="percents"
                                value="1"
                                name="percents">

                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4">
                <button class="btn btn-primary" type="submit">OK</button>
                <button class="btn btn-white" type="submit">Отменить</button>
            </div>
        </div>
    </form>
@endsection
@section('title')
    <h2>Пакетное изменение цен</h2>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li>
            <a href="/admin">Главная</a>
        </li>
        <li class="active">Пакетное изменение цен</li>
    </ol>
@endsection
@section('ibox_title')
    Редактирование
@endsection