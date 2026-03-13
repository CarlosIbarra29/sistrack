@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script>
@endpush

<<<<<<< HEAD
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

=======
>>>>>>> d039a95fbd0fd75c838ecc8adbd7165591c0b552
@section('title')
Agregar custodio
@endsection

@section('content')

<<<<<<< HEAD
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

=======
<div class="container-fluid">

    <!-- ENCABEZADO -->
    <div class="row mb-6">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center bg-white rounded shadow-sm px-6 py-5 border-left border-warning" style="border-left-width:5px !important;">
                <div>
                    <h2 class="mb-1 font-weight-bold text-dark">Agregar custodio</h2>
                    <span class="text-muted">Complete la información correspondiente del custodio</span>
                </div>

                <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-outline-warning font-weight-bold">
                    <i class="flaticon2-back"></i> Regresar
                </a>
            </div>
        </div>
    </div>

    <!-- CARD PRINCIPAL -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom shadow-sm border-0">

                <form action="{{ route('custodio.guardarcustodio') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
                    @csrf

                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>

                    <div class="card-body px-10 py-8">

                        <!-- TABS ESTILIZADAS -->
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-warning mb-8">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                                    Información básica
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_3">
                                    Domicilio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_4">
                                    Selección
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_5">
                                    Control de confianza
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                                    Documentos personales
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                                <div class="bg-light rounded p-6 mb-6 border">
                                    
                                   

                    <div class="tab-content mt-5">

                        
                        <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1">

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Usuario / Custodio</label>
                                    <select class="form-control" id="users_custodios" name="users_custodios" required >
                                        <option value="">Selecciona una opción</option>
                                        @foreach($users_custodio as $estado)
                                            <option value="{{ $estado->id }}" data-nombre="{{ $estado->name }}">
                                                Nombre:{{ $estado->name }}, Correo:{{ $estado->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="separator separator-dashed my-8"></div>

                            <div class="form-group row">
                                <div class="col-lg-6 form-group">
                                    <label>Fotografía</label>
                                    <div class='custom-file'>
                                        <input type='file' class='custom-file-input' id='file_carga' name='file_carga[]'/>
                                        <label class='custom-file-label'>Selecciona un archivo</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label>Fecha de ingreso</label>
                                    <input type="text" class="form-control" name="fecha_ingreso" id="fecha_ingreso" required/>
                                </div>
                                <div class="col-lg-3">
                                    <label>Fecha de baja</label>
                                    <input type="text" class="form-control" name="fecha_baja" id="fecha_baja" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Apellido paterno</label>
                                    <input type="text" class="form-control" name="ape_paterno" id="ape_paterno" required/>
                                </div>
                                <div class="col-lg-6">
                                    <label>Apellido materno</label>
                                    <input type="text" class="form-control" name="ape_materno" id="ape_materno" required/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Nombre(s)</label>
                                    <input type="text" class="form-control" name="nombre_custodio" id="nombre_custodio" required/>
                                </div>

                                <div class="col-lg-3">
                                    <label>Edad</label>
                                    <input type="number" class="form-control" name="edad" id="edad" />
                                </div>

                                <div class="col-lg-3">
                                    <label>Sexo</label>
                                    <select class="form-control" name="sexo" id="sexo">
                                        <option value="">Selecciona un opción</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                        <option value="3">Otro</option>
                                    </select>
                                </div>
                            </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Fecha de nacimiento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="fecha_nacimiento"  id="fecha_nacimiento" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Lugar de nacimiento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="lugar_nacimiento" id="lugar_nacimiento"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nacionalidad</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Estado civil</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="estado_civil" id="estado_civil"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>CURP</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="curp" id="curp"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>RFC</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="rfc" id="rfc"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Correo electronico</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="mail" id="mail"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Base</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="base" id="base"  />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Escolaridad</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="escolaridad" id="escolaridad"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Número Telefónico</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="telefono_custodio" id="telefono_custodio"/>
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade mt-10" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Calle</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_calle" id="dom_calle"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Núm. Ext. / Int.</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_num" id="dom_num"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Colonia</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_colonia" id="dom_colonia"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Municipio/ Delegación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_municipio" id="dom_municipio"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Estado</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_estado" id="dom_estado"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Código postal</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="dom_cp" id="dom_cp"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    
                            <div class="tab-pane fade mt-10" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Entrevista Inicial</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="entin_fecha" readonly id="entin_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="entin_comentario" id="entin_comentario"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Verificación Documental</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="verdoc_fecha" readonly id="verdoc_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="verdoc_comentario" id="verdoc_comentario"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Entrevista Operativa / Seguridad </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="entope_fecha" readonly id="entope_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="entope_comentario" id="entope_comentario"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    

                    
                            <div class="tab-pane fade mt-10" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">  
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Entrevista de Validación de Datos</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="valdat_fecha" readonly id="valdat_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="valdat_comentario" id="valdat_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Verificación de Referencias Personales</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="verref_fecha" readonly id="verref_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="verref_comentario" id="verref_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Verificación de Referencias Laborales</label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="verlab_fecha" readonly id="verlab_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="verlab_comentario" id="verlab_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Análisis Socioeconómico Laboral </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="anasoc_fecha" readonly id="anasoc_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="anasoc_comentario" id="anasoc_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Examen Físico </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="exafis_fecha" readonly id="exafis_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="exafis_comentario" id="exafis_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Examen Médico </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="examed_fecha" readonly id="examed_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="examed_comentario" id="examed_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Examen Psicológico </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="exapsi_fecha" readonly id="exapsi_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="exapsi_comentario" id="exapsi_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Examen Toxicológico </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="exatox_fecha" readonly id="exatox_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="exatox_comentario" id="exatox_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Test de Veracidad </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tesver_fecha" readonly id="tesver_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tesver_comentario" id="tesver_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Test de Robo </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tesrob_fecha" readonly id="tesrob_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tesrob_comentario" id="tesrob_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Test de Normas </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tesnor_fecha" readonly id="tesnor_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tesnor_comentario" id="tesnor_comentario"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-2">
                                        <label>Test de Soborno </label>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Fecha de aplicación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tessob_fecha" readonly id="tessob_fecha"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <label>Comentarios</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="tessob_comentario" id="tessob_comentario"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   


                            <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                <div class="row form-group" >
                                    <div class="col-lg-12" id="tblArchivos">
                                        <table class='table table-bordered table-hover' id='tblDocumentos'>
                                            <thead>
                                            <tr>
                                                <th>Adjuntar Documento</th>
                                                <th>Tipo de Documento</th>
                                                <th>Opción</th>
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
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="button"  id="btnGuardar" class="btn btn-warning mr-2"><i class="flaticon2-check-mark"></i>Guardar</button>
                                <a href="{{ route('custodio.listadocustodio') }}"  class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
>>>>>>> d039a95fbd0fd75c838ecc8adbd7165591c0b552
        </div>
    </div>
</div>

@endsection
