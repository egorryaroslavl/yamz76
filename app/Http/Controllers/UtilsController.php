<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Mail;
	use DB;
	use PDO;
	use App\Http\Requests;

	class UtilsController extends Controller
	{


		public function reorder( Request $request )
		{


			if( isset( $request->sort_data ) ){

				$id        = array();
				$table     = $request->table;
				$sort_data = $request->sort_data;

				parse_str( $sort_data );

				$count = count( $id );
				for( $i = 0; $i < $count; $i++ ){


					DB::update( 'UPDATE `' . $table . '` SET `lft`=' . $i . ' WHERE `id`=? ', [ $id[ $i ] ] );

				}

			}
		}

		public static function Pre( $Arr )
		{
			echo '<span style="font-size:1.5em;color:#008800;">Items - ' . count( $Arr ) . '</span>
			<pre style="font-size:1.5em;">';
			print_r( $Arr );
			echo '</pre>';
		}


		public function translite( Request $request )
		{

			$alias_tranlited = self::translite_( $request->alias_source );

			echo json_encode( array( 'alias' => $alias_tranlited ) );
		}


		public function translite_( $string )
		{

			$dictionary = array(
				"А" => "a",
				"Б" => "b",
				"В" => "v",
				"Г" => "g",
				"Д" => "d",
				"Е" => "e",
				"Ж" => "zh",
				"З" => "z",
				"И" => "i",
				"Й" => "y",
				"К" => "K",
				"Л" => "l",
				"М" => "m",
				"Н" => "n",
				"О" => "o",
				"П" => "p",
				"Р" => "r",
				"С" => "s",
				"Т" => "t",
				"У" => "u",
				"Ф" => "f",
				"Х" => "h",
				"Ц" => "ts",
				"Ч" => "ch",
				"Ш" => "sh",
				"Щ" => "sch",
				"Ъ" => "",
				"Ы" => "yi",
				"Ь" => "",
				"Э" => "e",
				"Ю" => "yu",
				"Я" => "ya",
				"а" => "a",
				"б" => "b",
				"в" => "v",
				"г" => "g",
				"д" => "d",
				"е" => "e",
				"ж" => "zh",
				"з" => "z",
				"и" => "i",
				"й" => "y",
				"к" => "k",
				"л" => "l",
				"м" => "m",
				"н" => "n",
				"о" => "o",
				"п" => "p",
				"р" => "r",
				"с" => "s",
				"т" => "t",
				"у" => "u",
				"ф" => "f",
				"х" => "h",
				"ц" => "ts",
				"ч" => "ch",
				"ш" => "sh",
				"щ" => "sch",
				"ъ" => "y",
				"ы" => "y",
				"ь" => "",
				"э" => "e",
				"ю" => "yu",
				"я" => "ya",
				"-" => "_",
				" " => "_",
				"," => "_",
				"." => "_",
				"?" => "",
				"!" => "",
				"«" => "",
				"»" => "",
				":" => "",
				'ё' => "e",
				'Ё' => "e",
				"*" => "",
				"(" => "",
				")" => "",
				"[" => "",
				"]" => "",
				"<" => "",
				">" => ""
			);
			$string     = preg_replace( '/[^\w\s]/u', ' ', $string );
			$string     = mb_strtolower( strtr( strip_tags( trim( $string ) ), $dictionary ) );
			return preg_replace( '/[_]+/', '_', $string );
		}


		public function sendmail( Request $request )
		{

			$data = array(
				'name'    => $request->name,
				'phone'   => $request->phone,
				'email'   => $request->email,
				'message' => $request->message,
			);

			Mail::send( 'emails.usermsg', [ 'data' => $data ], function ( $message ){
				$message->to( 'yaroslavl.city@gmail.com', 'Админу сайта' )->subject( 'Сообщение с сайта' );
			} );

		}

		public static function defaultMeta( $data, $defaultMeta )
		{

			if( !isset( $defaultMeta ) || !is_array( $defaultMeta ) || count( $defaultMeta ) == 0 ){
				$defaultMeta = array(
					'title'       => 'ООО «ЯрТрансАвто»',
					'description' => 'ООО «ЯрТрансАвто»',
					'keywords'    => 'ООО «ЯрТрансАвто»' );
			}

			if( !isset( $data->metatag_title ) && empty( $data->metatag_title ) ){
				$data->metatag_title = $defaultMeta[ 'title' ];
			}
			if( !isset( $data->metatag_description ) || empty( $data->metatag_description ) ){
				$data->metatag_description = $defaultMeta[ 'description' ];
			}

			if( !isset( $data->metatag_keywords ) || empty( $data->metatag_keywords ) ){
				$data->metatag_keywords = $defaultMeta[ 'keywords' ];
			}

		}


		public static function itemActive( $path, $request )
		{

			if( $request == $path ){
				echo ' current-menu-item ';
			}

		}

		function reverseValue( Request $request )
		{
			$error = 'error';
			if( isset( $request->table ) ){

				$value = $request->value;
				$table = $request->table;
				$id    = $request->id;
				//UPDATE users SET `authorised` = IF (`authorised`, 0, 1)
				$res = DB::update( 'UPDATE `' . $table . '` SET `public` = IF (`public`, 0, 1) WHERE `id`=? ', [ $id ] );


				if( $res > 0 ){
					$error = 'ok';
					$nv    = DB::select( 'SELECT `public` FROM  `' . $table . '` WHERE `id`=? ', [ $id ] );
					$name  = $nv->fetchColumn( PDO::FETCH_OBJ );
					dd( $name->public );
					echo json_encode( [ 'error' => $error, 'messsage' => $name->public ] );
				}


			}

		}

		public static function pageOneClear( $p )
		{

			if( preg_match( '/(\?page=1)([^\d])/i', $p ) ){
				return preg_replace( '/(\?page=1")/i', '"', $p );
			} else{
				return $p;
			}

		}


		/**
		 * Highlighting matching string
		 *
		 * @param   string $text  subject
		 * @param   string $words search string
		 *
		 * @return  string  highlighted text
		 */
		public static function highlight( $words, $name, $articul )
		{

			$articul = !empty( $articul ) ? " ($articul)" : '';

			$text        =   mb_strtolower( $name )  . $articul;
			$highlighted = preg_replace( "/" . mb_strtolower(  $words ) . "/", '<span class="search-highlight">$0</span>', $text );
			if( !empty( $highlighted ) ){
				$text = $highlighted;
			}
			return $text;
		}

		public static function highLightSearchResult( $word, $name, $articul )
		{


			$highlighted = preg_filter( '/' . preg_quote( $word ) . '/i', '<span class="search-highlight">$0</span>', $name );

			if( !empty( $highlighted ) ){
				$name = $highlighted;
			}
			return $name;


			/*			$articul = !empty( $articul ) ? ' (' . $articul . ')' : '';
						$name = mb_strtolower($name);
						 $word = mb_strtolower($word);
						$name = str_ireplace($word,"<span style='color:#FF4500'>$word</span>",$name);
						$articul = str_ireplace($word,"<span style='color:#FF4500'>$word</span>",$articul);
						return $name .$articul;*/

			//	{{$item->name}}{{ !empty($item->articul) ? ' ('. $item->articul .')' :''}}

		}
	}
