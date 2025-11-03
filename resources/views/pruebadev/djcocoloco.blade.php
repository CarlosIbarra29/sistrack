@extends('layouts.app')

@push('styles')
<style>
    /* Colores de referencia del logo SIS PROTEC */
    /* Dorado/Oro Principal: rgb(205, 153, 51) */
    /* Gris Oscuro (Casi Negro): rgb(24, 24, 24) */
    /* Dorado Oscuro (Para el degradado): rgb(184, 142, 46) */

    /* ---------------------------------------------------- */
    /* --- ESTILOS DE BOTONES SUPERIORES (Se mantienen) --- */
    /* ---------------------------------------------------- */

    .btn-top-menu {
        display: inline-flex;
        align-items: center;
        padding: 10px 18px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
        margin-right: 10px;
        border: none;
        transition: all 0.2s;
        position: relative;
        overflow: hidden;
    }

    .btn-nuevo {
        background: linear-gradient(to right, rgb(205, 153, 51), rgb(184, 142, 46));
        color: white;
        box-shadow: 0 4px 6px rgba(184, 142, 46, 0.4);
    }
    .btn-nuevo:hover {
        opacity: 0.9;
    }
    .btn-nuevo::before { content: none; }

    .btn-clientes-inactivos {
        background-color: #e9e9e9;
        color: #555;
        border: 1px solid #ccc;
        box-shadow: none;
    }
    .btn-clientes-inactivos:hover {
        background-color: #ddd;
    }
    .btn-clientes-inactivos::before { content: none; }


    /* ---------------------------------------------------- */
    /* --- ESTILOS BOTONES DE OPCIONES (Borde Degradado) --- */
    /* ---------------------------------------------------- */
    
    .btn-opciones-icon {
        background: white !important;
        color: rgb(24, 24, 24) !important;
        
        /* Borde Degradado (requiere el elemento interno) */
        background: linear-gradient(to right, rgb(205, 153, 51), rgb(184, 142, 46)) !important;
        background-clip: padding-box;
        border: 1px solid transparent !important;
        padding: 0; 
        
        width: 35px;
        height: 35px;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 5px; 
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
    }

    /* Contenedor interior blanco para el efecto de borde */
    .btn-opciones-icon > * {
        background-color: white;
        border-radius: 3px; 
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-opciones-icon .svg-icon,
    .btn-opciones-icon .flaticon-eye,
    .btn-opciones-icon .flaticon-edit,
    .btn-opciones-icon .flaticon-delete {
        color: rgb(24, 24, 24) !important; /* Color de icono Gris Oscuro/Negro */
    }

    .btn-opciones-icon:hover {
        box-shadow: 0 4px 8px rgba(184, 142, 46, 0.5);
    }


    /* ---------------------------------------------------- */
    /* --- NUEVO ESTILO: BOTONES DE PAGINACIÓN --- */
    /* ---------------------------------------------------- */

    /* Estilo para todos los enlaces de paginación (no activos) - Borde Dorado */
    .pagination .page-item .page-link {
        border: 1px solid rgb(205, 153, 51) !important; /* Borde Dorado */
        color: rgb(24, 24, 24) !important; /* Texto Gris Oscuro/Negro */
        background-color: white !important;
        margin: 0 2px;
        border-radius: 4px;
        font-weight: 600;
        transition: all 0.2s;
        height: 40px; 
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Sobrescribir estilos de borde doble en el centro de paginación */
        border-left-width: 1px !important; 
        border-right-width: 1px !important;
    }

    .pagination .page-item .page-link:hover {
        background-color: #fffaf0 !important; 
    }
    
    /* Estilo para la Paginación Activa (Solid Gradient) */
    .pagination .page-item.active .page-link,
    .paginacion-btn-activo {
        background: linear-gradient(to right, rgb(205, 153, 51), rgb(184, 142, 46)) !important;
        color: white !important;
        font-weight: bold;
        border: none !important;
        box-shadow: 0 4px 6px rgba(184, 142, 46, 0.4);
        z-index: 2; 
        /* Resetear márgenes en los extremos para que el botón activo no se vea afectado */
        margin-left: 2px !important;
        margin-right: 2px !important;
    }


    /* ---------------------------------------------------- */
    /* --- CÓDIGO MARCA DE AGUA (NO MODIFICADO) --- */
    /* ---------------------------------------------------- */
    .card-custom {
        position: relative;
        overflow: hidden;
        z-index: 1;
        background-color: white;
    }

    .card-custom::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('{{ asset('img/logos/LogoSis.png') }}');
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 70%;
        opacity: 0.05;
        z-index: -1;
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
<script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
Inventario de clientes
@endsection
@section('content')

<div class="d-flex flex-row">
<div class="flex-row-fluid">
<div class="d-flex flex-column flex-grow-1">

 <div class="row">
 <div class="col-xl-12">

<div class="card card-custom">
<div class="card-header">
<div class="card-title">
<span class="card-icon">
 <i class="flaticon2-file text-primary"></i>
 </span>
 <h3 class="card-label">Inventario de clientes</h3>
 </div>

 <div class="card-toolbar">
 @if (in_array("6", Session::get('permisos')))
 <a href="{{ route('cliente.agregarcliente') }}" class="btn-top-menu btn-nuevo mr-3">
 <i class="la la-plus"></i>Nuevo
 </a>
 @endif
 <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn-top-menu btn-clientes-inactivos">
 <i class="far fa-trash-alt"></i>Clientes inactivos
 </a>
 </div>
 </div>

 <div class="card-body pt-0 pb-0">
 <div class="row align-items-center mb-4 mt-4">
 <div class="col-lg-12">
 <div class="row align-items-center">
 <div class="col-md-4 my-2 my-md-0">
 <div class="input-icon">
 </div>
 </div>
 </div>
 </div>
 </div>

 <hr class="mt-0">
 <div class="collapse" id="collapseExample">
 <div class="card card-body">
 </div>
 </div>
 </div>

 <div class="card-body pt-0">
 <table class="table table-hover table-checkable" id="kdatatable_clientes">
 <thead>
 <tr>
 <th>Folio.</th>
 <th>Razon social</th>
 <th>Nombre cliente</th>
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
 <td>{{ $unid->nombre_cliente }}</td>
 <td>{{ $unid->nombre_cliente }}</td>
 <td>{{ $unid->grupo }}</td>
 <td class="text-center">
 <a href="{{ route('cliente.vercliente', $unid->id) }}" class="btn btn-sm btn-icon mr-2 btn-opciones-icon" title="Ver cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
 <span class="svg-icon svg-icon-md">
 <i class="flaticon-eye"></i>
 </span>
 </a>
 <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="btn btn-sm btn-icon mr-2 btn-opciones-icon" title="Editar cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
 <span class="svg-icon svg-icon-md">
 <i class="flaticon-edit"></i>
 </span>
 </a>
 <button class="btn btn-sm btn-icon mt-1 btn-opciones-icon" onClick="deletecliente(`{{ $unid->id }} `,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" data-toggle="tooltip" data-theme="dark" title="Desactivar cliente">
 <span class="svg-icon svg-icon-md">
 <i class="flaticon-delete"></i>
 </span>
 </button>
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
 <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
 </div>
 </div>
 </div>

 </div>
 </div>
 </div>
</div>

{{-- M O D A L S --}}
<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" id="id_cliente_delete" value="">
</form>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection