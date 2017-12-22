@include('header.main_menu_bar.top_bar')
@include('header.main_menu_bar.header')
<div class="" id="main-menu" style="box-shadow: 0 3px 10px #000000;">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 hidden-xs all-category-left">
				<div class="dropdown">
					<button class="btn btn-primary dropdown-toggle drop-menu " type="button" data-toggle="dropdown" id="flip">Каталог  <i class="fa fa-bars" onclick="document.location.href='/categories'" title="Весь каталог"></i></button>
					@include('header.main_menu_bar.all_category')
				</div>
				<div class="left-category-1">
				</div>
			</div>
			<div class="col-md-9 col-sm-12 col-xs-12 toggle-menu">
				<div id="menus">
					<div class="">
						<div class="row">
							<div class="col-sm-12 col-xs-12 pad-lr">
								<nav id="menu" class="navbar mobile-margin">
									<div class="navbar-header"><span id="category" class="visible-xs">Каталог</span>
										<button type="button" class="btn btn-navbar navbar-toggle"
										        data-toggle="collapse" data-target=".navbar-ex1-collapse"><i
												class="fa fa-bars"></i></button>
									</div>
									<div class="collapse navbar-collapse navbar-ex1-collapse">
										@include('header.main_menu_bar.navbar')
									</div>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@if($_SERVER['REQUEST_URI'] =='/' || $_SERVER['REQUEST_URI'] =='')
	<header class="header header--home-page">
		@include('header.slider')
	</header>
@endif
