@extends('layouts.app')

@push('scripts')
  <script src="{{ asset('js/custodios/CatalogoCustodio.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          
          var options = {
              series: [75.6, 14.1, 6.4],
              chart: { type: 'donut', height: 130 },
              colors: ['#1BC5BD', '#FFA800', '#F64E60'],
              dataLabels: { enabled: false },
              legend: { show: false },
              stroke: { show: false, width: 0 },
              plotOptions: { pie: { donut: { size: '70%' } } }
          };
          var chart = new ApexCharts(document.querySelector("#chart_lateral"), options);
          chart.render();
      });
  </script>
@endpush




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

@section('content')
<div class="container-fluid pt-5" style="background-color: #1e1e2d; min-height: 100vh; color: white;">
    <div class="row">
        
        <div class="col-xl-9">
            
            
            <div class="card card-custom mb-6 shadow-none" style="background-color: #151521; border-radius: 10px;">
                <div class="card-header border-0 pt-5" style="border-bottom: 1px solid #f6a924 !important;">
                    <div class="card-title">
                        <span class="card-icon"><i class="flaticon2-file text-warning"></i></span>
                        <h3 class="card-label text-white uppercase font-weight-bolder">INVENTARIO DE CUSTODIOS</h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('custodio.listadocustodioinactivo') }}" class="btn btn-white font-weight-bold btn-sm" style="color: #000; background-color: #fff8e1;">
                            <i class="far fa-trash-alt mr-1"></i> Clientes inactivos
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    
                    <div class="row mb-10">
                        @php
                            $buttons = [
                                ['t' => 'ALTA DE CUSTODIOS', 'i' => 'fas fa-user-plus', 'c' => '#f6a924', 'bg' => 'rgba(246, 169, 36, 0.05)', 'r' => route('custodio.agregarcustodio')],
                                ['t' => 'CONTROL DE CONFIANZA MIDOT', 'i' => 'fas fa-shield-alt', 'c' => '#3699ff', 'bg' => 'rgba(54, 153, 255, 0.05)', 'r' => '#'],
                                ['t' => 'FICHA TÉCNICA', 'i' => 'fas fa-id-card', 'c' => '#1bc5bd', 'bg' => 'rgba(27, 197, 189, 0.05)', 'r' => '#'],
                                ['t' => 'SEGUIMIENTO DE DOCTOS.', 'i' => 'fas fa-file-signature', 'c' => '#8950fc', 'bg' => 'rgba(137, 80, 252, 0.05)', 'r' => '#'],
                                ['t' => 'IMPRESIÓN DE CREDENCIAL', 'i' => 'fas fa-print', 'c' => '#ffa800', 'bg' => 'rgba(255, 168, 0, 0.05)', 'r' => '#']
                            ];
                        @endphp
                        @foreach($buttons as $btn)
                        <div class="col px-2">
                            <div class="text-center p-4 h-100 d-flex flex-column justify-content-between" style="border: 1px solid {{ $btn['c'] }}; background: {{ $btn['bg'] }}; border-radius: 4px;">
                                <div>
                                    <i class="{{ $btn['i'] }} mb-3" style="color: {{ $btn['c'] }}; font-size: 2.2rem;"></i>
                                    <div class="font-weight-bolder mb-3" style="color: {{ $btn['c'] }}; font-size: 0.75rem;">{{ $btn['t'] }}</div>
                                </div>
                                <a href="{{ $btn['r'] }}" class="btn btn-sm btn-block p-2 font-weight-bolder d-flex justify-content-between align-items-center" style="background: {{ $btn['c'] }}; color: #000; font-size: 0.75rem;">
                                    ACCEDER <i class="fas fa-chevron-right ml-2" style="font-size: 0.6rem;"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    
                    <h6 class="text-warning font-weight-bolder mb-5">RESUMEN DE CUSTODIOS</h6>
                    <div class="row mb-8">
                        <div class="col-md-3">
                            <div class="p-5 d-flex align-items-center" style="background: #1b1b28; border: 1px solid #2b2b40; border-radius: 8px;">
                                <div class="symbol symbol-45 symbol-light-primary mr-4">
                                    <span class="symbol-label"><i class="fas fa-users"></i></span>
                                </div>
                                <div>
                                    <div class="text-white font-weight-bolder font-size-h4">156</div>
                                    <div class="text-muted font-size-sm">TOTAL CUSTODIOS</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-5 d-flex align-items-center" style="background: #1b1b28; border: 1px solid #2b2b40; border-radius: 8px;">
                                <div class="symbol symbol-45 symbol-light-success mr-4">
                                    <span class="symbol-label"><i class="far fa-check-circle"></i></span>
                                </div>
                                <div>
                                    <div class="text-white font-weight-bolder font-size-h4">118</div>
                                    <div class="text-muted font-size-sm">ACTIVOS</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-5 d-flex align-items-center" style="background: #1b1b28; border: 1px solid #2b2b40; border-radius: 8px;">
                                <div class="symbol symbol-45 symbol-light-warning mr-4">
                                    <span class="symbol-label"><i class="fas fa-hourglass-half"></i></span>
                                </div>
                                <div>
                                    <div class="text-white font-weight-bolder font-size-h4">22</div>
                                    <div class="text-muted font-size-sm">EN PROCESO MIDOT</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-5 d-flex align-items-center" style="background: #1b1b28; border: 1px solid #2b2b40; border-radius: 8px;">
                                <div class="symbol symbol-45 symbol-light-danger mr-4">
                                    <span class="symbol-label"><i class="fas fa-user-times"></i></span>
                                </div>
                                <div>
                                    <div class="text-white font-weight-bolder font-size-h4">16</div>
                                    <div class="text-muted font-size-sm">INACTIVOS</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="d-flex align-items-center mb-8 p-4" style="background: #1b1b28; border-radius: 8px;">
                        <div class="flex-grow-1 position-relative mr-4">
                            <input type="text" class="form-control border-0" style="background: #252537; color: white;" placeholder="Buscar custodio...">
                            <i class="fas fa-search position-absolute" style="right: 15px; top: 12px; color: #565674;"></i>
                        </div>
                        <select class="form-control mr-2 border-0" style="background: #252537; color: white; width: 150px;"><option>Estatus: Todos</option></select>
                        <select class="form-control mr-2 border-0" style="background: #252537; color: white; width: 150px;"><option>Puesto: Todos</option></select>
                        <select class="form-control mr-4 border-0" style="background: #252537; color: white; width: 150px;"><option>Sucursal: Todos</option></select>
                        <button class="btn btn-outline-secondary btn-sm mr-2"><i class="fas fa-filter"></i> FILTROS</button>
                        <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-sync-alt"></i> LIMPIAR</button>
                    </div>

                    <h6 class="text-warning font-weight-bolder mb-5">LISTADO DE CUSTODIOS</h6>

                    <!-- TABLA PRINCIPAL -->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-vertical-center" style="background-color: #1b1b28;">
                            <thead>
                                <tr class="text-uppercase" style="color: #565674; border-bottom: 1px solid #2b2b40;">
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>PUESTO</th>
                                    <th>SUCURSAL</th>
                                    <th>ESTATUS</th>
                                    <th>MIDOT</th>
                                    <th>DOCUMENTACIÓN</th>
                                    <th>VENC. DOC.</th>
                                    <th class="text-right">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody class="text-white-50 font-weight-bold">
                                @foreach($data as $unid)
                                <tr style="border-bottom: 1px solid #2b2b40;">
                                    <td class="text-primary">CUST-{{ str_pad($unid->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-30 symbol-circle mr-3">
                                                <img src="{{ asset('media/users/default.jpg') }}" alt="">
                                            </div>
                                            <span class="text-white">{{ $unid->nombre_custodio }} {{ $unid->ap_paterno }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $unid->puesto ?? 'Escolta' }}</td>
                                    <td>{{ $unid->sucursal ?? 'N/A' }}</td>
                                    <td><span class="label label-inline label-light-success font-weight-bold">ACTIVO</span></td>
                                    <td><span class="label label-inline label-light-primary font-weight-bold">APROBADO</span></td>
                                    <td><span class="label label-inline label-light-success font-weight-bold">COMPLETA</span></td>
                                    <td class="text-success">{{ $unid->fecha_licencia ?? '15/08/2026' }}</td>
                                    <td class="text-right">
                                        <!-- BOTONES RÁPIDOS -->
                                        <a href="{{ route('custodio.vercustodio', $unid->id) }}" class="btn btn-sm btn-icon btn-text-warning mr-1" title="Ver Perfil" data-toggle="tooltip">
                                            <i class="far fa-eye text-muted"></i>
                                        </a>

                                       
                                        <div class="dropdown dropdown-inline">
                                            <button type="button" class="btn btn-clean btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v text-muted"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0" style="background-color: #1b1b28; border: 1px solid #2b2b40; border-radius: 8px;">
                                                <ul class="navi navi-hover py-4">
                                                    
                                                      <li class="navi-item">
                                                        <a href="{{ route('custodio.editarcustodio', $unid->id) }}" class="navi-link py-3">
                                                            <span class="navi-icon"><i class="fas fa-pencil-alt text-warning"></i></span>
                                                            <span class="navi-text text-white font-weight-bold">Editar Datos</span>
                                                        </a>
                                                    </li>

                                                    
                                                    {{--<li class="navi-item">
                                                        @if($unid->op_vehiculo == 1)
                                                            <a href="{{ route('custodio.agregarvehiculo', $unid->id) }}" class="navi-link py-3">
                                                                <span class="navi-icon"><i class="flaticon-truck text-warning"></i></span>
                                                                <span class="navi-text text-white font-weight-bold">Asignar Vehículo</span>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('custodio.editarvehiculo', $unid->id) }}" class="navi-link py-3">
                                                                <span class="navi-icon"><i class="flaticon-truck text-warning"></i></span>
                                                                <span class="navi-text text-white font-weight-bold">Editar Vehículo</span>
                                                            </a>
                                                        @endif
                                                    </li>

                                                    <!-- Opción Arma -->
                                                    <li class="navi-item">
                                                        @if($unid->op_arma == 1)
                                                            <a href="{{ route('custodio.agregararma', $unid->id) }}" class="navi-link py-3">
                                                                <span class="navi-icon"><i class="flaticon-notepad text-warning"></i></span>
                                                                <span class="navi-text text-white font-weight-bold">Asignar Arma</span>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('custodio.editararma', $unid->id) }}" class="navi-link py-3">
                                                                <span class="navi-icon"><i class="flaticon-notepad text-warning"></i></span>
                                                                <span class="navi-text text-white font-weight-bold">Editar Arma</span>
                                                            </a>
                                                        @endif
                                                    </li>--}}

                                                    <div class="dropdown-divider" style="border-top: 1px solid #2b2b40; opacity: 0.6;"></div>
                                                    
                                                    
                                                    <li class="navi-item">
                                                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('id_custodio_delete').value={{$unid->id}}; $('#custodio_delete_form').submit();" class="navi-link py-3">
                                                            <span class="navi-icon"><i class="fas fa-user-times text-danger"></i></span>
                                                            <span class="navi-text text-danger font-weight-bold">Desactivar</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-xl-3">
            <div class="card card-custom gutter-b shadow-none" style="background-color: #151521; border-radius: 10px;">
                <div class="card-body">
                    <h6 class="text-warning font-weight-bolder mb-7">ESTADO DOCUMENTACIÓN</h6>
                    <div class="d-flex align-items-center">
                        <div id="chart_lateral"></div>
                        <div class="ml-4">
                            <div class="text-white font-size-sm mb-2"><i class="fa fa-circle text-success mr-2"></i> 75.6% Completa</div>
                            <div class="text-white font-size-sm mb-2"><i class="fa fa-circle text-warning mr-2"></i> 14.1% Pendiente</div>
                            <div class="text-white font-size-sm"><i class="fa fa-circle text-danger mr-2"></i> 6.4% Incompleta</div>
                        </div>
                    </div>
                    <button class="btn btn-outline-warning btn-sm btn-block mt-8 font-weight-bolder">REPORTE COMPLETO</button>
                </div>
            </div>

            <div class="card card-custom gutter-b shadow-none" style="background-color: #151521; border-radius: 10px;">
                <div class="card-body">
                    <h6 class="text-warning font-weight-bolder mb-7">ALERTAS</h6>
                    <div class="d-flex align-items-center mb-8">
                        <div class="symbol symbol-40 symbol-light-danger mr-4 p-1" style="background: rgba(246, 78, 96, 0.1); border-radius: 50%;">
                            <span class="symbol-label" style="background: transparent;"><i class="flaticon-warning-sign text-danger"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-white font-weight-bolder">6 Vencidos</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-40 symbol-light-warning mr-4 p-1" style="background: rgba(255, 168, 0, 0.1); border-radius: 50%;">
                            <span class="symbol-label" style="background: transparent;"><i class="flaticon-event-calendar-symbol text-warning"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-white font-weight-bolder">22 Por Vencer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<form method="post" id="custodio_delete_form" action="{{ route('custodio.desactivarcustodio') }}">
    @csrf
    <input type="hidden" name="id" id="id_custodio_delete" value="">
</form>
@endsection