@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.2') }}"
          rel="stylesheet"
          type="text/css" />
@endpush

@push('scripts')
    {{-- <script src="{{ asset('js/programacion/AgregarProgramacionCliente.js') }}"></script> --}}
    <script src="{{ asset('js/programacion/CatalogoProgramacion.js?v=1.3.8') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/programacion/Complementoprogramacion.js?v=1.1.2') }}"></script>
@endpush

@section('title')
    Ver servicio
@endsection

@section('content')

<div class="detalle-servicio-page">

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

        @if($data->estatus  == 0)
            <button id="marcar_leido"
               class="detalle-servicio-btn detalle-servicio-btn--secondary">

                <i class="far fa-eye text-white"></i>
                Marcar como "Solicitud Atendida" 

            </button>
        @endif

        <a href="{{ route('procli.listaservicios') }}"
           class="detalle-servicio-btn detalle-servicio-btn--secondary">

            <i class="flaticon2-back"></i>
            Regresar

        </a>

    </header>


    <section class="detalle-servicio-panel is-collapsed">

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

            <footer class="detalle-servicio-footer">


            </footer>

    </section>



    {{-- =========================================================
        PANEL PRINCIPAL
    ========================================================== --}}
    <section class="detalle-servicio-panel detalle-complemento-panel mt-4 ">

        <div class="detalle-servicio-panel-header">

            <div class="detalle-servicio-panel-title">

                <span class="detalle-servicio-panel-icon">
                    <i class="la la-clipboard-list"></i>
                </span>

                <div>
                    <span class="detalle-servicio-eyebrow">
                        CUSTODIO
                    </span>

                    <h6>
                        INFORMACIÓN DE CUSTODIO
                    </h6>
                </div>

            </div>

        </div>

        <form action="{{ route('procli.addcomplementarservicio') }}"  method="post" id="submit_programacioncliente" enctype="multipart/form-data">
            @csrf
            <div class="detalle-servicio-panel-body">
            </div>
                    <input type="hidden" name="id_servicio_cliente" value="{{ $data->id }}">
                    <input type="hidden" name="dom_origen" value="{{ $data->direccion_origen }}">
                    <input type="hidden" name="dom_destino" value="{{ $data->direccion_destino }}">
                    <input type="hidden" name="armado_servicio" value="{{ $data->armada }}">
                    <input type="hidden" name="linea_transportista" value="{{ $data->linea_transporte }}">

                    <div style="display: none;">
                        <input type="datetime-local" class="form-control detalle-servicio-input" name="fecha_servicio" id="fecha_servicio" value="{{ $data->fechahora_servicio }}">
                    </div>

                    <input type="hidden"
                           id="tipoArchivo"
                           value="{{ $cadenaTipoDocumento }}">


                        <section class="form-row-section form-row-section--personal">

                            <div class="section-meta">
                                <span class="section-number">03</span>

                                <div>
                                    <h3>Personal</h3>
                                    <p>
                                        Custodio principal y acompañantes secundarios.
                                    </p>
                                </div>
                            </div>

                            <div class="section-controls">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label class="app-label">Cliente </label>
                                        <select class="form-control  app-input" id="cliente_id" name="cliente_id" >
                                            <option value="">Selecciona una opción</option>
                                            @foreach($cliente as $cli)
                                                <option value="{{ $cli->id }}" data-nombre="{{ $cli->razon_social }}">
                                                    Razon social: {{ $cli->razon_social }}, Nombre cliente: {{ $cli->nombre_cliente }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="app-label">
                                            Tipo de servicio
                                        </label>

                                        <div class="compact-radio-group">

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       
                                                       name="tipo_servicio"
                                                       value="0" required>

                                                <span>
                                                    <i class="la la-road"></i>
                                                    Foráneo
                                                </span>
                                            </label>

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       name="tipo_servicio"
                                                       value="1">

                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                    Local
                                                </span>
                                            </label>

                                        </div>
                                    </div>


                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-6 form-group programacion-field-status">
                                        <label class="app-label">
                                            Estatus *
                                        </label>

                                        <div class="programacion-status-select">

                                            <select class="form-control app-input"
                                                    id="programacion_id"
                                                    name="programacion_id"
                                                    required>

                                                <option value="" disabled selected>
                                                    Selecciona el estatus
                                                </option>

                                                @foreach($estatus_programacion_data as $estatus)
                                                    <option value="{{ $estatus->id }}">
                                                        {{ $estatus->estatus_programacion }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 form-group programacion-field-status">
                                        <label class="app-label">
                                            Folio
                                            <span class="programacion-label-optional">
                                                Cliente
                                            </span>
                                        </label>

                                        <input type="text"
                                               class="form-control app-input"
                                               name="folio_interno"
                                               id="folio_interno"
                                               placeholder="Folio proporcionado por el cliente"
                                               autocomplete="off">
                                    </div>

                                </div>


                                <div class="programacion-field-grid programacion-field-grid--personal mt-4">

                                    <div class="form-group programacion-field-custodio">
                                        <label class="app-label">
                                            Custodio Principal *
                                        </label>

                                        <select class="form-control app-input"
                                            id="custodio_id"
                                            name="custodio_id"
                                            required>

                                            <option value="" disabled selected>
                                                Buscar y asignar custodio...
                                            </option>

                                            <option value="153">
                                                Sin custodio
                                            </option>

                                            <option value="154">
                                                Custodio emergente
                                            </option>

                                            @foreach($custodio as $cli)

                                                {{-- Seguridad por si algún día el 153 cambia de estatus --}}
                                                @if((int) $cli->id !== 153)

                                                    <option value="{{ $cli->id }}">
                                                        {{ $cli->nombre_custodio }}
                                                        {{ $cli->ap_paterno }}
                                                        {{ $cli->ap_materno }}
                                                    </option>

                                                @endif 

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group programacion-field-custodio-emergente"
                                         id="contenedor_custodio_emergente"
                                         style="display: none;">

                                        <label class="app-label">
                                            Nombre completo del custodio emergente *
                                        </label>

                                        <input type="text"
                                               class="form-control app-input"
                                               name="custodio_emergente"
                                               id="custodio_emergente"
                                               placeholder="Nombre completo del custodio emergente"
                                               autocomplete="off"
                                               maxlength="255">

                                    </div>

                                    <div class="form-group">
                                        <label class="app-label">
                                            ¿Lleva Acompañantes?
                                        </label>

                                        <div class="compact-radio-group">

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       name="op_custodios"
                                                       id="op_c_uno"
                                                       value="0" />

                                                <span>
                                                    <i class="la la-user-plus"></i>
                                                    Sí
                                                </span>
                                            </label>

                                            <label class="compact-radio-item">
                                                <input type="radio"
                                                       checked
                                                       name="op_custodios"
                                                       id="op_c_dos"
                                                       value="1" />

                                                <span>
                                                    <i class="la la-user"></i>
                                                    No
                                                </span>
                                            </label>

                                        </div>
                                    </div>

                                </div>

                                {{-- ACOMPAÑANTES --}}
                                <div id="div_custodios"
                                     class="programacion-extra-custodios">

                                    <label class="app-label programacion-extra-title">
                                        Acompañantes Extras
                                    </label>

                                    <div class="table-responsive programacion-extra-table-wrapper">

                                        <table class="table table-bordered m-0 text-white programacion-extra-table"
                                               id="tblDocumentos">

                                            <thead>
                                                <tr>
                                                    <th>Custodio</th>
                                                    <th class="text-center programacion-extra-option">
                                                        Opción
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody id="tbodyDocumentos"></tbody>

                                        </table>

                                    </div>

                                    <a href="#"
                                       class="btn btn-action-secondary btn-sm hrefAgregarOtro programacion-add-extra">

                                        <i class="flaticon2-plus"></i>
                                        Agregar otro

                                    </a>

                                </div>

                            </div>
                        </section>




                    {{-- NOTAS + ACCIONES --}}
                    <div class="programacion-form-bottom">

                        <section class="programacion-notes-block">

                            <div class="section-meta section-meta--inline">
                                <span class="section-number">04</span>

                                <div>
                                    <h3>Notas</h3>
                                    <p>
                                        Observaciones críticas u operacionales a considerar.
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control app-input programacion-notes"
                                          name="observaciones"
                                          placeholder="Escriba comentarios adicionales aquí..."
                                          id="observaciones"
                                          rows="3"></textarea>
                            </div>

                        </section>
                </form>
                        <div class="panel-footer-actions">

                            <button type="button"
                                    id="btnGuardarServicioCliente"
                                    class="btn btn-action-primary">

                                <i class="la la-save"></i>
                                Guardar Registro

                            </button>

                        </div>

                    </div>


        
    </section>



</div>

@endsection