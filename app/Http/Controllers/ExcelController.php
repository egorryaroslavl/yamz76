<?php

	namespace App\Http\Controllers;

	use App\Model\Product;
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use Maatwebsite\Excel\Facades\Excel;
	use Illuminate\Support\Facades\Input;

	class ExcelController extends Controller
	{

		public function index()
		{

			return view( 'admin.excel.index' );

		}


		public function getFile()
		{

			$fileName = public_path() . '/uploads/excel/excel_to_import.csv';

			$update   = '';
			$insert   = '';
			$kpp      = file( $fileName );
			$our      = '';
			$names    = '';
			$colNames = $this->first_row( $kpp );
			if( $this->first_row( $kpp ) !== null ){
				$names = $this->first_row( $kpp );
				$kpp   = array_slice( $kpp, 1 );
			}

			foreach( $kpp as $str ){

				$res_ = str_getcsv( $str );

				foreach( $res_ as $k => $v ){

					$res[ $names[ $k ] ] = $v;

				}
				unset( $k, $v );

				/*			$name    = $res[ 0 ];
							$articul = $res[ 1 ];
							$price   = $res[ 2 ];*/

			}

			return $res;

		}


		public function postUpload( Request $request )
		{

			if( $request->file == null ){

				return redirect()
					->back()
					->with( [ 'error' => 'Не выбран файл!' ] );
			}

			if( $request->yamz_categories == 0 ){

				return redirect()
					->back()
					->with( [ 'error' => 'Не выбрана категория!' ] );
			}


			if( Input::hasFile( 'file' ) ){
				$data               = '';
				$ext                = Input::file( 'file' )->getClientOriginalExtension();
				$path               = Input::file( 'file' )->getRealPath();
				$destPatch          = public_path() . '/uploads/excel/';
				$destName           = 'excel_to_import.' . $ext;
				$fileName           = $destPatch . $destName;
				$yamz_categories_id = $request->yamz_categories;


				if( move_uploaded_file( $path, $fileName ) ){
					$res = $this->makeQ( $yamz_categories_id );


					if( $res[ 'insert' ] != null && $res[ 'insert' ] > 0 ){
						return redirect()
							->back()
							->with( [ 'ok' => 'Добавлено ' . $res[ 'insert' ] . ' позиций!' ] );
					}

				}


				//return view( '/admin/excel/edit', [ 'data' => $request ] );
				//return redirect( '/admin/excel/edit' );


			}


		}

		public function q_insert_str( $res )
		{

			foreach( $res as $val ){
				$val   = '"' . trim( $val, '"' ) . '"';
				$res[] = $val;
			}

			return implode( ',', $res ) . '<br>';
		}


		public function q_update( $articul, $price )
		{
			return "UPDATE `products` SET `price` = '" . $this->_round( $price ) . "'  WHERE  `articul`='" . $articul . "';";
		}

		public function q_insert( $aQ )
		{

			$fields_for_sql = $this->fields_for_sql( $aQ[ 1 ] );
			$fields_for_pdo = array_keys( $aQ[ 1 ] );
			$values_for_sql = [];

			$sqlDel = "

 DELETE FROM `products` WHERE  `yamz_category_id`=" . $aQ[ 1 ][ 'yamz_category_id' ] . ";
 
	 		";

			$sql = "
INSERT INTO `products` 
($fields_for_sql)	
	 VALUES
	 		";


			foreach( $aQ as $val ){
				$sql              .= "(" . implode( ',', $val ) . "),";
				$values_for_sql[] = $val;

			}
			$pdo          = \DB::connection()->getPdo();
			$delResult    = $pdo->exec( $sqlDel );
			$insertResult = $pdo->exec( rtrim( $sql, "," ) . ';' );

			return [ 'delete' => $delResult, 'insert' => $insertResult ];

		}

		public function _round( $num )
		{
			$nums = str_replace( ",", ".", $num );
			return $nums = round( $nums, 2 );
			//return str_replace( ".", ",", $nums );
		}


		public function fields_for_sql( $arr )
		{
			$arrFields = array_keys( $arr );
			return "`" . implode( '`,`', $arrFields ) . "`";


		}

		public function first_row( $arr = false )
		{
			if( !$arr ){

				$fileName = public_path() . '/uploads/excel/excel_to_import.csv';
				$arr      = file( $fileName );

			}

			if( !is_array( $arr ) || count( $arr ) == 0 ){
				return null;
			}
			$result  = array();
			$keys    = array();
			$fields  = array();
			$alloved = [ 'name', 'articul', 'alias', 'price', 'description' ];
			$res     = str_getcsv( $arr[ 0 ] ); // получаем первую строку
			/*
						if( !array_key_exists( 'name', $res )
							&& !array_key_exists( 'articul', $res )
							&& !array_key_exists( 'price', $res )
						){
							return [ 'keys'   => [ 0, 1, 2 ],
									 'fields' => [ 'name', 'articul', 'price' ],
									 'result' => "`name`,`articul`,`price`" ];
						}*/

			$Count = count( $res );

			if( $Count > 0 ){

				for( $i = 0; $i < $Count; $i++ ){

					if( in_array( trim( $res[ $i ] ), $alloved ) ){
						$result[] = trim( $res[ $i ] );
						$keys[]   = $i;
					}

				}

			}


			if( count( $result ) == 0 ){
				return false;
			}

			return [ 'keys' => $keys, 'fields' => $result, 'result' => "`" . implode( '`,`', $result ) . "`" ];

		}

		public function available_articuls( $kpp )
		{
			$articul = [];
			foreach( $kpp as $str ){
				$res       = str_getcsv( $str );
				$articul[] = $res[ 1 ];

			}
			return $articul;
		}

		public function to_update_articuls( $kpp )
		{
			$articul = [];
			foreach( $kpp as $str ){
				$res       = str_getcsv( $str );
				$articul[] = $res[ 1 ];

			}
			return $articul;
		}

		public function all_articuls()
		{
			$pdo = \DB::connection()->getPdo();

			return $pdo->query( 'SELECT articul FROM products' )
				->fetchAll( \PDO::FETCH_COLUMN );

		}

		public function clearField( $key, $str )
		{

			if( $key == 'price' && !empty( $str ) ){
				return $this->_round( $str );
			}


			return '"' . trim( addslashes( $str ), '"' ) . '"';

		}


		/*
		 *
		 */
		public function csvArray( $yamz_category_id )
		{

			$fileName = public_path() . '/uploads/excel/excel_to_import.csv';
			$kpp      = file( $fileName ); // массив строк файла

			/* определяем есть ли первая строка с заголовками */
			if( $this->first_row( $kpp ) !== null ){
				/*  если есть получаем массив с именами полей и массив с индексами ключей */
				$fields = $this->first_row( $kpp );

			}

			$first = str_getcsv( $kpp[ 0 ] );


			if( in_array( 'name', array_values( $first ) )
				|| in_array( 'articul', array_values( $first ) )
				|| in_array( 'price', array_values( $first ) )
			){
				$kpp = array_slice( $kpp, 1 ); // удаляем строку с именами полей
			}


			foreach( $kpp as $str ){
				$str  = preg_replace( '/\n/im', "", $str ); //убираем переводы строки
				$str  = preg_replace( '/[\s]+/', " ", $str ); //убираем лишние пробелы
				$res  = str_getcsv( $str );
				$ress = [];

				foreach( $res as $key => $str ){


					$k = $fields[ 'fields' ][ $key ];

					$ress[ 'yamz_category_id' ] = $yamz_category_id;
					$ress[ 'public' ]           = 1;
					$str                        = $this->clearField( $k, $str );
					$ress[ $k ]                 = $str;
					if( $k == 'name' ){
						$ress[ 'alias' ] = '"' . str_slug( trim( $str ), "_" ) . '"';
					}


				}

				$allArray[] = $ress;

			}

			return $allArray;

		}


		public function makeQ( $yamz_category_id )
		{


			$svs         = $this->csvArray( $yamz_category_id );
			$firstSqlStr = $this->first_row()[ 'result' ];
			//	UtilsController::Pre( $firstSqlStr );
			//	UtilsController::Pre( $svs );

			return $this->q_insert( $svs );


			/*	return [ 'insert' => $insert, 'update' => $update ];
				//	return view( '/admin/excel/edit', [ 'insert' => $insert, 'update' => $update ] );*/

		}

	}
