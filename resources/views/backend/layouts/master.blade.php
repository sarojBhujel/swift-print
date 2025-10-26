<!DOCTYPE html>
<html lang="zxx">

@include('backend.layouts.header')

<body class="crm_body_bg">


    @include('backend.layouts.sidebar')

    <section class="main_content dashboard_part large_header_bg">

        @include('backend.layouts.notificationbar')

        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">

                @yield('main-content')
            </div>
        </div>

        {{-- <div class="footer_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer_iner text-center">
                            <p>2020 © Influence - Designed by <a href="#"> <i class="ti-heart"></i> </a><a href="#"> DashboardPack</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
    @stack('modal')

    @include('backend.layouts.footer')
</body>

<!-- Mirrored from demo.dashboardpack.com/analytic-html/dark_sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 31 Mar 2024 05:00:04 GMT -->

</html>
