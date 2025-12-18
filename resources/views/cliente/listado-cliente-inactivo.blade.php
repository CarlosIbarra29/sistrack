@extends('layouts.app')

@section('title')
    Catálogo de clientes inactivos
@endsection

@push('scripts')
    <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- 💡 AGREGAR ESTILOS PERSONALIZADOS AQUÍ (O EN UN ARCHIVO CSS) --}}
    <style>
        /* Definición de la paleta */
        :root {
            --color-dorado-mate: #A68A6B; /* Dorado Mate / Champán */
            --color-negro-suave: #252525; /* Negro Suave para fondos/texto */
            --color-gris-oscuro: #333333; /* Gris Oscuro para texto */
            --color-gris-claro: #F8F8F8; /* Gris Claro para el fondo general */
            --color-borde-gris: #E0E0E0; /* Gris para bordes sutiles */
        }

        /* Estilo general del fondo */
        body {
            background-color: var(--color-gris-claro);
        }

        /* Encabezados de tabla: Fondo Negro Suave, Texto Blanco/Dorado */
        #kdatatable_clientes_inactivos thead {
            background-color: var(--color-negro-suave);
        }

        #kdatatable_clientes_inactivos thead th {
            color: white !important; /* Texto de encabezado blanco */
            border-bottom: 2px solid var(--color-dorado-mate); /* Línea inferior dorada */
        }

        /* Estilo de la fila de datos para contraste (opcional) */
        #kdatatable_clientes_inactivos tbody tr {
            color: var(--color-gris-oscuro); /* Texto de las filas en gris oscuro */
        }

        /* Estilo para los iconos flaticon dorados */
        .icono-dorado i {
            color: var(--color-dorado-mate) !important;
        }

        /* Estilo de los botones de acción dorados */
        .btn-accion-dorado {
            color: var(--color-dorado-mate) !important;
            border-color: var(--color-dorado-mate) !important;
        }
        .btn-accion-dorado:hover {
            background-color: var(--color-dorado-mate) !important;
            color: white !important;
        }
    </style>
@endpush


@section('content')
    <div class="d-flex flex-row">

    <div class="flex-row-fluid">
        <div class="d-flex flex-column flex-grow-1">

            <div class="row">
                <div class="col-xl-12">

                {{-- QUITAMOS card-custom para que el fondo sea blanco por defecto --}}
                    <div class="card">
                        <div class="card-header border-0"> {{-- Usamos border-0 para un look más limpio --}}
                            <div class="card-title">
                                <span class="card-icon icono-dorado"> {{-- Clase personalizada para el icono --}}
                                    <i class="flaticon2-file"></i> {{-- Se quita 'text-warning' --}}
                                </span>
                                {{-- Texto principal en negro suave --}}
                                <h3 class="card-label" style="color: var(--color-negro-suave);">Inventario de clientes inactivos</h3>
                            </div>
                            <div class="card-toolbar">

                                {{-- Botón "Regresar" en Dorado Mate --}}
                                <a href="{{ route('cliente.listadocliente') }}"
                                   class="btn font-weight-bold mr-3 ml-7"
                                   style="background-color: var(--color-dorado-mate); color: white;">
                                    Regresar
                                </a>
                                </div>
                        </div>
                        <div class="card-body">
                            {{-- Aplicamos estilos de tabla para que el encabezado sea oscuro --}}
                            <table class="table table-hover table-checkable" id="kdatatable_clientes_inactivos">

                                <thead>
                                <tr>
                                    <th>Razon social</th>
                                    <th>Nombre cliente</th>
                                    <th>Grupo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($data as $unid)
                                        <tr>
                                            <td>{{ $unid->razon_social }}</td>
                                            <td>{{ $unid->nombre_cliente }}</td>
                                            <td>{{ $unid->grupo }}</td>

                                            <td class="text-center">
                                                {{-- Botón de acción: Usamos la clase personalizada Dorado Mate --}}
                                                <button class="btn btn-clean btn-icon btn-accion-dorado mt-1 activar-cliente" 
                                                        data-id="{{ $unid->id }}" 
                                                        data-nombre="{{ $unid->razon_social }}" 
                                                        data-toggle="tooltip" 
                                                        data-theme="dark" 
                                                        title="Activar Cliente" >
                                                    <i class="flaticon2-reply "></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Razon social</th>
                                    <th>Nombre cliente</th>
                                    <th>Grupo</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                                </tfoot>

                            </table>
                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

                        </div>
                    </div>
                    </div>

            </div>
            </div>
    </div>
    </div>

    <form method="post" id="cliente_act_form" action="{{ route('cliente.activarcliente') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" id="id_delete" value="">
    </form>
@endsection