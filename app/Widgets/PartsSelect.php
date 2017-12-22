<?php

	namespace App\Widgets;

	use Arrilot\Widgets\AbstractWidget;
	use Illuminate\Http\Request;
	use Route;

	class PartsSelect extends AbstractWidget
	{
		/**
		 * The configuration array.
		 *
		 * @var array
		 */
		protected $config = [
			'position' => null
		];


		public function run( $position )
		{

			return view( "widgets.parts_select", [
				'position' =>  $position
			] );
		}
	}