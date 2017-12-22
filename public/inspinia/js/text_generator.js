$( function(){

	partsSelectsLoad();


	if( $.cookie( 'sentenceSelOpt' ) ){
		$( "#sentence" + $.cookie( 'sentenceSelOpt' ) ).prop( 'selected', true );
		partsSelectsLoad();
	}


	/*  при выборе категории формируем список отобранных категорий и дисаблим оптионы  */
	$( "body" ).on( "change", "#yamz_categories", function(){

		if( $( this ).val() != "0" ){

			$( "#no-related" ).remove();
			var id = $( this ).val();
			var text = $( this ).find( "option:selected" ).text();
			$( this ).next().append( ids_input( id, text ) );
			$( this ).find( "option:selected" ).prop( 'disabled', true );

		}

	} );

	/* Удалить выбранную категорию */
	$( "body" ).on( "click", ".categories_del", function(){
		var catId = $( this ).data( 'id' );
		$( this ).parent().fadeOut( 600, function(){
			$( this ).remove();
		} );


	} );

	/* выбор номера предложения */
	$( "body" ).on( "change", "#sentence", function(){
		$( this ).css( { "border": "inherit" } );
		$.cookie( 'sentenceSelOpt', $( this ).val() );
		partsSelectsLoad();
	} );


	/* при выборе части предложения из селекта отправляем его данные в input для редактироания */
	$( "body" ).on( "change", ".partsSelect", function(){

		var text = $( this ).find( "option:selected" ).text();
		var part_id = $( this ).find( "option:selected" ).val();
		var position = $( this ).find( "option:selected" ).data( 'position' );
		if( part_id == '0' ){
			$( "#part" + position ).val( '' );
			$( "#part" + position + "_button" ).removeAttr( "data-part_id" );
			return false;
		}

		loadRelatedCategores( part_id );

		$( "#part" + position + "_button" )
			.removeAttr( "data-part_id" )
			.attr( 'data-part_id', part_id );

		$( "#part" + position ).val( text );


	} );


	/* сохранение новой части предложения */
	$( "body" ).on( "click", ".part_button", function(){

		var position = $( this ).data( 'position' ); // позиция в предложении a, b, или c
		var part = $( "#part" + position ).val(); // текст части
		var sentence = $( "#sentence" ).val(); // номер предложения
		/*var subject = $( "#subject" ).val();*/
		var select = $( ".position_" + position );
		var part_id = $( ".position_" + position ).find( "option:selected" ).val();
		var ids = $( "form" ).serializeArray(); // привязанные категории

		if( sentence == '0' ){
			alert( "Не выбрана категория для привязки!\nСледует выбрать категорию!" );
		}


		oData = {
			'position': position,
			'part'    : part,
			'sentence': sentence,
			'part_id' : part_id,
			'ids'     : ids,
			'_token'  : $( "#_token" ).val()
		};


		$.ajax( {
			type   : "POST",
			url    : "/admin/textGenerator/create",
			data   : oData,
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){

					$( "#part" + position ).val( "" );

					partSelectLoad( position, {
						'sentence': sentence,
						'position': position,
						'part_id' : res.part_id,
						'_token'  : $( "#_token" ).val()
					} )

				}
				if( res.error == 'error' ){
					alert( 'Операция закончилась ошибкой!' )
				}
			}
		} );

	} );


	/* множественное сохранение новой частей предложения */
	$( "body" ).on( "click", "#many_once", function(){

		var ids = "";
		var partA = $( "#part_a" ).val(); // текст части a
		var partB = $( "#part_b" ).val(); // текст части b
		var partC = $( "#part_c" ).val(); // текст части c
		var sentence = $( "#sentence" ).val(); // номер предложения

		ids = $( "form" ).serializeArray(); // привязанные категории

		if( ids == "" ){
			alert( "Не выбрана категория/категории!" );
			$( "#yamz_categories" ).focus().css( { "border": "2px orange solid" } );
			return false;
		}


		if( sentence == '0' ){
			alert( "Не выбран номер предложения!" );
			$( "#sentence" ).focus().css( { "border": "2px orange solid" } );
			return false;
		}


		oData = {
			'many_once': true,
			'partA'    : partA,
			'partB'    : partB,
			'partC'    : partC,
			'sentence' : sentence,
			'ids'      : ids,
			'_token'   : $( "#_token" ).val()
		};


		$.ajax( {
			type   : "POST",
			url    : "/admin/textGenerator/create_many",
			data   : oData,
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){

					$( "#part_a" ).val( "" );
					$( "#part_b" ).val( "" );
					$( "#part_c" ).val( "" );

				}
				if( res.error == 'error' ){
					alert( 'Операция закончилась ошибкой!' )
				}
			}
		} );

	} );


	/* удаление части предложения */
	$( "body" ).on( "click", ".part_del_button", function(){

		var select_id = $( this ).data( 'parts-select-id' );
		var position = $( this ).data( 'position' );
		var part_id = $( "#" + select_id ).val();

		if( part_id == 0 ){
			var ansv = confirm( "Желаете удалить пункт [" + $( "#" + select_id + " option:selected" ).text() + "]?" );
			if( ansv ){
				alert( "Дурака не валяйте!" )
			}

		} else{

			var ansv = confirm( "Пункт [" + $( "#" + select_id + " option:selected" ).text() + "] будет удалён!\nПродолжить?" );
			if( ansv ){
				$.ajax( {
					type   : "POST",
					url    : "/admin/partdelete",
					data   : {
						'part_id': part_id,
						'_token' : $( "#_token" ).val()
					},
					success: function( msg ){
						var res = jQuery.parseJSON( msg );
						if( res.error == 'ok' ){
							$( "#opt" + part_id ).remove();
							$( "#part" + position ).val( '' );
						}
					}
				} );
			}
		}


	} );


	/* загрузка селекта с частями */
	function partSelectLoad( position, oData ){

		$( "#part" + position + "_select" )
			.load( '/admin/partselect', oData );
	};


	$( "body" ).on( "click", ".metatag", function(){

		var metatag = $( this ).data( 'metatag' );
		var value = $( "#" + metatag + "_button" ).val();
		$.ajax( {
			type   : "POST",
			url    : "/admin/metatag/update",
			data   : {
				'metatag': metatag,
				'text'   : value,
				'_token' : $( "#_token" ).val()
			},
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){
					$( "#" + metatag + "_button" ).removeClass("animated rubberBand").addClass( "animated rubberBand" );
				}
			}
		} );

	} );


	function partsSelectsLoad(){

		if( $( '#parta_select' ).length ){

			var data = {
				'sentence': $( "#sentence" ).val(),
				'position': 'a',
				'_token'  : $( "#_token" ).val()
			};
			partSelectLoad( 'a', data );
		}

		if( $( '#partb_select' ).length ){
			var data = {
				'sentence': $( "#sentence" ).val(),
				'position': 'b',
				'_token'  : $( "#_token" ).val()
			};
			partSelectLoad( 'b', data );
		}


		if( $( '#partc_select' ).length ){
			var data = {
				'sentence': $( "#sentence" ).val(),
				'position': 'c',
				'_token'  : $( "#_token" ).val()
			};
			partSelectLoad( 'c', data );
		}
	}

	/* вставка якорей */
	$( "body" ).on( "click", ".smallBtn", function(){

		insertTextAtCursor( document.getElementById( $( this ).data( 'input_id' ) ), $( this ).data( 'anchor' ) );
	} );


	$( "body" ).on( "focus", ".partsSelect", function(){

		if( $( "#sentence" ).val() == 0 ){
			alert( "Не выбран номер предложения!" );
			$( "#sentence" ).focus().css( { "border": "2px orange solid" } );
			return false;
		}

	} );

	function insertTextAtCursor( el, text, offset ){
		var val = el.value, endIndex, range, doc = el.ownerDocument;
		if( typeof el.selectionStart == "number"
			&& typeof el.selectionEnd == "number" ){
			endIndex = el.selectionEnd;
			el.value = val.slice( 0, endIndex ) + text + val.slice( endIndex );
			el.selectionStart = el.selectionEnd = endIndex + text.length + (offset ? offset : 0);
		} else if( doc.selection != "undefined" && doc.selection.createRange ){
			el.focus();
			range = doc.selection.createRange();
			range.collapse( false );
			range.text = text;
			range.select();
		}
	}


	function ids_input( id, text ){
		return '<div name="yamz_categories_id"  class="sel-btn"><input type="hidden" name="ids" value="' + id + '" ><i title="Удалить" class="fa fa-times categories_del" data-id="' + id + '"></i> ' + text + '</div>';
	};


	function loadRelatedCategores( part_id ){

		$( "#sr" ).empty().load( "/admin/selected_categories", {
			'_token': $( "#_token" ).val(),
			part_id : part_id
		}, function(){
		} );


	};


} );

