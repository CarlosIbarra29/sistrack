@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/monitoreo/AgregarEstadias.js') }}"></script>
@endpush
@section('title')
    Agregar generales del transporte
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Agregar generales del transporte</h3>
                </div>
                <!--begin::Form-->
                <form action="{{ route('monitoreo.guardarestadia') }}" method="post" id="submit_estadia" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        @if($op_estadia == 0)
                            <input type="hidden" name="op_estadias" value="{{ $op_estadia }}">
                            <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Linea transportista</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="linea_transportista" id="linea_transportista"  required/>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Nombre del conductor</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="nombre_conductor" id="nombre_conductor"  required/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Telefono</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="telefono" id="telefono"  required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Placas</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="placas" id="placas"  required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de llegada del custodio</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_llegada_custodio" id="fechahora_llegada_custodio"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de inicio de trayecto</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_inicio_trayecto" id="fechahora_inicio_trayecto"/>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de llegada a destino</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_llegado_destino" id="fechahora_llegado_destino"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de finalizacion</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_finalizacion" id="fechahora_finalizacion"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="observaciones">Generales de la unidad</label>
                                            <textarea class="form-control" name="observaciones" placeholder="" id="generales_unidad" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @else
                            <input type="hidden" name="op_estadias" value="{{ $op_estadia }}">
                            <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Linea transportista</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="linea_transportista" id="linea_transportista" value="{{ $estadias_info->linea_transportistas }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Nombre del conductor</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="nombre_conductor" id="nombre_conductor" value="{{ $estadias_info->nombre_conductor }}" required/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Telefono</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="telefono" id="telefono" value="{{ $estadias_info->telefono }}" required/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Placas</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="placas" id="placas" value="{{ $estadias_info->telefono }}" required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de llegada del custodio</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_llegada_custodio" value="{{ $estadias_info->fechahora_llegada_custodio }}" id="fechahora_llegada_custodio"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de inicio de trayecto</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_inicio_trayecto" value="{{ $estadias_info->fechahora_inicio_trayecto }}" id="fechahora_inicio_trayecto"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de llegada a destino</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_llegado_destino" value="{{ $estadias_info->fechahora_llegado_destino }}" id="fechahora_llegado_destino"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Fecha y hora de finalizacion</label>
                                            <div class="input-group">
                                                <input type="datetime-local" class="form-control" name="fechahora_finalizacion" value="{{ $estadias_info->fechahora_finalizacion }}" id="fechahora_finalizacion"/>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="col-lg-12">
                                            <label for="observaciones">Generales de la unidad</label>
                                            <textarea class="form-control" name="observaciones" placeholder="" id="generales_unidad" rows="5">{{ $estadias_info->generales_unidad }}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('monitoreo.listamonitoreo') }}"  class="btn btn-secondary">Cancelar</a>
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