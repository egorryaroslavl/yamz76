<?php
$data = \App\Model\Client::where( 'public', 1 )->get();
if( count( $data ) > 0 ){


?>
<div class="section-wrapper section-wrapper--partners">
    <section class="section">
        <header class="section__header">
            <div class="section__title">
                <h1>Наши клиенты</h1>
            </div>
            <div class="section__icon">
                <span class="fa fa-briefcase"></span>
            </div>
        </header>

        <div class="container">
            <div class="partners partners-carousel owl-carousel">
                @foreach($data as $item)
                    <div class="partner-logo " style="background-image: url('{{$item->logo}}')"></div>
                @endforeach
            </div>
        </div>
</div>
</section>
</div>
<style>
    .partner-logo {
        height:              60px;
        width:               120px;
        background-repeat:   no-repeat;
        background-position: 50% 50%;
        background-size:     contain;
        border: 1px #ccc solid;
        }
</style>
<?php
}