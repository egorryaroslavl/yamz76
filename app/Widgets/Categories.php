<?php

	namespace App\Widgets;

	use App\Model\YamzCategory;
	use Arrilot\Widgets\AbstractWidget;
	use Cache;

	class Categories extends AbstractWidget
	{

		protected $config = [];


		public function run()
		{


			$data = YamzCategory::where( 'parent_id', '=', null )
				->where( 'public', 1 )
				->orderBy( 'lft' )
				->get();

			return view( "widgets.categories" )->with( 'data', $data )->render();


		}


	}