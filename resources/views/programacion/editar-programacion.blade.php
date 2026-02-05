@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/programacion/EditarProgramacion.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
Editar programación
@endsection

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-8">

    <div>
        <h2 class="font-weight-bold">Editar programación</h2>
    </div>

    <!-- Grupo derecho -->
    <div class="d-flex align-items-center">
        <span class="btn btn-light-danger mr-3">
            Estatus: {{ $programacion->programacionEstatus->estatus_programacion }}
        </span>
            <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-warning font-weight-bold"> <i class="flaticon2-back"></i> Regresar</a>
    </div>
</div>


    <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">
    <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>

    <form action="{{ route('programacion.modificarprogramacion') }}" method="POST" id="submit_programacion">
        @csrf
        <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">

        <div class="card card-custom shadow-sm">

            <!-- DATOS GENERALES -->
            <div class="card card-custom mb-8">
                <div class="card-header">
                    <h3 class="card-title">Datos generales</h3>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <span class="titulo-lb">Cliente</span>
                            <select class="form-control st-input" name="cliente_id" required>
                                @foreach($cliente as $tp)
                                    <option value="{{ $tp->id }}" @selected($programacion->cliente_id == $tp->id)>
                                        {{ $tp->nombre_cliente }} / {{ $tp->razon_social }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <span class="titulo-lb">Fecha y hora de servicio</span>
                            <input type="datetime-local" class="form-control st-input"
                                   name="fecha_hora"
                                   value="{{ $programacion->fecha_servicio }}" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-3">
                            <span class="titulo-lb">Tipo de servicio</span>
                            <div class="radio-inline mt-2">
                                <label class="radio mr-4">
                                    <input type="radio" name="tipo_servicio" value="0"
                                        {{ $programacion->tipo_servicio == 0 ? 'checked' : '' }}>
                                    <span></span> Foráneo
                                </label>

                                <label class="radio">
                                    <input type="radio" name="tipo_servicio" value="1"
                                        {{ $programacion->tipo_servicio == 1 ? 'checked' : '' }}>
                                    <span></span> Local
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <span class="titulo-lb">Monitoreo</span>
                            <div class="radio-inline mt-2">
                                <label class="radio mr-4">
                                    <input type="radio" name="op_monitoreo_id" value="1"
                                        {{ $programacion->op_monitoreo_id == 1 ? 'checked' : '' }}>
                                    <span></span> Monitoreo 1
                                </label>

                                <label class="radio">
                                    <input type="radio" name="op_monitoreo_id" value="2"
                                        {{ $programacion->op_monitoreo_id == 2 ? 'checked' : '' }}>
                                    <span></span> Monitoreo 2
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <span class="titulo-lb">Tarifario</span>
                            <select class="form-control st-input" name="id_tarifa" required>
                                @foreach($tarifario as $tp)
                                    <option value="{{ $tp->id }}" @selected($programacion->tarifario_id == $tp->id)>
                                        Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <!-- RUTAS -->
            <div class="card card-custom mb-8 bg-light">
                <div class="card-header border-0">
                    <h3 class="card-title">Rutas del servicio</h3>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <span class="titulo-lb">Domicilio origen</span>
                            <input type="text" class="form-control st-input"
                                   name="dom_origen" value="{{ $programacion->dom_origen }}" required>
                        </div>

                        <div class="col-lg-6">
                            <span class="titulo-lb">Domicilio destino</span>
                            <input type="text" class="form-control st-input"
                                   name="dom_destino" value="{{ $programacion->dom_destino }}" required>
                        </div>
                    </div>

                </div>
            </div>

            <!-- CUSTODIOS -->
            <div class="card card-custom mb-8">
                <div class="card-header">
                    <h3 class="card-title">Custodios</h3>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <span class="titulo-lb">Custodio principal</span>
                            <select class="form-control st-input" name="custodio_id" required>
                                @foreach($custodio as $tp)
                                    <option value="{{ $tp->id }}" @selected($programacion->custodio_id == $tp->id)>
                                        {{ $tp->nombre_custodio }} {{ $tp->ap_paterno }} {{ $tp->ap_materno }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <span class="titulo-lb">Acompañantes</span>
                            <div class="radio-inline mt-2">
                                <label class="radio mr-4">
                                    <input type="radio" name="op_custodios" value="0"
                                        {{ $programacion->acompanantes == 0 ? 'checked' : '' }}>
                                    <span></span> Sí
                                </label>

                                <label class="radio">
                                    <input type="radio" name="op_custodios" value="1"
                                        {{ $programacion->acompanantes == 1 ? 'checked' : '' }}>
                                    <span></span> No
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ACOMPAÑANTES -->
            <div class="card card-custom bg-light mb-8 {{ $programacion->acompanantes == 1 ? 'd-none' : '' }}" id="div_custodios">
                <div class="card-header border-0">
                    <h3 class="card-title">Acompañantes</h3>
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Custodio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDocumentos">
                            @foreach($acompanantes_pro as $documento)
                                <tr id="trDocumento{{ $documento->id }}">
                                    <td>
                                        {{ $documento->custodio->nombre_custodio }}
                                        {{ $documento->custodio->ap_paterno }}
                                        {{ $documento->custodio->ap_materno }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-danger hrefEliminarDocumento"
                                           data-id="{{ $documento->id }}">
                                            <i class="flaticon-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="p-4">
                        <a href="#" class="btn btn-sm btn-outline-warning hrefAgregarOtro">
                            <i class="flaticon2-plus"></i> Agregar acompañante
                        </a>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="card-footer text-right">
                <button type="button" id="btnGuardar" class="btn btn-warning mr-2">
                    <i class="flaticon2-check-mark"></i> Guardar
                </button>
                <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </div>
    </form>
</div>

@endsection
