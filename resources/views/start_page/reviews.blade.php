<?php

$data = \App\Model\Review::where( 'public', 1 )->get();
if(count( $data ) > 0 ){
?>
<!-- "Reviews" section -->
<section id="reviews" class="section section--bottom-space-large">
    <div class="section__header">
        <div class="section__title">
            <div class="h1">Отзывы</div>
        </div>
        <div class="section__icon">
            <span class="fa fa-comments"></span>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div id="reviews-carousel" class="reviews-carousel owl-carousel owl-equal-height owl-dots-regular">

                @foreach($data as $item)

                <div id="review-1" class="review-item">
                    <div class="review-avatar">
                        <img src="{{$item->logo}}" alt=""/>
                    </div>
                    <blockquote class="review-quote">{!! $item->short_description !!}
                    </blockquote>
                    <footer class="review-footer">
                        <span class="review-author">{{$item->name}}</span>
                        <span><a href="/review/{{$item->alias}}" style="font-size: 12px;color:#666;">Подробней >></a> </span>
                    </footer>
                </div>

                @endforeach

            </div>
        </div>
    </div>
</section>
<?php
}