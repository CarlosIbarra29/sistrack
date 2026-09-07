@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.0') }}"
          rel="stylesheet"
          type="text/css" />
@endpush

@section('title')
    Nuevo pedido de servicio
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
                    Nuevo Pedido de Servicio
                </h2>

                <p>
                    Completa la información necesaria para solicitar un nuevo servicio de custodia.
                </p>
            </div>

        </div>

        <a href="{{ route('programacion.listadoprogramacion') }}"
           class="nuevo-servicio-btn nuevo-servicio-btn--secondary">

            <i class="flaticon2-back"></i>
            Regresar

        </a>

    </header>


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

                                    <input type="text"
                                           class="form-control nuevo-servicio-input"
                                           name="ubicacion_origen"
                                           id="ubicacion_origen"
                                           placeholder="Ej. 19.2827, -103.7250">

                                </div>

                            </div>


                            <div class="nuevo-servicio-field">

                                <label class="nuevo-servicio-label">
                                    Dirección
                                </label>

                                <textarea class="form-control nuevo-servicio-input nuevo-servicio-textarea nuevo-servicio-textarea--address"
                                          name="direccion_origen"
                                          id="direccion_origen"
                                          rows="2"
                                          placeholder="Escribe la dirección completa"></textarea>

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

                                    <i class="la la-map-marker"></i>

                                    <input type="text"
                                           class="form-control nuevo-servicio-input"
                                           name="ubicacion_destino"
                                           id="ubicacion_destino"
                                           placeholder="Ej. 22.1565, -100.9855">

                                </div>

                            </div>


                            <div class="nuevo-servicio-field">

                                <label class="nuevo-servicio-label">
                                    Dirección
                                </label>

                                <textarea class="form-control nuevo-servicio-input nuevo-servicio-textarea nuevo-servicio-textarea--address"
                                          name="direccion_destino"
                                          id="direccion_destino"
                                          rows="2"
                                          placeholder="Escribe la dirección completa"></textarea>

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

                            <i class="la la-calendar"></i>

                            <input type="datetime-local"
                                   class="form-control nuevo-servicio-input"
                                   name="fecha_hora_servicio"
                                   id="fecha_hora_servicio">

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
                                       value="1">

                                <span>
                                    <i class="la la-check"></i>
                                    Sí
                                </span>

                            </label>


                            <label class="nuevo-servicio-choice">

                                <input type="radio"
                                       name="armada"
                                       value="0">

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

                            <i class="la la-truck"></i>

                            <input type="text"
                                   class="form-control nuevo-servicio-input"
                                   name="linea_transporte"
                                   id="linea_transporte"
                                   placeholder="Escribe la línea de transporte">

                        </div>

                    </div>


                    {{-- OPERADOR --}}
                    <div class="nuevo-servicio-field">

                        <div class="nuevo-servicio-section-label">
                            NOMBRE DEL OPERADOR
                        </div>

                        <div class="nuevo-servicio-input-icon">

                            <i class="la la-user"></i>

                            <input type="text"
                                   class="form-control nuevo-servicio-input"
                                   name="nombre_operador"
                                   id="nombre_operador"
                                   placeholder="Nombre completo del operador">

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

                            <i class="la la-car"></i>

                            <input type="text"
                                   class="form-control nuevo-servicio-input"
                                   name="placas"
                                   id="placas"
                                   placeholder="Ej. 12-AB-34">

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

                            <i class="la la-phone"></i>

                            <input type="tel"
                                   class="form-control nuevo-servicio-input"
                                   name="telefono"
                                   id="telefono"
                                   placeholder="Número telefónico de contacto">

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

                    <textarea class="form-control nuevo-servicio-input nuevo-servicio-textarea"
                              name="observaciones"
                              id="observaciones"
                              rows="4"
                              placeholder="Agrega observaciones o indicaciones adicionales para el servicio..."></textarea>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FOOTER VISUAL
        ========================================================== --}}
        <footer class="nuevo-servicio-footer">

            <a href="{{ route('programacion.listadoprogramacion') }}"
               class="nuevo-servicio-btn nuevo-servicio-btn--secondary">

                <i class="la la-times"></i>
                Cancelar

            </a>

            <button type="button"
                    class="nuevo-servicio-btn nuevo-servicio-btn--primary">

                <i class="la la-save"></i>
                Crear solicitud

            </button>

        </footer>

    </section>

</div>

@endsection