@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/custodios/AgregarArma.js') }}"></script>
@endpush

@section('title')
    Agregar arma del custodio
@endsection

@section('content')

<div class="container-fluid">
    <form action="{{ route('custodio.guardarinfoarma') }}" method="post" id="submit_vehiculo" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-custom shadow-sm border-0">
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>
                    <input type="hidden" name="custodio_id" value="{{ $custodio->id }}">

                    <div class="card-body px-10 py-8">
                        
                        
                        <div class="d-flex justify-content-between align-items-center mb-10 border-left border-warning" style="border-left-width:5px !important; padding-left: 20px;">
                            <div>
                                <h2 class="mb-1 font-weight-bold text-white">Registro del arma</h2>
                                <span class="text-muted">Complete la información correspondiente del arma asignado al custodio</span>
                            </div>
                            <div class="d-flex gap-3">
                                <a href="{{ route('custodio.editarcustodio', $custodio->id) }}" class="btn btn-regresar-custom font-weight-bold">
                                    Regresar
                                </a>
                                <button type="button" id="btnGuardar" class="btn btn-warning font-weight-bold px-8" style="background-color: #ffa800; border: none; color: #000;">
                                    GUARDAR Y ACTIVAR
                                </button>
                            </div>
                        </div>

                        
                        <h5 class="font-weight-bold text-warning mb-6 text-uppercase">Datos del arma</h5>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="text-white">Fotografia</label>
                                <input type="file" class="form-control form-control-lg" name="fotografia" id="fotografia" required/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label class="text-white">No. Registro</label>
                                <input type="text" class="form-control form-control-lg" name="registro_arma" id="registro_arma" required/>
                            </div>
                            <div class="col-lg-6">
                                <label class="text-white">Vigencia de portación</label>
                                <input type="text" class="form-control form-control-lg" name="vigencia_portacion" id="vigencia_portacion" readonly required/>
                            </div>
                        </div>
                        <div class="form-group mb-8">
                            <label class="text-white">Observaciones</label>
                            <textarea class="form-control form-control-lg" name="observaciones" id="observaciones" rows="3"></textarea>
                        </div>

                        <hr class="border-secondary mb-8">

                        
                        <div class="row">
                            <div class="col-lg-8">
                                <h5 class="font-weight-bold text-warning mb-4 text-uppercase">Documentación</h5>
                                <table class='table table-borderless text-white' id='tblDocumentos'>
                                    <thead>
                                        <tr>
                                            <th>Adjuntar Documento</th>
                                            <th>Tipo</th>
                                            <th>Vigencia</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentos'></tbody>
                                </table>
                                <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm hrefAgregarOtro">
                                    <i class="flaticon2-plus"></i>
                                </a>
                            </div>

                            <div class="col-lg-4">
                                <h5 class="font-weight-bold text-warning mb-4 text-uppercase">Fotografías</h5>
                                <table class='table table-borderless text-white' id='tblDocumentosF'>
                                    <thead>
                                        <tr>
                                            <th>Adjuntar Fotografía</th>
                                            <th width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentosf'></tbody>
                                </table>
                                <a href="#" class="btn btn-icon btn-outline-warning btn-circle btn-sm hrefAgregarOtroF">
                                    <i class="flaticon2-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection