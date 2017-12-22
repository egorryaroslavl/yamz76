<?php

	namespace App\Http\Controllers;

	use App\Model\Metatag;
	use App\Model\Seo;
	use Illuminate\Http\Request;
	use App\Http\Requests;


	class SeosController extends Controller
	{


		protected $request_uri = '';

		public static function request_uri()
		{

			if( $_SERVER[ 'REQUEST_URI' ] != "/" ){
				return ltrim( $_SERVER[ 'REQUEST_URI' ], "/" );
			}

			return '/';


		}


		public static function metatags()
		{

			$request_uri = $_SERVER[ 'REQUEST_URI' ];
			if( $_SERVER[ 'REQUEST_URI' ] != "/" ){
				$request_uri = ltrim( $_SERVER[ 'REQUEST_URI' ], "/" );
			}

			$metatag = \App\Model\Seo::where( 'name', $request_uri )->where( 'public', 1 )->first();

			if( !is_null( $metatag ) ){
				return [
					'metatag_title'       => $metatag->metatag_title,
					'metatag_description' => $metatag->metatag_description,
					'metatag_keywords'    => $metatag->metatag_keywords,

				];

			}

			return false;

		}


		public static function title( $data )
		{


			$page = isset( $_GET[ 'page' ] ) ? $_GET[ 'page' ] . ' ' : '';

			if( $data == 'main' ){
				return Seo::where( 'alias', '/' )->first()->metatag_title;
			}


			$articul = '';

			if( isset( $data->articul ) && !empty( $data->articul ) ){
				$articul = '  ' . $data->articul;
			}
			/*$data = false;*/

			/* Сначала ищем в таблице seos Основной приоритет */
			if( $aMetatags = self::metatags() ){


				/*			if( isset( $data->articul ) && !empty( $data->articul ) ){
								$articul =  $data->articul  ;
							}*/

				if( isset( $aMetatags[ 'metatag_title' ] )
					&& !empty( $aMetatags[ 'metatag_title' ] )
				){
					return $page . str_replace( "/$articul/", '', $aMetatags[ 'metatag_title' ]) . ' ' . $articul;

				}
			}


			/* Если в seos не нашлось, ищем в объекте $data */
			if( $data && isset( $data->metatag_title ) && !empty( $data->metatag_title ) ){

				if( preg_match( "/$articul/", $data->metatag_title ) ){

					return   $page . str_replace( "/$articul/", '', $data->metatag_title );

				} else{

					return   $page .  str_replace( "$articul", '', $data->metatag_title ) . '   ' /* $articul*/;

				}


			}


			if( mb_strpos( $_SERVER[ 'REQUEST_URI' ], 'product' ) > 0 && isset( $data ) ){
				$title = Metatag::find( 1 )->title;
				return   ProductsController::overTextOutPut( $title, $data ) . ' ';
			}


			/* Если в объекте $data не нашлось, ищем в объекте $data  $data->defaultMeta */
			if( $data
				&& isset( $data->defaultMeta )
				&& isset( $data->defaultMeta->title )
				&& !empty( $data->defaultMeta->title )
			){
				return  $page . $data->title . ' ' . $articul;
			}

			/* Если в объекте $data не нашлось, ищем в объекте $data  $data->name */
			if( $data && isset( $data->name ) && !empty( $data->name ) ){
				return   $page . $data->name . ' ' . $articul;
			}

		}


		public static function description( $data = false )
		{

			$add  = ' страница каталога сайта';
			$page = isset( $_GET[ 'page' ] ) ? ' ' . ' - ' . $_GET[ 'page' ] . $add : '';

			if( $data == 'main' ){
				return Seo::where( 'alias', '/' )->first()->metatag_description;
			}

			/* Сначала ищем в таблице seos Основной приоритет */

			if( $aMetatags = self::metatags() ){

				if( isset( $aMetatags[ 'metatag_description' ] )
					&& !empty( $aMetatags[ 'metatag_description' ] )
				){
					return $aMetatags[ 'metatag_description' ] . $page;

				}
			}

			/* Если в seos не нашлось, ищем в объекте $data */
			if( $data
				&& isset( $data->metatag_description )
				&& !empty( $data->metatag_description )
			){
				return $data->metatag_description . $page;
			}

			if( mb_strpos( $_SERVER[ 'REQUEST_URI' ], 'product' ) > 0 && isset( $data ) ){
				$description = Metatag::find( 1 )->description;
				return ProductsController::overTextOutPut( $description, $data );
			}


			/* Если в объекте $data не нашлось, ищем в объекте $data  $data->defaultMeta */
			if( $data
				&& isset( $data->defaultMeta )
				&& isset( $data->defaultMeta->description )
				&& !empty( $data->defaultMeta->description )
			){
				return $data->defaultMeta->description . $page;
			}

			/* Если в объекте $data не нашлось, ищем в объекте $data  $data->name */
			if( $data && isset( $data->name ) && !empty( $data->name ) ){
				return $data->name . $page;
			}

		}

		public static function keywords( $data = false )
		{


			$page = isset( $_GET[ 'page' ] ) ? $_GET[ 'page' ] . ' ' : '';

			if( $data == 'main' ){
				return Seo::where( 'alias', '/' )->first()->metatag_keywords;
			}

			/* Сначала ищем в таблице seos Основной приоритет */
			$keywords = \App\Model\Seo::where( 'name', self::request_uri() )->first();
			if( $keywords
				&& isset( $keywords->metatag_keywords )
				&& !empty( $keywords )
			){
				return $keywords->metatag_keywords;
			}


			/* Если в seos не нашлось, ищем в объекте $data */
			if( $data
				&& isset( $data->metatag_keywords )
				&& !empty( $data->metatag_keywords )
			){
				return $data->metatag_keywords;
			}

			if( mb_strpos( $_SERVER[ 'REQUEST_URI' ], 'product' ) > 0 && isset( $data ) ){
				$keywords = Metatag::find( 1 )->keywords;
				return ProductsController::overTextOutPut( $keywords, $data );
			}


			/* Если в объекте $data не нашлось, ищем в объекте $data  $data->defaultMeta */
			if( $data
				&& isset( $data->defaultMeta )
				&& isset( $data->defaultMeta->keywords )
				&& !empty( $data->defaultMeta->keywords )
			){
				return $data->defaultMeta->keywords;
			}

			/* Если в объекте $data не нашлось, ищем в объекте $data  $data->name */
			if( $data && isset( $data->name ) && !empty( $data->name ) ){
				return $page . $data->name;
			}

		}
	}
