<?php

namespace App\Widgets;

use App\Model\Article;
use Arrilot\Widgets\AbstractWidget;

class LatestArticles extends AbstractWidget
{

    protected $config = [];


    public function run()
    {

	    $data = Article::where( 'public',1 )->orderBy('created_at','DESC')->limit(3)->get( );

	    return view( "widgets.latest_articles" )->with( 'data', $data );
    }
}