<?php

	namespace App\Http\Controllers\Prices;

	use App\Model\Product;
	use App\Model\YamzCategory;
	use Illuminate\Http\Request;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;
	use Illuminate\Support\Facades\DB;

	class PricesController extends Controller
	{

		public function __construct()
		{
			$this->middleware( 'auth' );
		}


		public function index()
		{


			$data =	YamzCategory::with_production();

			$data->table = 'yamz_categories';
			return view( 'prices.categories_list' )->with( 'data', $data );
		}


		public function edit( Request $request )
		{

			$data          = YamzCategory::where( 'id', $request->id )->first();
			$data->all = YamzCategory::get();
			return view( 'prices.edit' )->with( 'data', $data );
		}


		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			//
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function store( Request $request )
		{
			//
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function show( $id )
		{
			//
		}


		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int                      $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function update( Request $request, $id )
		{
			//
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function destroy( $id )
		{
			//
		}
	}
