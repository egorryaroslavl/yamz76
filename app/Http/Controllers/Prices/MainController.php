<?php

	namespace App\Http\Controllers\Prices;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;

	class MainController extends Controller
	{
 		public function __construct()
		{
			$this->middleware( 'auth' );
		}


		public function index()
		{
			return view( 'prices.main' );
		}


	}