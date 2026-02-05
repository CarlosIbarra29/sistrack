@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/programacion/EditarProgramacion.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Ver programación
@endsection

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h2 class="font-weight-bold mb-1">Ver programación</h2>
            <span class="text-danger font-weight-bold">
                Estatus: {{ $programacion->programacionEstatus->estatus_programacion }}
            </span>
        </div>

        <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-warning font-weight-bold">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </div>

    <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">

    <!-- CARD PRINCIPAL -->
    <div class="card card-custom shadow-sm">
        <div class="card-body">

            <!-- ================= DATOS GENERALES ================= -->

            <div class="row mb-6">
                <div class="col-lg-6">
                    <label class="text-muted">Cliente</label>
                    <div class="font-weight-bold">
                        @foreach($cliente as $tp)
                            @if($programacion->cliente_id == $tp->id)
                                {{ $tp->nombre_cliente }} / {{ $tp->razon_social }}
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6">
                    <label class="text-muted">Fecha y hora de servicio</label>
                    <div class="font-weight-bold">
                        {{ date('d/m/Y H:i:s', strtotime($programacion->fecha_servicio)) }}
                    </div>
                </div>
            </div>

            <div class="row mb-6">
                <div class="col-lg-6">
                    <label class="text-muted">Tipo de servicio</label>
                    <div class="font-weight-bold">
                        {{ $programacion->tipo_servicio == 0 ? 'Foráneo' : 'Local' }}
                    </div>
                </div>

                <div class="col-lg-6">
                    <label class="text-muted">Tarifario</label>
                    <div class="font-weight-bold">
                        @foreach($tarifario as $tp)
                            @if($programacion->tarifario_id == $tp->id)
                                Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- ================= RUTAS ================= -->

            <div class="card card-custom bg-light mb-8">
                <div class="card-header border-0">
                    <h4 class="card-title mb-0">Rutas del servicio</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="text-muted">Domicilio origen</label>
                            <div class="font-weight-bold">{{ $programacion->dom_origen }}</div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="text-muted">Domicilio destino</label>
                            <div class="font-weight-bold">{{ $programacion->dom_destino }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= CUSTODIO ================= -->

            <div class="row mb-6">
                <div class="col-lg-6">
                    <label class="text-muted">Custodio</label>
                    <div class="font-weight-bold">
                        @foreach($custodio as $tp)
                            @if($programacion->custodio_id == $tp->id)
                                {{ $tp->nombre_custodio }} {{ $tp->ap_paterno }} {{ $tp->ap_materno }}
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6">
                    <label class="text-muted">Acompañantes</label>
                    <div class="font-weight-bold">
                        {{ $programacion->acompanantes == 0 ? 'Sí' : 'No' }}
                    </div>
                </div>
            </div>

            <!-- ================= ACOMPAÑANTES ================= -->

            @if($programacion->acompanantes == 0)
            <div class="card card-custom bg-light mb-8">
                <div class="card-header border-0">
                    <h4 class="card-title mb-0">Acompañantes</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Custodio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($acompanantes_pro as $documento)
                                <tr>
                                    <td>
                                        {{ $documento->custodio->nombre_custodio }}
                                        {{ $documento->custodio->ap_paterno }}
                                        {{ $documento->custodio->ap_materno }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

            <!-- ================= OBSERVACIONES ================= -->

            <div class="card card-custom mb-8">
                <div class="card-header">
                    <h4 class="card-title mb-0">Observaciones</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-checkable">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Observación</th>
                                <th>Fecha y hora</th>
                                <th>Responsable</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($observaciones as $unid)
                                <tr>
                                    <td>{{ $unid->id }}</td>
                                    <td>{{ $unid->observacion }}</td>
                                    <td>{{ date('d/m/Y h:i A', strtotime($unid->created_at)) }}</td>
                                    <td>{{ $unid->userCreated->name }}</td>
                                    <td class="text-center">

                                        <button class="btn btn-sm btn-outline-success btn-icon"
                                            onclick="editpobservacion('{{ $unid->id }}','{{ $unid->observacion }}')"
                                            data-toggle="modal"
                                            data-target="#model_add_incidencia">
                                            <i class="flaticon-edit"></i>
                                        </button>

                                        <button class="btn btn-sm btn-outline-danger btn-icon eliminar-observacion"
                                            data-id="{{ $unid->id }}"
                                            data-nombre="{{ $unid->observacion }}">
                                            <i class="flaticon-delete"></i>
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ================= INCIDENCIAS ================= -->

            <div class="card card-custom mb-8">
                <div class="card-header">
                    <h4 class="card-title mb-0">Incidencias</h4>
                </div>

                <div class="card-body">
                    <table class="table table-hover table-checkable">
                        <thead class="thead-light">
                            <tr>
                                <th>No.</th>
                                <th>Incidencia</th>
                                <th>Fecha y hora</th>
                                <th>Responsable</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($incidencias as $unid)
                                <tr>
                                    <td>{{ $unid->id }}</td>
                                    <td>{{ $unid->incidencia }}</td>
                                    <td>{{ date('d/m/Y h:i A', strtotime($unid->created_at)) }}</td>
                                    <td>{{ $unid->userCreated->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- FOOTER -->
        <div class="card-footer text-right">
            <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-warning">
                Regresar
            </a>
        </div>

    </div>
</div>



@endsection
