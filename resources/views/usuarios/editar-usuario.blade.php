@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/usuarios/EditarUsuario.js') }}"></script>
@endpush

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.10') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('title')
    Editar usuario
@endsection
@section('content')
    <div class="usuario-alta-page usuario-editar-page">
        <div class="usuario-alta-heading">
            <div>
                <span class="usuario-alta-eyebrow">ADMINISTRACIÓN DE PLATAFORMA</span>
                <h1>Editar usuario</h1>
                <p>Actualiza la información, documentación y clientes asociados al usuario.</p>
            </div>
            <a href="{{ route('user.catalogousuarios') }}" class="usuario-alta-back" data-toggle="tooltip" data-theme="dark" title="Salir"><i class="la la-arrow-left"></i> Regresar</a>
        </div>
        <div class="usuario-alta-card">
            <div class="usuario-alta-card-heading"><span class="usuario-alta-step">EDICIÓN DE REGISTRO</span><strong>DATOS DEL USUARIO</strong></div>
                <input type="hidden" id="documentoEliminarPath" value="{{ route('user.eliminardocumentouser') }}">
                <input type="hidden" id="documentoEliminarCliente" value="{{ route('user.eliminarclienteuser') }}">
                <!--begin::Form-->
                <form class="form" action="{{ route('user.modificarusuario') }}" method="post" id="frmUsuario" enctype="multipart/form-data">
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

                                <input type="hidden" name="id" value="{{ $usuario }}">
                                @foreach ($userinfo as $user)
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Nombre del usuario</label>
                                            <input type="text" class="form-control" name="name_user"
                                                value="{{ strtoupper($user->name) }}" id="name_user_edit" required
                                                onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Contraseña</label>
                                            <input type="password" class="form-control" name="password" id="password_edit" />
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Email del usuario</label>
                                            <input type="text" class="form-control" name="email_user"
                                                value="{{ strtoupper($user->email) }}" id="email_user_edit" required
                                                onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Roles</label>
                                            <select class="form-control" name="rol_user" id="rol_edit" required>
                                                <option value="">Selecciona un opción</option>
                                                @foreach ($rol as $ub)
                                                    <option value="{{ $ub->id }}"
                                                        {{ $ub->id == $user->role ? 'selected' : '' }}>
                                                        {{ strtoupper($ub->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>RFC</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="rfc"
                                                    value="{{ strtoupper($user->rfc) }}" id="rfc"
                                                    onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Teléfono</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="telefono"
                                                    value="{{ $user->telefono }}" id="telefono" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-6">
                                            <label>Dirección</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="ubicacion"
                                                    value="{{ strtoupper($user->ubicacion) }}" id="ubicacion"
                                                    onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
                                            </div>
                                        </div>
                                        {{-- Areas personales --}}
                                        <div class="col-lg-6">
                                            <label>Área personal</label>
                                            <div class="input-group">
                                                <select class="form-control" name="area_personal" id="area_personal" required>
                                                    <option value="">Selecciona un opción</option>
                                                    @foreach ($areas as $area)
                                                        <option value="{{ $area->id }}"
                                                            {{ $area->id == Auth::user()->area_personal_id ? 'selected' : '' }}>
                                                            {{ strtoupper($area->nombre_area) }}
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                @endforeach
                            </div>


                            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                                <table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentos">
                                    <thead>
                                    <tr>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Tipo de Documento</th>
                                        <th scope="col">Opción</th>
                                    </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentos'>
                                        @foreach($documentos as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td><a href="{{ route('archivo.documentoUsuario', ['id'=>$documento->id]) }}" class="link-primary" target="_blank"> {{ $documento->userDocumento->tipo_documento }} </a></td>
                                                <td>{{ $documento->userDocumento->tipo_documento }}</td>
                                                <td>
                                                    <a href='#' class='btn btn-sm btn-clean btn-hover-icon-success btn-icon hrefEliminarDocumento' data-id='{{ $documento->id }}' data-documento='{{ $documento->documento }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
                                                        <i class='flaticon-delete'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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
                                                @foreach($clienteusuario as $documento)
                                                    <tr id="trDocumentoCli{{ $documento->id }}">
                                                        <td>{{ $documento->cliente->razon_social }} - {{ $documento->cliente->nombre_cliente }}</td>
                                                        <td>
                                                            <a href='#' class='btn btn-sm btn-clean btn-hover-icon-success btn-icon hrefEliminarCliente' data-id='{{ $documento->id }}' data-documento='{{ $documento->cliente->razon_social  }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
                                                                <i class='flaticon-delete'></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
                                <button type="button" id="btnGuardar" class="btn usuario-alta-save"><i class="la la-save"></i> Guardar cambios</button>
                                <a href="{{ route('user.catalogousuarios') }}" class="btn usuario-alta-cancel">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
        </div>
    </div>
@endsection
