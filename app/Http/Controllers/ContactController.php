<?php

	namespace App\Http\Controllers;

	use App\Model\Contact;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Mail;

	use App\Http\Requests;

	class ContactController extends Controller
	{

		public function index()
		{
			$data = Contact::where( 'id', 1 )->first();

			$defaultMeta = array(
				'title'       => 'Контакты',
				'description' => 'Контакты',
				'keywords'    => 'Контакты'
			);
			UtilsController::defaultMeta( $data, $defaultMeta );
			return view( 'contacts' )
				->with( 'data', $data );
		}


		public function messagesend( Request $request )
		{


			$aFromRequest = [
				'name'        => $request->name,
				'phone'       => $request->phone,
				'email'       => $request->email,
				'usermessage' => $request->message,
			];


			Mail::send( 'email.messagesend', $aFromRequest, function ( $message ){
				$message->from( 'noreply@yamz76.ru', 'Сообщение с сайта  yamz76.ru' );
				$message->to( 'info@yamz76.ru', 'Админу сайта' );
				$message->cc( 'volga076@yandex.ru', 'Админу сайта' );
				//	 $message->to( 'yaroslavl.city@gmail.com', 'Админу сайта' );
				//$message->to( '76region95@mail.ru', 'Админу сайта' );
				$message->bcc( 'yaroslavl.city@gmail.com', 'Egorr' );

				$message->subject( 'Сообщение с сайта от ' . date( 'd.m.Y H:i' ) );
			} );

			echo json_encode( [ 'error' => 'ok', 'message' => '' ] );


		}

	}
