@extends('layouts.app')

@section('title')
    Catálogo de programación inactivas
@endsection

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=4.1.1') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacion.js') }}"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush


@section('content')
<div class="programacion-inactivas-page">
    <header class="programacion-inactivas-header">
        <div>
            <span class="programacion-inactivas-eyebrow">ADMINISTRACIÓN DE SERVICIOS</span>
            <h1>Programaciones inactivas</h1>
            <p>Consulta los servicios inactivos y reactiva una programación cuando corresponda.</p>
        </div>
        <a href="{{ route('programacion.listadoprogramacion') }}" class="programacion-inactivas-back">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </header>

    <section class="programacion-inactivas-panel">
        <div class="programacion-inactivas-panel-header">
            <div class="programacion-inactivas-heading">
                <span class="programacion-inactivas-heading-icon"><i class="flaticon2-file"></i></span>
                <div>
                    <span class="programacion-inactivas-eyebrow">HISTORIAL DE PROGRAMACIONES</span>
                    <h2>Inventario de programación inactivas <span class="programacion-inactivas-count">{{ $programacion->count() }}</span></h2>
                </div>
            </div>
            <span class="programacion-inactivas-legend"><i class="la la-info-circle"></i> Utiliza la acción para reactivar un servicio</span>
        </div>
        <div class="programacion-inactivas-table-wrap">
            <table class="table table-hover table-checkable inventory-table programacion-inactivas-table" id="kdatatable_programacion_inactivos">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Folio</th>
                        <th>Cliente</th>
                        <th>Domicilio origen</th>
                        <th>Domicilio destino</th>
                        <th>Fecha y Hora</th>
                        <th>Tipo de servicio</th>
                        <th>Estatus</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($programacion as $unid)
                        <tr>
                            <td><span class="programacion-inactivas-id">{{ $unid->id }}</span></td>
                            <td><strong class="programacion-inactivas-folio">{{ $unid->folio }}</strong></td>
                            <td><span class="programacion-inactivas-client">{{ $unid->nombre_cliente }}</span></td>
                            <td><span class="programacion-inactivas-route" title="{{ $unid->dom_origen }}">{{ $unid->dom_origen }}</span></td>
                            <td><span class="programacion-inactivas-route" title="{{ $unid->dom_destino }}">{{ $unid->dom_destino }}</span></td>
                            <td><span class="programacion-inactivas-date">{{ $unid->fecha_servicio }}</span></td>
                            <td>
                                @if($unid->tipo_servicio == 0)
                                    <span class="label font-weight-bold label-outline-danger label-inline programacion-inactivas-type programacion-inactivas-type--foraneo">Foraneo</span>
                                @else
                                    <span class="label font-weight-bold label-outline-warning label-inline programacion-inactivas-type programacion-inactivas-type--local">Local</span>
                                @endif
                            </td>
                            <td><span class="programacion-inactivas-status"><span class="programacion-inactivas-status-dot"></span>{{ $unid->estatus_programacion }}</span></td>
                            <td class="text-center">
                                <button class="btn btn-clean btn-icon btn-outline-warning mt-1 activar-programacion programacion-inactivas-activate" data-id="{{ $unid->id }}" data-nombre="{{ $unid->id }}" data-toggle="tooltip" data-theme="dark" title="Activar programación"><i class="flaticon2-reply"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No.</th><th>Folio</th><th>Cliente</th><th>Domicilio origen</th><th>Domicilio destino</th><th>Fecha y Hora</th><th>Tipo de servicio</th><th>Estatus</th><th class="text-center">Acciones</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
    </section>
</div>

<form method="post" id="programacion_act_form" action="{{ route('programacion.activarprogramacion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_delete" value="">
</form>
@endsection
