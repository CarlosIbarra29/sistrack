@extends('layouts.app')

@push('scripts')
  <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
  Inventario de clientes
@endsection

@section('content')
<div class="w-100 p-5" style="background-color: #0b0f19; color: #ffffff; font-family: 'Poppins', sans-serif; min-height: 100vh;">

    {{-- HEADER DE LA SECCIÓN --}}
    <div class="mb-4 select-none">
        <h2 class="fw-bold text-white m-0" style="font-size: 1.8rem;">Inventario de Clientes</h2>
        <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona el alta, control y seguimiento de las cuentas y clientes de la plataforma.</p>
    </div>

    {{-- ACCESOS RÁPIDOS PRINCIPALES (SIN HOVER INTERACTIVO) --}}
    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #f59e0b; cursor: default;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3 select-none">
                        <i class="fas fa-user-plus text-warning mb-2" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold text-warning text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px;">NUEVO CLIENTE</h6>
                    </div>
                    @if(true)
                        <a href="{{ route('cliente.agregarcliente') }}" class="btn w-100 fw-bold py-2" style="background-color: #f59e0b; color: #0b0f19; font-size: 0.8rem; letter-spacing: 1px; transition: none;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #64748b; cursor: default;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3 select-none">
                        <i class="far fa-trash-alt mb-2" style="font-size: 2rem; color: #94a3b8;"></i>
                        <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #94a3b8;">CLIENTES INACTIVOS</h6>
                    </div>
                    <a href="{{ route('cliente.listadoclienteinactivo') }}" class="btn w-100 fw-bold py-2 text-white" style="background-color: #475569; font-size: 0.8rem; letter-spacing: 1px; transition: none;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #38bdf8; cursor: default;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3 select-none">
                        <i class="fas fa-file-invoice-dollar mb-2" style="font-size: 2rem; color: #38bdf8;"></i>
                        <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #38bdf8;">REPORTES COMERCIALES</h6>
                    </div>
                    <button type="button" class="btn w-100 fw-bold py-2 text-dark" style="background-color: #38bdf8; font-size: 0.8rem; letter-spacing: 1px; transition: none;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- DISEÑO DE DOS COLUMNAS: PRINCIPAL Y SIDEBAR --}}
    <div class="row g-4">
        
        {{-- COLUMNA IZQUIERDA: RESUMEN, FILTROS Y DATATABLE --}}
        <div class="col-xl-9 col-lg-8">
            
            {{-- TARJETAS DE INDICADORES (RESUMEN) --}}
            <div class="mb-2 select-none">
                <span class="fw-bold text-warning" style="font-size: 0.8rem; letter-spacing: 0.5px;">RESUMEN DE CUENTAS</span>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b; cursor: default;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #1e293b;"><i class="fas fa-wallet text-warning fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">PENDIENTES</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">12</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b; cursor: default;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #1e293b;"><i class="fas fa-user-clock text-muted fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">INACTIVOS</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">8</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #2d1515;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #2d1515;"><i class="fas fa-exclamation-circle text-danger fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">TAREAS VENCIDAS</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">3</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b; cursor: default;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #132b24;"><i class="fas fa-user-shield text-success fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold select-none" style="font-size: 0.7rem; letter-spacing: 0.5px;">EN RIESGO</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">4</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FORMULARIO DE BÚSQUEDA / FILTROS --}}
            <div class="p-3 rounded-3 mb-4" style="background-color: #111625; border: 1px solid #1e293b;">
                <form>
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text border-0 text-muted" style="background-color: #171e30;"><i class="fas fa-search"></i></span>
                                <input type="text" class="form-control border-0 text-white datatable-input" data-col-index="1" placeholder="Buscar por nombre de cliente..." style="background-color: #171e30; font-size: 0.85rem;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select border-0 text-white" style="background-color: #171e30; font-size: 0.85rem;">
                                <option value="">Grupo: Todos</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2 justify-content-end">
                            <button type="button" class="btn btn-sm btn-dark border-secondary text-white px-3" id="kt_search" style="font-size: 0.75rem; font-weight: 600; transition: none;"><i class="fas fa-filter me-1"></i> BUSCAR</button>
                            <button type="button" class="btn btn-sm text-muted text-decoration-none p-0" id="kt_reset" style="font-size: 0.75rem; transition: none;"><i class="fas fa-sync-alt"></i> LIMPIAR</button>
                        </div>
                    </div>
                </form>
            </div>

            {{-- SUBHEADER DE LA TABLA Y EXPORTACIONES --}}
            <div class="mb-2 d-flex justify-content-between align-items-center select-none">
                <span class="fw-bold text-warning" style="font-size: 0.8rem; letter-spacing: 0.5px;">LISTADO DE CLIENTES</span>
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

            {{-- CONTENEDOR DE LA TABLA PRINCIPAL (SIN HOVER EN FILAS) --}}
            <div class="p-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                <div class="d-flex align-items-center text-white mb-4 select-none" style="font-size: 0.85rem;">
                    <span>Mostrar</span>
                    <select class="form-select form-select-sm border-0 text-white mx-2 text-center" style="background-color: #171e30; width: 65px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span>registros</span>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle text-white" id="kdatatable_usuarios2" style="--bs-table-bg: transparent; font-size: 0.85rem;">
                        <thead>
                            <tr class="text-muted fw-bold text-uppercase border-bottom border-secondary select-none" style="font-size: 0.75rem; border-color: #1e293b !important;">
                                <th style="width: 15%; color: #38bdf8 !important;">Folio <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 30%;">Razón Social <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 30%;">Nombre Cliente <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">Grupo <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 12%;" class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @php $num = 1; @endphp
                            @foreach($data as $unid)
                                <tr class="border-bottom border-dark" style="border-color: #171e30 !important;">
                                    <td class="fw-bold" style="color: #38bdf8;">{{ $unid->num_list }}</td>
                                    <td class="text-white-50">{{ $unid->razon_social }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center me-2 text-dark fw-bold select-none" style="width: 28px; height: 28px; background-color: #cbd5e1; font-size: 0.75rem;">
                                                {{ strtoupper(substr($unid->nombre_cliente, 0, 2)) }}
                                            </div>
                                            <span class="fw-bold text-white">{{ $unid->nombre_cliente }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge px-2 py-1 fw-semibold select-none" style="background-color: #171e30; color: #38bdf8; font-size: 0.75rem;">
                                            {{ $unid->grupo }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('cliente.vercliente', $unid->id) }}" class="text-decoration-none text-muted px-1" title="Ver cliente" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-eye text-white" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="{{ route('cliente.editarcliente', $unid->id) }}" class="text-decoration-none text-muted px-1" title="Editar cliente" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-edit text-white" style="font-size: 1rem;"></i>
                                            </a>
                                            <a href="javascript:void(0);" onClick="deletecliente(`{{ $unid->id }} `,`{{ $unid->id }}`)" class="text-decoration-none text-muted px-1" title="Desactivar cliente" data-toggle="modal" data-target="#model_delete_user" data-placement="top">
                                                <i class="far fa-trash-alt text-white" style="font-size: 1rem;"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @php $num ++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINACIÓN / PIE DE TABLA (ESTÁTICA) --}}
                <div class="d-flex justify-content-between align-items-center mt-4 select-none" style="font-size: 0.8rem; color: #94a3b8;">
                    <div>Mostrando registros del 1 al {{ count($data) }} de un total de {{ count($data) }} registros</div>
                    <div class="d-flex gap-1">
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30; cursor: default;">Anterior</button>
                        <button type="button" class="btn btn-sm text-white px-3 border-0" style="background-color: #3b82f6; cursor: default;">1</button>
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30; cursor: default;">Siguiente</button>
                    </div>
                </div>
            </div>

        </div>

        {{-- COLUMNA DERECHA: SIDEBAR DE ALERTAS Y GRÁFICOS INFORMATIVOS (ESTÁTICO) --}}
        <div class="col-xl-3 col-lg-4">
            
            {{-- SECCIÓN CONIC GRAPH DE DISTRIBUCIÓN --}}
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

        </div>
    </div>
</div>

{{-- M O D A L S & FORMS --}}
<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection