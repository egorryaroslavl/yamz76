<?php


	if( !function_exists( 'bytesToHuman' ) ){
		function bytesToHuman( $bytes )
		{
			return \App\Http\Controllers\CustomHelpers::bytesToHuman( $bytes );
		}

	}


	if( !function_exists( 'withFirstElement' ) ){
		function withFirstElement( $sourceArray, $customText = false )
		{
			return \App\Http\Controllers\CustomHelpers::withFirstElement( $sourceArray, $customText = false );
		}

	}


	if( !function_exists( 'ruDate' ) ){
		function ruDate( $date )
		{
			return \App\Http\Controllers\CustomHelpers::ruDate( $date );
		}
	}

	if( !function_exists( 'translite' ) ){
		function translite( $str )
		{
			return \App\Http\Controllers\CustomHelpers::translite( $str );
		}
	}


