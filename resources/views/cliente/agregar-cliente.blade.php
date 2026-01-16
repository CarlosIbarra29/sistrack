@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush

@section('title', 'Agregar cliente')

@section('content')

<style>
    .form-control-solid {
        background-color: #F3F6F9;
        border-color: transparent;
        font-weight: 500;
    }
    .form-control-solid:focus {
        background-color: #EBEDF3;
        border-color: transparent;
    }
    label {
        font-weight: 600;
        color: #3F4254;
        margin-bottom: .5rem;
    }
    .separator.separator-dashed {
        border-bottom: 1px dashed #EBEDF3;
    }
    .card-title-custom {
        font-size: 1.2rem;
        font-weight: 700;
        color: #181C32;
    }
</style>

<div class="row">
<div class="col-lg-12">
<div class="card card-custom gutter-b">

    {{-- HEADER --}}
    <div class="card-header border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Agregar Cliente</h3>
        </div>
        <div class="card-toolbar">
            <a href="{{ route('cliente.listadocliente') }}" class="btn btn-light-danger btn-sm">
                <i class="flaticon2-reply"></i> Regresar
            </a>
        </div>
    </div>

    {{-- FORM --}}
    <form action="{{ route('cliente.guardarcliente') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            {{-- TABS --}}
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-primary">
                <li class="nav-item">
                    <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                        <i class="flaticon2-user mr-2"></i> Información del Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                        <i class="flaticon2-file mr-2"></i> Documentación
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-8">

                {{-- TAB CLIENTE --}}
                <div class="tab-pane fade show active" id="kt_tab_pane_1">

                    {{-- DATOS GENERALES --}}
                    <div class="row mb-6">
                        <div class="col-lg-4">
                            <label>Razón social *</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="razon_social" id="razon_social" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Nombre comercial / Cliente *</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="cliente" id="cliente" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Grupo</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="grupo" id="grupo">
                        </div>
                    </div>

                    <div class="separator separator-dashed my-8"></div>

                    {{-- INFO TECNICA --}}
                    <h4 class="card-title-custom mb-4">Información Técnica</h4>

                    <div class="row mb-6">
                        <div class="col-lg-3">
                            <label>Días de crédito</label>
                            <input type="number" class="form-control form-control-solid"
                                   name="dias_credito" id="dias_credito">
                        </div>
                        <div class="col-lg-3">
                            <label>Costo estadía</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="costo_estadia" id="costo_estadia">
                        </div>
                        <div class="col-lg-3">
                            <label>Costo km extraordinario</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="costo_km" id="costo_km">
                        </div>
                        <div class="col-lg-3">
                            <label>Costo estadía no armada</label>
                            <input type="text" class="form-control form-control-solid"
                                   name="costo_estadia_armada" id="costo_estadia_armada">
                        </div>
                    </div>

                    {{-- CONTACTO OPERATIVO --}}
                    <input type="hidden" id="tipoArchivo2" value="{{ $cadenatipocliente }}">

                    <div class="separator separator-dashed my-8"></div>
                    <h4 class="card-title-custom mb-4">Contacto operativo</h4>

                    <div class="table-responsive" id="tblArchivos">
                        <table class="table table-bordered table-hover" id="tblDocumentos">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tipo contacto</th>
                                    <th>Nombre contacto</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDocumentos"></tbody>
                        </table>
                    </div>

                    <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mt-3 hrefAgregarOtro"
                       data-toggle="tooltip" title="Agregar contacto">
                        <i class="flaticon2-plus"></i>
                    </a>

                    {{-- OBSERVACIONES --}}
                    <div class="row mt-8">
                        <div class="col-lg-12">
                            <label>Observaciones</label>
                            <textarea class="form-control form-control-solid"
                                      name="observaciones" id="observaciones" rows="3"></textarea>
                        </div>
                    </div>

                </div>

                {{-- TAB DOCUMENTOS --}}
                <div class="tab-pane fade" id="kt_tab_pane_2">
                    <input type="hidden" id="tipoArchivo" value="{{ $cadenaTipoDocumento }}">

                    <div class="table-responsive mt-6" id="tblArchivos2">
                        <table class="table table-bordered table-hover" id="tblDocumentos2">
                            <thead class="thead-light">
                                <tr>
                                    <th>Adjuntar Documento</th>
                                    <th>Tipo de Documento</th>
                                    <th>Opción</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyDocumentos2"></tbody>
                        </table>
                    </div>

                    <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm mt-3 hrefAgregarOtro2"
                       data-toggle="tooltip" title="Agregar documento">
                        <i class="flaticon2-plus"></i>
                    </a>
                </div>

            </div>
        </div>

        {{-- FOOTER --}}
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('cliente.listadocliente') }}" class="btn btn-secondary">
                Cancelar
            </a>
            <button type="button" id="btnGuardar" class="btn btn-warning px-10">
                <i class="flaticon2-check-mark"></i> Guardar
            </button>
        </div>

    </form>

</div>
</div>
</div>

@endsection
