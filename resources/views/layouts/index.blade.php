<!DOCTYPE html>
<html lang="en">
@include('head.head')
<body class="home-page">
@if($_SERVER['REQUEST_URI'] =='/')
	{{--@include('header.headermain')--}}
	@include('header.main_menu_bar.main_header')
@else
	{{--@include('header.header')--}}
	@include('header.main_menu_bar.main_header')
@endif
<main>
	@yield('content')
</main>
@include('footer.footer')
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
@include('scripts')
<?php if(  Request::has( 'chart' )  ){
$data = Request::get( 'chart', 'empty' );
?>
{{--<div class="shoping-cart-place"><i class="fa fa-shopping-basket" title="Ваш заказ"></i></div>--}}
<?php } ?>
</body>
</html>


