@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/usuarios/AgregarUsuario.js?v=1.2.2') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.9') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('title')
    Agregar usuario
@endsection
@section('content')

    <!--begin::Card-->
    <div class="usuario-alta-page">
        <div class="usuario-alta-heading">
            <div><span class="usuario-alta-eyebrow">ADMINISTRACIÓN DE PLATAFORMA</span><h1>Agregar usuario</h1><p>Registra la información, documentación y clientes asociados al usuario.</p></div>
            <a href="{{ route('user.catalogousuarios') }}" class="usuario-alta-back"><i class="la la-arrow-left"></i> Regresar</a>
        </div>
        <div class="usuario-alta-card">
                <div class="usuario-alta-card-heading"><span class="usuario-alta-step">NUEVO REGISTRO</span><strong>DATOS DEL USUARIO</strong></div>
                <!--begin::Form-->
                <form action="{{ route('user.guardarusuario') }}" method="post" id="submit_user" enctype="multipart/form-data">
                    @csrf
                    <div class="usuario-alta-body">

                        <ul class="nav nav-tabs nav-tabs-line usuario-alta-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información del usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Documentación</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Clientes</a>
                            </li>
                        </ul>



                        <div class="tab-content usuario-alta-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nombre del usuario</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control  st-input" name="name_user" id="name_user" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Correo electrónico</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="email_user" id="email_user" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Roles</label>
                                        <div class="input-group">
                                            <select class="form-control" id="rol" name="rol_user"  required >
                                                <option value="">Selecciona una opción</option>
                                                @foreach($rol as $ub)
                                                    <option value="{{ $ub->id }}" >{{ $ub->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>RFC</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="rfc" id="rfc" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Teléfono</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" maxlength="10" name="telefono" id="telefono" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Dirección</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="ubicacion" id="ubicacion" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Área personal</label>
                                        <div class="input-group">
                                            <select class="form-control" id="area_personal" name="area_personal"  required >
                                                <option value="">Selecciona una opción</option>
                                                @foreach($areas  as $area)
                                                    <option value="{{ $area->id }}" >{{ $area->nombre_area }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
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
                                        <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro usuario-alta-add" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                            <i class="flaticon2-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                <input type='hidden' id='tipoCliente' value='{{ $cadenaTipoCliente }}'>
                                <div class="row form-group" >
                                    <div class="col-lg-12" id="tblArchivos">
                                        <table class='table table-bordered table-hover' id='tblClientes'>
                                            <thead>
                                            <tr>
                                                <th>Cliente</th>
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
                                        <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtroCliente usuario-alta-add" data-toggle="tooltip" data-theme="dark" title="Agregar cliente">
                                            <i class="flaticon2-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                    <div class="usuario-alta-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="btnGuardar" class="btn usuario-alta-save"><i class="la la-save"></i> Guardar usuario</button>
                                <a href="{{ route('user.catalogousuarios') }}"  class="btn usuario-alta-cancel">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    <!--end::Card-->

@endsection