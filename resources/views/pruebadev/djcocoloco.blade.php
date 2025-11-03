@extends('layouts.app')

@push('styles')
<style>
    /* Colores de referencia del logo SIS PROTEC */
    /* Dorado/Oro Principal: rgb(205, 153, 51) */
    /* Gris Oscuro (Casi Negro): rgb(24, 24, 24) */
    /* Dorado Oscuro (Para el degradado): rgb(184, 142, 46) */
    /* Color de Texto Principal: white */
    /* Gris de fondo sutil: rgb(35, 35, 35) */

    /* ---------------------------------------------------- */
    /* --- ESTILOS GLOBALES Y DE CONTENEDOR --- */
    /* ---------------------------------------------------- */

    /* Fondo de la vista general (body) */
    .app-content {
        background-color: rgb(35, 35, 35) !important; /* Fondo Gris Oscuro Suave */
    }

    /* Contenedor principal (card-custom) */
    .card-custom {
        position: relative;
        overflow: hidden;
        z-index: 1;
        background-color: rgb(24, 24, 24) !important; /* Fondo Negro Sólido para la tarjeta */
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
    }

    /* Encabezado de la tarjeta (Inventario de clientes inactivos) */
    .card-header {
        background-color: rgb(24, 24, 24) !important; /* Mismo fondo oscuro */
        border-bottom: 1px solid rgb(184, 142, 46, 0.5) !important; /* Separador Dorado Suave */
    }

    /* Título principal */
    .card-label {
        color: white !important; /* Texto del título en BLANCO */
        font-weight: 700 !important;
    }

    /* Icono del título */
    .card-icon .flaticon2-file {
        color: rgb(205, 153, 51) !important; /* Icono en Dorado */
    }
    
    /* Texto "Mostrar X registros" y "Buscar:" */
    .dataTables_length,
    .dataTables_filter label,
    .dataTables_filter input::placeholder {
        color: white !important; /* Texto en BLANCO */
    }
    
    /* Campos de entrada de texto (Buscar) y select (Mostrar X) */
    .dataTables_filter input,
    .dataTables_length select {
        background-color: rgb(50, 50, 50) !important; /* Fondo oscuro sutil */
        border: 1px solid rgb(184, 142, 46) !important; /* Borde Dorado */
        color: white !important; /* Texto de entrada en BLANCO */
    }

    /* ---------------------------------------------------- */
    /* --- ESTILO BOTÓN REGRESAR --- */
    /* ---------------------------------------------------- */

    .btn-regresar {
        background-color: transparent !important;
        color: rgb(205, 153, 51) !important; /* Texto en Dorado */
        border: 2px solid rgb(205, 153, 51) !important; /* Borde Dorado */
        font-weight: 700;
        border-radius: 6px;
        padding: 10px 20px;
        transition: all 0.2s;
    }
    .btn-regresar:hover {
        background-color: rgb(205, 153, 51, 0.1) !important; /* Sombra sutil dorada */
        color: white !important; /* Texto blanco en hover */
        box-shadow: 0 0 10px rgba(205, 153, 51, 0.5);
    }

    /* ---------------------------------------------------- */
    /* --- ESTILOS DE TABLA (kdatatable_clientes_inactivos) --- */
    /* ---------------------------------------------------- */

    /* Estilo del cuerpo de la tabla */
    #kdatatable_clientes_inactivos {
        background-color: rgb(24, 24, 24) !important;
    }
    
    /* Regla Crítica para el contenido de las celdas */
    #kdatatable_clientes_inactivos tbody tr td {
        color: white !important; /* Aseguramos que el texto de CADA celda sea BLANCO */
        background-color: transparent !important;
    }


    /* Encabezado y pie de tabla */
    #kdatatable_clientes_inactivos thead th,
    #kdatatable_clientes_inactivos tfoot th {
        color: rgb(205, 153, 51) !important; /* Texto del encabezado en Dorado */
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 2px solid rgb(205, 153, 51) !important; /* Línea inferior dorada */
        background-color: rgb(24, 24, 24) !important; /* Fondo oscuro */
    }

    /* Filas de la tabla (para el efecto de cebra o hover) */
    #kdatatable_clientes_inactivos tbody tr {
        background-color: rgb(24, 24, 24); /* Fondo base */
        border-bottom: 1px solid rgb(50, 50, 50); /* Separador sutil */
    }

    /* Estilo al pasar el ratón (Hover) */
    #kdatatable_clientes_inactivos tbody tr:hover {
        background-color: rgb(45, 45, 45) !important; /* Gris más claro al pasar el ratón */
    }


    /* ---------------------------------------------------- */
    /* --- ESTILO BOTÓN DE ACCIONES (Activar) --- */
    /* ---------------------------------------------------- */
    
    .activar-cliente {
        background-color: rgb(30, 85, 30) !important; /* Fondo Verde Oscuro (Para activar) */
        color: white !important; 
        border: 1px solid rgb(60, 150, 60) !important; 
        padding: 8px 10px;
        width: 38px;
        height: 38px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .activar-cliente i {
        color: white !important; /* Icono en blanco */
    }

    .activar-cliente:hover {
        background-color: rgb(40, 105, 40) !important;
        box-shadow: 0 4px 8px rgba(30, 85, 30, 0.5);
    }
    
    /* ---------------------------------------------------- */
    /* --- ESTILOS DE PAGINACIÓN --- */
    /* ---------------------------------------------------- */

    /* Paginación (Botones Anterior/Siguiente y números) */
    .dataTables_wrapper .pagination .page-item .page-link {
        border: 1px solid rgb(184, 142, 46) !important; /* Borde Dorado */
        color: white !important; /* Texto en BLANCO */
        background-color: rgb(50, 50, 50) !important;
        margin: 0 2px;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.2s;
    }

    .dataTables_wrapper .pagination .page-item .page-link:hover {
        background-color: rgb(65, 65, 65) !important; 
        color: white !important;
    }

    /* Botón de paginación Activo */
    .dataTables_wrapper .pagination .page-item.active .page-link {
        background: linear-gradient(to right, rgb(205, 153, 51), rgb(184, 142, 46)) !important;
        color: white !important;
        border: none !important;
    }

    /* Texto de Registros mostrados */
    .dataTables_info {
        color: white !important; /* Texto en BLANCO */
    }

    /* ---------------------------------------------------- */
    /* --- CÓDIGO MARCA DE AGUA --- */
    /* ---------------------------------------------------- */
    
    .card-custom::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        /* Asegúrate de que esta ruta sea correcta para tu logo */
        background-image: url('{{ asset('img/logos/LogoSis.png') }}'); 
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 70%;
        opacity: 0.1; 
        z-index: -1;
        pointer-events: none;
        /* Aplicar un filtro de color para que el logo se vea blanco/dorado */
        filter: grayscale(100%) brightness(200%); 
    }
</style>
@endpush

@section('title')
 Catálogo de clientes inactivos
@endsection

@push('scripts')
 <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
 <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush


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
 <i class="flaticon2-file text-primary"></i>
 </span>
 <h3 class="card-label">Inventario de clientes inactivos</h3>
 </div>
 <div class="card-toolbar">

 <!--begin::Button-->
 <a href="{{ route('cliente.listadocliente') }}" class="btn-regresar mr-3 ml-3">
 Regresar</a>
 <!--end::Button-->

 </div>
 </div>
 <div class="card-body pt-0">
 <!--begin: Datatable-->
 <table class="table table-hover table-checkable" id="kdatatable_clientes_inactivos">
 <thead>
 <tr>
 {{-- <th>No.</th> --}}
 <th>Razon social</th>
<th>Nombre cliente</th>
 <th>Grupo</th>
 <th class="text-center">Acciones</th>
 </tr>
 </thead>

 <tbody>
 @foreach($data as $unid)
 <tr>
 {{-- <td>{{ $unid->id }}</td> --}}
 <td>{{ $unid->razon_social }}</td>
 <td>{{ $unid->nombre_cliente }}</td>
 <td>{{ $unid->grupo }}</td>

 <td class="text-center">
 <button class="activar-cliente" data-id="{{ $unid->id }}" data-nombre="{{ $unid->razon_social }}" data-toggle="tooltip" data-theme="dark" title="Activar Cliente" ><i class="flaticon2-reply "></i></button>
 </td>
 </tr>
 @endforeach
 </tbody>

 <tfoot>
 <tr>
 {{-- <th>No.</th> --}}
 <th>Razon social</th>
 <th>Nombre cliente</th>
 <th>Grupo</th>
 <th class="text-center">Acciones</th>
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

 <form method="post" id="cliente_act_form" action="{{ route('cliente.activarcliente') }}" enctype="multipart/form-data">
 @csrf
<input type="hidden" name="id" id="id_delete" value="">
 </form>


@endsection