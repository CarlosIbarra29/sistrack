@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/monitoreo/AgregarEstadias.js') }}"></script>
@endpush

@section('title')
    Agregar generales del transporte
@endsection

@section('content')

<!-- HEADER MODERNO -->
<div class="d-flex justify-content-between align-items-center mb-8">
    <h2 class="font-weight-bold">Agregar generales del transporte</h2>

    <a href="{{ route('monitoreo.listamonitoreo') }}" class="btn btn-warning font-weight-bold">
        <i class="flaticon2-back"></i> Regresar
    </a>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">

            <form action="{{ route('monitoreo.guardarestadia') }}" method="post" id="submit_estadia" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    @if($op_estadia == 0)
                        <input type="hidden" name="op_estadias" value="{{ $op_estadia }}">
                        <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">

                        {{-- ===================== --}}
                        {{-- DATOS DEL TRANSPORTE --}}
                        {{-- ===================== --}}
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <span class="titulo-lb">Línea transportista</span>
                                <input type="text" class="form-control st-input" name="linea_transportista" id="linea_transportista" required>
                            </div>

                            <div class="col-lg-6">
                                <span class="titulo-lb">Nombre del conductor</span>
                                <input type="text" class="form-control st-input" name="nombre_conductor" id="nombre_conductor" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <span class="titulo-lb">Teléfono</span>
                                <input type="number" class="form-control st-input" name="telefono" id="telefono" required>
                            </div>

                            <div class="col-lg-6">
                                <span class="titulo-lb">Placas</span>
                                <input type="text" class="form-control st-input" name="placas" id="placas" required>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-8"></div>

                        {{-- ===================== --}}
                        {{-- FECHAS Y HORAS --}}
                        {{-- ===================== --}}
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <span class="titulo-lb">Fechas y horarios</span>
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Llegada del custodio</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_llegada_custodio">
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Inicio de trayecto</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_inicio_trayecto">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Llegada a destino</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_llegado_destino">
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Finalización</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_finalizacion">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===================== --}}
                        {{-- GENERALES UNIDAD --}}
                        {{-- ===================== --}}
                        <div class="form-group">
                            <span class="titulo-lb">Generales de la unidad</span>
                            <textarea class="form-control st-input" name="observaciones" id="generales_unidad" rows="4"></textarea>
                        </div>

                    @else
                        <input type="hidden" name="op_estadias" value="{{ $op_estadia }}">
                        <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">

                        {{-- MISMO DISEÑO – CON VALORES --}}
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <span class="titulo-lb">Línea transportista</span>
                                <input type="text" class="form-control st-input" name="linea_transportista" value="{{ $estadias_info->linea_transportistas }}" required>
                            </div>

                            <div class="col-lg-6">
                                <span class="titulo-lb">Nombre del conductor</span>
                                <input type="text" class="form-control st-input" name="nombre_conductor" value="{{ $estadias_info->nombre_conductor }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <span class="titulo-lb">Teléfono</span>
                                <input type="number" class="form-control st-input" name="telefono" value="{{ $estadias_info->telefono }}" required>
                            </div>

                            <div class="col-lg-6">
                                <span class="titulo-lb">Placas</span>
                                <input type="text" class="form-control st-input" name="placas" value="{{ $estadias_info->telefono }}" required>
                            </div>
                        </div>

                        <div class="separator separator-dashed my-8"></div>

                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <span class="titulo-lb">Fechas y horarios</span>
                                    </h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Llegada del custodio</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_llegada_custodio" value="{{ $estadias_info->fechahora_llegada_custodio }}">
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Inicio de trayecto</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_inicio_trayecto" value="{{ $estadias_info->fechahora_inicio_trayecto }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Llegada a destino</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_llegado_destino" value="{{ $estadias_info->fechahora_llegado_destino }}">
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="titulo-lb">Finalización</span>
                                        <input type="datetime-local" class="form-control st-input" name="fechahora_finalizacion" value="{{ $estadias_info->fechahora_finalizacion }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="titulo-lb">Generales de la unidad</span>
                            <textarea class="form-control st-input" name="observaciones" rows="4">{{ $estadias_info->generales_unidad }}</textarea>
                        </div>
                    @endif

                </div>

                {{-- FOOTER --}}
                <div class="card-footer text-right">
                    <button type="button" id="btnGuardar" class="btn btn-warning mr-2">
                        <i class="flaticon2-check-mark"></i> Guardar
                    </button>
                    <a href="{{ route('monitoreo.listamonitoreo') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
