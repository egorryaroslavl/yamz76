@extends('layouts.admin.form')
@section('content')
	@if (Session::has('message'))
		<div class="alert alert-info">{!! Session::get('message') !!}   </div>
	@if(Session::get('flash_message') ) <div class="alert alert-danger">{!! Session::get('flash_message') !!}   </div>  @endif
	@endif
	{{ Form::open( [ 'action' =>'CategoryController@'. $data->act,'enctype'=>'multipart/form-data' ] ) }}
	<?php if( isset( $data->id ) ){ ?> {{ Form::hidden('id',$data->id )}} <?php } ?>
	<input type="hidden" name="icon" id="icon" value="{{$data->icon}}"/>
	<div class="tabs-container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#tab-1" onclick="return false">Основные данные</a>
			</li>
			<li class=""><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
		</ul>
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active">
				<div class="panel-body">
					@if( count($errors->all()) > 0 )
						@foreach ($errors->all() as $error)
							<div class="alert alert-danger">Ошибка! {{ $error }}</div>
						@endforeach
					@endif
						<div class="row">
					 
							<div class="col-xs-12">
								<div class="row">
									<div class="col-xs-6">
										<label for="name">Имя* <small>( max 255 символов )</small></label>
										<input
											type="text"
											name="name"
											class="form-control"
											id="name"
											value="{{$data->name}}"
											placeholder="Имя">
									</div>
									<div class="col-xs-6">
										<label for="alias">Алиас* <small>( max 255 символов )</small></label>
										<input
											type="text"
											name="alias"
											class="form-control"
											id="alias"
											value="{{$data->alias}}"
											placeholder="Алиас">
									</div>
							 
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									{{Form::label('description','Описание')}}
									{{Form::textarea('description',$data->text,['class'=>'form-control','id'=>'description' ])}}
						 
								</div>
							</div>
						</div>
					<div class="hr-line-dashed"></div>
 
					@include('admin.common.public_anons_hit')
					<div class="hr-line-dashed"></div>
				</div>
			</div>
			<div id="tab-2" class="tab-pane">
				<div class="panel-body">
					@include('admin.common.metatag_title_metatag_description_metatag_keywords')
				</div>
			</div>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	<div class="row">
		<div class="col-xs-6">
			{!! Form::submit('Готово!',['class'=>'btn btn-primary','style'=>'padding:3px  50px;font-size:1.5rem']) !!}
			{!! Form::close() !!}
		</div>
	</div>
@endsection
@section('breadcrumb')
	@if(isset($data->id))
		<ol class="breadcrumb">
			<li>
				<a href="/admin">Главная</a>
			</li>
			
			<li>
				<strong>Категория [ <a
						href="/admin/category/{{$data->id}}/productions">{{$data->name}}</a>
				        ]</strong>
			</li>
			
			<li>
				<strong> Продукция</strong>
			</li>
			<li>
				<strong>{{$data->name}} </strong>
			</li>
		
		</ol>
	@endif
	<style>
		label {
			margin-top: 15px;
			}
		
		.nav-tabs li a {
			/* font-size: 18px !important;*/
			font-weight: bold !important;
			color:       rgba(64, 80, 187, 0.7) !important;
			}
	</style>
@endsection

