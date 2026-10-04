@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.2.3') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
  <script src="{{ asset('js/catalogos/CatalogoNotificaciones.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
  Listado de Notificaciones
@endsection

@section('content')

<div class="notificaciones-page">

    <div class="notificaciones-page-header select-none">
        <div>
            <span class="notificaciones-eyebrow">CENTRO DE NOTIFICACIONES</span>
            <h2 class="notificaciones-page-title">LISTADO DE NOTIFICACIONES</h2>
            {{-- <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona el alta, control y seguimiento de las cuentas y clientes de la plataforma.</p> --}}
            <p class="notificaciones-page-subtitle">Consulta y da seguimiento a las notificaciones generadas por el sistema.</p>
        </div>
    </div>

    <div class="notificaciones-panel">
        <div class="notificaciones-panel-header select-none">
            <div>
                <span class="notificaciones-eyebrow">ACTIVIDAD DEL SISTEMA</span>
                <h6>NOTIFICACIONES</h6>
            </div>
            <div class="notificaciones-panel-header__legend">
                <span class="notificaciones-live-dot"></span>
                <span>Registro de actividad</span>
            </div>
        </div>

        <div class="notificaciones-table-area">
            <div class="table-responsive notificaciones-table-wrapper">
                <table class="table align-middle notificaciones-table" id="kdatatable_notificaciones">
                    <thead>
                        <tr class="select-none">
                            <th style="width: 30%;">Modulo<i class="fas fa-sort ms-1"></i></th>
                            <th style="width: 30%;">Resumen<i class="fas fa-sort ms-1"></i></th>
                            <th style="width: 30%;">Estatus <i class="fas fa-sort ms-1"></i></th>
                            <th style="width: 13%;">FECHA Y HORA DE NOTIFICACIÓN <i class="fas fa-sort ms-1"></i></th>
                            <th style="width: 13%;">USUARIO <i class="fas fa-sort ms-1"></i></th>
                            <th style="width: 12%;" class="text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="border-0">

                        @php $num = 1; @endphp
                        @foreach($notificaciones as $unid)
                            <tr>

                                <td class="notificaciones-module">{{ $unid->modulo_notificacion  }} </td>
                                <td class="notificaciones-summary">{{ $unid->resumen  }} </td>
                                <td>
                                    @if($unid->estatus == 0)
                                        <span class="label font-weight-bold label-outline-warning label-inline notificaciones-status notificaciones-status--pending"> Sin visualizar</span>
                                    @endif

                                    @if($unid->estatus == 1)
                                        <span class="label font-weight-bold label-outline-success label-inline notificaciones-status notificaciones-status--success"> Atendida</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge px-2 py-1 fw-semibold select-none notificaciones-date">
                                        {{ $unid->created_at }}
                                    </span>
                                </td>

                                <td class="notificaciones-user">
                                    {{-- {{ $unid->userCreated->name  }}   --}}
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- 0 = Modulo de servicios cliente --}}
                                        @if($unid->op_modulo == 0)
                                            <a href="{{ route('notificaciones.vernotificacionservcliente', $unid->id) }}" class="notificaciones-action" title="Ver Notificación" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        @endif

                                    </div>
                                </td>
                            </tr>
                            @php $num ++; @endphp
                        @endforeach
                    </tbody>
                </table>
                <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
            </div>
        </div>
    </div>
</div>

<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>

@endsection
