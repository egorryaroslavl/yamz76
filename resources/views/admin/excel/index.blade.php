@extends('layouts.admin.index')
@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-12">
			<h2>Excel</h2>
			<ol class="breadcrumb">
				<li>
					<a href="/admin">Главная</a>
				</li>
				<li class="active">
					<strong><a href="/admin/excel">Excel</a></strong>
				</li>
			</ol>
		</div>
	</div>
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-12">
				<div class="ibox">
					<h5>Excel</h5>
					<div class="ibox-content"
					     style="border: 4px solid #a1a1a1;
					     margin-top: 15px;
					     padding: 10px;
					     display: block">
						<form
							action="{{ URL::to('/admin/excel/upload') }}"
							class="form-horizontal"
							method="post"
							enctype="multipart/form-data">
							<h3>Выберите категорию в которую планируете добавить позиции прайса</h3>
							@include('admin.common.categories_select')
							<hr style="height:10px">
							<input
								style="font-size:14px"
								type="file"
								onchange="tstFile(this)"
								id="fileName"
								name="file"
								class="btn btn-default"/><br>
							
							<input
								id="Reset"
								type="reset"
								style="display:none">
							@if( session('error'))
								<div class="alert alert-danger"
								     style="margin-top: 20px">
									<strong>{{session('error')}}</strong></div>
							@endif
							@if( session('ok'))
								<div class="alert alert-success"
								     style="margin-top: 20px;font-size: 24px">
									<strong>{!! session('ok') !!} </strong></div>
							@endif
							<div style="margin-bottom:20px;background-color:#f2f2f2;padding:20px">
								<h3>Выберите режим обновления</h3>
								<img src="/inspinia/img/crossData.svg">
								<table class="table table-condensed"
								       style="background-color: white">
									<tr>
										<td colspan="2" style="padding:10px 20px">
											<h4>Пересечение множеств БД и файла</h4>
											<p style="margin-bottom:25px;margin-top:-10px">
												<label for="public"
												       class="radio-inline i-checks">
													<input class="public"
													       id="public"
													       checked="checked"
													       name="public"
													       type="radio"
													       value="1"> <i></i> обновить </label>
											</p>
											
											<h4>Разность множеств в БД </h4>
											<p style="margin-bottom:25px;margin-top:-10px">
												<label for="RaznostMnozhestvDBLeave"
												       class="radio-inline i-checks">
													<input
														class="public"
														id="RaznostMnozhestvDBLeave"
														checked="checked"
														name="RaznostMnozhestvDB"
														type="radio"
														value="leave"> <i></i> оставить </label>
												<label for="RaznostMnozhestvDBDel"
												       class="radio-inline i-checks">
													<input
														class="public"
														id="RaznostMnozhestvDBDel"
														name="RaznostMnozhestvDB"
														type="radio"
														value="delete"> <i></i> удалить </label>
											</p>
											<h4>Разность множеств в файле</h4>
											<p style="margin-bottom:25px;margin-top:-10px">
												<label for="RaznostMnozhestvFayleInsert"
												       class="radio-inline i-checks">
													<input
														class="public"
														id="RaznostMnozhestvFayleInsert"
														checked="checked"
														name="RaznostMnozhestvFile"
														type="radio"
														value="insert"> <i></i> записать в БД </label>
												<label for="RaznostMnozhestvBDNotInsert"
												       class="radio-inline i-checks">
													<input
														class="public"
														id="RaznostMnozhestvBDNotInsert"
														name="RaznostMnozhestvFile"
														type="radio"
														value="not_insert"> <i></i> не записывать в БД </label>
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<input
												class="btn btn-warning"
												id="clearCategory"
												name="clearCategory"
												type="button"
												value="Очистить категорию"
												onclick="if($('#yamz_categories').val()!=='0'){$(this).next().slideToggle(600,function(){$('#clearLink').attr('href','/admin/category/'+$('#yamz_categories').val()+'/clear');$('.ct').html('[ <strong>'+$('#yamz_categories option:selected').text()+'</strong> ]')}) }else{  if( confirm('Вы не выбрали категорию.\nГрохнуть всю базу?') ){ $('body').html('<div class=\'middle-box text-center animated fadeInDown\'><h2>Сайт успешно удалён!</h2><h3 class=\'font-bold\'>База данных сайта очищена!</h3></div>')  }}">
											<div id="noteAbout"
											     style="display:none;"
											     class=" ">
												<p style="padding:10px 50px">Внимание! Все данные категории
													<span
														class="ct">[ Не выбрана категория ]</span> будут удалены!<br>После нажатия кнопки "Да, удалить!" отменить операцию будет невозможно!</span>
												</p>
												<h3 style="text-align: center">Итак!..<br>Последний раз спрашиваю: Удалить все данные из
													<span class="ct">[ Не выбрана категория ]</span>?
												</h3>
												<table style="width:100%">
													<tr>
														<td style="width:50%;padding: 10px">
															<button
																class="btn btn-primary btn-rounded btn-block btn-lg"
																
																type="button"
																onclick="$('#clearLink').attr('href','#');$('#noteAbout').slideToggle(600);$('.ct').html('[ Не выбрана категория ]');$('#yamz_categories').val('0')"
															><i class="fa fa-heart"></i> Нет, не
																удалять!
															</button>
														</td>
														<td style="width:50%;padding: 10px">
															<a id="clearLink"
															   class="btn btn-danger btn-rounded btn-block btn-lg dim"
															   href="#"><i class="fa fa-trash"></i> Да, удалить!</a>
														</td>
													</tr>
												</table>
											</div>
										</td>
									</tr>
								</table>
							</div>
							{{ csrf_field() }}
							<input
								type="submit"
								size="1"
								title="Загрузить"
								name="sendBtn"
								class="rightSubmit btn btn-lg btn-primary">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="placeModal"></div>
	<script type="text/javascript">
		var FLAG = true;

		function validate(){
			return FLAG;
		}

		function tstFile( val ){
			var v = val.value;
			var v = v.search( /^.*\.(?:csv)\s*$/ig )
			if( v != 0 ){
				alert( "Неправильный формат файла!" );
				$( '#Reset' ).click();
			}
		}
	</script>
@endsection