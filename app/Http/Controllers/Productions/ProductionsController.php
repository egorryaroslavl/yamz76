<?php

	namespace App\Http\Controllers\Productions;

	use App\Http\Controllers\AdminController;
	use App\Http\Controllers\UtilsController;
	use App\Model\Product;
	use App\Model\YamzCategory;
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use Intervention\Image\File;
	use ValidatesRequests;
	use Baum;


	class ProductionsController extends AdminController
	{


		/**
		 * Сначала корневые категории
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function index()
		{
			//	$data = YamzCategory::categories();
			/* сначала корневые категории */
			$data = YamzCategory::rootCategories();
			//	$data = YamzCategory::with_production();
			$data->table = 'yamz_categories';

			return view( 'productions.categorieslist', [ 'data' => $data ] );

		}


		public function productions( Request $request )
		{
			$data = Product::where( 'yamz_category_id', $request->id )
				->orderBy( 'id' )
				->paginate( 50 );

			$category = YamzCategory::where( 'id', $request->id )->first();

			$data->category = $category;
			$data->table    = 'products';

			// dd( count($data) );
			return view( 'productions.list', [ 'data' => $data ] );

		}


		public function create( Request $request )
		{
			$data     = $request;
			$category = YamzCategory::where( 'id', $request->id )->first();

			$data->category = $category;
			$data->table    = 'products';

			return view( 'productions.form_create', [ 'data' => $data ] );
		}

		public function store( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name'  => 'required|unique:products|max:255',
				'alias' => 'required|unique:products|max:255',
				'price' => 'numeric',
			] );


			if( $v->fails() ){
				return redirect()->back()->withErrors( $v->errors() );
			}

			$input = $request->all();
			$input = array_except( $input, '_token' );
			$id    = Product::create( $input )->id;

			if( !empty( $request->icon ) ){

				$path_parts = pathinfo( $request->icon );
				$ext        = $path_parts[ 'extension' ];

				$file_name       = '/uploads/icons' . "/icon_product_" . $id . ".$ext";
				$file_name_small = '/uploads/icons' . "/icon_product_" . $id . "_small.$ext";


				$icon = public_path( $file_name );

				$icon_small = public_path( $file_name_small );


				$img = \Image::make( $request->icon );


				$img->save( $icon );
				$img->resize( 320, 240 );
				$img->save( $icon_small );


				$prod       = Product::where( 'id', $id )->first();
				$prod->icon = $file_name_small;
				$prod->save();

			}

			return redirect( '/admin/productions/' . $id . '/edit' )->with( 'message', 'Запись добавлена! ID-' . $id );
		}


		public function edit( Request $request )
		{


			$data = Product::where( 'id', $request->id )->first();

			$category       = YamzCategory::where( 'id', $data->yamz_category_id )->first();
			$data->category = $category;
			$data->table    = 'products';

			/*  */
			$fullUrl   = explode( "/", $request->fullUrl() );
			$data->act = end( $fullUrl );
			if( $data->act == 'edit' ) $data->act = 'update';
			$data->action = [ 'action' => 'Productions\ProductionsController@' . $data->act ];

			return view( 'productions.form', [ 'data' => $data ] );
		}


		public function update( Request $request )
		{


			$v = \Validator::make( $request->all(), [
				'name'  => 'required|max:255',
				'alias' => 'required|max:255',
				'price' => 'numeric',
			] );

			if( $v->fails() ){
				return redirect()->back()->withErrors( $v->errors() );
			}


			if( !empty( $request->icon ) && !strpos( $request->icon, 'uploads' ) ){

				$path_parts      = pathinfo( $request->icon );
				$ext             = $path_parts[ 'extension' ];
				$rand            = str_random( 6 );
				$file_name       = '/uploads/icons' . "/icon_product_" . $request->id . $rand . ".$ext";
				$file_name_small = '/uploads/icons' . "/icon_product_" . $request->id . $rand . "_small.$ext";

				$icon       = str_replace( '//', '/', public_path( $file_name ) );
				$icon_small = str_replace( '//', '/', public_path( $file_name_small ) );
				$img        = \Image::make( $request->icon );

				$img->save( $icon );
				$img->resize( 320, 240 );
				$img->save( $icon_small );


				$request->icon = $file_name_small;
				/*	dd($request->icon);*/
			}


			$product                      = Product::find( $request->id );
			$product->name                = $request->name;
			$product->alias               = $request->alias;
			$product->articul             = $request->articul;
			$product->description         = $request->description;
			$product->short_description   = $request->short_description;
			$product->applicability       = $request->applicability;
			$product->price               = str_replace( ',', '.', $request->price );
			$product->trademark           = $request->trademark;
			$product->icon                = $request->icon;
			$product->public              = isset( $request->public ) ? 1 : 0;
			$product->anons               = isset( $request->anons ) ? 1 : 0;
			$product->hit                 = isset( $request->hit ) ? 1 : 0;
			$product->metatag_title       = $request->metatag_title;
			$product->metatag_description = $request->metatag_description;
			$product->metatag_keywords    = $request->metatag_keywords;

			/*		dd( $request );
					dd( $product );*/
			$product->save();

			return back()->with( 'message', 'Запись обновлена!' );
		}


		public function icon( $id, $icon )
		{
			$path_parts = pathinfo( $icon );
			$ext        = $path_parts[ 'extension' ];

			$file_name       = '/uploads/icons' . "/icon_product_" . $id . ".$ext";
			$file_name_small = '/uploads/icons' . "/icon_product_" . $id . "_small.$ext";
			$icon            = public_path( $file_name );
			$icon_small      = public_path( $file_name_small );
			$img             = \Image::make( $icon );
			$img->save( $icon );
			$img->resize( 320, 240 );
			$img->save( $icon_small );

			return $file_name_small;
		}


		/**
		 * Формирует список категорий
		 *
		 * @param      $data
		 * @param bool $sub
		 *
		 * @return string
		 */
		public function table( $data, $sub = false )
		{

			$htmlOut = '';

			$Count = count( $data );

			if( $Count > 0 ){

				$subClass = $sub ? 'sub-table' : '';

				for( $i = 0; $i < $Count; $i++ ){

					$sub = '';

					if( $data[ $i ]->sub_item !== '' ){
						$sub = $this->table( $data[ $i ]->sub_item, true );
					}

					$brcr    = \App\Model\YamzCategory::breadCrumbs( 'dvigateli_yamz' );
					$htmlOut = view( 'admin.common.table', [ 'data' => $data, 'sub' => $sub, 'brcr' => $brcr ] )->render();


				}


			}

			return $htmlOut;

		}


		public function categoriesList()
		{

			/*			$data = YamzCategory::rootCategories();

						$table = $this->table( $data );

						return view( 'admin.products.category_list', [ 'data' => $table, 'table' => 'products'   ] );*/


			$data = YamzCategory::rootCategories();

			$data->table = 'yamz_categories';

			return view( 'productions.categorieslist', [ 'data' => $data, 'table' => 'products' ] );


		}

		public function subcategoriesList( $alias )
		{

			$id = YamzCategory::where( 'alias', $alias )->first()->id;

			$childCount    = YamzCategory::childCount( $alias );
			$productsCount = YamzCategory::productsInCategoryCount( $id );
			/* Получаем детей */
			if( $childCount > 0 ){
				$children = YamzCategory::where( 'parent_id', $id )
					->orderBy( 'lft' )
					->paginate( config( 'admin.settings.perPage' ) );
			}


			$table = $this->table( $children );

			return view( 'admin.products.category_list',
				[
					'data'          => $table,
					'table'         => 'products',
					'alias'         => $alias,
					'childCount'    => $childCount,
					'productsCount' => $productsCount,

				] );

		}

	}
