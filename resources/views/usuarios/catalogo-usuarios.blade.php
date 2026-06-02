@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/usuarios/CatalogoUsuarios.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Inventario de clientes
@endsection

@section('content')


<div class="bg-dashboard-dark">

    <div class="mb-5">
        <h1 class="font-weight-bolder text-white m-0" style="font-size: 24px; letter-spacing: -0.5px;">Inventario de Usuarios</h1>
        <p class="text-muted font-size-sm m-0">Gestiona el alta, control y seguimiento de tus usuarios de plataforma.</p>
    </div>

    <div class="row mb-10">
        @php
            $buttons = [
                ['t' => 'ALTA DE CUSTODIOS', 'i' => 'fas fa-user-plus', 'c' => '#f6a924', 'bg' => 'rgba(246, 169, 36, 0.05)', 'r' => route('user.agregarusuario')],
                /* Actualizado con el color verde brillante (#10b981) de la imagen image_3c8643.png */
                ['t' => 'FICHA TÉCNICA', 'i' => 'fas fa-id-card', 'c' => '#10b981', 'bg' => 'rgba(16, 185, 129, 0.05)', 'r' => '#'],
                ['t' => 'SEGUIMIENTO DE DOCTOS.', 'i' => 'fas fa-file-signature', 'c' => '#38bdf8', 'bg' => 'rgba(56, 189, 248, 0.05)', 'r' => '#'],
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
            
            <div class="text-warning font-weight-bolder font-size-xs mb-3 text-uppercase tracking-wide">Resumen de Usuarios</div>

            <div class="row mb-4 g-3">
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(59, 130, 246, 0.12); color: #3b82f6;"><i class="la la-users"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">Total Usuarios</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">156</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(16, 185, 129, 0.12); color: #10b981;"><i class="la la-check-circle"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">Activos</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">118</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(245, 158, 11, 0.12); color: #f59e0b;"><i class="la la-clock"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">En Proceso</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">22</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box-improved">
                        <div class="icon-wrapper" style="background-color: rgba(239, 68, 68, 0.12); color: #ef4444;"><i class="la la-user-times"></i></div>
                        <div>
                            <span class="text-muted font-weight-bold d-block font-size-xs text-uppercase">Inactivos</span>
                            <span class="text-white font-weight-bolder font-size-h4 d-block">16</span>
                        </div>
                    </div>
                </div>
            </div>

            <form class="horizontal-filter-bar mb-4" onsubmit="return false;">
                <div style="flex: 1; min-width: 160px; position: relative;">
                    <input type="text" id="global_search_input" class="form-control input-premium-dark pl-8" placeholder="Buscar usuario..." />
                    <i class="la la-search text-muted position-absolute" style="left: 10px; top: 12px; font-size: 13px;"></i>
                </div>
                <div style="width: 130px;">
                    <select class="form-control input-premium-dark datatable-input py-0" data-col-index="6">
                        <option value="">Estatus: Todos</option>
                        <option value="ACTIVO">Activo</option>
                        <option value="INACTIVO">Inactivo</option>
                    </select>
                </div>
                <div style="width: 150px;">
                    <select class="form-control input-premium-dark datatable-input py-0" name="roles" data-col-index="5">
                        <option value="">Rol: Todos</option>
                        @foreach($rol as $co)
                          <option value="{{ $co->name }}">{{ $co->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="width: 130px;">
                    <input type="text" class="form-control input-premium-dark datatable-input" placeholder="RFC" data-col-index="2" />
                </div>
                
                <button type="button" class="btn btn-sm btn-outline-secondary text-white font-weight-bold px-4" id="kt_search" style="height:38px; border-color: var(--border-color);"><i class="la la-filter"></i> FILTROS</button>
                <button type="button" class="btn btn-sm btn-outline-secondary text-muted font-weight-bold px-4" id="kt_reset" style="height:38px; border-color: var(--border-color);"><i class="la la-sync"></i> LIMPIAR</button>
            </form>

            <div class="text-warning font-weight-bolder font-size-xs mb-3 text-uppercase tracking-wide">Listado de Usuarios</div>
            <div class="card card-premium mb-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-improved-dark" id="kdatatable_usuarios_dos">
                            <thead>
                                <tr>
                                    <th style="color: #38bdf8 !important;">ID</th>
                                    <th>Nombre</th>
                                    <th>RFC</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Estatus</th>
                                    <th class="text-center" style="width: 100px;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php $num = 1; @endphp
                                @foreach($usuario as $unid)
                                <tr>
                                    <td class="font-weight-bold" style="color: #38bdf8;">USR-{{ str_pad($unid->num_list ?? $unid->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-25 symbol-circle mr-2" style="background-color: var(--bg-input); width:26px; height:26px; display:flex; align-items:center; justify-content:center; border: 1px solid var(--border-color); overflow:hidden;">
                                                <img src="{{ asset('media/users/default.jpg') }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                                            </div>
                                            <span class="font-weight-bold text-white">{{ $unid->name }}</span>
                                        </div>
                                    </td>
                                    
                                    <td>{{ $unid->rfc ? $unid->rfc : 'N/A' }}</td>
                                    <td class="text-muted">{{ $unid->telefono ? $unid->telefono : '—' }}</td>
                                    <td class="text-muted">{{ $unid->email }}</td>
                                    
                                    <td><span class="status-chip chip-info">{{ $unid->name_role }}</span></td>
                                    
                                    <td>
                                        <span class="status-chip {{ $unid->deleted_at ? 'chip-inactive' : 'chip-active' }}">
                                            {{ $unid->deleted_at ? 'INACTIVO' : 'ACTIVO' }}
                                        </span>
                                    </td>
                                    
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <a href="{{ route('user.verusuario', $unid->id) }}" class="btn btn-xs btn-icon btn-clean text-muted p-0" title="Ver"><i class="la la-eye font-size-lg"></i></a>
                                            <a href="{{ route('user.editarusuario', $unid->id) }}" class="btn btn-xs btn-icon btn-clean text-muted p-0" title="Editar"><i class="la la-edit font-size-lg"></i></a>
                                            <button class="btn btn-xs btn-icon btn-clean text-muted p-0" onClick="deleteuser(`{{ $unid->name }} `,`{{ $unid->id }}`)" data-toggle="modal" data-target="#model_delete_user" title="Desactivar"><i class="la la-trash font-size-lg"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @php $num ++; @endphp
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

{{-- CONFIGURACIÓN DEL DIÁLOGO MODAL --}}
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_delete_user">
    <div class="modal-dialog">
        <div class="modal-content card-premium text-white">
            <div class="modal-header" style="border-bottom: 1px solid var(--border-color);">
                <h5 class="modal-title text-danger font-weight-bolder">Desactivar usuario</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.desacticarusuario') }}" method="post" id="submit_desactivar">
                    @csrf
                    <div class="row form-group">
                        <div class="col-lg-12 mt-2">
                            <label class="text-muted font-weight-bold mb-2">Motivo del cambio de estado:</label>
                            <input type="text" class="form-control input-premium-dark" name="motivo" id="desactivar_add" required/>
                            <input type="hidden" name="id" id="id_user_desc">
                            <input type="hidden" name="name_user" id="name_user">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top: 1px solid var(--border-color);">
                <button type="button" class="btn btn-secondary btn-sm font-weight-bold" data-dismiss="modal">Cancelar</button>
                <button type="button" id="send_desactivar" class="btn btn-primary btn-sm font-weight-bold">Guardar</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
@endsection