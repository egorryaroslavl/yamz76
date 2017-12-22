<div style="width:100%;height:1px;margin: 0;">
	@if(isset($prev[0]))
		<div class="prev"><a href="/product/{{$prev[0]->alias}}-{{$prev[0]->id}}" title="{{$prev[0]->name}}{{ !empty($prev[0]->articul) ? ' ('. $prev[0]->articul .')' :''}}"><i class="fa fa-chevron-left"></i> </a></div>
		@else
		<div class="prev"><a href="#" style="opacity:.5;cursor: not-allowed"> <i class="fa fa-chevron-left"></i> </a></div>
	@endif
	@if(isset($next[0]))
		<div class="next"><a href="/product/{{$next[0]->alias}}-{{$next[0]->id}}" title="{{$next[0]->name}}{{ !empty($next[0]->articul) ? ' ('. $next[0]->articul .')' :''}}"> <i class="fa fa-chevron-right"></i> </a></div>
		@else
			<div class="next"><a href="#" style="opacity:.5;cursor: not-allowed"> <i class="fa fa-chevron-right"></i> </a></div>
	@endif
</div>
<style>
	.prev {
		float: left;
		vertical-align: middle;
		}

	.next {
		float: right;
		vertical-align: middle;
		}
</style>

