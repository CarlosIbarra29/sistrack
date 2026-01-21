@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/tarifario/AgregarTarifario.js') }}"></script>
@endpush

@section('title')
Ver tarifa
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
                        Ver Tarifa
                    </h3>
                    <a href="{{ route('tarifario.listadotarifario') }}"
                       class="btn btn-icon btn-light btn-hover-warning"
                       data-toggle="tooltip" title="Salir">
                        <i class="flaticon2-reply"></i>
                    </a>
                </div>
            </div>

            <div class="card-body bg-light">
                <input type="hidden" name="id_tarifario" value="{{ $tarifario->id }}">

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
                                            <input type="radio" {{ $tarifario->tipo_viaje == 0 ? 'checked' : '' }} disabled>
                                            <span></span> Local
                                        </label>
                                        <label class="radio radio-outline radio-warning">
                                            <input type="radio" {{ $tarifario->tipo_viaje == 1 ? 'checked' : '' }} disabled>
                                            <span></span> Foráneo
                                        </label>
                                    </div>
                                </div>

                                <!-- Cliente / Origen -->
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold">Cliente</label>
                                        @foreach($data as $cli)
                                            @if($cli->id == $tarifario->cliente_id)
                                                <p class="form-control form-control-solid">
                                                    {{ $cli->nombre_cliente }} / {{ $cli->razon_social }}
                                                </p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold">Origen</label>
                                        <p class="form-control form-control-solid">
                                            {{ $tarifario->origen }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Destino / KMS -->
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold">Destino</label>
                                        <p class="form-control form-control-solid">
                                            {{ $tarifario->destino }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold"># KMS</label>
                                        <p class="form-control form-control-solid">
                                            {{ $tarifario->kms }}
                                        </p>
                                    </div>
                                </div>

                                <!-- PPKM -->
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold">PPKM SIS</label>
                                        <p class="form-control form-control-solid">
                                            {{ $tarifario->ppkm_sis }}
                                        </p>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold">PPKM CUST</label>
                                        <p class="form-control form-control-solid">
                                            {{ $tarifario->ppkm_cust }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Caseta -->
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="font-weight-semibold">Caseta</label>
                                        <p class="form-control form-control-solid">
                                            {{ $tarifario->caseta }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Observaciones -->
                                <div class="form-group">
                                    <label class="font-weight-semibold">Observaciones</label>
                                    <p class="form-control form-control-solid" style="min-height: 120px;">
                                        {{ $tarifario->observaciones ?: '—' }}
                                    </p>
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
                                               id="{{ $item[1] }}"
                                               value="{{ $item[2] }}"
                                               disabled>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-white text-right">
                <a href="{{ route('tarifario.listadotarifario') }}" class="btn btn-warning px-10">
                    Regresar
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
