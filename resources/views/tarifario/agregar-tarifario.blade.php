@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/tarifario/AgregarTarifario.js') }}"></script>
@endpush
@section('title')
    Agregar tarifa
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Agregar Tarifa</h3>
                </div>
                <!--begin::Form-->
                <form action="{{ route('tarifario.guardartarifario') }}" method="post" id="submit_cliente">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Cliente</label>
                                        <select class="form-control" id="cliente_id" name="cliente_id"  required >
                                            <option value="">Selecciona una cliente</option>
                                            @foreach($data as $cli)
                                                <option value="{{ $cli->id }}" >{{ $cli->nombre_cliente }} / {{ $cli->razon_social }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Origen</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="origen" id="origen" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Destino</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="destino" id="destino"  required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label># KMS</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="kms" id="kms" required/>
                                             {{-- oninput="onclickkms(this)" --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>PPKM SIS</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="ppkm_sis" id="ppkm_sis"  required/>
                                            {{-- oninput="onclickppkmsis(this)" --}}
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>PPKM CUST </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="ppkm_cust" id="ppkm_cust" required/>
                                            {{-- oninput="onclickppkmcust(this)" --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Caseta</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="caseta" id="caseta" required/> 
                                             {{-- oninput="onclickcaseta(this)" --}}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 text-center mt-2">
                                        <a id="calcular_tarifa" class="btn btn-success">
                                            <i class="flaticon2-pie-chart"></i> Calcular tarifa
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" placeholder="*Opcional" id="observaciones" rows="12"></textarea>
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
                                                    <input type="text" class="form-control" disabled name="monto_cliente" id="monto_cliente"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Custodio</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="monto_custodio" id="monto_custodio"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Subtotal</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="subtotal" id="subtotal_sis"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Ganancia</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="ganancia" id="ganancia"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>% Custodio</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="porcentaje_custodio" id="porcentaje_custodio"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>% SISPROTEC</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="porcentaje_sisprotec" id="porcentaje_sisprotec"  />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label>Total</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" disabled name="total" id="total"  />
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
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('tarifario.listadotarifario') }}"  class="btn btn-secondary">Cancelar</a>
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