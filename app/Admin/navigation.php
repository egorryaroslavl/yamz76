<?php

	use SleepingOwl\Admin\Navigation\Page;


	return [
		[
			'title'    => 'Главная',
			'icon'     => 'fa fa-home',
			'url'      => route( 'admin.dashboard' ),
			'priority' => 10,
		],

		[
			'title'    => 'Прайсы',
			'icon'     => 'fa fa-money',
			'url'      => 'admin/prices',
			'priority' => 50,
		],

		[
			'title' => 'Продукция',
			'icon'  => 'fa fa-money',
			//'url'      =>  'admin/products/list' ,
			'url'   => 'admin/product/categories',

			'priority' => 50,
		],

	];


