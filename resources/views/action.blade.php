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

                <a href="#" class="home-banner-link">
                    <div class="home-banner">
                        <div class="banner-image">
                            <img class="visible-xs" src="/{{$data->icon}}" alt=""/>
                            <img class="visible-sm" src="/{{$data->icon}}" alt=""/>
                            <img class="visible-md" src="/{{$data->icon}}" alt=""/>
                            <img class="visible-lg" src="/{{$data->icon}}" alt=""/>
                        </div>
                        <div class="banner-body" style="background: rgba(255, 255, 255, 0.3);padding: 10px;border-radius: 6px;margin-right: 10px">
                            <h3 class="banner-title">{{$data->name}}</h3>
                             {!! $data->description !!}  </div>
                    </div>
                </a>
        </div>
    </section>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/actions">Акции</a></li>
        <li><a href="#">{{$data->name}}</a></li>
    </ol>
@endsection