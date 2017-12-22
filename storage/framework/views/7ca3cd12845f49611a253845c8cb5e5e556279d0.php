<!-- "Contacts" section -->
<section id="contacts" class="section">
	<header class="section__header">
		<div class="section__title">
			<h1>Контакты</h1>
		</div>
		<div class="section__icon">
			<span class="fa fa-phone-square"></span>
		</div>
	</header>
	<div class="container">
		<div class="row contact-widgets">
			<div class="col-xs-7 col-xs-push-2 col-sm-3 col-sm-push-0">
				<div id="contact-address" class="contact-widget">
					<span class="contact-widget__icon fa fa-map-marker fa-3x"></span>
					<div class="contact-widget__body">
						<h5 class="contact-widget__title">Адрес</h5>
						<p>150510, г. Ярославль,<br> п.&nbsp;Кузнечиха,<br>ул.&nbsp;Индустриальная, д. 7</p>
					</div>
				</div>
			</div>
			<div class="col-xs-7 col-xs-push-2 col-sm-3 col-sm-push-0">
				<div id="contact-phone" class="contact-widget">
					<span class="contact-widget__icon fa fa-phone fa-3x"></span>
					<div class="contact-widget__body">
						<h5 class="contact-widget__title">Телефоны</h5>
						<p><a href="tel:+74852672232">+7(4852)&nbsp;67-22-32</a>,<br> <a href="tel:+74852672231">+7(4852)&nbsp;67-22-31</a>,<br> <a href="tel:+74852672230">+7(4852)&nbsp;67-22-30</a></p>
					</div>
				</div>
			</div>
			<div class="col-xs-7 col-xs-push-2 col-sm-3 col-sm-push-0">
				<div id="contact-fax" class="contact-widget">
					<span class="contact-widget__icon fa fa-clock-o fa-3x"></span>
					<div class="contact-widget__body">
						<h5 class="contact-widget__title">Время работы </h5>
						<p>пн-пт 9.00-17.00<br>сб - вс: выходной</p>
					</div>
				</div>
			</div>
			<div class="col-xs-7 col-xs-push-2 col-sm-3 col-sm-push-0">
				<div id="contact-email" class="contact-widget">
					<span class="contact-widget__icon fa fa-envelope-o fa-3x"></span>
					<div class="contact-widget__body">
						<h5 class="contact-widget__title">E-mail</h5>
						<p><a href="mailto:info@yamz76.ru">info@yamz76.ru</a>
							 </p>
					</div>
				</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="visible-xs-block">
				<a href="/contacts" class="btn button button--hover" role="button">Контакты</a>
			</div>
		</div>
		<div class="row hidden-xs">
			<form class="contacts-form" id="send-message" name="contact-form">
				<div class="col-xs-4">
					<input
						class="form-control form-control--input"
						type="text"
						name="name"
						id="name"
						value=""
						required
						placeholder="Имя*">
				</div>
				<div class="col-xs-4">
					<input
						class="form-control form-control--input"
						type="tel"
						name="phone"
						id="phone"
						value=""
						placeholder="Телефон">
				</div>
				<div class="col-xs-4">
					<input
						class="form-control form-control--input"
						type="email"
						name="email"
						id="email"
						value=""
						required
						placeholder="Email*">
				</div>
				<div class="col-xs-12">
                     <textarea
	                     class="form-control form-control--textarea"
	                     name="message"
	                     id="message"
	                     required
	                     placeholder="Сообщение*"
	                     rows="4"></textarea>
				</div>
				<div class="text-center">
					<button onclick="yaCounter41168344.reachGoal ('contacts-form-main'); return true;" type="button" class="btn button button--hover send-message">Отправить</button>
				</div>
			</form>
		</div>
	</div> <!-- .row -->
	</div> <!-- .container -->
</section>