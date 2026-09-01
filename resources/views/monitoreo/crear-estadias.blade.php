@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.0.3') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('js/monitoreo/AgregarEstadias.js?v=2.0.3') }}"></script>
@endpush

@section('title')
    Editar servicio
@endsection

@section('content')

@php
    $fechaServicio = $programacion->fecha_servicio
        ? \Carbon\Carbon::parse($programacion->fecha_servicio)->format('Y-m-d\TH:i')
        : '';

    $fechaLlegadaCustodio = $estadias_info && $estadias_info->fechahora_llegada_custodio
        ? \Carbon\Carbon::parse($estadias_info->fechahora_llegada_custodio)->format('Y-m-d\TH:i')
        : '';

    $fechaInicioTrayecto = $estadias_info && $estadias_info->fechahora_inicio_trayecto
        ? \Carbon\Carbon::parse($estadias_info->fechahora_inicio_trayecto)->format('Y-m-d\TH:i')
        : '';

    $fechaLlegadaDestino = $estadias_info && $estadias_info->fechahora_llegado_destino
        ? \Carbon\Carbon::parse($estadias_info->fechahora_llegado_destino)->format('Y-m-d\TH:i')
        : '';

    $fechaFinalizacion = $estadias_info && $estadias_info->fechahora_finalizacion
        ? \Carbon\Carbon::parse($estadias_info->fechahora_finalizacion)->format('Y-m-d\TH:i')
        : '';
@endphp

<div class="transport-page">

    <header class="transport-page-header">

        <div class="transport-heading">

            <span class="transport-header-icon">
                <i class="la la-edit"></i>
            </span>

            <div>
                <span class="transport-eyebrow">
                    MONITOREO OPERATIVO
                </span>

                <h2>
                    Editar Servicio
                </h2>

                <p>
                    Modifica la información general, operativa y de transporte del servicio programado.
                </p>
            </div>

        </div>

        <a href="{{ route('monitoreo.listamonitoreo') }}" class="transport-btn transport-btn--secondary">
            <i class="flaticon2-back"></i>
            Regresar
        </a>

    </header>


    <form action="{{ route('monitoreo.guardarestadia') }}"
          method="post"
          id="submit_estadia"
          enctype="multipart/form-data"
          class="transport-form">

        @csrf

        <input type="hidden"
               name="op_estadias"
               value="{{ $op_estadia }}">

        <input type="hidden"
               name="id_programacion"
               value="{{ $id_programacion }}">


        <section class="transport-panel">

            <div class="transport-panel-header">

                <div class="transport-panel-title">

                    <span class="transport-panel-icon">
                        <i class="la la-file-text"></i>
                    </span>

                    <div>
                        <span class="transport-eyebrow">
                            PROGRAMACIÓN
                        </span>

                        <h6>
                            DATOS DEL SERVICIO
                        </h6>
                    </div>

                </div>

                <span class="transport-folio">
                    {{ $programacion->folio }}
                </span>

            </div>


            <div class="transport-panel-body">

                <div class="transport-service-grid">

                    {{-- ESTATUS --}}
                    <div class="transport-field">

                        <label class="transport-label" for="programacion_estatus_id">
                            Estatus
                            <span>*</span>
                        </label>

                        <select class="form-control transport-input"
                                id="programacion_estatus_id"
                                name="programacion_estatus_id">

                            <option value="" disabled>
                                Selecciona el estatus
                            </option>

                            @foreach($estatus_programacion as $estatus)

                                <option value="{{ $estatus->id }}"
                                        @selected($programacion->programacion_estatus_id == $estatus->id)>

                                    {{ $estatus->estatus_programacion }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="transport-field">
                        <label class="transport-label">
                            Cliente
                        </label>

                        @php
                            $clienteActual = $clientes->firstWhere(
                                'id',
                                $programacion->cliente_id
                            );
                        @endphp

                        <div class="transport-readonly">

                            <span class="transport-readonly__icon">
                                <i class="la la-building"></i>
                            </span>

                            <div class="transport-readonly__content">

                                <strong>
                                    {{ $clienteActual->nombre_cliente ?? 'Sin cliente' }}
                                </strong>

                                @if($clienteActual && !empty($clienteActual->razon_social))
                                    <small>
                                        {{ $clienteActual->razon_social }}
                                    </small>
                                @endif

                            </div>

                            <span class="transport-readonly__badge">
                                Solo lectura
                            </span>

                        </div>

                    </div>

                    <div class="transport-field">

                        <label class="transport-label" for="fecha_servicio">
                            Fecha y hora del servicio
                            <span>*</span>
                        </label>

                        <div class="transport-input-icon">
                            <i class="la la-calendar"></i>

                            <input type="datetime-local"
                                   class="form-control transport-input"
                                   id="fecha_servicio"
                                   name="fecha_servicio"
                                   value="{{ $fechaServicio }}"
                                   >

                        </div>

                    </div>

                    <div class="transport-field">

                        <label class="transport-label" for="tipo_servicio">
                            Tipo de servicio
                            <span>*</span>
                        </label>

                        <select class="form-control transport-input"
                                id="tipo_servicio"
                                name="tipo_servicio"
                                >

                            <option value="0"
                                    @selected($programacion->tipo_servicio == 0)>
                                Foráneo
                            </option>

                            <option value="1"
                                    @selected($programacion->tipo_servicio == 1)>
                                Local
                            </option>

                        </select>

                    </div>

                    <div class="transport-field">

                        <label class="transport-label" for="dom_origen">
                            Origen
                            <span>*</span>
                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-map-marker"></i>

                            <input type="text"
                                   class="form-control transport-input"
                                   id="dom_origen"
                                   name="dom_origen"
                                   value="{{ $programacion->dom_origen }}"
                                   placeholder="Origen del servicio"
                                   >

                        </div>

                    </div>

                    <div class="transport-field">

                        <label class="transport-label" for="dom_destino">
                            Destino
                            <span>*</span>

                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-map-marker"></i>

                            <input type="text"
                                   class="form-control transport-input"
                                   id="dom_destino"
                                   name="dom_destino"
                                   value="{{ $programacion->dom_destino }}"
                                   placeholder="Destino del servicio"
                                   >

                        </div>

                    </div>

                    <div class="transport-field">

                        <label class="transport-label" for="custodio_id">

                            Nombre del custodio
                            <span>*</span>

                        </label>

                        <select class="form-control transport-input"
                                id="custodio_id"
                                name="custodio_id"
                                >

                            <option value=""  disabled>
                                Selecciona el custodio
                            </option>

                            @foreach($custodios as $custodio)

                                <option value="{{ $custodio->id }}"
                                        @selected($programacion->custodio_id == $custodio->id)>

                                    {{ $custodio->nombre_custodio }}
                                    {{ $custodio->ap_paterno }}
                                    {{ $custodio->ap_materno }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="transport-field">

                        <label class="transport-label">
                            Servicio armado
                        </label>

                        <div class="transport-choice-group">

                            <label class="transport-choice">

                                <input type="radio"
                                       name="armado_servicio"
                                       value="1"
                                       @checked($programacion->armado_servicio == 1)>

                                <span>
                                    <i class="la la-check"></i>
                                    Sí
                                </span>

                            </label>

                            <label class="transport-choice">

                                <input type="radio"
                                       name="armado_servicio"
                                       value="2"
                                       @checked($programacion->armado_servicio == 2)>

                                <span>
                                    <i class="la la-times"></i>
                                    No
                                </span>

                            </label>

                        </div>

                    </div>

                    <div class="transport-field transport-field--companions">

                        <label class="transport-label"  for="acompanantes_ids">
                            Armados y acompañantes
                        </label>

                        <select class="form-control transport-input transport-multiple"
                                id="acompanantes_ids"
                                name="acompanantes_ids[]"
                                multiple>

                            @foreach($custodios as $custodio)

                                <option value="{{ $custodio->id }}"
                                        @selected(in_array($custodio->id, $acompanantes_ids))>

                                    {{ $custodio->nombre_custodio }}
                                    {{ $custodio->ap_paterno }}
                                    {{ $custodio->ap_materno }}

                                </option>

                            @endforeach

                        </select>

                        <small class="transport-field-help">
                            Puedes seleccionar uno o más custodios acompañantes.
                        </small>

                    </div>


                    {{-- OBSERVACIONES DE PROGRAMACIÓN --}}
                    <div class="transport-field transport-field--full">

                        <label class="transport-label"
                               for="observaciones_programacion">
                            Observaciones del servicio
                        </label>

                        <textarea class="form-control transport-input transport-textarea"
                                  id="observaciones_programacion"
                                  name="observaciones_programacion"
                                  rows="3"
                                  placeholder="Observaciones generales del servicio...">{{ $programacion->observaciones }}</textarea>

                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
            DATOS DEL TRANSPORTE
        ========================================================== --}}
        <section class="transport-panel transport-panel--highlight">

            <div class="transport-panel-header">

                <div class="transport-panel-title">

                    <span class="transport-panel-icon transport-panel-icon--blue">
                        <i class="la la-truck"></i>
                    </span>

                    <div>
                        <span class="transport-eyebrow">
                            INFORMACIÓN LOGÍSTICA
                        </span>

                        <h6>
                            DATOS DEL TRANSPORTE Y CONDUCTOR
                        </h6>
                    </div>

                </div>

            </div>


            <div class="transport-panel-body">

                <div class="transport-vehicle-grid">

                    <div class="transport-field">

                        <label class="transport-label" for="linea_transportista">
                            Línea transportista
                            <span>*</span>
                        </label>

                        <input type="text"
                               class="form-control transport-input"
                               name="linea_transportista"
                               id="linea_transportista"
                               value="{{ $estadias_info->linea_transportistas ?? '' }}"
                               placeholder="Nombre de la línea transportista"
                               >

                    </div>


                    {{-- CONDUCTOR --}}
                    <div class="transport-field">

                        <label class="transport-label" for="nombre_conductor">
                            Nombre del conductor
                            <span>*</span>

                        </label>

                        <input type="text"
                               class="form-control transport-input"
                               name="nombre_conductor"
                               id="nombre_conductor"
                               value="{{ $estadias_info->nombre_conductor ?? '' }}"
                               placeholder="Nombre completo del conductor"
                               >

                    </div>


                    {{-- TELÉFONO --}}
                    <div class="transport-field">

                        <label class="transport-label" for="telefono">
                            Teléfono
                            <span>*</span>

                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-phone"></i>

                            <input type="tel"
                                   class="form-control transport-input"
                                   name="telefono"
                                   id="telefono"
                                   value="{{ $estadias_info->telefono ?? '' }}"
                                   placeholder="Teléfono del conductor"
                                   >

                        </div>

                    </div>


                    <div class="transport-field">

                        <label class="transport-label" for="placas">
                            Placas
                            <span>*</span>
                        </label>

                        <input type="text"
                               class="form-control transport-input"
                               name="placas"
                               id="placas"
                               value="{{ $estadias_info->placas ?? '' }}"
                               placeholder="Placas de la unidad"
                               >

                    </div>

                    <div class="transport-field transport-field--full">

                        <label class="transport-label" for="generales_unidad">
                            Generales de la unidad
                        </label>

                        <textarea class="form-control transport-input transport-textarea"
                                  name="observaciones"
                                  id="generales_unidad"
                                  rows="3"
                                  placeholder="Marca, modelo, color, tipo de caja u otros datos de la unidad...">{{ $estadias_info->generales_unidad ?? '' }}</textarea>

                    </div>

                </div>

            </div>

        </section>

        <section class="transport-panel">

            <div class="transport-panel-header">

                <div class="transport-panel-title">

                    <span class="transport-panel-icon">
                        <i class="la la-clock-o"></i>
                    </span>

                    <div>
                        <span class="transport-eyebrow">
                            SEGUIMIENTO
                        </span>

                        <h6>
                            FECHAS Y HORARIOS OPERATIVOS
                        </h6>
                    </div>

                </div>

            </div>


            <div class="transport-panel-body">

                <div class="transport-dates-grid">

                    <div class="transport-field">

                        <label class="transport-label" for="fechahora_llegada_custodio">
                            Llegada del custodio
                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-calendar-check-o"></i>

                            <input type="datetime-local"
                                   class="form-control transport-input"
                                   name="fechahora_llegada_custodio"
                                   id="fechahora_llegada_custodio"
                                   value="{{ $fechaLlegadaCustodio }}">

                        </div>

                    </div>


                    <div class="transport-field">

                        <label class="transport-label" for="fechahora_inicio_trayecto">
                            Inicio de trayecto
                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-road"></i>

                            <input type="datetime-local"
                                   class="form-control transport-input"
                                   name="fechahora_inicio_trayecto"
                                   id="fechahora_inicio_trayecto"
                                   value="{{ $fechaInicioTrayecto }}">

                        </div>

                    </div>


                    <div class="transport-field">

                        <label class="transport-label" for="fechahora_llegado_destino">
                            Llegada a destino
                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-map-marker"></i>

                            <input type="datetime-local"
                                   class="form-control transport-input"
                                   name="fechahora_llegado_destino"
                                   id="fechahora_llegado_destino"
                                   value="{{ $fechaLlegadaDestino }}">

                        </div>

                    </div>


                    <div class="transport-field">

                        <label class="transport-label"
                               for="fechahora_finalizacion">
                            Finalización
                        </label>

                        <div class="transport-input-icon">

                            <i class="la la-flag-checkered"></i>

                            <input type="datetime-local"
                                   class="form-control transport-input"
                                   name="fechahora_finalizacion"
                                   id="fechahora_finalizacion"
                                   value="{{ $fechaFinalizacion }}">

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <footer class="transport-form-footer">

            <a href="{{ route('monitoreo.listamonitoreo') }}"
               class="transport-btn transport-btn--secondary">

                <i class="la la-times"></i>
                Cancelar

            </a>


            <div class="transport-form-footer__right">

                <button type="button"
                        id="btnLimpiarEstadia"
                        class="transport-btn transport-btn--secondary">

                    <i class="la la-refresh"></i>
                    Limpiar

                </button>


                <button type="button"
                        id="btnGuardar"
                        class="transport-btn transport-btn--primary">

                    <i class="la la-save"></i>
                    Guardar cambios

                </button>

            </div>

        </footer>

    </form>

</div>

@endsection