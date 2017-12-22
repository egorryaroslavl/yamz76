$( function(){

	partsSelectsLoad();
	subjectsSelectLoad();

	$( "body" ).on( "change", "#sentence", function(){
		$( this ).css( { "border": "inherit" } );
		partsSelectsLoad();
	} );


	$( "body" ).on( "change", ".partsSelect", function(){

		var text = $( this ).find( "option:selected" ).text();
		var part_id = $( this ).find( "option:selected" ).val();
		var position = $( this ).find( "option:selected" ).data( 'position' );
		if( part_id == '0' ){
			$( "#part" + position ).val( '' );
			$( "#part" + position + "_button" ).removeAttr( "data-part_id" );
			return false;
		}


		$( "#part" + position + "_button" )
			.removeAttr( "data-part_id" )
			.attr( 'data-part_id', part_id );
		$( "#part" + position ).val( text );


	} );

	//$( "body" ).on( "click", ".part_button", function(){});

	$( "body" ).on( "click", ".part_button", function(){

		var position = $( this ).data( 'position' );
		var part = $( "#part" + position ).val();
		var sentence = $( "#sentence" ).val();
		var subject = $( "#subject" ).val();
		var select = $( ".position_" + position );
		var part_id =  $( ".position_"+ position).find( "option:selected" ).val();


		if( sentence == '0' && $.trim( subject ) == '' ){
			alert( "Не выбрана категория для привязки и не введена новая!\nСледует выбрать категорию или определить новую!" );
		}



		oData = {
			'position': position,
			'part'    : part,
			'sentence': sentence,
			'subject' : subject,
			'part_id' : part_id,
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

	$( "body" ).on( "click", ".part_del_button", function(){

		var select_id = $( this ).data( 'parts-select-id' );
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
						}
					}
				} );
			}
		}


	} );


	function partSelectLoad( position, oData ){

		$( "#part" + position + "_select" )
			.load( '/admin/partselect', oData );
	};


	function subjectsSelectLoad(){
		$( "#subject_select" )
			.load( '/admin/subjectsselect', {
				'count' : 'all',
				'_token': $( "#_token" ).val()
			} );
	}


	function partsSelectsLoad(){
		if( $( '#parta_select' ).length > 0 ){

			var data = {
				'sentence': $( "#sentence" ).val(),
				'position': 'a',
				'_token'  : $( "#_token" ).val()
			};
			partSelectLoad( 'a', data );
		}

		if( $( '#partb_select' ).length > 0 ){
			var data = {
				'sentence': $( "#sentence" ).val(),
				'position': 'b',
				'_token'  : $( "#_token" ).val()
			};
			partSelectLoad( 'b', data );
		}


		if( $( '#partc_select' ).length > 0 ){
			var data = {
				'sentence': $( "#sentence" ).val(),
				'position': 'c',
				'_token'  : $( "#_token" ).val()
			};
			partSelectLoad( 'c', data );
		}
	}

	$( "body" ).on( "click", ".smallBtn", function(){

		//	var patrCont = $( "#partc" ).val();
		//$( "#partc" ).val( $( this ).data( 'anchor' ) + patrCont );
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
} );

