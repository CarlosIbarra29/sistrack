@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/programacion/AgregarProgramacion.js') }}"></script>
@endpush
@section('title')
    Agregar Programacion
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Agregar Programación</h3>
                </div>
                <!--begin::Form-->
                <form action="{{ route('programacion.guardarprogramacion') }}" method="post" id="submit_programacion" enctype="multipart/form-data">
                    @csrf

                    <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Cliente</label>
                                        <select class="form-control" id="cliente_id" name="cliente_id" required >
                                            <option value="">Selecciona una cliente</option>
                                            @foreach($cliente as $cli)
                                                <option value="{{ $cli->id }}" >{{ $cli->nombre_cliente }} / {{ $cli->razon_social }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Fecha y hora de servicio</label>
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="fecha_hora" id="fecha_hora" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <label>Tipo de servicio</label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" checked name="tipo_servicio" value="0" />
                                                <span></span>
                                                Foraneo
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="tipo_servicio" value="1" />
                                                <span></span>
                                                Local
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Monitoreo</label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio" checked name="op_monitoreo_id" value="1" />
                                                <span></span>
                                                Monitoreo 1
                                            </label>
                                            <label class="radio">
                                                <input type="radio" name="op_monitoreo_id" value="2" />
                                                <span></span>
                                                Monitoreo 2
                                            </label>
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <label>Tarifario.</label>
                                        <select class="form-control" id="id_tarifa" name="id_tarifa"  required>
                                            <option></option>
{{--                                             <option value="">Selecciona una opción</option>
                                            @foreach($municipios as $municipio)
                                                <option value="{{ $municipio->id_municipio }}" >{{ $municipio->municipio_nombre }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Domicilio origen</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_origen" id="dom_origen"  required/>
                                            {{-- oninput="onclickppkmsis(this)" --}}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Domicilio destino </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_destino" id="dom_destino" required/>
                                            {{-- oninput="onclickppkmcust(this)" --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Custodio</label>
                                        <select class="form-control" id="custodio_id" name="custodio_id" required >
                                            <option value="">Selecciona una custodio</option>
                                            @foreach($custodio as $cli)
                                                <option value="{{ $cli->id }}" >{{ $cli->nombre_custodio }} {{ $cli->ap_paterno }} {{ $cli->ap_materno }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Acompañantes</label>
                                        <div class="radio-inline">
                                            <label class="radio">
                                                <input type="radio"  name="op_custodios" id="op_c_uno" value="0" />
                                                <span></span>
                                                Si
                                            </label>
                                            <label class="radio">
                                                <input type="radio" checked name="op_custodios" id="op_c_dos" value="1" />
                                                <span></span>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-custom gutter-b" id="div_custodios" style="background-color:  #f1f1f1; display: none;" >
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
                                        <textarea class="form-control" name="observaciones" placeholder="*Opcional" id="observaciones" rows="5"></textarea>
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