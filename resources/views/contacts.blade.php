@extends('layouts.index')
@section('content')

	<!-- "Contacts" section -->
	<section id="contacts" class="section">
		<header class="section__header">
			<div class="section__title">
				<h1>Контакты</h1>
			</div>
			<div class="section__icon">
				<span class="fa fa-bell-o"></span>
			</div>
		</header>

		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-push-1 col-md-6 col-md-push-0">
					<div class="contact-widgets">
						<div class="row">
							@if(\App\Model\Contact::address() != '')
								<div class="col-xs-7 col-xs-push-2 col-sm-6 col-sm-push-0">
									<div id="contact-address" class="contact-widget">
										<span class="contact-widget__icon fa fa-map-marker"></span>
										<div class="contact-widget__body">
											<h5 class="contact-widget__title">Адрес</h5>
											<p>{{\App\Model\Contact::address() }}</p>
										</div>
									</div>
								</div>
							@endif
							@if(\App\Model\Contact::address_yurid() != '')
								<div class="col-xs-7 col-xs-push-2 col-sm-6 col-sm-push-0">
									<div id="contact-address" class="contact-widget">
										<span class="contact-widget__icon fa fa-map-marker"></span>
										<div class="contact-widget__body">
											<h5 class="contact-widget__title">Юридический адрес</h5>
											<p>{{\App\Model\Contact::address_yurid() }}</p>
										</div>
									</div>
								</div>
							@endif
							@if(\App\Model\Contact::phone() != '')
								<div class="col-xs-7 col-xs-push-2 col-sm-6 col-sm-push-0">
									<div id="contact-phone" class="contact-widget">
										<span class="contact-widget__icon fa fa-phone"></span>
										<div class="contact-widget__body">
											<h5 class="contact-widget__title">Телефоны</h5>
											<p>{!! \App\Model\Contact::phone() !!}</p>
										</div>
									</div>
								</div>
						</div> <!-- .row -->
						@endif

						@if(\App\Model\Contact::rekvizity() != '')
							<div class="col-xs-7 col-xs-push-2 col-sm-6 col-sm-push-0">
								<div id="contact-email" class="contact-widget">
									<span class="contact-widget__icon fa  fa-list-alt"></span>
									<div class="contact-widget__body">
										<h5 class="contact-widget__title">Реквизиты</h5>
										<p>{!! \App\Model\Contact::rekvizity()  !!} </p>
									</div>
								</div>
							</div>
						@endif


						<div class="row">

							@if(\App\Model\Contact::email() != '')
								<div class="col-xs-7 col-xs-push-2 col-sm-6 col-sm-push-0">
									<div id="contact-email" class="contact-widget">
										<span class="contact-widget__icon fa fa-envelope-o"></span>
										<div class="contact-widget__body">
											<h5 class="contact-widget__title">E-mail</h5>
											<p>{{\App\Model\Contact::email()}}</p>
										</div>
									</div>
								</div>
							@endif


						</div> <!-- .row -->
					</div> <!-- .contact-widgets -->
				</div> <!-- .col-* -->



				<div class="hidden-xs col-sm-8 col-sm-push-2 col-md-6 col-md-push-0">
					<form name="contact-form" id="send-message" class="contact-form">
						<input
							class="form-control form-control--input"
							type="text"
							name="name"
							id="name"
							value=""
							required
							placeholder="Имя*">
						<input
							class="form-control form-control--input"
							type="tel"
							name="phone"
							id="phone"
							value=""
							required
							placeholder="Телефон">
						<input
							class="form-control form-control--input"
							type="email"
							name="email"
							id="email"
							value=""
							required
							placeholder="Email*">
						<textarea
							class="form-control form-control--textarea"
							name="message"
							id="message"
							required
							placeholder="Сообщение*"
							rows="4"></textarea>
						<button type="button" class="btn button button--hover send-message" onclick="yaCounter41168344.reachGoal ('contacts-form'); return true;">Отправить</button>
					</form>
				</div> <!-- .col-* -->
			</div> <!-- .row -->
		</div> <!-- .container -->

		<div class="directions">
			@if(\App\Model\Contact::map() != '')
				<div class="directions__map">{!! \App\Model\Contact::map( ) !!}</div>
			@endif
		</div>
	</section>

@endsection
@section('breadcrumb')
	<ol class="breadcrumb">
		<li><a href="/">Главная</a></li>
		<li class="active">Контакты</li>
	</ol>
@endsection