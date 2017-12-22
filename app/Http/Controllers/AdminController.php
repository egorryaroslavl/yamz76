<?php

	namespace App\Http\Controllers;

	use Faker\Provider\File;
	use Illuminate\Http\Request;
	use App\Http\Requests;
	use App\Http\Controllers\Input;
	use DB;

	class AdminController extends Controller
	{

		public static function status_buttons_set( $data )
		{
			return view( 'admin.common.status_buttons_set', [ 'data' => $data ] );
		}

		public static function status_change( Request $request )
		{
			$sql = "
			UPDATE `" . $request->table . "` 
			SET `" . $request->field . "` = NOT `" . $request->field . "` WHERE id =" . $request->id;

			$res = \DB::update( $sql );

			if( $res > 0 ){
				$current = $request->value > 0 ? '0' : '1';
				echo json_encode( [ 'error' => 'ok', 'message' => $current ] );
			} else{
				echo json_encode( [ 'error' => 'error', 'message' => '' ] );
			}

		}

		public static function imagesave( Request $request )
		{
			/*			if( $image = \Input::file( 'photo' ) ){
							$filename     = str_random( 6 ) . '.' . $image->getClientOriginalExtension();
							$path         = public_path( '/uploads/' . $filename );
							$resizedImage = \Image::make( $image->getRealPath() )->resize( 200, 200 );
							$resizedImage->response( 'jpg' );
							\Storage::put( 'uploads/' . $filename, $resizedImage );

							echo json_encode( [ 'error' => 'ok', 'message' => $filename ] );
						}*/


		}

		public static function iconsave( Request $request )
		{
			if( $request->hasFile( 'photo' ) ){
				//
				/*	dd(  );*/

				$uploads_dir = sys_get_temp_dir();

				$file     = $request->file( 'photo' );
				$ext      = $file->clientExtension();
				$tmp_name = $_FILES[ "photo" ][ "tmp_name" ];
				/*$name     = basename( $_FILES[ "photo" ][ "name" ] );*/
				$name = 'icon_' . $_POST[ 'table' ] . "_" . $_POST[ 'id' ] . ".$ext";

				$res = move_uploaded_file( $tmp_name, "$uploads_dir/$name" );
				if( $res > 0 ){
					echo json_encode( [ 'error' => 'ok', 'message' => $uploads_dir . '/' . $name ] );
				}


			}
		}


		public static function changeprice( Request $request )
		{

			$updateRes = DB::table( $request->table )
				->where( 'id', $request->id )
				->update( [ 'price' => $request->price ] );

			if( $updateRes > 0 ){
				echo json_encode( [ 'error' => 'ok', 'message' => '' ] );

			} else{
				echo json_encode( [ 'error' => 'error', 'message' => '' ] );
			}


		}


		public function delete( Request $request )
		{


			$deleteRes = \DB::table( $request->table )
				->where( 'id', '=', $request->id )
				->delete();

			if( $deleteRes > 0 ){
				echo json_encode( [ 'error' => 'ok', 'message' => '' ] );

			} else{
				echo json_encode( [ 'error' => 'error', 'message' => 'В ходе удаления возникли ошибки!' ] );
			}
		}

		public static function icondelete( Request $request )
		{
			if( $request->id != 0 ){
				$icon = \DB::table( $request->table )
					->select( [ 'icon' ] )
					->where( 'id', $request->id )->get();


				if( is_null( $icon[ 0 ]->icon ) or empty( $icon[ 0 ]->icon ) ){

					return json_encode( [ 'error' => 'error', 'message' => 'В процессе удаления возникли ошибки!' ] );

				}
				$iconNameSmall = $icon[ 0 ]->icon;
				$iconName      = str_replace( '_small', '', $iconNameSmall );

				$iconNameSmallPath = public_path() . $iconNameSmall;
				$iconNamePath      = public_path() . $iconName;

				$iconNameSmallDel = false;
				$iconNameDel      = false;
				$resArr           = [
					'error'        => 'error',
					'success'      => false,
					'name'         => null,
					'thumbnailUrl' => null,
					'qquuid'       => $request->qquuid,
					'uuid'         => $request->qquuid,
				];


				if( file_exists( $iconNameSmallPath ) ){
					$iconNameSmallDel = unlink( $iconNameSmallPath );
				}
				if( file_exists( $iconNamePath ) ){
					$iconNameDel = unlink( $iconNamePath );
				}

				if( $iconNameDel && $iconNameSmallDel ){

					\DB::table( $request->table )
						->where( 'id', $request->id )
						->update( [ 'icon' => null ] );

					$resArr = [
						'error'        => 'ok',
						'success'      => true,
						'name'         => null,
						'thumbnailUrl' => null,
						'qquuid'       => $request->qquuid,
						'uuid'         => $request->qquuid,
					];

				}

				echo json_encode( $resArr );


			}

		}
	}
