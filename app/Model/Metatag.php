<?php

	namespace App\Model;

	use Illuminate\Database\Eloquent\Model;

	class Metatag extends Model
	{
		protected $fillable = ['name','text','type'];
	}
