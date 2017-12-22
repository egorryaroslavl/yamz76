@extends('layouts.index')
@section('content')
    <section id="services" class="section">
        <header class="section__header">
            <div class="section__title">
                <h1>Статьи</h1>
            </div>
            <div class="section__icon">
                <span class="fa fa-leanpub"></span>
            </div>
        </header>
	    <div class="container">
		    <div class="blog-content pull-right">
			    <div class="blog-post-wrapper">
				    <article id="post-2" class="blog-post">

					    <div class="container wow slideInLeft" data-wow-duration="1s" data-wow-delay=".5s">
						    <div class="services-content-wrapper">
							    <div class="services-content">
								    @if(count($data)>0)
									    <ul class="services-menu articles-list">
										    @foreach($data as $item)
											    <li><i class="fa fa-angle-double-right" aria-hidden="true"></i> <a href="/article/{{$item->alias}}">{{$item->name}}</a></li>
										    @endforeach
									    </ul>
									    {!! $data->render() !!}
								    @endif
							    </div>



						    </div>
					    </div>
				    </article>
			    </div>
		    </div>
		    <aside class="sidebar pull-left visible-md-block visible-lg-block">
			    {!!  Widget::Categories() !!}
			    {!!  Widget::LatestArticles() !!}
		    </aside>
	    </div>
    </section>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/articles">Статьи</a></li>
    </ol>
@endsection