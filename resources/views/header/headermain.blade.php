<header class="header header--home-page">
    <div class="header-bottom-decor"></div>
    <!-- Header Slider -->
   @include('header.slider')

    <div class="container-fluid">
        <div class="header-row" style="background:#22455E;box-shadow: 0px 6px 10px rgba(51, 51, 51, 0.50);border-bottom:1px rgba(255, 255, 255, 0.3) solid">

            <div class="header-logo-box">
                <a href="/">
                    <div class="header-logo" style="background:#00AFEA">
                        <img src="/gear/images/logo-header.png" alt="" />
                    </div>
                </a>
            </div>

    <div>       <div class="header-navbar-box header-navbar-box--home-page">
                <nav class="header-navbar navbar">
                    <div class="header-navbar-toggle-box">
                        <button class="header-navbar-toggle navbar-toggle collapsed" data-toggle="collapse" data-target="#header-menu" style="float: right">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar top-bar"></span>
                            <span class="icon-bar middle-bar"></span>
                            <span class="icon-bar bottom-bar"></span>
                        </button>
                    </div>
                    <div id="header-menu" class="header-navbar-collapse collapse">
                       @include('header.header_navbar')
                    </div>
                </nav>
            </div>

        <div class="header-phone-box">
                <div class="header-phone header-phone--home-page">
                    <span style="color:#fff"  class="visible-xs-inline-block icon fa fa-phone-square"></span>
                    <span  style="color:#fff" class="hidden-xs icon ionicons ion-ios-telephone"></span>
                    <a href="tel:+7(4852)67-22-30" class="number" style="color:#fff">+7 (4852) 67-22-30, 8-800-200-09-24</a>
                    <span class="text" style="color:#fff">Горячая линия</span>
                </div>
            </div>
        </div>
            <div class="clearfix visible-md-block visible-lg-block"></div>

            @include('header.header_bottom')
        </div> <!-- .header-row -->
    </div> <!-- .container -->
</header>