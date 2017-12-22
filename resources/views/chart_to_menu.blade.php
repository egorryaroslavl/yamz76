@if( count($data)> 0)
	<table class="table table-striped" id="draggable" style="font-size: 11px;margin-top: 40px">
		<tbody>
		<?php $sum = 0; ?>
		@for ($i = 0,$n = 1; $i < count($data); $i++,$n++)
			<?php

			if( !isset( $data[ $i ][ 'count' ] ) || empty( $data[ $i ][ 'count' ] ) ){
				$count = 1;
			} else{
				$count = $data[ $i ][ 'count' ];
			}

			$summ = str_replace( [ ' ', ',' ], [ '', '.' ], $data[ $i ][ 'price' ] ) * $count;
			?>
			<tr class="active" id="row{{$data[$i]['product_id']}}">
				<td style="width: 30px">
					{{$n}}
				</td>
				<td>
					{{$data[$i]['product_name']}}
				</td>
				<td>
					{{$data[$i]['price']}}
				</td>
				<td>
					<input
						type="number"
						value="{{$count}}"
						min="1"
						class="form-control product-count"
						data-id="{{$data[$i]['product_id']}}"
						data-price="{{str_replace([' ',','],['','.'],$data[$i]['price'])}}"
						id="count{{$data[$i]['product_id']}}"
						name="count"/>
				</td>
				<td class="summ" id="summ{{$data[$i]['product_id']}}" style="text-align:center">
					{{$summ}}
				</td>
				<td
					class="del-product-item"
					id="del{{$data[$i]['product_id']}}"
					data-id="{{$data[$i]['product_id']}}"
					style="text-align:center">
					<a href="#" onclick="return false"><i class="fa fa-times"></i></a>
				</td>
			</tr>
			<?php $sum = $sum + $summ; ?>
		@endfor
		</tbody>
	</table>
	<table class="table table-bordered">
		<tbody>
		<tr>
			<td style="text-align: right">
				Позиций:
			</td>
			<td  colspan="2" class="count"> {{count($data)}}</td>
		</tr>
		<tr>
			<td class="summ-text" style="text-align: right">
				Сумма:
			</td>
			<td class="total">{{$sum}}</td>
			<td class="un" style="text-align:left">руб.
			</td>
		</tr>
		<tr>
			<td>
				@if(count($data) > 0)
					{{--<button class="btn btn-primary btn-sm" onclick="yaCounter41168344.reachGoal ('otpravit-zakaz');  document.location.href='/order'">ОТПРАВИТЬ</button>--}}

				@endif
			</td>
			<td  colspan="2" style="text-align: right">
				@if(count($data) > 0)
				<button class="btn btn-primary" onclick="yaCounter41168344.reachGoal ('otpravit-zakaz');  document.location.href='/order'">ОТПРАВИТЬ</button>
					<br>
					<button class="btn btn-danger del-order"
					        title="Очистить и закрыть (Не рекомендуется!)"
					        style="float: right;margin: 10px 0;"> ОТМЕНИТЬ
					</button>
				@endif
			</td>
		</tr>
		</tbody>
	</table>
	<input type="hidden" name="total-count" id="total-count" value="{{count($data)}}" />
@endif