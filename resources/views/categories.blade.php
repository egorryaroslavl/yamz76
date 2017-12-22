@extends('layouts.index')
@section('content')
    <section id="shop" class="section">
        <header class="section__header">
            <div class="section__title">
                <h1>Каталог</h1>
                <small>{{count($data)}} категорий</small>
            </div>
            <div class="section__icon">
                <span class="fa fa-cogs"></span>
            </div>
        </header>
        <div class="container">
            <div class="row">
                <div  class="">
                    @if(count($data)==0)
                        <p>Пусто...</p>
                    @else
                        <?php $n = 0; ?>
                        @foreach($data as $item)
                            <div id="shop-item-{{$n}}" class="shop-item col-md-2 col-sm-4 col-xs-6">
                                <div class="shop-item__header">
                                    <a href="/category/{{$item->alias}}">
                                   <img class="shop-item__image" src="{{ $item->icon }}" alt=""/>
                                    </a>
                                </div>
                                <div class="shop-item__body" style="height: 150px">
                                    <h3 style="height:4.0rem;vertical-align: bottom"><a href="/category/{{$item->alias}}"
                                           class="shop-item__title">{{$item->name}}</a>
                                    </h3>
                                    <span class="shop-item__price">
                                        {{$item->short_description}}
                                    </span>
                                    {{--<span class="shop-item__rating">
                                        Подкатегорий - {{\App\Http\Controllers\YamzCategoryController::childCount($item->alias)}}
                                    </span>--}}
                                </div>
                            </div>
                            <?php $n++; ?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('title')
<p>Каталог</p>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li class="active">Каталог</li>
    </ol>
@endsection