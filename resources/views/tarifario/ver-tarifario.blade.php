@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/tarifario/AgregarTarifario.js') }}"></script>
@endpush
@section('title')
    Ver tarifa
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Ver Tarifa</h3>
                </div>

                    <div class="card-body">
                        <input type="hidden" name="id_tarifario" value="{{ $tarifario->id }}">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Cliente</label>
                                        @foreach($data as $cli)
                                            @if($cli->id == $tarifario->cliente_id)
                                                <p>{{ $cli->nombre_cliente }} / {{ $cli->razon_social }}</p>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Origen</label>
                                        <div class="input-group">
                                            <p>{{ $tarifario->origen }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Destino</label>
                                        <div class="input-group">
                                            <p>{{ $tarifario->destino }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label># KMS</label>
                                        <div class="input-group">
                                            <p>{{ $tarifario->kms }}</p>
                                             {{-- oninput="onclickkms(this)" --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>PPKM SIS</label>
                                        <div class="input-group">
                                            <p>{{ $tarifario->ppkm_sis }}</p>
                                            {{-- oninput="onclickppkmsis(this)" --}}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>PPKM CUST </label>
                                        <div class="input-group">
                                            <p>{{ $tarifario->ppkm_cust }}</p>
                                            {{-- oninput="onclickppkmcust(this)" --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Caseta</label>
                                        <div class="input-group">
                                            <p>{{ $tarifario->caseta }}</p>
                                             {{-- oninput="onclickcaseta(this)" --}}
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="observaciones">Observaciones</label>
                                        <p>{{ $tarifario->observaciones }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card card-custom gutter-b" style="background-color: #A9A2A1;">

                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Cliente</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="monto_cliente" id="monto_cliente"  value="{{ $tarifario->monto_cliente }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Custodio</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="monto_custodio" id="monto_custodio"  value="{{ $tarifario->monto_custodio }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Subtotal</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="subtotal" id="subtotal_sis"  value="{{ $tarifario->subtotal }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Ganancia</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="ganancia" id="ganancia"  value="{{ $tarifario->ganancia }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>% Custodio</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="porcentaje_custodio" id="porcentaje_custodio"  value="{{ $tarifario->porcentaje_custodio }}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>% SISPROTEC</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="porcentaje_sisprotec" id="porcentaje_sisprotec" value="{{ $tarifario->porcentaje_sisprotec }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Total</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="total" id="total" value="{{ $tarifario->total }}" />
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{ route('tarifario.listadotarifario') }}"  class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>

                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->



@endsection