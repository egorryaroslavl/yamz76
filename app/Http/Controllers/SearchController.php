<?php

	namespace App\Http\Controllers;

	use App\Model\Product;
	use Illuminate\Http\Request;
	use App\Http\Requests;

	class SearchController extends Controller
	{
		public function search( Request $request )
		{


			return view( 'search' )->with( 'data', $request );


		}

		public function searchPost( Request $request )
		{

			if( empty( $request->search ) ){
				return \Redirect::back()
					->withErrors( [ 'Не заполнено поле запроса.', 'Не заполнено поле запроса.' ] );
			}

			if( mb_strlen( $request->search ) <= 2 ){
				return \Redirect::back()
					->withErrors( [ 'Запрос менее трёх символов!', 'Запрос менее трёх символов!' ] );
			}

			$request->search = str_replace('\\','-',$request->search);
			$request->search = str_replace('/','-',$request->search);
			$articulSearch = preg_replace( '%[\x20\x2A\x2C\x2D\x2E\x2F\x5C\x20\x2A\x2C\x2D\x2E\x2F\x5C\x5F\x96\x96\x20\x2A\x2C\x2D\x2E\x2F\x3A\x3B\x5C\x5F\x96]%i', '(.|,|-|_|\\\\\\\\|//)', mb_strtolower( trim( $request->search ) ) );


			$sql = '
SELECT `id`,`name`,`alias`,`articul`,`price` FROM products WHERE BINARY LOWER(articul) REGEXP  "' . $articulSearch . '" 
OR    LOWER(`name`)   LIKE "%' . trim( mb_strtolower( $request->search ) ) . '%" 
OR  `alias` LIKE "%' . trim( $request->search ) . '%"';


			\DB::query( 'SET NAMES utf8' );

			$data = \DB::select( $sql );

			return view( 'search', [ 'data' => $data, 'word' => trim( $request->search ), 'count' => count( $data ) ] );

		}

		public function searchPostForAdmin( Request $request )
		{

			if( empty( $request->search ) ){
				return \Redirect::back()
					->withErrors( [ 'Не заполнено поле запроса.', 'Не заполнено поле запроса.' ] );
			}

			if( mb_strlen( $request->search ) <= 2 ){
				return \Redirect::back()
					->withErrors( [ 'Запрос менее трёх символов!', 'Запрос менее трёх символов!' ] );
			}

			$request->search = str_replace('\\','-',$request->search);
			$request->search = str_replace('/','-',$request->search);

			$articulSearch = preg_replace( '%[\x20\x2A\x2C\x2D\x2E\x2F\x5C\x20\x2A\x2C\x2D\x2E\x2F\x5C\x5F\x96\x96\x20\x2A\x2C\x2D\x2E\x2F\x3A\x3B\x5C\x5F\x96]%i', '(.|,|-|_|\\\\|\\//)', mb_strtolower( trim( $request->search ) ) );


			$sql = '
SELECT `id`,`name`,`alias`,`articul`,`price` FROM products WHERE BINARY LOWER(articul) REGEXP "' . $articulSearch . '" 
OR LOWER(`name`)   LIKE "%' . trim( mb_strtolower( $request->search ) ) . '%" 
OR  `alias` LIKE "%' . trim( $request->search ) . '%"';


			\DB::query( 'SET NAMES utf8' );

			$data = \DB::select( $sql );

			echo  view( 'admin.common.search_result', [ 'data' => $data, 'word' => trim( $request->search ), 'count' => count( $data ) ] )->render();

		}



/*		public function searchPostForAdmin( Request $request )
		{

			if( empty( $request->search ) ){
				return \Redirect::back()
					->withErrors( [ 'Не заполнено поле запроса.', 'Не заполнено поле запроса.' ] );
			}

			if( mb_strlen( $request->search ) <= 2 ){
				return \Redirect::back()
					->withErrors( [ 'Запрос менее трёх символов!', 'Запрос менее трёх символов!' ] );
			}

			$int   = preg_replace( "/\s/", '', trim( $request->search ) );
			$price = is_numeric( $int ) ? $int : $request->search;

			$articulSearch = preg_replace( '%[-_.,\\\\/\s]%i', '(.|,|-|_|\\\\\\\\|//)', mb_strtolower( trim( $request->search ) ) );

			$sql = '
SELECT * FROM products WHERE BINARY LOWER(articul) REGEXP  "' . $articulSearch . '" 
OR    LOWER(`name`)   LIKE "%' . trim( mb_strtolower( $request->search ) ) . '%" 
OR  `price` LIKE "%' . trim( $request->search ) . '%" 
OR  `alias` LIKE "%' . trim( $request->search ) . '%"';





			$articulSearch = preg_replace( '%[-_.,\\\\/\s]%i', '(.|,|-|_|\\\\\\\\|//)', mb_strtolower( trim( $request->search ) ) );


			$sql = '
SELECT `id`,`name`,`alias`,`articul`,`price` FROM products WHERE BINARY LOWER(articul) REGEXP  "' . $articulSearch . '" 
OR    LOWER(`name`)   LIKE "%' . trim( mb_strtolower( $request->search ) ) . '%" 
OR  `alias` LIKE "%' . trim( $request->search ) . '%"';


			\DB::query( 'SET NAMES utf8' );

			$data = \DB::select( $sql );

			return view( 'admin.common.search_result', [ 'data' => $data, 'word' => trim( $request->search ), 'count' => count( $data ) ] );

		}*/
	}
