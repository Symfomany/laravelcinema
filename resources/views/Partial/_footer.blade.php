
</div>
<!-- End: Main -->

<!-- BEGIN: PAGE SCRIPTS -->

@section('js')

    <script src="{{ asset('vendor/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/utility/utility.js') }}"></script>
    <script src="{{ asset('assets/js/demo/demo.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            "use strict";
            Core.init();
        });
    </script>

@show


</body>

</html>
