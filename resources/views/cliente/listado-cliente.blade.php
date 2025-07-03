@extends('layouts.app')
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
                  <a href="{{ route('cliente.agregarcliente') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3">
                    <i class="la la-plus"></i>Nuevo
                  </a>
                @endif
                <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3">
                  <i class="far fa-trash-alt"></i>Clientes inactivos
                </a>
                <!-- Buscador visible -->
                <div class="ml-5">
                  <input type="text" class="form-control datatable-input" placeholder="Buscar por nombre" data-col-index="2" />
                </div>
              </div>
            </div>

            <div class="card-body">
              <!-- Tabla -->
              <table class="table table-hover table-checkable" id="kdatatable_usuarios">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Razón Social</th>
                    <th>Nombre Cliente</th>
                    <th>Grupo</th>
                    <th class="text-center">Opciones</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Razón Social</th>
                    <th>Nombre Cliente</th>
                    <th>Grupo</th>
                    <th class="text-center">Opciones</th>
                  </tr>
                </tfoot>
              </table>

              <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
              <input type="hidden" id="clientedatatable" value="{{ route('cliente.clientelistadodatatable') }}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- FORMULARIO DELETE --}}
<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}">
  @csrf
  <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>
@endsection
