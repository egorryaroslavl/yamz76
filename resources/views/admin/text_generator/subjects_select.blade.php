<div class="input-group mb-5">
	<select class="form-control subjectsSelect" id="subjectsSelect{{$rand = rand(1111,9999)}}">
		<option value="0"> -= Выбрать =- </option>
		@if(count($data)>0)
			@foreach( $data as $item )
				<option id="opt_{{ $item->id }}"  value="{{ $item->id }}">
				        {{ $item->name }}</option>
			@endforeach
		@endif
	</select>
	<span class="input-group-btn">
        <button
	        class="btn btn-default subject_del_button"
	        data-subjects-select-id="subjectsSelect{{$rand}}"
	        type="button"><i class="fa fa-trash"></i></button>
      </span>
</div><!-- /input-group -->



