@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.2.5') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('js/programacion/EditarProgramacionNew.js?v=1.0.4') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Editar Programación
@endsection

@section('content')
<div class="dashboard-dark programacion-page programacion-edit-page">

    <header class="programacion-page-header programacion-edit-header">

        <div class="programacion-edit-header-main">
            <span class="programacion-edit-header-icon">
                <i class="la la-edit"></i>
            </span>

            <div class="programacion-edit-header-copy">
                <span class="programacion-eyebrow">
                    PROGRAMACIÓN
                </span>

                <h2 class="programacion-page-title">
                    Editar Programación
                </h2>

                <p class="programacion-page-subtitle">
                    Actualiza los datos operativos del servicio.
                    Estatus actual:
                    <strong>
                        {{ $programacion->programacionEstatus->estatus_programacion }}
                    </strong>
                </p>
            </div>
        </div>

        <div class="programacion-header-actions">
            <a href="{{ route('programacion.listadoprogramacion') }}"
               class="programacion-edit-back">
                <i class="flaticon2-back"></i>
                <span>Regresar</span>

            </a>
        </div>

    </header>

    <section class="panel-dark programacion-form-panel">
        <div class="programacion-card-header">
            <div>
                <span class="programacion-eyebrow">SERVICIO {{ $programacion->folio }}</span>
                <h6>DATOS DE LA PROGRAMACIÓN</h6>
            </div>
        </div>

        <form action="{{ route('programacion.modificarprogramacion') }}"
              method="post"
              id="submit_programacion"
              enctype="multipart/form-data"
              class="programacion-form">

            @csrf

            <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
            <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">
            <!-- <input type="hidden" id="tipoArchivo" value="{{ e($cadenaTipoDocumento) }}">-->
             <script type="application/json" id="tipoArchivo">@json($cadenaTipoDocumento)</script>

            <div class="programacion-form-grid">

                {{-- 01 CLIENTE --}}
                <section class="form-row-section form-row-section--origen">
                    <div class="section-meta">
                        <span class="section-number">01</span>
                        <div>
                            <h3>Cliente</h3>
                            <p>Cliente solicitante, horario y variables del servicio.</p>
                        </div>
                    </div>

                    <div class="section-controls">
                        <div class="programacion-field-grid programacion-field-grid--origin">

                            <div class="form-group programacion-field-client">
                                <label class="app-label">Razón Social *</label>
                                <select class="form-control app-input" id="cliente_id" name="cliente_id" required>
                                    @foreach($cliente as $cli)
                                        <option value="{{ $cli->id }}" @selected((int)$programacion->cliente_id === (int)$cli->id)>
                                            {{ $cli->nombre_cliente }} / {{ $cli->razon_social }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group programacion-field-date">
                                <label class="app-label">Fecha y hora de servicio *</label>
                                <input type="datetime-local"
                                       class="form-control app-input"
                                       name="fecha_hora"
                                       id="fecha_hora"
                                       value="{{ \Carbon\Carbon::parse($programacion->fecha_servicio)->format('Y-m-d\\TH:i') }}"
                                       required>
                            </div>

                            <div class="form-group programacion-field-folio">
                                <label class="app-label">
                                    Folio <span class="programacion-label-optional">Cliente</span>
                                </label>
                                <input type="text"
                                       class="form-control app-input"
                                       name="folio_interno"
                                       id="folio_interno"
                                       value="{{ $programacion->folio_interno }}"
                                       placeholder="Folio proporcionado por el cliente"
                                       autocomplete="off">
                            </div>

                            <div class="form-group programacion-choice-block">
                                <label class="app-label">Tipo de servicio *</label>
                                <div class="compact-radio-group">
                                    <label class="compact-radio-item">
                                        <input type="radio" name="tipo_servicio" value="0"
                                               {{ (int)$programacion->tipo_servicio === 0 ? 'checked' : '' }} required>
                                        <span><i class="la la-road"></i> Foráneo</span>
                                    </label>
                                    <label class="compact-radio-item">
                                        <input type="radio" name="tipo_servicio" value="1"
                                               {{ (int)$programacion->tipo_servicio === 1 ? 'checked' : '' }}>
                                        <span><i class="la la-map-marker"></i> Local</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group programacion-choice-block">
                                <label class="app-label">Armado *</label>
                                <div class="compact-radio-group">
                                    <label class="compact-radio-item">
                                        <input type="radio" name="armado_servicio" value="1"
                                               {{ (int)$programacion->armado_servicio === 1 ? 'checked' : '' }} required>
                                        <span><i class="la la-check"></i> Sí</span>
                                    </label>
                                    <label class="compact-radio-item">
                                        <input type="radio" name="armado_servicio" value="2"
                                               {{ (int)$programacion->armado_servicio === 2 ? 'checked' : '' }}>
                                        <span><i class="la la-times"></i> No</span>
                                    </label>
                                </div>
                            </div>

                            {{-- <!-- PREPARADO PARA FUTURO: TARIFARIO -->

                                <!-- <div class="form-group">
                                    <label class="font-weight-bold">Tarifario</label>
                                    <select class="form-control form-control-lg" name="id_tarifa" required>
                                        @foreach($tarifario as $tp)
                                            <option value="{{ $tp->id }}" @selected($programacion->tarifario_id == $tp->id)>
                                                Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> -->
                            --}}
                            

                        </div>
                    </div>
                </section>

                {{-- 02 RUTA --}}
                <section class="form-row-section form-row-section--rutas">
                    <div class="section-meta">
                        <span class="section-number">02</span>
                        <div>
                            <h3>Origen-Destino</h3>
                            <p>Puntos geográficos de partida y destino del servicio.</p>
                        </div>
                    </div>

                    <div class="section-controls">
                        <div class="programacion-field-grid">
                            <div class="form-group">
                                <label class="app-label">Domicilio origen *</label>
                                <input type="text" class="form-control app-input"
                                       name="dom_origen" value="{{ $programacion->dom_origen }}" required>
                            </div>
                            <div class="form-group">
                                <label class="app-label">Domicilio destino *</label>
                                <input type="text" class="form-control app-input"
                                       name="dom_destino" value="{{ $programacion->dom_destino }}" required>
                            </div>

                            <div class="form-group programacion-field-status">
                                
                                <label class="app-label">Estatus *</label>

                                <div class="programacion-status-select">

                                    <i class="la la-flag"></i>

                                    <select class="form-control app-input" id="programacion_id" name="programacion_id" required>

                                        @foreach($estatus_programacion_data as $estatus)

                                            <option value="{{ $estatus->id }}"
                                                @selected((int)$programacion->programacion_estatus_id === (int)$estatus->id)>
                                                {{ $estatus->estatus_programacion }}

                                            </option>

                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>

                {{-- 03 PERSONAL --}}
                <section class="form-row-section form-row-section--personal">
                    <div class="section-meta">
                        <span class="section-number">03</span>
                        <div>
                            <h3>Personal</h3>
                            <p>Custodio principal y acompañantes secundarios.</p>
                        </div>
                    </div>

                    <div class="section-controls">
                        <div class="programacion-field-grid programacion-field-grid--personal">

                            <div class="form-group programacion-field-custodio">
                                <label class="app-label">Custodio Principal *</label>
                                <select class="form-control app-input" id="custodio_id" name="custodio_id" required>
                                    <option value="153" @selected((int)$programacion->custodio_id === 153)>Sin custodio</option>
                                    <option value="154" @selected((int)$programacion->custodio_id === 154)>Custodio emergente</option>

                                    @foreach($custodio as $cli)
                                        @if((int)$cli->id !== 153 && (int)$cli->id !== 154)
                                            <option value="{{ $cli->id }}" @selected((int)$programacion->custodio_id === (int)$cli->id)>
                                                {{ $cli->nombre_custodio }} {{ $cli->ap_paterno }} {{ $cli->ap_materno }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group programacion-field-custodio-emergente"
                                 id="contenedor_custodio_emergente"
                                 style="display:none;">
                                <label class="app-label">Nombre completo del custodio emergente *</label>
                                <input type="text"
                                       class="form-control app-input"
                                       name="custodio_emergente"
                                       id="custodio_emergente"
                                       value="{{ $programacion->custodio_emergente }}"
                                       placeholder="Nombre completo del custodio emergente"
                                       maxlength="255">
                            </div>

                            <div class="form-group">
                                <label class="app-label">¿Lleva Acompañantes?</label>
                                <div class="compact-radio-group">
                                    <label class="compact-radio-item">
                                        <input type="radio" name="op_custodios" id="op_c_uno" value="0"
                                               {{ (int)$programacion->acompanantes === 0 ? 'checked' : '' }}>
                                        <span><i class="la la-user-plus"></i> Sí</span>
                                    </label>
                                    <label class="compact-radio-item">
                                        <input type="radio" name="op_custodios" id="op_c_dos" value="1"
                                               {{ (int)$programacion->acompanantes === 1 ? 'checked' : '' }}>
                                        <span><i class="la la-user"></i> No</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="div_custodios" class="programacion-extra-custodios">
                            <div class="programacion-extra-header">
                                <div class="programacion-extra-heading">
                                    <span class="programacion-extra-icon">
                                        <i class="la la-users"></i>
                                    </span>

                                    <div>
                                        <span class="programacion-extra-title">
                                            Acompañantes asignados
                                        </span>
                                        <small>
                                            Personal adicional para este servicio
                                        </small>
                                    </div>
                                </div>

                                <a href="#"
                                   class="hrefAgregarOtro programacion-add-extra">
                                    <i class="la la-plus"></i>
                                    <span>Agregar</span>
                                </a>
                            </div>

                            <div class="programacion-extra-table-wrapper">

                                <table class="programacion-extra-table"
                                       id="tblDocumentos">

                                    <tbody id="tbodyDocumentos">

                                        @foreach($acompanantes_pro as $documento)

                                            <tr id="trDocumento{{ $documento->id }}">

                                                <td>
                                                    <div class="programacion-extra-person">
                                                        <span class="programacion-extra-person-icon">
                                                            <i class="la la-user"></i>
                                                        </span>

                                                        <span class="programacion-extra-person-name">
                                                            {{ $documento->custodio->nombre_custodio }}
                                                            {{ $documento->custodio->ap_paterno }}
                                                            {{ $documento->custodio->ap_materno }}
                                                        </span>
                                                    </div>
                                                </td>

                                                <td class="programacion-extra-option">

                                                    <a href="#"
                                                       class="programacion-extra-delete hrefEliminarDocumento"
                                                       data-id="{{ $documento->id }}"
                                                       data-documento="{{ $documento->custodio->nombre_custodio }} {{ $documento->custodio->ap_paterno }}"
                                                       title="Eliminar acompañante">

                                                        <i class="la la-trash"></i>

                                                    </a>

                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>
                    </div>
                </section>
            </div>

            <div class="programacion-form-bottom">
                <section class="programacion-notes-block">
                    <div class="section-meta section-meta--inline">
                        <span class="section-number">04</span>
                        <div>
                            <h3>Notas</h3>
                            <p>Observaciones críticas u operacionales a considerar.</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <textarea class="form-control app-input programacion-notes"
                                  name="observaciones"
                                  id="observaciones"
                                  rows="3"
                                  placeholder="Escriba comentarios adicionales aquí...">{{ $programacion->observaciones }}</textarea>
                    </div>
                </section>

                <div class="panel-footer-actions">
                    <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-action-secondary">
                        <i class="la la-times"></i> Cancelar
                    </a>
                    <button type="button" id="btnGuardar" class="btn btn-action-primary">
                        <i class="la la-save"></i> Guardar Cambios
                    </button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
