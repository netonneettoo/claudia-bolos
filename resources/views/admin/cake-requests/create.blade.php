@extends('layouts.admin_layout')

@section('styles')
    <link href="/assets/admin/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Novo pedido</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form id="cake-request-form" action="/admin/cake-requests" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('admin.cake-requests.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection