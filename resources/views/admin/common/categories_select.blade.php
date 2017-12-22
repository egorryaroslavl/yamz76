<?php
/*
 
	$data0 = [];
	$data1 = [];
	$aData = \DB::table( 'yamz_categories' )->get();


	foreach( $aData as $value0 ){

		if( $value0->parent_id === null ){


			$data0[ $value0->id ] = $value0->name;
		}
	}


	foreach( $aData as $value ){

		if( $value->parent_id !== null ){
			$parentName = \App\Model\YamzCategory::get_parent( $value->parent_id );

			$data1[ $value->id ] = $parentName . ' > ' . $value->name;
		}
	}

	$data = $data0 + $data1;


*/?>{!! Widget::CategoriesSelect() !!}
{{--
<select name="yamz_categories" class="form-control col-md-2 chosen-select" id="yamz_categories">
	<option value="0"> -= Выбрать =-</option>
	@if(count($data)>0)
		@foreach( $data as $key => $item )
			<option value="{{$key}}">{{$item}}</option>
		@endforeach
	@endif
</select>--}}
