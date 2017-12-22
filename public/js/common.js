if( !$.cookie( 'chart-body' ) ){
	$.cookie( 'chart-body', 'hide', { path: '/' } );
}
$( function(){

	jQuery( document ).on( 'keyup', 'body', function( e ){
		e = e || window.event;
		if( e.keyCode === 91 ){
			swal( {
					title    : "Вход в административную часть",
					imageUrl : "images/tools.png",
					imageSize: "128x128",
					text     : "Жду семь секунд!",

					showCancelButton  : true,
					html              : true,
					cancelButtonText  : 'Закрыть',
					confirmButtonClass: 'btn btn-sm hvr-bounce-to-right',
					confirmButtonText : 'Войти',
					closeOnConfirm    : true,
					closeOnCancel     : true,
					timer             : 7000
				},
				function(){
					window.open( "/admin", "_blank" );
					//document.location.href = "/admin";
				} );
		}
		return false;
	} );

	loadChart();
	totalCount();
	cartTotal();
	$( "body" ).on( "click", ".get-order", function(){

		var btn = $( this );
		var productId = btn.data( 'product_id' );
		var price = btn.data( 'price' );
		var count = $( ".product-count" ).val();
		var categoryId = btn.data( 'category_id' );
		$.ajax( {
			type   : "POST",
			url    : "/chart",
			data   : {
				product_id : productId,
				price      : price,
				count      : count,
				category_id: categoryId,
				_token     : $( "#_token" ).val()
			},
			success: function(){

				$( "#appaend" + productId ).fadeToggle( 1500, function(){
					$( "#appaend" + productId ).fadeToggle( 1500 );
				} );
				loadChart();
			}
		} );

	} );

	/* Загрузка корзины заказов */
	function loadChart(){

		var state = 'show';
		if( $.cookie( 'chart-body' ).length > 0 ){
			state = $.cookie( 'chart-body' );
		}

		//$( ".shoping-cart-place" ).remove();

		$.ajax( {
			type   : "POST",
			url    : "/chartload",
			data   : { _token: $( "#_token" ).val(), state: state },
			success: function( msg ){
				if( $( '#order-page' ).length == 0 ){

					$( ".shoping-cart" ).html( msg );
					totalCount();
					cartTotal();

				} else{

				}
			}
		} );


	};

	/* Удаление пункта в заказе */
	$( "body" ).on( "click", ".del-product-item", function(){

		var id = $( this ).data( 'id' );
		$.ajax( {
			type   : "POST",
			url    : "/chartdel",
			data   : { _token: $( "#_token" ).val(), id: id },
			success: function(){
				window.location.reload( true );
				loadChart();
			}
		} );

	} );

	/* Удаление всего заказа */
	$( "body" ).on( "click", ".del-order", function(){

		if( confirm( 'Ваш заказ будет удалён!\nПродолжить?' ) ){
			$.ajax( {
				type   : "POST",
				url    : "/orderdel",
				data   : { _token: $( "#_token" ).val() },
				success: function(){
					loadChart();
				}
			} );
		}


	} );

	/* Измененение количества  */
	$( "body" ).on( "change", ".product-count", function(){
		var id = $( this ).data( 'id' );
		var price = $( this ).data( 'price' );
		var count = $( this ).val();
		var res = parseFloat( price ) * parseFloat( count );
		$( "#summ" + id ).text( res.toFixed( 2 ) );
		var tt = totalCount();
		$( ".total" ).text( tt );
		$.ajax( {
			type   : "POST",
			url    : "/changecount",
			data   : { _token: $( "#_token" ).val(), id: id, count: count },
			success: function( msg ){
				/*loadChart();*/
			}
		} );
	} );

	/* Подсчёт суммы */
	function totalCount(){
		var total = 0;
		$( ".summ" ).each( function(){
			var value = $( this ).text();
			total = parseFloat( value ) + total;
		} );
		return total.toFixed( 2 );

	}

	function cartTotal(){
		if( $( "#total-count" ).length > 0 ){
			var total = $( "#total-count" ).val() + ' позиций';
			$( "#cart-total" ).text( total );
		}
	}


	function chartBodyHide(){
		$( ".chart-body" ).hide( 900 );
		$.cookie( 'chart-body', 'hide', { path: '/' } );
	}

	function chartBodyShow(){
		$( ".chart-body" ).show( 900 );
		$.cookie( 'chart-body', 'show', { path: '/' } );
	}


	if( $.cookie( 'chart-body' ) == 'show' ){
		chartBodyShow();
	}
	if( $.cookie( 'chart-body' ) == 'hide' ){
		chartBodyHide();
	}


	$( "body" ).on( "click", ".close-chart", function(){
		chartBodyHide();
	} );

	$( "body" ).on( "click", ".fa-shopping-basket", function(){
		chartBodyShow();
	} );

	$( ".partners-carousel" ).owlCarousel( {
		items   : 6,
		margin  : 3,
		autoplay: true,

	} );


	/* отправка сообщения */
	$( "body" ).on( "click", ".send-message", function(){

		if( $( "#name" ).val().length == 0 ){
			alert( 'Не заполнено поле "Компания"' );
			return false;
		}

		if( $( "#phone" ).val().length == 0 ){
			alert( 'Не заполнено поле "Телефон"' );
			return false;
		}
		if( $( "#email" ).val().length == 0 ){
			alert( 'Не заполнено поле "Email"' );
			return false;
		}

		var sendData = {
			name   : $( "#name" ).val(),
			phone  : $( "#phone" ).val(),
			email  : $( "#email" ).val(),
			message: $( "#message" ).val(),
			_token : $( "#_token" ).val()
		};
		$( "#contact-form" ).html( '<div class="col-md-12"><h3 class="text-center">Идёт отправка...</h3></div>' );
		$.ajax( {
			type   : "POST",
			url    : "/messagesend",
			data   : sendData,
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){
					document.getElementById( "send-message" ).reset();

					$( "#send-message" ).html( '<div class="col-md-12"><div class="jumbotron"><h2>Ваше сообщение успешно отправлено!</h2><p>Благодарим за обращение в нашу компанию!</p></div></div>' );


				}

			}
		} );


	} );

	/* отправка заявки */
	$( "body" ).on( "click", ".send-order", function(){

		if( $( "#companyname" ).val().length == 0 ){
			alert( 'Не заполнено поле "Компания"' );
			return false;
		}
		if( $( "#username" ).val().length == 0 ){
			alert( 'Не заполнено поле "Имя"' );
			return false;
		}
		if( $( "#userphone" ).val().length == 0 ){
			alert( 'Не заполнено поле "Телефон"' );
			return false;
		}
		if( $( "#useremail" ).val().length == 0 ){
			alert( 'Не заполнено поле "Email"' );
			return false;
		}

		var sendData = {
			companyname: $( "#companyname" ).val(),
			username   : $( "#username" ).val(),
			userphone  : $( "#userphone" ).val(),
			useremail  : $( "#useremail" ).val(),
			usercomment: $( "#usercomment" ).val(),
			_token     : $( "#_token" ).val()
		};
		$( "#order-form" ).html( '<div class="col-md-12"><h3 class="text-center">Идёт отправка...</h3></div>' );
		$.ajax( {
			type   : "POST",
			url    : "/ordersend",
			data   : sendData,
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){

					$( "#order-form" ).html( '<div class="col-md-12"><div class="jumbotron"><h2>Ваша заявка успешно отправлена!</h2><p>Копия вашей заявки выслана на ваш E-mail.</p><p>Наши сотрудники скоро свяжутся с вами.</p><p>Благодарим за обращение в нашу компанию!</p></div></div>' );

					$.ajax( {
						type   : "POST",
						url    : "/orderdel",
						data   : { _token: $( "#_token" ).val() },
						success: function(){
							loadChart();
						}
					} );

				}

			}
		} );


	} );
	function is_chart(){
		$.ajax( {
			type   : "POST",
			url    : "/is_chart",
			data   : { _token: $( "#_token" ).val() },
			success: function( msg ){
				return msg;
			}
		} );
	}


	$( "body" ).on( "click", ".search", function(){

		$.ajax( {
			type   : "POST",
			url    : "/search",
			data   : {
				search: $( '#main-search' ).val(),
				_token: $( "#_token" ).val()
			},
			success: function( msg ){
				if( msg ){
					$( 'main' ).html( msg );
				}
			}
		} );

	} );

} );
