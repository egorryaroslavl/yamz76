<?php

	namespace App\Model;

	use Illuminate\Database\Eloquent\Model;

	class Contact extends Model
	{
		protected $casts = [
			'photos' => 'array',
			'images' => 'array',
		];

		public static function address()
		{

			return Contact::where( 'id', 1 )->first()->address;

		}


		public static function address_yurid()
		{

			return Contact::where( 'id', 1 )->first()->address_yurid;

		}


		public static function phone()
		{

			return Contact::where( 'id', 1 )->first()->phone;

		}


		public static function map()
		{

			return Contact::where( 'id', 1 )->first()->map;

		}


		public static function schedule()
		{

			return Contact::where( 'id', 1 )->first()->schedule;

		}

		public static function rekvizity()
		{

			return Contact::where( 'id', 1 )->first()->rekvizity;

		}

		public static function icon()
		{

			return Contact::where( 'id', 1 )->first()->icon;

		}

		public static function email()
		{

			return Contact::where( 'id', 1 )->first()->email;

		}



		public static function skype()
		{

			return Contact::where( 'id', 1 )->first()->skype;

		}



	}
