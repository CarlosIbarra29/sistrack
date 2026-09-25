@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.0') }}"
          rel="stylesheet"
          type="text/css" />
@endpush

@push('scripts')
    {{-- <script src="{{ asset('js/programacion/AgregarProgramacionCliente.js') }}"></script> --}}
    <script src="{{ asset('js/programacion/CatalogoProgramacion.js?v=1.3.8') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/programacion/Complementoprogramacion.js') }}"></script>
@endpush

@section('title')
    Ver servicio
@endsection

@section('content')

<div class="nuevo-servicio-page">

    {{-- =========================================================
        ENCABEZADO
    ========================================================== --}}
    <header class="nuevo-servicio-header">

        <div class="nuevo-servicio-heading">

            <span class="nuevo-servicio-header-icon">
                <i class="la la-clipboard"></i>
            </span>

            <div>
                <span class="nuevo-servicio-eyebrow">
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

        <a href="{{ route('procli.listaservicios') }}"
           class="nuevo-servicio-btn nuevo-servicio-btn--secondary">

            <i class="flaticon2-back"></i>
            Regresar

        </a>

    </header>


    {{-- =========================================================
        PANEL PRINCIPAL
    ========================================================== --}}
    <section class="nuevo-servicio-panel is-collapsed">

        <div class="nuevo-servicio-panel-header">

            <div class="nuevo-servicio-panel-title">

                <span class="nuevo-servicio-panel-icon">
                    <i class="la la-clipboard-list"></i>
                </span>

                <div>
                    <span class="nuevo-servicio-eyebrow">
                        SOLICITUD
                    </span>

                    <h6>
                        INFORMACIÓN DEL SERVICIO
                    </h6>
                </div>

            </div>

        </div>

            <div class="nuevo-servicio-panel-body">

                {{-- =====================================================
                    ORIGEN / DESTINO
                ====================================================== --}}
                <div class="nuevo-servicio-section">

                    <div class="nuevo-servicio-section-grid">

                        {{-- ORIGEN --}}
                        <div class="nuevo-servicio-location-block">

                            <div class="nuevo-servicio-section-label">
                                UBICACIÓN / DIRECCIÓN ORIGEN
                            </div>

                            <div class="nuevo-servicio-location-grid">

                                <div class="nuevo-servicio-field">

                                    <label class="nuevo-servicio-label">
                                        Ubicación
                                    </label>

                                    <div class="nuevo-servicio-input-icon">
                                        <i class="la la-map-marker"></i>
                                        <span>{{ $data->ubicacion_origen }}</span>
                                    </div>

                                </div>


                                <div class="nuevo-servicio-field">

                                    <label class="nuevo-servicio-label">
                                        Dirección
                                    </label>
                                    <span>{{ $data->direccion_origen }}</span>

                                </div>

                            </div>

                        </div>


                        {{-- DESTINO --}}
                        <div class="nuevo-servicio-location-block">

                            <div class="nuevo-servicio-section-label">
                                UBICACIÓN / DIRECCIÓN DESTINO
                            </div>

                            <div class="nuevo-servicio-location-grid">

                                <div class="nuevo-servicio-field">

                                    <label class="nuevo-servicio-label">
                                        Ubicación
                                    </label>

                                    <div class="nuevo-servicio-input-icon">
                                        <span>{{ $data->ubicacion_destino }}</span>
                                    </div>

                                </div>


                                <div class="nuevo-servicio-field">

                                    <label class="nuevo-servicio-label">
                                        Dirección
                                    </label>
                                    <span>{{ $data->direccion_destino }}</span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="nuevo-servicio-divider"></div>


                {{-- =====================================================
                    FECHA / ARMADA
                ====================================================== --}}
                <div class="nuevo-servicio-section">

                    <div class="nuevo-servicio-main-grid">

                        {{-- FECHA Y HORA --}}
                        <div class="nuevo-servicio-field">

                            <div class="nuevo-servicio-section-label">
                                FECHA Y HORA DEL SERVICIO
                            </div>

                            <div class="nuevo-servicio-input-icon">
                                <span>{{ $data->fechahora_servicio }}</span>

                            </div>

                        </div>


                        {{-- ARMADA --}}
                        <div class="nuevo-servicio-field">

                            <div class="nuevo-servicio-section-label">
                                ARMADA
                            </div>

                            <div class="nuevo-servicio-choice-group">

                                <label class="nuevo-servicio-choice">

                                    <input type="radio"
                                           name="armada"
                                           value="1" {{($data->armada == 1) ? 'checked' : ''}} disabled>

                                    <span>
                                        <i class="la la-check"></i>
                                        Sí
                                    </span>

                                </label>


                                <label class="nuevo-servicio-choice">

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


                <div class="nuevo-servicio-divider"></div>


                {{-- =====================================================
                    TRANSPORTE / OPERADOR
                ====================================================== --}}
                <div class="nuevo-servicio-section">

                    <div class="nuevo-servicio-main-grid">

                        {{-- LÍNEA TRANSPORTE --}}
                        <div class="nuevo-servicio-field">

                            <div class="nuevo-servicio-section-label">
                                LÍNEA DE TRANSPORTE
                            </div>

                            <div class="nuevo-servicio-input-icon">
                                <span>{{ $data->linea_transporte }}</span>
                            </div>

                        </div>


                        {{-- OPERADOR --}}
                        <div class="nuevo-servicio-field">

                            <div class="nuevo-servicio-section-label">
                                NOMBRE DEL OPERADOR
                            </div>

                            <div class="nuevo-servicio-input-icon">
                                <span>{{ $data->nombre_operador }}</span>
                            </div>

                        </div>

                    </div>

                </div>


                <div class="nuevo-servicio-divider"></div>


                {{-- =====================================================
                    PLACAS / TELÉFONO
                ====================================================== --}}
                <div class="nuevo-servicio-section">

                    <div class="nuevo-servicio-main-grid">

                        {{-- PLACAS --}}
                        <div class="nuevo-servicio-field">

                            <div class="nuevo-servicio-section-label">
                                PLACAS
                            </div>

                            <div class="nuevo-servicio-input-icon">
                                <span>{{ $data->placas }}</span>
                            </div>

                            <small class="nuevo-servicio-help">
                                Ej. 12-AB-34 o 123-ABC
                            </small>

                        </div>


                        {{-- TELÉFONO --}}
                        <div class="nuevo-servicio-field">

                            <div class="nuevo-servicio-section-label">
                                NÚMERO TELEFÓNICO
                            </div>

                            <div class="nuevo-servicio-input-icon">
                                <span>{{ $data->numero_telefono }}</span>
                            </div>

                            <small class="nuevo-servicio-help">
                                Ej. 55 1234 5678
                            </small>

                        </div>

                    </div>

                </div>


                <div class="nuevo-servicio-divider"></div>


                {{-- =====================================================
                    OBSERVACIONES
                ====================================================== --}}
                <div class="nuevo-servicio-section">

                    <div class="nuevo-servicio-field">

                        <div class="nuevo-servicio-section-label">
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
            <footer class="nuevo-servicio-footer">


            </footer>

    </section>



    {{-- =========================================================
        PANEL PRINCIPAL
    ========================================================== --}}
    <section class="nuevo-servicio-panel mt-4">

        <div class="nuevo-servicio-panel-header">

            <div class="nuevo-servicio-panel-title">

                <span class="nuevo-servicio-panel-icon">
                    <i class="la la-clipboard-list"></i>
                </span>

                <div>
                    <span class="nuevo-servicio-eyebrow">
                        CUSTODIO
                    </span>

                    <h6>
                        INFORMACIÓN DE CUSTODIO
                    </h6>
                </div>

            </div>

        </div>

        <form action="{{ route('procli.guardarserviciocliente') }}"  method="post" id="submit_programacion" enctype="multipart/form-data">
            @csrf
            <div class="nuevo-servicio-panel-body">
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

                                <div class="programacion-field-grid programacion-field-grid--personal">

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

                        <div class="panel-footer-actions">

                            <button type="button"
                                    id="btnGuardar"
                                    class="btn btn-action-primary">

                                <i class="la la-save"></i>
                                Guardar Registro

                            </button>

                        </div>

                    </div>


        </form>
    </section>



</div>

@endsection