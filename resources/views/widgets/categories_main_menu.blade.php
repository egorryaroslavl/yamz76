@if(count($data)>0)
	<ul class="dropdown-menu drop-menu-1" id="panels">
			@foreach($data as $item)
			<?php $active = strpos($_SERVER['REQUEST_URI'],$item->alias)> 0 ? ' class="active"' :'' ?>
				<li>
			<a href="/category/{{$item->alias}}"{!! $active !!}>{{$item->name}}</a>

				</li>
			@endforeach
		</ul>
@endif

