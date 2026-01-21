@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/tarifario/AgregarTarifario.js') }}"></script>
@endpush
@section('title')
Editar tarifa
@endsection
@section('content')



<div class="row">
    <div class="col-lg-12">

        <!-- Card principal -->
        <div class="card card-custom gutter-b border-0 shadow-sm">

            <!-- Header -->
            <div class="card-header bg-white border-bottom">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        Editar Tarifa
                    </h3>
                    <a href="{{ route('tarifario.listadotarifario') }}"
                       class="btn btn-icon btn-light btn-hover-warning"
                       data-toggle="tooltip" title="Salir">
                        <i class="flaticon2-reply"></i>
                    </a>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('tarifario.updatetarifario') }}" method="post" id="submit_cliente">
                @csrf
                <input type="hidden" name="id_tarifario" value="{{ $tarifario->id }}">

                <div class="card-body bg-light">
                    <div class="row">

                        <!-- FORMULARIO -->
                        <div class="col-lg-8">
                            <div class="card card-custom mb-5 border shadow-sm">
                                <div class="card-body">

                                    <!-- Tipo viaje -->
                                    <div class="form-group">
                                        <label class="font-weight-bold text-dark">Tipo de viaje</label>
                                        <div class="radio-inline mt-2">
                                            <label class="radio radio-outline radio-warning">
                                                <input type="radio" name="tipo_viaje" value="0"
                                                    {{ $tarifario->tipo_viaje == 0 ? 'checked' : '' }}>
                                                <span></span> Local
                                            </label>
                                            <label class="radio radio-outline radio-warning">
                                                <input type="radio" name="tipo_viaje" value="1"
                                                    {{ $tarifario->tipo_viaje == 1 ? 'checked' : '' }}>
                                                <span></span> Foráneo
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Cliente / Origen -->
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold">Cliente</label>
                                            <select class="form-control form-control-solid"
                                                    id="cliente_id" name="cliente_id" required>
                                                <option value="">Selecciona un cliente</option>
                                                @foreach($data as $cli)
                                                    <option value="{{ $cli->id }}"
                                                        {{ $cli->id == $tarifario->cliente_id ? 'selected' : '' }}>
                                                        {{ $cli->nombre_cliente }} / {{ $cli->razon_social }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold">Origen</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="origen" id="origen"
                                                   value="{{ $tarifario->origen }}" required>
                                        </div>
                                    </div>

                                    <!-- Destino / KMS -->
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold">Destino</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="destino" id="destino"
                                                   value="{{ $tarifario->destino }}" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold"># KMS</label>
                                            <input type="number" class="form-control form-control-solid"
                                                   name="kms" id="kms"
                                                   value="{{ $tarifario->kms }}" required>
                                        </div>
                                    </div>

                                    <!-- PPKM -->
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold">PPKM SIS</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="ppkm_sis" id="ppkm_sis"
                                                   value="{{ $tarifario->ppkm_sis }}" required>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold">PPKM CUST</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="ppkm_cust" id="ppkm_cust"
                                                   value="{{ $tarifario->ppkm_cust }}" required>
                                        </div>
                                    </div>

                                    <!-- Caseta -->
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label class="font-weight-semibold">Caseta</label>
                                            <input type="text" class="form-control form-control-solid"
                                                   name="caseta" id="caseta"
                                                   value="{{ $tarifario->caseta }}" required>
                                        </div>
                                    </div>

                                    <!-- Calcular -->
                                    <div class="form-group text-right mt-6">
                                        <a id="calcular_tarifa"
                                           class="btn btn-warning  text-right">
                                            <i class="flaticon2-pie-chart mr-2"></i>
                                            Calcular tarifa
                                        </a>
                                    </div>

                                    <!-- Observaciones -->
                                    <div class="form-group">
                                        <label class="font-weight-semibold">Observaciones</label>
                                        <textarea class="form-control form-control-solid"
                                                  name="observaciones" id="observaciones"
                                                  rows="6">{{ $tarifario->observaciones }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- RESUMEN -->
                        <div class="col-lg-4">
                            <div class="card card-custom border border-warning shadow-sm">
                                <div class="card-body">
                                    <h5 class="text-warning font-weight-bold mb-6">
                                        Resumen de tarifa
                                    </h5>

                                    @foreach([
                                        ['Cliente','monto_cliente',$tarifario->monto_cliente],
                                        ['Custodio','monto_custodio',$tarifario->monto_custodio],
                                        ['Pago de custodia sin arma','subtotal_sis',$tarifario->subtotal],
                                        ['Ganancia','ganancia',$tarifario->ganancia],
                                        ['% Custodio','porcentaje_custodio',$tarifario->porcentaje_custodio],
                                        ['% SISPROTEC','porcentaje_sisprotec',$tarifario->porcentaje_sisprotec],
                                        ['Total','total',$tarifario->total],
                                    ] as $item)
                                        <div class="form-group">
                                            <label class="text-muted">{{ $item[0] }}</label>
                                            <input type="text"
                                                   class="form-control form-control-solid font-weight-bold"
                                                   id="{{ $item[1] }}" value="{{ $item[2] }}" disabled>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Footer -->
                <div class="card-footer bg-white text-right">
                    <button type="button" id="btnGuardar" class="btn btn-warning px-10">
                        Guardar
                    </button>
                    <a href="{{ route('tarifario.listadotarifario') }}" class="btn btn-light px-10">
                        Cancelar
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
