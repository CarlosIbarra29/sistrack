@extends('layouts.app')

@push('styles')
<style>
    /* 🚨 CÓDIGO CORREGIDO PARA LA MARCA DE AGUA EN LA TARJETA CENTRAL */
    
    /* 1. Aplicamos los estilos al contenedor de la tarjeta que contiene la tabla */
    .card-custom {
        position: relative; /* Esencial para que el pseudo-elemento ::before se posicione correctamente */
        overflow: hidden; 
        z-index: 1; /* Asegura que la tarjeta esté visible */
        background-color: white; /* Asegura un fondo sólido para que el logo se vea bien como marca de agua */
    }

    /* 2. Estilo para el pseudo-elemento que crea la marca de agua */
    .card-custom::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        
        /* 💡 RUTA CLAVE: AJUSTA ESTA RUTA si tu logo no está en public/img/logos/ */
        background-image: url('{{ asset('img/logos/LogoSis.png') }}'); 
        
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 70%; /* Ajusta el tamaño para que encaje bien en la tarjeta */
        opacity: 0.05; /* La transparencia necesaria para que sea una marca de agua sutil */
        z-index: -1; /* ¡CLAVE! Lo envía al fondo de la tarjeta, detrás de la tabla y contenido */
        pointer-events: none; /* No interfiere con clics ni selecciones de texto */
    }

    /* 3. Las reglas de .watermark-background y body::before han sido ELIMINADAS para evitar la doble marca de agua
       y que el logo aparezca sobre la barra lateral. */
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

    {{-- ELIMINAMOS la clase 'watermark-background' del div principal, ya que la aplicamos directamente al .card-custom --}}
 <div class="d-flex flex-row"> 
        <div class="flex-row-fluid">
 <div class="d-flex flex-column flex-grow-1">

 <div class="row">
 <div class="col-xl-12">

     {{-- La marca de agua se aplicará en este div gracias al CSS .card-custom::before --}}
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
 <a href="{{ route('cliente.agregarcliente') }}" class="btn btn-light-primary font-weight-bolder mr-3" >
 <i class="la la-plus"></i>Nuevo</a>
 @endif
 <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn btn-light-primary font-weight-bolder mr-3">
 <i class="far fa-trash-alt"></i>Clientes inactivos</a>

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
 <a href="{{ route('cliente.vercliente', $unid->id) }}" class="btn btn-sm btn-outline-success btn-icon mr-2" title="Ver cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
 <span class="svg-icon svg-icon-md">
  <i class="flaticon-eye"></i>
 </span>
 </a>
 <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="btn btn-sm btn-outline-success btn-icon mr-2" title="Editar cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
 <span class="svg-icon svg-icon-md">
 <i class="flaticon-edit"></i>
 </span>
 </a>
 <button class="btn btn-clean btn-sm btn-icon btn-outline-success mt-1" onClick="deletecliente(`{{ $unid->id }} `,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" data-toggle="tooltip" data-theme="dark" title="Desactivar cliente">
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