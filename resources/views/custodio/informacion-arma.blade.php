@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/custodios/AgregarArma.js') }}"></script>
@endpush
@section('title')
    Agregar arma del custodio
@endsection
@section('content')

        <!--begin::Card-->
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <h3 class="card-title">Agregar información del arma</h3>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('custodio.guardarinfoarma') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data">
                        @csrf

                        <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                        <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
                        <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">
                        <div class="card-body">

                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_3">Datos del arma</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Documentos del arma</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Fotografias</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade show active mt-10" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>No. Registro</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="registro_arma" id="registro_arma" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Vigencia de portación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="vigencia_portacion" id="vigencia_portacion" readonly required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea class="form-control" name="observaciones" id="observaciones" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade mt-10" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                                 <div class="row form-group" >
                                        <div class="col-lg-12" id="tblArchivos">
                                            <table class='table table-bordered table-hover' id='tblDocumentos'>
                                                <thead>
                                                <tr>
                                                    <th>Adjuntar Documento</th>
                                                    <th>Tipo de Documento</th>
                                                    <th>Opción</th>
                                                </tr>
                                                </thead>
                                                <tbody id='tbodyDocumentos'>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade mt-10" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                                 <div class="row form-group" >
                                        <div class="col-lg-12" id="tblArchivosf">
                                            <table class='table table-bordered table-hover' id='tblDocumentosF'>
                                                <thead>
                                                <tr>
                                                    <th>Adjuntar Fotografia</th>
                                                    <th>Opción</th>
                                                </tr>
                                                </thead>
                                                <tbody id='tbodyDocumentosf'>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtroF" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                    <a href="{{ route('custodio.listadocustodio') }}"  class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Card-->

@endsection