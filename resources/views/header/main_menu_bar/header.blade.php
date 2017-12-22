<header id="main-header" class="main-header">
	<div class="container">
		<div class="row" style="margin-bottom:10px;">
			<div class="col-sm-4 col-xs-12 logo-padding">
				<div id="logo">
					<a href="/">{{--<img src="/images/logo7.png"
					                 title=""
					                 alt=""
					                 class="img-responsive hidden-xs hidden-sm hidden-phone"/>--}}
						<img src="/images/logo7_sm.png"
						     title=""
						     alt=""
						     class="img-responsive"/>
					</a>
					{{--<span style="padding-bottom:0;margin-bottom:0;padding-left: 60px"><a href="tel:74852672230" style="color: #203440 ;font-size:1.2rem;font-family:RalewayBold;">+7 (4852) 67-22-30</a></span>--}}
				</div>
			</div>
			<form name="searchForm" action="/search" method="post">
				<div class="col-sm-5 col-xs-12">
					<div id="search" class="input-group">
						<input
							type="text"
							name="search"
							id="main-search"
							value=""
							placeholder="Поиск по каталогу..."
							class="form-control input-lg"/>
						<input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
						<span class="input-group-btn">

    <button type="submit" class="btn btn-primary btn-lg search"
            onclick="document.getElementsByName('search')[0].submit();"><i class="fa fa-search"></i></button> 
  </span></div>
				</div>
			</form>
			<div class="col-sm-3 col-xs-12">
				@include('header.main_menu_bar.cart_')
			</div>
		</div>
	</div>
</header>