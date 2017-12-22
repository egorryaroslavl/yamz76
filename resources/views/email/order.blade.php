<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml>
    <head>
        <meta http-equiv=" Content-Type" content="text/html; charset=utf-8" />
<title>Заявка c сайта</title>
</head>
<body>
<table border="0" class="header" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <h1>ООО «ЯрТрансАвто»</h1>
        </td>
    </tr>
</table>
<table class="contact">
    <tbody>
    <tr>
        <td width="33%">
            Адрес:<br>
            150510, г. Ярославль,
            п. Кузнечиха, ул. Индустриальная, д. 7
        </td>
        <td width="33%">
            Email: info@yamz76.ru<br>
            Тел: (4852) 67-22-32,<br>
            67-22-31, 67-22-30
        </td>
        <td width="33%">
            Часы работы:<br>
            Пн - Пт: 9:00 - 17:00<br>
            Сб - Вс: выходной
        </td>
    </tr>
    </tbody>
</table>
<table align="left" border="0" class="content" cellpadding="0" cellspacing="0">
    <tr>
        <td style="text-align: center;font-size: 24px">
            ﻿Заявка #{{date('d.m.Y').'-'. $ordernum }}
        </td>
    </tr>
    <tr>
        <td style="padding: 0 10px;text-align: center">
            {{date('d.m.Y H:i')}}
        </td>
    </tr>
</table>
<table class="user-data">
    <tbody>
    <tr>
        <td class="td-title">
            Компания:
        </td>
        <td class="td-cont">
            {{$companyname}}
        </td>
    </tr>
    <tr>
        <td class="td-title">
            Имя:
        </td>
        <td class="td-cont">
            {{$username}}
        </td>
    </tr>
    <tr>
        <td class="td-title">
            Телефон:
        </td>
        <td class="td-cont">
            {{$userphone}}
        </td>
    </tr>
    <tr>
        <td class="td-title">
            Email:
        </td>
        <td class="td-cont">
            {{$useremail}}
        </td>
    </tr>
    @if(!empty($usercomment))
        <tr>
            <td class="td-title">
                Сообщение:
            </td>
            <td class="td-cont">
                {{  $usercomment  }}
            </td>
        </tr>
    @endif
    </tbody>
</table>
<table class="product-list" cellpadding="0" cellspacing="0">
    <thead>
    <tr style="font-size: 12px">
        <th>№</th>
        <th>Название</th>
        <th>Цена руб.</th>
        <th>Кол-<br>во</th>
        <th>Сумма</th>
    </tr>
    </thead>
    <tbody>
    <?php $sum = 0; ?>
    @for ($i = 0,$n = 1; $i < count($data); $i++,$n++)
        <?php

        if( !isset( $data[ $i ][ 'count' ] ) || empty( $data[ $i ][ 'count' ] ) ){
            $count = 1;
        } else{
            $count = $data[ $i ][ 'count' ];
        }

        $summ = str_replace( [ ' ', ',' ], [ '', '.' ], $data[ $i ][ 'price' ] ) * $count; //стоимость позиции

        $summRow = number_format( $summ, 2, ',', ' ' ) . 'руб.';
        $priceRow = number_format( $data[ $i ][ 'price' ], 2, ',', ' ' ) . 'руб.';

        /* Узнаем артикул продукта */

        $articul = \App\Model\Product::where( 'id', $data[ $i ][ 'product_id' ] )->first()->articul;
        if( !empty( $articul ) ){
            $articul = ' артикул-' . $articul;
        }
        ?>
        <tr class="active" id="row{{$data[$i]['product_id']}}">
            <td style="width: 30px">
                {{$n}}
            </td>
            <td>
                {{$data[$i]['product_name']}}{{$articul}}
            </td>
            <td>
                {{$priceRow}}
            </td>
            <td>
                {{$count}}
            </td>
            <td class="summ" id="summ{{$data[$i]['product_id']}}"
                style="text-align:center">
                {{$summRow}}
            </td>
        </tr>
        <?php $sum = $sum + $summ; ?>
    @endfor
    </tbody>
</table>
<table class="table table-bordered" id="fixed">
    <tbody>
    <tr>
        <td class="summ-text" style="text-align: right;font-size:24px">
            Сумма:
        </td>
        <td class="total" style="font-size:24px">{{number_format($sum, 2, ',', ' ')}}руб.</td>
    </tr>
    </tbody>
</table>
</div>
</body>
</html>