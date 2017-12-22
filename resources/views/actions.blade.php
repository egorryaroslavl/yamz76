@extends('layouts.index')
@section('content')
    <section id="actions" class="section">
        <header class="section__header">
            <div class="section__title">
                <h1>Акции</h1>
            </div>
            <div class="section__icon">
                <span class="fa fa-fire"></span>
            </div>
        </header>
        <div class="home-banner-wrapper">
            @foreach($data as $item)
                <a href="/action/{{$item->alias}}" class="home-banner-link">
                    <div class="home-banner">
                        <div class="banner-image">
                            <img class="visible-xs" src="{{$item->icon}}" alt=""/>
                            <img class="visible-sm" src="{{$item->icon}}" alt=""/>
                            <img class="visible-md" src="{{$item->icon}}" alt=""/>
                            <img class="visible-lg" src="{{$item->icon}}" alt=""/>
                        </div>
                        <div class="banner-body">
                            <h3 class="banner-title">{{$item->name}}</h3>
                            <p style="background: rgba(255, 255, 255, 0.3);padding: 10px;border-radius: 6px;margin-right: 10px">
                                {!! $item->short_description !!}
                            </p>
                            <span class="read-more"><a href="/action/{{$item->alias}}"> Подробней >>></a></span>
                        </div>
                    </div>
                </a>

                <div class="clearfix" style="height:5px; margin: 20px 0; background: #FF851B"></div>
            @endforeach
        </div>
    </section>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/actions">Акции</a></li>
    </ol>
@endsection