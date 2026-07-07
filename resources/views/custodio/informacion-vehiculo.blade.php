@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/custodios/AgregarVehiculo.js') }}"></script>
@endpush

@section('title')
    Agregar vehiculo del custodio
@endsection

@section('content')

<div class="container-fluid px-6">

                <form action="{{ route('custodio.guardarinfovehiculo') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data">
                    @csrf

    <!-- ENCABEZADO -->

    <div class="row mb-6">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center cont-title-forms rounded shadow-sm px-6 py-5 border-left border-warning" style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold title-forms text-white">Registro de vehículo</h2>
                    <span class="text-muted">Complete la información correspondiente del vehículo asignado al custodio</span>
                </div>

                <a href="{{ route('custodio.editarcustodio', $custodio->id) }}" class="btn btn-outline-warning font-weight-bold">
                    <i class="flaticon2-back"></i> Regresar
                </a>

                <button type="button"  id="btnGuardar" class="btn btn-outline-warning">Guardar</button>

            </div>
        </div>
    </div>




    <!-- CARD PRINCIPAL -->
    <div class="row custom-full-width">
        <div class="col-12">
            <div class="card card-custom shadow-sm border-0">


                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
                    <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">

                    <div class="card-body px-10 py-8">

                        <!-- TABS -->
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-warning mb-8">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_3">
                                    <i class="flaticon2-car mr-2"></i> Datos del vehículo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_4">
                                    <i class="flaticon2-document mr-2"></i> Documentos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_5">
                                    <i class="flaticon2-image-file mr-2"></i> Fotografías
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- DATOS VEHÍCULO -->
                            <div class="tab-pane fade show active" id="kt_tab_pane_3">
                                <div class=" rounded p-6 mb-6 ">
                                    <h5 class="font-weight-bold mb-6 text-white">Información general</h5>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="text-white">Fotografia</label>
                                            <input type="file" class="form-control form-control-lg" name="fotografia" id="fotografia" required/>
                                        </div>

                                    </div>


                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="text-white">Marca</label>
                                            <input type="text" class="form-control form-control-lg" name="vehiculo" id="vehiculo" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="text-white">Modelo</label>
                                            <input type="text" class="form-control form-control-lg" name="modelo" id="modelo" required/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="text-white">Año</label>
                                            <input type="number" class="form-control form-control-lg" name="year_unidad" id="year_unidad" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="text-white">No. serie</label>
                                            <input type="text" class="form-control form-control-lg" name="no_serie" id="no_serie" required/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="text-white">Placa</label>
                                            <input type="text" class="form-control form-control-lg" name="placa" id="placa" required/>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="text-white">Color</label>
                                            <input type="text" class="form-control form-control-lg" name="color" id="color"/>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="text-white">GPS</label>
                                            <div class="radio-inline mt-2">
                                                <label class="radio mr-6">
                                                    <input type="radio" checked name="gps" value="0"/>
                                                    <span></span> Si
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="gps" value="1"/>
                                                    <span></span> No
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
                            </div>

                            <!-- DOCUMENTOS -->
                            <div class="tab-pane fade" id="kt_tab_pane_4">
                                <div class=" rounded p-6 ">
                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <h5 class="font-weight-bold text-white mb-0">Documentación del vehículo</h5>
{{--                                         <a href="#" class="btn btn-outline-success btn-sm hrefAgregarOtro">
                                            <i class="flaticon2-plus"></i> Agregar
                                        </a> --}}
                                    </div>
                                    <div class="row form-group" >
                                        <div class="col-lg-12">
                                            <table class='table table-responsive' id='tblDocumentos'>
                                                <thead>
                                                    <tr>
                                                        <th>Adjuntar Documento</th>
                                                        <th>Tipo de Documento</th>
                                                        <th>Vigencia</th>
                                                        <th width="120">Opción</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='tbodyDocumentos'></tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <!-- FOTOGRAFÍAS -->
                            <div class="tab-pane fade" id="kt_tab_pane_5">
                                <div class="rounded p-6">
                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <h5 class="font-weight-bold text-white mb-0">Fotografías del vehículo</h5>
{{--                                         <a href="#" class="btn btn-outline-success btn-sm hrefAgregarOtroF">
                                            <i class="flaticon2-plus"></i> Agregar
                                        </a> --}}
                                    </div>

                                    <div class="table-responsive">
                                        <table class='table table-hover mb-6 table-responsive-sm' id='tblDocumentosF'>
                                            <thead class="">
                                                <tr>
                                                    <th>Adjuntar Fotografía</th>
                                                    <th width="120">Opción</th>
                                                </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentosf'></tbody>
                                        </table>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm mr-2 hrefAgregarOtroF" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

{{--                     <!-- FOOTER -->
                    <div class="card-footer bg-white border-top text-right">
                        <button type="button" id="btnGuardar" class="btn btn-warning font-weight-bold px-8">
                            <i class="flaticon2-check-mark"></i> Guardar
                        </button>

                    </div>
 --}}
                </form>

            </div>
        </div>
    </div>

</div>

@endsection
