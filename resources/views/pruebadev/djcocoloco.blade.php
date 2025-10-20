@extends('layouts.app')
@push('scripts')
    <!-- CSS Personalizado para Look Moderno y Estilo SIS PROTEC -->
    <style>
        /* Paleta de colores basada en el logo:
           - Primario (Botones y Acentos Oscuros): #10305D (Azul elegante)
           - Secundario (Marca Oscura/Texto Principal): #1D1D1D (Casi negro, elegante)
           - Acento Dorado/Metálico: #C5A358 (Para detalles y íconos)
        */
        :root {
            --primary-color-dark: #10305D;
            --primary-color-light: #184A86; /* Tono más claro para el degradado */
            --secondary-color-dark: #1D1D1D;
            --accent-color-gold: #C5A358;
            --background-light: #f9f9fb;
            --border-color: #eee;
            --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.05);
            --font-family: 'Inter', sans-serif;
        }

        /* 1. Contenedor: Bordes redondeados y sombra suave */
        .card-custom {
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            border: none;
        }

        /* 2. Encabezado de la Tarjeta */
        .card-header {
            padding: 20px 25px;
            border-bottom: 2px solid var(--accent-color-gold); /* Separador dorado */
        }
        .card-title .card-label {
            font-weight: 700;
            color: var(--secondary-color-dark); /* Título en color de marca oscuro */
        }
        .card-icon i {
            color: var(--accent-color-gold) !important; /* Ícono principal en dorado */
        }

        /* 3. Estilos Base de Botones Dinámicos con GRADIENTE */
        .btn-dynamic {
            border: none;
            border-radius: 8px !important;
            font-weight: 600 !important;
            padding: 10px 15px;
            margin-left: 10px;
            cursor: pointer;
            overflow: hidden;
            position: relative;
            transition: all 0.3s ease;
        }

        /* Botón NUEVO (Degradado) */
        .btn-primary-dynamic {
            /* Degradado sutil de oscuro a claro */
            background: linear-gradient(135deg, var(--primary-color-dark) 0%, var(--primary-color-light) 100%) !important;
            color: white !important;
            box-shadow: 0 4px 10px rgba(16, 48, 93, 0.3); /* Sombra para resaltar */
        }
        .btn-primary-dynamic:hover {
            /* Degradado invertido para efecto hover */
            background: linear-gradient(135deg, var(--primary-color-light) 0%, var(--primary-color-dark) 100%) !important;
            box-shadow: 0 6px 15px rgba(16, 48, 93, 0.4);
        }

        /* Botón Clientes Inactivos (Borde y Fondo al Hover) */
        .btn-secondary-outline-dynamic {
            background-color: transparent !important;
            color: var(--primary-color-dark) !important;
            border: 1px solid var(--primary-color-dark) !important;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-secondary-outline-dynamic:hover {
            /* Se llena con un color sólido más suave al hacer hover */
            background-color: rgba(16, 48, 93, 0.1) !important;
            color: var(--primary-color-dark) !important;
        }

        /* Animación de Flecha */
        .btn-content {
            display: inline-flex;
            align-items: center;
            transition: transform 0.3s ease;
        }
        .btn-dynamic:hover .btn-content {
            transform: translateX(-5px);
        }
        .btn-arrow {
            font-size: 1.2em;
            opacity: 0;
            margin-left: 5px;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .btn-dynamic:hover .btn-arrow {
            opacity: 1;
            transform: translateX(10px);
        }
        .btn-secondary-outline-dynamic:hover .btn-arrow {
             color: var(--primary-color-dark); /* La flecha se mantiene oscura en el botón outline */
        }

        /* 4. Estilo de la Tabla: Encabezado y Zebra Stripping */
        .table-checkable thead th {
            background-color: var(--background-light);
            font-weight: 700;
            color: var(--secondary-color-dark);
            border-bottom: 2px solid var(--secondary-color-dark) !important;
        }
        .table-checkable tbody td {
            border-bottom: 1px solid #eee !important;
            color: var(--secondary-color-dark);
            font-weight: 400;
        }
        /* Zebra Stripping: Resaltar filas impares */
        .table-checkable tbody tr:nth-child(odd) {
            background-color: #fafafa;
        }
        .table-checkable tbody tr:hover {
            background-color: #f0f0f0;
        }

        /* 5. Icono de Cliente y Nombre */
        .client-info {
            display: flex;
            align-items: center;
            font-weight: 400;
            color: var(--secondary-color-dark);
        }
        .client-icon {
            color: var(--accent-color-gold);
            font-size: 1.2em;
            margin-right: 8px;
        }

        /* 6. Estilo de Botones de Opciones */
        .options-group {
            display: inline-flex;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .options-icon-btn {
            background: none;
            border: none;
            padding: 8px 10px;
            cursor: pointer;
            opacity: 0.8;
            transition: all 0.2s ease;
            position: relative;
        }
        .options-icon-btn:hover {
            opacity: 1;
            background-color: #f0f0f0;
        }
        .options-icon-btn:not(:last-child)::after {
            content: '';
            position: absolute;
            right: 0;
            top: 20%;
            height: 60%;
            width: 1px;
            background-color: #eee;
        }

        .options-icon-btn.view-btn { color: var(--accent-color-gold); }
        .options-icon-btn.edit-btn { color: #28a745; }
        .options-icon-btn.delete-btn { color: #dc3545; }

    </style>

    <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Inventario de clientes
@endsection
@section('content')

    <div class="d-flex flex-row">
        <!--begin::List-->
        <div class="flex-row-fluid">
            <div class="d-flex flex-column flex-grow-1">

                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-12">

                        <!--begin::Card-->
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="card-icon">
                                        {{-- El ícono aquí tomará el color dorado del CSS --}}
                                        <i class="flaticon2-file text-primary"></i>
                                    </span>
                                    <h3 class="card-label">Inventario de clientes</h3>
                                </div>
                                <div class="card-toolbar">
                                    <!-- Botón Nuevo (Estilo dinámico con Degradado) -->
                                    @if (in_array("6", Session::get('permisos')))
                                        <a href="{{ route('cliente.agregarcliente') }}" class="btn btn-dynamic btn-primary-dynamic mr-3" >
                                            <span class="btn-content">
                                                <i class="la la-plus"></i>Nuevo
                                                <span class="btn-arrow">→</span>
                                            </span>
                                        </a>
                                    @endif
                                    <!-- Botón Clientes Inactivos (Estilo Outline mejorado) -->
                                    <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn btn-dynamic btn-secondary-outline-dynamic mr-3">
                                        <span class="btn-content">
                                            <i class="far fa-trash-alt"></i>Clientes inactivos
                                            <span class="btn-arrow">→</span>
                                        </span>
                                    </a>

                                    <!-- Dropdown de Exportar -->
                                    <div class="dropdown dropdown-inline mr-2">
                                        {{-- ... Código de Dropdown de Exportar ... --}}
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="navi flex-column navi-hover py-2">
                                                <li class="navi-item"> <a href="#" class="navi-link" id="export-excel"> <span class="navi-icon"> <i class="la la-file-excel-o"></i> </span> <span class="navi-text">Excel</span> </a> </li>
                                                <li class="navi-item"> <a href="#" class="navi-link" id="export-csv"> <span class="navi-icon"> <i class="la la-file-text-o"></i> </span> <span class="navi-text">CSV</span> </a> </li>
                                                <li class="navi-item"> <a href="#" class="navi-link" id="export-print"> <span class="navi-icon"> <i class="la la-file-text-o"></i> </span> <span class="navi-text">Imprimir</span> </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="collapse" id="collapseExample">
                                    {{-- ... Formulario de Búsqueda ... --}}
                                </div>

                                <!--begin: Datatable-->
                                <table class="table table-hover table-checkable" id="kdatatable_clientes">
                                    <thead>
                                        <tr>
                                            <th>Folio.</th>
                                            <th>Razon social</th>
                                            <th>Nombre cliente</th>
                                            <th>Grupo</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $num = 1; @endphp
                                        @foreach($data as $unid)
                                            <tr>
                                                <td>{{ $unid->num_list }}</td>
                                                <td>{{ $unid->razon_social }}</td>
                                                <td >
                                                    {{-- Icono de persona y nombre (Ahora sin negrita) --}}
                                                    <div class="client-info">
                                                        <i class="flaticon-user-1 client-icon"></i>
                                                        <span>{{ $unid->nombre_cliente }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $unid->grupo }}</td>
                                                <td class="text-center">
                                                    {{-- Opciones agrupadas en un componente limpio --}}
                                                    <div class="options-group">
                                                        {{-- Botón VER (Ojo) - Color Dorado --}}
                                                        <a href="{{ route('cliente.vercliente', $unid->id) }}" class="options-icon-btn view-btn" title="Ver cliente" data-toggle="tooltip" data-placement="top">
                                                            <i class="flaticon-eye"></i>
                                                        </a>

                                                        {{-- Botón EDITAR (Lápiz) - Color Verde --}}
                                                        <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="options-icon-btn edit-btn" title="Editar cliente" data-toggle="tooltip" data-placement="top">
                                                            <i class="flaticon-edit"></i>
                                                        </a>

                                                        {{-- Botón DESACTIVAR (Bote de Basura) - Color Rojo --}}
                                                        <button class="options-icon-btn delete-btn" onClick="deletecliente(`{{ $unid->id }} `,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" title="Desactivar cliente">
                                                            <i class="flaticon-delete"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $num ++; @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Folio.</th>
                                            <th>Razon social</th>
                                            <th>Nombre cliente</th>
                                            <th>Grupo</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </tfoot>

                                </table>
                                <!--end: Datatable-->

                                <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>
        <!--end::List-->
    </div>

{{-- M O D A L S --}}
    <form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id_cliente_delete" value="">
    </form>

    <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection
