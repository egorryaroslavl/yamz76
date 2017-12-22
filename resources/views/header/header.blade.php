<header class="header" style="background:#22455E;box-shadow: 0px 6px 10px rgba(51, 51, 51, 0.50);border-bottom:1px rgba(255, 255, 255, 0.3) solid">
    <div class="header-bottom-decor"></div>
    <div class="container-fluid">
        <div class="header-row">
            <div class="header-logo-box">
                <a href="/">
                    <div class="header-logo" style="background:#00AFEA">
                        <img src="/gear/images/logo-header.png" alt=""/>
                    </div>
                </a>
            </div>
            <div class="header-navbar-box">
                <nav class="header-navbar navbar">
                    <div class="header-navbar-toggle-box">
                        <button class="header-navbar-toggle navbar-toggle collapsed" data-toggle="collapse"
                                data-target="#header-menu"  style="float: right">
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

                </div>
            </div>
            @include('header.header_bottom')
        </div> <!-- .header-row -->
    </div> <!-- .container -->
    @yield('breadcrumb')
</header>