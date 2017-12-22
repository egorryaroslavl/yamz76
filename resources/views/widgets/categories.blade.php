@if(count($data)>0)
		{!! Widget::SearchBox() !!}
		<aside class="services-sidebar">
			<ul class="services-menu">
				@foreach($data as $item)
					<?php $active = strpos( $_SERVER[ 'REQUEST_URI' ], $item->alias ) > 0 ? ' class="active"' : '' ?><li><div class="h4"><a href="/category/{{$item->alias}}"{!! $active !!}>{{$item->name}}</a></div>@if(count( $subCats = \App\Model\YamzCategory::get_children($item->alias)) > 0 )<ul class="services-submenu">@foreach($subCats as $item_)<li><a href="/category/{{$item_->alias}}">{{$item_->name}}</a></li>@endforeach</ul>@endif</li>@endforeach</ul></aside> @endif

