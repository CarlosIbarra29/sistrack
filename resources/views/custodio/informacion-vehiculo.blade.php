@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/inventario-custodios.css?v=7.1.1') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/custodios/AgregarVehiculo.js?v=1.0.1') }}"></script>
@endpush

@section('title')
    Agregar vehículo del custodio
@endsection

@section('content')


<div class="container-fluid">
    <form action="{{ route('custodio.guardarinfovehiculo') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data" class="cu-asset-page">
        @csrf
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom shadow-sm border-0">
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
                    <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">

                    <div class="card-body">
                        
                        
                        <div class="d-flex justify-content-between align-items-center border-left border-warning cu-asset-header" style="border-left-width:5px !important; padding-left: 20px;">
                            <div>
                                <h2 class="mb-1 font-weight-bold text-white">Registro de vehículo</h2>
                                <span class="text-muted">Complete la información correspondiente del vehículo asignado al custodio</span>
                            </div>
                            <div class="d-flex gap-3 cu-asset-actions">
                                <a href="{{ route('custodio.editarcustodio', $custodio->id) }}" class="btn cu-asset-btn cu-asset-btn-back">
                                    <i class="la la-arrow-left"></i> Regresar
                                </a>
                                <button type="button" id="btnGuardar" class="btn cu-asset-btn cu-asset-btn-save">
                                    <i class="la la-save" aria-hidden="true"></i> Guardar
                                </button>
                            </div>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-warning mb-8">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_3"><i class="flaticon2-car mr-2"></i> Datos del vehículo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_4"><i class="flaticon2-document mr-2"></i> Documentos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_5"><i class="flaticon2-image-file mr-2"></i> Fotografías</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            
                            <div class="tab-pane fade show active" id="kt_tab_pane_3">
                                <h5 class="font-weight-bold mb-3 text-white">Información general</h5>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Fotografía</label>
                                        <input type="file" class="form-control form-control-lg" name="fotografia" id="fotografia" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Marca</label><input type="text" class="form-control form-control-lg" name="vehiculo" id="vehiculo" required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">Modelo</label><input type="text" class="form-control form-control-lg" name="modelo" id="modelo" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Año</label><input type="number" class="form-control form-control-lg" name="year_unidad" id="year_unidad" required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">No. serie</label><input type="text" class="form-control form-control-lg" name="no_serie" id="no_serie" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Placa</label><input type="text" class="form-control form-control-lg" name="placa" id="placa" required/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">Color</label><input type="text" class="form-control form-control-lg" name="color" id="color"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">GPS</label>
                                        <div class="radio-inline mt-2 cu-gps-options">
                                            <label class="radio text-white">
                                                <input type="radio" checked name="gps" value="0"/><span></span> <strong>Sí</strong>
                                            </label>
                                            <label class="radio text-white">
                                                <input type="radio" name="gps" value="1"/><span></span> <strong>No</strong>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label class="text-white">No. GPS</label>
                                        <input type="text" class="form-control form-control-lg" name="no_gps" id="no_gps"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-white">Observaciones</label>
                                    <textarea class="form-control form-control-lg" name="observaciones" id="observaciones" rows="4"></textarea>
                                </div>

                            </div>

                            
                            <div class="tab-pane fade" id="kt_tab_pane_4">

                                <h5 class="font-weight-bold text-white mb-6">Documentación del vehículo</h5>

                                <table class='table' id='tblDocumentos'>

                                    <thead>
                                        <tr>
                                            <th>Adjuntar Documento</th>
                                            <th>Tipo de Documento</th><th>Vigencia</th>
                                            <th width="120">Opción</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id='tbodyDocumentos'></tbody>
                                </table>

                                <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm hrefAgregarOtro"><i class="flaticon2-plus"></i></a>
                            </div>

                            
                            <div class="tab-pane fade" id="kt_tab_pane_5">
                                <h5 class="font-weight-bold text-white mb-6">Fotografías del vehículo</h5>
                                
                                <table class='table' id='tblDocumentosF'>
                                    <thead>
                                        <tr>
                                            <th>Adjuntar Fotografía</th>
                                            <th width="120">Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentosf'></tbody>
                                </table>
                                <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm hrefAgregarOtroF"><i class="flaticon2-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection