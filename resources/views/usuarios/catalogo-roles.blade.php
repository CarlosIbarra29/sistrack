@extends('layouts.app')

@push('scripts')
  <script src="{{ asset('js/roles/CatalogoRoles.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Inventario de roles
@endsection

@section('content')
<div class="w-100 p-5" style="background-color: #0b0f19; color: #ffffff; font-family: 'Poppins', sans-serif; min-height: 100vh;">

    <div class="mb-4">
        <h2 class="fw-bold text-white m-0" style="font-size: 1.8rem;">Inventario de Roles</h2>
        <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona el alta, control y seguimiento de tus roles de plataforma.</p>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-3">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #f59e0b;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-plus text-warning mb-2" style="font-size: 2rem;"></i>
                        <h6 class="fw-bold text-warning text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px;">ALTA DE ROLES</h6>
                    </div>
                    <a href="{{ route('rol.agregarrol') }}" class="btn w-100 fw-bold py-2" style="background-color: #f59e0b; color: #0b0f19; font-size: 0.8rem; letter-spacing: 1px;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #10b981;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-id-card mb-2" style="font-size: 2rem; color: #10b981;"></i>
                        <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #10b981;">FICHA TÉCNICA</h6>
                    </div>
                    <button type="button" class="btn w-100 fw-bold py-2" style="background-color: #10b981; color: #0b0f19; font-size: 0.8rem; letter-spacing: 1px;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #38bdf8;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3">
                        <i class="fas fa-file-signature mb-2" style="font-size: 2rem; color: #38bdf8;"></i>
                        <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #38bdf8;">SEGUIMIENTO DE CAMBIOS</h6>
                    </div>
                    <button type="button" class="btn w-100 fw-bold py-2 text-dark" style="background-color: #38bdf8; font-size: 0.8rem; letter-spacing: 1px;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 rounded-3" style="background-color: #111625; border: 1px solid #64748b;">
                <div class="card-body d-flex flex-column align-items-center justify-content-between p-4">
                    <div class="text-center mb-3">
                        <i class="far fa-trash-alt mb-2" style="font-size: 2rem; color: #94a3b8;"></i>
                        <h6 class="fw-bold text-uppercase m-0" style="font-size: 0.75rem; letter-spacing: 1px; color: #94a3b8;">ROLES INACTIVOS</h6>
                    </div>
                    <a href="{{ route('rol.rolesinactivos') }}" class="btn w-100 fw-bold py-2 text-white" style="background-color: #475569; font-size: 0.8rem; letter-spacing: 1px;">ACCEDER <i class="fas fa-chevron-right ms-1" style="font-size: 0.7rem;"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-xl-9 col-lg-8">
            
            <div class="mb-2">
                <span class="fw-bold text-warning" style="font-size: 0.8rem; letter-spacing: 0.5px;">RESUMEN DE ROLES</span>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #1e293b;"><i class="fas fa-users text-muted fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">TOTAL ROLES</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">156</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #132b24;"><i class="fas fa-check text-success fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">ACTIVOS</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">118</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                        <div class="p-3 rounded-3 me-3" style="background-color: #1e293b;"><i class="far fa-clock text-muted fs-4"></i></div>
                        <div>
                            <span class="text-muted d-block fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">INACTIVOS</span>
                            <h3 class="text-white fw-bold mb-0" style="font-size: 1.6rem;">16</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-3 rounded-3 mb-4" style="background-color: #111625; border: 1px solid #1e293b;">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text border-0 text-muted" style="background-color: #171e30;"><i class="fas fa-search"></i></span>
                            <input type="text" class="form-control border-0 text-white datatable-input" data-col-index="1" placeholder="Buscar rol..." style="background-color: #171e30; font-size: 0.85rem;">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select border-0 text-white" style="background-color: #171e30; font-size: 0.85rem;">
                            <option value="">Estatus: Todos</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select class="form-select border-0 text-white" style="background-color: #171e30; font-size: 0.85rem;">
                            <option value="">Tipo: Todos</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control border-0 text-white" placeholder="Clave" style="background-color: #171e30; font-size: 0.85rem;">
                    </div>
                    <div class="col-md-2 d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-sm btn-dark border-secondary text-white px-3" id="kt_search" style="font-size: 0.75rem; font-weight: 600;"><i class="fas fa-filter me-1"></i> FILTROS</button>
                        <button type="button" class="btn btn-sm text-muted text-decoration-none p-0" id="kt_reset" style="font-size: 0.75rem;"><i class="fas fa-sync-alt"></i> LIMPIAR</button>
                    </div>
                </div>
            </div>

            <div class="mb-2 d-flex justify-content-between align-items-center">
                <span class="fw-bold text-warning" style="font-size: 0.8rem; letter-spacing: 0.5px;">LISTADO DE ROLES</span>
                <div class="dropdown">
                    <button type="button" class="btn btn-sm text-white border-0" data-toggle="dropdown" style="background-color: #171e30; font-size: 0.8rem;">
                        <i class="fas fa-download me-1"></i> Exportar
                    </button>
                    <div class="dropdown-menu dropdown-menu-end bg-dark border-secondary">
                        <a href="#" class="dropdown-item text-white" id="export-excel">Excel</a>
                        <a href="#" class="dropdown-item text-white" id="export-csv">CSV</a>
                        <a href="#" class="dropdown-item text-white" id="export-print">Imprimir</a>
                    </div>
                </div>
            </div>

            <div class="p-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">
                <div class="d-flex align-items-center text-white mb-4" style="font-size: 0.85rem;">
                    <span>Mostrar</span>
                    <select class="form-select form-select-sm border-0 text-white mx-2 text-center" style="background-color: #171e30; width: 65px;">
                        <option value="10">10</option>
                        <option value="25">25</option>
                    </select>
                    <span>registros</span>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle text-white custom-table" id="kdatatable_roles" style="--bs-table-bg: transparent; font-size: 0.85rem;">
                        <thead>
                            <tr class="text-muted fw-bold text-uppercase border-bottom border-secondary" style="font-size: 0.75rem; border-color: #1e293b !important;">
                                <th style="width: 15%; color: #38bdf8 !important;">ID <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 45%;">NOMBRE <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 20%;">ESTATUS <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 20%;" class="text-center">ACCIONES <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            <tr class="border-bottom border-dark" style="border-color: #171e30 !important;">
                                <td class="fw-bold" style="color: #38bdf8;">ROL-0001</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2 text-dark fw-bold" style="width: 28px; height: 28px; background-color: #cbd5e1; font-size: 0.75rem;">ADM</div>
                                        <span class="fw-bold text-white">ADMINISTRADOR</span>
                                    </div>
                                </td>
                                <td><span class="badge px-3 py-1 text-success fw-bold" style="background-color: #132b24; font-size: 0.7rem; letter-spacing: 0.5px;">ACTIVO</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 text-muted">
                                        <a href="#" class="text-decoration-none text-muted transition-all" title="Ver detalle"><i class="far fa-eye"></i></a>
                                        <a href="#" class="text-decoration-none text-muted transition-all" title="Editar"><i class="far fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none text-muted transition-all" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <tr class="border-bottom border-dark" style="border-color: #171e30 !important;">
                                <td class="fw-bold" style="color: #38bdf8;">ROL-0002</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2 text-dark fw-bold" style="width: 28px; height: 28px; background-color: #94a3b8; font-size: 0.75rem;">CST</div>
                                        <span class="fw-bold text-white">CUSTODIO DE VALORES</span>
                                    </div>
                                </td>
                                <td><span class="badge px-3 py-1 fw-bold" style="background-color: #1e293b; color: #94a3b8; font-size: 0.7rem; letter-spacing: 0.5px;">INACTIVO</span></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2 text-muted">
                                        <a href="#" class="text-decoration-none text-muted transition-all" title="Ver detalle"><i class="far fa-eye"></i></a>
                                        <a href="#" class="text-decoration-none text-muted transition-all" title="Editar"><i class="far fa-edit"></i></a>
                                        <a href="#" class="text-decoration-none text-muted transition-all" title="Eliminar"><i class="far fa-trash-alt"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4" style="font-size: 0.8rem; color: #94a3b8;">
                    <div>Mostrando registros del 1 al 2 de un total de 2 registros</div>
                    <div class="d-flex gap-1">
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30;">Anterior</button>
                        <button type="button" class="btn btn-sm text-white px-3 border-0" style="background-color: #3b82f6;">1</button>
                        <button type="button" class="btn btn-sm btn-dark text-muted px-3 border-0" disabled style="background-color: #171e30;">Siguiente</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-3 col-lg-4">
            
            <div class="card border-0 p-4 mb-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b !important;">
                <span class="fw-bold text-warning d-block mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">ESTADO DOCUMENTACIÓN</span>
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 75px; height: 75px; background: conic-gradient(#10b981 75%, #f59e0b 15%, #94a3b8 6%, #3b82f6 4%); min-width: 75px;">
                        <div class="rounded-circle" style="width: 55px; height: 55px; background-color: #111625;"></div>
                    </div>
                    <div style="font-size: 0.75rem; line-height: 1.5;">
                        <span class="d-block text-white">● <span class="text-success">Completa</span> 118 (75.6%)</span>
                        <span class="d-block text-white">● <span class="text-warning">Pendiente</span> 22 (14.1%)</span>
                        <span class="d-block text-white">● <span class="text-muted">Incompleta</span> 10 (6.4%)</span>
                        <span class="d-block text-white">● <span class="text-primary">Vencida</span> 6 (3.9%)</span>
                    </div>
                </div>
                <button type="button" class="btn w-100 mt-4 py-2 text-white border border-secondary" style="background-color: transparent; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">VER REPORTE COMPLETO</button>
            </div>

            <div class="card border-0 p-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b !important;">
                <span class="fw-bold text-warning d-block mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">ALERTAS IMPORTANTES</span>
                
                <div class="d-flex align-items-start gap-2 mb-3">
                    <i class="fas fa-exclamation-triangle text-muted mt-1" style="font-size: 0.9rem;"></i>
                    <div>
                        <p class="mb-0 text-white fw-bold" style="font-size: 0.8rem;">6 documentos inactivos</p>
                        <small class="text-muted" style="font-size: 0.7 room;">Requieren revisión ordinaria</small>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-2 mb-4">
                    <i class="far fa-clock text-warning mt-1" style="font-size: 0.9rem;"></i>
                    <div>
                        <p class="mb-0 text-white fw-bold" style="font-size: 0.8rem;">22 usuarios por vencer doctos.</p>
                        <small class="text-muted" style="font-size: 0.7rem;">Próximos 30 días</small>
                    </div>
                </div>

                <button type="button" class="btn w-100 py-2 text-white border border-secondary" style="background-color: transparent; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.5px;">VER TODAS LAS ALERTAS</button>
            </div>

        </div>
    </div>
</div>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
<input type="hidden" id="rolesdatatable" value="{{ route('rol.rolesdatatable') }}">

<form method="post" id="rol_delete_form" action="{{ route('rol.desacticarrol') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_rol_des" value="">
</form>
@endsection