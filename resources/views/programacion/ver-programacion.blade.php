@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/programacion/EditarProgramacion.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Programacion
@endsection
@section('content')

<style type="text/css">
    .oculto{
        display: none;
    }
</style>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Programación </h3>
                    <div class="card-toolbar">
                        <span style="font-size: 15px; font-weight: bold; color:red;">Estatus: {{ $programacion->programacionEstatus->estatus_programacion }}</span>
                         <div class="card-toolbar">
                        <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-light-warning font-weight-bold mr-3 ml-3"><i class="flaticon2-back"></i> Regresar</a>
                    </div>
                    </div>
                </div>

                <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">
                
                <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Cliente</label>
                                        @foreach($cliente as $tp)
                                            @if($programacion->cliente_id == $tp->id)
                                                <p>{{ $tp->nombre_cliente }} / {{ $tp->razon_social }}</p>
                                            @endif
                                        @endforeach

                                </div>
                                <div class="col-lg-6">
                                    <label>Fecha y hora de servicio</label>
                                    <div class="input-group">
                                        <p> {{ date('d/m/Y H:i:s', strtotime($programacion->fecha_servicio))}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Tipo de servicio</label>
                                    @if($programacion->tipo_servicio == 0)
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" checked disabled name="tipo_servicio" value="0" />
                                                <span></span>
                                                Foraneo
                                            </label>
                                        </div>
                                    @else
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" checked disabled name="tipo_servicio" value="1" />
                                                <span></span>
                                                Local
                                            </label>
                                        </div>
                                    @endif
                                </div>


                                <div class="col-lg-6">
                                    <label>Tarifario.</label>
                                        @foreach($tarifario as $tp)
                                            @if($programacion->tarifario_id == $tp->id)
                                                <p>Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}</p>
                                            @endif
                                        @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Armado</label>
                                    <div class="radio-inline">
                                        <label class="radio radio-disabled">
                                            <input type="radio" {{($programacion->armado_servicio == 0) ? 'checked' : ''}} disabled name="armado_servicio" />
                                            <span></span> Si
                                        </label>
                                        <label class="radio radio-disabled ml-4">
                                            <input type="radio" {{($programacion->armado_servicio == 1) ? 'checked' : ''}} disabled name="armado_servicio" />
                                            <span></span> No
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Monitoreo</label>
                                    <div class="radio-inline">
                                        <label class="radio radio-disabled">
                                            <input type="radio" {{($programacion->op_monitoreo_id == 1) ? 'checked' : ''}} disabled name="op_monitoreo" />
                                            <span></span> Monitoreo 1
                                        </label>
                                        <label class="radio radio-disabled ml-4">
                                            <input type="radio" {{($programacion->op_monitoreo_id == 2) ? 'checked' : ''}} disabled name="op_monitoreo" />
                                            <span></span> Monitoreo 2
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Domicilio origen</label>
                                    <div class="input-group">
                                        <p>{{ $programacion->dom_origen }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label>Domicilio destino </label>
                                    <div class="input-group">
                                        <p>{{ $programacion->dom_destino }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Folio Interno</label>
                                    <div class="input-group">
                                        <p>{{ $programacion->folio_interno }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Linea Transportista</label>
                                    <div class="input-group">
                                        <p>{{ $programacion->linea_transportista }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Custodio</label>
                                        @foreach($custodio as $tp)
                                            @if($programacion->custodio_id == $tp->id)
                                                <p>{{ $tp->nombre_custodio }} {{ $tp->ap_paterno }} {{ $tp->ap_materno }}</p>
                                            @endif
                                        @endforeach
                                </div>

                                <div class="col-lg-6">
                                    <label>Acompañantes</label>
                                    @if($programacion->acompanantes == 0)
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" {{($programacion->acompanantes == 0) ? 'checked' : ''}} disabled name="op_custodios" id="op_c_uno" value="0" />
                                                <span></span>
                                                Si
                                            </label>
                                        </div>
                                    @else
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" {{($programacion->acompanantes == 1) ? 'checked' : ''}} disabled name="op_custodios" id="op_c_dos" value="1" />
                                                <span></span>
                                                No
                                            </label>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="card card-custom gutter-b {{($programacion->acompanantes == 1) ? 'oculto' : ''}}" id="div_custodios" style="background-color:  #f1f1f1;"  >
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Acompañantes
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row form-group" >
                                        <div class="col-lg-12" id="tblArchivos">
                                            <table class='table table-bordered table-hover' id='tblDocumentos'>
                                                <thead>
                                                <tr>
                                                    <th>Custodio</th>
                                                </tr>
                                                </thead>
                                                <tbody id='tbodyDocumentos'>
                                                    @foreach($acompanantes_pro as $documento)
                                                        <tr id="trDocumento{{ $documento->id }}">
                                                            <td>{{ $documento->custodio->nombre_custodio}} {{ $documento->custodio->ap_paterno}} {{ $documento->custodio->ap_materno}}</td>

                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Observaciones</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-checkable" id="kdatatable_observaciones">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Observacion</th>
                                        <th>Fecha y hora</th>
                                        <th>Responsable</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($observaciones as $unid)
                                    <tr>
                                      <td>{{ $unid->id }}</td>
                                      <td>{{ $unid->observacion }}</td>
                                      <td>{{ date('d/m/Y  h:i  A' , strtotime( $unid->created_at)) }}</td>
                                      <td>{{ $unid->userCreated->name }}</td>
                                      <td class="text-center">
                                        <button class="btn btn-sm btn-outline-success btn-icon mt-2" onClick="editpobservacion('{{$unid->id}}', '{{$unid->observacion }}')" data-toggle="modal" data-target="#model_add_incidencia" title="Editar">
                                               <i class="flaticon-edit"></i>
                                        </button>
                                        <button class="btn btn-clean btn-icon btn-outline-success mt-1 eliminar-observacion" data-id="{{ $unid->id }}" data-nombre="{{ $unid->observacion }}" title="Eliminar"><i class="flaticon-delete"></i></button>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                        </div>
                    </div>

                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Incidencias</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-checkable" id="kdatatable_incidenciass">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Incidencia</th>
                                        <th>Fecha y hora</th>
                                        <th>Responsable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($incidencias as $unid)
                                    <tr>
                                      <td>{{ $unid->id }}</td>
                                      <td>{{ $unid->incidencia }}</td>
                                      <td>{{ date('d/m/Y  h:i  A' , strtotime( $unid->created_at)) }}</td>
                                      <td>{{ $unid->userCreated->name }}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div> <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <a href="{{ route('programacion.listadoprogramacion') }}"  class="btn btn-warning">Regresar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post" id="observacion_delete_form" action="{{ route('programacion.eliminarobservacion') }}">
        @csrf
        <input type="hidden" name="id" id="id_observacion_delete" value="">
        <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
    </form>

    <div class="modal fade" tabindex="-1" role="dialog" id="model_add_incidencia">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Observaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('programacion.editarobservacion') }}" method="post" id="submit_edit_observacion">
                        @csrf
                        <div class="form-group">
                            <label>Observación</label>
                            <textarea class="form-control" name="observacion" id="observacion_id"></textarea>
                            <input type="hidden" name="id" id="id_observacion">
                            <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="edit_observacion" class="btn btn-warning">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection