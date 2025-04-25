@if($g_setting->google_analytic_status == 'Show')
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $g_setting->google_analytic_tracking_id }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-84213520-6');
</script>
@endif


@if($g_setting->cookie_consent_status == 'Show')
<script>
    window.addEventListener("load", function(){
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#000"
                },
                "button": {
                    "background": "#f1d600"
                }
            },
            "position": "bottom-left"
        })});
</script>
@endif

<!-- All JS -->
<script src="{{ asset('storage/frontend/js/cookieconsent.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/wow.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/jquery.meanmenu.js') }}"></script>
<script src="{{ asset('storage/frontend/js/waypoints.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/select2.full.js') }}"></script>
<script src="{{ asset('storage/frontend/js/toastr.min.js') }}"></script>
<script src="{{ asset('storage/frontend/js/bootstrap-select.js') }}"></script>
<script src="{{ asset('storage/frontend/js/theia-sticky-sidebar.js') }}"></script>
<script src="{{ asset('storage/frontend/js/ResizeSensor.js') }}"></script>

<script src="{{ asset('storage/backend/js/echarts.min.js') }}"></script>