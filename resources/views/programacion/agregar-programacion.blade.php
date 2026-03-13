@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/programacion/AgregarProgramacion.js') }}"></script>
@endpush

@section('title')
    Agregar Programación
@endsection

@section('content')

<div class="container-fluid">

    <!-- ENCABEZADO MODERNO -->
    <div class="row mb-8">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded shadow-sm px-6 py-5 border-left border-warning"
                 style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold text-dark">Nueva Programación</h2>
                    <span class="text-muted">Complete los datos del servicio y la asignación correspondiente</span>
                </div>

                <a href="{{ route('programacion.listadoprogramacion') }}"
                   class="btn btn-outline-warning font-weight-bold">
                    <i class="flaticon2-back"></i> Regresar
                </a>
            </div>
        </div>
    </div>

    <!-- CARD PRINCIPAL -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom shadow-sm border-0">

                <form action="{{ route('programacion.guardarprogramacion') }}" 
                      method="post" 
                      id="submit_programacion" 
                      enctype="multipart/form-data">

                    @csrf

                    <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>

                    <div class="card-body px-10 py-8">

                        <!-- ================= DATOS GENERALES ================= -->
                        <div class="bg-light rounded p-6 mb-8 border">

                            <h5 class="font-weight-bold text-dark mb-6">Datos de la programación</h5>

                            <div class="form-group row">

                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Cliente</label>
                                    <select class="form-control form-control-lg" id="cliente_id" name="cliente_id" required>
                                        <option value="">Selecciona un cliente</option>
                                        @foreach($cliente as $cli)
                                            <option value="{{ $cli->id }}">
                                                {{ $cli->nombre_cliente }} / {{ $cli->razon_social }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

<<<<<<< HEAD
                               <div class="col-lg-6">
    <label>Acompañantes</label>
    <div class="radio-inline">
        <label class="radio">
            <input type="radio" name="op_custodios" value="1">
            <span></span> Si
        </label>
        <label class="radio">
            <input type="radio" name="op_custodios" value="0" checked>
            <span></span> No
        </label>
    </div>
</div>

<!-- Select de acompañante -->
<div class="form-group row" id="select_acompanante" style="display:none;">
   <div class="col-lg-6">
<label>Seleccionar acompañante</label>

<select class="form-control" name="acompanante_id">

<option value="">Selecciona un acompañante</option>

@foreach($custodio as $cli)
<option value="{{ $cli->id }}">
{{ $cli->nombre_custodio }} {{ $cli->ap_paterno }} {{ $cli->ap_materno }}
</option>
@endforeach

</select>

</div>
</div>
=======
                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Fecha y hora de servicio</label>
                                    <input type="datetime-local" class="form-control form-control-lg"
                                           name="fecha_hora" id="fecha_hora" required>
                                </div>
>>>>>>> d039a95fbd0fd75c838ecc8adbd7165591c0b552

                            </div>

                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label class="font-weight-bold">Tipo de servicio</label>
                                    <div class="radio-inline mt-2">
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
                                    <label class="font-weight-bold">Monitoreo</label>
                                    <div class="radio-inline mt-2">
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
                                    <label class="font-weight-bold">Tarifario</label>
                                    <select class="form-control form-control-lg"
                                            id="id_tarifa"
                                            name="id_tarifa"
                                            required></select>
                                </div>

                            </div>
                        </div>

                        <!-- ================= RUTAS ================= -->
                        <div class="bg-light rounded p-6 mb-8 border">

                            <h5 class="font-weight-bold text-dark mb-6">Rutas del servicio</h5>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Domicilio origen</label>
                                    <input type="text" class="form-control form-control-lg"
                                           name="dom_origen" id="dom_origen" required>
                                </div>

                                <div class="col-lg-6">
                                    <label class="font-weight-bold">Domicilio destino</label>
                                    <input type="text" class="form-control form-control-lg"
                                           name="dom_destino" id="dom_destino" required>
                                </div>
                            </div>
                        </div>

                        <!-- ================= ASIGNACIÓN ================= -->
                        
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
                                                <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
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

                    </div>

                    <!-- FOOTER MODERNO -->
                    <div class="card-footer bg-white border-top text-right">
                        <button type="button"
                                id="btnGuardar"
                                class="btn btn-warning font-weight-bold px-8 mr-2">
                            <i class="flaticon2-check-mark"></i> Guardar
                        </button>

                        <a href="{{ route('programacion.listadoprogramacion') }}"
                           class="btn btn-secondary font-weight-bold px-8">
                            Cancelar
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

@endsection
