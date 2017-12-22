<?php

	namespace App\Http\Controllers;

	use App\Model\Article;
	use Illuminate\Http\Request;
	use Illuminate\Pagination\Paginator;
	use App\Http\Requests;

	class ArticlesController extends Controller
	{

		public function index()
		{
			$data        = Article::where( 'public', 1 )->orderBy( 'pos' )->paginate( 10 );
			$defaultMeta = array(
				'title'       => 'Статьи',
				'description' => 'Статьи',
				'keywords'    => 'Статьи'
			);
			UtilsController::defaultMeta( $data, $defaultMeta );
			return view( 'articles' )->with( 'data', $data );
		}


		public function show( Request $request )
		{
			$data              = Article::where( 'alias', $request->alias )->where( 'public', 1 )->first();
			$data->defaultMeta = array(
				'title'       => $data->name,
				'description' => $data->name,
				'keywords'    => $data->name
			);

			return view( 'article' )->with( 'data', $data );

		}

	}
