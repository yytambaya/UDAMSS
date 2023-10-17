<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/js/loader.js') }}"></script>


<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
<link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@switch( $page_name )
    @case( 'announcements' )
        <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/animate/animate.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/editors/quill/quill.snow.css')}}" rel="stylesheet" type="text/css">
        @break
        
        @case( 'login' )
        <link href="{{ asset('assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/switches.css')}}">
        @break

    @case( 'project' )
        <link href="{{ asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/elements/miscellaneous.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" />
        
        <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/components/custom-countdown.css')}}" rel="stylesheet" type="text/css">
        <link href="{{ asset('plugins/table/datatable/datatables.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/table/datatable/dt-global_style.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
        @break

    @case( 'schedule' )
        <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/users/account-setting.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/dropify/dropify.min.css')}}" rel="stylesheet" type="text/css" />
        @break



@endswitch
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->