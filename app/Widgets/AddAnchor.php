<?php

	namespace App\Widgets;

	use Arrilot\Widgets\AbstractWidget;

	class AddAnchor extends AbstractWidget
	{

		protected $config = [ 'position' => null ];


		public function run( $position )
		{


			return view( "widgets.add_anchor", [
				'position' => $position
			] );
		}
	}