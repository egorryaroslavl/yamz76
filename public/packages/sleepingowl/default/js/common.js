$( function(){


	 	CKEDITOR.config.allowedContent = true;
		//CKEDITOR.stylesSet= 'mystyles:http://localhost:8000/js/styles.js';

	$( "body" ).on( "click", ".fa-check,.fa-minus", function(){
		var table = $( this ).data( 'table' );
		var id = $( this ).data( 'id' );
		var value = $( this ).attr( 'rel' );
		var newClass = [ 'fa-check', 'fa-minus' ];
		$.ajax( {
			type   : "POST",
			url    : "/reverse",
			data   : {
				table: table,
				id   : id,
				value: value,
			},
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){

					console.log( newClass[ value ] + ' ' + res.messsage )

					if( res.message == 0 ){

						$( "#comments" + id ).removeClass( 'fa-check' ).addClass( 'fa-minus' );
						$( "#public" + id ).attr( { 'rel': res.message } );
						return false;

					} else{

						$( "#public" + id ).removeClass( 'fa-minus' ).addClass( 'fa-check' );
						$( "#public" + id ).attr( { 'rel': res.message } );
						return false;

					}


					/*$( '#public' + id ).removeClass( 'fa-minus' ).removeClass( 'fa-check' ).addClass(  newClass[ value ] ).attr( { 'rel': res.message } );*/


				}
			}
		} );
	} );


	/**
	 * Транслитерация
	 */
	/* в режиме редактирования делаем поле alias только для чтения */
	var url = document.location.pathname;
	if( /(edit)/.test( url ) ){
		$( "#alias" ).attr( 'readonly', true );
	}
	/* генерим alias транслитерацией поля name */
	$( "#name,#title" ).keyup( function(){
		var url = document.location.pathname;
		$( "textarea[name='metatag_title']" ).val( $( "#name,#title,#question" ).val() );
		if( /(create|add_child)/.test( url ) ){
			var res = jQuery.parseJSON( getAlias( $( "#name,#title,#question" ).val() ) );
			$( "#alias" ).val( res.alias );
		} else{
			return false;
		}
	} );

	/* разрешаем обновление значения поля alias */
	$( "body" ).on( "dblclick", "#alias", function(){
		var alias = $.trim( $( "#alias" ).val() );
		if( alias != '' ){
			if( confirm( "Будет сгенерирован новый алиас\n и он заменит собой существующий\nПродолжить?" ) ){
				var res = jQuery.parseJSON(
					getAlias( $( "#name,#title,#question" ).val() )
				);
				$( "#alias" ).val( res.alias );
			}
		}
	} );

	$( '#someTab' ).tab( 'show' );
	/**
	 * Get transliterated words
	 */
	function getAlias( alias ){
		response = $.ajax( {
			type : 'POST',
			url  : '/translite',
			async: false,
			data : { alias_source: alias, _token: $( "input[name='_token']" ).val() }

		} ).responseText;

		return response;
	}

	/**
	 * Конец Транслитерация
	 */


	/**
	 * Сортировка
	 */
	if( $( "#sort" ).length > 0 ){

		$( "#sort" ).sortable( {
			/*handle              : ".handle",*/
			placeholder: "sortable-placeholder",
			/*			forceHelperSize     : true,
			 forcePlaceholderSize: true,*/
			containment: "parent",
			update     : function( ev, ui ){
				var sort_data = $( this ).sortable( 'serialize' );
				var table = $( this ).parent().data( 'table' );

				$.ajax( {
					type: 'POST',
					url : '/reorder',
					data: {
						sort_data: sort_data,
						table    : table

					}
				} );

			}

		} );
	}
	/**
	 * Конец Сортировка
	 */


} );

