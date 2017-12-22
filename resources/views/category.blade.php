@extends('layouts.index')
@section('content')
	<section id="services" class="section">
		<header class="section__header" style="background: transparent">
			<ol class="breadcrumb">
				{{--<li><a href="/">Главная</a></li>--}}
				<li><a href="/categories">Каталог</a></li>
				<li class="active">{{$data->parent_name}}</li>
			</ol>
		</header>
		<header class="section__header">
			<div class="section__title">
				<h1>{{$data->parent_name}}</h1>
			</div>
			<div class="section__icon">
				<span class="fa fa-cogs"></span>
			</div>
		</header>
		<div class="container">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<article id="post-2" class="blog-post">
						@if( count($data->products) > 0 )
							<div class="container-fluid">
								@foreach($data->products as $item)
									<div class="row" style="background: #dddddd;margin-bottom: 3px">
										<div class="col-md-9 col-sm-12"
										     style="vertical-align: middle;padding-left: 0">
											<button
												id="product{{$item->id}}"
												class="btn btn-primary btn-xs get-order"
												data-product_id="{{$item->id}}"
												data-price="{{$item->price}}"
												data-category_id="{{$data->parent_id}}"
												data-token="{{csrf_token()}}"
												data-toggle="popover"
												data-content="Позиция добавлена в заказ"
												data-trigger="focus"
												title="Заказать"
												onclick="yaCounter41168344.reachGoal ('zakaz-kategoria'); return true;"
												type="button"><i class="fa fa-shopping-basket"></i> {{--Заказать--}}
											</button> <span style="display: none" class="label label-success" id="appaend{{$item->id}}">Добавлено в заказ!</span>
											<a href="/product/{{$item->alias}}-{{$item->id}}"> {{$item->name}}{{ !empty($item->articul) ? ' ('. $item->articul .')' :''}}</a>
										</div>
										<div class="col-md-3 col-sm-12">
												<span style="float:right;display: inline-block"> {!! number_format( $item->price , 2, ',', ' ') !!} руб. </span>
										</div>
									</div>
								@endforeach
							</div>


							{!! \App\Http\Controllers\UtilsController::pageOneClear($data->products->render()) !!}

							
						@endif
						
						@if( count( $data ) > 0 )
							<ul class="services-menu" style="padding: 0">
								@foreach( $data as $item )
									<li style="background: #f2f2f2;margin-bottom: 2px;padding: 2px 10px">
										<a href="/category/{{$item->alias}}" style="font-size: 1.5rem">{{$item->name}}</a>
									</li>
								@endforeach
							</ul>

								@if(isset($data->parent_text) && !empty($data->parent_text))
									@if(!isset($_REQUEST['page']) || (int)$_REQUEST['page'] == 1 )
										<article>{!! $data->parent_text !!}</article>
									@endif
								@endif
						@endif
							
							@if(isset($data->parent_text) && !empty($data->parent_text))
								
								@if(!isset($_REQUEST['page']) || (int)$_REQUEST['page'] == 1 )
									
									{!! $data->parent_text !!}
								
								@endif
							
							@endif
					</article>
				</div>
			</div>
			<aside class="sidebar pull-left visible-md-block visible-lg-block">
		 				{!! Widget::Categories() !!}
			</aside>
		</div>
	</section>
 
	<script>
	//	$('body').popover(options);
	</script>
@endsection
@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li><a href="/categories">Каталог</a></li>
		<li class="active">{{$data->parent_name}}</li>
	</ol>
@endsection