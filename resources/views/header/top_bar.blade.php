<div class="container-fluid">
	<div class="row" style="background: #203440">
		<div class="col-md-2">
		</div>
		<div class="col-md-6" style="padding: 8px 0">
			<form name="searchForm" action="/search" method="GET" class="form-inline" style="display: inline;float: right">
				<div class="form-group has-success has-feedback">
					<div class="input-group"
					     style="margin:0;margin-right:-7px; ">
						<input
							type="text"
							class="form-control"
							id="search"
							name="search"
							placeholder="Поиск"
							style="border-right:0">
					</div>
					<button
						type="submit"
						class="btn button--hover"
						style="margin-left: 0;border-left:0"><i class="fa fa-search"></i></button>
					<input type="hidden" value="{{csrf_token()}}" name="_token">
				</div>
			</form>
		</div>
		<div class="col-md-4" style="position: relative">
			<div class="shoping-cart-place"><i class="fa fa-cart-arrow-down" title="Ваш заказ"></i></div>
		</div>
	</div>
</div>