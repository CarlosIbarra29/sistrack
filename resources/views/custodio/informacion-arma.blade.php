@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/custodios/AgregarArma.js') }}"></script>
@endpush

@section('title')
    Agregar arma del custodio
@endsection

@section('content')

<div class="container-fluid">

    <!-- ENCABEZADO FORMAL -->
    <div class="row mb-6">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded shadow-sm px-6 py-5 border-left border-warning" style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold text-dark">Registro de arma</h2>
                    <span class="text-muted">Complete la información correspondiente del arma asignada</span>
                </div>
                <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-outline-warning font-weight-bold">
                    <i class="flaticon2-back"></i> Regresar
                </a>
            </div>
        </div>
    </div>

    <!-- CARD PRINCIPAL -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom shadow-sm border-0">

                <form action="{{ route('custodio.guardarinfoarma') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data">
                    @csrf

                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
                    <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">

                    <div class="card-body px-10 py-8">

                        <!-- TABS ESTILIZADAS -->
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-warning mb-8">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_3">
                                    <i class="flaticon2-file mr-2"></i> Datos del arma
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_4">
                                    <i class="flaticon2-document mr-2"></i> Documentos del arma
                                </a>
                            </li>
                            <li class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_5">
                                    <i class="flaticon2-image-file mr-2"></i> Fotografías
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- ================= DATOS DEL ARMA ================= -->
                            <div class="tab-pane fade show active" id="kt_tab_pane_3">

                                <div class="bg-light rounded p-6 mb-8 border">
                                    <h5 class="font-weight-bold text-dark mb-6">Información general</h5>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="font-weight-bold">No. Registro</label>
                                            <input type="text" class="form-control form-control-lg" name="registro_arma" id="registro_arma" required/>
                                        </div>

                                        <div class="col-lg-6">
                                            <label class="font-weight-bold">Vigencia de portación</label>
                                            <input type="text" class="form-control form-control-lg bg-white" name="vigencia_portacion" id="vigencia_portacion" readonly required/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-weight-bold">Observaciones</label>
                                        <textarea class="form-control form-control-lg" name="observaciones" id="observaciones" rows="4"></textarea>
                                    </div>
                                </div>

                            </div>

                            <!-- ================= DOCUMENTOS ================= -->
                            <div class="tab-pane fade" id="kt_tab_pane_4">

                                <div class="bg-light rounded p-6 mb-8 border">

                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <h5 class="font-weight-bold text-dark mb-0">Documentación del arma</h5>
                                        <a href="#" class="btn btn-outline-success btn-sm hrefAgregarOtro" data-toggle="tooltip" title="Agregar archivo">
                                            <i class="flaticon2-plus"></i> Agregar
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class='table table-head-custom table-bordered table-hover' id='tblDocumentos'>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Adjuntar Documento</th>
                                                    <th>Tipo de Documento</th>
                                                    <th width="120">Opción</th>
                                                </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos'></tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                            <!-- ================= FOTOGRAFÍAS ================= -->
                            <div class="tab-pane fade" id="kt_tab_pane_5">

                                <div class="bg-light rounded p-6 border">

                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <h5 class="font-weight-bold text-dark mb-0">Fotografías del arma</h5>
                                        <a href="#" class="btn btn-outline-success btn-sm hrefAgregarOtroF" data-toggle="tooltip" title="Agregar fotografía"><i class="flaticon2-plus"></i> Agregar
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class='table table-head-custom table-bordered table-hover' id='tblDocumentosF'>
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Adjuntar Fotografía</th>
                                                    <th width="120">Opción</th>
                                                </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentosf'></tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="card-footer bg-white border-top">
                        <div class="text-right">
                            <button type="button" id="btnGuardar" class="btn btn-warning font-weight-bold px-8">
                                Guardar
                            </button>
                            <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-secondary font-weight-bold px-8">
                                Cancelar
                            </a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

@endsection
