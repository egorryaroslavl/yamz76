@extends('layouts.admin.index')
@section('content')
	    @if(!empty($insert) )
		<div style="background:#fff;color:#000;padding: 5px 20px;">
			<textarea style="width:100%; height:600px" name="" id="">{!! $insert !!}</textarea>
		</div>
	@endif
	@if(!empty($update) )
		<div style="background:#fff;color:#000;padding:5px 20px;">{!! $update !!}</div>
	@endif
@endsection