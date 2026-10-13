
@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.11') }}" rel="stylesheet" type="text/css"/>
@endpush

@section('title')
    Ver usuario
@endsection

@section('content')

<div class="usuario-ver-page">

    <header class="usuario-ver-top">

        <div>
            <span class="usuario-ver-eyebrow">
                ADMINISTRACIÓN DE PLATAFORMA / CONSULTA
            </span>

            <h1>Detalle del usuario</h1>

            <p>
                Consulta los datos generales, documentos y clientes asociados.
            </p>
        </div>

        <a href="{{ route('user.catalogousuarios') }}" class="usuario-ver-back">
            <i class="la la-arrow-left"></i>
            Volver al catálogo
        </a>

    </header>

    @foreach($userinfo as $user)

        <section class="usuario-ver-hero">

            <div class="usuario-ver-avatar">
                <i class="la la-user"></i>
            </div>

            <div class="usuario-ver-identity">

                <span class="usuario-ver-kicker">
                    PERFIL DE USUARIO
                </span>

                <h2>{{ $user->name }}</h2>

                <p>
                    <i class="la la-envelope"></i>
                    {{ $user->email }}
                </p>

            </div>

            <div class="usuario-ver-hero-meta">

                <span class="usuario-ver-meta-label">
                    ROL ASIGNADO
                </span>

                <span class="usuario-ver-role">

                    <i class="la la-shield"></i>

                    @foreach($rol as $ub)
                        @if($ub->id == $user->role)
                            {{ $ub->name }}
                        @endif
                    @endforeach

                </span>

            </div>

        </section>

    @endforeach

    <section class="usuario-ver-panel">

        <ul class="nav nav-tabs nav-tabs-line usuario-ver-tabs">

            <li class="nav-item">

                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                    <i class="la la-id-card"></i>
                    Información del usuario
                </a>

            </li>

            <li class="nav-item">

                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                    <i class="la la-file-alt"></i>

                    Documentación

                    <span class="usuario-ver-count">
                        {{ $documentos->count() }}
                    </span>
                </a>

            </li>

            <li class="nav-item">

                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">
                    <i class="la la-building"></i>
                    Clientes
                    <span class="usuario-ver-count">
                        {{ $clienteusuario->count() }}
                    </span>
                </a>

            </li>

        </ul>

        <div class="tab-content usuario-ver-content" id="myTabContent">

            <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">

                <input type="hidden" name="id" value="{{ $usuario }}">

                @foreach($userinfo as $user)

                    <div class="usuario-ver-section-head">

                        <span class="usuario-ver-section-icon">
                            <i class="la la-address-card"></i>
                        </span>

                        <div>
                            <h3>Información general</h3>
                            <p>Datos registrados en la plataforma</p>
                        </div>

                    </div>

                    <div class="usuario-ver-info-grid">

                        <!-- Nombre -->
                        <div class="usuario-ver-info">

                            <label>Nombre del usuario</label>
                            <p>{{ $user->name }}</p>

                        </div>

                        <div class="usuario-ver-info">

                            <label>Contraseña</label>

                            <p class="usuario-ver-muted">
                                Información no disponible
                            </p>

                        </div>

                        <div class="usuario-ver-info">

                            <label>Email del usuario</label>
                            <p>{{ $user->email }}</p>

                        </div>

                        <div class="usuario-ver-info">

                            <label>Roles</label>

                            <p>
                                @foreach($rol as $ub)
                                    @if($ub->id == $user->role)
                                        {{ $ub->name }}
                                    @endif
                                @endforeach
                            </p>

                        </div>

                        <div class="usuario-ver-info">
                            <label>RFC</label>
                            <p>{{ $user->rfc }}</p>
                        </div>

                        <div class="usuario-ver-info">
                            <label>Teléfono</label>
                            <p>{{ $user->telefono }}</p>
                        </div>

                        <div class="usuario-ver-info usuario-ver-info-wide">
                            <label>Dirección</label>
                            <p>{{ $user->ubicacion }}</p>
                        </div>

                    </div>

                @endforeach

            </div>

            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">

                {{-- <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'> --}}

                <div class="usuario-ver-section-head">

                    <span class="usuario-ver-section-icon">
                        <i class="la la-folder-open"></i>
                    </span>

                    <div>
                        <h3>Documentación registrada</h3>

                        <p>
                            Archivos asociados al usuario · selecciona un documento para consultarlo
                        </p>
                    </div>

                </div>

                <div class="usuario-ver-table-wrap">

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

                                    <td>

                                        <a href="{{ route('archivo.documentoUsuario', ['id'=>$documento->id]) }}" class="link-primary usuario-ver-doc-link" target="_blank">

                                            <i class="la la-file-alt"></i>

                                            {{ $documento->userDocumento->tipo_documento }}

                                            <i class="la la-external-link-alt"></i>

                                        </a>

                                    </td>

                                    <td>
                                        {{ $documento->userDocumento->tipo_documento }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @if($documentos->isEmpty())

                    <div class="usuario-ver-empty">

                        <i class="la la-folder-open"></i>

                        <p>No hay documentos registrados.</p>

                    </div>

                @endif

            </div>

            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">

                {{-- <input type='hidden' id='tipoCliente' value='{{ $cadenaTipoCliente }}'> --}}

                <div class="usuario-ver-section-head">

                    <span class="usuario-ver-section-icon">
                        <i class="la la-building"></i>
                    </span>

                    <div>
                        <h3>Clientes asociados</h3>
                        <p>Relación de clientes vinculados a este usuario</p>
                    </div>

                </div>

                <div class="row form-group">

                    <div class="col-lg-12" id="tblArchivos">

                        <div class="usuario-ver-table-wrap">

                            <table
                                class='table table-bordered table-hover'
                                id='tblClientes'
                            >

                                <thead>
                                    <tr>
                                        <th>Cliente</th>

                                        {{-- <th>Opción</th> --}}
                                    </tr>
                                </thead>

                                <tbody id='tbodyDocumentos'>

                                    @foreach($clienteusuario as $documento)
                                        <tr id="trDocumentoCli{{ $documento->id }}">

                                            <td>
                                                <span class="usuario-ver-client-icon">
                                                    <i class="la la-building"></i>
                                                </span>

                                                {{ $documento->cliente->razon_social }} - {{ $documento->cliente->nombre_cliente }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

                @if($clienteusuario->isEmpty())

                    <div class="usuario-ver-empty">
                        <i class="la la-building"></i>
                        <p>No hay clientes asociados.</p>
                    </div>

                @endif

            </div>

        </div>

    </section>

    <footer class="usuario-ver-footer">
        <span>
            <i class="la la-eye"></i>
            Vista de solo consulta
        </span>
        <a href="{{ route('user.catalogousuarios') }}" class="usuario-ver-back">
            <i class="la la-arrow-left"></i>
            Regresar
        </a>
    </footer>

</div>

@endsection
