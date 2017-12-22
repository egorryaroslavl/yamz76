<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\View\View;
	use Illuminate\Support\Facades\Route;
	use Collective\Html\HtmlFacade;
	use Sentinel;
	use Carbon\Carbon;

	class CustomHelpers extends Controller
	{


		public static function bytesToHuman( $bytes )
		{
			$units = [ 'B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB' ];

			for( $i = 0; $bytes > 1024; $i++ ){
				$bytes /= 1024;
			}

			return round( $bytes, 1 ) . ' ' . $units[ $i ];
		}


		public static function withFirstElement( $sourceArray, $customText = false )
		{
			$firstItem = config( 'admin.settings.first_item' );

			if( $customText ){
				$firstItem = [ null => ' :: ' . $customText . ' :: ' ];
			}

			if( count( $sourceArray ) === 0 ){
				$firstItem .= [ null => '   Список пуст...   ' ];
			}

			return $firstItem + $sourceArray;

		}


		public static function ruDate( $date )
		{
			$month = array( 1 => "января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря" );
			if( $date !== null ){
				$carbon = Carbon::parse( $date );
				$d      = $carbon::parse( $date )->format( 'd' );
				$m      = $carbon::parse( $date )->format( 'n' );
				$y      = $carbon::parse( $date )->format( 'Y' );
				return $d . ' ' . $month[ $m ] . ' ' . $y;
			}
		}



		public static function translite( $string )
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

	}
