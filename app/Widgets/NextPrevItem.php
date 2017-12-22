<?php

	namespace App\Widgets;

	use Arrilot\Widgets\AbstractWidget;

	class NextPrevItem extends AbstractWidget
	{

		protected $config = [];


		public function run( $data )
		{
			$prev = \DB::table( 'articles' )->where( [
					[ 'id', '<', $data->id ],
					[ 'public', 1 ]
				]
			)->take( 1 )->get();

			$next = \DB::table( 'articles'  )->where( [
					[ 'id', '>', $data->id ],
					[ 'public', 1 ]
				]
			)->take( 1 )->get();

			return view( "widgets.next_prev_item", [
				'prev' => $prev, 'next' => $next,  'table' => $data->table
			] );
		}
	}