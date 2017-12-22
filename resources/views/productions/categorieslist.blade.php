@extends('layouts.admin.index')
@section('content')
	{{--  page header  --}}
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Категории </h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong>Продукция</strong>
				</li>
			</ol>
		</div>
	</div>
	
	{{--  page header  --}}
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox">
					<h5>Категории продукции</h5>
					<div class="ibox-content">
	 
						@include('admin.common.table')
 
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection