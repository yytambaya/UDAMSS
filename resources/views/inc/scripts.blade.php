    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @switch( $page_name )
    
        @case( 'announcements' )
            <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
            <script src="{{ asset('assets/js/dashboard/dash_1.js') }}"></script>
            <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
            <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
            <script src="{{ asset('plugins/editors/quill/quill.js') }}"></script>
            <script src="{{ asset('plugins/editors/quill/custom-quill.js') }}"></script>
            @break

        @case( 'login' )
            <script src="{{ asset('assets/js/authentication/form-2.js') }}"></script>
            @break

    @endswitch
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
