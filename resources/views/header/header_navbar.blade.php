<?php
$ac = ' class="active"';
function ac( $thisUrl, $more = false )
{

    $add = $more ? ' ' . $more : '';

    if( $thisUrl == $_SERVER[ "REQUEST_URI" ] ) echo ' class="active' . $add . '"';

    $explRes = explode( "/", $_SERVER[ "REQUEST_URI" ] );
    $u       = $explRes[ 1 ];
    if( preg_match( "/$u/i", $thisUrl ) && $_SERVER[ "REQUEST_URI" ] !== "/" ){
        echo ' class="active' . $add . '"';
    }

}

$data = \App\Model\YamzCategory::where( 'parent_id', null )->get();

$Count = count( $data );

$catList = '';



if( $Count > 0 ){
    $catList = '<span class="dropdown-toggle dropdown-toggle--navbar" data-toggle="dropdown" role="button"
              aria-expanded="false"></span>
        <ul class="dropdown-menu dropdown-menu--navbar">';
    foreach( $data as $item ){
        $catList .= '<li><a href="/category/' . $item->alias . '">' . $item->name . '</a></li>';
    }
    $catList .= '</ul>';

}


/* Services */


$data1 = \App\Model\Service::where( 'public', 1 )->orderBy( 'pos' )->get();
$Count1 = count( $data1 );

$servList = '';

if( $Count1 > 0 ){
    $servList = '<span class="dropdown-toggle dropdown-toggle--navbar" data-toggle="dropdown" role="button" aria-expanded="false"></span>
        <ul class="dropdown-menu dropdown-menu--navbar">';
    foreach( $data1 as $item1 ){
        $servList .= '<li><a href="/service/' . $item1->alias . '">' . $item1->name . '</a></li>';
    }
    $servList .= '</ul>';

}

$cl = $_SERVER[ "REQUEST_URI" ] == '/actions' ? ' class="active"' : '';
$actionItem = '';
$actionData = \App\Model\Action::where( 'public', 1 )->get();
if( count( $actionData ) > 0 ){
    $actionItem = '<li' . $cl . '><a href="/actions">Акции <sup class="badge" style="background: red;"><i class="fa fa-fire" aria-hidden="true" style="font-size: 10px;"></i></sup></a></li>';
}

?>
<ul class="nav nav--home-page" style="background:#22455E">
    <li<?php ac( '/' ) ?>><a href="/">Главная</a></li>
    <li<?php ac( '/categories', 'dropdown' ) ?><?php ac( '/category', 'dropdown' ) ?>>
        <a href="/categories">Каталог</a>
        {!! $catList !!}
    </li>
    <li<?php ac( '/services', 'dropdown' ) ?>>
        <a href="/services">Услуги</a>
        {!! $servList !!}
    </li>
    <li<?php ac( '/about' ) ?>><a href="/about">О нас</a></li>
    {!! $actionItem !!}
    <li<?php ac( '/articles', 'dropdown' ) ?>>
        <a href="/articles">Статьи</a></li>
    <li<?php ac( '/contacts' ) ?>><a href="/contacts">Контакты</a></li>
</ul>