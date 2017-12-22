<?php

	namespace App\Http\Controllers;

	use App\Model\Service;
	use Illuminate\Http\Request;

	use App\Http\Requests;

	class ServiceController extends Controller
	{

		public function index()
		{
			$data = Service::get();
			/*			$defaultMeta = array(
							'title'       => 'Статьи',
							'description' => 'Статьи',
							'keywords'    => 'Статьи'
						);
						UtilsController::defaultMeta( $data, $defaultMeta );*/
			return view( 'services' )->with( 'data', $data );


		}


		public function show( Request $request )
		{
			$count = Service::where( 'alias', $request->alias )->where( 'public', 1 )->count();
			if( $count == 0 ){
				abort( 404 );
			}
			$data        = Service::where( 'alias', $request->alias )->where( 'public', 1 )->first();
			$defaultMeta = array(
				'title'       => $data->name,
				'description' => $data->name,
				'keywords'    => $data->name
			);
			UtilsController::defaultMeta( $data, $defaultMeta );
			return view( 'service' )->with( 'data', $data );
		}

	}
