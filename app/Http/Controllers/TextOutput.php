<?php

	namespace App\Http\Controllers;

	use App\Part;
	use Illuminate\Http\Request;
	use DB;
	use Cache;
	use App\Http\Requests;

	class TextOutput extends Part
	{
		private $category_id;

		/*		public $position = '';
				public $sentence = '';*/

		public function __construct( $category_id )
		{
			$this->category_id = $category_id;

		}


		public function textRand()
		{


			/* получаем массивы предложений */
			$sentenceOne   = $this->sentenceOne();
			$sentenceTwo   = $this->sentenceTwo();
			$sentenceThree = $this->sentenceThree();
			$sentenceFour  = $this->sentenceFour();

			if( !$sentenceOne || !$sentenceTwo || !$sentenceThree || !$sentenceFour ){
				return '';
			}


			do{
				/* извлекаем случайные ключи из массивов */
				$sentenceOneKey   = array_rand( $sentenceOne );
				$sentenceTwoKey   = array_rand( $sentenceTwo );
				$sentenceThreeKey = array_rand( $sentenceThree );
				$sentenceFourKey  = array_rand( $sentenceFour );

				/* получаем ключ текста */
				$textId = "$sentenceOneKey.$sentenceTwoKey.$sentenceThreeKey.$sentenceFourKey";
			} while( $this->uniqTextId( $textId ) === true );

			$this->putTextId( $textId );


			$html = "{$sentenceOne[ $sentenceOneKey ]}. {$sentenceTwo[ $sentenceTwoKey ]}. {$sentenceThree[ $sentenceThreeKey ]}. {$sentenceFour[ $sentenceFourKey ]}.";

			return str_replace( "<br>", "", $html );
		}


		public function parts( $position, $sentence )
		{

			$key = "parts_category_id" . $this->category_id . "position" . $position . "sentence" . $sentence;

			if( Cache::has( $key ) ){
				return Cache::get( $key, [] );
			}


			$andWhere = "";

			if( $position && $sentence ){
				$andWhere = "
AND `position` = '$position'
AND `sentence`  = $sentence";

			}


			$pdo = DB::connection()->getPdo();
			$sql = "
SELECT `part`  FROM `parts` 
WHERE `id` IN (
SELECT `part_id`  
FROM `parts_yamz_categories` 
WHERE `yamz_category_id` = $this->category_id ) 
$andWhere
ORDER BY `position`";

			$data = $pdo->query( $sql )
				->fetchAll( \PDO::FETCH_COLUMN );


			//dd( $data );

			Cache::put( $key, $data, 30 );

			return count( $data ) > 0 ? $data : false;

		}


		/**
		 * Формирует массив предложений #1
		 *
		 * @return array|mixed
		 */
		public function sentenceOne()
		{

			$key = "sentenceOne_category_id" . $this->category_id;
			if( Cache::has( $key ) ){
				return Cache::get( $key, [] );
			}

			$outArray = array();
			$partsA   = $this->parts( 'a', 1 );
			$partsB   = $this->parts( 'b', 1 );
			$partsC   = $this->parts( 'c', 1 );

			if(
				!$partsA
				&& !$partsB
				&& !$partsC

			){
				return false;
			}


			shuffle( $partsA );
			shuffle( $partsB );
			shuffle( $partsC );


			foreach( $partsA as $one ){
				foreach( $partsB as $two ){
					foreach( $partsC as $three ){
						$outArray[] = $one . ' ' . $two . ' ' . $three;
					}

				}

			}
			Cache::put( $key, $outArray, 30 );
			return $outArray;
		}

		/**
		 * Формирует массив предложений #2
		 *
		 * @return array|mixed
		 */
		public function sentenceTwo()
		{

			$key = "sentenceTwo_category_id" . $this->category_id;
			if( Cache::has( $key ) ){
				return Cache::get( $key, [] );
			}


			$outArray = array();
			$partsA   = $this->parts( 'a', 2 );
			$partsB   = $this->parts( 'b', 2 );
			$partsC   = $this->parts( 'c', 2 );

			if(
				!$partsA
				&& !$partsB
				&& !$partsC

			){
				return false;
			}


			shuffle( $partsA );
			shuffle( $partsB );
			shuffle( $partsC );

			foreach( $partsA as $one ){
				foreach( $partsB as $two ){
					foreach( $partsC as $three ){
						$outArray[] = $one . ' ' . $two . ' ' . $three;
					}

				}

			}
			Cache::put( $key, $outArray, 30 );
			return $outArray;
		}

		/**
		 * Формирует массив предложений #1
		 *
		 * @return array|mixed
		 */
		public function sentenceThree()
		{

			$key = "sentenceThree_category_id" . $this->category_id;
			if( Cache::has( $key ) ){
				return Cache::get( $key, [] );
			}


			$outArray = array();
			$partsA   = $this->parts( 'a', 3 );
			$partsB   = $this->parts( 'b', 3 );
			$partsC   = $this->parts( 'c', 3 );

			if(
				!$partsA
				&& !$partsB
				&& !$partsC

			){
				return false;
			}


			shuffle( $partsA );
			shuffle( $partsB );
			shuffle( $partsC );

			if( count( $partsA ) == 0 && count( $partsB ) == 0 && count( $partsC ) == 0 ){
				return false;
			}

			foreach( $partsA as $one ){
				foreach( $partsB as $two ){
					foreach( $partsC as $three ){
						$outArray[] = $one . ' ' . $two . ' ' . $three;
					}

				}

			}
			Cache::put( $key, $outArray, 30 );
			return $outArray;
		}


		public function sentenceFour()
		{

			$key = "sentenceFour_category_id" . $this->category_id;
			if( Cache::has( $key ) ){
				return Cache::get( $key, [] );
			}


			$outArray = array();
			$partsA   = $this->parts( 'a', 4 );
			$partsB   = $this->parts( 'b', 4 );
			$partsC   = $this->parts( 'c', 4 );

			if(
				!$partsA
				&& !$partsB
				&& !$partsC

			){
				return false;
			}


			shuffle( $partsA );
			shuffle( $partsB );
			shuffle( $partsC );

			foreach( $partsA as $one ){
				foreach( $partsB as $two ){
					foreach( $partsC as $three ){
						$outArray[] = $one . ' ' . $two . ' ' . $three;
					}

				}

			}
			Cache::put( $key, $outArray, 30 );
			return $outArray;
		}

		public function textIds()
		{


			if( Cache::has( 'TextKeys' ) ){
				return Cache::get( 'TextKeys', [] );
			}

			return false;


		}

		public function uniqTextId( $id )
		{

			$textIds = $this->textIds();


			if( $textIds && in_array( $id, $textIds ) ){
				return true;
			}

			return false;

		}

		public function putTextId( $id )
		{

			if( Cache::has( 'TextKeys' ) ){
				$textIds = Cache::get( 'TextKeys', [] );
				array_push( $textIds, $id );
				Cache::put( 'TextKeys', [ $textIds ], 30 );

			}


		}


	}
