@extends('layouts.app')

@push('scripts')
<<<<<<< HEAD
<<<<<<< HEAD
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
=======

  <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
>>>>>>> dd131c9bfd9d89d6618879dfe112cac17b1611e3

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
<<<<<<< HEAD
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

=======
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

=======
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
>>>>>>> 57ac616e540f14b87531ac072f3dc43a92e4f729
@endpush

@section('title')
    Agregar cliente
@endsection

@section('content')

<style>
/* ===== ESTILO TABS AGREGAR CLIENTE ===== */
.nav-tabs.nav-tabs-line .nav-link {
    color: #6c757d; /* Gris */
    font-weight: 500;
}

.nav-tabs.nav-tabs-line .nav-link.active,
.nav-tabs.nav-tabs-line .nav-item.show .nav-link {
    color: #FFC107; /* Amarillo warning */
    border-bottom: 2px solid #FFC107;
}

.nav-tabs.nav-tabs-line .nav-link:hover {
    color: #FFB300;
}
</style>

<!--begin::Card-->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Agregar Cliente</h3>
                <div class="card-toolbar">
                    <a href="{{ route('cliente.listadocliente') }}"
                       class="btn btn-sm btn-clean btn-hover-icon-success btn-icon"
                       data-toggle="tooltip" data-theme="dark" title="Salir">
                        <i class="flaticon2-reply"></i>
                    </a>
                </div>
            </div>

            <!--begin::Form-->
            <form action="{{ route('cliente.guardarcliente') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <!--begin::tabs-->
                    <ul class="nav nav-tabs nav-tabs-line">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                                Información del Cliente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                                Documentación
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-5" id="myTabContent">

                        <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1" role="tabpanel">

                            <!-- === AQUÍ CONTINÚA TU CONTENIDO SIN CAMBIOS === -->
                            <!-- (todo lo demás se queda exactamente igual) -->

                        </div>

                        <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel">
                            <!-- CONTENIDO DOCUMENTACIÓN -->
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" id="btnGuardar" class="btn btn-warning mr-2">
                                Guardar
                            </button>
                            <a href="{{ route('cliente.listadocliente') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>

            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Card-->

>>>>>>> dd131c9bfd9d89d6618879dfe112cac17b1611e3
@endsection
