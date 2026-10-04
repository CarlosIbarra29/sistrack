@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=3.1.3') }}"
          rel="stylesheet"
          type="text/css" />
@endpush

@push('scripts')
        <script src="{{ asset('js/programacion/EditarProgramacionNew.js?v=1.0.2') }}"></script>
@endpush

@section('title')
    Ver servicio
@endsection

@section('content')

<div class="detalle-servicio-page">

    {{-- =========================================================
        ENCABEZADO
    ========================================================== --}}
    <header class="detalle-servicio-header">

        <div class="detalle-servicio-heading">

            <span class="detalle-servicio-header-icon">
                <i class="la la-clipboard"></i>
            </span>

            <div>
                <span class="detalle-servicio-eyebrow">
                    PROGRAMACIÓN DE SERVICIOS
                </span>

                <h2>
                    Servicio solicitado
                </h2>

                <p>
                    {{-- Completa la información necesaria para solicitar un nuevo servicio de custodia. --}}
                </p>
            </div>

        </div>

        @if($data->programacion_id == null || $data->programacion_id == "" )

        @else
            @if($data->estatus == 0 && $role != 17)
                <button id="marcar_leido"
                   class="detalle-servicio-btn detalle-servicio-btn--secondary">

                    <i class="far fa-eye text-white"></i>
                    Marcar como "Solicitud Atendida" 

                </button>
            @endif
        @endif


        <a href="{{ route('procli.listaservicios') }}"
           class="detalle-servicio-btn detalle-servicio-btn--secondary">

            <i class="flaticon2-back"></i>
            Regresar

        </a>

        <form method="post" id="marcar_atendida" action="{{ route('procli.editaratendida') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id_servicio" value="{{ $data->id }}">
        </form>


    </header>


    {{-- =========================================================
        PANEL PRINCIPAL
    ========================================================== --}}
    <section class="detalle-servicio-panel">

        <div class="detalle-servicio-panel-header">

            <div class="detalle-servicio-panel-title">

                <span class="detalle-servicio-panel-icon">
                    <i class="la la-clipboard-list"></i>
                </span>

                <div>
                    <span class="detalle-servicio-eyebrow">
                        SOLICITUD
                    </span>

                    <h6>
                        INFORMACIÓN DEL SERVICIO
                    </h6>
                </div>

            </div>

        </div>

        <form action="{{ route('procli.guardarserviciocliente') }}"  method="post" id="submit_programacion" enctype="multipart/form-data">
            @csrf
            <div class="detalle-servicio-panel-body">


                <div class="row">
                    <div class="col-lg-9"></div>
                    <div class="col-lg-3">
                        Usuario: {{ $data->userCreated->name }}
                    </div>
                </div>

                {{-- =====================================================
                    ORIGEN / DESTINO
                ====================================================== --}}
                <div class="detalle-servicio-section">

                    <div class="detalle-servicio-section-grid">

                        {{-- ORIGEN --}}
                        <div class="detalle-servicio-location-block">

                            <div class="detalle-servicio-section-label">
                                UBICACIÓN / DIRECCIÓN ORIGEN
                            </div>

                            <div class="detalle-servicio-location-grid">

                                <div class="detalle-servicio-field">

                                    <label class="detalle-servicio-label">
                                        Ubicación
                                    </label>

                                    <div class="detalle-servicio-input-icon">
                                        <i class="la la-map-marker"></i>
                                        <span>{{ $data->ubicacion_origen }}</span>
                                    </div>

                                </div>


                                <div class="detalle-servicio-field">

                                    <label class="detalle-servicio-label">
                                        Dirección
                                    </label>
                                    <span>{{ $data->direccion_origen }}</span>

                                </div>

                            </div>

                        </div>


                        {{-- DESTINO --}}
                        <div class="detalle-servicio-location-block">

                            <div class="detalle-servicio-section-label">
                                UBICACIÓN / DIRECCIÓN DESTINO
                            </div>

                            <div class="detalle-servicio-location-grid">

                                <div class="detalle-servicio-field">

                                    <label class="detalle-servicio-label">
                                        Ubicación
                                    </label>

                                    <div class="detalle-servicio-input-icon">
                                        <span>{{ $data->ubicacion_destino }}</span>
                                    </div>

                                </div>


                                <div class="detalle-servicio-field">

                                    <label class="detalle-servicio-label">
                                        Dirección
                                    </label>
                                    <span>{{ $data->direccion_destino }}</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="detalle-servicio-divider"></div>


                {{-- =====================================================
                    FECHA / ARMADA
                ====================================================== --}}
                <div class="detalle-servicio-section">

                    <div class="detalle-servicio-main-grid">

                        {{-- FECHA Y HORA --}}
                        <div class="detalle-servicio-field">

                            <div class="detalle-servicio-section-label">
                                FECHA Y HORA DEL SERVICIO
                            </div>

                            <div class="detalle-servicio-input-icon">
                                <span>{{ $data->fechahora_servicio }}</span>

                            </div>

                        </div>


                        {{-- ARMADA --}}
                        <div class="detalle-servicio-field">

                            <div class="detalle-servicio-section-label">
                                ARMADA
                            </div>

                            <div class="detalle-servicio-choice-group">

                                <label class="detalle-servicio-choice">

                                    <input type="radio"
                                           name="armada"
                                           value="1" {{($data->armada == 1) ? 'checked' : ''}} disabled>

                                    <span>
                                        <i class="la la-check"></i>
                                        Sí
                                    </span>

                                </label>


                                <label class="detalle-servicio-choice">

                                    <input type="radio"
                                           name="armada"
                                           value="0" {{($data->armada == 0) ? 'checked' : ''}}  disabled>

                                    <span>
                                        <i class="la la-times"></i>
                                        No
                                    </span>

                                </label>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="detalle-servicio-divider"></div>


                {{-- =====================================================
                    TRANSPORTE / OPERADOR
                ====================================================== --}}
                <div class="detalle-servicio-section">

                    <div class="detalle-servicio-main-grid">

                        {{-- LÍNEA TRANSPORTE --}}
                        <div class="detalle-servicio-field">

                            <div class="detalle-servicio-section-label">
                                LÍNEA DE TRANSPORTE
                            </div>

                            <div class="detalle-servicio-input-icon">
                                <span>{{ $data->linea_transporte }}</span>
                            </div>

                        </div>


                        {{-- OPERADOR --}}
                        <div class="detalle-servicio-field">

                            <div class="detalle-servicio-section-label">
                                NOMBRE DEL OPERADOR
                            </div>

                            <div class="detalle-servicio-input-icon">
                                <span>{{ $data->nombre_operador }}</span>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="detalle-servicio-divider"></div>


                {{-- =====================================================
                    PLACAS / TELÉFONO
                ====================================================== --}}
                <div class="detalle-servicio-section">

                    <div class="detalle-servicio-main-grid">

                        {{-- PLACAS --}}
                        <div class="detalle-servicio-field">

                            <div class="detalle-servicio-section-label">
                                PLACAS
                            </div>

                            <div class="detalle-servicio-input-icon">
                                <span>{{ $data->placas }}</span>
                            </div>

                            <small class="detalle-servicio-help">
                                Ej. 12-AB-34 o 123-ABC
                            </small>

                        </div>


                        {{-- TELÉFONO --}}
                        <div class="detalle-servicio-field">

                            <div class="detalle-servicio-section-label">
                                NÚMERO TELEFÓNICO
                            </div>

                            <div class="detalle-servicio-input-icon">
                                <span>{{ $data->numero_telefono }}</span>
                            </div>

                            <small class="detalle-servicio-help">
                                Ej. 55 1234 5678
                            </small>

                        </div>

                    </div>

                </div>


                <div class="detalle-servicio-divider"></div>


                {{-- =====================================================
                    OBSERVACIONES
                ====================================================== --}}
                <div class="detalle-servicio-section">

                    <div class="detalle-servicio-field">

                        <div class="detalle-servicio-section-label">
                            OBSERVACIONES
                        </div>


                        <span>{{ $data->observaciones }}</span>
                    </div>

                </div>

            </div>
        
            {{-- end form --}}
            {{-- =========================================================
                FOOTER VISUAL
            ========================================================== --}}
            <footer class="detalle-servicio-footer">


            </footer>
        </form>
    </section>

    @if($data->programacion_id ==null || $data->programacion_id == "")
    @else
    <section class="panel-dark programacion-form-panel detalle-programacion-cliente mt-4">
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
                                     @foreach($cliente as $cli)
                                        @if($cli->id  == $programacion->cliente_id)
                                            <p>{{ $cli->nombre_cliente }} / {{ $cli->razon_social }}</p>
                                        @endif
                                    @endforeach
                            </div>

                            <div class="form-group programacion-field-date">
                                <label class="app-label">Fecha y hora de servicio</label>
                                <span>{{ \Carbon\Carbon::parse($programacion->fecha_servicio)->format('Y-m-d\\TH:i') }}</span>
                            </div>

                            <div class="form-group programacion-field-folio">
                                <label class="app-label">
                                    Folio <span class="programacion-label-optional">Cliente</span>
                                </label><br>
                                <span>{{ $programacion->folio_interno }}</span>
                            </div>

                            <div class="form-group programacion-choice-block">
                                <label class="app-label">Tipo de servicio *</label>
                                <div class="compact-radio-group">
                                    <label class="compact-radio-item">
                                        <input type="radio" name="tipo_servicio" value="0"
                                               {{ (int)$programacion->tipo_servicio === 0 ? 'checked' : '' }} required disable>
                                        <span><i class="la la-road"></i> Foráneo</span>
                                    </label>
                                    <label class="compact-radio-item">
                                        <input type="radio" name="tipo_servicio" value="1"
                                               {{ (int)$programacion->tipo_servicio === 1 ? 'checked' : '' }} disable>
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
                                <label class="app-label">Domicilio origen</label>
                                <span>{{ $programacion->dom_origen }}</span>
                            </div>
                            <div class="form-group">
                                <label class="app-label">Domicilio destino</label>
                                <span>{{ $programacion->dom_destino }}</span>
                            </div>

                            <div class="form-group programacion-field-status">
                                
                                <label class="app-label">Estatus *</label>

                                <div class="programacion-status-select">

                                    <i class="la la-flag"></i>

                                     @foreach($estatus_programacion_data as $estatus)
                                        @if($estatus->id  == $programacion->programacion_estatus_id)
                                            <p>{{ $estatus->estatus_programacion }}</p>
                                        @endif
                                    @endforeach

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
                        {{ $programacion->observaciones }}
                    </div>
                </section>

            </div>
        </form>
    </section>


    @endif


</div>

@endsection