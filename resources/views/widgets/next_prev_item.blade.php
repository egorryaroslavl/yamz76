<div style="width:100%;height:20px;margin: 0;">
	@if(isset( $prev[0] ))
		<div class="prev"><a href="/article}/{{ $prev[0]->alias }}" title="{{$prev[0]->name}}"><i class="fa fa-chevron-left"></i> </a></div>
	@else
		<div class="prev"><a href="#" style="opacity:.5;cursor: not-allowed"> <i class="fa fa-chevron-left"></i> </a></div>
	@endif
	@if(isset($next[0]))
		<div class="next">
			<a href="/article/{{ $next[0]->alias }}" title="{{ $next[0]->name }}"> <i class="fa fa-chevron-right"></i> </a></div>
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

