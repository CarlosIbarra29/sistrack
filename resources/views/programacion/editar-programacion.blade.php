@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/programacion/EditarProgramacion.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Editar Programación
@endsection

@section('content')

<div class="container-fluid">

    <div class="row mb-8">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded shadow-sm px-6 py-5 border-left border-warning"
                 style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold text-dark">Editar Programación</h2>
                    <span class="text-muted">Actualice los datos del servicio. Estatus actual: 
                        <strong class="text-danger">{{ $programacion->programacionEstatus->estatus_programacion }}</strong>
                    </span>
                </div>

                <a href="{{ route('programacion.listadoprogramacion') }}"
                   class="btn btn-outline-warning font-weight-bold">
                    <i class="flaticon2-back"></i> Regresar
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom shadow-sm border-0">

                <form action="{{ route('programacion.modificarprogramacion') }}" 
                      method="post" 
                      id="submit_programacion" 
                      enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                    <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">
                    <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>

                    <div class="card-body px-10 py-8">

                        <div class="bg-light rounded p-6 mb-8 border">
                            <h5 class="font-weight-bold text-dark mb-6">Datos de la programación</h5>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Cliente</label>
                                    <select class="form-control form-control-lg" name="cliente_id" required>
                                        @foreach($cliente as $tp)
                                            <option value="{{ $tp->id }}" @selected($programacion->cliente_id == $tp->id)>
                                                {{ $tp->nombre_cliente }} / {{ $tp->razon_social }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Fecha y hora de servicio</label>
                                    <input type="datetime-local" class="form-control form-control-lg"
                                           name="fecha_hora" value="{{ $programacion->fecha_servicio }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-2">
                                    <label class="font-weight-bold">Tipo de servicio</label>
                                    <div class="radio-inline mt-2">
                                        <label class="radio">
                                            <input type="radio" name="tipo_servicio" value="0" {{ $programacion->tipo_servicio == 0 ? 'checked' : '' }}>
                                            <span></span> Foráneo
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="tipo_servicio" value="1" {{ $programacion->tipo_servicio == 1 ? 'checked' : '' }}>
                                            <span></span> Local
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-2"> 
                                    <label class="font-weight-bold">Armado</label>
                                    <div class="radio-inline mt-2">
                                        <label class="radio">
                                            <input type="radio" name="armado_servicio" value="0" {{ $programacion->armado_servicio == 0 ? 'checked' : '' }}>
                                            <span></span> Si
                                        </label>
                                        <label class="radio ml-4"> 
                                            <input type="radio" name="armado_servicio" value="1" {{ $programacion->armado_servicio == 1 ? 'checked' : '' }}>
                                            <span></span> No
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <label class="font-weight-bold">Monitoreo</label>
                                    <div class="radio-inline mt-2">
                                        <label class="radio">
                                            <input type="radio" name="op_monitoreo_id" value="1" {{ $programacion->op_monitoreo_id == 1 ? 'checked' : '' }}>
                                            <span></span> Monitoreo 1
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="op_monitoreo_id" value="2" {{ $programacion->op_monitoreo_id == 2 ? 'checked' : '' }}>
                                            <span></span> Monitoreo 2
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Tarifario</label>
                                    <select class="form-control form-control-lg" name="id_tarifa" required>
                                        @foreach($tarifario as $tp)
                                            <option value="{{ $tp->id }}" @selected($programacion->tarifario_id == $tp->id)>
                                                Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6"> 
                                    <label class="font-weight-bold">Folio Interno</label>
                                    <input type="text" class="form-control form-control-lg" 
                                           name="folio_interno" value="{{ $programacion->folio_interno }}" required>
                                </div>

                                <div class="col-lg-6"> 
                                    <label class="font-weight-bold">Línea Transportista</label>
                                    <input type="text" class="form-control form-control-lg" 
                                           name="linea_transportista" value="{{ $programacion->linea_transportista }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light rounded p-6 mb-8 border">
                            <h5 class="font-weight-bold text-dark mb-6">Rutas del servicio</h5>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Domicilio origen</label>
                                    <input type="text" class="form-control form-control-lg"
                                           name="dom_origen" value="{{ $programacion->dom_origen }}" required>
                                </div>

                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Domicilio destino</label>
                                    <input type="text" class="form-control form-control-lg"
                                           name="dom_destino" value="{{ $programacion->dom_destino }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light rounded p-6 mb-8 border">
                            <h5 class="font-weight-bold text-dark mb-6">Asignación de personal</h5>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Custodio Principal</label>
                                    <select class="form-control form-control-lg" name="custodio_id" required>
                                        @foreach($custodio as $tp)
                                            <option value="{{ $tp->id }}" @selected($programacion->custodio_id == $tp->id)>
                                                {{ $tp->nombre_custodio }} {{ $tp->ap_paterno }} {{ $tp->ap_materno }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Acompañantes</label>
                                    <div class="radio-inline mt-2">
                                        <label class="radio">
                                            <input type="radio" name="op_custodios" value="0" {{ $programacion->acompanantes == 0 ? 'checked' : '' }} />
                                            <span></span> Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="op_custodios" value="1" {{ $programacion->acompanantes == 1 ? 'checked' : '' }} />
                                            <span></span> No
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="card card-custom gutter-b mt-4 {{ $programacion->acompanantes == 1 ? 'd-none' : '' }}" 
                                 id="div_custodios" style="background-color: #ffffff; border: 1px solid #ebedf3;">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label text-dark" style="font-size: 1rem;">Lista de Acompañantes</h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <table class='table table-bordered table-hover' id='tblDocumentos'>
                                                <thead>
                                                    <tr>
                                                        <th>Custodio</th>
                                                        <th style="width: 50px;">Opción</th>
                                                    </tr>
                                                </thead>
                                                <tbody id='tbodyDocumentos'>
                                                    @foreach($acompanantes_pro as $documento)
                                                        <tr id="trDocumento{{ $documento->id }}">
                                                            <td>
                                                                {{ $documento->custodio->nombre_custodio }} {{ $documento->custodio->ap_paterno }} {{ $documento->custodio->ap_materno }}
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-sm btn-icon btn-outline-danger hrefEliminarDocumento" data-id="{{ $documento->id }}">
                                                                    <i class="flaticon-delete"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm hrefAgregarOtro" data-toggle="tooltip" title="Agregar acompañante">
                                                <i class="flaticon2-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-light rounded p-6 mb-8 border">
                            <h5 class="font-weight-bold text-dark mb-6">Observaciones</h5>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <textarea class="form-control" name="observaciones" rows="4" style="resize: none;">{{ $programacion->observaciones }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-white border-top text-right">
                            <button type="button" id="btnGuardar" class="btn btn-warning font-weight-bold px-8 mr-2">
                                <i class="flaticon2-check-mark"></i> Guardar Cambios
                            </button>
                            <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-secondary font-weight-bold px-8">
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