
@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/estilos_principal.css?v=3.1.2') }}"
      rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('js/cliente/CatalogoClientes.js?v=2.2.2') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title', 'Inventario de Clientes')

@section('content')

<div class="clientes-page">

    
    <header class="clientes-header">

        <div>
            <span class="clientes-eyebrow">
                ADMINISTRACIÓN DE PLATAFORMA
            </span>

            <h1>Inventario de Clientes</h1>

            <p>
                Gestiona el alta, control y seguimiento de tus clientes.
            </p>
        </div>

        <div class="clientes-header-actions">

            <a href="{{ route('cliente.agregarcliente') }}"
               class="clientes-btn clientes-btn-primary">
                <i class="la la-user-plus"></i>
                Nuevo cliente
            </a>

            <a href="{{ route('cliente.listadoclienteinactivo') }}"
               class="clientes-btn clientes-btn-outline">
                <i class="la la-user-times"></i>
                Clientes inactivos
            </a>

        </div>

    </header>


    {{-- RESUMEN DE CLIENTES --}}
    <section class="clientes-summary">

        <div class="clientes-summary-card">
            <i class="la la-check-circle"></i>
            <div>
                <small>CLIENTES ACTIVOS</small>
                <strong>{{ $activosClientes }}</strong>
            </div>
        </div>

        <div class="clientes-summary-card">
            <i class="la la-user-times"></i>
            <div>
                <small>CLIENTES INACTIVOS</small>
                <strong>{{ $inactivosClientes }}</strong>
            </div>
        </div>

    </section>

    {{-- FILTROS --}}
    <section class="clientes-panel">

        <div class="clientes-panel-heading">
            <span class="clientes-eyebrow">CONSULTA</span>
            <h2>Filtros de clientes</h2>
        </div>

        <form id="clientes_filtros"
              class="clientes-filters"
              autocomplete="off">

            <label class="clientes-search">
                <i class="la la-search"></i>

                <input type="search"
                       id="clientes_busqueda"
                       placeholder="Buscar folio, razón social o nombre del cliente..."
                       aria-label="Buscar cliente">
            </label>

            <select id="clientes_grupo"
                    aria-label="Filtrar grupo">

                <option value="">Todos los grupos</option>

                @foreach($data->pluck('grupo')->filter()->unique()->sort() as $grupo)
                    <option value="{{ $grupo }}">
                        {{ $grupo }}
                    </option>
                @endforeach

            </select>

            <button type="submit"
                    class="clientes-btn clientes-btn-outline"
                    id="kt_search">
                <i class="la la-filter"></i>
                Filtrar
            </button>

            <button type="button"
                    class="clientes-btn clientes-btn-outline"
                    id="kt_reset">
                <i class="la la-undo"></i>
                Limpiar
            </button>

        </form>

    </section>

    {{-- LISTADO --}}
    <section class="clientes-panel clientes-list-panel">

        <div class="clientes-panel-heading clientes-heading-row">

            <div>
                <span class="clientes-eyebrow">
                    DIRECTORIO
                </span>

                <h2>
                    Clientes activos
                    <span class="clientes-count">
                        {{ $activosClientes }}
                    </span>
                </h2>
            </div>

            <div class="dropdown">

                <button type="button"
                        class="clientes-btn clientes-btn-outline dropdown-toggle"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">
                    <i class="la la-download"></i>
                    Exportar
                </button>

                <div class="dropdown-menu dropdown-menu-right">

                    <a href="#" class="dropdown-item" id="export-excel">
                        Excel
                    </a>

                    <a href="#" class="dropdown-item" id="export-csv">
                        CSV
                    </a>

                    <a href="#" class="dropdown-item" id="export-print">
                        Imprimir
                    </a>

                </div>

            </div>

        </div>

        <div class="clientes-table-scroll">

            <table id="kdatatable_usuarios2"
                   class="clientes-table">

                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Razón social</th>
                        <th>Nombre cliente</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($data as $unid)

                        <tr>

                            <td class="clientes-folio">
                                {{ $unid->num_list }}
                            </td>

                            <td>
                                {{ $unid->razon_social }}
                            </td>

                            <td>
                                <div class="clientes-person">

                                    <span class="clientes-avatar">
                                        {{ mb_strtoupper(mb_substr($unid->nombre_cliente ?: 'C', 0, 2)) }}
                                    </span>

                                    <strong>
                                        {{ $unid->nombre_cliente }}
                                    </strong>

                                </div>
                            </td>

                            <td>
                                <span class="clientes-chip">
                                    {{ $unid->grupo }}
                                </span>
                            </td>

                            <td>
                                <div class="clientes-actions">

                                    <a href="{{ route('cliente.vercliente', $unid->id) }}"
                                       title="Ver cliente">
                                        <i class="la la-eye"></i>
                                    </a>

                                    <a href="{{ route('cliente.editarcliente', $unid->id) }}"
                                       title="Editar cliente">
                                        <i class="la la-edit"></i>
                                    </a>

                                    <button type="button"
                                            class="clientes-desactivar"
                                            data-id="{{ $unid->id }}"
                                            data-nombre="{{ $unid->razon_social }}"
                                            title="Desactivar cliente">
                                        <i class="la la-trash"></i>
                                    </button>

                                </div>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </section>

</div>

{{-- FORMULARIO ORIGINAL PARA DESACTIVAR --}}
<form method="post"
      id="cliente_delete_form"
      action="{{ route('cliente.desactivarclientelistado') }}"
      enctype="multipart/form-data">

    @csrf

    <input type="hidden"
           name="id"
           id="id_cliente_delete"
           value="">

</form>

<input type="hidden"
       id="datatable_i18n"
       value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection
