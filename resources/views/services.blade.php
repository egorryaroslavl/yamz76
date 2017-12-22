@extends('layouts.index')
@section('content')

    <!-- "Our services" section -->
    <section id="services" class="section">
        <header class="section__header">
            <div class="section__title">
                <h1>Услуги</h1>
            </div>
            <div class="section__icon">
                <span class="fa fa-recycle"></span>
            </div>
        </header>
        <div class="container">
	        <div class="blog-content pull-right">
		        <div class="blog-post-wrapper">
                    @if(count($data)>0)
				        <ul class="services-menu" style="padding: 0">
					        @foreach( $data as $item )
						        <li style="background: #f2f2f2;margin-bottom: 2px;padding: 2px 10px">
							        <a href="/service/{{$item->alias}}" style="font-size: 1.5rem">{{$item->name}}</a>
						        </li>
					        @endforeach
				        </ul>
                    @endif
                </div>

            </div>

	        <aside class="sidebar pull-left visible-md-block visible-lg-block">
		        {!!  Widget::Categories() !!}
	        </aside>
        </div>
   </section>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/services">Услуги</a></li>
     </ol>
@endsection