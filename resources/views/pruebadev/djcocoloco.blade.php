@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush
@section('title', 'Agregar cliente')
@section('content')

<style>
    .form-control-solid { background-color: #F3F6F9; border-color: transparent; font-weight: 500; }
    .form-control-solid:focus { background-color: #EBEDF3; border-color: transparent; }
    label { font-weight: 600; color: #3F4254; margin-bottom: .5rem; }
    .separator.separator-dashed { border-bottom: 1px dashed #EBEDF3; }
    .card-title-custom { font-size: 1.1rem; font-weight: 700; color: #181C32; }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            {{-- HEADER --}}
            <div class="card-header border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Agregar Cliente</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('cliente.listadocliente') }}" class="btn btn-light-danger btn-sm font-weight-bold">
                        <i class="flaticon2-reply"></i> Regresar
                    </a>
                </div>
            </div>

            <form action="{{ route('cliente.guardarcliente') }}" method="POST" id="submit_cliente" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    {{-- TABS --}}
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-primary">
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

                    <div class="tab-content mt-8">
                        {{-- TAB 1: INFORMACIÓN --}}
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            
                            <div class="row mb-6">
                                <div class="col-lg-4">
                                    <label>Razón social <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid" name="razon_social" id="razon_social" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Nombre comercial / Cliente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid" name="cliente" id="cliente" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Grupo</label>
                                    <input type="text" class="form-control form-control-solid" name="grupo" id="grupo">
                                </div>
                            </div>

                            <div class="separator separator-dashed my-8"></div>

                            <h4 class="card-title-custom mb-4"><i class="flaticon2-gear text-primary mr-2"></i> Información Técnica</h4>
                            <div class="row mb-6">
                                <div class="col-lg-3">
                                    <label>Días de crédito</label>
                                    <input type="number" class="form-control form-control-solid" name="dias_credito" id="dias_credito">
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo estadía</label>
                                    <input type="text" class="form-control form-control-solid" name="costo_estadia" id="costo_estadia">
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo km extraordinario</label>
                                    <input type="text" class="form-control form-control-solid" name="costo_km" id="costo_km">
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo estadía no armada</label>
                                    <input type="text" class="form-control form-control-solid" name="costo_estadia_armada" id="costo_estadia_armada">
                                </div>
                            </div>

                            <div class="separator separator-dashed my-8"></div>

                            {{-- CONTACTO OPERATIVO --}}
                            <h4 class="card-title-custom mb-4"><i class="flaticon2-avatar text-primary mr-2"></i> Contacto Operativo</h4>
                            <input type='hidden' id='tipoArchivo2' value='{{ $cadenatipocliente }}'>
                            
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="tblDocumentos">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Tipo contacto</th>
                                                    <th>Nombre contacto</th>
                                                    <th>Email</th>
                                                    <th>Teléfono</th>
                                                    <th style="width: 50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyDocumentos"></tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder hrefAgregarOtro">
                                        <i class="flaticon2-plus"></i> Agregar Contacto Operativo
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="col-lg-12">
                                    <label>Observaciones</label>
                                    <textarea class="form-control form-control-solid" name="observaciones" id="observaciones" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 2: DOCUMENTOS --}}
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            <h4 class="card-title-custom mb-4"><i class="flaticon2-copy text-primary mr-2"></i> Documentación del Cliente</h4>
                            <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="tblDocumentos2">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Adjuntar Documento</th>
                                                    <th>Tipo de Documento</th>
                                                    <th style="width: 50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyDocumentos2"></tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-light-warning font-weight-bolder hrefAgregarOtro2">
                                        <i class="flaticon2-plus"></i> Agregar Documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('cliente.listadocliente') }}"  class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>