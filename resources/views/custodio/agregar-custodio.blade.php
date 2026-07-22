@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script>
    <script src="{{ asset('js/perfil/Informacion.js') }}" type="text/javascript"></script>
@endpush

@section('title')
    Agregar custodio
@endsection

@section('content')




<div class="container-fluid main-dark-container">
    <form action="{{ route('custodio.guardarcustodio') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
    @csrf

    
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center py-3">
                <div>
                    <h2 class="mb-1 main-title-gold">ALTA DE CUSTODIO</h2>
                    <span class="text-muted" style="font-size: 0.85rem;">Registra la información general y administrativa del nuevo custodio.</span>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ route('custodio.listadocustodio') }}" class="btn btn-outline-dark-gold mr-3 px-5 py-2">
                        Regresar
                    </a>
                    <button type="button" id="btnGuardar" class="btn btn-gold-submit px-6 py-2">
                        GUARDAR Y ACTIVAR
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
    <input type='hidden' id='tipoArchivov' value='{{ $cadenaTipoDocumento }}'>

    <div class="row">
        
        <div class="col-lg-3 mb-6">
            <div class="card custom-card-dark py-6 px-5 text-center">
                <span class="text-muted font-weight-bold text-uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">Nuevo Custodio</span>
                
                <div class="my-5">
                    <div class="image-input image-input-outline" id="kt_profile_avatar">
                                        <div class="image-input-wrapper"style=" background-color: #f3f3f3;">
                                        </div>
                                                            
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Cambiar foto de custodio">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="profile_avatar" id="file_carga" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="profile_avatar_remove" />
                                            </label>

                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Eliminar">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                    </div>
                </div>

                <div class="mb-4">
                    <span class="badge-status-active">ACTIVO</span>
                </div>

                <div class="mb-5">
                    <span class="text-white d-block font-weight-bold" style="font-size: 0.85rem;">Sin número de empleado</span>
                    <span class="text-muted d-block" style="font-size: 0.75rem;">Nuevo registro</span>
                </div>

                <div class="mb-6 text-left" style="border-top: 1px solid #1f242c; padding-top: 15px;">
                    <div class="d-flex justify-content-between mb-2" style="font-size: 0.75rem;">
                        <span class="text-muted">Completitud del perfil</span>
                        <span class="font-weight-bold text-warning">45%</span>
                    </div>
                    <div class="progress" style="height: 5px; background-color: #141923;">
                        <div class="progress-bar" role="progressbar" style="width: 45%; background-color: #e5a913;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>        

                <div class="text-left">
                    <ul class="sidebar-steps-list">
                        <li class="sidebar-step-item active"><span class="step-number">1</span> Información general</li>
                        <li class="sidebar-step-item"><span class="step-number">2</span> Documentación</li>
                        <li class="sidebar-step-item"><span class="step-number">3</span> Referencias</li>
                        <li class="sidebar-step-item"><span class="step-number">4</span> Datos laborales</li>
                        <li class="sidebar-step-item"><span class="step-number">5</span> Capacitación</li>
                        <li class="sidebar-step-item"><span class="step-number">6</span> Asignación</li>
                    </ul>
                </div>
            </div>
        </div>   

        
        <div class="col-lg-9 mb-6">
            <div class="card custom-card-dark">
                <div class="card-header custom-card-header-dark p-0">
                    <ul class="nav nav-tabs custom-nav-tabs-dark border-0">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información general</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Dirección</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Contacto</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Información fiscal</a></li>
                    </ul>
                </div>

                <div class="card-body px-6 py-6">
                    <div class="tab-content">
                        
                        
                        <div class="tab-pane fade show active" id="kt_tab_pane_1">
                            <h4 class="text-gold-label mb-5">Información básica</h4>

                            <div class="row form-group mb-5">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Nombre(s) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control dark-form-control" name="nombre_custodio" id="nombre_custodio" required />
                                </div>
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Apellidos <span class="text-danger">*</span></label>
                                    <div class="row no-gutters">
                                        <div class="col-6 pr-1">
                                            <input type="text" class="form-control dark-form-control" name="ape_paterno" id="ape_paterno" placeholder="Paterno" required />
                                        </div>
                                        <div class="col-6 pl-1">
                                            <input type="text" class="form-control dark-form-control" name="ape_materno" id="ape_materno" placeholder="Materno" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-label-muted">Fecha de nacimiento <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control dark-form-control" name="fecha_nacimiento" id="fecha_nacimiento" required />
                                        <i class="fa fa-calendar position-absolute" style="right: 12px; top: 13px; color: #4a5568;"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="row form-group mb-5">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label class="text-label-muted">CURP <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control dark-form-control" name="curp" id="curp" />
                                </div>
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label class="text-label-muted">RFC <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control dark-form-control" name="rfc" id="rfc" />
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-label-muted">Sucursal / Correo electrónico</label>
                                    <input type="text" class="form-control dark-form-control" name="mail" id="mail" placeholder="correo@empresa.com" />
                                </div>
                            </div>

                            <div class="row form-group mb-6">
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Número de empleado</label>
                                    <input type="text" class="form-control dark-form-control" placeholder="Se generará automáticamente" readonly />
                                </div>
                                <div class="col-lg-4 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Fecha de ingreso <span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="text" class="form-control dark-form-control" name="fecha_ingreso" id="fecha_ingreso" required />
                                        <i class="fa fa-calendar position-absolute" style="right: 12px; top: 13px; color: #4a5568;"></i>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label class="text-label-muted">Puesto / Cargo <span class="text-danger">*</span></label>
                                    <select class="form-control dark-form-control text-white" name="tipo_custodio" id="tipo_custodio">
                                        <option value="1">Custodio Principal</option>
                                        <option value="2">Custodio Armado</option>
                                        <option value="3">Custodio Segundo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group mb-5 d-none">
                                <input type="hidden" name="fecha_baja" id="fecha_baja" />
                                <input type="number" name="edad" id="edad" value="30" />
                                <input type="hidden" name="sexo" id="sexo" value="1" />
                                <input type="hidden" name="lugar_nacimiento" id="lugar_nacimiento" />
                                <input type="hidden" name="nacionalidad" id="nacionalidad" />
                                <input type="hidden" name="estado_civil" id="estado_civil" />
                                <input type="hidden" name="escolaridad" id="escolaridad" />
                                <input type="hidden" name="base" id="base" />
                            </div>

                            <hr style="border-color: #1f242c;" class="my-6">
                            
                            <h4 class="text-gold-label mb-4">Recursos asignados</h4>
                            <div class="row form-group mb-6">
                                <div class="col-lg-3 col-6 mb-3">
                                    <label class="text-label-muted d-block">GPS FIJO</label>
                                    <label class="gold-switch">
                                        <input type="checkbox" name="tipo_gps" value="0" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-6 mb-3">
                                    <label class="text-label-muted d-block">GPS PORTÁTIL</label>
                                    <label class="gold-switch">
                                        <input type="checkbox" name="tipo_gps_portatil" value="1">
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-6 mb-3">
                                    <label class="text-label-muted d-block">CANDADO</label>
                                    <label class="gold-switch">
                                        <input type="checkbox" name="candado_servicio" value="1" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                                <div class="col-lg-3 col-6 mb-3">
                                    <label class="text-label-muted d-block">UNIFORME</label>
                                    <label class="gold-switch">
                                        <input type="checkbox" name="chaleco_servicio" value="1" checked>
                                        <span class="switch-slider"></span>
                                    </label>
                                </div>
                            </div>

                            <hr style="border-color: #1f242c;" class="my-6">

                            <h4 class="text-gold-label mb-4">Credenciales y acceso</h4>
                            <div class="row form-group mb-0">
                                <div class="col-lg-3 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Correo institucional</label>
                                    <input type="email" class="form-control dark-form-control" name="correo_assistcargo" id="correo_assistcargo" />
                                </div>
                                <div class="col-lg-3 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Usuario de acceso</label>
                                    <input type="text" class="form-control dark-form-control" placeholder="Se generará automáticamente" readonly />
                                    <input type="hidden" name="contraseña_assistcargo" id="contraseña_assistcargo" value="123456" />
                                </div>
                                <div class="col-lg-3 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Rol del sistema</label>
                                    <select class="form-control dark-form-control text-white">
                                        <option>Custodio</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label class="text-label-muted d-block">Puede acceder a la app móvil</label>
                                    <div class="d-flex align-items-center mt-2">
                                        <label class="gold-switch">
                                            <input type="checkbox" name="identificacion_custodio" value="0" checked>
                                            <span class="switch-slider"></span>
                                        </label>
                                        <span class="text-white ml-3 font-weight-bold" style="font-size: 0.9rem;">Sí</span>
                                    </div>
                                </div>
                            </div>
                        </div>  

                        
                        <div class="tab-pane fade" id="kt_tab_pane_3">
                            <h4 class="text-gold-label mb-5">Domicilio</h4>
                            <div class="row form-group mb-5">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Calle</label>
                                    <input type="text" class="form-control dark-form-control" name="dom_calle" id="dom_calle"/>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-label-muted">Núm. Ext. / Int.</label>
                                    <input type="text" class="form-control dark-form-control" name="dom_num" id="dom_num"/>
                                </div>
                            </div>
                            <div class="row form-group mb-5">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Colonia</label>
                                    <input type="text" class="form-control dark-form-control" name="dom_colonia" id="dom_colonia"/>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-label-muted">Municipio / Delegación</label>
                                    <input type="text" class="form-control dark-form-control" name="dom_municipio" id="dom_municipio"/>
                                </div>
                            </div>
                            <div class="row form-group mb-0">
                                <div class="col-lg-6 mb-3 mb-lg-0">
                                    <label class="text-label-muted">Estado</label>
                                    <input type="text" class="form-control dark-form-control" name="dom_estado" id="dom_estado"/>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-label-muted">Código postal</label>
                                    <input type="text" class="form-control dark-form-control" name="dom_cp" id="dom_cp"/>
                                </div>
                            </div>
                        </div>  

                        
                        <div class="tab-pane fade" id="kt_tab_pane_4">
                            <h4 class="text-gold-label mb-5">Contacto de Emergencia</h4>
                            <div class="row form-group mb-5">
                                <div class="col-lg-6">
                                    <label class="text-label-muted">Número Telefónico</label>
                                    <input type="text" class="form-control dark-form-control" name="telefono_custodio" id="telefono_custodio"/>
                                </div>
                                <div class="col-lg-6">
                                    <label class="text-label-muted">Usuario / Responsable</label>
                                    <select class="form-control dark-form-control text-white" id="users_responsable" name="users_responsable">
                                        <option value="">Selecciona una opción</option>
                                        @foreach($users_responsable as $estado)
                                            <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row form-group mb-4 align-items-center">
                                <div class="col-lg-3"><span class="text-white font-weight-bold">Entrevista Inicial</span></div>
                                <div class="col-lg-3"><input type="text" class="form-control dark-form-control" name="entin_fecha" id="entin_fecha" placeholder="Fecha"/></div>
                                <div class="col-lg-6"><input type="text" class="form-control dark-form-control" name="entin_comentario" id="entin_comentario" placeholder="Comentarios adicionales"/></div>
                            </div>
                        </div>

                        
                        <div class="tab-pane fade" id="kt_tab_pane_2">
                            <h4 class="text-gold-label mb-5">Documentos Adjuntos</h4>
                            <div class="table-responsive">
                                <table class="table table-borderless" id="tblDocumentos" style="color: #ffffff;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #222b3a;">
                                            <th class="text-muted">Adjuntar Documento</th>
                                            <th class="text-muted">Tipo</th>
                                            <th class="text-muted">Vigencia</th>
                                            <th class="text-center text-muted">Opción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentos"></tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                <a href="#" class="btn btn-outline-dark-gold btn-sm hrefAgregarOtro">
                                    <i class="fa fa-plus mr-1"></i> Añadir fila de documento
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>     
    </div>

    
    <div class="row">
    <div class="row mt-2 w-100">
        <div class="col-lg-6">
            <div class="card card-custom shadow-sm border-0 w-100">
                <div class="card-header">
                    <h3 class="card-title text-white">Vehículo asignado</h3>
                </div>
                <div class="card-body px-12 py-10">
                    <div class="form-group row">
                        <span class="text-white">Para registrar el Vehículo es necesario registrar al custodio primero.</span>
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-lg-6">
            <div class="card card-custom shadow-sm border-0 w-100">
                <div class="card-header">
                    <h3 class="card-title text-white">Datos del Arma</h3>
                </div>
                <div class="card-body px-12 py-10">
                    <div class="form-group row">
                        <span class="text-white">Para registrar el arma es necesario registrar al custodio primero.</span>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>


    <div class="row mt-2">
    <div class="col-lg-12">
        <div class="card card-custom shadow-sm border-0">
            <div class="card-body px-10 py-8">
                <div class="form-group">
                    <label for="observaciones" class="text-white">Observaciones</label>
                    <textarea class="form-control" name="observaciones" placeholder="Agrega observaciones adicionales sobre el custodio" id="observaciones" rows="3"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>

    
    <div class="modal fade" id="modalSubirDocumentos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-dark">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-white"><i class="fa fa-folder-open text-warning mr-2"></i> Subir Expediente Digital</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted" style="font-size: 0.85rem;">Selecciona los archivos correspondientes a cada apartado para integrarlos al expediente:</p>
                    
                    <div class="form-group mb-4">
                        <label class="text-white font-weight-bold mb-2 d-block" style="font-size: 0.85rem;">1. INE / Identificación Oficial</label>
                        <div class="custom-file bg-transparent">
                            <input type="file" class="custom-file-input" id="modal_ine" accept=".pdf,.jpg,.jpeg,.png" onchange="syncWithGrid('modal_ine', 'doc_ine')">
                            <label class="custom-file-label dark-form-control text-muted" id="label_modal_ine" for="modal_ine">Seleccionar archivo...</label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="text-white font-weight-bold mb-2 d-block" style="font-size: 0.85rem;">2. Comprobante de Domicilio</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="modal_domicilio" accept=".pdf,.jpg,.jpeg,.png" onchange="syncWithGrid('modal_domicilio', 'doc_domicilio')">
                            <label class="custom-file-label dark-form-control text-muted" id="label_modal_domicilio" for="modal_domicilio">Seleccionar archivo...</label>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="text-white font-weight-bold mb-2 d-block" style="font-size: 0.85rem;">3. Acta de Nacimiento</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="modal_acta" accept=".pdf,.jpg,.jpeg,.png" onchange="syncWithGrid('modal_acta', 'doc_acta')">
                            <label class="custom-file-label dark-form-control text-muted" id="label_modal_acta" for="modal_acta">Seleccionar archivo...</label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <label class="text-white font-weight-bold mb-2 d-block" style="font-size: 0.85rem;">4. Cédula RFC</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="modal_rfc" accept=".pdf,.jpg,.jpeg,.png" onchange="syncWithGrid('modal_rfc', 'doc_rfc')">
                            <label class="custom-file-label dark-form-control text-muted" id="label_modal_rfc" for="modal_rfc">Seleccionar archivo...</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gold-submit px-5 py-2" data-dismiss="modal">LISTO</button>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="modalAsignarVehiculo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-dark">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold text-white">
                        <i class="fa fa-car text-warning mr-2"></i> Seleccionar Vehículo
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted" style="font-size: 0.85rem;">Selecciona una unidad de la lista para asociarla a este custodio de inmediato:</p>
                    
                    <div class="form-group mb-0">
                        <label class="text-white font-weight-bold mb-2 d-block" style="font-size: 0.85rem;">Vehículos Disponibles</label>
                        <select class="form-control dark-form-control text-white" id="select_vehiculo_modal" onchange="actualizarVehiculoCard()">
                            <option value="">Selecciona una unidad...</option>
                            <!-- Ejemplo de datos que renderizaría tu base de datos -->
                            <option value="1" data-serie="NISSAN83940219" data-placa="NEX-92-01" data-color="Blanco" data-marca="Nissan Versa / 2025">Nissan Versa</option>
                            <option value="2" data-serie="TOYOTA09238411" data-placa="XYZ-74-82" data-color="Gris Metálico" data-marca="Toyota Hilux / 2024">Toyota Hilux</option>
                            <option value="3" data-serie="FORD3928401928" data-placa="NMN-11-20" data-color="Negro" data-marca="Ford Ranger / 2025">Ford Ranger</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-gold-submit px-5 py-2" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

    </form>
</div>


<script>
</script>
@endsection