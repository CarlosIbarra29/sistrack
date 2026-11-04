
@extends('layouts.app')

@push('styles')
<link href="{{ asset('css/estilos_principal.css?v=3.1.1') }}"
      rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<script src="{{ asset('js/cliente/CatalogoClientes.js?v=2.2.2') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title', 'Inventario de clientes inactivos')

@section('content')

<div class="clientes-page">

    <header class="clientes-header">

        <div>
            <span class="clientes-eyebrow">
                ADMINISTRACIÓN DE PLATAFORMA
            </span>

            <h1>Clientes inactivos</h1>

            <p>
                Consulta y reactiva los clientes dados de baja.
            </p>
        </div>

        <a class="clientes-btn clientes-btn-primary"
           href="{{ route('cliente.listadocliente') }}">
            <i class="la la-arrow-left"></i>
            Regresar
        </a>

    </header>

    {{-- FILTROS --}}
    <section class="clientes-panel">

        <div class="clientes-panel-heading">
            <span class="clientes-eyebrow">CONSULTA</span>
            <h2>Filtros de clientes inactivos</h2>
        </div>

        <form id="clientes_inactivos_filtros"
              class="clientes-filters"
              autocomplete="off">

            <label class="clientes-search">
                <i class="la la-search"></i>

                <input type="search"
                       id="clientes_inactivos_busqueda"
                       placeholder="Buscar razón social o nombre..."
                       aria-label="Buscar cliente inactivo">
            </label>

            <select id="clientes_inactivos_grupo"
                    aria-label="Filtrar grupo">

                <option value="">Todos los grupos</option>

                @foreach($data->pluck('grupo')->filter()->unique()->sort() as $grupo)
                    <option value="{{ $grupo }}">
                        {{ $grupo }}
                    </option>
                @endforeach

            </select>

            <button type="submit"
                    class="clientes-btn clientes-btn-outline">
                <i class="la la-filter"></i>
                Filtrar
            </button>

            <button type="button"
                    class="clientes-btn clientes-btn-outline"
                    id="clientes_inactivos_limpiar">
                <i class="la la-undo"></i>
                Limpiar
            </button>

        </form>

    </section>

    {{-- TABLA DE CLIENTES INACTIVOS --}}
    <section class="clientes-panel clientes-list-panel">

        <div class="clientes-panel-heading">

            <span class="clientes-eyebrow">
                DIRECTORIO
            </span>

            <h2>
                Clientes inactivos

                <span class="clientes-count">
                    {{ $data->count() }}
                </span>
            </h2>

        </div>

        <div class="clientes-table-scroll">

            <table id="kdatatable_usuarios2"
                   class="clientes-table">

                <thead>
                    <tr>
                        <th>Razón social</th>
                        <th>Nombre del cliente</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($data as $unid)

                        <tr>

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

                                    <button type="button"
                                            class="activar-cliente"
                                            data-id="{{ $unid->id }}"
                                            data-nombre="{{ $unid->razon_social }}"
                                            title="Activar cliente">

                                        <i class="la la-undo"></i>

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

{{-- FORMULARIO ORIGINAL PARA ACTIVAR --}}
<form method="post"
      id="cliente_act_form"
      action="{{ route('cliente.activarcliente') }}">

    @csrf

    <input type="hidden"
           name="id"
           id="id_delete">

</form>

<input type="hidden"
       id="datatable_i18n"
       value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection
