<?php

	namespace App\Providers;

	use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

	class AdminSectionsServiceProvider extends ServiceProvider
	{

		/**
		 * @var array
		 */
		protected $sections = [
			\App\Model\Article::class      => 'App\Http\Sections\Article',
			\App\Model\Action::class       => 'App\Http\Sections\Action',
			\App\Model\Client::class       => 'App\Http\Sections\Client',
			\App\Model\Service::class      => 'App\Http\Sections\Service',
			\App\Model\Contact::class      => 'App\Http\Sections\Contact',
			\App\Model\About::class        => 'App\Http\Sections\About',
			\App\Model\YamzCategory::class => 'App\Http\Sections\YamzCategory',
			\App\Model\Product::class      => 'App\Http\Sections\Product',
			\App\Model\Review::class       => 'App\Http\Sections\Review',
			\App\Model\Seo::class          => 'App\Http\Sections\Seo',
		];

		/**
		 * Register sections.
		 *
		 * @return void
		 */
		public function boot( \SleepingOwl\Admin\Admin $admin )
		{
			//

			parent::boot( $admin );
		}
	}
