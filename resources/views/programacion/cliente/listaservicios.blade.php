@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/cliente/CatalogoClientes.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Listado de Servicios
@endsection
@section('content')


<div class="w-100 p-5" style="background-color: #0b0f19; color: #ffffff; font-family: 'Poppins', sans-serif; min-height: 100vh;">

    
    <div class="mb-4 select-none">
        <h2 class="fw-bold text-white m-0" style="font-size: 1.8rem;">Listado de Servicios</h2>
        {{-- <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona el alta, control y seguimiento de las cuentas y clientes de la plataforma.</p> --}}
    </div>

    
    <div class="row g-3 mb-5 col-md-12 ">
        <div class="col-md-4">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #f59e0b; cursor: default;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3 select-none">
                        <i class="fas fa-user-plus text-warning mb-2" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold text-warning text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px;">NUEVO SERVICIO</h6>
                    </div>
                    @if(true)
                        <a href="{{ route('procli.nuevoservicio') }}" class="btn w-100 fw-bold py-2" style="background-color: #f59e0b; color: #0b0f19; font-size: 0.8rem; letter-spacing: 1px; transition: none;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></a>
                    @endif
                </div>
            </div>
        </div>


    </div>

    
    <div class="row g-4">
        
        
        <div class="col-xl-12 col-lg-12">
            
           
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
                                <th style="width: 15%; color: #38bdf8 !important;">Id <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 30%;">UBICACIÓN / DIRECCIÓN ORIGEN <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 30%;">UBICACIÓN / DIRECCIÓN DESTINO <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">FECHA Y HORA DEL SERVICIO <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">ARMADA <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">LÍNEA DE TRANSPORTE <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">NOMBRE DEL OPERADOR <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">Estatus <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 12%;" class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            @php $num = 1; @endphp
                            @foreach($data as $unid)
                                <tr class="border-bottom border-dark" style="border-color: #171e30 !important;">
                                    <td class="fw-bold" style="color: #38bdf8;">{{ $unid->id }}</td>
                                    <td class="text-white-50">{{ $unid->ubicacion_origen  }} / {{ $unid->direccion_origen  }}</td>
                                    <td class="text-white-50">{{ $unid->ubicacion_destino  }} / {{ $unid->direccion_destino  }} </td>
                                    <td>
                                        <span class="badge px-2 py-1 fw-semibold select-none" style="background-color: #171e30; color: #38bdf8; font-size: 0.75rem;">
                                            {{ $unid->fechahora_servicio }}
                                        </span>
                                    </td>
                                    <td class="text-white-50">
                                        @if($unid->armada == 0) No @else Si @endif
                                    </td>

                                    <td class="text-white-50">{{ $unid->linea_transporte  }}  </td>
                                    <td class="text-white-50">{{ $unid->nombre_operador  }}  </td>
                                    <td class="text-white-50">
                                        @if($unid->estatus == 0) 
                                            <span class="label font-weight-bold label-outline-warning label-inline" > Pendiente</span>
                                        @else 
                                            Si 
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('procli.verservicio', $unid->id) }}" class="text-decoration-none text-muted px-1" title="Ver servicio" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-eye text-white" style="font-size: 1rem;"></i>
                                            </a>
                                            @if($role != 17)
                                                <a href="{{ route('procli.complementarservicio', $unid->id) }}" class="text-decoration-none text-muted px-1" title="Complementar servicio" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                    <i class="far fa-edit text-white" style="font-size: 1rem;"></i>
                                                </a>
                                            @endif


                                        </div>
                                    </td>
                                </tr>
                                @php $num ++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
                <div class="d-flex justify-content-between align-items-center mt-4 select-none" style="font-size: 0.8rem; color: #94a3b8;">
                    {{-- <div>Mostrando registros del 1 al {{ count($data) }} de un total de {{ count($data) }} registros</div> --}}
                    <div class="d-flex gap-1">
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30; cursor: default;">Anterior</button>
                        <button type="button" class="btn btn-sm text-white px-3 border-0" style="background-color: #3b82f6; cursor: default;">1</button>
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30; cursor: default;">Siguiente</button>
                    </div>
                </div>
            </div>

        </div>

        
    </div>
</div>


<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

@endsection