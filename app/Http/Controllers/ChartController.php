<?php

	namespace App\Http\Controllers;

	use App\Model\Product;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Mail;
	use App\Http\Requests;

	class ChartController extends Controller
	{

		protected $orderNum = '';
		protected $fileName = '';
		protected $username = '';
		protected $useremail = '';

		public function store( Request $request )
		{
			$product_data  = Product::where( 'id', $request->product_id )->first();
			$category_data = Product::product_category( $request->product_id );
			$new_record    = array(
				'product_name'   => $product_data->name,
				'product_alias'  => $product_data->alias,
				'product_id'     => $request->product_id,
				'price'          => $request->price,
				'count'          => $request->count,
				'category_id'    => $request->category_id,
				'category_name'  => $category_data->name,
				'category_alias' => $category_data->alias,

			);

			if( $request->session()->has( 'chart' ) ){

				$chartArray = $request->session()->get( 'chart', 'empty' );

				$issetId = $this->issetId( $request->product_id, $chartArray );

				if( !$issetId ){
					$request->session()->push( 'chart', $new_record );
				}


			} else{
				$newRecord[] = array(
					'product_name'   => $product_data->name,
					'product_alias'  => $product_data->alias,
					'product_id'     => $request->product_id,
					'price'          => $request->price,
					'count'          => $request->count,
					'category_id'    => $request->category_id,
					'category_name'  => $category_data->name,
					'category_alias' => $category_data->alias,

				);

				$request->session()->put( 'chart', $newRecord );
			}


			$data = $request->session()->get( 'chart', 'empty' );
			//return view( 'chart' )->with( 'data', $data );
			return view( 'chart_to_menu' )->with( 'data', $data );
		}


		public function issetId( $id, $aArray )
		{

			$Count = count( $aArray );

			if( $Count > 0 ){

				for( $i = 0; $i < $Count; $i++ ){

					if( $aArray[ $i ][ 'product_id' ] == $id ){
						return true;
					}

				}

			}

			return false;
		}

		public function load( Request $request )
		{
			if( $request->session()->has( 'chart' ) ){
				$data = $request->session()->get( 'chart', 'empty' );

				//return view( 'chart', [ 'data' => $data, 'state' => $request->state ] );
				return view( 'chart_to_menu', [ 'data' => $data, 'state' => $request->state ] );
			}


		}

		public function order( Request $request )
		{
			if( $request->session()->has( 'chart' ) ){

				$data = $request->session()->get( 'chart', 'empty' );

				return view( 'order' )->with( 'data', $data );
			} else{
				return redirect( '/categories' );
			}


		}

		public function is_chart( Request $request )
		{

			if( $request->session()->has( 'chart' ) ){

				die( 'true' );

			}

			die( 'false' );
		}


		public function changecount( Request $request )
		{

			if( $request->session()->has( 'chart' ) ){

				$aArray = $request->session()->get( 'chart', 'empty' );

				$Count = count( $aArray );

				$updatedArr = array();

				if( $Count > 0 ){

					for( $i = 0; $i < $Count; $i++ ){

						if( $aArray[ $i ][ 'product_id' ] == $request->id ){
							$aArray[ $i ][ 'count' ] = $request->count;
						}

						$updatedArr[] = $aArray[ $i ];
					}
					$request->session()->put( 'chart', $updatedArr );
				}


			}
		}


		public function destroy( Request $request )
		{

			if( $request->session()->has( 'chart' ) ){

				$aArray = $request->session()->get( 'chart', 'empty' );

				$Count = count( $aArray );

				$updatedArr = array();

				if( $Count > 0 ){

					for( $i = 0; $i < $Count; $i++ ){

						if( $aArray[ $i ][ 'product_id' ] != $request->id ){
							$updatedArr[] = $aArray[ $i ];
						}

					}
				return	$request->session()->put( 'chart', $updatedArr );
				}


			}
		}


		public function orderdel( Request $request )
		{

			if( $request->session()->has( 'chart' ) ){

				$request->session()->put( 'chart', [] );


			}
		}


		public function fileName()
		{


			$this->fileName = sys_get_temp_dir() . 'yamz76_ru_order_' . $this->orderNum . '_' . date( 'd_m_Y_H_i' ) . '.pdf';
		}


		public function orderNum()
		{

			$rand = rand( 111111, 999999 );

			$this->orderNum = $rand;

		}

		public function useremail( $useremail )
		{

			$this->useremail = $useremail;

		}

		public function username( $username )
		{

			$this->username = $username;

		}

		public function ordersend( Request $request )
		{


			if( $request->session()->has( 'chart' ) ){

				$data = $request->session()->get( 'chart', 'empty' );

				$this->orderNum(); // генерируем $this->orderNum
				$this->fileName(); // генерируем $this->fileName
				$this->useremail( $request->useremail );
				$this->username( $request->username );

				$aFromRequest = [
					'data'        => $data,
					'ordernum'    => $this->orderNum,
					'companyname' => $request->companyname,
					'username'    => $request->username,
					'userphone'   => $request->userphone,
					'useremail'   => $request->useremail,
					'usercomment' => $request->usercomment,
				];

				$html = view( 'email.order', $aFromRequest )->render();
				$f    = '<p style="font-style: normal;text-align: center;padding: 5px"> ООО «ЯрТрансАвто»
г. Ярославль, пос. Кузнечиха, Индустриальная, 7,<br> 
тел. 8 (4852) 67-22-30,
тел. 8 (4852) 67-22-31,
тел. 8 (4852) 67-22-32, 
Web yamz76.ru </p>';

				$mpdf       = new \mPDF( 'utf-8', 'A4', '', '', 0, 0, 0, 0, 5, 1, 1 );
				$stylesheet = file_get_contents( 'css/pdfPrintStyle.css' );
				$mpdf->SetFooter( $f );
				$mpdf->WriteHTML( $stylesheet, 1 );
				$mpdf->WriteHtml( $html );
				$mpdf->Output( $this->fileName );


				Mail::send( 'email.ordersend', $aFromRequest, function ( $message ){
					$message->from( 'noreply@yamz76.ru', 'Заявка OnLine' );
					$message->to( 'info@yamz76.ru', 'Админу сайта' );
					$message->cc( 'volga076@yandex.ru', 'Админу сайта' );
					$message->to( '76region95@mail.ru', 'Админу сайта' );
					$message->bcc( 'yaroslavl.city@gmail.com', 'Egorr' );
					$message->attach( $this->fileName );
					$message->subject( 'Заявка с сайта от ' . date( 'd.m.Y H:i' ) );
				} );

				if( filter_var( $request->useremail, FILTER_VALIDATE_EMAIL ) ){

					Mail::send( 'email.ordersendtouser', $aFromRequest, function ( $message ){
						$message->from( 'noreply@yamz76.ru', 'Сервис Заявка OnLine сайта Yamz76.ru' );
						$message->to( $this->useremail, $this->username );
						$message->bcc( 'yaroslavl.city@gmail.com', 'Egorr' );
						/*$message->to( 'yaroslavl.city@gmail.com' );*/
						$message->attach( $this->fileName );
						$message->subject( 'Ваша Заявка с сайта yamz76.ru от ' . date( 'd.m.Y H:i' ) );
					} );

				}

				echo json_encode( [ 'error' => 'ok', 'message' => '' ] );
				back();

			}
		}


	}
