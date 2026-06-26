@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/tarifario/CatalogoTarifario.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Listado del tarifario
@endsection
@section('content')


<div class="w-100 p-5" style="background-color: #0b0f19; color: #ffffff; font-family: 'Poppins', sans-serif; min-height: 100vh;">

    
    <div class="mb-4 select-none">
        <div class="d-flex align-items-center gap-2">
            <i class="flaticon2-file text-warning" style="font-size: 1.8rem;"></i>
            <h2 class="fw-bold text-white m-0" style="font-size: 1.8rem;">Inventario de Tarifario</h2>
        </div>
        <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona y controla las rutas, kilometrajes y tarifas del sistema.</p>
    </div>

    
    <div class="row g-3 mb-5">
        <div class="col-md-6">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid rgba(245, 158, 11, 0.3); cursor: default;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3 select-none">
                        <i class="fas fa-plus-circle text-warning mb-2" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold text-warning text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px;">NUEVO REGISTRO</h6>
                    </div>
                    @if(true)
                        <a href="{{ route('tarifario.agregartarifario') }}" class="btn w-100 fw-bold py-2" style="background-color: #f59e0b; color: #0b0f19; font-size: 0.8rem; letter-spacing: 1px; transition: none;">
                            AGREGAR TARIFA <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid rgba(100, 116, 139, 0.3); cursor: default;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3 select-none">
                        <i class="far fa-trash-alt mb-2" style="font-size: 2rem; color: #94a3b8;"></i>
                        <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #94a3b8;">TARIFARIOS INACTIVOS</h6>
                    </div>
                    <a href="{{ route('tarifario.listadotarifarioinactivo') }}" class="btn w-100 fw-bold py-2 text-white" style="background-color: #475569; font-size: 0.8rem; letter-spacing: 1px; transition: none;">
                        VER INACTIVOS <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        
        <div class="col-xl-9 col-lg-8">
            
            
            <div class="mb-2 select-none">
                <span class="fw-bold text-warning" style="font-size: 0.8rem; letter-spacing: 0.5px;">RESUMEN DE RUTAS</span>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b; cursor: default;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #1e293b;"><i class="fas fa-wallet text-warning fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7 Cantidad; letter-spacing: 0.5px;">PENDIENTES</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">12</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b; cursor: default;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #1e293b;"><i class="fas fa-user-clock text-muted fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">TARIFARIO INACTIVO</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">8</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #2d1515;"><i class="fas fa-exclamation-circle text-danger fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">TIPO DE VIAJE</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">3</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b; cursor: default;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #132b24;"><i class="fas fa-user-shield text-success fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">GRÁFICA</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">4</h3>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="p-3 rounded-3 mb-4" style="background-color: #111625; border: 1px solid #1e293b;">
                <form>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text border-0 text-muted" style="background-color: #171e30;"><i class="fas fa-search"></i></span>
                                <select class="form-select border-0 text-white datatable-input" name="nombre_cliente" data-control="select2" data-placeholder="Selecciona un cliente" style="background-color: #171e30; font-size: 0.85rem;">
                                    <option value="0">Selecciona un cliente</option>
                                    @foreach($data as $es)
                                        <option value="{{ $es->id }}">{{ $es->nombre_cliente }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-sm btn-dark border-secondary text-white px-3" id="kt_search" style="font-size: 0.75rem; font-weight: 600; transition: none;"><i class="fas fa-filter me-1"></i> BUSCAR</button>
                            <button type="button" class="btn btn-sm text-muted text-decoration-none p-0" id="kt_reset" style="font-size: 0.75rem; transition: none;"><i class="fas fa-sync-alt"></i> LIMPIAR</button>
                        </div>
                    </div>
                </form>
            </div>

            
            <div class="mb-2 d-flex justify-content-between align-items-center select-none">
                <span class="fw-bold text-warning" style="font-size: 0.8rem; letter-spacing: 0.5px;">LISTADO DE TARIFARIO</span>
                <div class="dropdown">
                    <button type="button" class="btn btn-sm text-white border-0" data-toggle="dropdown" style="background-color: #171e30; font-size: 0.8rem; transition: none;">
                        <i class="fas fa-download me-1"></i> Exportar
                    </button>
                    <div class="dropdown-menu dropdown-menu-end bg-dark border-secondary" style="transition: none;">
                        <a href="#" class="dropdown-item text-white" id="export-excel"><i class="la la-file-excel-o me-2 text-success"></i>Excel</a>
                        <a href="#" class="dropdown-item text-white" id="export-csv"><i class="la la-file-text-o me-2 text-info"></i>CSV</a>
                        <a href="#" class="dropdown-item text-white" id="export-print"><i class="la la-file-text-o me-2 text-warning"></i>Imprimir</a>
                    </div>
                </div>
            </div>

            
            <div class="p-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                <div class="table-responsive">
                    <table class="table align-middle text-white" id="kdatatable_usuarios2" style="--bs-table-bg: transparent; font-size: 0.85rem;">
                        <thead>
                            <tr class="text-muted fw-bold text-uppercase border-bottom border-secondary select-none" style="font-size: 0.75rem; border-color: #1e293b !important;">
                                <th style="color: #38bdf8 !important;">Folio</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Cliente</th>
                                <th>Tipo de Viaje</th>
                                <th>Caseta</th>
                                <th>#KMS</th>
                                <th>PPKM SIS</th>
                                <th>PPKM CUST</th>
                                <th class="text-center" style="min-width: 120px;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @foreach($tarifario as $unid)
                                <tr class="border-bottom border-dark" style="border-color: #171e30 !important;">
                                    <td class="fw-bold" style="color: #38bdf8;">{{ $unid->num_list }}</td>
                                    <td class="text-white-50">{{ $unid->origen }}</td>
                                    <td class="text-white-50">{{ $unid->destino }}</td>
                                    <td class="fw-bold text-white">{{ $unid->cliente->nombre_cliente }}</td>
                                    <td>
                                        @if($unid->tipo_viaje == 0)
                                            <span class="badge px-2 py-1 fw-semibold text-success select-none" style="background-color: #132b24; font-size: 0.75rem;">Local</span>
                                        @else
                                            <span class="badge px-2 py-1 fw-semibold text-primary select-none" style="background-color: #17243a; font-size: 0.75rem;">Foráneo</span>
                                        @endif
                                    </td>
                                    <td>{{ $unid->caseta }}</td>
                                    <td><span class="text-warning fw-bold">{{ $unid->kms }} KMS</span></td>
                                    <td class="text-success">${{ number_format($unid->ppkm_sis, 2) }}</td>
                                    <td class="text-info">${{ number_format($unid->ppkm_cust, 2) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('tarifario.vertarifa', $unid->id ) }}" class="text-decoration-none text-muted px-1 action-animate" title="Ver tarifario" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-eye text-white" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="{{ route('tarifario.editartarifario', $unid->id ) }}" class="text-decoration-none text-muted px-1 action-animate" title="Editar tarifario" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-edit text-white" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="javascript:void(0);" onClick="deletetarifario(`{{ $unid->origen }} `,`{{ $unid->id }}`)" class="text-decoration-none text-muted px-1 action-animate" title="Desactivar tarifario" data-toggle="modal" data-target="#model_delete_user" data-placement="top">
                                                <i class="far fa-trash-alt text-white" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

               
                <div class="d-flex justify-content-between align-items-center mt-4 select-none" style="font-size: 0.8rem; color: #94a3b8;">
                    <div>Mostrando registros del 1 al {{ count($tarifario) }} de un total de {{ count($tarifario) }} registros</div>
                    <div class="d-flex gap-1">
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30; cursor: default;">Anterior</button>
                        <button type="button" class="btn btn-sm text-white px-3 border-0" style="background-color: #3b82f6; cursor: default;">1</button>
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30; cursor: default;">Siguiente</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-3 col-lg-4">
            
            
            <div class="card border-0 p-4 mb-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b !important; cursor: default;">
                <span class="fw-bold text-warning d-block mb-3 select-none" style="font-size: 0.75rem; letter-spacing: 0.5px;">ESTADO DE CARTERA</span>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center select-none" style="width: 75px; height: 75px; background: conic-gradient(#10b981 70%, #f59e0b 15%, #ef4444 15%); min-width: 75px;">
                        <div class="rounded-circle" style="width: 55px; height: 55px; background-color: #111625;"></div>
                    </div>
                    <div class="select-none" style="font-size: 0.75rem; line-height: 1.5;">
                        <span class="d-block text-white">● <span class="text-success">Al corriente</span> 70%</span>
                        <span class="d-block text-white">● <span class="text-warning">En prórroga</span> 15%</span>
                        <span class="d-block text-white">● <span class="text-danger">Crítico</span> 15%</span>
                    </div>
                </div>
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


<form method="post" id="tarifario_delete_form" action="{{ route('tarifario.desactivartarifario') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_tarifario_delete" value="">
</form>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection