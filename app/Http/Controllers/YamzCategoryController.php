<?php

	namespace App\Http\Controllers;

	use App\Model\Product;
	use Baum\Node;
	use Illuminate\Http\Request;
	use App\Model\YamzCategory;
	use App\Http\Requests;

	class YamzCategoryController extends Controller
	{

		public function index()
		{
			$data        = YamzCategory::where( 'parent_id', null )->where( 'public', 1 )->orderBy( 'lft' )->get();
			$defaultMeta = array(
				'title'       => 'Каталог',
				'description' => 'Каталог',
				'keywords'    => 'Каталог'
			);
			UtilsController::defaultMeta( $data, $defaultMeta );

			return view( 'categories' )->with( 'data', $data );
		}


		public static function childCount( $alias )
		{
			$id = YamzCategory::where( 'alias', $alias )->first()->id;
			return YamzCategory::where( 'parent_id', $id )->where( 'public', 1 )->count();
		}

		public static function productionsCount( $alias )
		{
			$id = YamzCategory::where( 'alias', $alias )->first()->id;
			return Product::where( 'yamz_category_id', $id )->count();
		}


		public function show( Request $request )
		{

			$d = YamzCategory::where( 'alias', $request->alias )->first();

			if($d === null){
				abort(404);
			}


			$data                      = YamzCategory::where( 'parent_id', $d->id )
				->orderBy( 'lft' )
				->get();
			$data->metatag_title       = $d->metatag_title;
			$data->metatag_description = $d->metatag_description;
			$data->metatag_keywords    = $d->metatag_keywords;
			if( !$data || !is_object( $data ) || $data == null ){
				abort( 404 );
				redirect( 'error', 404 );
			}
			$data->products = Product::where( 'yamz_category_id', $d->id )->paginate( 20 );


			$defaultMeta = array(
				'title'       => ' страница каталога ' . $d->name,
				'description' => $d->name,
				'keywords'    => 'каталог,' . $d->name
			);

			UtilsController::defaultMeta( $data, $defaultMeta );
			$data->parent_id    = $d->id;
			$data->parent_alias = $d->alias;
			$data->parent_name  = $d->name;
			$data->parent_text  = $d->text;


			return view( 'category' )->with( 'data', $data );
		}

		public function categoryalias( Request $request )
		{


			$categoryaliasCount = YamzCategory::where( 'alias', $request->categoryalias )->count();

			if( $categoryaliasCount > 0 ){
				$d = YamzCategory::where( 'alias', $request->categoryalias )->first();


				$data           = YamzCategory::where( 'parent_id', $d->id )->orderBy( 'lft' )->get();
				$data->products = Product::where( 'yamz_category_id', $d->id )->get();

				$defaultMeta = array(
					'title'       => 'Каталог',
					'description' => 'Каталог',
					'keywords'    => 'Каталог'
				);
				UtilsController::defaultMeta( $data, $defaultMeta );

				$data->parent_id    = $d->id;
				$data->parent_alias = $d->alias;
				$data->parent_name  = $d->name;
				$data->parent_text  = $d->text;
				return view( 'category' )->with( 'data', $data );
			}

		}


		public function category_product( Request $request )
		{

			$categoryaliasCount = YamzCategory::where( 'alias', $request->categoryalias )->count();


			if( $categoryaliasCount > 0 ){

				$productaliasCount = Product::where( 'alias', $request->productalias )->count();

				if( $productaliasCount > 0 ){

					$d              = YamzCategory::where( 'alias', $request->categoryalias )
						->first();
					$data           = Product::where( 'alias', $request->productalias )->first();
					$data->category = Product::product_category( $data->id );
					/*	$data->parent   = Product::product_category( $d->id );*/

					$defaultMeta = array(
						'title'       => 'Каталог',
						'description' => 'Каталог',
						'keywords'    => 'Каталог'
					);
					UtilsController::defaultMeta( $data, $defaultMeta );
					return view( 'product' )->with( 'data', $data );

				}


			}


		}


		public static function categoryParent( $id )
		{

			$parent_id = YamzCategory::where( 'parent_id', $id )->first()->parent_id;
			return $parent_id;
		}


	}
