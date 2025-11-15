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
                <h3 class="card-label">Inventario de clientes</h3>
              </div>
              <div class="card-toolbar">

                <!--begin::Button-->
                @if (in_array("6", Session::get('permisos'))) 
                  <a href="{{ route('cliente.agregarcliente') }}" class="btn-gradient-blue">
                    <i class="la la-plus"></i>
                    <span>Nuevo</span>
                    <span class="arrow">➜</span>
                  </a>
                @endif
                <!--end::Button-->

                <!-- ✅ Clientes inactivos -->
                <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn-gradient-blue ml-3">
                  <i class="far fa-trash-alt"></i>
                  <span>Clientes inactivos</span>
                  <span class="arrow">➜</span>
                </a>

              </div>
            </div>
            <div class="card-body">

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
                    <td>{{ $unid->nombre_cliente }}</td>
                    <td>{{ $unid->grupo }}</td>
                    <td class="text-center">

                      <!-- 👁️ Ver cliente -->
                      <a href="{{ route('cliente.vercliente', $unid->id) }}" class="btn btn-sm btn-outline-primary mr-2" title="Ver cliente" data-toggle="tooltip">
                        <i class="flaticon-eye"></i>
                      </a>

                      <!-- ✏️ Editar cliente -->
                      <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="btn btn-sm btn-outline-warning mr-2" title="Editar cliente" data-toggle="tooltip">
                        <i class="flaticon-edit"></i>
                      </a>

                      <!-- ❌ Desactivar cliente -->
                      <button class="btn btn-sm btn-outline-danger mt-1" onClick="deletecliente(`{{ $unid->id }}`,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" title="Desactivar cliente">
                        <i class="flaticon-delete"></i>
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
              <!--end: Datatable-->

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

{{-- MODALS --}}
<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>

<!-- ✅ Estilos solo para los botones principales -->
<style>
.btn-gradient-blue {
  background: linear-gradient(90deg, #10305D, #1956A6);
  color: #fff !important;
  font-weight: bold;
  padding: 10px 22px;
  border-radius: 8px;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: all 0.3s ease;
  border: none;
  cursor: pointer;
}

.btn-gradient-blue i {
  font-size: 16px;
}

.btn-gradient-blue .arrow {
  transition: transform 0.3s ease;
}

.btn-gradient-blue:hover {
  background: linear-gradient(90deg, #1956A6, #10305D);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(16, 48, 93, 0.4);
}

.btn-gradient-blue:hover .arrow {
  transform: translateX(5px);
}
</style>

@endsection
