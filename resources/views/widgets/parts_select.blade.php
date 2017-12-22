<div class="col-md-4">
	<label>{{strtoupper($position)}} @if($position=='c')
			<small style="margin-left: 20px;color: #7f7f7f;font-weight: normal">Добавить якорь: </small>
			<div class="smallBtn" data-anchor="[PRODUCT_NAME]" title="[PRODUCT_NAME]"></div>
			<div class="smallBtn" data-anchor="[PRODUCT_ARTICUL]" TITLE="[PRODUCT_ARTICUL]"></div>@endif</label>
	<div class="input-group mb-5">
		<input
			type="text"
			name="parta"
			class="form-control mb-5"
			id="part{{$position}}"
			value="{{ old('parta') }}"
			placeholder="Часть {{strtoupper($position)}}">
		<span class="input-group-btn">
        <button
	        class="btn btn-default part_button"
	        id="parta_button"
	        data-position="{{$position}}"
	        type="button">OK</button>
      </span>
	</div><!-- /input-group -->
	<div id="part{{$position}}_select"></div>
</div>