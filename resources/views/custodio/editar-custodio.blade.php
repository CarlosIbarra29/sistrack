@extends('layouts.app')

@push('styles')
   
@endpush

@section('title', 'Editar custodio')

@section('content')
<input type="hidden" id="documentoEliminarPath" value="{{ route('custodio.eliminardocumentocustodio') }}">

<div class="container-fluid px-0" id="main_form_custodio">
    <form action="{{ route('custodio.updatecustodio') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_custodio" value="{{ $custodio->id }}">

        
        <div class="row mb-6">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center rounded shadow-sm px-6 py-5" style="background-color: #1a1a1a;">
                    <div>
                        <h2 class="mb-1 title-forms">EDITAR CUSTODIO</h2>
                        <span class="text-muted">Registra la información general y administrativa del custodio</span>
                    </div>
                    <div class="d-flex gap-4">
                        <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-custodio-outline">
                            Regresar
                        </a>
                        <button type="button" id="btnGuardar" class="btn btn-custodio-solid">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
        <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>

        <div class="row">
            
            <div class="col-lg-3">
                <div class="card card-custom shadow-sm custodio-sidebar-card border-0 mb-6">
                    <div class="card-body p-0 text-center">
                        <div class="row mb-3">
                            <div class="col-12 text-center custodio-avatar-container">
                                <div class="custodio-avatar-wrapper mx-auto" style="background-image: url('{{ $custodio->fotografia_custodio != null ? route('archivo.fotografiaCustodio', $custodio->id) : asset('media/users/default.jpg') }}'); background-color: #f3f3f3;">
                                    <label class="custodio-avatar-upload" data-toggle="tooltip" title="Cambiar foto">
                                        <i class="fa fa-camera icon-sm"></i>
                                        <input type="file" name="profile_avatar" id="file_carga" accept=".png, .jpg, .jpeg" style="display: none;"/>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <span class="status-badge-activo">ACTIVO</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12 text-muted">
                                <span style="font-size: 0.95rem;">Nuevo custodio</span><br>
                                <span style="font-size: 0.8rem;">Sin número de empleado</span>
                            </div>
                        </div>

                        <div class="row progress-container mb-5 text-left px-3">
                            <div class="col-12 d-flex justify-content-between mb-1">
                                <span>Completitud del perfil</span>
                                <span class="font-weight-bold text-white">75%</span>
                            </div>
                            <div class="col-12">
                                <div class="progress-bar-custom">
                                    <div class="progress-bar-fill" style="width: 75%;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-left px-3 mb-6">
                            <div class="col-12">
                                <h4 class="text-white font-weight-bold mb-4">Linea tiempo</h4>
                                <ul class="timeline-custodio">
                                    <li class="timeline-custodio-item active">Información General</li>
                                    <li class="timeline-custodio-item">Documentación</li>
                                    <li class="timeline-custodio-item">Referencias</li>
                                    <li class="timeline-custodio-item">Datos laborales</li>
                                    <li class="timeline-custodio-item">Capacitación</li>
                                    <li class="timeline-custodio-item">Asignación</li>
                                </ul>
                            </div>
                        </div>

                        
                        <div class="text-left px-3 mt-4">
                            
                            <div class="info-box-card-large">
                                <div class="info-box-title">
                                    <i class="fa fa-car text-warning"></i> Vehículo asignado
                                </div>
                                <div class="info-box-body-wrapper">
                                    @if($vehiculo_custod == null)
                                        <div class="text-muted text-center py-2">
                                            <p class="mb-4" style="font-size: 0.95rem;">No tiene vehículo asignado.</p>
                                            <a href="{{ route('custodio.agregarvehiculo', $custodio->id) }}" class="btn btn-custodio-outline">
                                                Asignar
                                            </a>
                                        </div>
                                    @else
                                        <div class="row align-items-center info-box-content py-2">
                                            <div class="col-12 text-center mb-3">
                                                <img src="{{ route('archivo.documentovehiculoficha', $vehiculo_custod->id) }}" class="img-fluid" style="max-height: 90px; border-radius: 4px;">
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-2" style="font-size: 0.9rem;"><span class="info-box-label">Vehículo:</span> {{ $vehiculo_custod->vehiculo }}</p>
                                                <p class="mb-2" style="font-size: 0.9rem;"><span class="info-box-label">Serie:</span> {{ $vehiculo_custod->no_serie }}</p>
                                                <p class="mb-2" style="font-size: 0.9rem;"><span class="info-box-label">Placa:</span> {{ $vehiculo_custod->placa }}</p>
                                                <p class="mb-0" style="font-size: 0.9rem;"><span class="info-box-label">Estatus:</span> <span class="text-doc-cargado font-weight-bold">ACTIVO</span></p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="info-box-card-large">
                                <div class="info-box-title">
                                    <i class="fa fa-shuttle-van text-warning"></i> Datos del Arma
                                </div>
                                <div class="info-box-body-wrapper">
                                    @if($arma_custod == null)
                                        <div class="text-muted text-center py-2">
                                            <p class="mb-4" style="font-size: 0.95rem;">No tiene arma asignada.</p>
                                            <a href="{{ route('custodio.agregararma', $custodio->id) }}" class="btn btn-custodio-outline">
                                                Asignar
                                            </a>
                                        </div>
                                    @else
                                        <div class="row align-items-center info-box-content py-2">
                                            <div class="col-12 text-center mb-3">
                                                <img src="{{ route('archivo.documentoarmaficha', $arma_custod->id) }}" class="img-fluid" style="max-height: 90px; border-radius: 4px;">
                                            </div>
                                            <div class="col-12">
                                                <p class="mb-2" style="font-size: 0.9rem;"><span class="info-box-label">Registro:</span> {{ $arma_custod->registro_arma }}</p>
                                                <p class="mb-0" style="font-size: 0.9rem;"><span class="info-box-label">Vigencia:</span> {{ $arma_custod->vigencia_portacion }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="col-lg-9">
                <div class="card card-custom shadow-sm border-0 mb-6" style="background-color: #1a1a1a; border-radius: 8px;">
                    <div class="card-body px-10 py-8">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-warning mb-8">
                            <li class="nav-item">
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">Información básica</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_3">Domicilio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_4">Selección</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">Documentos personales</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5">
                            
                            <div class="tab-pane fade show active" id="kt_tab_pane_1">
                                <h3 class="section-tab-title">Información básica</h3>

                                <div class="form-group row align-items-end">
                                    <div class="col-lg-4">
                                        <label>Tipo de custodio</label>
                                        <div class="radio-custom-group">
                                            <label class="radio-custom-label">
                                                <input type="radio" name="tipo_custodio" value="1" {{ $custodio->tipo_custodio == 1 ? 'checked' : '' }}>
                                                <span class="radio-custom-checkmark"></span>
                                                Custodio
                                            </label>
                                            <label class="radio-custom-label">
                                                <input type="radio" name="tipo_custodio" value="2" {{ $custodio->tipo_custodio == 2 ? 'checked' : '' }}>
                                                <span class="radio-custom-checkmark"></span>
                                                Armados
                                            </label>
                                            <label class="radio-custom-label">
                                                <input type="radio" name="tipo_custodio" value="3" {{ $custodio->tipo_custodio == 3 ? 'checked' : '' }}>
                                                <span class="radio-custom-checkmark"></span>
                                                Segundos
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Usuario / Custodio</label>
                                        <select class="form-control" id="users_custodios" name="users_custodios">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($users_custodio as $estado)
                                                <option value="{{ $estado->id }}" data-nombre="{{ $estado->name }}" @selected($custodio->users_custodios == $estado->id)>Nombre:{{ $estado->name }}, Correo:{{ $estado->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Usuario / Responsable</label>
                                        <select class="form-control" id="users_responsable" name="users_responsable">
                                            <option value="">Selecciona una opción</option>
                                            @foreach($users_responsable as $estado)
                                                <option value="{{ $estado->id }}" data-nombre="{{ $estado->name }}" @selected($custodio->users_responsable == $estado->id)>Nombre:{{ $estado->name }}, Correo:{{ $estado->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mt-5">
                                    <div class="col-lg-4">
                                        <label>Fecha de ingreso</label>
                                        <input type="text" class="form-control" value="{{ $custodio->fecha_ingreso != null ? date('d/m/Y', strtotime($custodio->fecha_ingreso)) : '' }}" name="fecha_ingreso" id="fecha_ingreso" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Fecha de baja</label>
                                        <input type="text" class="form-control" value="{{ $custodio->fecha_baja != null ? date('d/m/Y', strtotime($custodio->fecha_baja)) : '' }}" name="fecha_baja" id="fecha_baja"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Nombre(s)</label>
                                        <input type="text" class="form-control" name="nombre_custodio" id="nombre_custodio" value="{{ $custodio->nombre_custodio }}" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Apellido paterno</label>
                                        <input type="text" class="form-control" name="ape_paterno" id="ape_paterno" value="{{ $custodio->ap_paterno }}" required/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Apellido materno</label>
                                        <input type="text" class="form-control" name="ape_materno" id="ape_materno" value="{{ $custodio->ap_materno }}" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Edad</label>
                                        <input type="number" class="form-control" value="{{ $custodio->edad }}" name="edad" id="edad"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Sexo</label>
                                        <select class="form-control" name="sexo" id="sexo">
                                            <option value="">Selecciona un opción</option>
                                            <option value="1" {{ $custodio->sexo == 1 ? 'selected' : '' }}>Masculino</option>
                                            <option value="2" {{ $custodio->sexo == 2 ? 'selected' : '' }}>Femenino</option>
                                            <option value="3" {{ $custodio->sexo == 3 ? 'selected' : '' }}>Otro</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Fecha de nacimiento</label>
                                        <input type="text" class="form-control" name="fecha_nacimiento" value="{{ date('d/m/Y', strtotime($custodio->fecha_nacimiento)) }}" id="fecha_nacimiento" required/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Lugar de nacimiento</label>
                                        <input type="text" class="form-control" name="lugar_nacimiento" id="lugar_nacimiento" value="{{ $custodio->lugar_nacimiento }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Nacionalidad</label>
                                        <input type="text" class="form-control" name="nacionalidad" id="nacionalidad" value="{{ $custodio->nacionalidad }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Estado civil</label>
                                        <input type="text" class="form-control" name="estado_civil" id="estado_civil" value="{{ $custodio->estado_civil }}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>CURP</label>
                                        <input type="text" class="form-control" name="curp" id="curp" value="{{ $custodio->curp }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>RFC</label>
                                        <input type="text" class="form-control" name="rfc" id="rfc" value="{{ $custodio->rfc }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Correo electronico</label>
                                        <input type="email" class="form-control" name="mail" id="mail" value="{{ $custodio->correo_electronico }}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Base</label>
                                        <input type="text" class="form-control" name="base" id="base" value="{{ $custodio->base }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Escolaridad</label>
                                        <input type="text" class="form-control" name="escolaridad" id="escolaridad" value="{{ $custodio->escolaridad }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Número Telefónico</label>
                                        <input type="text" class="form-control" name="telefono_custodio" id="telefono_custodio" value="{{ $custodio->numero_telefono }}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Correo ASSISTCARGO</label>
                                        <input type="email" class="form-control" name="correo_assistcargo" id="correo_assistcargo" value="{{ $custodio->correo_assistcargo }}"/>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Contraseña ASSISTCARGO</label>
                                        <input type="password" class="form-control" name="contraseña_assistcargo" id="contraseña_assistcargo" value="{{ $custodio->contraseña_assistcargo }}"/>
                                    </div>
                                    
                                    <!-- SWITCH: IDENTIFICACIÓN -->
                                    <div class="col-lg-4">
                                        <div class="custom-switch-container">
                                            <span class="custom-switch-label">Identificación</span>
                                            <label class="theme-switch">
                                                <input type="checkbox" id="switch_identificacion" {{ $custodio->identificacion_custodio == 0 ? 'checked' : '' }}>
                                                <span class="theme-slider"></span>
                                            </label>
                                        </div>
                                        <input type="hidden" name="identificacion_custodio" id="identificacion_custodio" value="{{ $custodio->identificacion_custodio }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    
                                    <div class="col-lg-4">
                                        <div class="custom-switch-container">
                                            <span class="custom-switch-label">Contrato</span>
                                            <label class="theme-switch">
                                                <input type="checkbox" id="switch_contrato" {{ $custodio->contrato_custodio == 1 ? 'checked' : '' }}>
                                                <span class="theme-slider"></span>
                                            </label>
                                        </div>
                                        <input type="hidden" name="contrato_custodio" id="contrato_custodio" value="{{ $custodio->contrato_custodio }}">
                                    </div>
                                </div>

                                
                                <h3 class="section-tab-title mt-8">Recursos asignados</h3>
                                <div class="form-group row">
                                    <div class="col-lg-3 col-md-6 mb-5">
                                        <div class="custom-switch-container">
                                            <span class="custom-switch-label">GPS Fijo</span>
                                            <label class="theme-switch">
                                                <input type="checkbox" id="switch_gps_fijo" {{ ($custodio->tipo_gps == 0 || $custodio->tipo_gps == 2) ? 'checked' : '' }}>
                                                <span class="theme-slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-5">
                                        <div class="custom-switch-container">
                                            <span class="custom-switch-label">GPS Portátil</span>
                                            <label class="theme-switch">
                                                <input type="checkbox" id="switch_gps_portatil" {{ ($custodio->tipo_gps == 1 || $custodio->tipo_gps == 2) ? 'checked' : '' }}>
                                                <span class="theme-slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-5">
                                        <div class="custom-switch-container">
                                            <span class="custom-switch-label">Candado</span>
                                            <label class="theme-switch">
                                                <input type="checkbox" id="switch_candado" {{ $custodio->candado_servicio == 1 ? 'checked' : '' }}>
                                                <span class="theme-slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 mb-5">
                                        <div class="custom-switch-container">
                                            <span class="custom-switch-label">Uniforme</span>
                                            <label class="theme-switch">
                                                <input type="checkbox" id="switch_uniforme" {{ $custodio->chaleco_servicio == 1 ? 'checked' : '' }}>
                                                <span class="theme-slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="tipo_gps" id="tipo_gps" value="{{ $custodio->tipo_gps }}">
                                <input type="hidden" name="candado_servicio" id="candado_servicio" value="{{ $custodio->candado_servicio }}">
                                <input type="hidden" name="chaleco_servicio" id="chaleco_servicio" value="{{ $custodio->chaleco_servicio }}">
                            </div>

                            
                            <div class="tab-pane fade" id="kt_tab_pane_3">
                                <h3 class="section-tab-title">Domicilio</h3>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Calle</label>
                                        <input type="text" class="form-control" value="{{ $custodio->dom_calle }}" name="dom_calle" id="dom_calle"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Núm. Ext. / Int.</label>
                                        <input type="text" class="form-control" name="dom_num" value="{{ $custodio->dom_num }}" id="dom_num"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Colonia</label>
                                        <input type="text" class="form-control" value="{{ $custodio->dom_colonia }}" name="dom_colonia" id="dom_colonia"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Municipio/ Delegación</label>
                                        <input type="text" class="form-control" name="dom_municipio" value="{{ $custodio->dom_municipio }}" id="dom_municipio"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Estado</label>
                                        <input type="text" class="form-control" name="dom_estado" value="{{ $custodio->dom_estado }}" id="dom_estado"/>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Código postal</label>
                                        <input type="text" class="form-control" name="dom_cp" value="{{ $custodio->dom_cp }}" id="dom_cp"/>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade" id="kt_tab_pane_4">
                                <h3 class="section-tab-title">Selección y Entrevistas</h3>
                                @if($custodio_seleccion == null)
                                    <div class="alert alert-custom alert-light-warning fade show mb-8 border border-warning" role="alert" style="background-color: #2a2215;">
                                        <div class="alert-icon"><i class="flaticon-warning text-warning"></i></div>
                                        <div class="alert-text text-warning font-weight-bold">No hay datos de selección registrados para este custodio aún.</div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <div class="col-lg-2"><label>Entrevista Inicial</label></div>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" readonly value="{{ $custodio_seleccion->entin_fecha != null ? date('d/m/Y', strtotime($custodio_seleccion->entin_fecha)) : '' }}"/>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="entin_comentario" value="{{ $custodio_seleccion->entin_comentario }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2"><label>Verificación Documental</label></div>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" readonly value="{{ $custodio_seleccion->verdoc_fecha != null ? date('d/m/Y', strtotime($custodio_seleccion->verdoc_fecha)) : '' }}"/>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="verdoc_comentario" value="{{ $custodio_seleccion->verdoc_comentario }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2"><label>Entrevista Operativa</label></div>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control" readonly value="{{ $custodio_seleccion->entope_fecha != null ? date('d/m/Y', strtotime($custodio_seleccion->entope_fecha)) : '' }}"/>
                                        </div>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" name="entope_comentario" value="{{ $custodio_seleccion->entope_comentario }}"/>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            
                            <div class="tab-pane fade" id="kt_tab_pane_2">
                                <h3 class="section-tab-title">Documentación</h3>
                                <table class="table mb-6 table-responsive" id="tblDocumentos">
                                    <thead>
                                        <tr>
                                            <th scope="col">Documento</th>
                                            <th scope="col">Tipo de Documento</th>
                                            <th scope="col">Vigencia</th>
                                            <th scope="col">Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentos'>
                                        @foreach($documentos as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td><a href="{{ route('archivo.documentocustodio', ['id'=>$documento->id]) }}" class="text-white font-weight-bold" target="_blank">{{ $documento->documento }}</a></td>
                                                <td>{{ $documento->custodioDocumentacion->tipo_documento }}</td>
                                                <td>{{ $documento->vigencia }}</td>
                                                <td>
                                                    <a href='#' class='btn btn-clean btn-icon btn-outline-danger btn-sm hrefEliminarDocumento' data-id='{{ $documento->id }}' data-documento='{{ $documento->documento }}' data-toggle='tooltip' title='Eliminar'>
                                                        <i class='flaticon-delete'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <a href="#" class="btn btn-outline-warning btn-pill font-weight-bold hrefAgregarOtro">
                                            <i class="flaticon2-plus"></i> Agregar archivo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="info-box-card-large" style="background-color: #1a1a1a !important; min-height: auto; padding: 1.5rem !important; margin-bottom: 0 !important;">
                    <div class="info-box-title mb-3">
                        <i class="fa fa-edit text-warning"></i> Observaciones
                    </div>
                    <div class="form-group mb-0">
                        <textarea class="form-control" name="observaciones" id="observaciones" rows="4" placeholder="Agrega observaciones adicionales sobre el custodio" style="background-color: #121212 !important; border-color: #333;"></textarea>
                    </div>
                </div>

            </div>
        </div>

    </form>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('js/perfil/Informacion.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custodios/EditarCustodio.js') }}"></script>

    <script>
        $(document).ready(function() {
            
            $('#switch_identificacion').on('change', function() {
                $('#identificacion_custodio').val($(this).is(':checked') ? 0 : 1);
            });

            
            $('#switch_contrato').on('change', function() {
                $('#contrato_custodio').val($(this).is(':checked') ? 1 : 2);
            });

            
            function actualizarGpsHidden() {
                let fijo = $('#switch_gps_fijo').is(':checked');
                let portatil = $('#switch_gps_portatil').is(':checked');

                if (fijo && portatil) {
                    $('#tipo_gps').val(2); 
                } else if (fijo) {
                    $('#tipo_gps').val(0); 
                } else if (portatil) {
                    $('#tipo_gps').val(1); 
                } else {
                    $('#tipo_gps').val(''); 
                }
            }

            $('#switch_gps_fijo, #switch_gps_portatil').on('change', function() {
                actualizarGpsHidden();
            });

            
            $('#switch_candado').on('change', function() {
                $('#candado_servicio').val($(this).is(':checked') ? 1 : 2);
            });

            
            $('#switch_uniforme').on('change', function() {
                $('#chaleco_servicio').val($(this).is(':checked') ? 1 : 2);
            });
        });
    </script>
@endpush