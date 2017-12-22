<?php

namespace App\Widgets;

use App\Model\YamzCategory;
use Arrilot\Widgets\AbstractWidget;


class CategoriesMainMenu extends AbstractWidget
{

    protected $config = [];


    public function run()
    {
	    $data = YamzCategory::where( 'parent_id', '=', null )
		    ->where('public',1 )
		    ->orderBy('lft')
		    ->get();

	    return view( "widgets.categories_main_menu" )->with( 'data', $data );
    }
}