<!DOCTYPE html>
<html>
@include('admin.inspinia.head.head')
<body>
<div id="wrapper">
	@include('admin.inspinia.navigation.mainmenu')
	<div id="page-wrapper" class="gray-bg">
		@include('admin.inspinia.navigation.navbar_top')
		@yield('content')
		@include('admin.inspinia.footer')
	</div>
</div>
<div id="placeModal"></div>
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
@include('admin.inspinia.scripts')
</body>
</html>
