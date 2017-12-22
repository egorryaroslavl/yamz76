<?php namespace App\Model;

use Baum\Node;
use Baum;
use Illuminate\Support\Facades\DB;


class YamzCategory extends Baum\Node
{

	protected $table = 'yamz_categories';

	// 'parent_id' column name
	protected $parentColumn = 'parent_id';

	// 'lft' column name
	protected $leftColumn = 'lft';

	// 'rgt' column name
	protected $rightColumn = 'rgt';

	// 'depth' column name
	protected $depthColumn = 'depth';

	// guard attributes from mass-assignment
	protected $guarded = array( 'id', 'parent_id', 'lft', 'rgt', 'depth' );

	public function products()
	{
		return $this->belongsToMany( 'Product', 'products_categories' );
	}

	public function parts()
	{
		return $this->hasMany( 'app\Parts' );
	}

	public static function childCount( $alias )
	{
		$id = YamzCategory::where( 'alias', $alias )->first()->id;
		return YamzCategory::where( 'parent_id', $id )->where( 'public', 1 )->count();
	}

	public static function productsInCategoryCount( $id )
	{
		return \DB::table( 'products' )->where( 'yamz_category_id', $id )->count();
	}


	public static function with_production()
	{

		return YamzCategory::whereIn(
			'id',
			Product::distinct()
				->select( 'yamz_category_id' )
				->groupBy( 'yamz_category_id' )
				->get()
		)->orderBy( 'lft' )
			->paginate( config('admin.settings.perPage') );

		//	return YamzCategory::get()->paginate( 20 );


	}


	public static function categories()
	{

		return YamzCategory::paginate( config('admin.settings.perPage')  );

		//	return YamzCategory::get()->paginate( 20 );


	}

	public static function category( $alias )
	{

		return YamzCategory::where( 'alias', $alias )->first();

	}

	/**
	 * @param $alias
	 *
	 * @return mixed
	 */
	public static function get_children( $alias )
	{
		$id = YamzCategory::where( 'alias', $alias )->first()->id;
		return YamzCategory::where( 'parent_id', $id )
			->where( 'public', 1 )
			->orderBy( 'lft' )->paginate(  config('admin.settings.perPage') );
	}


	public static function getChildrenCount( $id )
	{

		return YamzCategory::where( 'parent_id', $id )->where( 'public', 1 )->orderBy( 'lft' )->count();
	}


	/*
	 * Если категория не имеет продукции возвращается false
	 * Или продукция, если она есть
	 */
	public static function get_product()
	{

		$productsCount = Product::where( 'yamz_category_id' )->count();
		if( $productsCount == 0 ){
			return false;
		}
		return Product::where( 'yamz_category_id' )->orderBy( 'lft' )->get();
	}

	public static function get_parent( $id, $allFields = false )
	{

		if( is_string( $id ) ){
			$id = YamzCategory::where( 'alias', $id )->first()->id;
		}

		if( $allFields ){
			return YamzCategory::where( 'parent_id', $id )
				->first();
		}
		return YamzCategory::where( 'parent_id', $id )
			->first()->name;


	}

	public static function hasParent( $param )
	{

		$field = gettype( $param ) === 'string' ? 'alias' : 'id';

		$result = YamzCategory::where( $field, $param )
			->first()->parent_id;

		return is_null( $result ) ? false : true;

	}

	/**
	 * @return array
	 */
	public static function getOptions()
	{

		$sd = array();
		/*	$aData = YamzCategory::where( [
				[ 'depth', '=', 'null' ],
				[ 'depth', '<>', 'null' ],
			] )->get( [ 'id', 'name', 'parent_id' ] );*/

		$aData = YamzCategory::where( 'depth', '>', 0 )
			->get( [ 'id', 'name', 'parent_id' ] );


		$aData = \DB::table( 'yamz_categories' )->where( [
			/*	[ 'depth', '=', 'null' ],
				[ 'depth', '<>', 'null' ],*/
		] )->get();


		foreach( $aData as $value ){

			$parentName = YamzCategory::get_parent( $value->parent_id );

			$sd[ $value->id ] = $parentName . ' > ' . $value->name;
		}
		return $sd;


	}

	public static function getParents( $id )
	{
		return YamzCategory::where( 'parent_id', '=', $id )
			->orderBy( 'lft' );

	}


 	public static function breadCrumbs( $alias )
	{

 		$data = self::get_parent( $alias, true );

		$breadCrumbs = [];

		while( $data->parent_id === 'NULL' ){

			$breadCrumbs[] = [ $data->alias, $data->name ];
			self::breadCrumbs( $data->alias,true );
		}

		return $breadCrumbs;

	}


	public static function rootCategories()
	{

		return YamzCategory::where( 'parent_id', '=', null )
			->orderBy( 'lft' )
			->paginate( config('admin.settings.perPage') );


	}


	public static function getAliases()
	{

		$sd = array();

		$aData = YamzCategory::where( 'public', 1 )->get( [ 'alias' ] );


		foreach( $aData as $value ){


			$sd[] = $value->alias;
		}
		return '(' . implode( '|', $sd ) . ')';


	}

}
