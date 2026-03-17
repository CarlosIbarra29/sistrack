@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush

@section('title')
    Agregar cliente
@endsection

@section('content')

<div class="container-fluid">

    <!-- ENCABEZADO MODERNO -->
    <div class="row mb-8">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded shadow-sm px-6 py-5 border-left border-warning"
                 style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold text-dark">Registro de Cliente</h2>
                    <span class="text-muted">Complete la información general y técnica del cliente</span>
                </div>

                <a href="{{ route('cliente.listadocliente') }}" 
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

                <form action="{{ route('cliente.guardarcliente') }}" 
                      method="post" 
                      id="submit_cliente"  
                      enctype="multipart/form-data">
                    @csrf

                    <div class="card-body px-10 py-8">

                        <!-- TABS ESTILIZADAS -->
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-warning mb-8">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                                    <i class="flaticon2-user mr-2"></i> Información del Cliente
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                                    <i class="flaticon2-document mr-2"></i> Documentación
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <!-- ================= INFO CLIENTE ================= -->
                            <div class="tab-pane fade show active" id="kt_tab_pane_1">

                                <div class="bg-light rounded p-6 mb-8 border">

                                    <h5 class="font-weight-bold text-dark mb-6">Información General</h5>

                                    <div class="form-group row">
                                        <div class="col-lg-4">
                                            <spam class="titulo-lb">Razón social</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="razon_social" id="razon_social" required/>
                                        </div>

                                        <div class="col-lg-4">
                                            <spam class="titulo-lb">Nombre comercial / Cliente</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="cliente" id="cliente" required/>
                                        </div>

                                        <div class="col-lg-4">
                                            <spam class="titulo-lb">Grupo</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="grupo" id="grupo"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- INFORMACIÓN TÉCNICA -->
                                <div class="bg-light rounded p-6 mb-8 border">

                                    <h5 class="font-weight-bold text-dark mb-6">Información Técnica</h5>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <spam class="titulo-lb">Días de Crédito</spam>
                                            <input type="number" class="form-control form-control-lg st-input"
                                                   name="dias_credito" id="dias_credito"/>
                                        </div>

                                        <div class="col-lg-3">
                                            <spam class="titulo-lb">Costo de estadía</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="costo_estadia" id="costo_estadia"/>
                                        </div>

                                        <div class="col-lg-3">
                                            <spam class="titulo-lb">Costo km extraordinario</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="costo_km" id="costo_km"/>
                                        </div>

                                        <div class="col-lg-3">
                                            <spam class="titulo-lb">Costo por estadía no armada</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="costo_estadia_armada" id="costo_estadia_armada"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <spam class="titulo-lb">Servicio con arma</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="servicio_arma" id="servicio_arma"/>
                                        </div>

                                        <div class="col-lg-6">
                                            <spam class="titulo-lb">Servicio sin arma</spam>
                                            <input type="text" class="form-control form-control-lg st-input"
                                                   name="servicio_sin_arma" id="servicio_sin_arma"/>
                                        </div>
                                    </div>
                                </div>

                                <!-- CONTACTO OPERATIVO -->
                                <div class="bg-light rounded p-6 mb-8 border">

                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <h5 class="font-weight-bold text-dark mb-0">Contacto Operativo</h5>

                                        <a href="#" 
                                           class="btn btn-outline-warning btn-sm hrefAgregarOtro"
                                           data-toggle="tooltip"
                                           title="Agregar contacto">
                                            <i class="flaticon2-plus"></i> Agregar
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class='table table-head-custom table-bordered table-hover' id='tblDocumentos'>
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Tipo contacto</th>
                                                <th>Nombre contacto</th>
                                                <th>Email</th>
                                                <th>Telefono</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos'></tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- OBSERVACIONES -->
                                <div class="bg-light rounded p-6 border">
                                    <h5 class="font-weight-bold text-dark mb-6">Observaciones</h5>
                                    <textarea class="form-control form-control-lg st-input"
                                              name="observaciones"
                                              id="observaciones"
                                              rows="4"></textarea>
                                </div>

                            </div>

                            <!-- ================= DOCUMENTACIÓN ================= -->
                            <div class="tab-pane fade" id="kt_tab_pane_2">

                                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                                <input type='hidden' id='tipoArchivo2' value='{{ $cadenatipocliente }}'>

                                <div class="bg-light rounded p-6 border">

                                    <div class="d-flex justify-content-between align-items-center mb-6">
                                        <h5 class="font-weight-bold text-dark mb-0">Documentación del Cliente</h5>

                                        <a href="#"
                                           class="btn btn-outline-warning btn-sm hrefAgregarOtro2"
                                           data-toggle="tooltip"
                                           title="Agregar archivo">
                                            <i class="flaticon2-plus"></i> Agregar
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class='table table-head-custom table-bordered table-hover' id='tblDocumentos2'>
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Adjuntar Documento</th>
                                                <th>Tipo de Documento</th>
                                                <th>Opción</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos2'></tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- FOOTER MODERNO -->
                    <div class="card-footer bg-white border-top">
                        <div class="text-right">
                            <button type="button" id="btnGuardar"
                                    class="btn btn-warning font-weight-bold px-8">
                                <i class="flaticon2-check-mark"></i> Guardar
                            </button>

                            <a href="{{ route('cliente.listadocliente') }}"
                               class="btn btn-secondary font-weight-bold px-8">
                                Cancelar
                            </a>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

@endsection