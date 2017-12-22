<?php

	namespace App\Http\Controllers;

	use App\Model\Contact;
	use App\Model\Product;
	use App\Model\YamzCategory;
	use App\Part;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Input;
	use App\Http\Requests;
	use Illuminate\Contracts\Cache\Factory;
	use Illuminate\Contracts\Cache\Repository;
	use Cache;
	use App\Http\Controllers\CsvController;

	class ProductsController extends Controller
	{


		public function uploadCsvFile()
		{

			return view( 'admin.excel.index' );

		}

		public function aticulEq( $a1, $a2 )
		{
			if( $a1[ 'articul' ] === $a2[ 'articul' ] ){
				return 1;
			}
			return 0;
		}


		public function uploadCsv( Request $request )
		{

			//	dd( $request->all() );
			/*
			 *   "yamz_categories" => "9"
  "public" => "1"
  "RaznostMnozhestvDB" => "delete"
  "RaznostMnozhestvFile" => "not_insert"
  "_token" => "DK5x2W6rMuRc0dyZvoAjOLFmxCbIKKkeLNbgksOB"
  "sendBtn" => "Отправить"
  "file" => UploadedFile {#448 ▶}
			 * */

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


			/* Если остался старый файл удаляем его  */
			if( file_exists( $oldFile = public_path() . '/uploads/excel/excel_to_import.cvs' ) ){
				unlink( $oldFile );
			}


			if( Input::hasFile( 'file' ) ){

				$ext = Input::file( 'file' )->getClientOriginalExtension(); // получаем расширение

				if( $ext !== 'csv' ){

					return redirect()
						->back()
						->with( [ 'error' => 'Файл должен иметь расширение .csv!' ] );
				}


				$path      = Input::file( 'file' )->getRealPath();
				$destPatch = public_path() . '/uploads/excel/';
				$destName  = 'excel_to_import.' . $ext; // новое имя
				$fileName  = $destPatch . $destName; // путь и имя


				if( move_uploaded_file( $path, $fileName ) ){

					$csv                       = new CsvController( $fileName, $request->yamz_categories );
					$csv->raznostMnozhestvDB   = $request->RaznostMnozhestvDB;
					$csv->raznostMnozhestvFile = $request->RaznostMnozhestvFile;

					$startCount  = YamzCategory::productsInCategoryCount( $request->yamz_categories );
					$res         = $csv->qUpdate( $csv->dataFromFile );
					$finishCount = YamzCategory::productsInCategoryCount( $request->yamz_categories );
					$inserted    = $finishCount - $startCount +  $res[ 'deleted' ];
					$resHtml     = 'Обновлено  ' . count( $res[ 'updated' ] ) . ' позиций <br>
					 Добавлено ' . $inserted . ' позиций<br>
					 Удалено ' . $res[ 'deleted' ] . ' позиций ';


					if( is_array( $res ) ){
						return redirect()
							->back()
							->with( [ 'ok' => $resHtml ] );
					}

				}


			}

		}


		public function show( Request $request )
		{

			$category = Product::product_category( $request->id ); // категория этого продукта

			$data = Product::where( 'id', $request->id )
				->where( 'alias', $request->alias )
				->where( 'public', 1 )
				->first();

			/* если поле over_text пусто... */
			if( empty( $data->over_text ) ){

				/* генерируем текст для него */
				$textOutput              = new TextOutput( $category->id );
				$textOutput->category_id = $category->id;
				$over_text               = $textOutput->textRand();
				/* заменяем якоря значениями */
				$over_text = self::overTextOutPut( $over_text, $data );
				/* и записываем в БД */
				$product            = Product::find( $request->id );
				$product->over_text = $over_text;
				$product->save();
				$data = $product;
			}

			if( !empty( $data->over_text ) && mb_strlen( $data->description ) < 500 ){
				$data->description = $data->over_text;
			}

			if( $data == null ){
				abort( 404 );
			}

			$data->category = $category;

			$data->table = 'products';
			return view( 'product' )->with( 'data', $data );

		}


		/*
		 *
		 * */
		public static function overText( $id )
		{
			$product = Product::where( 'id', $id )->first();

			// если поле over_text пусто
			if( empty( $product->over_text ) ){
				// генерим over_text и записываем в БД
				$overText           = \App\Part::textRand();
				$product->over_text = $overText;
				$product->save();
				return $overText;

			}

			return $product->over_text;

		}

		/*
		 * Заменяет якоря на значения
		 * */
		public static function overTextOutPut( $overText, $data )
		{

			$address = Contact::address();
			$phone   = Contact::phone();
			$email   = Contact::email();

			$trans = [
				"[PRODUCT_NAME]"    => $data->name,
				"[PRODUCT_ARTICUL]" => $data->articul,
				"[ADDRESS]"         => $address,
				"[PHONE]"           => $phone,
				"[EMAIL]"           => $email,
			];

			$transNull = [
				"[PRODUCT_NAME]"    => '',
				"[PRODUCT_ARTICUL]" => '',
				"[ADDRESS]"         => '',
				"[PHONE]"           => '',
				"[EMAIL]"           => '',
			];


			$outText = strtr( $overText, $trans );
			return strtr( $outText, $transNull );

		}


		public function changeprice( Request $request )
		{


			$category          = YamzCategory::where( 'id', $request->category_id )->first();
			$request->category = $category;

			$view = $request->ids == 'all' ? 'productions.makechangeallcategorypricesform' : 'productions.makechangeform';

			echo view( $view, [ 'data' => $request ] )->render();

		}

		public function calculator( $tcena, $percents, $todo )
		{

			if( $todo == 'up' ){
				return round( $tcena * ( 1 + $percents / 100 ), 2 );
			}

			if( $todo == 'down' ){
				return round( $tcena - $percents * ( $tcena / 100 ), 2 );
			}

		}


		public function mknewpricesforall( $category_id )
		{
			$out   = [];
			$price = Product::where( 'yamz_category_id', $category_id )
				->where( 'price', '<>', '' )->get();


			foreach( $price as $val ){
				$out[ $val->id ] = $val->price;
			}
			return $out;

		}


		public function mknewprices( Request $request )
		{


			$aNewPrices = [];
			$ids        = json_decode( $request->ids );

			if( $request->ids == 'all' ){

				$ids = $this->mknewpricesforall( $request->category_id );

			}


			foreach( $ids as $id => $price ){
				if( $request->todo == 'up' || $request->todo == 'down' ){
					$aNewPrices[ $id ] = $this->calculator( $price, $request->percents, $request->todo );
				}
				if( $request->todo == 'chislo' ){
					$aNewPrices[ $id ] = $request->chislo;
				}

			}
			unset( $id, $price );


			$newPricesCount = count( $aNewPrices );
			$updateRes      = 0;

			foreach( $aNewPrices as $_id => $_newPrice ){
				$res = $this->priceUpdate( $_id, $_newPrice );
				if( $res > 0 ) $updateRes++;
			}
			unset( $_id, $_newPrice );

			if( $newPricesCount == $updateRes ){
				echo json_encode( [ 'error' => 'ok', 'message' => $updateRes ] );
			}

		}

		public function priceUpdate( $id, $price )
		{

			return \DB::table( 'products' )
				->where( 'id', $id )
				->update( [ 'price' => $price ] );

		}

	}
