@extends('layouts.index')
@section('content')
	<section id="services" class="section">
		<header class="section__header">
			<div class="section__title">
				<h1>{!!  "Результаты поиска [<small style='color:#FF4500'>".$word."</small>]"  !!}</h1>
			</div>
			<div class="section__icon">
				<span class="fa fa-cogs"></span>
			</div>
		</header>
		<div class="container">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<article id="post-2" class="blog-post">
						{{-- если не найдено --}}
						@if( $count == 0 )
							<h4>Поиск не дал результатов...</h4>
							@if(!empty(\App\Model\Contact::phone()))
								<p>Но это не означает, что мы не сможем вам помочь.<br><strong style="color:#207e00">Позвоните нам:<br>{!! \App\Model\Contact::phone() !!} </strong>
								</p>
							@endif
						@endif
						{{-- \если не найдено --}}
						{{-- если найдено --}}
						@if( $count > 0 )
							<div style="max-height:1200px;overflow:scroll;overflow-x:hidden;">
								<div class="container-fluid">
									@foreach($data as $item)
										<div class="row" style="background: #dddddd;margin-bottom: 3px">
											<div class="col-md-9 col-sm-12"
											     style="vertical-align: middle;padding-left: 0">
												<button
													id="product{{$item->id}}"
													class="btn btn-primary btn-xs get-order"
													data-product_id="{{$item->id}}"
													data-price="{{$item->price}}"
													{{--data-category_id="{{$data->parent_id}}"--}}
													data-token="{{csrf_token()}}"
													title="Заказать"
													type="button"><i class="fa fa-shopping-basket"></i> {{--Заказать--}}
												</button>
												<a href="/product/{{$item->alias}}-{{$item->id}}"> {!!   \App\Http\Controllers\UtilsController::highlight($word,$item->name,$item->articul) !!}</a>
											</div>
											<div class="col-md-3 col-sm-12">
												<span style="float:right;display: inline-block"> {!! number_format( $item->price , 2, ',', ' ') !!}
													руб. </span>
											</div>
										</div>
									@endforeach
								</div>
							</div>
						@endif
						{{-- \если найдено --}}
					</article>
				</div>
			</div>
			<aside class="sidebar pull-left visible-md-block visible-lg-block">
				{!! Widget::Categories() !!}
			</aside>
		</div>
	</section>
	<style>
		.search-highlight{background: #fff200!important;}
	</style>
@endsection
@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li><a href="/categories">Каталог</a></li>
	</ol>
@endsection