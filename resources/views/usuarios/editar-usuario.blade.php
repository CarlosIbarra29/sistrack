@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/usuarios/EditarUsuario.js') }}"></script>
@endpush
@section('title')
    Editar usuario
@endsection
@section('content')
    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Editar usuario</h3>
                    <div class="card-toolbar">
                        <a href="{{ route('user.catalogousuarios') }}" class="btn btn-sm btn-clean btn-hover-icon-success btn-icon" data-toggle="tooltip" data-theme="dark" title="Salir" ><i class="flaticon2-reply "></i></a>
                    </div>
                </div>
                <input type="hidden" id="documentoEliminarPath" value="{{ route('user.eliminardocumentouser') }}">
                <!--begin::Form-->
                <form class="form" action="{{ route('user.modificarusuario') }}" method="post" id="frmUsuario" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <ul class="nav nav-tabs nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información del usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Documentación</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-5" id="myTabContent">
                            <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">

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


                            <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
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
                                        <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                            <i class="flaticon2-plus"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>




                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button" id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('user.catalogousuarios') }}" class="btn btn-secondary">Cancelar</a>
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
