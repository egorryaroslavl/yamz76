<!DOCTYPE html>
<html>
@include('admin.inspinia.head.head')
<body>
<div id="wrapper">
    @include('admin.inspinia.navigation.mainmenu')
    <div id="page-wrapper" class="gray-bg">
        @include('admin.inspinia.navigation.navbar_top')
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                @yield('title')
                @yield('breadcrumb')
            </div>
            <div class="col-lg-2">
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>@yield('ibox_title') </h5>
                           <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.inspinia.footer')
    </div>
</div>
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
@include('admin.inspinia.scripts')
</body>
</html>
