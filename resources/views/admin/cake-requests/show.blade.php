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
                        <div class="col-lg-4">
                            @if(strlen($cakeRequest->cake_image) > 32)
                                <img id="cake_image_preview" src="{{$cakeRequest->cake_image}}" alt="{{$cakeRequest->cake_image}}" class="img-thumbnail" />
                            @else
                                <img id="cake_image_preview" src="/assets/admin/img/no-image.jpg" alt="{{$cakeRequest->cake_image}}" class="img-thumbnail" />
                            @endif
                        </div>
                        <div class="col-lg-8">
                            <div class="col-lg-6">
                                <b>Data da Entrega:</b><br/>
                                {{$cakeRequest->getDeliveryTimestamp()}}<br/><br/>
                                <b>Cliente:</b><br/>
                                {{$cakeRequest->client_name}}<br/><br/>
                                <b>Telefone:</b><br/>
                                {{$cakeRequest->client_phone}}<br/><br/>
                                <b>Celular:</b><br/>
                                {{$cakeRequest->client_mobile}}<br/><br/>
                            </div>
                            <div class="col-lg-6">
                                <b>Status:</b><br/>
                                <span class="label label-{{$cakeRequest->getClassByStatus()}}">{{$cakeRequest->getStatusName()}}</span><br/><br/>
                                <b>Preço Estimado:</b><br/>
                                {{$cakeRequest->getEstimatedPrice()}}<br/><br/>
                                <b>Valor do Pagamento:</b><br/>
                                {{$cakeRequest->getPaymentValue()}}<br/><br/>
                            </div>
                            <div class="col-lg-12">
                                <b>Anotações:</b><br/>
                                {{$cakeRequest->note}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection