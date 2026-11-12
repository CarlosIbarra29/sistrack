@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/clientes.css?v=1.0.2') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js?v=1.0.2') }}"></script>
@endpush

@section('title')
    Agregar informacion
@endsection

@section('content')

<div class="cliente-edit-page cliente-create-page">
    <div class="cliente-page-header">
        <div class="cliente-page-title">
            <div class="cliente-title-kicker">CONTROL DE SERVICIOS</div>
            <h2>Registro de INFORMACION</h2>
            <p>Complete la información general.</p>
        </div>
        <a href="{{ route('controlserv.listcontrolservicios') }}"
           class="btn cliente-btn cliente-btn--back">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </div>

                <form action="{{ route('cliente.guardarcliente') }}" 
                      method="post" 
                      id="submit_cliente"  
                      enctype="multipart/form-data">
                    @csrf

                    <div class="cliente-main-card">
                        <div class="cliente-tabs-header">
                        <ul class="nav nav-tabs cliente-tabs">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                                    <i class="flaticon2-user mr-2"></i> Información
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                                    <i class="flaticon2-document mr-2"></i> Costo
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_3">
                                    <i class="flaticon2-document mr-2"></i> Costo servicio cliente
                                </a>
                            </li>
                        </ul>
                        </div>

                        <div class="cliente-content">
                        <div class="tab-content">

                            <!-- ================= INFO GENERAL ================= -->
                            <div class="tab-pane fade show active" id="kt_tab_pane_1">

                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">INFORMACIÓN GENERAL</span><h3>Datos generales</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Estado Admon</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="estado_admon" id="estado_admon" required/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Ser Compartido</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="ser_compartido" id="ser_compartido" required/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb"># Factura Cliente</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="factura_cliente" id="factura_cliente"/>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Fecha de envío/ Subida Portal</span>
                                                <input type="date" class="form-control form-control-lg st-input"
                                                       name="fecha_envio" id="fecha_envio" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">OC / CR</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="oc_cr" id="oc_cr" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Fecha de Vencimiento</span>
                                                <input type="date" class="form-control form-control-lg st-input"
                                                       name="fecha_vencimiento" id="fecha_vencimiento"/>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Fecha Pago</span>
                                                <input type="date" class="form-control form-control-lg st-input"
                                                       name="fecha_pago" id="fecha_pago" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Sts.</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="sts" id="sts" />
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- INFORMACIÓN CUSTODIO -->
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">CUSTODIO ASIGNADO</span><h3>Información del custodio</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb"># Fac CU</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="fac_cu" id="fac_cu"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Fecha Pago</span>
                                                <input type="date" class="form-control form-control-lg st-input"
                                                       name="fecha_pago_custodio" id="fecha_pago_custodio"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Validado</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="validado" id="validado"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- INFORMACIÓN CUSTODIO II-->
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">CUSTODIO II</span><h3>Información del custodio</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Hrs. Estadía Cu II</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="hrs_estadia_cu" id="hrs_estadia_cu"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Costo Hrs. Estadía Cu II</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="cosot_hrs_estadia_cu" id="cosot_hrs_estadia_cu"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">KM BIT</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="km_bit" id="km_bit"/>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Costo Ser Custudio II</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="costo_custodio_dos" id="costo_custodio_dos"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Total Costo Cu II</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="total_costo" id="total_costo"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb"># Fac CU</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="fac_cu" id="fac_cu"/>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Fecha Pago</span>
                                                <input type="date" class="form-control form-control-lg st-input"
                                                       name="fecha_pago_cu_dos" id="fecha_pago_cu_dos"/>
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Validado</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="validado_cu_dos" id="validado_cu_dos"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- OBSERVACIONES -->
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header"><div><span class="cliente-section-label">NOTAS</span><h3>Observaciones</h3></div></div>
                                    <div class="cliente-panel-body">
                                    <textarea class="form-control form-control-lg st-input"
                                              name="observaciones"
                                              id="observaciones"
                                              rows="4"></textarea>
                                    </div>
                                </div>

                            </div>
                            {{--END  informacion general --}}

                            <div class="tab-pane fade" id="kt_tab_pane_2">

                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">INFORMACIÓN COSTO</span><h3>Datos costo</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Costo</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="costo" id="costo" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Total Casetas</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="total_casetas" id="total_casetas" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Hrs. Estadía Bitácora</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="hrs_estadias_bitacora" id="hrs_estadias_bitacora"/>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Hrs. Estadía</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="hrs_estadia" id="hrs_estadia" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Km Exced.</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="km_exced" id="km_exced" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Apoyo</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="apoyo" id="apoyo"/>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Hrs. E Estadía</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="hrs_e_estadia" id="hrs_e_estadia" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Km. Exced.</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="km_exced_dos" id="km_exced_dos" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Subtotal CU</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="subtotal_cu" id="subtotal_cu" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">IVA</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="iva" id="iva" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Regimen</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="regimen" id="regimen" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Total factura custodio</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="total_factura_custodio" id="total_factura_custodio" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Comprobación</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="comprobacion" id="comprobacion" />
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            {{--END  costo --}}

                            <div class="tab-pane fade" id="kt_tab_pane_3">
                                <div class="cliente-panel">
                                    <div class="cliente-panel-header">
                                        <div><span class="cliente-section-label">INFORMACIÓN COSTO SERVICIO CLIENTE</span><h3>Datos costo servicio cliente</h3></div>
                                    </div>
                                    <div class="cliente-panel-body">

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Costo Servicio Cliente</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="costo_servicio_cliente" id="costo_servicio_cliente" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Hrs. Estadía Cliente</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="hrs_estadia_cliente" id="hrs_estadia_cliente" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Total Estadía Cliente</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="total_estadia_cliente" id="total_estadia_cliente"/>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Validación Estadia</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="validacion_estadia" id="validacion_estadia" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Km Excedente Cliente</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="km_exced_cliente" id="km_exced_cliente" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Km Excedente Cliente $</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="km_exced_cliente_precio" id="km_exced_cliente_precio"/>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Km Exc. Cobro a Cliente</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="km_exced_cliente_cobro" id="km_exced_cliente_cobro" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Subtotal</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="subtotal_cliente" id="subtotal_cliente" />
                                            </div>

                                            <div class="col-lg-4">
                                                <span class="titulo-lb">IVA</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="iva_cliente" id="iva_cliente" />
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-4">
                                                <span class="titulo-lb">Total</span>
                                                <input type="text" class="form-control form-control-lg st-input"
                                                       name="total_cliente" id="total_cliente" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{--END  costo servicio cliente--}}
                        </div>
                        </div>

                        <div class="cliente-footer">
                            <div class="cliente-footer-info">
                                <span><i class="flaticon2-information"></i> Verifica la información antes de guardar.</span>
                            </div>
                            <div class="cliente-footer-actions">
                                <button type="button" id="btnGuardar" class="btn btn-warning cliente-btn cliente-btn--save">
                                    <i class="flaticon2-check-mark"></i> Guardar
                                </button>
                                <a href="{{ route('controlserv.listcontrolservicios') }}" class="btn btn-secondary cliente-btn cliente-btn--cancel">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
</div>
@endsection
