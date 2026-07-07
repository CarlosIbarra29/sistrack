@extends('layouts.app')

@section('title')
    Catálogo de documentación vehículo
@endsection

@push('scripts')
    <script src="{{ asset('js/catalogos/custodios/CatalogoDocumentacionVehiculo.js') }}"></script> 
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="card bg-dark text-white shadow-sm border-0 rounded-lg">
        
        <div class="card-header border-bottom border-secondary d-flex flex-wrap align-items-center justify-content-between gap-3 py-4">
            <div class="d-flex align-items-center gap-2">
                <span class="p-2 bg-soft-warning rounded">
                    <i class="flaticon2-file text-warning fs-4"></i>
                </span>
                <h3 class="card-title h5 mb-0 fw-bold text-white tracking-wide">
                    Inventario de Documentación del Vehículo
                </h3>
            </div>
            
            <div class="d-flex flex-wrap align-items-center gap-2">
                <a class="btn btn-sm btn-outline-secondary font-weight-bold busqueda" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="la la-search mr-1"></i> Búsqueda
                </a>

                <a href="#" class="btn btn-sm btn-warning font-weight-bolder text-dark" data-toggle="modal" data-target="#kt_modal_1">
                    <i class="la la-plus mr-1"></i> Nuevo
                </a>

                <a href="{{ route('docvehiculo.catalogodocvehiculoinactivos') }}" class="btn btn-sm btn-outline-danger font-weight-bolder">
                    <i class="far fa-trash-alt mr-1"></i> Documentación Inactiva
                </a>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-sm btn-light font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="la la-download mr-1"></i> Exportar
                    </button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right shadow-sm border-0">
                        <ul class="navi flex-column navi-hover py-2 list-unstyled mb-0">
                            <li class="navi-item">
                                <a href="#" class="navi-link d-flex align-items-center px-4 py-2 text-dark text-decoration-none" id="export-excel">
                                    <i class="la la-file-excel-o text-success mr-2 fs-5"></i>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link d-flex align-items-center px-4 py-2 text-dark text-decoration-none" id="export-csv">
                                    <i class="la la-file-text-o text-info mr-2 fs-5"></i>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link d-flex align-items-center px-4 py-2 text-dark text-decoration-none" id="export-print">
                                    <i class="la la-print text-primary mr-2 fs-5"></i>
                                    <span class="navi-text">Imprimir</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-4">
            
            <div class="collapse mb-4" id="collapseExample">
                <div class="card bg-secondary text-white border-0 p-4 rounded">
                    <form class="mb-0">
                        <div class="row align-items-end">
                            <div class="col-lg-6 mb-3 mb-lg-0">
                                <label class="form-label text-light small fw-bold">Nombre del documento:</label>
                                <input type="text" class="form-control bg-dark text-white border-secondary datatable-input" data-col-index="1" placeholder="Ej. Tarjeta de circulación..." />
                            </div>
                            <div class="col-lg-6 d-flex gap-2">
                                <button class="btn btn-warning text-dark px-4" id="kt_search">
                                    <i class="la la-search mr-1"></i> Buscar
                                </button>
                                <button class="btn btn-outline-light px-4" id="kt_reset" type="button">
                                    <i class="la la-close mr-1"></i> Limpiar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle border-secondary mb-0" id="kdatatable_documentoscustodio">
                    <thead class="table-light text-dark fw-bold uppercase tracking-wider">
                        <tr>
                            <th scope="col" class="py-3" style="width: 10%">No.</th>
                            <th scope="col" class="py-3" style="width: 70%">Documento</th>
                            <th scope="col" class="py-3 text-center" style="width: 20%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        </tbody>
                </table>
            </div>
            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
            <input type="hidden" id="documentocustdatatable" value="{{ route('docvehiculo.vehiculodatatable') }}">
        </div>
        </div>
    </div>

{{-- M O D A L S --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="kt_modal_1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title fw-bold">Agregar documentación</h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('docvehiculo.guardardocumentovehiculo') }}" method="post" id="submit_documento">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-light small">Nombre del documento</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" name="documento" id="documento" required autocomplete="off"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Cancelar</button>
                <button type="button" id="send_documento" class="btn btn-sm btn-warning text-dark">Guardar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_edit_tipodocumento">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-secondary">
            <div class="modal-header border-secondary">
                <h5 class="modal-title fw-bold">Editar documentación</h5>
                <button type="button" class="btn-close btn-close-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('docvehiculo.editardocumentovehiculo') }}" method="post" id="submit_documentoedit_edit">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-light small">Nombre del documento</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" name="documento" id="tipo_documento" required autocomplete="off"/>
                    </div>
                    <input type="hidden" name="id_documento" id="id_documento" value="">
                </form> 
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-sm btn-outline-light" data-dismiss="modal">Cancelar</button>
                <button type="button" id="edit_tipodocumento_submit" class="btn btn-sm btn-warning text-dark">Guardar</button>
            </div>
        </div>
    </div>
</div>

<form method="post" id="tipodocumento_delete_form" action="{{ route('docvehiculo.desactivardocumentovehiculo') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_documento_delete" value="">
</form>
@endsection