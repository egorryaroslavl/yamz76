@extends('layouts.index')
@section('content')
    @if(isset($data) )
        <section class="section section--bottom-space-large">
            <div class="section__header">
                <div class="section__title">
                    <div class="h2 post-title">Статьи</div>
                </div>
                <div class="section__icon">
                    <span class="fa fa-newspaper-o"></span>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-3 wow fadeInLeft" style="display: table-footer-group;">
                        {!!  Widget::Categories() !!}
                    </div>
                    <div class="col-md-6 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".1s" style="display: table-header-group; ">
                        <div class="blog-post-wrapper">
                            <article id="post-2" class="blog-post">
	                            {{ Widget::NextPrevItem('data', $data ) }}
                                <header class="post-header">
                                    <h1>{{$data->name}}</h1>

                                </header>
                                <div class="description">{!! $data->description !!}</div>

                            </article>
                        </div>
                    </div>
                    <div class="col-md-3 wow fadeInRight" data-wow-duration=".9s" data-wow-delay=".1s"  style="display:table-row-group;text-align: justify">
                        {!!  Widget::LatestArticles() !!}
                    </div>
                </div>
            </div>

        </section>
    @endif
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/articles">Статьи</a></li>
        <li class="active">{{$data->name}}</li>
    </ol>
@endsection