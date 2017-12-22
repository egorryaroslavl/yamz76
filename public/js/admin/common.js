$( function(){





	/**
	 * Транслитерация
	 */
	/* в режиме редактирования делаем поле alias только для чтения */
	var url = document.location.pathname;
/*
	if( /(edit)/.test( url ) ){
		$( "#alias" ).attr( 'readonly', true );
	}
	/!* генерим alias транслитерацией поля name *!/
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

	/!* разрешаем обновление значения поля alias *!/
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


	/!**
	 * Get transliterated words
	 *!/
	function getAlias( alias ){
		response = $.ajax( {
			type : 'POST',
			url  : '/translite',
			async: false,
			data : { alias_source: alias, _token: $( "input[name='_token']" ).val() }

		} ).responseText;

		return response;
	}
*/

	/**
	 * Конец Транслитерация
	 */





} );
