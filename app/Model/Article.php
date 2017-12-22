<?php

	namespace App\Model;

	use Illuminate\Database\Eloquent\Model;

	class Article extends Model
	{
		protected $casts = [
			'photos' => 'array',
			'images' => 'array',
		];
	}
