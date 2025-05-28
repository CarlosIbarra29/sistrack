@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/programacion/EditarProgramacion.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Editar Programacion
@endsection
@section('content')

<style type="text/css">
    .oculto{
        display: none;
    }
</style>
    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Editar Programación</h3>
                    <div class="card-toolbar">
                        <span style="font-size: 15px; font-weight: bold; color:red;">Estatus: {{ $programacion->programacionEstatus->estatus_programacion }}</span>
                    </div>
                </div>

                <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">
                <!--begin::Form-->
                <form action="{{ route('programacion.modificarprogramacion') }}" method="post" id="submit_programacion" enctype="multipart/form-data">
                    @csrf

                    <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Cliente</label>
                                        <select class="form-control" name="cliente_id" id="cliente_id" required>
                                            <option value="">Selecciona una opción</option>
                                            @foreach($cliente as $tp)
                                                <option value="{{ $tp->id }}" @selected($programacion->cliente_id == $tp->id) >{{ $tp->nombre_cliente }} / {{ $tp->razon_social }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Fecha y hora de servicio</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" value="{{ $programacion->fecha_servicio }}" name="fecha_hora" id="fecha_hora" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label>Tipo de servicio</label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" {{($programacion->tipo_servicio == 0) ? 'checked' : ''}} name="tipo_servicio" value="0" />
                                                <span></span>
                                                Foraneo
                                            </label>
                                            <label class="radio">
                                                <input type="radio" {{($programacion->tipo_servicio == 1) ? 'checked' : ''}} name="tipo_servicio" value="1" />
                                                <span></span>
                                                Local
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Monitoreo</label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" {{($programacion->op_monitoreo_id == 1) ? 'checked' : ''}} name="op_monitoreo_id" value="1" />
                                                <span></span>
                                                Monitoreo 1
                                            </label>
                                            <label class="radio">
                                                <input type="radio" {{($programacion->op_monitoreo_id == 2) ? 'checked' : ''}} name="op_monitoreo_id" value="2" />
                                                <span></span>
                                                Monitoreo 2
                                            </label>
                                        </div>
                                    </div>



                                    <div class="col-lg-6">
                                        <label>Tarifario.</label>
                                        <select class="form-control" id="id_tarifa" name="id_tarifa"  required>
                                            {{-- <option value="">Selecciona una opción</option> --}}
                                            @foreach($tarifario as $tp)
                                                <option value="{{ $tp->id }}" @selected($programacion->tarifario_id == $tp->id) >Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Domicilio origen</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_origen" value="{{ $programacion->dom_origen }}" id="dom_origen"  required/>
                                            {{-- oninput="onclickppkmsis(this)" --}}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Domicilio destino </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_destino" value="{{ $programacion->dom_destino }}" id="dom_destino" required/>
                                            {{-- oninput="onclickppkmcust(this)" --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Custodio</label>
                                        <select class="form-control" id="custodio_id" name="custodio_id" required >
                                            <option value="">Selecciona una custodio</option>
                                            @foreach($custodio as $tp)
                                                <option value="{{ $tp->id }}" @selected($programacion->custodio_id == $tp->id) >{{ $tp->nombre_custodio }} {{ $tp->ap_paterno }} {{ $tp->ap_materno }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Acompañantes</label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" {{($programacion->acompanantes == 0) ? 'checked' : ''}} name="op_custodios" id="op_c_uno" value="0" />
                                                <span></span>
                                                Si
                                            </label>
                                            <label class="radio">
                                                <input type="radio" {{($programacion->acompanantes == 1) ? 'checked' : ''}} name="op_custodios" id="op_c_dos" value="1" />
                                                <span></span>
                                                No
                                            </label>
                                        </div>
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
                                                        <th>Opción</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id='tbodyDocumentos'>
                                                        @foreach($acompanantes_pro as $documento)
                                                            <tr id="trDocumento{{ $documento->id }}">
                                                                <td>{{ $documento->custodio->nombre_custodio}} {{ $documento->custodio->ap_paterno}} {{ $documento->custodio->ap_materno}}</td>
                                                                <td>
                                                                    <a href='#' class='btn btn-sm btn-clean btn-hover-icon-success btn-icon hrefEliminarDocumento' data-id='{{ $documento->id }}' data-documento='{{ $documento->custodio->nombre_custodio}}  {{ $documento->custodio->ap_paterno}} {{ $documento->custodio->ap_materno}}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
                                                                        <i class='flaticon-delete'></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
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
                                </div>


{{-- 
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" placeholder="*Opcional" id="observaciones" rows="5">{{ $programacion->observaciones }}</textarea>
                                    </div>
                                </div> --}}
                            </div>

                        </div>


                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('programacion.listadoprogramacion') }}"  class="btn btn-secondary">Cancelar</a>
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