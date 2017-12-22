<?php

	Route::get( '', [ 'as' => 'admin.dashboard', function (){
		$content = 'Не выбран раздел...';
		return AdminSection::view( $content, 'Главная' );
	} ] );

	/*Route::get('', ['as' => 'admin.products', function () {
		$content = 'admin.products...';
		return  view('admin.productions.categorieslist');
	}]);*/
