<?php

	namespace App\Widgets;

	use App\Http\Controllers\UtilsController;
	use Arrilot\Widgets\AbstractWidget;

	class NextPrevProduct extends AbstractWidget
	{

		protected $config = [];


		public function run( $data )
		{


			$prev = \DB::table( $data->table )->where( [
					[ 'yamz_category_id', $data->category->id ],
					[ 'id', '<', $data->id ],
					[ 'public', 1 ],
				]
			)->take( 1 )->get();

			$next = \DB::table( $data->table )->where( [
					[ 'yamz_category_id', $data->category->id ],
					[ 'id', '>', $data->id ],
					[ 'public', 1 ],
				]
			)->take( 1 )->get();


			return view( "widgets.next_prev_product", [
				'prev' => $prev, 'next' => $next
			] );
		}
	}