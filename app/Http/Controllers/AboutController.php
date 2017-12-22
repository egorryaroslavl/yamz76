<?php

namespace App\Http\Controllers;

use App\Model\About;
use Illuminate\Http\Request;
use App\Http\Requests;

class AboutController extends Controller
{

    public function index()
    {
	   $data = About::where('id',1)->first();
/*	    $defaultMeta = [
		    'title'       => 'О нас',
		    'description' => 'О нас',
		    'keywords'    => 'О нас'
	    ];
	    UtilsController::defaultMeta( $data, $defaultMeta );*/
	    return view( 'about' )
		    ->with( 'data', $data );

    }



}
