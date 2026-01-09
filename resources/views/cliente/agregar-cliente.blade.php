@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush
@section('title', 'Agregar cliente')
@section('content')



<style>
    .form-control-solid { background-color: #F3F6F9; border-color: transparent; font-weight: 500; }
    .form-control-solid:focus { background-color: #EBEDF3; border-color: transparent; }
    label { font-weight: 600; color: #3F4254; margin-bottom: .5rem; }
    .separator.separator-dashed { border-bottom: 1px dashed #EBEDF3; }
    .card-title-custom { font-size: 1.2rem; font-weight: 700; color: #181C32; }
</style>

<div class="row">
<div class="col-lg-12">
<div class="card card-custom gutter-b">

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

    <form action="{{ route('cliente.guardarcliente') }}" method="POST" id="submit_cliente" enctype="multipart/form-data">
        @csrf

        <div class="card-body">

            {{-- TABS --}}
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-primary">
                <li class="nav-item">
                    <a class="nav-link active font-weight-bold" data-toggle="tab" href="#tab_cliente">
                        <i class="flaticon2-user mr-2"></i> Información del Cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" data-toggle="tab" href="#tab_documentos">
                        <i class="flaticon2-file mr-2"></i> Documentación
                    </a>
                </li>
            </ul>

            <div class="tab-content mt-8">

                {{-- TAB CLIENTE --}}
                <div class="tab-pane fade show active" id="tab_cliente">

                    <div class="row mb-6">
                        <div class="col-lg-4">
                            <label>Razón social <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-solid" name="razon_social" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Nombre comercial <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-solid" name="cliente" required>
                        </div>
                        <div class="col-lg-4">
                            <label>Grupo</label>
                            <input type="text" class="form-control form-control-solid" name="grupo">
                        </div>
                    </div>

                    <div class="separator separator-dashed my-8"></div>

                    <h4 class="card-title-custom mb-4">Información Técnica</h4>

                    <div class="row mb-6">
                        <div class="col-lg-3">
                            <label>Días de crédito</label>
                            <input type="number" class="form-control form-control-solid" name="dias_credito">
                        </div>
                        <div class="col-lg-3">
                            <label>Costo estadía</label>
                            <input type="text" class="form-control form-control-solid" name="costo_estadia">
                        </div>
                        <div class="col-lg-3">
                            <label>Costo km extra</label>
                            <input type="text" class="form-control form-control-solid" name="costo_km">
                        </div>
                        <div class="col-lg-3">
                            <label>Costo estadía no armada</label>
                            <input type="text" class="form-control form-control-solid" name="costo_estadia_armada">
                        </div>
                    </div>

                    <div class="row mt-6">
                        <div class="col-lg-12">
                            <label>Observaciones</label>
                            <textarea class="form-control form-control-solid" name="observaciones" rows="3"></textarea>
                        </div>
                    </div>

                </div>

                {{-- TAB DOCUMENTOS --}}
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

        {{-- FOOTER --}}
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('cliente.listadocliente') }}" class="btn btn-secondary">
                Cancelar
            </a>

            <button type="submit" id="btnGuardar" class="btn btn-warning px-10">
                <i class="flaticon2-check-mark"></i> Guardar
            </button>
        </div>

    </form>

</div>
</div>
</div>
@endsection
