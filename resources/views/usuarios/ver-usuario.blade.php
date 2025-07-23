@extends('layouts.app')

@section('title')
    Ver usuario
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Ver usuario</h3>
                </div>
                <!--begin::Form-->
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
                                @foreach($userinfo as $user)
                                    <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Nombre del usuario</label>
                                            <p>{{ $user->name }}</p>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Contraseña</label>
                                            <p>Información no disponible</p>
                                        </div>
                                      </div>

                                      <div class="row form-group">
                                        <div class="col-lg-6">
                                            <label>Email del usuario</label>
                                            <p>{{ $user->email }}</p>
                                        </div>

                                        <div class="col-lg-6">
                                            <label>Roles</label>
                                            @foreach($rol as $ub)
                                                @if($ub->id == $user->role)
                                                    <p>{{ $ub->name }}</p>
                                                @endif
                                            @endforeach
                                        </div>
                                      </div>

                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>RFC</label>
                                                <div class="input-group">
                                                    <p>{{ $user->rfc }}</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Teléfono</label>
                                                <div class="input-group">
                                                    <p>{{ $user->telefono }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                <label>Ubicación en JetVan</label>
                                                <div class="input-group">
                                                    <p>{{ $user->ubicacion }}</p>
                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </div>

                            <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                {{-- <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'> --}}
                                <table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentos">
                                    <thead>
                                    <tr>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Tipo de Documento</th>
                                    </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentos'>
                                        @foreach($documentos as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td><a href="{{ route('archivo.documentoUsuario', ['id'=>$documento->id]) }}" class="link-primary" target="_blank"> {{ $documento->userDocumento->tipo_documento }} </a></td>
                                                <td>{{ $documento->userDocumento->tipo_documento }}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>

                        </div>




                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{ route('user.catalogousuarios') }}"  class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>

                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->

@endsection