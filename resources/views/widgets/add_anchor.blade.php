<label>{{strtoupper($position)}} {{--@if($position=='c')--}}
	<small style="margin-left: 20px;color: #7f7f7f;font-weight: normal">Добавить якорь: </small>
	<div class="smallBtn" data-input_id="part{{$position}}" data-anchor="[PRODUCT_NAME]" title="[PRODUCT_NAME]"></div>
	<div class="smallBtn" data-input_id="part{{$position}}" data-anchor="[PRODUCT_ARTICUL]" TITLE="[PRODUCT_ARTICUL]"></div>
	<div class="smallBtn" data-input_id="part{{$position}}" data-anchor="[ADDRESS]" title="[ADDRESS]"></div>
	<div class="smallBtn" data-input_id="part{{$position}}" data-anchor="[PHONE]" TITLE="[PHONE]"></div>
	<div class="smallBtn" data-input_id="part{{$position}}" data-anchor="[EMAIL]" TITLE="[EMAIL]"></div>
	{{--@endif--}}</label>