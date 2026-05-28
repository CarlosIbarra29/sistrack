@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/roles/CatalogoRoles.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Inventario de roles
@endsection

@section('content')
<style>
    .dark-panel {
        background-color: #070b12 !important;
        color: #ffffff !important;
        font-family: 'Poppins', 'Inter', sans-serif;
    }
    .custom-card-top {
        background-color: #0b111e !important;
        border-radius: 6px;
        min-height: 160px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .btn-acc {
        border-radius: 6px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 15px !important;
        border: none !important;
    }
    .summary-box {
        background-color: #0b1322 !important;
        border: 1px solid #131c2e !important;
        border-radius: 6px;
    }
    .summary-icon-container {
        background-color: rgba(255, 255, 255, 0.03) !important;
        border-radius: 6px;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .filter-input {
        background-color: #0b1322 !important;
        border: 1px solid #1e293b !important;
        color: #ffffff !important;
        border-radius: 6px !important;
        font-size: 0.9rem;
    }
    .filter-input::placeholder {
        color: #4b5563 !important;
    }
    .filter-input:focus {
        background-color: #0b1322 !important;
        color: #fff;
        border-color: #3b82f6;
        box-shadow: none;
    }
    select.filter-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        padding-right: 2.5rem;
    }
    .btn-filter-action {
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    .custom-table th {
        color: #38bdf8 !important;
        font-weight: 600 !important;
        font-size: 0.8rem !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #1e293b !important;
        background-color: transparent !important;
    }
    .custom-table td {
        background-color: transparent !important;
        border-bottom: 1px solid #111927 !important;
        font-size: 0.85rem;
        padding-top: 14px !important;
        padding-bottom: 14px !important;
    }
    .badge-role {
        background-color: rgba(37, 99, 235, 0.15) !important;
        color: #3b82f6 !important;
        border: 1px solid rgba(37, 99, 235, 0.25);
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 4px;
    }
    .badge-status-active {
        background-color: rgba(16, 185, 129, 0.15) !important;
        color: #10b981 !important;
        border: 1px solid rgba(16, 185, 129, 0.25);
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 4px;
    }
    .right-sidebar-card {
        background-color: #0b111e !important;
        border: 1px solid #111927 !important;
        border-radius: 6px;
    }
</style>

<div class="container-fluid dark-panel p-4" style="min-height: 100vh;">
    
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="background-color: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #fff;">
            <strong>Notificación: </strong> {{ session()->get('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold text-white m-0">Inventario de Roles</h4>
            <p class="text-muted small m-0 mt-1">Gestiona el alta, control y seguimiento de tus usuarios de plataforma.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card-top p-4 border border-warning border-opacity-25">
                <div class="text-center w-100 mb-3">
                    <i class="fas fa-user-plus text-warning fs-3 mb-2"></i>
                    <div class="text-warning fw-bold text-uppercase small" style="font-size: 0.75rem; letter-spacing: 0.5px;">Alta de Custodios</div>
                </div>
                <a href="{{ route('rol.agregarrol') }}" class="btn btn-warning btn-acc w-100 text-dark">
                    <span>NUEVO ROL</span> <i class="fas fa-chevron-right fs-7 opacity-75"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card-top p-4 border border-info border-opacity-25">
                <div class="text-center w-100 mb-3">
                    <i class="fas fa-trash-alt text-info fs-3 mb-2" style="color: #00bfa5 !important;"></i>
                    <div class="fw-bold text-uppercase small" style="font-size: 0.75rem; color: #00bfa5; letter-spacing: 0.5px;">Roles Inactivos</div>
                </div>
                <a href="{{ route('rol.rolesinactivos') }}" class="btn btn-acc w-100 text-dark" style="background-color: #00bfa5 !important;">
                    <span>VER ELIMINADOS</span> <i class="fas fa-chevron-right fs-7 opacity-75"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card-top p-4 border border-primary border-opacity-25" style="border-color: rgba(126, 87, 194, 0.3) !important;">
                <div class="text-center w-100 mb-3">
                    <i class="fas fa-file-signature fs-3 mb-2" style="color: #7e57c2 !important;"></i>
                    <div class="fw-bold text-uppercase small" style="font-size: 0.75rem; color: #7e57c2; letter-spacing: 0.5px;">Seguimiento de Doctos.</div>
                </div>
                <a href="#" class="btn btn-acc w-100 text-white" style="background-color: #673ab7 !important;">
                    <span>ACCEDER</span> <i class="fas fa-chevron-right fs-7 opacity-75"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card-top p-4 border border-warning border-opacity-25">
                <div class="text-center w-100 mb-3">
                    <i class="fas fa-print text-warning fs-3 mb-2"></i>
                    <div class="text-warning fw-bold text-uppercase small" style="font-size: 0.75rem; letter-spacing: 0.5px;">Impresión de Credencial</div>
                </div>
                <a href="#" class="btn btn-warning btn-acc w-100 text-dark">
                    <span>ACCEDER</span> <i class="fas fa-chevron-right fs-7 opacity-75"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-xl-9 col-lg-8">
            
            <div class="text-warning fw-bold text-uppercase small mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">Resumen de Usuarios</div>
            <div class="row g-3 mb-4">
                <div class="col-xl-3 col-sm-6">
                    <div class="card summary-box p-3">
                        <div class="d-flex align-items-center">
                            <div class="summary-icon-container me-3"><i class="fas fa-users text-muted fs-6"></i></div>
                            <div>
                                <div class="text-muted text-uppercase d-block" style="font-size: 0.65rem; letter-spacing: 0.3px;">Total Usuarios</div>
                                <div class="fs-4 fw-bold text-white lh-1 mt-1">156</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card summary-box p-3">
                        <div class="d-flex align-items-center">
                            <div class="summary-icon-container me-3" style="background-color: rgba(16, 185, 129, 0.05) !important;"><i class="fas fa-check text-success fs-6"></i></div>
                            <div>
                                <div class="text-muted text-uppercase d-block" style="font-size: 0.65rem; letter-spacing: 0.3px;">Activos</div>
                                <div class="fs-4 fw-bold text-white lh-1 mt-1">118</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card summary-box p-3">
                        <div class="d-flex align-items-center">
                            <div class="summary-icon-container me-3" style="background-color: rgba(245, 158, 11, 0.05) !important;"><i class="fas fa-clock text-warning fs-6"></i></div>
                            <div>
                                <div class="text-muted text-uppercase d-block" style="font-size: 0.65rem; letter-spacing: 0.3px;">En Proceso</div>
                                <div class="fs-4 fw-bold text-white lh-1 mt-1">22</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card summary-box p-3">
                        <div class="d-flex align-items-center">
                            <div class="summary-icon-container me-3" style="background-color: rgba(239, 68, 68, 0.05) !important;"><i class="fas fa-user-slash text-danger fs-6"></i></div>
                            <div>
                                <div class="text-muted text-uppercase d-block" style="font-size: 0.65rem; letter-spacing: 0.3px;">Inactivos</div>
                                <div class="fs-4 fw-bold text-white lh-1 mt-1">16</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-2 mb-4 align-items-center">
                <div class="col-md-4">
                    <div class="position-relative">
                        <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-muted small"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control filter-input ps-5 datatable-input" data-col-index="1" placeholder="Buscar por nombre de rol...">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-select filter-input">
                        <option selected>Estatus: Todos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select filter-input">
                        <option selected>Rol: Todos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control filter-input" placeholder="RFC">
                </div>
                <div class="col-md-1 col-6">
                    <button type="button" id="kt_search" class="btn btn-outline-secondary text-white border-secondary btn-filter-action w-100">
                        <i class="fas fa-filter fs-7 text-muted"></i> FILTROS
                    </button>
                </div>
                <div class="col-md-1 col-6">
                    <button type="button" id="kt_reset" class="btn btn-link text-muted text-decoration-none btn-filter-action w-100">
                        <i class="fas fa-sync fs-7"></i> LIMPIAR
                    </button>
                </div>
            </div>

            <div class="text-warning fw-bold text-uppercase small mb-2" style="font-size: 0.75rem; letter-spacing: 0.5px;">Listado de Roles</div>
            
            <div class="d-flex align-items-center mb-3">
                <span class="text-muted small me-2">Mostrar</span>
                <select class="form-select filter-input p-1 px-2 text-center" style="width: auto; height: 30px; font-size: 0.8rem;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                </select>
                <span class="text-muted small ms-2">registros</span>
            </div>

            <div class="table-responsive">
                <table class="table table-dark align-middle custom-table" id="kdatatable_roles">
                    <thead>
                        <tr>
                            <th scope="col">No. <i class="fas fa-sort ms-1 opacity-25 fs-7"></i></th>
                            <th scope="col">Nombre <i class="fas fa-sort ms-1 opacity-25 fs-7"></i></th>
                            <th scope="col" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($rol)
                            @foreach($rol as $unid)
                                <tr>
                                    <td class="text-muted">{{ $unid->id }}</td>
                                    <td class="text-white fw-semibold">
                                        <span class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 28px; height: 28px;">
                                            <i class="fas fa-shield-alt text-muted" style="font-size: 0.75rem;"></i>
                                        </span>
                                        {{ $unid->name }}
                                    </td>
                                    <td class="text-center">
                                        <a class="text-info me-3 text-decoration-none edit_rol" href="{{ route('rol.modificarrol',$unid->id) }}" title="Editar Rol">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <button class="btn btn-link text-danger p-0 border-0 text-decoration-none desactivar-rol" data-id="{{ $unid->id }}" data-nombre="{{ $unid->name }}" title="Desactivar Rol">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-muted">USR-0001</td>
                                <td class="text-white fw-semibold">
                                    <span class="bg-secondary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center me-2" style="width: 28px; height: 28px;">
                                        <i class="fas fa-user text-muted" style="font-size: 0.75rem;"></i>
                                    </span>
                                    ADMIN
                                </td>
                                <td class="text-center">
                                    <span class="text-muted small">Cargando desde JavaScript...</span>
                                </td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                <span class="text-muted small">Mostrando registros del 1 al 1 de un total de 1 registros</span>
                <nav>
                    <ul class="pagination pagination-sm m-0">
                        <li class="page-item disabled"><a class="page-link bg-transparent border-secondary text-muted" href="#">Anterior</a></li>
                        <li class="page-item active"><a class="page-link bg-primary border-primary text-white" href="#">1</a></li>
                        <li class="page-item disabled"><a class="page-link bg-transparent border-secondary text-muted" href="#">Siguiente</a></li>
                    </ul>
                </nav>
            </div>

        </div>

        <div class="col-xl-3 col-lg-4">
            
            <div class="card right-sidebar-card p-3 mb-4">
                <div class="text-warning fw-bold text-uppercase small mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">Estado Documentación</div>
                
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="position-relative d-flex align-items-center justify-content-center" style="width: 85px; height: 85px; border-radius: 50%; background: conic-gradient(#10b981 0% 75.6%, #f59e0b 75.6% 89.7%, #ef4444 89.7% 96.1%, #3b82f6 96.1% 100%);">
                        <div class="position-absolute rounded-circle" style="width: 61px; height: 61px; inset: 12px; background-color: #0b111e;"></div>
                    </div>
                    
                    <div style="font-size: 0.75rem; line-height: 1.5;">
                        <div><span class="text-success fw-bold">• Completa</span> <span class="text-muted">118 (75.6%)</span></div>
                        <div><span class="text-warning fw-bold">• Pendiente</span> <span class="text-muted">22 (14.1%)</span></div>
                        <div><span class="text-danger fw-bold">• Incompleta</span> <span class="text-muted">10 (6.4%)</span></div>
                        <div><span class="text-primary fw-bold">• Vencida</span> <span class="text-muted">6 (3.9%)</span></div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-secondary w-100 text-white border-secondary btn-sm py-2 fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    VER REPORTE COMPLETO
                </button>
            </div>

            <div class="card right-sidebar-card p-3">
                <div class="text-warning fw-bold text-uppercase small mb-3" style="font-size: 0.75rem; letter-spacing: 0.5px;">Alertas Importantes</div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="text-danger me-2 mt-1" style="font-size: 1.1rem;"><i class="fas fa-exclamation-triangle"></i></div>
                    <div>
                        <span class="fw-semibold d-block text-white" style="font-size: 0.8rem;">6 documentos vencidos</span>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Requieren atención inmediata</small>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="text-warning me-2 mt-1" style="font-size: 1.1rem;"><i class="fas fa-clock"></i></div>
                    <div>
                        <span class="fw-semibold d-block text-white" style="font-size: 0.8rem;">22 usuarios por vencer doctos.</span>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Próximos 30 días</small>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-secondary w-100 text-white border-secondary btn-sm py-2 fw-semibold" style="font-size: 0.75rem; letter-spacing: 0.5px;">
                    VER TODAS LAS ALERTAS
                </button>
            </div>

        </div>
    </div>

    <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
    <input type="hidden" id="rolesdatatable" value="{{ route('rol.rolesdatatable') }}">

    <form method="post" id="rol_delete_form" action="{{ route('rol.desacticarrol') }}" enctype="multipart/form-data" class="d-none">
        @csrf
        <input type="hidden" name="id" id="id_rol_des" value="">
    </form>
</div>
@endsection