@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/programacion/AgregarProgramacion.js') }}"></script>
@endpush

@section('title')
    Agregar Programación
@endsection

@section('content')

<style>
    /* Base e Integración al Dashboard */
    body, .content, .wrapper {
        background-color: #121824 !important;
        color: #ffffff !important;
    }

    /* Panel Unificado Estilo Industrial */
    .flat-panel {
        background-color: #1a2332 !important;
        border: 1px solid #243146 !important;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
    }

    /* Filas divisoras del formulario */
    .form-row-section {
        display: flex;
        flex-wrap: wrap;
        border-bottom: 1px solid #243146;
        padding: 2.2rem 2.5rem;
    }

    .form-row-section:last-of-type {
        border-bottom: none;
    }

    /* Columna de Títulos Laterales (Indicador del bloque) */
    .section-meta {
        flex: 0 0 25%;
        max-width: 25%;
        padding-right: 2rem;
    }

    .section-meta h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #e2a84b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 0.5rem;
    }

    .section-meta p {
        font-size: 0.8rem;
        color: #64748b;
        line-height: 1.4;
    }

    /* Columna de Controles de Formulario */
    .section-controls {
        flex: 0 0 75%;
        max-width: 75%;
    }

    /* Inputs Estilo Minimalista de Alta Densidad */
    .app-input {
        background-color: #111827 !important;
        border: 1px solid #2e3b4e !important;
        color: #ffffff !important;
        border-radius: 6px !important;
        padding: 0.65rem 0.85rem;
        height: auto !important;
        font-size: 0.9rem;
    }

    .app-input:focus {
        border-color: #ebc053 !important;
        background-color: #0f1422 !important;
        box-shadow: none !important;
    }

    .app-label {
        color: #94a3b8 !important;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.5rem;
    }

    /* Contenedor de Botones de Opción (Radios) Compactos */
    .compact-radio-group {
        display: inline-flex;
        background-color: #111827;
        border: 1px solid #2e3b4e;
        border-radius: 6px;
        padding: 2px;
        width: 100%;
    }

    .compact-radio-item {
        flex: 1;
        text-align: center;
        margin: 0;
    }

    .compact-radio-item input[type="radio"] {
        display: none;
    }

    .compact-radio-item span {
        display: block;
        padding: 0.55rem 0.75rem;
        font-size: 0.85rem;
        color: #94a3b8;
        border-radius: 4px;
        cursor: pointer;
        user-select: none;
        transition: all 0.2s ease;
    }

    .compact-radio-item input[type="radio"]:checked + span {
        background-color: #243146;
        color: #ebc053;
        font-weight: 600;
    }

    /* Barra de Herramientas de Cierre */
    .panel-footer-actions {
        background-color: #151c28;
        padding: 1.5rem 2.5rem;
        border-top: 1px solid #243146;
    }

    /* Estilo de Select nativo */
    select.app-input option {
        background-color: #111827 !important;
        color: #ffffff !important;
    }

    /* Botonera */
    .btn-action-primary {
        background-color: #ebc053 !important;
        color: #000000 !important;
        font-weight: 700 !important;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-radius: 6px !important;
        padding: 0.75rem 2rem !important;
        border: none !important;
    }

    .btn-action-secondary {
        background-color: transparent !important;
        border: 1px solid #2e3b4e !important;
        color: #94a3b8 !important;
        font-weight: 600 !important;
        font-size: 0.85rem;
        text-transform: uppercase;
        border-radius: 6px !important;
        padding: 0.75rem 1.5rem !important;
    }

    .btn-action-secondary:hover {
        background-color: #243146 !important;
        color: #ffffff !important;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .section-meta, .section-controls {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .section-meta {
            padding-right: 0;
            margin-bottom: 1.5rem;
        }
    }
</style>

<div class="container-fluid py-4 px-6">

    <!-- HEADER MINIMALISTA -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h1 class="font-weight-bold text-white m-0" style="font-size: 1.6rem; letter-spacing: 0.5px; text-transform: uppercase;">NUEVA PROGRAMACIÓN</h1>
            <p class="text-muted m-0 small">Complete los datos del servicio y la asignación correspondiente</p>
        </div>

        <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-action-secondary">
            <i class="flaticon2-back mr-2"></i> Regresar
        </a>
    </div>

    {{-- FORMULARIO ESTRUCTURADO --}}
    <form action="{{ route('programacion.guardarprogramacion') }}" 
          method="post" 
          id="submit_programacion" 
          enctype="multipart/form-data">
        
        @csrf
        <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
        <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>

        <div class="flat-panel">
            
            <!-- SECCIÓN 1: CLIENTE Y TIEMPO -->
            <div class="form-row-section">
                <div class="section-meta">
                    <h3>Origen</h3>
                    <p>Defina el cliente solicitante, el horario de salida del servicio y las variables de monitoreo.</p>
                </div>
                <div class="section-controls">
                    <div class="form-group row">
                        <div class="col-md-7 mb-4">
                            <label class="app-label">Razón Social *</label>
                            <select class="form-control app-input" id="cliente_id" name="cliente_id" required>
                                <option value="" disabled selected>Buscar y seleccionar cliente...</option>
                                @foreach($cliente as $cli)
                                    <option value="{{ $cli->id }}">{{ $cli->nombre_cliente }} / {{ $cli->razon_social }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5 mb-4">
                            <label class="app-label">Fecha y hora de servicio *</label>
                            <input type="datetime-local" class="form-control app-input" name="fecha_hora" id="fecha_hora" required>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-4 mb-3">
                            <label class="app-label">Tipo de servicio</label>
                            <div class="compact-radio-group">
                                <label class="compact-radio-item">
                                    <input type="radio" checked name="tipo_servicio" value="0">
                                    <span>Foráneo</span>
                                </label>
                                <label class="compact-radio-item">
                                    <input type="radio" name="tipo_servicio" value="1">
                                    <span>Local</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="app-label">Armado</label>
                            <div class="compact-radio-group">
                                <label class="compact-radio-item">
                                    <input type="radio" checked name="armado_servicio" value="1">
                                    <span>Sí</span>
                                </label>
                                <label class="compact-radio-item">
                                    <input type="radio" name="armado_servicio" value="2">
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="app-label">Monitoreo</label>
                            <div class="compact-radio-group">
                                <label class="compact-radio-item">
                                    <input type="radio" checked name="op_monitoreo_id" value="1">
                                    <span>M1</span>
                                </label>
                                <label class="compact-radio-item">
                                    <input type="radio" name="op_monitoreo_id" value="2">
                                    <span>M2</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: LOGÍSTICA E IDENTIFICACIÓN -->
            <div class="form-row-section">
                <div class="section-meta">
                    <h3>Logística</h3>
                    <p>Detalle el tarifario base aplicable y el control interno de folios y transportación.</p>
                </div>
                <div class="section-controls">
                    <div class="form-group row">
                        <div class="col-md-12 mb-4">
                            <label class="app-label">Tarifario asignado *</label>
                            <select class="form-control app-input" id="id_tarifa" name="id_tarifa" required></select>
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-6 mb-3">
                            <label class="app-label">Folio Interno *</label>
                            <input type="text" class="form-control app-input" name="folio_interno" id="folio_interno" placeholder="Ingrese número de folio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="app-label">Cliente / Transportista *</label>
                            <input type="text" class="form-control app-input" name="linea_transportista" id="linea_transportista" placeholder="Escriba la línea de transporte" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 3: GEOLOCALIZACIÓN -->
            <div class="form-row-section">
                <div class="section-meta">
                    <h3>Rutas</h3>
                    <p>Puntos geográficos controlados de partida y destino.</p>
                </div>
                <div class="section-controls">
                    <div class="form-group row mb-0">
                        <div class="col-md-6 mb-3">
                            <label class="app-label">Domicilio origen *</label>
                            <input type="text" class="form-control app-input" name="dom_origen" id="dom_origen" placeholder="Dirección origen del servicio" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="app-label">Domicilio destino *</label>
                            <input type="text" class="form-control app-input" name="dom_destino" id="dom_destino" placeholder="Dirección destino del servicio" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 4: ASIGNACIÓN OPERATIVA -->
            <div class="form-row-section">
                <div class="section-meta">
                    <h3>Personal</h3>
                    <p>Gestione el custodio principal al mando de la unidad y acompañantes secundarios.</p>
                </div>
                <div class="section-controls">
                    <div class="form-group row align-items-end">
                        <div class="col-md-7 mb-4">
                            <label class="app-label">Custodio Principal *</label>
                            <select class="form-control app-input" id="custodio_id" name="custodio_id" required >
                                <option value="" disabled selected>Asignar custodio...</option>
                                @foreach($custodio as $cli)
                                    <option value="{{ $cli->id }}" >{{ $cli->nombre_custodio }} {{ $cli->ap_paterno }} {{ $cli->ap_materno }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-5 mb-4">
                            <label class="app-label">¿Lleva Acompañantes?</label>
                            <div class="compact-radio-group">
                                <label class="compact-radio-item">
                                    <input type="radio" name="op_custodios" id="op_c_uno" value="0" />
                                    <span>Sí</span>
                                </label>
                                <label class="compact-radio-item">
                                    <input type="radio" checked name="op_custodios" id="op_c_dos" value="1" />
                                    <span>No</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Bloque dinámico integrado --}}
                    <div class="p-5 rounded mb-0" id="div_custodios" style="display: none; background-color: #111827; border: 1px solid #2e3b4e;">
                        <label class="app-label mb-3">Acompañantes Extras</label>
                        <div class="table-responsive mb-3">
                            <table class="table table-bordered m-0 text-white" id="tblDocumentos" style="border-color: #2e3b4e;">
                                <thead>
                                    <tr style="background-color: #1a2332;">
                                        <th class="border-0 py-2">Custodio</th>
                                        <th class="border-0 py-2 text-center" style="width: 80px;">Opción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDocumentos"></tbody>
                            </table>
                        </div>
                        <a href="#" class="btn btn-action-secondary btn-sm hrefAgregarOtro">
                            <i class="flaticon2-plus small"></i> Agregar otro
                        </a>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 5: ANOTACIONES FINALES -->
            <div class="form-row-section">
                <div class="section-meta">
                    <h3>Notas</h3>
                    <p>Observaciones críticas u operacionales a considerar.</p>
                </div>
                <div class="section-controls">
                    <div class="form-group mb-0">
                        <textarea class="form-control app-input" name="observaciones" placeholder="Escriba comentarios adicionales aquí..." id="observaciones" rows="3"></textarea>
                    </div>
                </div>
            </div>

            <!-- ACCIONES -->
            <div class="panel-footer-actions d-flex justify-content-end align-items-center">
                <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-action-secondary mr-3">
                    Limpiar Todo
                </a>
                <button type="button" id="btnGuardar" class="btn btn-action-primary">
                    Guardar Registro
                </button>
            </div>

        </div>
    </form>
</div>

@endsection