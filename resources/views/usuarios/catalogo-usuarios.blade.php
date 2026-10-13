@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.8') }}" rel="stylesheet" type="text/css"/>
@endpush

@push('scripts')
    <script src="{{ asset('js/usuarios/CatalogoUsuarios.js?v=2.0.1') }}"></script>
@endpush

@section('title', 'Inventario de Usuarios')

@section('content')

<div class="usuarios-page">

    <header class="usuarios-header">

        <div>
            <span class="usuarios-eyebrow">
                ADMINISTRACIÓN DE PLATAFORMA
            </span>
            <h1>Inventario de Usuarios</h1>
            <p>Gestiona el alta, control y seguimiento de tus usuarios de plataforma.</p>
        </div>

        <a class="usuarios-btn usuarios-btn-primary" href="{{ route('user.agregarusuario') }}">
            <i class="la la-user-plus"></i>
            Agregar usuario
        </a>

    </header>

    <section class="usuarios-summary">

        <div class="usuarios-summary-card">

            <span class="usuarios-summary-icon">
                <i class="la la-users"></i>
            </span>

            <div>
                <small>TOTAL USUARIOS</small>
                <strong>{{ $totalUsuarios }}</strong>
            </div>

        </div>

        <div class="usuarios-summary-card">

            <span class="usuarios-summary-icon">
                <i class="la la-check-circle"></i>
            </span>

            <div>
                <small>ACTIVOS</small>
                <strong>{{ $activosUsuarios }}</strong>
            </div>

        </div>

        <div class="usuarios-summary-card">

            <span class="usuarios-summary-icon">
                <i class="la la-user-times"></i>
            </span>

            <div>
                <small>INACTIVOS</small>
                <strong>{{ $inactivosUsuarios }}</strong>
            </div>

        </div>

    </section>

    <section class="usuarios-panel usuarios-filter-panel">

        <div class="usuarios-panel-heading">

            <span class="usuarios-eyebrow">
                CONSULTA
            </span>

            <h2>Filtros de usuarios</h2>

        </div>

        <form id="usuarios_filtros" class="usuarios-filter-grid" autocomplete="off">

            <label class="usuarios-search-field">
                <i class="la la-search"></i>
                <input id="global_search_input" type="search" placeholder="Buscar nombre, correo, teléfono, RFC..." aria-label="Buscar usuario">
            </label>

            <select id="usuarios_estatus" aria-label="Filtrar estatus">
                <option value="">Todos los estatus</option>
                <option value="ACTIVO">Activo</option>
                <option value="INACTIVO">Inactivo</option>
            </select>

            <select id="usuarios_rol" aria-label="Filtrar rol">
                <option value="">Todos los roles</option>

                @foreach($rol as $co)
                    <option value="{{ $co->name }}">
                        {{ $co->name }}
                    </option>
                @endforeach

            </select>

            <input id="usuarios_rfc" type="search" placeholder="Buscar RFC" aria-label="Buscar RFC">

            <button id="kt_search" type="button" class="usuarios-btn usuarios-btn-outline">
                <i class="la la-filter"></i>
                Filtrar
            </button>

            <button id="kt_reset" type="button" class="usuarios-btn usuarios-btn-outline">
                <i class="la la-undo"></i>
                Limpiar
            </button>

        </form>

    </section>

    <section class="usuarios-panel usuarios-list-panel">

        {{-- ENCABEZADO DE TABLA --}}
        <div class="usuarios-panel-heading">

            <div>

                <span class="usuarios-eyebrow">
                    DIRECTORIO
                </span>

                <h2>
                    Usuarios registrados

                    <span class="usuarios-count">
                        {{ $totalUsuarios }}
                    </span>
                </h2>

            </div>

        </div>


        {{-- CONTENEDOR DE TABLA --}}
        <div class="usuarios-table-scroll">

            <table id="kdatatable_usuarios_dos" class="usuarios-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>RFC</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($usuario as $unid)

                        <tr>

                            <td class="usuarios-id">
                                USR-{{ str_pad($unid->num_list ?? $unid->id, 4, '0', STR_PAD_LEFT) }}
                            </td>

                            <td>

                                <div class="usuarios-person">

                                    <span class="usuarios-avatar">
                                        {{ mb_strtoupper(mb_substr($unid->name ?? 'U', 0, 1)) }}
                                    </span>

                                    <strong>
                                        {{ $unid->name }}
                                    </strong>

                                </div>

                            </td>

                            <td>
                                {{ $unid->rfc ?: 'N/A' }}
                            </td>

                            <td>
                                {{ $unid->telefono ?: '—' }}
                            </td>

                            <td>
                                {{ $unid->email }}
                            </td>

                            <td>

                                <span class="usuarios-chip usuarios-chip-role">
                                    {{ $unid->name_role ?: 'Sin rol' }}
                                </span>

                            </td>

                            <td>

                                <span class="usuarios-chip {{ $unid->id_status_delete == 1 ? 'usuarios-chip-active' : 'usuarios-chip-inactive' }}">
                                    {{ $unid->id_status_delete == 1 ? 'ACTIVO' : 'INACTIVO' }}
                                </span>

                            </td>


                            {{-- ACCIONES --}}
                            <td>

                                <div class="usuarios-actions">

                                    <a href="{{ route('user.verusuario', $unid->id) }}" title="Ver usuario" aria-label="Ver usuario">
                                        <i class="la la-eye"></i>
                                    </a>

                                    <a href="{{ route('user.editarusuario', $unid->id) }}" title="Editar usuario" aria-label="Editar usuario">
                                        <i class="la la-edit"></i>
                                    </a>

                                    @if($unid->id_status_delete == 1)

                                        <button type="button" class="usuarios-desactivar" data-id="{{ $unid->id }}" data-nombre="{{ $unid->name }}" data-toggle="modal" data-target="#model_delete_user" title="Desactivar usuario" aria-label="Desactivar usuario">
                                            <i class="la la-trash"></i>
                                        </button>

                                    @endif

                                    
                                    @if($unid->id_status_delete == 2)
                                        <button type="button" class="activar-user" data-id="{{ $unid->id }}" data-nombre="{{ $unid->name }}" title="Activar usuario" aria-label="Activar usuario"> <i class="la la-user-check"></i>
                                        </button>
                                    @endif


                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </section>

</div>

{{-- MODAL PARA DESACTIVAR USUARIO --}}

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_delete_user">
    <div class="modal-dialog">
        <div class="modal-content card-premium text-white">

            <div class="modal-header">

                <h5 class="modal-title text-danger font-weight-bolder">
                    Desactivar usuario
                </h5>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body">

                <form action="{{ route('user.desacticarusuario') }}" method="post" id="submit_desactivar">

                    @csrf

                    <div class="row form-group">

                        <div class="col-lg-12 mt-2">

                            <label class="text-muted font-weight-bold mb-2">
                                Motivo del cambio de estado:
                            </label>
                            <input type="text" class="form-control input-premium-dark" name="motivo" id="desactivar_add" required/>
                            <input type="hidden" name="id" id="id_user_desc">
                            <input type="hidden" name="name_user" id="name_user">

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary btn-sm font-weight-bold" data-dismiss="modal">
                    Cancelar
                </button>

                <button type="button" id="send_desactivar" class="btn btn-primary btn-sm font-weight-bold">
                    Guardar
                </button>

            </div>

        </div>

    </div>

</div>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
<form method="post" id="user_act_form" action="{{ route('user.activarusuario') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_user_act" value="">
  </form>
@endsection
