@if(count($data)>0)
	<aside class="services-sidebar">
		<select name="yamz_categories" class="form-control col-md-2 chosen-select" id="yamz_categories">
			<option value="0"> -= Выбрать =-</option>
				@foreach($data as $item)
				
				<optgroup label="{{$item->name}}">
					<option value="{{$item->id}}">{{$item->name}}</option>
				 	@if(count( $subCats = \App\Model\YamzCategory::get_children($item->alias)) > 0 )
					 
							@foreach($subCats as $item_)
							<option value="{{$item_->id}}"> {{$item->name}}  &rarr; {{$item_->name}}</option>
							@endforeach
					 
					@endif
				</optgroup>
			@endforeach
		</select>
	</aside>
@endif