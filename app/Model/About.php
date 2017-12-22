<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
	protected $casts = [
		'photos' => 'array',
		'images' => 'array',
	];
}
