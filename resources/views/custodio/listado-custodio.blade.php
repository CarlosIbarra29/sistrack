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

@section('content')
<div class="bg-dashboard-dark">

    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="font-weight-bolder text-white m-0" style="font-size: 24px; letter-spacing: -0.5px;">Inventario de Custodios</h1>
            <p class="text-muted font-size-sm m-0">Gestiona el alta, control y seguimiento de tus custodios en plataforma.</p>
        </div>
        <div>
            <a href="{{ route('custodio.listadocustodioinactivo') }}" class="btn btn-sm font-weight-bold text-white btn-outline-secondary" style="border-color: var(--border-color); height: 38px; display: flex; align-items: center; gap: 6px;">
                <i class="la la-trash-alt"></i> Clientes inactivos
            </a>
        </div>
    </div>

    <div class="row mb-10">
        @php
            $buttons = [
                ['t' => 'ALTA DE CUSTODIOS', 'i' => 'fas fa-user-plus', 'c' => '#f6a924', 'bg' => 'rgba(246, 169, 36, 0.05)', 'r' => route('custodio.agregarcustodio')],
                ['t' => 'FICHA TÉCNICA', 'i' => 'fas fa-id-card', 'c' => '#00c2a8', 'bg' => 'rgba(0, 194, 168, 0.05)', 'r' => '#'],
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

    <div class="row">
        <div class="col-xl-9 col-lg-8 pr-md-2">
            
            <div class="text-warning font-weight-bolder font-size-xs mb-3 text-uppercase tracking-wide">Resumen de Custodios</div>

            <div class="row mb-4 g-3">
                <div class="col-md-4">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(59, 130, 246, 0.12); color: #3b82f6;"><i class="la la-users"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">Total Custodios</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">156</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(16, 185, 129, 0.12); color: #10b981;"><i class="la la-check-circle"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">Activos</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">118</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(239, 68, 68, 0.12); color: #ef4444;"><i class="la la-user-times"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">Inactivos</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">16</span>
                        </div>
                    </div>
                </div>
            </div>

            <form class="horizontal-filter-bar mb-4">
                <div style="flex: 1; min-width: 160px; position: relative;">
                    <input type="text" class="form-control input-premium-dark datatable-input pl-8" placeholder="Buscar custodio..." />
                    <i class="la la-search text-muted position-absolute" style="left: 10px; top: 12px; font-size: 13px;"></i>
                </div>
                <div style="width: 150px;">
                    <select class="form-control input-premium-dark datatable-input py-0">
                        <option>Estatus: Todos</option>
                    </select>
                </div>
                <div style="width: 150px;">
                    <select class="form-control input-premium-dark datatable-input py-0">
                        <option>Puesto: Todos</option>
                    </select>
                </div>
                <div style="width: 150px;">
                    <select class="form-control input-premium-dark datatable-input py-0">
                        <option>Sucursal: Todos</option>
                    </select>
                </div>
                
                <button type="button" class="btn btn-sm btn-outline-secondary text-white font-weight-bold px-4" style="height:38px; border-color: var(--border-color);"><i class="la la-filter"></i> FILTROS</button>
                <button type="button" class="btn btn-sm btn-outline-secondary text-muted font-weight-bold px-4" style="height:38px; border-color: var(--border-color);"><i class="la la-sync"></i> LIMPIAR</button>
            </form>

            <div class="text-warning font-weight-bolder font-size-xs mb-3 text-uppercase tracking-wide">Listado de Custodios</div>
            <div class="card card-premium mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-improved-dark">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Puesto</th>
                                    <th>Sucursal</th>
                                    <th>Estatus</th>
                                    <th>Documentación</th>
                                    <th class="text-right" style="width: 100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($data as $unid)
                                <tr>
                                    <td class="text-muted font-weight-bold">CUST-{{ str_pad($unid->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-25 symbol-circle mr-2" style="background-color: var(--bg-input); width:26px; height:26px; display:flex; align-items:center; justify-content:center; border: 1px solid var(--border-color); overflow:hidden;">
                                                <img src="{{ asset('media/users/default.jpg') }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                                            </div>
                                            <span class="font-weight-bold text-white">{{ $unid->nombre_custodio }} {{ $unid->ap_paterno }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $unid->puesto ?? 'Escolta' }}</td>
                                    <td class="text-muted">{{ $unid->sucursal ?? 'N/A' }}</td>
                                    <td><span class="status-chip chip-active">ACTIVO</span></td>
                                    <td><span class="status-chip chip-info">COMPLETA</span></td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-end align-items-center gap-1">
                                            <a href="{{ route('custodio.vercustodio', $unid->id) }}" class="btn btn-xs btn-icon btn-clean text-muted p-0" title="Ver Perfil"><i class="la la-eye font-size-lg"></i></a>
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

        <div class="col-xl-3 col-lg-4 pl-md-2">
            <div class="card card-premium p-4 mb-4">
                <span class="text-warning font-weight-bolder font-size-xs d-block mb-3 text-uppercase">Estado Documentación</span>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="donut-chart-segment"></div>
                    <div class="font-size-xs" style="line-height: 1.8;">
                        <div style="color: #10b981; font-weight: 600;">● Completa <span class="text-white-50 font-weight-normal">118 (75.6%)</span></div>
                        <div style="color: #f59e0b; font-weight: 600;">● Pendiente <span class="text-white-50 font-weight-normal">22 (14.1%)</span></div>
                        <div style="color: #ef4444; font-weight: 600;">● Incompleta <span class="text-white-50 font-weight-normal">10 (6.4%)</span></div>
                        <div style="color: #3b82f6; font-weight: 600;">● Vencida <span class="text-white-50 font-weight-normal">6 (3.9%)</span></div>
                    </div>
                </div>
                <button class="btn btn-xs btn-block btn-outline-secondary font-weight-bold text-white mt-4 py-2" style="border-color: var(--border-color); font-size: 11px;">VER REPORTE COMPLETO</button>
            </div>

            <div class="card card-premium p-4 mb-4">
                <span class="text-warning font-weight-bolder font-size-xs d-block mb-3 text-uppercase">Alertas Importantes</span>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-2">
                        <i class="la la-exclamation-triangle text-danger font-size-h3 mt-1"></i>
                        <div>
                            <span class="text-white font-weight-bold font-size-xs d-block">6 documentos vencidos</span>
                            <span class="text-muted font-size-xs">Requieren atención inmediata</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-start gap-2 mt-2">
                        <i class="la la-clock text-warning font-size-h3 mt-1"></i>
                        <div>
                            <span class="text-white font-weight-bold font-size-xs d-block">22 usuarios por vencer doctos.</span>
                            <span class="text-muted font-size-xs">Próximos 30 días</span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-xs btn-block btn-outline-secondary font-weight-bold text-white mt-4 py-2" style="border-color: var(--border-color); font-size: 11px;">VER TODAS LAS ALERTAS</button>
            </div>
        </div>
    </div>
</div>
@endsection