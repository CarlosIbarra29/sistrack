@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/custodios/EditarVehiculo.js') }}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Editar custodio
@endsection
@section('content')

	<input type="hidden" id="documentoEliminarPath" value="{{ route('custodio.eliminardocumentovehiculo') }}">
    <input type="hidden" id="fotografiaEliminarPath" value="{{ route('custodio.eliminarfotografia') }}">

        <!--begin::Card-->
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <h3 class="card-title">Agregar información vehículo</h3>
                    </div>
                    <!--begin::Form-->
                    <form action="{{ route('custodio.editinfovehiculo') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" name="vehiculo" id="vehiculo" value="{{ $vehiculo->vehiculo }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Modelo</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="modelo" id="modelo" value="{{ $vehiculo->modelo }}" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Año</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="year_unidad" id="year_unidad" value="{{ $vehiculo->year_unidad }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>No. serie</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="no_serie" id="no_serie" value="{{ $vehiculo->no_serie }}" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Placa</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="placa" id="placa" value="{{ $vehiculo->placa }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Color</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="color" value="{{ $vehiculo->color }}" id="color"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>GPS</label>
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio"  name="gps" value="0" {{($vehiculo->gps == 0) ? 'checked' : ''}}/>
                                                    <span></span>
                                                    Si
                                                </label>
                                                <label class="radio">
                                                    <input type="radio" name="gps" value="1" {{($vehiculo->gps == 1) ? 'checked' : ''}}/>
                                                    <span></span>
                                                    No
                                                </label>
                                            </div> 
                                        </div>
                                        <div class="col-lg-6">
                                            <label>No. gps</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="no_gps" id="no_gps" value="{{ $vehiculo->no_gps }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-12">
                                            <label for="observaciones">Observaciones</label>
                                            <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{ $vehiculo->observaciones }}</textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade mt-10" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
									<table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentos">
									    <thead>
									    <tr>
									        <th scope="col">Documento</th>
									        <th scope="col">Tipo de Documento</th>
									        <th scope="col">Opción</th>
									    </tr>
									    </thead>
									    <tbody id='tbodyDocumentos'>
									        @foreach($docvehiculo as $documento)
									            <tr id="trDocumento{{ $documento->id }}">
									                <td><a href="{{ route('archivo.documentovehiculo', ['id'=>$documento->id]) }}" class="link-primary" target="_blank"> {{ $documento->documento }} </a></td>
									                <td>{{ $documento->custodioDocumentacionVehiculo->tipo_documento_vehiculo }}</td>
									                <td>
									                    <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarDocumento' data-id='{{ $documento->id }}' data-documento='{{ $documento->documento }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
									                        <i class='flaticon-delete'></i>
									                    </a>
									                </td>
									            </tr>
									        @endforeach
									    </tbody>
									</table>

									<div class="row form-group">
									    <div class="col-lg-12">
									        <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
									            <i class="flaticon2-plus"></i>
									        </a>
									    </div>
									</div>
                                </div>


                                <div class="tab-pane fade mt-10" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_4">
									<table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentosF">
									    <thead>
									    <tr>
									        <th scope="col">Fotografía</th>
									        <th scope="col">Opción</th>
									    </tr>
									    </thead>
									    <tbody id='tbodyDocumentosF'>
									        @foreach($fotografias as $documento)
									            <tr id="trFotografia{{ $documento->id }}">
									                <td><a href="{{ route('archivo.fotografiavehiculo', ['id'=>$documento->id]) }}" class="link-primary" target="_blank"> {{ $documento->fotografia }} </a></td>
									                <td>
									                    <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarFotografia' data-id='{{ $documento->id }}' data-documento='{{ $documento->fotografia }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
									                        <i class='flaticon-delete'></i>
									                    </a>
									                </td>
									            </tr>
									        @endforeach
									    </tbody>
									</table>

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