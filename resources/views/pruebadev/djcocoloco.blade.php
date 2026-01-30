@extends('layouts.app')
@push('scripts')

<<<<<<< HEAD
<style>
    .form-control-solid { background-color: #F3F6F9; border-color: transparent; font-weight: 500; }
    .form-control-solid:focus { background-color: #EBEDF3; border-color: transparent; }
    label { font-weight: 600; color: #3F4254; margin-bottom: .5rem; }
    .separator.separator-dashed { border-bottom: 1px dashed #EBEDF3; }
    .card-title-custom { font-size: 1.1rem; font-weight: 700; color: #181C32; }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            {{-- HEADER --}}
            <div class="card-header border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Agregar Cliente</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('cliente.listadocliente') }}" class="btn btn-light-danger btn-sm font-weight-bold">
                        <i class="flaticon2-reply"></i> Regresar
                    </a>
                </div>
            </div>

            <form action="{{ route('cliente.guardarcliente') }}" method="POST" id="submit_cliente" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    {{-- TABS --}}
                    <ul class="nav nav-tabs nav-tabs-line nav-tabs-primary">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_pane_1">
                                <i class="flaticon2-user mr-2"></i> Información del Cliente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_pane_2">
                                <i class="flaticon2-file mr-2"></i> Documentación
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-8">
                        {{-- TAB 1: INFORMACIÓN --}}
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            
                            <div class="row mb-6">
                                <div class="col-lg-4">
                                    <label>Razón social <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid" name="razon_social" id="razon_social" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Nombre comercial / Cliente <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-solid" name="cliente" id="cliente" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Grupo</label>
                                    <input type="text" class="form-control form-control-solid" name="grupo" id="grupo">
                                </div>
=======
  <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Inventario de clientes
@endsection
@section('content')
<style>
  .alert-card {
        background: white;
        border: 1px solid #e8e8e8;
        padding: 22px;
        border-radius: 14px;
        transition: 0.3s ease;
    }

    .alert-card:hover {
        border-color: #eaeaea;
        box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
    }

    .alert-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .alert-header i {
        font-size: 25px;
        color: #B9770E;
    }

    .alert-title {
        font-size: 20px;
        font-weight: 700;
        color: #000000
    }

    .alert-value {
        font-size: 32px;
        font-weight: 800;
        color: var(--);
        margin-top: 4px;
    }
    .divider {
        height: 1px;
        background: #eaeaea;
        margin: 14px 0;
    }

    .coloricono {
      color:#B9770E!important;
    }
</style>
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
                        <i class="flaticon2-file coloricono"></i>
                      </span>
                                <h3 class="card-label">Inventario de clientes</h3>
>>>>>>> 6527e855e3a5c93e7bf61b8c73855dc1c11e9ab6
                            </div>
                            <div class="card-toolbar">

<<<<<<< HEAD
                            <div class="separator separator-dashed my-8"></div>

                            <h4 class="card-title-custom mb-4"><i class="flaticon2-gear text-primary mr-2"></i> Información Técnica</h4>
                            <div class="row mb-6">
                                <div class="col-lg-3">
                                    <label>Días de crédito</label>
                                    <input type="number" class="form-control form-control-solid" name="dias_credito" id="dias_credito">
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo estadía</label>
                                    <input type="text" class="form-control form-control-solid" name="costo_estadia" id="costo_estadia">
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo km extraordinario</label>
                                    <input type="text" class="form-control form-control-solid" name="costo_km" id="costo_km">
                                </div>
                                <div class="col-lg-3">
                                    <label>Costo estadía no armada</label>
                                    <input type="text" class="form-control form-control-solid" name="costo_estadia_armada" id="costo_estadia_armada">
                                </div>
                            </div>

                            <div class="separator separator-dashed my-8"></div>

                            {{-- CONTACTO OPERATIVO --}}
                            <h4 class="card-title-custom mb-4"><i class="flaticon2-avatar text-primary mr-2"></i> Contacto Operativo</h4>
                            <input type='hidden' id='tipoArchivo2' value='{{ $cadenatipocliente }}'>
                            
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="tblDocumentos">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Tipo contacto</th>
                                                    <th>Nombre contacto</th>
                                                    <th>Email</th>
                                                    <th>Teléfono</th>
                                                    <th style="width: 50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyDocumentos"></tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-light-primary font-weight-bolder hrefAgregarOtro">
                                        <i class="flaticon2-plus"></i> Agregar Contacto Operativo
                                    </button>
                                </div>
                            </div>

                            <div class="row mt-10">
                                <div class="col-lg-12">
                                    <label>Observaciones</label>
                                    <textarea class="form-control form-control-solid" name="observaciones" id="observaciones" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 2: DOCUMENTOS --}}
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            <h4 class="card-title-custom mb-4"><i class="flaticon2-copy text-primary mr-2"></i> Documentación del Cliente</h4>
                            <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover" id="tblDocumentos2">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Adjuntar Documento</th>
                                                    <th>Tipo de Documento</th>
                                                    <th style="width: 50px"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyDocumentos2"></tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-light-warning font-weight-bolder hrefAgregarOtro2">
                                        <i class="flaticon2-plus"></i> Agregar Documento
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('cliente.listadocliente') }}"  class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
=======
{{--                                 <a class="btn btn-link-primary font-weight-bold mr-2 busqueda" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Busqueda
                                </a> --}}

                                <!--begin::Button-->
                                @if (in_array("6", Session::get('permisos', []))) 
                                  
                                  <a href="{{ route('cliente.agregarcliente') }}"class="btn btn-light-warning font-weight-bold mr-3 ml-3" style="color:black"><i class="la la-plus"></i>Nuevo</a>
                                @endif
                                <!--end::Button-->

                                

                                    <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn btn-light-warning font-weight-bold mr-3 ml-3" style="color:black"><i class="far fa-trash-alt"></i>Clientes inactivos</a>

                                <!--begin::Dropdown-->
                                <div class="dropdown dropdown-inline mr-2">
{{--                                     <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="svg-icon svg-icon-md">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24" />
                                          <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                          <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                        </g>
                                      </svg>
                                      </span>Exportar
                                    </button> --}}
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-excel">
                                                <span class="navi-icon">
                                                  <i class="la la-file-excel-o"></i>
                                                </span>
                                                <span class="navi-text">Excel</span>
                                              </a>
                                            </li>
{{--                                             <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-pdf">
                                                <span class="navi-icon">
                                                  <i class="la la-file-pdf-o"></i>
                                                </span>
                                                <span class="navi-text">PDF</span>
                                              </a>
                                            </li> --}}
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-csv">
                                                <span class="navi-icon">
                                                  <i class="la la-file-text-o"></i>
                                                </span>
                                                <span class="navi-text">CSV</span>
                                              </a>
                                            </li>
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-print">
                                                <span class="navi-icon">
                                                  <i class="la la-file-text-o"></i>
                                                </span>
                                                <span class="navi-text">Imprimir</span>
                                              </a>
                                            </li>

                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                    <!--end::Dropdown Menu-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                        </div>
                        <div class="card-body">

                          <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                <!--begin: Search Form-->
                                <form class="mb-15">
                                  <div class="row mb-6">
                                    <div class="col-lg-6 mb-lg-0 mb-6">
                                      <label>Nombre del cliente:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="1" />
                                    </div>
                                  </div>

                                  <div class="row mt-8">
                                    <div class="col-lg-12">
                                      <button class="btn btn-primary btn-primary--icon" id="kt_search">
                                        <span><i class="la la-search"></i><span>Buscar</span></span>
                                      </button>&#160;&#160;
                                      <button class="btn btn-secondary btn-secondary--icon" id="kt_reset">
                                        <span><i class="la la-close"></i><span>Limpiar</span></span>
                                      </button>
                                    </div>
                                  </div>
                                </form>
                              </div>
                          </div>



<div class="row">
  <div class="col-lg-3">
        <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-wallet"></i>
                <span class="alert-title">Pendientes</span>
            </div>
            <div class="alert-value">12</div>
            <div class="divider"></div>
            <small>Clientes con pagos programados los próximos 7 días.</small>
        </div>
  </div>
  <div class="col-lg-3">
<div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-user-clock"></i>
                <span class="alert-title">Clientes inactivos</span>
            </div>
            <div class="alert-value">8</div>
            <div class="divider"></div>
            <small>Clientes sin actividad en más de 30 días.</small>
        </div>
  </div>
  <div class="col-lg-3">
  <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-exclamation-circle"></i>
                <span class="alert-title">Tareas vencidas</span>
            </div>
            <div class="alert-value">3</div>
            <div class="divider"></div>
            <small>Tareas importantes que requieren atención inmediata.</small>
        </div>
  </div>
  <div class="col-lg-3">
  <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-user-shield"></i>
                <span class="alert-title">Clientes en riesgo</span>
            </div>
            <div class="alert-value">4</div>
            <div class="divider"></div>
            <small>Clientes con señales de abandono o retrasos.</small>
        </div>
  </div>

</div>



<div class="col-xl-12">
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
                                      <td>
                                        <a href="{{ route('cliente.vercliente', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mr-2" title="Ver cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-eye"></i>
                                            </span>
                                        </a>

                                        <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mr-2" title="Editar cliente" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-edit"></i>
                                            </span>
                                        </a>

                                        <button class="btn btn-clean btn-sm btn-icon btn-outline-warning mt-1" onClick="deletecliente(`{{ $unid->id }} `,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" data-toggle="tooltip" data-theme="dark" title="Desactivar cliente">
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
                            <!--end: Datatable-->
</div>





                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                            {{-- <input type="hidden" id="clientedatatable" value="{{ route('cliente.clientelistadodatatable') }}"> --}}

                        </div>
                    </div>
                    <!--end::Card-->
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
>>>>>>> 6527e855e3a5c93e7bf61b8c73855dc1c11e9ab6
