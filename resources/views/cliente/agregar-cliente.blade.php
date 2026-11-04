@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/clientes.css?v=1.0.2') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js?v=1.0.2') }}"></script>
@endpush

@section('title')
    Agregar cliente
@endsection

@section('content')

<div class="cliente-edit-page cliente-create-page">
    <div class="cliente-page-header">
        <div class="cliente-page-title">
            <div class="cliente-title-kicker">ADMINISTRACIÓN / CLIENTES</div>
            <h2>Registro de cliente</h2>
            <p>Complete la información general y técnica del cliente.</p>
        </div>
        <a href="{{ route('cliente.listadocliente') }}"
           class="btn cliente-btn cliente-btn--back">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </div>

                <form action="{{ route('cliente.guardarcliente') }}" 
                      method="post" 
                      id="submit_cliente"  
                      enctype="multipart/form-data">
                    @csrf

                    <div class="cliente-main-card">
                        <div class="cliente-tabs-header">
                        <ul class="nav nav-tabs cliente-tabs">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                                    <i class="flaticon2-user mr-2"></i> Información del Cliente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                                    <i class="flaticon2-document mr-2"></i> Documentación
                                </a>
                            </li>
                        </ul>
                        </div>

                        <div class="cliente-content">
                        <div class="tab-content">

                            <!-- ================= INFO CLIENTE ================= -->
                            <div class="tab-pane fade show active" id="kt_tab_pane_1">

                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">INFORMACIÓN GENERAL</span><h3>Datos generales</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <span class="titulo-lb">Razón social</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="razon_social" id="razon_social" required/>
                                        </div>

                                        <div class="col-lg-4">
                                            <span class="titulo-lb">Nombre comercial / Cliente</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="cliente" id="cliente" required/>
                                        </div>

                                        <div class="col-lg-4">
                                            <span class="titulo-lb">Grupo</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="grupo" id="grupo"/>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- INFORMACIÓN TÉCNICA -->
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">CONFIGURACIÓN DEL SERVICIO</span><h3>Información técnica</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <span class="titulo-lb">Días de Crédito</span>
                                            <input type="number" class="form-control form-control-lg st-input"
                                                   name="dias_credito" id="dias_credito"/>
                                        </div>

                                        <div class="col-lg-3">
                                            <span class="titulo-lb">Costo de estadía</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="costo_estadia" id="costo_estadia"/>
                                        </div>

                                        <div class="col-lg-3">
                                            <span class="titulo-lb">Costo km extraordinario</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="costo_km" id="costo_km"/>
                                        </div>

                                        <div class="col-lg-3">
                                            <span class="titulo-lb">Costo por estadía no armada</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="costo_estadia_armada" id="costo_estadia_armada"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="titulo-lb">Servicio con arma</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="servicio_arma" id="servicio_arma"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <span class="titulo-lb">Servicio sin arma</span>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="servicio_sin_arma" id="servicio_sin_arma"/>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <!-- CONTACTO OPERATIVO -->
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">CONTACTOS</span><h3>Contactos</h3></div>

                                        <a href="#" 
                                           class="btn btn-icon btn-outline-warning btn-sm hrefAgregarOtro cliente-add-btn"
                                           data-toggle="tooltip"
                                           title="Agregar contacto">
                                            <i class="flaticon2-plus"></i> <span>Agregar contacto</span>
                                        </a>
                                    </div>

                                    <div class="cliente-table-wrapper">
                                        <table class='table table-hover mb-0 cliente-table' id='tblDocumentos'>
                                            <thead>
                                            <tr>
                                                <th>Tipo contacto</th>
                                                <th>Nombre contacto</th>
                                                <th>Email</th>
                                                <th>Telefono</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos'></tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- OBSERVACIONES -->
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header"><div><span class="cliente-section-label">NOTAS</span><h3>Observaciones</h3></div></div>
                                    <div class="cliente-panel-body">
                                    <textarea class="form-control form-control-lg st-input"
                                              name="observaciones"
                                              id="observaciones"
                                              rows="4"></textarea>
                                    </div>
                                </div>

                            </div>

                            <!-- ================= DOCUMENTACIÓN ================= -->
                            <div class="tab-pane fade" id="kt_tab_pane_2">

                                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                                <input type='hidden' id='tipoArchivo2' value='{{ $cadenatipocliente }}'>

                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">ARCHIVOS</span><h3>Documentación</h3></div>

                                        <a href="#"
                                           class="btn btn-icon btn-outline-warning btn-sm hrefAgregarOtro2 cliente-add-btn"
                                           data-toggle="tooltip"
                                           title="Agregar archivo">
                                            <i class="flaticon2-plus"></i> <span>Agregar documento</span>
                                        </a>
                                    </div>

                                    <div class="cliente-table-wrapper">
                                        <table class='table table-hover mb-0 cliente-table' id='tblDocumentos2'>
                                            <thead>
                                            <tr>
                                                <th>Adjuntar Documento</th>
                                                <th>Tipo de Documento</th>
                                                <th>Opción</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos2'></tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>
                        </div>

                        <div class="cliente-footer">
                            <div class="cliente-footer-info">
                                <span><i class="flaticon2-information"></i> Verifica la información antes de guardar.</span>
                            </div>
                            <div class="cliente-footer-actions">
                                <button type="button" id="btnGuardar" class="btn btn-warning cliente-btn cliente-btn--save">
                                    <i class="flaticon2-check-mark"></i> Guardar
                                </button>
                                <a href="{{ route('cliente.listadocliente') }}" class="btn btn-secondary cliente-btn cliente-btn--cancel">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
</div>
@endsection
