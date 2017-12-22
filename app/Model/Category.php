<?php

	namespace App\Model;

	use Illuminate\Database\Eloquent\Model;

	class Category extends Model
	{
		protected $table = 'yamz_categories';
		protected $fillable = [ 'id', 'yamz_category_id', 'name', 'alias', 'description', 'short_description', 'icon', 'pos', 'public', 'anons', 'hit', 'metatag_title', 'metatag_description', 'metatag_keywords', 'created_at', 'updated_at' ];






	}
