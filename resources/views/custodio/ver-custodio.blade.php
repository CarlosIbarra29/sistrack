@extends('layouts.app')
@push('scripts')
    {{-- <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script> --}}
@endpush
@section('title')
    Información custodio
@endsection
@section('content')




<div class="container-fluid main-dark-container">

    
    <div class="card custom-card-dark mb-6">
        <div class="card-body d-flex justify-content-between align-items-center py-4 px-5">
            <div>
                <h2 class="main-title-gold mb-0">Ver custodio</h2>
                <span class="text-muted" style="font-size: 0.85rem;">Información detallada del custodio</span>
            </div>
            <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-outline-dark-gold px-4">
                <i class="flaticon2-back mr-1"></i> Regresar
            </a>
        </div>
    </div>

    <div class="row">

        
        <div class="col-lg-3 mb-4">
            
            <div class="card profile-card-premium text-center d-flex flex-column justify-content-center pb-5">
                
                
                <div class="profile-cover-banner"></div>
                
                
                <div class="card-body p-0 px-4">
                    
                    
                    <div class="avatar-view-container-premium">
                        @if( $custodio->fotografia_custodio == "" || $custodio->fotografia_custodio == null)
                            <img src="/img/no_disponible.png" class="avatar-view-img-premium">
                        @else
                            <img src="{{ route('archivo.fotografiaCustodio', ['id'=>$custodio->id]) }}" class="avatar-view-img-premium">
                        @endif
                    </div>

                    
                    <div class="profile-content-text flex-grow-1 d-flex flex-column justify-content-center">
                        
                        <h5 class="profile-name-premium mb-3 mt-4">
                            {{ $custodio->nombre_custodio }}
                        </h5>

                       
                        <div class="mb-5">
                            <span class="badge-status-active-premium">
                                Activo
                            </span>
                        </div>

                        
                        <div class="px-0">
                            <a href="{{ route('custodio.fichatecnica', $custodio->id) }}" class="btn btn-premium-action btn-block">
                                <i class="flaticon2-poll-symbol mr-2"></i> Ficha técnica
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="col-lg-9 mb-4">
            <div class="card custom-card-dark mb-4">
                <div class="custom-card-header-dark">
                    <h5 class="font-weight-bold text-white mb-0">Información General</h5>
                </div>

                <div class="card-body px-5 py-5">
                    
                   
                    <div class="row mb-5">
                        <div class="col-md-6 mb-4">
                            <div class="info-grid-item">
                                <i class="fa fa-envelope info-grid-icon"></i>
                                <div>
                                    <span class="text-label-muted">Correo electrónico</span>
                                    <span class="info-value-text">{{ $custodio->correo_electronico }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="info-grid-item">
                                <i class="fa fa-phone info-grid-icon"></i>
                                <div>
                                    <span class="text-label-muted">Teléfono</span>
                                    <span class="info-value-text">{{ $custodio->numero_telefono }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="info-grid-item">
                                <i class="fa fa-map-marker-alt info-grid-icon"></i>
                                <div>
                                    <span class="text-label-muted">Base</span>
                                    <span class="info-value-text">{{ $custodio->base }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="info-grid-item">
                                <i class="fa fa-id-card info-grid-icon"></i>
                                <div>
                                    <span class="text-label-muted">CURP</span>
                                    <span class="info-value-text">{{ $custodio->curp }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="info-grid-item">
                                <i class="fa fa-file-invoice info-grid-icon"></i>
                                <div>
                                    <span class="text-label-muted">RFC</span>
                                    <span class="info-value-text">{{ $custodio->rfc }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="border-top: 1px solid #1f242c;" class="my-5">

                   
                    <div class="row mb-5">
                        <div class="col-lg-6 mb-3">
                            <label class="text-label-muted mb-2">Correo ASSISTCARGO</label>
                            <input type="email" class="form-control dark-form-control" name="correo_assistcargo" id="correo_assistcargo" placeholder="No registrado" readonly/>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <label class="text-label-muted mb-2">Contraseña ASSISTCARGO</label>
                            <input type="password" class="form-control dark-form-control" name="contraseña_assistcargo" id="contraseña_assistcargo" placeholder="••••••••" readonly/>
                        </div>
                    </div>

                    <hr style="border-top: 1px solid #1f242c;" class="my-5">

                    
                    <div class="row mb-5">
                        <div class="col-lg-6 mb-4">
                            <label class="text-gold-label d-block mb-3">Identificación</label>
                            <div class="premium-switch-container">
                                <label class="premium-switch">
                                    <input type="checkbox" name="identificacion" value="0" checked disabled>
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="text-gold-label d-block mb-3">Contrato</label>
                            <div class="premium-switch-container">
                                <label class="premium-switch">
                                    <input type="checkbox" name="contrato" value="1" checked disabled>
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <label class="text-gold-label d-block mb-3">GPS Fijo</label>
                            <div class="premium-switch-container">
                                <label class="premium-switch">
                                    <input type="checkbox" name="tipo_gps" value="0" checked disabled>
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label class="text-gold-label d-block mb-3">Candado</label>
                            <div class="premium-switch-container">
                                <label class="premium-switch">
                                    <input type="checkbox" name="candado_servicio" value="1" checked disabled>
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label class="text-gold-label d-block mb-3">Uniforme / Chaleco</label>
                            <div class="premium-switch-container">
                                <label class="premium-switch">
                                    <input type="checkbox" name="chaleco_servicio" value="2" disabled>
                                    <span class="slider-switch"></span>
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>


@if($custodio->op_vehiculo == 2)
<div class="container-fluid mt-3 main-dark-container">
    <div class="card custom-card-dark">
        <div class="custom-card-header-dark">
            <h5 class="font-weight-bold text-white mb-0">Vehículo asignado</h5>
        </div>

        <div class="card-body px-5 py-5">
            <div class="row">

                <div class="col-lg-4 mb-4">
                    <ul class="spec-sheet-list">
                        <li class="spec-sheet-item">
                            <span class="spec-label">Vehículo</span>
                            <span class="spec-value">{{ $vehiculo->vehiculo }}</span>
                        </li>
                        <li class="spec-sheet-item">
                            <span class="spec-label">Marca</span>
                            <span class="spec-value">{{ $vehiculo->marca }}</span>
                        </li>
                        <li class="spec-sheet-item">
                            <span class="spec-label">No. serie</span>
                            <span class="spec-value">{{ $vehiculo->no_serie }}</span>
                        </li>
                        <li class="spec-sheet-item">
                            <span class="spec-label">Placa</span>
                            <span class="spec-value">{{ $vehiculo->placa }}</span>
                        </li>
                        <li class="spec-sheet-item">
                            <span class="spec-label">Color</span>
                            <span class="spec-value">{{ $vehiculo->color }}</span>
                        </li>
                        <li class="spec-sheet-item">
                            <span class="spec-label">GPS</span>
                            <span class="spec-value">{{ $vehiculo->no_gps }}</span>
                        </li>
                        <li class="spec-sheet-item" style="flex-direction: column; align-items: flex-start; gap: 4px;">
                            <span class="spec-label">Observaciones</span>
                            <span class="spec-value" style="text-align: left; font-size: 0.85rem; color: #a0aec0; font-weight: normal;">{{ $vehiculo->observaciones }}</span>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-8">
                    <div id="carouselExampleControls" class="carousel slide shadow-lg" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($fotografias as $documento)
                            <div class="carousel-item {{($ver == $documento->id) ? 'active' : ''}}">
                                <img class="d-block w-100 rounded"
                                     style="height:400px; object-fit:cover; border: 1px solid #1f242c;"
                                     src="{{ route('archivo.fotografiavehiculo', ['id'=>$documento->id]) }}">
                            </div>
                            @endforeach
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </a>

                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endif

@endsection