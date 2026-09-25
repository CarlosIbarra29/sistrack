@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.0') }}"
          rel="stylesheet"
          type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('js/catalogos/CatalogoNotificaciones.js') }}"></script>
@endpush

@section('title')
    Notificación del servicio
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

        @if($notificaciones->estatus == 0)
            <button id="marcar_leido"
               class="nuevo-servicio-btn nuevo-servicio-btn--secondary">

                <i class="far fa-eye text-white"></i>
                Marcar como leído 

            </button>
        @endif

        <a href="{{ route('notificaciones.catalogonotificaciones') }}"
           class="nuevo-servicio-btn nuevo-servicio-btn--secondary">

            <i class="flaticon2-back"></i>
            Regresar

        </a>
    </header>


        <form method="post" id="leido_notificacion" action="{{ route('notificaciones.marcarleidosercliente') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="id_notificacion" value="{{ $notificaciones->id }}">
        </form>

    {{-- =========================================================
        PANEL PRINCIPAL
    ========================================================== --}}
    <section class="nuevo-servicio-panel">

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

        <form action="{{ route('procli.guardarserviciocliente') }}"  method="post" id="submit_programacion" enctype="multipart/form-data">
            @csrf
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
        </form>
    </section>

</div>

@endsection