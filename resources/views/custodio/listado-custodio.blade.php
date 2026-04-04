@extends('layouts.app')
@push('scripts')
{{-- <script src="{{ asset('js/Usuarios.js') }}"></script> --}}
  <script src="{{ asset('js/custodios/CatalogoCustodio.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Inventario de custodios
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
                        <i class="flaticon2-file coloricono"></i>
                      </span>
                                <h3 class="card-label">Inventario de custodios</h3>
                            </div>
                            <div class="card-toolbar">

{{--                                 <a class="btn btn-link-primary font-weight-bold mr-2 busqueda" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Busqueda
                                </a> --}}

                                <!--begin::Button-->
                                @if(true)
                                  <a href="{{ route('custodio.agregarcustodio') }}"class="btn btn-light-warning font-weight-bold mr-3 ml-3" style="color:black"><i class="la la-plus"></i>Nuevo</a>
                                @endif
                                <!--end::Button-->

                                <a href="{{ route('custodio.listadocustodioinactivo') }}" class="btn btn-light-warning font-weight-bold mr-3 ml-3" style="color:black"><i class="far fa-trash-alt"></i>Clientes inactivos</a>


{{--                                 <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="svg-icon svg-icon-md">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                          <rect x="0" y="0" width="24" height="24" />
                                          <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                          <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                        </g>
                                      </svg>
                                      </span>Exportar
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="navi flex-column navi-hover py-2">
                                            <li class="navi-item">
                                              <a href="#" class="navi-link" id="export-excel">
                                                <span class="navi-icon">
                                                  <i class="la la-file-excel-o"></i>
                                                </span>
                                                <span class="navi-text">Excel</span>
                                              </a>
                                            </li>
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
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="card-body">

                          <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                <!--begin: Search Form-->
                                <form class="mb-15">
                                  <div class="row mb-6">
                                    <div class="col-lg-64mb-lg-0 mb-4">
                                      <label>Nombre del custodio:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="1" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-4">
                                      <label>Apellido paterno:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="2" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-4">
                                      <label>Apellido materno:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="3" />
                                    </div>
                                  </div>

                                  <div class="row mb-6">
                                    <div class="col-lg-64mb-lg-0 mb-4">
                                      <label>CURP:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="4" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-4">
                                      <label>RFC:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="5" />
                                    </div>
                                    <div class="col-lg-4 mb-lg-0 mb-4">
                                      <label>Correo electronico:</label>
                                      <input type="text" class="form-control datatable-input" data-col-index="7" />
                                    </div>
                                  </div>


                                  <div class="row mt-8">
                                    <div class="col-lg-12">
                                      <button class="btn btn-primary btn-warning--icon" id="kt_search">
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
                <span class="alert-title">Custodios Inactivo</span>
            </div>
            <div class="alert-value">8</div>
            <div class="divider"></div>
            <small>Tarifas inactivas en más de 30 días.</small>
        </div>
  </div>
  <div class="col-lg-3">
  <div class="alert-card">
            <div class="alert-header">
                <i class="fas fa-user-shield"></i>
                <span class="alert-title">Grafica</span>
                
            </div>
            <div class="alert-value">4</div>
            <div class="divider"></div>
            <small>Clientes con señales de abandono o retrasos.</small>
        </div>
  </div>

  <div class="col-lg-3">
    <div class="alert-card" style="cursor: pointer; border: 1px solid #ffcc00;" data-toggle="modal" data-target="#modalVencimientos">
        <div class="alert-header">
            <i class="fas fa-bell "></i>
            <span class="alert-title">Vencimientos Proximos</span>
        </div>
        <div class="alert-value text-warning">
            <div class="alert-value text-warning">
    {{ $data->where('tiene_vencimientos_proximos', true)->count() }}
</div>
        </div>
        <div class="divider"></div>
        <small>Documentos (Licencia, Seguro, etc.) por vencer en 30 días.</small>
    </div>
</div>

</div>

                            <!--begin: Datatable-->
                            <table class="table table-hover table-checkable inventory-table" id="kdatatable_usuarios2">
                                <thead>
                                <tr>
                                  <th>Folio.</th>
                                  <th>Nombre</th>
                                  <th>Apellido Paterno</th>
                                  <th>Apellido Materno</th>
                                  <th>CURP</th>
                                  <th>RFC</th>
                                  <th>Número Telefono</th>
                                  <th>Correo Electónico</th>
                                  <th class="text-center">Opciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                  @php $num = 1; @endphp
                                  @foreach($data as $unid)
                                    <tr>
                                      <td>{{ $unid->num_list }}</td>
                                      <td>{{ $unid->nombre_custodio }}</td>
                                      <td>{{ $unid->ap_paterno }}</td>
                                      <td>{{ $unid->ap_materno }}</td>
                                      <td>{{ $unid->curp }}</td>
                                      <td>{{ $unid->rfc }}</td>
                                      <td>{{ $unid->numero_telefono }}</td>
                                      <td>{{ $unid->correo_electronico }}</td> 

                                      <td class="text-center">
                                        <a href="{{ route('custodio.vercustodio', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-2" title="Ver custodio" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-eye"></i>
                                            </span>
                                        </a>

                                        <a href="{{ route('custodio.editarcustodio', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-2" title="Editar custodio" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-edit"></i>
                                            </span>
                                        </a>

                                        @if($unid->op_vehiculo == 1)
                                          <a href="{{ route('custodio.agregarvehiculo', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-2" title="Información vehículo" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                              <span class="svg-icon svg-icon-md">
                                                  <i class="flaticon-truck"></i>
                                              </span>
                                          </a>
                                        @else
                                          <a href="{{ route('custodio.editarvehiculo', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-2" title="Información vehículo" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                              <span class="svg-icon svg-icon-md">
                                                  <i class="flaticon-truck"></i>
                                              </span>
                                          </a>
                                        @endif

                                        @if($unid->op_arma == 1)
                                          <a href="{{ route('custodio.agregararma', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-2" title="Información arma" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                              <span class="svg-icon svg-icon-md">
                                                  <i class="flaticon-notepad"></i>
                                              </span>
                                          </a>
                                        @else
                                          <a href="{{ route('custodio.editararma', $unid->id) }}" class="btn btn-sm btn-outline-warning btn-icon mt-2" title="Información arma" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                              <span class="svg-icon svg-icon-md">
                                                  <i class="flaticon-notepad"></i>
                                              </span>
                                          </a>
                                        @endif

                                        <button class="btn btn-clean btn-sm btn-icon btn-outline-warning mt-1" onClick="deletecustodio(` {{ $unid->nombre_custodio }} `,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" data-toggle="tooltip" data-theme="dark" title="Desactivar custodio">
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
                                  <th>Nombre</th>
                                  <th>Apellido Paterno</th>
                                  <th>Apellido Materno</th>
                                  <th>CURP</th>
                                  <th>RFC</th>
                                  <th>Número Telefono</th>
                                  <th>Correo Electrónico</th>
                                  <th class="text-center">Opciones</th>
                                </tr>
                                </tfoot>

                            </table>
                            <!--end: Datatable-->

                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                            {{-- <input type="hidden" id="custodiosdatatable" value="{{ route('custodio.custodiodatatable') }}"> --}}

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
  <form method="post" id="custodio_delete_form" action="{{ route('custodio.desactivarcustodio') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_custodio_delete" value="">
  </form>

  <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

<div class="modal fade" id="modalPorcentajes" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestión de Administración: <span id="nombre_custodio_modal" class="text-primary"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="formPorcentajes">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Administrador Responsable (Dueño):</label>
                        <select class="form-control select2" name="admin_principal">
                            <option value="1">Admin Persona A</option>
                            <option value="2">Admin Persona B</option>
                        </select>
                        <span class="form-text text-muted">Es quien figura como contacto directo.</span>
                    </div>
                    
                    <hr>
                    <h6>Repartición de Porcentajes</h6>
                    <div id="contenedor_porcentajes">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">Persona A</div>
                            <div style="width: 100px;">
                                <input type="number" class="form-control" placeholder="%" value="50">
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">Persona B</div>
                            <div style="width: 100px;">
                                <input type="number" class="form-control" placeholder="%" value="50">
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-custom alert-light-danger p-2" id="error_porcentaje" style="display:none;">
                        La suma debe ser exactamente 100%.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning" style="color:black">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>









  {{-- MODAL DE VENCIMIENTOS --}}
<div class="modal fade" id="modalVencimientos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-warning mr-2"></i> Documentos Próximos a Vencer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-head-custom table-vertical-center" id="tabla_vencimientos">
                        <thead>
                            <tr>
                                <th>Custodio</th>
                                <th>Documento</th>
                                <th>Fecha Vencimiento</th>
                                <th>Días Circulación</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($data as $unid)
                                <tr>
                                    <td>{{ $unid->nombre_custodio }} {{ $unid->ap_paterno }}</td>
                                    <td>
                                        <span class="d-block"><b>Licencia:</b> {{ $unid->fecha_licencia ?? 'N/A' }}</span>
                                        <span class="d-block"><b>Póliza:</b> {{ $unid->fecha_seguro ?? 'N/A' }}</span>
                                        <span class="d-block"><b>Verificación:</b> {{ $unid->fecha_verificacion ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="label label-light-danger label-inline">Próximo</span>
                                    </td>
                                    <td>{{ $unid->dias_circulacion ?? 'Lunes-Viernes' }}</td>
                                    <td>
                                        <a href="{{ route('custodio.editarcustodio', $unid->id) }}" class="btn btn-sm btn-clean btn-icon">
                                            <i class="flaticon-edit text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


@endsection