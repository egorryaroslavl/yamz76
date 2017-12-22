<?php

	namespace App;

	use App\Model\YamzCategory;
	use Illuminate\Database\Eloquent\Model;
	use DB;
	use Storage;
	use Illuminate\Pagination\LengthAwarePaginator;
	use Illuminate\Database\Eloquent\Collection;

	class Part extends Model
	{

		protected $fillable = [
			'position', 'sentence', 'subject', 'part',
		];

		protected $categoryId = '';

		public $timestamps = false;


		public function subjects()
		{
			return $this->belongsToMany( 'App\Subject', 'subjects_parts', 'part_id', 'subject_id' );
		}


		public function categories()
		{
			return $this->belongsTo( YamzCategory::class );
		}

		public function setCategoryId( $categoryId )
		{

			$this->categoryId = $categoryId;

			return $this;

		}


		public function getCategoryId()
		{

			return $this->categoryId;

		}


		public function CategoryId()
		{

			return $this->categoryId;

		}


		public static function sentences()
		{
			if( !Storage::exists( config( 'admin.settings.sentences_json' ) ) ){
				return false;
			}
			$sentences      = Storage::get( config( 'admin.settings.sentences_json' ) );
			$sentencesArr   = json_decode( $sentences );
			$sentencesCount = count( $sentencesArr );
			return count( $sentencesCount );
		}


	}
