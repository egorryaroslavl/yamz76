<?php

	namespace App\Http\Controllers;

	use App\Model\Product;
	use Symfony\Component\HttpFoundation\File;

	class CsvController extends Controller
	{

		/**
		 * Allowed autofill properties
		 *
		 * @var array
		 */
		public $allowedProperties = [
			'id',
			'name',
			'articul',
			'description',
			'price',
			'alias',
		];
		//name,articul,price
		/**
		 * Required properties
		 *
		 * @var array
		 */
		public $requiredProperties = [
			'name',
			'articul',
			'price',
		];
		protected $pdo;
		protected $handle = null;
		protected $enclosure;
		protected $escape;


		public $raznostMnozhestvDB = null;
		public $raznostMnozhestvFile = null;
		public $delimiter = ',';
		public $filePath = false;
		public $categoryId = null;
		public $keyField = 'articul';
		public $dataFromFile = []; // массив данных из файла
		public $dataFromDB = []; // массив данных из БД
		public $fileHeader = false; // заголовок из файла
		public $dataFromFileCount = null; // количество данных из файла

		function __construct( $filePath, $categoryId, $keyField = 'articul' )
		{

			$this->filePath = $filePath;
			$this->detectDelimiter();
			$this->categoryId = $categoryId;
			$this->dataFromFile();
			$this->allDataFromDBbyCategory();
			//$this->qUpdate();

		}


		/**
		 * Возвращает массив данных из файла
		 *
		 * @return $this
		 */
		public function dataFromFile()
		{
			$dataOut     = [];
			$fileContent = file_get_contents( $this->filePath );// строка из csv файла
			/*  Проверяем кодировку  */
			$encoding = mb_detect_encoding( $fileContent, mb_list_encodings(), true );


			if( $encoding !== 'UTF-8' ){ // если не UTF-8
				// Если определяется семейство стандартов ISO-8859* считаем их CP1251
				if( preg_match( '/ISO-8859/i', $encoding ) ){
					$encoding = 'cp1251';
				}


				/*  конвертим и сохраняем  */
				$fileContent = iconv( $encoding, 'UTF-8', $fileContent );

			}


			$fileCsv = str_getcsv( $fileContent, "\n" ); // сырой массив со всеми строками csv файла

			/* обход строк массива. Преобразование их в массив */
			$this->getHeader( $fileCsv );

			//	dd( $fileContent );


			foreach( $fileCsv as $data ){

				$dataArray = str_getcsv( $this->clearString( $data ), $this->delimiter );

				$outArray = [];
				foreach( $dataArray as $k => $v ){
					if( $this->fileHeader ){

						$outArray[ $this->fileHeader[ $k ] ] = $v;
					}
				}
				unset( $k, $v );

				$dataOut[] = $outArray;

			}


			if( $this->fileHeader ){
				$this->dataFromFile = array_values( collect( $dataOut )->forget( 0 )->all() );
			} else{
				$this->dataFromFile = $dataOut;
			}
			$this->dataFromFileCount = count( $this->dataFromFile );

			return $this;


		}

		/**
		 * Заголовок файла
		 *
		 * @return $this
		 */
		function getHeader( $data )
		{

			$arrayFromFile = str_getcsv( $this->clearString( $data[ 0 ] ), $this->delimiter );

			$header = array_values( collect( $this->allowedProperties )
				->intersect( $this->clearHeaderArray( $arrayFromFile ) )
				->all() );

			if( count( $header ) > 0 ){
				$this->fileHeader = $header;
			} else{
				$this->fileHeader = false;
			}


			return $this;
		}

		public function clearHeaderArray( $arr )
		{
			$out = [];
			foreach( $arr as $str ){

				$str   = preg_replace( ' / \n / im', "", trim( $str ) ); //убираем переводы строки
				$out[] = mb_strtolower( preg_replace( ' / [ \s ] +/', "", $str ) ); //убираем лишние пробелы
			}
			return $out;
		}

		public function clearString( $str )
		{
			$str = preg_replace( ' / \n / im', "", trim( $str ) ); //убираем переводы строки
			return preg_replace( ' / [ \s ] +/', " ", $str ); //убираем лишние пробелы
		}

		public function allDataFromDBbyCategory()
		{

			$pdo  = \DB::connection()->getPdo();
			$sql  = "SELECT `id`, `name`, `articul`, `alias`, `price`, `description`  FROM products  WHERE yamz_category_id=:yamz_category_id";
			$stmt = $pdo->prepare( $sql );
			$stmt->execute( [ 'yamz_category_id' => $this->categoryId ] );
			return $this->dataFromDB = $stmt->fetchAll( $pdo::FETCH_ASSOC );


		}

		/**
		 * Обходим данные из файла
		 *
		 * @param bool $arr
		 *
		 * @return array
		 */
		public function qUpdate( $data = false )
		{

			//	$data = $arr;/* ? $arr : $this->partOfArrayFromFileToUpdate*/

			$res = null;


			$Count       = count( $data );
			$toInsertArr = [];

			/* 0 => "delete"
  1 => "not_insert"*/

			$toUpdateArr = [];

			if( $Count > 0 ){

				$is = [];

				for( $i = 0; $i < $Count; $i++ ){

					$value = $data[ $i ];

					$articulExist = $this->isArticulExist( $value[ 'articul' ] );
					$is[]         = $articulExist;

					if( $articulExist !== false ){

						$value[ 'id' ]    = $articulExist;
						$value[ 'alias' ] = $this->translite( $value[ 'articul' ] );
						$toUpdateArr[]    = $value;

					}

					if( !$articulExist ){
						if( !is_null( $this->raznostMnozhestvFile ) && $this->raznostMnozhestvFile === 'insert' ){

							$value[ 'alias' ]            = $this->translite( $value[ 'articul' ] );
							$value[ 'yamz_category_id' ] = $this->categoryId;
							$value[ 'public' ]           = 1;
							$toInsertArr[]               = $value;

						}


					}


				} // end for()

			}

			$inserted = 0;
			$deleted  = 0;

			if( !is_null( $this->raznostMnozhestvFile )
				&& $this->raznostMnozhestvFile === 'insert'
				&& is_array( $toInsertArr )
				&& count( $toInsertArr ) > 0
			){
				$inserted = $this->insertNew( $toInsertArr );
			}

			$updated = $this->updateSt( $toUpdateArr );
			$deleted =  $this->removeFromDatabase();

			return [ 'updated'  => $updated,
			         'inserted' => $inserted,
			         'deleted'  => $deleted,
			];

		}

		/**
		 * Возвращает часть строки запроса
		 *
		 * @return string
		 */
		public function sqlSet( $arr = false, $insert = false )
		{


			foreach( $arr as $key => $item ){

				$set = $key . '="' . $arr[ $key ] . '"';

				if( in_array( $key, [ 'price', 'yamz_category_id', 'public' ] ) ){
					$set = $key . '=' . $arr[ $key ];
				}

				/*	if( $insert ){

					}*/

				$setArr[] = $arr ? $set : "$item =:$item";

			}


			$setText = $insert ? '' : 'SET ';

			if( $insert ){
				return implode( ',', $setArr );
			}
			return $setText . 'alias="' . $this->translite( $arr[ 'articul' ] ) . '",' . implode( ',', $setArr );
		}


		public function updateStatment( $arr = false )
		{

			$st          = [];
			$outStatment = 'UPDATE products SET';

			foreach( $arr as $key => $val ){

				if( in_array( $key, $this->allowedProperties ) && $key !== 'id' ){
					$st[] = " $key=:$key";
				}
			}
			$outStatment .= implode( ',', $st ) . " WHERE id=:id";

			return $outStatment;


		}

		public function updateSt( $toUpdateArr )
		{

			$count = [];

			foreach( $toUpdateArr as $arr ){


				$count[] = $this->pdoUpdate( $arr );

			}


			return $count;
		}

		public function pdoUpdate( $arr )
		{

			$updateStatment = $this->updateStatment( $arr );


			$pdo = \DB::connection()->getPdo();

			$pdoUpdate = $pdo->prepare( $updateStatment );

			foreach( $arr as $key => $val ){
				if( in_array( $key, $this->allowedProperties ) ){

					$pdoUpdate->bindValue( ":$key", $val );
				}
			}
			$pdoUpdate->execute();

			return $pdoUpdate->rowCount();
		}


		/**
		 * Определяет имеется ли в БД такой артикул
		 * Возвращает либо ID записи с ним,
		 * либо false
		 *
		 * @param $articul
		 *
		 * @return bool
		 */
		public function isArticulExist( $articul )
		{

			$result = Product::where(
				[
					[ 'articul', '=', $articul ],
					[ 'yamz_category_id', '=', $this->categoryId ],
				]
			)->take( 1 )->pluck( 'id' )->all();

			return count( $result ) > 0 ? $result[ 0 ] : false;

		}

		public function update( $fieldsArr, $articulExist )
		{

			$fieldsArr[ 'alias' ] = $this->translite( $fieldsArr[ 'articul' ] );

			return \DB::table( 'products' )
				->where( 'id', $articulExist )
				->update( $fieldsArr );

		}

		public function str( $valuesArr )
		{

			$outArray = [];

			if( !is_array( $valuesArr ) && count( $valuesArr ) === 0 ){
				return null;
			}

			foreach( $valuesArr as $data ){

				$data = preg_replace( '#\".*\"#is', '', $data );

				if( in_array( gettype( $data ), [ 'integer', 'double' ] ) ){

					$value = preg_replace( '#\".*\"#is', '', $data );

				} else{

					$value = "`" . $data . "`";
				}

				$outArray[] = $value;
			}
			return '(' . implode( ",", $outArray ) . ')';

		}


		public function insertNew( $fieldsArr )
		{

			return \DB::table( 'products' )->insert( $fieldsArr );

		}


		/**
		 * Detect csv delimiter
		 *
		 *
		 * @return mixed
		 */
		function detectDelimiter()
		{
			$delimiters = [ "\t", ";", "|", "," ];
			$data_1     = null;
			$data_2     = null;
			$delimiter  = $delimiters[ 0 ];
			$handle     = fopen( $this->filePath, 'r' );
			foreach( $delimiters as $d ){
				$data_1 = fgetcsv( $handle, 4096, $d );
				if( sizeof( $data_1 ) > sizeof( $data_2 ) ){
					$delimiter = sizeof( $data_1 ) > sizeof( $data_2 ) ? $d : $delimiter;
					$data_2    = $data_1;
				}
				rewind( $handle );
			}

			$this->delimiter = $delimiter;
			return $this;
		}


		public function removeFromDatabase()
		{

			$collection       = collect( $this->dataFromFile );
			$plucked          = $collection->pluck( 'articul' );
			$articulsFromFile = $plucked->all(); // все артикулы из файла

			$arrOut = [];

			/* Обходим массив из базы данных */
			foreach( $this->dataFromDB as $data ){

				/* и определяем какие артикулы в БД отсутствуют в файле */
				if( !in_array( $data[ 'articul' ], $articulsFromFile ) ){


					if( $this->raznostMnozhestvDB === 'delete' ){

						$arrOut[] = Product::where( 'id', $data[ 'id' ] )->delete();

					}

				}

			}

			return count($arrOut) ;
		}


		public function translite( $string )
		{
			$dictionary = array(
				"А" => "a",
				"Б" => "b",
				"В" => "v",
				"Г" => "g",
				"Д" => "d",
				"Е" => "e",
				"Ж" => "zh",
				"З" => "z",
				"И" => "i",
				"Й" => "y",
				"К" => "K",
				"Л" => "l",
				"М" => "m",
				"Н" => "n",
				"О" => "o",
				"П" => "p",
				"Р" => "r",
				"С" => "s",
				"Т" => "t",
				"У" => "u",
				"Ф" => "f",
				"Х" => "h",
				"Ц" => "ts",
				"Ч" => "ch",
				"Ш" => "sh",
				"Щ" => "sch",
				"Ъ" => "",
				"Ы" => "yi",
				"Ь" => "",
				"Э" => "e",
				"Ю" => "yu",
				"Я" => "ya",
				"а" => "a",
				"б" => "b",
				"в" => "v",
				"г" => "g",
				"д" => "d",
				"е" => "e",
				"ж" => "zh",
				"з" => "z",
				"и" => "i",
				"й" => "y",
				"к" => "k",
				"л" => "l",
				"м" => "m",
				"н" => "n",
				"о" => "o",
				"п" => "p",
				"р" => "r",
				"с" => "s",
				"т" => "t",
				"у" => "u",
				"ф" => "f",
				"х" => "h",
				"ц" => "ts",
				"ч" => "ch",
				"ш" => "sh",
				"щ" => "sch",
				"ъ" => "y",
				"ы" => "y",
				"ь" => "",
				"э" => "e",
				"ю" => "yu",
				"я" => "ya",
				"-" => "_",
				" " => "_",
				"," => "_",
				"." => "_",
				"?" => "",
				"!" => "",
				"«" => "",
				"»" => "",
				":" => "",
				'ё' => "e",
				'Ё' => "e",
				"*" => "",
				"(" => "",
				")" => "",
				"[" => "",
				"]" => "",
				"<" => "",
				">" => ""
			);
			$string     = preg_replace( '/[^\w\s]/u', ' ', $string );
			$string     = mb_strtolower( strtr( strip_tags( trim( $string ) ), $dictionary ) );
			return preg_replace( '/[_]+/', '_', $string );
		}


	}
