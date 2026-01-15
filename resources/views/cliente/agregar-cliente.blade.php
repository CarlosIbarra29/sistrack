@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>

@endpush
@section('title')
    Agregar cliente
@endsection
@section('content')


<style>

    
    .separator.separator-dashed {
        border-bottom: 1px dashed #EBEDF3;
    }

    .card-title-custom {
        font-size: 1.2rem;
        font-weight: 700;
        color: #181C32;
    }
</style>

 <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-8">
        <h2 class="font-weight-bold">Agregar Cliente</h2>

        <a href="{{ route('cliente.listadocliente') }}" class="btn btn-warning font-weight-bold">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </div>
    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                
                <!--begin::Form-->
                <form action="{{ route('cliente.guardarcliente') }}" method="post" id="submit_cliente"  enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <!--begin::tabs-->
                        <ul class="nav nav-tabs nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información del Cliente</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Documentación</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5" id="myTabContent">
                            <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <spam class="titulo-lb" >Razón social</spam>
                                        <div class="input-group">
                                            <input type="text" class="form-control st-input" name="razon_social" id="razon_social" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <spam class="titulo-lb">Nombre comercial/ Cliente<spaml>
                                        <div class="input-group">
                                            <input type="text" class="form-control st-input" name="cliente" id="cliente" required/>
                                        </div>
                                    </div>
                                     <div class="col-lg-4">
                                        <spam class="titulo-lb">Grupo</spam>
                                        <div class="input-group">
                                            <input type="text" class="form-control st-input" name="grupo" id="grupo"  />
                                        </div>
                                    </div>
                                </div>
                        <div class="separator separator-dashed my-8"></div>

                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label card-title-custom ">
                                                <spam class="titulo-lb" >Información Técnica</spam >
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-3">
                                                <spam class="titulo-lb">Días de Crédito </spam >
                                                <div class="input-group">
                                                    <input type="number" class="form-control st-input" name="dias_credito" id="dias_credito" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <spam class="titulo-lb">Costo de estadía</spam >
                                                <div class="input-group">
                                                    <input type="text" class="form-control st-input" name="costo_estadia" id="costo_estadia" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <spam class="titulo-lb">Costo km extraordinario</spam >
                                                <div class="input-group">
                                                    <input type="text" class="form-control st-input" name="costo_km" id="costo_km" />
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <spam class="titulo-lb">Costo por estadía no armada</spam >
                                                <div class="input-group">
                                                    <input type="text" class="form-control st-input" name="costo_estadia_armada" id="costo_estadia_armada" />
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>

<input type='hidden' id='tipoArchivo2' value='{{ $cadenatipocliente }}'>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        <spam class="titulo-lb">Contacto operativo</spam>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row form-group" >
                                                    <div class="col-lg-12" id="tblArchivos">
                                                        
                                                        <table class='table table-bordered table-hover' id='tblDocumentos'>
                                                            <thead>
                                                            <tr>
                                                                <th>Tipo contacto</th>
                                                                <th>Nombre contacto</th>
                                                                <th>Email</th>
                                                                <th>Telefono</th>
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
                                    </div>
{{--                                     <div class="col-lg-12">
                                        <div class="card card-custom gutter-b">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">
                                                        <small>Contacto facturación y cobranza</small>
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                              <div class="row form-group" >
                                                    <div class="col-lg-12" id="tblArchivos1">
                                                        <table class='table table-bordered table-hover' id='tblDocumentos1'>
                                                            <thead>
                                                            <tr>
                                                                <th>Nombre contacto</th>
                                                                <th>Email</th>
                                                                <th>Telefono</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id='tbodyDocumentos1'>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro1" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                            <i class="flaticon2-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <spam class="titulo-lb">Observaciones</spam>
                                        <textarea class="form-control st-input" name="observaciones" id="observaciones" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                                <div class="row form-group" >
                                    <div class="col-lg-12" id="tblArchivos2">
                                        <table class='table table-bordered table-hover' id='tblDocumentos2'>
                                            <thead>
                                            <tr>
                                                <th>Adjuntar Documento</th>
                                                <th>Tipo de Documento</th>
                                                <th>Opción</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos2'>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm mr-2 hrefAgregarOtro2" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                            <i class="flaticon2-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>







                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="button"  id="btnGuardar" class="btn btn-warning mr-2"><i class="flaticon2-check-mark"></i>Guardar</button>
                                <a href="{{ route('cliente.listadocliente') }}"  class="btn btn-secondary">Cancelar</a>
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