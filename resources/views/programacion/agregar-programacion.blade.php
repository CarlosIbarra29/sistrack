@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/programacion/AgregarProgramacion.js') }}"></script>
@endpush

@section('title')
    Agregar Programación
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card card-custom gutter-b shadow-sm">

            <!-- HEADER MODERNO -->
            <div class="card-header">
                <h3 class="card-title">Agregar Programación</h3>
                <div class="card-toolbar">
                    <a href="{{ route('programacion.listadoprogramacion') }}"class="btn btn-light-warning font-weight-bold mr-3 ml-3"><i class="flaticon2-back"></i> Regresar</a>
                </div>
            </div>

            <!-- FORM -->
            <form action="{{ route('programacion.guardarprogramacion') }}" 
                  method="post" 
                  id="submit_programacion" 
                  enctype="multipart/form-data">

                @csrf

                <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>

                <div class="card-body">

                    <!-- ===== DATOS GENERALES ===== -->
                    <h4 class="mb-5 font-weight-bold text-warning">Datos de la programación</h4>

                    <div class="form-group row">

                        <div class="col-lg-6">
                            <label>Cliente</label>
                            <select class="form-control" id="cliente_id" name="cliente_id" required>
                                <option value="">Selecciona un cliente</option>
                                @foreach($cliente as $cli)
                                    <option value="{{ $cli->id }}">
                                        {{ $cli->nombre_cliente }} / {{ $cli->razon_social }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label>Fecha y hora de servicio</label>
                            <input type="datetime-local" class="form-control" name="fecha_hora" id="fecha_hora" required>
                        </div>

                    </div>

                    <div class="form-group row">

                        <div class="col-lg-3">
                            <label>Tipo de servicio</label>
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" checked name="tipo_servicio" value="0">
                                    <span></span> Foraneo
                                </label>
                                <label class="radio">
                                    <input type="radio" name="tipo_servicio" value="1">
                                    <span></span> Local
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label>Monitoreo</label>
                            <div class="radio-inline">
                                <label class="radio">
                                    <input type="radio" checked name="op_monitoreo_id" value="1">
                                    <span></span> Monitoreo 1
                                </label>
                                <label class="radio">
                                    <input type="radio" name="op_monitoreo_id" value="2">
                                    <span></span> Monitoreo 2
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label>Tarifario</label>
                            <select class="form-control" id="id_tarifa" name="id_tarifa" required></select>
                        </div>

                    </div>

                    <div class="separator separator-dashed my-8"></div>

                    <!-- ===== DOMICILIOS ===== -->
                    <div class="card card-custom gutter-b bg-light">

                        <div class="card-header">
                            <h3 class="card-title">Rutas del servicio</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label>Domicilio origen</label>
                                    <input type="text" class="form-control" name="dom_origen" id="dom_origen" required>
                                </div>

                                <div class="col-lg-6">
                                    <label>Domicilio destino</label>
                                    <input type="text" class="form-control" name="dom_destino" id="dom_destino" required>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- ===== CUSTODIOS ===== -->
                    <div class="card card-custom gutter-b">

                        <div class="card-header">
                            <h3 class="card-title">Asignación de custodio</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label>Custodio</label>
                                    <select class="form-control" id="custodio_id" name="custodio_id" required>
                                        <option value="">Selecciona un custodio</option>
                                        @foreach($custodio as $cli)
                                            <option value="{{ $cli->id }}">
                                                {{ $cli->nombre_custodio }} {{ $cli->ap_paterno }} {{ $cli->ap_materno }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <label>Acompañantes</label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="op_custodios" value="0">
                                            <span></span> Si
                                        </label>
                                        <label class="radio">
                                            <input type="radio" checked name="op_custodios" value="1">
                                            <span></span> No
                                        </label>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- ===== ACOMPAÑANTES DINÁMICOS ===== -->
                    <div class="card card-custom gutter-b bg-light" id="div_custodios" style="display:none;">

                        <div class="card-header">
                            <h3 class="card-title">Acompañantes</h3>
                        </div>

                        <div class="card-body">

                            <table class="table table-bordered table-hover" id="tblDocumentos">
                                <thead>
                                    <tr>
                                        <th>Custodio</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyDocumentos"></tbody>
                            </table>

                            <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm hrefAgregarOtro">
                                <i class="flaticon2-plus"></i>
                            </a>

                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="card-footer text-right">
                    <button type="button" id="btnGuardar" class="btn btn-warning mr-2">
                        Guardar
                    </button>
                    <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
