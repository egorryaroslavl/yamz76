@extends('layouts.admin.index')
@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Генератор Метатэгов</h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong><a href="#">Генератор Метатэгов</a></strong>
				</li>
			</ol>
		</div>
	</div>
	{{--  page header  --}}
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row border4 mb-10 p10 block-wrap">
			<h2>Метатэги</h2>{{--
			<h5>Выберите категорию к которой вы планируете привязать текст</h5>--}}
			{{--@include('admin.common.categories_select')--}}
			<hr>

			{{--			{{ Widget::PartsBlock('title', 'title') }}
						{{ Widget::PartsBlock('description', 'description') }}
						{{ Widget::PartsBlock('keywords', 'keywords') }}--}}
			<div class="col-md-4">
				<label>TITLE
					<small style="margin-left: 20px;color: #7f7f7f;font-weight: normal">Добавить якорь:</small>
					<div class="smallBtn" data-input_id="title_button" data-anchor="[PRODUCT_NAME]"
					     title="[PRODUCT_NAME]"></div>
					<div class="smallBtn" data-input_id="title_button" data-anchor="[PRODUCT_ARTICUL]"
					     title="[PRODUCT_ARTICUL]"></div>
					<div class="smallBtn" data-input_id="title_button" data-anchor="[ADDRESS]" title="[ADDRESS]"></div>
					<div class="smallBtn" data-input_id="title_button" data-anchor="[PHONE]" title="[PHONE]"></div>
					<div class="smallBtn" data-input_id="title_button" data-anchor="[EMAIL]" title="[EMAIL]"></div>
				</label>
				<div class="input-group mb-5">
					<input
						type="text"
						name="title"
						class="form-control mb-5"
						id="title_button"
						value="{{$data->title or ''}}"
						placeholder="TITLE">
					<span class="input-group-btn">
        <button
	        class="btn btn-default metatag title_button"
	        id="title_button"
	        data-metatag="title"
	        type="button">OK</button>
      </span>
				</div><!-- /input-group -->
				<div id="parttitle_select"></div>
			</div>
			<div class="col-md-4">
				<label>DESCRIPTION
					<small style="margin-left: 20px;color: #7f7f7f;font-weight: normal">Добавить якорь:</small>
					<div class="smallBtn" data-input_id="description_button" data-anchor="[PRODUCT_NAME]"
					     title="[PRODUCT_NAME]"></div>
					<div class="smallBtn" data-input_id="description_button" data-anchor="[PRODUCT_ARTICUL]"
					     title="[PRODUCT_ARTICUL]"></div>
					<div class="smallBtn" data-input_id="description_button" data-anchor="[ADDRESS]"
					     title="[ADDRESS]"></div>
					<div class="smallBtn" data-input_id="description_button" data-anchor="[PHONE]"
					     title="[PHONE]"></div>
					<div class="smallBtn" data-input_id="description_button" data-anchor="[EMAIL]"
					     title="[EMAIL]"></div>
				</label>
				<div class="input-group mb-5">
					<input
						type="text"
						name="description"
						class="form-control mb-5"
						id="description_button"
						value="{{$data->description or ''}}"
						placeholder=" DESCRIPTION">
					<span class="input-group-btn">
        <button
	        class="btn btn-default metatag description_button"
	        id="description_button"
	        data-metatag="description"
	        type="button">OK</button>
      </span>
				</div><!-- /input-group -->
				<div id="partdescription_select"></div>
			</div>
			<div class="col-md-4">
				<label>KEYWORDS
					<small style="margin-left: 20px;color: #7f7f7f;font-weight: normal">Добавить якорь:</small>
					<div class="smallBtn" data-input_id="keywords_button" data-anchor="[PRODUCT_NAME]"
					     title="[PRODUCT_NAME]"></div>
					<div class="smallBtn" data-input_id="keywords_button" data-anchor="[PRODUCT_ARTICUL]"
					     title="[PRODUCT_ARTICUL]"></div>
					<div class="smallBtn" data-input_id="keywords_button" data-anchor="[ADDRESS]"
					     title="[ADDRESS]"></div>
					<div class="smallBtn" data-input_id="keywords_button" data-anchor="[PHONE]" title="[PHONE]"></div>
					<div class="smallBtn" data-input_id="keywords_button" data-anchor="[EMAIL]" title="[EMAIL]"></div>
				</label>
				<div class="input-group mb-5">
					<input
						type="text"
						name="keywords"
						class="form-control mb-5"
						id="keywords_button"
						value="{{$data->keywords or ''}}"
						placeholder="KEYWORDS">
					<span class="input-group-btn">
        <button
	        class="btn btn-default metatag part_button"
	        id="keywords"
	        data-metatag="keywords"
	        type="button">OK</button>
      </span>
				</div><!-- /input-group -->
				<div id="partkeywords_select"></div>
			</div>


			<hr style="display: block;clear:both;margin:30px 0">
			<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
		</div>
		{{--@include('admin.text_generator.sentences_html_list')--}}
	</div>
	</div>
@endsection