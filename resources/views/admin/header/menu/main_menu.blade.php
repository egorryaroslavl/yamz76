<?php


    $menuHtml = '<li>Пусто...</li>';
    $items    = config( 'admin.menu' );
    $Count    = count( $items );


    if( $Count > 0 ){

        $menuHtml = '';

        for( $i = 0; $i < $Count; $i++ ){


            /* формируем список */

            $subItems = $items[ $i ][ 'pages' ];

            $subCount = count( $subItems );

            /* Если есть вложенное меню */

            if( $subCount > 0 ){

                /* формируем вложенное меню */

                $subMenu = '<ul class="treeview-menu">';
                for( $ii = 0; $ii < $subCount; $ii++ ){

                    $subMenu .= '
<li>
<a href="' . $subItems[ $ii ][ 'url' ] . '">' . $subItems[ $ii ][ 'title' ] . '</a>
</li>
';

                }


                $subMenu .= '</ul>';


                /* и основное */


                $menuHtml .= '
<li class="treeview">
        <a href="' . $items[ $i ] [ 'url' ] . '">
        <i class="' . $items[ $i ] [ 'icon' ] . '"></i> <span>' . $items[ $i ] [ 'title' ] . '</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        ' . $subMenu . '
    </li>
    ';


                /* иначе формируем простое меню */
            } else{


                $menuHtml .= '
            <li><a href="' . $items[ $i ] [ 'url' ] . '"><i class="' . $items[ $i ] [ 'icon' ] . '"></i> <span>' . $items[ $i ] [ 'title' ] . '</span></a></li>
            ';


            }


        }

    }


?>
<!-- Sidebar Menu -->
<ul class="sidebar-menu">
    <li class="header">МЕНЮ</li>
    {!! $menuHtml !!}
    <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
        </ul>
    </li>
</ul>
<!-- /.sidebar-menu -->
