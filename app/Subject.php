<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Subject extends Model
	{


		protected $fillable = [
			'name', 'yamz_categories_id',
		];

		public $timestamps = false;

		public function parts()
		{
			return $this->belongsToMany( 'App\Part', 'subjects_parts', 'subject_id', 'part_id' );
		}
	}
