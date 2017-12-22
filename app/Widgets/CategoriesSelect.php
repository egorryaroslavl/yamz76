<?php

	namespace App\Widgets;

	use Arrilot\Widgets\AbstractWidget;
	use App\Model\YamzCategory;

	class CategoriesSelect extends AbstractWidget
	{
		/**
		 * The configuration array.
		 *
		 * @var array
		 */
		protected $config = [];


		public function run()
		{

			$data =   YamzCategory::where( 'parent_id', '=', null )
					->orderBy( 'lft' )
					->get();

			return view( "widgets.categories_select" )->with( 'data', $data )->render();
		}
	}