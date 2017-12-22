@if( count($data)> 0)
<div class="container-fluid chart-body" @if(isset($state)&&$state =='hide') style="display:none;" @endif>
    <div class="row">
        <div class="col-md-12">
            <div class="row" style="margin: 0">
                <button
                        type="button"
                        class="close close-chart"
                        style="margin-top: -20px"
                        data-dismiss="alert"
                        title="Свернуть (данные не пропадут)"
                        aria-hidden="true"><i class="fa fa-chevron-down"
                                              style="font-size: inherit;font-weight: normal"></i>
                </button>
            </div>


            <h3 class="text-left text-primary" style="margin-top: 0">
                Ваш заказ@if(count($data) == 0) пуст... @endif
            </h3>
            <div class="product-list">

                <table class="table table-bordered">
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

            </div>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>
                        @if(count($data) > 0)
                            <button class="btn btn-primary btn-sm"  onclick="document.location.href='/order'">ОТПРАВИТЬ</button>
                            <button class="btn btn-danger btn-sm del-order"
                                    style="margin-left: 6px"
                                    title="Очистить и закрыть (Не рекомендуется!)">ОТМЕНИТЬ
                            </button>
                        @endif
                    </td>
                    <td class="summ-text" style="text-align: right">
                        СУММА:
                    </td>
                    <td class="total">{{$sum}}</td>
                    <td class="un" style="text-align:left">руб.
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>@endif