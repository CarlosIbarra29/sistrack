@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/custodios/AgregarVehiculo.js') }}"></script>
@endpush
@section('title')
    Agregar vehiculo del custodio
@endsection
@section('content')

        <!--begin::Card-->
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <h3 class="card-title">Agregar información vehículo</h3>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('custodio.guardarinfovehiculo') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data">
                        @csrf

                        <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                        <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
                        <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">
                        <div class="card-body">

                            <ul class="nav nav-tabs nav-tabs-line">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_3">Datos del vehículo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Documentos del vehículo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Fotografias</a>
                                </li>
                            </ul>

                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade show active mt-10" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Marca</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="vehiculo" id="vehiculo" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Modelo</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="modelo" id="modelo" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Año</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="year_unidad" id="year_unidad"  required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>No. serie</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="no_serie" id="no_serie" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Placa</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="placa" id="placa" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Color</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="color" id="color"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>GPS</label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" checked name="gps" value="0" />
                                                    <span></span>
                                                    Si
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="gps" value="1" />
                                                    <span></span>
                                                    No
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <label>No. gps</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="no_gps" id="no_gps"/>
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