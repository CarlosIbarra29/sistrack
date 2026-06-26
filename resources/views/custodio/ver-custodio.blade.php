@extends('layouts.app')
@push('scripts')
    {{-- <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script> --}}
@endpush
@section('title')
    Información custodio
@endsection
@section('content')

<div class="container-fluid">

    <!-- ENCABEZADO ESTILO PANEL -->
    <div class="card shadow-sm border-0 mb-6">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h2 class="font-weight-bold mb-0">
                    Ver custodio
                </h2>
                <span class="text-muted">
                    Información detallada del custodio
                </span>
            </div>

            <a href="{{ route('custodio.listadocustodio') }}"
               class="btn btn-outline-warning font-weight-bold">
                <i class="flaticon2-back"></i> Regresar
            </a>

        </div>
    </div>

    <div class="row">

        <!-- SIDEBAR PERFIL -->
        <div class="col-lg-3">

            <div class="card shadow border-0 mb-4 text-center">

                <div class="card-body">

                    @if( $custodio->fotografia_custodio == "" || $custodio->fotografia_custodio == null)
                        <img src="/img/no_disponible.png"
                             class="rounded-circle mb-3"
                             style="width:160px; height:160px; object-fit:cover;">
                    @else
                        <img src="{{ route('archivo.fotografiaCustodio', ['id'=>$custodio->id]) }}"
                             class="rounded-circle shadow mb-3"
                             style="width:160px; height:160px; object-fit:cover;">
                    @endif

                    <h5 class="font-weight-bold">
                        {{ $custodio->nombre_custodio }}
                    </h5>

                    <span class="badge badge-success px-4 py-2 mt-2">
                        Activo
                    </span>

                </div>

                <div class="card-footer bg-light">
                    <a href="{{ route('custodio.fichatecnica', $custodio->id) }}"
                       class="btn btn-outline-warning btn-block font-weight-bold">
                        <i class="flaticon2-poll-symbol"></i> Ficha técnica
                    </a>
                </div>

            </div>

        </div>

        <!-- CONTENIDO PRINCIPAL -->
        <div class="col-lg-9">

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="font-weight-bold mb-0">Información General</h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">Correo electrónico</small>
                            <span class="font-weight-bold font-size-lg">
                                {{ $custodio->correo_electronico }}
                            </span>
                        </div>

                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">Teléfono</small>
                            <span class="font-weight-bold font-size-lg">
                                {{ $custodio->numero_telefono }}
                            </span>
                        </div>

                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">Base</small>
                            <span class="font-weight-bold font-size-lg">
                                {{ $custodio->base }}
                            </span>
                        </div>

                        <div class="col-md-6 mb-4">
                            <small class="text-muted d-block">CURP</small>
                            <span class="font-weight-bold font-size-lg">
                                {{ $custodio->curp }}
                            </span>
                        </div>

                        <div class="col-md-12">
                            <small class="text-muted d-block">RFC</small>
                            <span class="font-weight-bold font-size-lg">
                                {{ $custodio->rfc }}
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                                    <div class="col-lg-6">
                                    <label>Correo ASSISTCARGO</label>
                                    <input type="email" class="form-control" name="correo_assistcargo" id="correo_assistcargo"/>
                                </div>

                                <div class="col-lg-6">
                                    <label>Contraseña ASSISTCARGO</label>
                                    <input type="password" class="form-control" name="contraseña_assistcargo" id="contraseña_assistcargo"/>
                                </div>
                            </div>
                </div>

                            <div class="form-group row">
                                      <div class="col-lg-5">
                                            <label class="font-weight-bold">Identificacion</label>
                                                 <div class="radio-inline mt-2">
                                                    <label class="radio">
                                                        <input type="radio" checked name="identificacion" value="0">
                                                        <span></span> Si
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="identificacion" value="1">
                                                        <span></span> No
                                                    </label>
                                                </div>
                                            </div>

                                        <div class="col-lg-5">
                                            <label class="font-weight-bold">Contrato</label>
                                            <div class="radio-inline mt-2">
                                                <label class="radio">
                                                    <input type="radio" checked name="contrato" value="1">
                                                    <span></span> Si
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="contrato" value="2">
                                                    <span></span>  No
                                                </label>
                                            </div>
                                        </div>
                                </div>




                            <div class="form-group row ">
                                      <div class="col-lg-4">
                                            <label class="font-weight-bold">Tipo de servicio</label>
                                                 <div class="radio-inline mt-2">
                                                    <label class="radio">
                                                        <input type="radio" checked name="tipo_gps" value="0">
                                                        <span></span> GPS Fijo
                                                    </label>
                                                    <label class="radio">
                                                        <input type="radio" name="tipo_gps" value="1">
                                                        <span></span> GPS Portatil
                                                    </label>
                                                </div>
                                            </div>

                                        <div class="col-lg-4">
                                            <label class="font-weight-bold">Candados</label>
                                            <div class="radio-inline mt-2">
                                                <label class="radio">
                                                    <input type="radio" checked name="candado_servicio" value="1">
                                                    <span></span> Si
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="candado_servicio" value="2">
                                                    <span></span>  No
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <label class="font-weight-bold">Chaleco antireflejantes</label>
                                            <div class="radio-inline mt-2">
                                                <label class="radio">
                                                    <input type="radio" checked name="chaleco_servicio" value="1">
                                                    <span></span> Si
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="chaleco_servicio" value="2">
                                                    <span></span> No
                                                </label>
                                            </div>
                                        </div>
                                </div>
            </div>

        </div>

    </div>

</div>

@if($custodio->op_vehiculo == 2)
<div class="container-fluid mt-3">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="font-weight-bold mb-0">Vehículo asignado</h5>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-lg-4">

                    <p><strong>Vehículo:</strong> {{ $vehiculo->vehiculo }}</p>
                    <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
                    <p><strong>No. serie:</strong> {{ $vehiculo->no_serie }}</p>
                    <p><strong>Placa:</strong> {{ $vehiculo->placa }}</p>
                    <p><strong>Color:</strong> {{ $vehiculo->color }}</p>
                    <p><strong>GPS:</strong> {{ $vehiculo->no_gps }}</p>
                    <p><strong>Observaciones:</strong> {{ $vehiculo->observaciones }}</p>

                </div>

                <div class="col-lg-8">
                    <div id="carouselExampleControls" class="carousel slide shadow-sm" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($fotografias as $documento)
                            <div class="carousel-item {{($ver == $documento->id) ? 'active' : ''}}">
                                <img class="d-block w-100 rounded"
                                     style="height:400px; object-fit:cover;"
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
