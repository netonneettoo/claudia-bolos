@extends('layouts.admin_layout')

@section('styles')
    <link href="/assets/admin/css/plugins/fullcalendar/fullcalendar.css" rel="stylesheet">
    <link href="/assets/admin/css/plugins/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pedidos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Full Calendar -->
    <script src="/assets/admin/js/plugins/fullcalendar/moment.min.js"></script>
    <script src="/assets/admin/js/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="/assets/admin/js/plugins/fullcalendar/lang-all.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                timezone: 'America/Fortaleza',
                lang: 'pt-br',
                editable: true,
                events: '/api/cake-requests'
            });
        });
    </script>
@endsection