<?php

	namespace App\Model;

	use Illuminate\Database\Eloquent\Model;

	class Service extends Model
	{
		protected $casts = [
			'photos' => 'array',
			'images' => 'array',
		];
	}
