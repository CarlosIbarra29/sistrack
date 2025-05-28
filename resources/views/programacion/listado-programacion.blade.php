@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacion.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Listado de la programación
@endsection
@section('content')

{{--     <div class="d-flex flex-row">
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
                                <h3 class="card-label">Inventario de programación</h3>
                            </div>
                            <div class="card-toolbar">

                                <a class="btn btn-link-primary font-weight-bold mr-2 busqueda" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Busqueda
                                </a>

                                  <a href="{{ route('programacion.nuevaprogramacion') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3" >
                                  <i class="la la-plus"></i>Nuevo</a>

                                <a href="{{ route('programacion.programacioninactivas') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3">
                                    <i class="far fa-trash-alt"></i>Programación inactivas</a>

                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="svg-icon svg-icon-md">
                                      <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
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
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                          <div class="collapse" id="collapseExample">
                              <div class="card card-body">
                                <form class="mb-15">
                                  <div class="row mb-6">
                                    <div class="col-lg-6 mb-lg-0 mb-6">
                                        <label>Cliente:</label>
                                        <select class="form-control datatable-input" name="nombre_cliente" data-control="select2" data-placeholder="Estado" data-col-index="0">
                                            <option value="0">Selecciona un cliente</option>
                                            @foreach($data as $es)
                                                <option value="{{ $es->id }}" >{{ $es->nombre_cliente }}</option>
                                            @endforeach
                                        </select>
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

                            <table class="table table-hover table-checkable" id="kdatatable_programacion">
                                <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </tfoot>

                            </table>

                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                            <input type="hidden" id="programaciondatatable" value="{{ route('programacion.programaciondatatable') }}">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> --}}

  <input type='hidden' id='url_estatus' value='{{ route('programacion.updatemonitoreoajax') }}'>

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
                                <h3 class="card-label">Inventario de monitoreo</h3>
                            </div>
                            <div class="card-toolbar">

                                                                <a href="{{ route('programacion.nuevaprogramacion') }}" class="btn btn-light-primary font-weight-bolder mr-3 ml-3" >
                                  <i class="la la-plus"></i>Nuevo</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-hover table-checkable" id="kdatatable_programacion_activo">
                                <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Custodio</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th>Monitoreo</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                  @foreach($programcion as $unid)
                                    <tr>
                                      <td>{{ $unid->id }}</td>
                                      <td>{{ $unid->folio }}</td>
                                      <td>{{ $unid->nombre_cliente }}</td>
                                      <td>{{ $unid->dom_origen }}</td>
                                      <td>{{ $unid->dom_destino }}</td>
                                      <td>{{ date('d/m/Y  h:i  A' , strtotime( $unid->fecha_servicio)) }}</td>
                                      <td>{{ $unid->custodio->nombre_custodio }} {{ $unid->custodio->ap_paterno }} {{ $unid->custodio->ap_materno }}</td>
                                      <td>
                                        @if($unid->tipo_servicio == 0)
                                          Foraneo
                                        @else
                                          Local
                                        @endif
                                      </td>
                                      <td>
                                        @if($unid->programacion_estatus_id == 1)  {{-- Programado --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: gray; border: 1px solid gray !important">{{ $unid->estatus_programacion }}</span>
                                        @endif

                                        @if($unid->programacion_estatus_id == 2) {{-- Por salir --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: yellow; border: 1px solid yellow !important">{{ $unid->estatus_programacion }}</span>
                                        @endif


                                        @if($unid->programacion_estatus_id == 3) {{-- En ruta --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: green; border: 1px solid green !important">{{ $unid->estatus_programacion }}</span>
                                        @endif


                                        @if($unid->programacion_estatus_id == 4) {{-- Pernota --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: blue; border: 1px solid blue !important">{{ $unid->estatus_programacion }}</span>
                                        @endif


                                        @if($unid->programacion_estatus_id == 5) {{-- Incidencia --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: orange; border: 1px solid orange !important">{{ $unid->estatus_programacion }}</span>
                                        @endif


                                        @if($unid->programacion_estatus_id == 6) {{-- Posicionamiento en falso (Especificar en reglas a futuro) --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: green; border: 1px solid green !important">{{ $unid->estatus_programacion }}</span>
                                        @endif


                                        @if($unid->programacion_estatus_id == 7) {{-- Finalizado --}}
                                          <span class="label font-weight-bold  label-outline label-inline" style="color: red; border: 1px solid red !important">{{ $unid->estatus_programacion }}</span>
                                        @endif
                                        
                                      </td>
                                      <td>
                                        <select class="form-control" id="monitoreo_id" name="monitoreo_id" data-programacion="{{ $unid->id }}" style="width: 140px">
                                            <option value="">Selecciona una custodio</option>
                                            @foreach($estatus_monitoreo as $tp)
                                                <option value="{{ $tp->id }}" @selected($unid->op_monitoreo_id == $tp->id) >{{ $tp->op_monitoreo }} </option>
                                            @endforeach
                                        </select>

                                      </td>

                                      <td class="text-center">
                                        <a href="{{ route('programacion.verprogramacion', $unid->id) }}" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Ver programación" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-eye"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('programacion.editarprogramacion', $unid->id) }}" class="btn btn-sm btn-outline-success btn-icon mt-2" title="Editar programación" data-theme="dark" data-toggle="tooltip" data-placement="top">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-edit"></i>
                                            </span>
                                        </a>


                                        <button class="btn btn-sm btn-outline-success btn-icon mt-2" onClick="addincidenciaid({{ $unid->id }})" data-toggle="modal" data-target="#model_add_incidencia" data-toggle="tooltip" data-theme="dark" title="Observaciones">
                                                <i class="flaticon-notepad"></i>
                                        </button>


                                        <button class="btn btn-clean btn-sm btn-icon btn-outline-success mt-1" onClick="deleteprogramacion('{{$unid->id}}', '{{$unid->id }}')" data-theme="dark" data-toggle="tooltip" data-placement="top" title="Desactivar programación">
                                            <span class="svg-icon svg-icon-md">
                                                <i class="flaticon-delete"></i>
                                            </span>
                                         </button>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Custodio</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th>Monitoreo</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </tfoot>

                            </table>
                            <!--end: Datatable-->

                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

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



  <form method="post" id="programacion_delete_form" action="{{ route('programacion.deasactivarprogramacion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_programacion_delete" value="">
  </form>



  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_add_incidencia">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Observaciones</h5>
                  <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                      <span class="svg-icon svg-icon-2x"></span>
                  </div>
              </div>

              <div class="modal-body">
                <form action="{{ route('programacion.guardarobservacion') }}" method="post" id="submit_incidencia">
                @csrf
                  <div class="row form-group">
                    <div class="col-lg-12 mt-2">
                      <label>Observación</label>
                      <textarea class="form-control" name="observacion" id="observacion" ></textarea>
                      <input type="hidden" name="id" id="id_programacion">
                    </div>
                  </div>
                </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn btn-secondary font-weight-bold" data-dismiss="modal"><i class="la la-times"></i>Cancelar</button>
                <button type="button" id="send_incidencia" class="btn btn-success"><i class="la la-plus"></i>Guardar</button>
              </div>
          </div>
      </div>
  </div>

@endsection