<?php

	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	| It's a breeze. Simply tell Laravel the URIs it should respond to
	| and give it the controller to call when that URI is requested.
	|
	*/
//	Route::get( '/', 'HomeController@index');

	Route::get( '/', function (){

		return view( 'main' )
			->with( 'data', 'main' );

	} );

	Route::auth();

	Route::get( 'admin/prices', 'Prices\PricesController@index' );
	Route::get( 'admin/category/{id}/price/edit', 'Prices\PricesController@edit' );


	Route::get( 'admin/category/{id}/productions', 'Productions\ProductionsController@productions' );


	/* Весь каталог с иерархией */


	Route::get( 'admin/product/categories', 'Productions\ProductionsController@index' )->name( 'product_categories' );
	Route::get( 'admin/category/{id}/productions', 'Productions\ProductionsController@productions' );


	Route::get( 'admin/products/list', 'Productions\ProductionsController@categoriesList' );
	//http://localhost:8000/admin/category/12/subcategory

	Route::get( 'admin/category/{alias}/subcategory', 'Productions\ProductionsController@subcategoriesList' );


	Route::get( 'admin/category/{id}/edit', 'CategoryController@edit' );
	Route::post( 'admin/category/update', 'CategoryController@update' );
	Route::get( 'admin/category/{id}/clear', 'CategoryController@clear' );

	/* \\ Весь каталог */

	Route::get( 'admin/productions/{id}/edit', 'Productions\ProductionsController@edit' );

	Route::get( 'admin/excel', 'ProductsController@uploadCsvFile' );
	Route::post( 'admin/excel/upload', 'ProductsController@uploadCsv' );


	Route::get( 'admin/text_generator', 'TextGenerator@index' );
	Route::post( 'admin/textGenerator/create', 'TextGenerator@createPost' );
	Route::post( 'admin/textGenerator/create_many', 'TextGenerator@create_manyPost' );
	Route::get( 'admin/text_generator/sentences', 'TextGenerator@sentencesHtmlList' );


	Route::get( 'admin/metatags', function (){
		$metatags = \App\Model\Metatag::find( 1 );
		return view( 'admin.metatags.index' )->with( 'data', $metatags );
	} );


	Route::post( 'admin/metatag/update', function ( \Illuminate\Http\Request $request ){
		$res      = $request->all();
		$affected = DB::update(
			'
UPDATE 
`metatags` 
SET ' . $res[ 'metatag' ] . ' = ? WHERE `id` = 1', [ $res[ 'text' ] ] );

		if( $affected > 0 ){
			return json_encode( [ 'error' => 'ok', 'message' => '' ] );
		}

	} );


	Route::post( 'admin/partselect', 'TextGenerator@partSelect' );
	Route::post( 'admin/partdelete', 'TextGenerator@partDelete' );

	Route::post( 'admin/subjectsselect', 'TextGenerator@subjectSelect' );
	Route::post( 'admin/subjectdelete', 'TextGenerator@subjectDelete' );

	Route::get( 'admin/category/{id}/productions/create', 'Productions\ProductionsController@create' );
	Route::post( 'admin/productions/store', 'Productions\ProductionsController@store' );


	Route::post( 'admin/productions/edit', 'Productions\ProductionsController@update' );

	Route::post( 'admin/selected_categories', 'TextGenerator@postSelectedCategories' );


	Route::post( '/changestatus', 'AdminController@status_change' );
	Route::post( '/delete', 'AdminController@delete' );
	Route::post( '/translite', 'UtilsController@translite' );
	Route::post( '/reorder', 'UtilsController@reorder' );
	Route::post( '/chart', 'ChartController@store' );
	Route::post( '/chartload', 'ChartController@load' );
	Route::post( '/chartdel', 'ChartController@destroy' );
	Route::post( '/orderdel', 'ChartController@orderdel' );
	Route::post( '/ordersend', 'ChartController@ordersend' );
	Route::post( '/messagesend', 'ContactController@messagesend' );

	Route::post( '/changecount', 'ChartController@changecount' );
	Route::post( '/imagesave', 'AdminController@imagesave' );
	Route::post( '/iconsave', 'AdminController@iconsave' );
	Route::post( '/icondelete', 'AdminController@icondelete' );
	Route::post( '/changeprice', 'AdminController@changeprice' );
	Route::post( '/changeprices', 'ProductsController@changeprice' );

	Route::post( '/mknewprices', 'ProductsController@mknewprices' );

	Route::post( '/is_chart', 'ChartController@is_chart' );

	Route::get( '/search_result', 'SearchController@search' );
	Route::post( '/search', 'SearchController@searchPost' );

	Route::post( '/search_for_admin', 'SearchController@searchPostForAdmin' );


	Route::post( '/catalog_search', 'SearchController@searchPost' );


	Route::get( '/about', 'AboutController@index' );
	Route::get( '/contacts', 'ContactController@index' );
	Route::get( '/categories', 'YamzCategoryController@index' );
	Route::get( '/actions', 'ActionsController@index' );
	Route::get( '/action/{alias}', 'ActionsController@show' );
	Route::get( '/order', 'ChartController@order' );


	Route::get( '/category/{alias}', 'YamzCategoryController@show' );
	Route::get( '/product/{alias}-{id}', 'ProductsController@show' )->where( 'id', '[0-9]+' );
	Route::get( '/articles', 'ArticlesController@index' );
	Route::get( '/article/{alias}', 'ArticlesController@show' );
	Route::get( '/services', function (){
		$data        = \App\Model\Service::where( 'public', 1 )->orderBy( 'pos' )->paginate( 10 );
		$defaultMeta = array(
			'title'       => 'Услуги',
			'description' => 'Услуги',
			'keywords'    => 'Услуги',
		);
		\App\Http\Controllers\UtilsController::defaultMeta( $data, $defaultMeta );
		return view( 'services' )->with( 'data', $data );
	} );

	Route::get( '/service/{alias}', 'ServiceController@show' );
	/*Route::get( '/prices', 'RateController@index' );*/

	Route::get( '/responses', 'ResponsesController@index' );
	Route::get( '/response/{alias}', 'ResponsesController@show' );
	Route::get( '/clients', 'ClientsController@index' );
	Route::get( '/client/{alias}', 'ClientsController@show' );




