<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/loader.js') }}"></script>


<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@switch( $page_name )
    @case( 'annoucements' )
        <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/editors/quill/quill.snow.css')}}" rel="stylesheet" type="text/css">
        @break



@endswitch
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->