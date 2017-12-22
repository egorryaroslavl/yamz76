@extends('layouts.index')
@section('content')
	<section id="order" class="section">
		<header class="section__header">
			<div class="section__title">
				<h1>Ваш заказ</h1>
			</div>
			<div class="section__icon" style="cursor:pointer">
				<span class="fa fa-cart-arrow-down"></span>
			</div>
		</header>


		<div class="container" id="order-form">
			<div class="blog-content pull-right">
				<div class="blog-post-wrapper">
					<article class="blog-post">

						<input type="hidden" value="1" name="order-page" id="order-page"/>
						<table class="table order-user-data">
							<tbody>
							<tr style="height: 30px;border: none">
								<td colspan="2"
								    style="vertical-align: middle;border: none;text-align:right;font-weight: bold;width: 90px">
									Компания*
								</td>
								<td colspan="4">
									<input
										type="text"
										name="companyname"
										class="companyname form-control"
										id="companyname"
										style="margin:0"
									>
								</td>
							</tr>
							<tr style="height: 30px">
								<td colspan="2"
								    style="vertical-align: middle;text-align: right;font-weight: bold">
									Имя*
								</td>
								<td colspan="4">
									<input
										type="text"
										name="username"
										class="username form-control"
										id="username"
										style="margin:0"
									>
								</td>
							</tr>
							<tr style="height: 30px">
								<td colspan="2"
								    style="vertical-align: middle;text-align: right;font-weight: bold">
									Телефон*
								</td>
								<td colspan="4">
									<input
										type="phone"
										name="userphone"
										class="userphone form-control"
										id="userphone"
										style="margin:0"
									>
								</td>
							</tr>
							<tr style="height: 30px">
								<td colspan="2"
								    style="vertical-align: middle;text-align: right;font-weight: bold">
									Email*
								</td>
								<td colspan="4">
									<input
										type="email"
										name="useremail"
										class="useremail form-control"
										id="useremail"
										style="margin:0"
									>
								</td>
							</tr>
							<tr style="height: 60px">
								<td colspan="2"
								    style="vertical-align: middle;text-align: right;font-weight: bold">
									Сообщение
								</td>
								<td colspan="4">
                                                        <textarea
	                                                        name="usercomment"
	                                                        class="usercomment form-control"
	                                                        id="usercomment"
	                                                        style="margin:0"
                                                        ></textarea>
								</td>

							</tr>
							</tbody>
						</table>
						<table class="table table-bordered">
							<tbody>
							<?php $sum = 0; ?>
							@for ($i = 0,$n = 1; $i < count($data); $i++,$n++)
								<?php

								if( !isset( $data[ $i ][ 'count' ] ) || empty( $data[ $i ][ 'count' ] ) ){
									$count = 1;
								} else{
									$count = $data[ $i ][ 'count' ];
								}

								$summ = str_replace( [ ' ', ',' ], [ '', '.' ], $data[ $i ][ 'price' ] ) * $count;

								/* Узнаем артикул продукта */

								$articul = \App\Model\Product::where( 'id', $data[ $i ][ 'product_id' ] )->first()->articul;
								if( !empty( $articul ) ){
									$articul = ' артикул-' . $articul;
								}

								?>
								<tr class="active" id="row{{$data[$i]['product_id']}}">
									<td style="width: 30px">
										{{$n}}
									</td>
									<td>
										{{$data[$i]['product_name']}}{{$articul}}
									</td>
									<td>
										{{$data[$i]['price']}}
									</td>
									<td>
										<input
											type="number"
											value="{{$count}}"
											min="1"
											class="form-control product-count"
											data-id="{{$data[$i]['product_id']}}"
											data-price="{{str_replace([' ',','],['','.'],$data[$i]['price'])}}"
											id="count{{$data[$i]['product_id']}}"
											name="count"/>
									</td>
									<td class="summ" id="summ{{$data[$i]['product_id']}}"
									    style="text-align:center">
										{{$summ}}
									</td>
									<td
										class="del-product-item"
										id="del{{$data[$i]['product_id']}}"
										data-id="{{$data[$i]['product_id']}}"
										style="text-align:center">
										<a href="#" onclick="return false"><i class="fa fa-times"></i></a>
									</td>
								</tr>
								<?php $sum = $sum + $summ; ?>
							@endfor
							</tbody>
						</table>

						<table class="table table-bordered" id="fixed">
							<tbody>
							<tr>
								<td>
									@if( count( $data ) > 0 )
										<button
											<?php if( $_SERVER[ 'REQUEST_URI' ] == '/order' ){
												echo 'data-page="order"';
											} ?>
											class="btn btn-primary btn-sm send-order">ОТПРАВИТЬ
										</button>
										<button class="btn btn-danger btn-sm del-order"
										        style="margin-left: 6px"
										        title="Очистить и закрыть (Не рекомендуется!)">ОТМЕНИТЬ
										</button>
									@endif
								</td>
								<td class="summ-text" style="text-align: right">
									СУММА:
								</td>
								<td class="total">{{$sum}}</td>
								<td class="un" style="text-align:left">руб.
								</td>
							</tr>
							</tbody>
						</table>
 					</article>
				</div>
			</div>
			<aside class="sidebar pull-left visible-md-block visible-lg-block">
				{!! Widget::Categories() !!}
			</aside>
		</div>
	</section>
@endsection
@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li><a href="/#">Заявка</a></li>
	</ol>
@endsection