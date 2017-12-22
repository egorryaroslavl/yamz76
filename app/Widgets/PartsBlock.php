<?php

	namespace App\Widgets;

	use Arrilot\Widgets\AbstractWidget;
	use Illuminate\Http\Request;
	use Route;

	class PartsBlock extends AbstractWidget
	{

		protected $config = [
			'position' => null
		];


		public function run( $position )
		{

			return view( "widgets.parts_block", [
				'position' =>  $position
			] );
		}
	}