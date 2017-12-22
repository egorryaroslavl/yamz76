<?php

	namespace App\Model;

	use Illuminate\Database\Eloquent\Model;

	class Product extends Model
	{
		protected $table = 'products';
		protected $fillable = [ 'id', 'yamz_category_id', 'name', 'alias', 'articul', 'description', 'short_description', 'updated_at', 'applicability', 'price', 'trademark', 'icon', 'pos', 'public', 'anons', 'hit', 'metatag_title', 'metatag_description', 'metatag_keywords', 'created_at', 'updated_at' ];

		public function yamz_categories()
		{
			return $this->belongsToMany( 'YamzCategory', 'products_yamz_categories' );
		}


		public static function product_category( $id )
		{
			$yamz_category_id = Product::where( 'id', $id )->first()->yamz_category_id;
			$category         = YamzCategory::where( 'id', $yamz_category_id )->first();
			$category->parent = null;
			if( !is_null( $category->parent_id ) ){
				$category->parent = YamzCategory::where( 'id', $category->parent_id )->first();
			}
			return $category;

		}

		public static function getAliases()
		{

			$sd = array();

			$aData = Product::where( 'public', 1 )->get( [ 'alias' ] );


			foreach( $aData as $value ){


				$sd[] = $value->alias;
			}
			return '(' . implode( '|', $sd ) . ')';


		}

	}
