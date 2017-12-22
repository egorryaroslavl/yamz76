<?php

$data = \App\Model\Service::where( 'public', 1 )->get();
if(count( $data ) > 0){
?>
<section id="services" class="section section--bottom-space-large">
    <header class="section__header">
        <div class="section__title">
            <h1>Наши услуги</h1>
        </div>
        <div class="section__icon">
            <span class="fa fa-cogs"></span>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div id="services-carousel" class="services-carousel owl-carousel">
                @foreach($data as $item)
                    <?php
                    $icon = '/gear/images/logo-header.png';
                    if( !empty( $item->icon ) ){
                        $icon = $item->icon;
                    }
                    ?>
                    <a href="/services/{{$item->alias}}">
                        <div class="service-item">

                            <img class="service-item__image" src="{{$icon}}" alt=""/>
                            <div class="service-item__title">{{$item->name}}</div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="text-center">
                <a href="/services" class="btn button button--hover">Все услуги</a>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</section>
<?php } ?>