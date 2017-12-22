$( function(){

	if( $( "#description" ).length > 0 ){
		CKEDITOR.replace( 'description' );
		CKEDITOR.config.allowedContent = true;
		CKEDITOR.config.height = 150;
	}
	/* check / uncheck */
	$( "#checkAll" ).change( function(){
		$( "input:checkbox" ).prop( 'checked', $( this ).prop( "checked" ) );
		if( $( "#checkAll" ).prop( "checked" ) ){
			$( "#change-all-prices" ).fadeIn( 900 );
		}
	} );


	/* Меняем input */
	$( "body" ).on( 'change', "#todo", function(){
		var act = $( this ).val();
		if( act == 'chislo' ){
			$( "#chislo_label" ).show( 900 );
			$( "#percents_label" ).hide( 900 );
		} else{
			$( "#chislo_label" ).hide( 900 );
			$( "#percents_label" ).show( 900 );
		}
		if( act == '0' ){
			$( "#chislo_label" ).hide( 900 );
			$( "#percents_label" ).hide( 900 );
		}

	} );

	/* Загрузка формы изменения всех цен категории */
	$( "body" ).on( "click", ".change-category-prices", function(){
		var categoryId = $( this ).data( 'category-id' );
		/* идём генерить форму */
		$.ajax( {
			type   : "POST",
			url    : "/changeprices",
			data   : {
				ids        : 'all',
				category_id: categoryId,
				_token     : $( "#_token" ).val()
			},
			success: function( msg ){

				$( '#placeModal' ).html( msg );
				$( '#makechangeform' ).modal();

			}
		} );

	} );


	/* Загрузка формы изменения цен */
	$( "body" ).on( "click", "#change-all-prices", function(){

		var ids = {};
		var categoryId = $( this ).data( 'category-id' );
		var countChecked = $( '.change-price-checkbox:checkbox:checked' ).length; // сколько чекнуто
		if( countChecked > 0 ){
			if( countChecked == 1 ){
				alert( "Из-за одной позиции напрягаться не буду! " );
				return false;
			}

			/* набиваем объект данными */
			$( '.change-price-checkbox:checkbox:checked' ).each( function(){

				ids[ $( this ).data( 'id' ) ] = $( this ).data( 'price' );

			} );
			/* городим json */
			var idsJson = JSON.stringify( ids );

			/* идём генерить форму */
			$.ajax( {
				type   : "POST",
				url    : "/changeprices",
				data   : {
					ids        : idsJson,
					category_id: categoryId,
					_token     : $( "#_token" ).val()
				},
				success: function( msg ){

					$( '#placeModal' ).html( msg );
					$( '#makechangeform' ).modal();

				}
			} );
		}

	} );


	/* Отправляем массив ID для вычисления новых цен */
	$( "body" ).on( "click", "#go-btn", function(){

		var todo = $( "#todo" ).val();
		var ids = $( "#ids" ).val();
		var percents = $( "#percents" ).val();
		var chislo = $( "#chislo" ).val();
		var category_id = $( "#category_id" ).val();
		if( todo != '0' && ids != '' ){
			$.ajax( {
				type   : "POST",
				url    : "/mknewprices",
				data   : {
					ids        : ids,
					todo       : todo,
					percents   : percents,
					chislo     : chislo,
					category_id: category_id,
					_token     : $( "#_token" ).val()
				},
				success: function( msg ){
					var res = jQuery.parseJSON( msg );
					if( res.error == 'ok' ){
						document.location.reload();
					}
					if( res.error == 'error' ){
						alert( 'Операция закончилось ошибкой!' )
					}
				}
			} );
		}

	} );


	/* Удаление */
	$( "body" ).on( "click", ".del", function(){

	/*	alert( $( '.del' ).length );*/

		confirm( "Запись будет удалена!\nПродолжить?" )
		var id = $( this ).data( 'id' );
		var table = $( this ).data( 'table' );
		$.ajax( {
			type   : "POST",
			url    : "/delete",
			data   : {
				id    : id,
				table : table,
				_token: $( "#_token" ).val()
			},
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){
					$( "#id_" + id ).slideDown( 900 )
					{
						$( "#id_" + id ).remove();
					}

				}
				if( res.error == 'error' ){
					alert( res.message )
				}
			}
		} );
	} );


	$( '.i-checks' ).iCheck( {
		checkboxClass: 'icheckbox_square-green',
		radioClass   : 'iradio_square-green',
	} );

	/*	</script>*/

	$( "#hm" ).html( $( "#percents" ).val() );
	$( "body" ).on( "change", "#percents", function(){
		$( "#hm" ).html( $( this ).val() );
	} );

	/* Сортировка */
	$( "#sortable" ).sortable( {
		placeholder         : "ui-state-highlight",
		handle              : ".reorder",
		forceHelperSize     : true,
		forcePlaceholderSize: true,
		revert              : true,
		update              : function( ev, ui ){
			var sort_data = $( this ).sortable( 'serialize' );
			var table = $( this ).data( 'table' );
			$.ajax( {
				type: 'POST',
				url : '/reorder',
				data: {
					sort_data: sort_data,
					table    : table,
					_token   : $( "#_token" ).val()
				}
			} );
		}
	} );

	/* Изменение статуса .public,.hit,.anons" */
	$( "body" ).on( "click", ".public,.hit,.anons", function(){
		var id = $( this ).data( 'id' );
		var table = $( this ).data( 'table' );
		var field = $( this ).attr( 'name' );
		var value = $( this ).val();
		var elId = field + "_" + id;
		$.ajax( {
			type   : "POST",
			url    : "/changestatus",
			data   : {
				table : table,
				id    : id,
				field : field,
				value : value,
				_token: $( "#_token" ).val()
			},
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){
					changeStatus( field, elId, value );
				}
				if( res.error == 'error' ){
					alert( 'Изменение статуса закончилось ошибкой!' )
				}
			}
		} );

	} );


	/* Удаление иконки */
	$( "body" ).on( "dblclick", "#icon-preview", function(){
		var id = $( this ).data( 'id' );
		var table = $( this ).data( 'table' );
		var icon = $( this ).data( 'icon' );
		if( confirm( "Изображение будет удалено!\nПродолжить?" ) ){
			$.ajax( {
				type   : "POST",
				url    : "/icondelete",
				data   : {
					table : table,
					id    : id,
					icon  : icon,
					_token: $( "#_token" ).val()
				},
				success: function( msg ){

					var res = jQuery.parseJSON( msg );
					if( res.error == 'ok' ){

						$( "#icon-preview" ).css( 'background-image', 'none' )
					}
					if( res.error == 'error' ){
						alert( res.message )
					}

				}
			} );
		}

	} );

	/* Изменение цены */
	$( "body" ).on( "click", ".change-price", function(){

		var id = $( this ).data( 'id' );
		var table = $( this ).data( 'table' );
		var price = $( "#price-input" + id ).val();
		$.ajax( {
			type   : "POST",
			url    : "/changeprice",
			data   : {
				table : table,
				id    : id,
				price : price,
				_token: $( "#_token" ).val()
			},
			success: function( msg ){

				if( msg   ){
					var res = jQuery.parseJSON( msg );
					if( res.error == 'ok' ){

						$( "#id_" + id ).addClass( "animated rubberBand" );
					}
					/*		if( res.error == 'error' ){
					 alert( res.message )
					 }*/
				}


			}
		} );
	} );

	changeStatus = function( field, elId, value ){

		var Idle = "i_" + elId;
		var newValue = value == 0 ? 1 : 0;
		$( "#" + elId ).val( newValue ); // меняем значение кнопки
		if( newValue == 0 ){
			$( "#" + Idle ).addClass( 'shadow' );
			if( field == 'public' ){
				$( "#name_" + elId ).addClass( 'shadow' );
			}
		}
		if( newValue == 1 ){
			$( "#" + Idle ).removeClass( 'shadow' );
			if( field == 'public' ){
				$( "#name_" + elId ).removeClass( 'shadow' );
			}
		}

	}


} );

