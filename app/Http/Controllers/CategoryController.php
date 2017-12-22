<?php

	namespace App\Http\Controllers;

	use App\Model\Category;
	use App\Model\Product;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;
	use App\Http\Requests;

	class CategoryController extends Controller
	{


		function messages()
		{
			$strLimit = config( 'admin.settings.text_limit.text_short_description.', 300 );
			return [
				'name.required'         => 'Поле "Имя" обязятельно для заполнения!',
				'alias.required'        => 'Поле "Алиас" обязятельно для заполнения!',
				'name.unique'           => 'Значение поля "Имя" не является уникальным!',
				'alias.unique'          => 'Значение поля "Алиас" не является уникальным!',
				'description.required'  => 'Поле "Текст" обязятельно для заполнения!',
				'short_description.max' => 'Поле "Краткий текст" не должно быть более ' . $strLimit . ' символов!',

			];

		}


		public function edit( $id )
		{
			$data = Category::where( 'id', $id )->first();

			$data->table = 'yamz_categories';
			$data->act   = 'update';

			return view( 'admin.category.form', [ 'data' => $data ] );

		}


		public function clear( $id )
		{
			Product::where( 'yamz_category_id', $id )->delete();

			return redirect()->back()->with( [ 'ok' => 'Данные удалены.' ] );

		}

		public function update( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name' => [
					'required',

					'max:255',
				],

				'alias' => [
					'required',

					'max:255',
				],


			], $this->messages() );


			/* если есть ошибки - сообщаем об этом */
			if( $v->fails() ){
				return redirect( 'admin/category/' . $request->id . '/edit' )
					->withErrors( $v )
					->withInput();
			}

			$category         = Category::find( $request->id );
			$category->name   = $request->name;
			$category->alias  = $request->alias;
			$category->text   = $request->description;
			$category->public = isset( $request->public ) ? $request->public : 0;
			$category->anons  = isset( $request->anons ) ? $request->anons : 0;
			$category->hit    = isset( $request->hit ) ? $request->hit : 0;


			$category->metatag_title       = $request->metatag_title;
			$category->metatag_description = $request->metatag_description;
			$category->metatag_keywords    = $request->metatag_keywords;
			$category->save();

			\Session::flash( 'message', 'Запись обновлена!' );


			/*	if( $direct == 'back' ){
					return redirect( url( '/admin/categories' ) );
				}*/


			return redirect( '/admin/category/' . $request->id . '/edit' );


		}


	}
