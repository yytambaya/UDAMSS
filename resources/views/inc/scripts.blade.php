    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{asset('assets/js/custom.js')}}"></script>

    <script src="{{asset('plugins/notification/snackbar/snackbar.min.js')}}"></script>
    <script src="{{asset('assets/js/components/notification/custom-snackbar.js')}}"></script>

    @if(Session::has('login'))
    <script>
        Snackbar.show({
            text: "{{Session::get('login')}}",
            actionTextColor: '#fff',
            backgroundColor: '#8dbf42',
            pos: 'top-right',
            duration: 2000,
        });
    </script>
    @endif

    @if(Session::has('success'))
    <script>
        Snackbar.show({
            text: "{{Session::get('success')}}",
            actionTextColor: '#fff',
            backgroundColor: '#8dbf42',
            pos: 'top-center'
        });
    </script>
    @endif

    @if(Session::has('warning'))
    <script>
        Snackbar.show({
            text: "{{Session::get('warning')}}",
            actionTextColor: '#fff',
            backgroundColor: '#e2a03f',
            pos: 'top-center'
        });
    </script>
    @endif

    @if(Session::has('error'))
    <script>
        Snackbar.show({
            text: "{{Session::get('error')}}",
            actionTextColor: '#fff',
            backgroundColor: '#e7515a',
            pos: 'top-center'
        });
    </script>
    @endif
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @switch( $page_name )
    
        @case( 'announcements' )
            <script src="{{asset('plugins/apex/apexcharts.min.js')}}"></script>
            <script src="{{asset('assets/js/dashboard/dash_1.js')}}"></script>
            <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
            <script src="{{asset('plugins/highlight/highlight.pack.js')}}"></script>
            <script src="{{asset('plugins/editors/quill/quill.js')}}"></script>
            <script src="{{asset('plugins/editors/quill/custom-quill.js')}}"></script>
            @break

        @case( 'login' )
            <script src="{{asset('assets/js/authentication/form-2.js')}}"></script>
            @break

        @case( 'schedule' )
            <script src="{{asset('plugins/dropify/dropify.min.js')}}"></script>
            <script src="{{asset('plugins/blockui/jquery.blockUI.min.js')}}"></script>
            @break

        @case( 'project' )
            <script src="{{asset('assets/js/scrollspyNav.js')}}"></script>
            <script src="{{asset('plugins/table/datatable/datatables.js')}}"></script>
            <script src="{{asset('plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
            <script src="{{asset('assets/js/components/custom-countdown.js')}}"></script>
            <script src="{{asset('plugins/countdown/jquery.countdown.min.js')}}"></script>
            <script>
                $('#zero-config').DataTable({
                    "oLanguage": {
                        "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                        "sInfo": "Showing page _PAGE_ of _PAGES_",
                        "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                        "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                    },
                    "stripeClasses": [],
                    "lengthMenu": [7, 10, 20, 50],
                    "pageLength": 7 
                });
            </script>
            <script>
                $('#current_supervisory_group_id').on('change', function(){
                    sgid = $(this).val();
                    fetch(sgid);
                });

                function fetch(sgid){
                    $('#reassign_student_id').html('');
                    $('#new_supervisory_group_id').html('');
                    $.ajax({
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'post',
                        url: "{{route('getreassign.supervisee')}}",
                        data: {current_supervisory_group_id: sgid},
                        success: function(data){
                            $('#new_supervisory_group_id').html(data[0]);
                            $('#reassign_student_id').html(data[1]);
                        }
                    })
                }
            </script>
            <script>
                $('#selected_supervisory_group_id').on('change', function(){
                    sgid = $(this).val();
                    fetchSupervisees(sgid);
                });

                function fetchSupervisees(sgid){
                    $('#reassign_student_id').html('');
                    $.ajax({
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'post',
                        url: "{{route('getsupervisorsupervisees.coordination.project')}}",
                        data: {current_supervisory_group_id: sgid},
                        success: function(data){
                            $('#supervisor_supervisees').html(data);
                        }
                    })
                }
            </script>
            @break

    @endswitch
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
