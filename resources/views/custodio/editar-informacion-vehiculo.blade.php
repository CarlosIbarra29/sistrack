@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/inventario-custodios.css?v=7.1.1') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/custodios/EditarVehiculo.js?v=1.0.2') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Editar custodio
@endsection

@section('content')

    <input type="hidden" id="documentoEliminarPath" value="{{ route('custodio.eliminardocumentovehiculo') }}">
    <input type="hidden" id="fotografiaEliminarPath" value="{{ route('custodio.eliminarfotografia') }}">
                    <!--begin::Form-->
    <form action="{{ route('custodio.editinfovehiculo') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data" class="cu-asset-page">
    @csrf
    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
    <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">

    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center cont-title-forms rounded shadow-sm px-6 py-5 border-left border-warning cu-asset-header" style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold title-forms text-white">Editar Registro de vehículo</h2>
                    <span class="text-muted">Complete la información correspondiente del vehículo asignado al custodio</span>
                </div>

                <div class="cu-asset-actions">
                <a href="{{ route('custodio.editarcustodio', $custodio->id) }}" class="btn cu-asset-btn cu-asset-btn-back">
                    <i class="la la-arrow-left"></i> Regresar
                </a>

                <button type="button"  id="btnGuardar" class="btn cu-asset-btn cu-asset-btn-save"><i class="la la-save" aria-hidden="true"></i> Guardar</button>
                </div>

            </div>
        </div>
    </div>



    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom">

                <div class="card-body">
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

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active cu-asset-edit-layout" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">

                                <div class="form-group row cu-asset-media-row">
                                    <div class="col-lg-6">
                                        <div class="cu-asset-photo cu-asset-photo-premium">
                                            <img src="{{ route('archivo.documentovehiculoficha', $vehiculo->id) }}" alt="Fotografía actual del vehículo">
                                            <div class="cu-asset-photo-caption"><i class="la la-check-circle" aria-hidden="true"></i><span>Fotografía registrada</span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">Fotografía</label>
                                        <input type="file" class="form-control form-control-lg" name="fotografia" id="fotografia"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Marca</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="vehiculo" id="vehiculo" value="{{ $vehiculo->vehiculo }}" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">Modelo</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="modelo" id="modelo" value="{{ $vehiculo->modelo }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Año</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="year_unidad" id="year_unidad" value="{{ $vehiculo->year_unidad }}" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">No. serie</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="no_serie" id="no_serie" value="{{ $vehiculo->no_serie }}" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">Placa</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="placa" id="placa" value="{{ $vehiculo->placa }}" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">Color</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="color" value="{{ $vehiculo->color }}" id="color"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="text-white">GPS</label>
                                        <div class="radio-inline cu-gps-options">
                                            <label class="radio">
                                                <input type="radio"  name="gps" value="0" {{($vehiculo->gps == 0) ? 'checked' : ''}}/>
                                                <span></span>
                                                <strong>Sí</strong></label>
                                            <label class="radio">
                                                <input type="radio" name="gps" value="1" {{($vehiculo->gps == 1) ? 'checked' : ''}}/>
                                                <span></span>
                                                <strong>No</strong></label>
                                        </div> 
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="text-white">No. gps</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="no_gps" id="no_gps" value="{{ $vehiculo->no_gps }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label for="observaciones" class="text-white">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{ $vehiculo->observaciones }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade mt-10" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                                <table class="table  mb-6 table-responsive-sm" id="tblDocumentos">
                                    <thead>
                                    <tr>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Tipo de Documento</th>
                                        <th>Vigencia</th>
                                        <th scope="col">Opción</th>
                                    </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentos'>
                                        @foreach($docvehiculo as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td><a href="{{ route('archivo.documentovehiculo', ['id'=>$documento->id]) }}" class="link-primary" target="_blank"> {{ $documento->documento }} </a></td>
                                                <td>{{ $documento->custodioDocumentacionVehiculo->tipo_documento_vehiculo }}</td>
                                                
                                                <td>
                                                    @php
                                                        $fechaVigencia = $documento->vigencia ? \Carbon\Carbon::parse($documento->vigencia)->startOfDay() : null;
                                                        $hoy = \Carbon\Carbon::today();
                                                        $diasRestantes = $fechaVigencia ? $hoy->diffInDays($fechaVigencia, false) : null;
                                                    @endphp

                                                    @if(!$fechaVigencia)
                                                        <span class="cu-doc-badge cu-doc-none">
                                                            <i class="la la-infinity"></i>
                                                            Sin vencimiento
                                                        </span>
                                                    @elseif($diasRestantes < 0)
                                                        <span class="cu-doc-badge cu-doc-expired">
                                                            <i class="la la-times-circle"></i>
                                                            {{ $fechaVigencia->format('d/m/Y') }}
                                                            <small>Documento vencido</small>
                                                        </span>
                                                    @elseif($diasRestantes <= 10)
                                                        <span class="cu-doc-badge cu-doc-warning">
                                                            <i class="la la-exclamation-triangle"></i>
                                                            {{ $fechaVigencia->format('d/m/Y') }}
                                                            <small>Documento por vencer</small>
                                                        </span>
                                                    @else
                                                        <span class="cu-doc-badge cu-doc-valid">
                                                            <i class="la la-check-circle"></i>
                                                            {{ $fechaVigencia->format('d/m/Y') }}
                                                            <small>Documento vigente</small>
                                                        </span>
                                                    @endif
                                                </td>

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


                            <div class="tab-pane fade mt-10" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">


                                <div class="cu-gallery-section">
                                    <div class="cu-gallery-heading">
                                        <div>
                                            <h3><i class="la la-images"></i> Galería del vehículo</h3>
                                            <p>Consulta las fotografías registradas del vehículo.</p>
                                        </div>

                                        <span class="cu-gallery-count">
                                            {{ $fotografias->count() }} fotografía(s)
                                        </span>
                                    </div>

                                    @if($fotografias->count() > 0)
                                        <div class="cu-gallery-grid" id="cuGaleriaFotografias">
                                            @foreach($fotografias as $documento)
                                                <div class="cu-gallery-card" id="cuGalleryPhoto{{ $documento->id }}">
                                                    <a href="#" class="cu-gallery-preview" data-preview-url="{{ route('archivo.fotografiavehiculo', ['id' => $documento->id]) }}" data-preview-title="{{ $documento->fotografia }}" title="Ver fotografía">

                                                        <img src="{{ route('archivo.fotografiavehiculo', ['id' => $documento->id]) }}" alt="Fotografía del vehículo" loading="lazy">

                                                        <span class="cu-gallery-overlay">
                                                            <i class="la la-search-plus"></i>
                                                            Ver fotografía
                                                        </span>
                                                    </a>

                                                    <div class="cu-gallery-card-footer">
                                                        <span title="{{ $documento->fotografia }}">
                                                            <i class="la la-image"></i>
                                                            {{ $documento->fotografia }}
                                                        </span>

                                                        <i class="la la-check-circle cu-gallery-check"></i>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="cu-gallery-empty">
                                            <i class="la la-images"></i>
                                            <span>Aún no hay fotografías registradas.</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="modal fade cu-gallery-modal" id="cuGaleriaModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="cu-gallery-modal-header">
                                                <span id="cuGaleriaModalTitulo">Vista previa</span>
                                                <button type="button" data-dismiss="modal" aria-label="Cerrar">
                                                    <i class="la la-times"></i>
                                                </button>
                                            </div>

                                            <div class="cu-gallery-modal-body">
                                                <img id="cuGaleriaModalImagen" src="" alt="Fotografía ampliada">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <table class="table mb-6 table-responsive-sm" id="tblDocumentosF">
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

                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->

@endsection