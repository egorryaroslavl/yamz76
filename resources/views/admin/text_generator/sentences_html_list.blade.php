@for( $i=1;$i<=4;$i++ )
	<h3 style="border-bottom:1px #ccc solid;color:#0a568c;cursor: pointer"
	    onclick="$(this).next().slideToggle()">Предложение #{{$i}}</h3>
	<div class="row" style="display: none;">
		<div class="col-md-4">

			{{--		@if( $aCount = count($dataA = $data::partsA($i))  > 0 )
					   <h3>A</h3>
					   <ul class="list-unstyled">
						   @foreach($dataA as $item)
							   <li>{{$item->part}}</li>
						   @endforeach
					   </ul>
				   @endif--}}
		</div>

		<div class="col-md-4">
			{{--		@if( $aCount = count($dataB = $data::partsB($i))  > 0 )
					   <h3>B</h3>
					   <ul class="list-unstyled">
						   @foreach($dataB as $item)
							   <li>{{$item->part}}</li>
						   @endforeach
					   </ul>
				   @endif--}}
		</div>
		<div class="col-md-4">
			{{--	 	@if( $aCount = count($dataC = $data::partsC($i))  > 0 )
						<h3>C</h3>
						<ul class="list-unstyled">
							@foreach($dataC as $item)
								<li>{{$item->part}}</li>
							@endforeach
						</ul>
					@endif--}}
		</div>
	</div>
@endfor