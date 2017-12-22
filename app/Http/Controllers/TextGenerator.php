<?php

	namespace App\Http\Controllers;

	use App\Model\YamzCategory;
	use App\Part;
	use App\Subject;
	use DB;
	use Storage;
	use Illuminate\Pagination\LengthAwarePaginator;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Http\Request;

	use App\Http\Requests;

	class TextGenerator extends Controller
	{
		public function index()
		{

			$data = Part::class;
			return view( 'admin.text_generator.index', [ 'data' => $data ] );

		}


		public function createPost( Request $request )
		{

			/* преобразауем масив категорийных ID к нормальному массиву */
			$ids = []; // масив категорийных ID
			foreach( $request->ids as $item ){
				$ids[] = $item[ 'value' ];
			}


			if( isset( $request->part_id ) && $request->part_id != 0 ){
				echo self::partUpdate( $request );
				exit;
			}


			/* ищем имеется ли уже такое значение для этого номера части и для этого номера предложения */
			$parts = DB::table( 'parts' )
				->where( 'part', 'like', $request->part )
				->where( 'position', '=', $request->position )
				->where( 'sentence', '=', $request->sentence );

			$partsCount = $parts->count();// кличество найденых совпадений

			$arr = [
				'part'     => $request->part,
				'position' => $request->position,
				'sentence' => $request->sentence,
			];


			/* если такая часть уже имеется, тогда возвращаем её ID
			иначе пишем её в базу и возвращаем ID новой записи
			  */
			if( $partsCount > 0 ){
				$part_id = $parts->get( 'id' );
			} else{
				$part_id = Part::create( $arr )->id;
			}


			self::partsYamzCategories( $ids, $part_id );


			echo json_encode( [ 'error'   => 'ok',
			                    'msg'     => '',
			                    'part_id' => $part_id, ] );
		}


		public function create_manyPost( Request $request )
		{

			/* преобразауем масив категорийных ID к нормальному массиву */
			$ids = []; // масив категорийных ID
			foreach( $request->ids as $item ){
				$ids[] = $item[ 'value' ];
			}

			$partA = explode( "\n", $request->partA );
			$partB = explode( "\n", $request->partB );
			$partC = explode( "\n", $request->partC );

			$aData = [ 'a' => $partA, 'b' => $partB, 'c' => $partC ];


			foreach( $aData as $key => $Parts ){

				if( count( $Parts ) > 0 ){

					foreach( $Parts as $part ){

						if( trim( $part ) != '' ){


							/* ищем имеется ли уже такое значение для этого номера части и для этого номера предложения */
							$parts = DB::table( 'parts' )
								->where( 'part', 'like', $part )
								->where( 'position', '=', $key )
								->where( 'sentence', '=', $request->sentence );

							$partsCount = $parts->count();// кличество найденых совпадений

							$arr = [
								'part'     => $part,
								'position' => $key,
								'sentence' => $request->sentence,
							];


							/* если такая часть уже имеется, тогда возвращаем её ID
							иначе пишем её в базу и возвращаем ID новой записи
							  */
							/*	if( $partsCount > 0 ){
									$part_id = $parts->get( ['id'] );
								} else{
									$part_id = Part::create( $arr )->id;
								}*/
							$part_id = Part::create( $arr )->id;

							self::partsYamzCategories( $ids, $part_id );



						}

					}


				}

			}
			echo json_encode( [ 'error'   => 'ok',
			                    'msg'     => '',
			] );

		}


		public function partUpdate( Request $request )
		{


			/* преобразауем масив категорийных ID к нормальному массиву */
			$ids = []; // масив категорийных ID
			foreach( $request->ids as $item ){
				$ids[] = $item[ 'value' ];
			}

			$res = DB::table( 'parts' )
				->where( 'id', $request->part_id )
				->update( [ 'part' => $request->part ] );

			/*			$parts       = Part::where( 'id', $part_id );
						$parts->part = $part_id;*/
			self::partsYamzCategories( $ids, $request->part_id );

			//Part::sentenceRandAndCache();
			return json_encode( [ 'error'   => 'ok',
			                      'msg'     => '',
			                      'part_id' => $request->part_id ] );

		}


		public static function partsYamzCategories( $ids, $part_id )
		{
			$insert = array();

			foreach( $ids as $category_id ){
				$insert[] = [ 'part_id' => $part_id, 'yamz_category_id' => $category_id ];
			}

			DB::table( 'parts_yamz_categories' )->where( 'part_id', '=', $part_id )->delete();
			DB::table( 'parts_yamz_categories' )->insert( $insert );

		}


		public function partSelect( Request $request )
		{

			$parts = Part::where( 'position', $request->position )
				->where( 'sentence', $request->sentence )
				->get();

			echo view( 'admin.text_generator.parts_select' )
				->with( 'data', $parts )
				->with( 'position', $request->position )
				->with( 'part_id', $request->part_id )
				->render();

		}


		public function partDelete( Request $request )
		{

			$parts = null;
			$parts = Part::find( $request->part_id )->delete();
			$parts .= DB::table( 'parts_yamz_categories' )
				->where( 'part_id', '=', $request->part_id )->delete();
			if( $parts != null )
				// Part::sentenceRandAndCache();
				echo json_encode( [ 'error' => 'ok',
				                    'msg'   => 'Удаление успешно!' ] );

		}


		public function subjectSelect()
		{

			$subjects = Subject::where( 'name', '<>', '' )->orderBy( 'name' )->get();

			echo view( 'admin.text_generator.subjects_select' )
				->with( 'data', $subjects )->render();


		}


		public function subjectDelete( Request $request )
		{

			$parts = null;
			$parts = Part::find( $request->part_id )->delete();
			$parts .= DB::table( 'subjects_parts' )
				->where( 'part_id', '=', $request->part_id )->delete();
			if( $parts != null )
				echo json_encode( [ 'error' => 'ok',
				                    'msg'   => 'Удаление успешно!' ] );

		}

		public function SentencesHtmlList()
		{
			if( !Storage::exists( config( 'admin.settings.sentences_json' ) ) ){
				return view( 'admin.text_generator.sentences_html_list', [ 'data' => [], 'sentencesCount' => 0 ] );
			}
			$sentences      = Storage::get( config( 'admin.settings.sentences_json' ) );
			$sentencesArr   = json_decode( $sentences );
			$sentencesCount = count( $sentencesArr );
			//Get current page form url e.g. &page=6
			$currentPage = LengthAwarePaginator::resolveCurrentPage( '/admin/text_generator/sentences?page' );

			//Create a new Laravel collection from the array data
			$collection = new Collection( $sentencesArr );

			//Define how many items we want to be visible in each page
			$perPage = 200;

			//Slice the collection to get the items to display in current page
			$currentPageResults = $collection->slice( $currentPage * $perPage, $perPage )->all();

			//Create our paginator and pass it to the view
			$paginatedSearchResults = new LengthAwarePaginator( $currentPageResults, count( $collection ), $perPage );

			return view( 'admin.text_generator.sentences_html_list', [ 'data' => $paginatedSearchResults, 'sentencesCount' => $sentencesCount ] );

		}


		function postSelectedCategories( Request $request )
		{

			$listOut = '<div name="yamz_categories_id" id="no-related" class="sel-btn"><i title="Нет привязки"  
 class="fa fa-chain-broken "></i> 
Нет 
привязки</div>';


			$categories = DB::select( 'SELECT *, (SELECT `name` FROM `yamz_categories` WHERE `id` = `yamz_category_id` ) AS \'name\' FROM 
`parts_yamz_categories` WHERE `part_id`= :id', [ 'id' => $request->part_id ] );
			$Count      = count( $categories );

			if( $Count > 0 ){

				$listOut = '';

				foreach( $categories as $item ){
					$parentName = YamzCategory::get_parent( $item->yamz_category_id );
					$listOut .= '<div name="yamz_categories_id"  class="sel-btn"><input type="hidden" name="ids" value="' . $item->yamz_category_id . '" ><i title="Удалить" class="fa fa-times categories_del" data-id="' . $item->yamz_category_id . '"></i> ' . $parentName . ' > ' . $item->name . '</div>';
				}


			}
			return $listOut;

		}

	}
