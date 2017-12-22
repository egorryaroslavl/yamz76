@extends('layouts.index')
@section('content')
	
	<section class="section section--bottom-space-large">
		<header class="section__header" style="background: transparent">
			<ol class="breadcrumb">
				<li><a href="/categories">Каталог</a></li>
				<li><a href="/category/{{$data->category->alias}}">{{$data->category->name}}</a></li>
			</ol>
		</header>
		<div class="section__header">
			<div class="section__title">
				<h1>{{$data->name}}{{ !empty($data->articul) ? ' ('. $data->articul .')' :''}}{{--Запчасти [ {{$data->category->name}} ]--}}</h1>
			</div>
			<div class="section__icon">
				<span class="fa fa fa-cogs"></span>
			</div>
		</div>
		<div class="container">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<div itemscope itemtype="http://schema.org/Product">
						<article id="post-2" class="blog-post">
							{{ Widget::NextPrevProduct('data', $data ) }}
							<div itemprop="name"
							     class="h2 highlight">
								{{$data->name}}{{ !empty($data->articul) ? ' ('. $data->articul .')' :''}}
							</div>
		 
							@if(!empty($data->icon) && file_exists(public_path().$data->icon))
								<img
									src="{{$data->icon}}"
									style="width:240px;margin-bottom: 10px"
									class="img-responsive img-thumbnail"
									alt="{{$data->articul}}"
								>
							@endif
							<header class="post-header">
								
								<button
									id="product{{$data->id}}"
									class="btn btn-primary get-order"
									data-product_id="{{$data->id}}"
									data-price="{{$data->price}}"
									data-category_id="{{$data->category->id}}"
									data-token="{{csrf_token()}}"
									title="Заказать"
									onclick="yaCounter41168344.reachGoal ('zakaz-tovar'); return true;"
									type="button"><i class="fa fa-cart-arrow-down"></i> Заказать
								</button>
								<span style="display: none" class="label label-success" id="appaend{{$data->id or ''}}">Добавлено в заказ!</span>
							</header>
							
							@if(!empty($data->price))
								<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
									<meta itemprop="price" content="{!! number_format( $data->price , 2, ',', ' ') !!}">
									<meta itemprop="priceCurrency" content="RUB">
									<h4>Цена: <span style="color-rendering: #286090">{!! number_format( $data->price , 2, ',', ' ') !!}
											руб.</span></h4>
								</div>
							@endif
							<hr class="hr-line-dashed">
							<div
								itemprop="description">{!! str_replace(["<br>","ДВИГ"],[" ","ДВИГАТЕЛЬ"],$data->description)  !!}</div>
						</article>
					</div>
				
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
		<li><a href="/categories">Каталог</a></li>
		<li><a href="/category/{{$data->category->alias}}">{{$data->category->name}}</a></li>
	</ol>
@endsection