<?php

	namespace App\Http\Controllers;

	use App\Model\Action;
	use Illuminate\Http\Request;

	use App\Http\Requests;

	class ActionsController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			$data = Action::where( 'public', 1 )->get();
			return view( 'actions' )->with( 'data', $data );
		}


		public function show( Request $request )
		{
			$data = Action::where( 'alias', $request->alias )->first();
			return view( 'action' )->with( 'data', $data );
		}


	}
