@extends('layouts.app')
@push('scripts')

  <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
    /* Colores del logo */
    :root {
        --gold: #D4AF37;
        --gold-dark: #B8860B;
        --black: #000000;
    }

    /* Iconos en dorado */
    .icon-gold i {
        color: var(--gold) !important;
        font-size: 16px;
    }

    /* Botones outline dorados */
    .btn-outline-gold {
        border: 1px solid var(--gold) !important;
        color: var(--gold) !important;
    }
    .btn-outline-gold:hover {
        background: var(--gold) !important;
        color: var(--black) !important;
    }

    /* Badge verde estilo elegante */
    .badge-active-green {
        background: #28a745 !important;
        color: white !important;
        font-weight: bold;
        padding: 6px 12px;
        border-radius: 12px;
    }
</style>

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

                    <div class="card card-custom shadow-lg"> 
                
                        <div class="card-header bg-white border-0 py-4">
                            <div class="card-title">
                                <span class="card-icon">
                                    <i class="flaticon2-file text-primary"></i>
                                </span>
                                <h3 class="card-label font-weight-bolder text-dark">Inventario de clientes</h3>
                            </div>
                            <div class="card-toolbar">

                                @if (in_array("6", Session::get('permisos'))) 
                                    <a href="{{ route('cliente.agregarcliente') }}" class="btn btn-primary font-weight-bolder mr-3 ml-3">
                                        <i class="la la-plus"></i>Nuevo Cliente
                                    </a>
                                @endif

                                <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn btn-light-secondary font-weight-bolder mr-3 ml-3">
                                    <i class="far fa-trash-alt"></i>Clientes inactivos
                                </a>

                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-outline-secondary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Exportar
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-item"><a href="#" class="navi-link" id="export-excel"><span class="navi-icon"><i class="la la-file-excel-o"></i></span><span class="navi-text">Excel</span></a></li>
                                            <li class="navi-item"><a href="#" class="navi-link" id="export-csv"><span class="navi-icon"><i class="la la-file-text-o"></i></span><span class="navi-text">CSV</span></a></li>
                                            <li class="navi-item"><a href="#" class="navi-link" id="export-print"><span class="navi-icon"><i class="la la-file-text-o"></i></span><span class="navi-text">Imprimir</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped table-borderless table-hover" id="kdatatable_clientes">
                                <thead>
                                <tr>
                                    <th>Folio.</th>
                                    <th>Razon social</th>
                                    <th>Nombre cliente</th>
                                    <th>Grupo</th>
                                    <th class="text-center">Estado</th>
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
                                        <td>{{ $unid->grupo }}</td>

                                        {{-- Estado Activo verde --}}
                                        <td class="text-center">
                                            <span class="badge-active-green">
                                                <i class="fas fa-check-circle"></i> Activo
                                            </span>
                                        </td>

                                        <td>
                                            {{-- Ver --}}
                                            <a href="{{ route('cliente.vercliente', $unid->id) }}" 
                                               class="btn btn-sm btn-icon btn-outline-gold mr-1" 
                                               title="Ver cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                                <i class="flaticon-eye icon-gold"></i>
                                            </a>

                                            {{-- Editar --}}
                                            <a href="{{ route('cliente.editarcliente', $unid->id) }}" 
                                               class="btn btn-sm btn-icon btn-outline-gold mr-1" 
                                               title="Editar cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                                <i class="flaticon-edit icon-gold"></i>
                                            </a>

                                            {{-- Eliminar --}}
                                            <button class="btn btn-sm btn-icon btn-outline-gold" 
                                                    onClick="deletecliente(`{{ $unid->id }} `,`{{ $unid->id }}`)" 
                                                    data-toggle="modal" data-target="#model_delete_user" 
                                                    data-toggle="tooltip" data-theme="dark" title="Desactivar cliente">
                                                <i class="flaticon-delete icon-gold"></i>
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
                                    <th class="text-center">Estado</th>
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
