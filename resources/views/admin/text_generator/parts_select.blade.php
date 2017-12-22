<div class="input-group mb-5">
	<select class="form-control partsSelect position_{{$position}}" id="partsSelect{{$rand = rand(1111,9999)}}">
		<option  data-position="{{$position}}" value="0" id="opt{{ $item->id or "0" }}" > -= Выбрать =- </option>
		@if(count($data)>0)
			@foreach( $data as $item )
				<option data-position="{{$position}}" id="opt{{ $item->id }}" value="{{ $item->id }}"
				        @if(isset($part_id) && $part_id == $item->id)) selected @endif>{{ $item->part }}</option>
			@endforeach
		@endif
	</select>
	<span class="input-group-btn">
        <button
	        class="btn btn-default part_del_button"
	        data-part_id="{{$part_id}}"
	        data-position="{{$position}}"
	        data-parts-select-id="partsSelect{{$rand}}"
	        type="button"><i class="fa fa-trash"></i></button>
      </span>
</div><!-- /input-group -->



