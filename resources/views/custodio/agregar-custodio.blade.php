@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script>
@endpush

@push('styles')
<style>

/* Card principal */
.card-custom {
    border-radius: 16px;
    border: 1px solid #eef1f5;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}

/* Header limpio */
.card-header {
    background: #ffffff;
    border-bottom: 1px solid #f1f3f7;
    padding: 25px 30px;
}

.card-title {
    font-weight: 700;
    font-size: 20px;
    color: #2c3e50;
}

/* Tabs estilo moderno */
.nav-tabs {
    border-bottom: 1px solid #e9ecef;
}

.nav-tabs .nav-link {
    border: none;
    color: #7a7a7a;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 8px 8px 0 0;
}

.nav-tabs .nav-link.active {
    background: #f8f9fc;
    color: #f39c12;
    border-bottom: 3px solid #f39c12;
}

/* Contenedor interno */
.form-section {
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #f1f3f7;
}

/* Subtítulos */
.section-title {
    font-size: 15px;
    font-weight: 700;
    color: #34495e;
    margin-bottom: 25px;
    border-left: 4px solid #f39c12;
    padding-left: 10px;
}

/* Labels */
label {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #7b8a8b;
}

/* Inputs */
.form-control {
    border-radius: 10px;
    border: 1px solid #e1e5eb;
    padding: 10px 14px;
    transition: 0.2s ease;
}

.form-control:focus {
    border-color: #f39c12;
    box-shadow: 0 0 0 2px rgba(243,156,18,.15);
}

/* Footer */
.card-footer {
    background: #ffffff;
    border-top: 1px solid #f1f3f7;
    padding: 20px 30px;
}

/* Botones */
.btn-warning {
    border-radius: 8px;
    font-weight: 600;
}

</style>
@endpush

@section('title')
Agregar custodio
@endsection

@section('content')

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card card-custom">

            <!-- HEADER -->
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title">
                        Nuevo Registro de Custodio
                    </div>
                    <small class="text-muted">
                        Complete la información correspondiente
                    </small>
                </div>

                <a href="{{ route('custodio.listadocustodio') }}" 
                   class="btn btn-warning">
                    <i class="flaticon2-back"></i> Regresar
                </a>
            </div>

            <!-- FORM -->
            <form action="{{ route('custodio.guardarcustodio') }}" 
                  method="post" 
                  id="submit_cliente" 
                  enctype="multipart/form-data">
                @csrf

                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>

                <div class="card-body">

                    <!-- TABS -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información básica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Domicilio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Selección</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Control de confianza</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Documentos</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-4">

                        <!-- INFORMACIÓN BÁSICA -->
                        <div class="tab-pane fade show active" id="kt_tab_pane_1">
                            <div class="form-section">
                                <div class="section-title">Datos Generales</div>

                                <!-- AQUÍ PEGA TU CONTENIDO ORIGINAL DE INFORMACIÓN BÁSICA -->

                            </div>
                        </div>

                        <!-- DOMICILIO -->
                        <div class="tab-pane fade" id="kt_tab_pane_3">
                            <div class="form-section">
                                <div class="section-title">Información de Domicilio</div>

                                <!-- PEGA AQUÍ TU CONTENIDO ORIGINAL -->

                            </div>
                        </div>

                        <!-- SELECCIÓN -->
                        <div class="tab-pane fade" id="kt_tab_pane_4">
                            <div class="form-section">
                                <div class="section-title">Proceso de Selección</div>

                                <!-- PEGA AQUÍ TU CONTENIDO ORIGINAL -->

                            </div>
                        </div>

                        <!-- CONTROL -->
                        <div class="tab-pane fade" id="kt_tab_pane_5">
                            <div class="form-section">
                                <div class="section-title">Control de Confianza</div>

                                <!-- PEGA AQUÍ TU CONTENIDO ORIGINAL -->

                            </div>
                        </div>

                        <!-- DOCUMENTOS -->
                        <div class="tab-pane fade" id="kt_tab_pane_2">
                            <div class="form-section">
                                <div class="section-title">Documentación Adjunta</div>

                                <!-- PEGA AQUÍ TU CONTENIDO ORIGINAL -->

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="button" id="btnGuardar" class="btn btn-warning mr-2">
                        <i class="flaticon2-check-mark"></i> Guardar
                    </button>
                    <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-secondary">
                        Cancelar
                    </a>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
