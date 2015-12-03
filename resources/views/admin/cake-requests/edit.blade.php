@extends('layouts.admin_layout')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>#{{$cakeRequest->id}} - {{$cakeRequest->client_name}}</h5>
                    <div class="ibox-tools">
                        <a class="link" href="/admin/cake-requests/{{$cakeRequest->id}}/edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <form id="cake-request-form" action="/admin/cake-requests/{{$cakeRequest->id}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            @include('admin.cake-requests.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection