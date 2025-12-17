@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush

@section('title')
    Agregar cliente
@endsection

@section('content')
<style>
    
    .form-control-solid { background-color: #F3F6F9; border-color: transparent; font-weight: 500; }
    .form-control-solid:focus { background-color: #EBEDF3; border-color: transparent; }
    label { font-weight: 600 !important; color: #3F4254 !important; margin-bottom: 0.5rem; }
    .separator.separator-dashed { border-bottom: 1px dashed #EBEDF3; }
    .card-title-custom { font-size: 1.2rem; font-weight: 700; color: #181C32; }
    .table thead th { background-color: #F3F6F9; border-top: 0 !important; color: #B5B5C3 !important; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.1rem; }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Agregar Cliente
                    
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('cliente.listadocliente') }}" class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" title="Salir">
                        <i class="flaticon2-reply"></i> Regresar
                    </a>
                </div>
            </div>

            <form action="{{ route('cliente.guardarcliente') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x nav-tabs-primary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                                <i class="flaticon2-user mr-2"></i> Información del Cliente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                                <i class="flaticon2-file mr-2"></i> Documentación
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-8" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            
                            <div class="row mb-6">
                                <div class="col-lg-4">
                                    <label>Razón social <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid" name="razon_social" id="razon_social" required placeholder="Nombre legal"/>
                                </div>
                                <div class="col-lg-4">
                                    <label>Nombre comercial / Cliente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid" name="cliente" id="cliente" required placeholder="Nombre común"/>
                                </div>
                                <div class="col-lg-4">
                                    <label>Grupo</label>
                                    <input type="text" class="form-control form-control-solid" name="grupo" id="grupo" placeholder="Si pertenece a un corporativo"/>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>

                            <h4 class="card-title-custom mb-6">Información Técnica</h4>
                            <div class="row mb-6">
                                <div class="col-lg-3">
                                    <label>Días de Crédito</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-solid" name="dias_credito" id="dias_credito" />
                                        <div class="input-group-append"><span class="input-group-text">días</span></div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo de estadía</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" class="form-control form-control-solid" name="costo_estadia" id="costo_estadia" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo km extraordinario</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" class="form-control form-control-solid" name="costo_km" id="costo_km" />
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <label>Estadía no armada</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                        <input type="text" class="form-control form-control-solid" name="costo_estadia_armada" id="costo_estadia_armada" />
                                    </div>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-10"></div>

                            <div class="d-flex align-items-center justify-content-between mb-6">
                                <h4 class="card-title-custom">Contactos Operativos</h4>
                                <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder hrefAgregarOtro">
                                    <i class="flaticon2-plus"></i> Agregar Contacto
                                </button>
                            </div>

                           
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="tblDocumentos">
                                    <thead>
                                        <tr>
                                            <th>Tipo contacto</th>
                                            <th>Nombre contacto</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th class="text-right">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentos">
                                        </tbody>
                                </table>
                            </div>

                            <div class="row mt-10">
                                <div class="col-lg-12">
                                    <label for="observaciones">Observaciones adicionales</label>
                                    <textarea class="form-control form-control-solid" name="observaciones" id="observaciones" rows="3" placeholder="Notas o detalles importantes..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade mt-5" id="kt_tab_pane_2" role="tabpanel">
                            <div class="d-flex align-items-center justify-content-between mb-6">
                                <h4 class="card-title-custom">Expediente Digital</h4>
                                <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder hrefAgregarOtro2">
                                    <i class="flaticon2-plus"></i> Adjuntar Documento
                                </button>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="tblDocumentos2">
                                    <thead>
                                        <tr>
                                            <th>Archivo</th>
                                            <th>Tipo de Documento</th>
                                            <th class="text-right">Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentos2">
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('cliente.listadocliente') }}" class="btn btn-secondary font-weight-bold">Cancelar</a>
                    <button type="button" id="btnGuardar" class="btn btn-warning font-weight-bold px-10">
                        <i class="flaticon2-check-mark"></i> Guardar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection