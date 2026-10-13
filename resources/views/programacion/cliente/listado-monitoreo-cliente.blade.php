@extends('layouts.app')

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=2.1.15') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
    <script src="{{ asset('js/programacion/ListadoMonitoreoCliente.js?v=1.0.1') }}"></script>
@endpush

@section('title', 'Lista de servicios')

@section('content')
<div class="cliente-monitor-page">
    <header class="cliente-monitor-header">
        <div>
            <span class="cliente-monitor-eyebrow">CONSULTA DE SERVICIOS</span>
            <h1>Lista de servicios</h1>
            <p>Seguimiento de tus servicios en tiempo real</p>
        </div>
        <button type="button" class="cliente-monitor-btn" onclick="window.location.reload()">
            <i class="la la-refresh"></i> Actualizar
        </button>
    </header>

    <section class="cliente-monitor-panel cliente-monitor-filters">
        <div>
            <label for="cliente_monitor_estado">Estatus</label>
            <select id="cliente_monitor_estado" class="cliente-monitor-control">
                <option value="">Todos los estatus</option>
                @foreach($estatus_programacion as $estatus)
                    <option value="{{ $estatus->id }}">{{ $estatus->estatus_programacion }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="cliente_monitor_buscar">Buscar coincidencia</label>
            <input id="cliente_monitor_buscar" type="search" class="cliente-monitor-control" placeholder="Folio, cliente, custodio, origen, destino...">
        </div>
        <button id="cliente_monitor_limpiar" type="button" class="cliente-monitor-btn cliente-monitor-btn-secondary">Limpiar filtros</button>
    </section>

    <section class="cliente-monitor-panel">
        <div class="cliente-monitor-panel-title">
            <div>
                <span class="cliente-monitor-eyebrow">SERVICIOS ASIGNADOS</span>
                <h2>Historial y seguimiento <span id="cliente_monitor_total">{{ $monitoreo->count() }}</span></h2>
            </div>
            <span class="cliente-monitor-readonly"><i class="la la-eye"></i> Solo consulta</span>
        </div>
        <div class="cliente-monitor-table-wrap">
            <table class="cliente-monitor-table" id="cliente_monitor_tabla">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Estatus</th>
                        <th>Cliente / Razón social</th>
                        <th>Fecha y hora de servicio</th>
                        <th>Tipo de servicio</th>
                        <th>Domicilio origen</th>
                        <th>Domicilio destino</th>
                        <th>Custodio</th>
                        <th>Servicio armado</th>
                        <th>Acompañantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monitoreo as $unid)
                        @php
                            $estadoId = (int) $unid->programacion_estatus_id;
                            $semaforo = $estadoId === 1 ? 'gris' : ($estadoId === 3 ? 'verde' : ($estadoId === 10 ? 'rojo' : 'amarillo'));
                        @endphp
                        <tr data-estado="{{ $estadoId }}">
                            <td><strong class="cliente-monitor-folio">{{ $unid->folio_interno ?? 'Sin Folio' }}</strong></td>
                            <td>
                                <span class="cliente-monitor-status">
                                    <span class="cliente-monitor-dot cliente-monitor-dot-{{ $semaforo }}"></span>
                                    {{ $unid->estatus_programacion ?? 'Sin estatus' }}
                                </span>
                            </td>
                            <td>{{ $unid->razon_social && $unid->nombre_cliente ? "{$unid->razon_social} - {$unid->nombre_cliente}" : ($unid->razon_social ?? $unid->nombre_cliente ?? '—') }}</td>

                            <td>
                                @if($unid->fecha_servicio && strtotime($unid->fecha_servicio) > 0)
                                    {{ date('d/m/Y h:i A', strtotime($unid->fecha_servicio)) }}
                                @else
                                    <span class="cliente-monitor-no-time"><i class="la la-clock-o"></i> SIN HORARIO</span>
                                @endif
                            </td>
                            <td>{{ $unid->tipo_servicio == 0 ? 'Foráneo' : 'Local' }}</td>
                            <td>{{ $unid->dom_origen ?: '—' }}</td>
                            <td>{{ $unid->dom_destino ?: '—' }}</td>
                            {{-- Personal responsable del servicio --}}
                            <td>
                                @php
                                    $nombreCustodio = (int) $unid->custodio_id === 154
                                        ? ($unid->custodio_emergente ?: 'Custodio emergente')
                                        : ($unid->custodio
                                            ? trim(($unid->custodio->nombre_custodio ?? '') . ' ' . ($unid->custodio->ap_paterno ?? '') . ' ' . ($unid->custodio->ap_materno ?? ''))
                                            : '');
                                    $sinCustodio = (int) $unid->custodio_id === 153 || $nombreCustodio === '';
                                @endphp
                                @if($sinCustodio)
                                    <div class="cliente-monitor-person cliente-monitor-person--empty">
                                        <span class="cliente-monitor-person-avatar"><i class="la la-user-times"></i></span>
                                        <span class="cliente-monitor-person-content">
                                            <span class="cliente-monitor-person-name">{{ (int) $unid->custodio_id === 153 ? 'Sin custodio' : 'Sin asignar' }}</span>
                                            <span class="cliente-monitor-person-role">Pendiente de asignación</span>
                                        </span>
                                    </div>
                                @else
                                    <div class="cliente-monitor-person">
                                        <span class="cliente-monitor-person-avatar"><i class="la la-user"></i></span>
                                        <span class="cliente-monitor-person-content">
                                            <span class="cliente-monitor-person-name" title="{{ $nombreCustodio }}">{{ $nombreCustodio }}</span>
                                            <span class="cliente-monitor-person-role">{{ (int) $unid->custodio_id === 154 ? 'Custodio emergente' : 'Custodio principal' }}</span>
                                        </span>
                                    </div>
                                @endif
                            </td>

                            {{-- Modalidad de protección --}}
                            <td>
                                @if((int) $unid->armado_servicio === 1)
                                    <div class="cliente-monitor-protection cliente-monitor-protection--armed">
                                        <span class="cliente-monitor-protection-symbol"><i class="la la-shield"></i></span>
                                        <span class="cliente-monitor-protection-content">
                                            <strong>Con armamento</strong>
                                            <small>Servicio armado</small>
                                        </span>
                                    </div>
                                @elseif((int) $unid->armado_servicio === 2)
                                    <div class="cliente-monitor-protection cliente-monitor-protection--unarmed">
                                        <span class="cliente-monitor-protection-symbol"><i class="la la-check-circle"></i></span>
                                        <span class="cliente-monitor-protection-content">
                                            <strong>Sin armamento</strong>
                                            <small>Servicio no armado</small>
                                        </span>
                                    </div>
                                @else
                                    <span class="cliente-monitor-muted">No especificado</span>
                                @endif
                            </td>

                            {{-- Personal acompañante --}}
                            <td>
                                @php
                                    $acompanantesValidos = $unid->acompanantesProgramacion
                                        ->filter(function ($acompanante) {
                                            return $acompanante->custodio !== null;
                                        });
                                @endphp
                                @if($acompanantesValidos->isNotEmpty())
                                    <div class="cliente-monitor-team">
                                        @foreach($acompanantesValidos as $acompanante)
                                            @php
                                                $nombreAcompanante = trim(
                                                    ($acompanante->custodio->nombre_custodio ?? '') . ' ' .
                                                    ($acompanante->custodio->ap_paterno ?? '') . ' ' .
                                                    ($acompanante->custodio->ap_materno ?? '')
                                                );
                                            @endphp
                                            <div class="cliente-monitor-person cliente-monitor-person--companion">
                                                <span class="cliente-monitor-person-avatar"><i class="la la-user"></i></span>
                                                <span class="cliente-monitor-person-content">
                                                    <span class="cliente-monitor-person-name" title="{{ $nombreAcompanante }}">{{ $nombreAcompanante }}</span>
                                                    <span class="cliente-monitor-person-role">Acompañante {{ $loop->iteration }}</span>
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="cliente-monitor-no-companions">
                                        <i class="la la-users"></i>
                                        <span>Sin acompañantes</span>
                                    </div>
                                @endif
                            </td>

                            <td class="cliente-monitor-actions-cell">
                                <a href="{{ route('procliadm.vermonitoreocliente', $unid->id) }}"
                                   class="cliente-monitor-view-btn"
                                   title="Ver detalle del servicio"
                                   aria-label="Ver detalle del servicio">
                                    <i class="la la-eye"></i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="cliente_monitor_vacio" class="cliente-monitor-empty" hidden>No se encontraron servicios con los filtros seleccionados.</div>
        <footer class="cliente-monitor-footer">
            <span id="cliente_monitor_info"></span>
            <div class="cliente-monitor-pagination">
                <label for="cliente_monitor_length">Mostrar</label>
                <select id="cliente_monitor_length" class="cliente-monitor-control">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50" selected>50</option>
                    <option value="100">100</option>
                    <option value="all">Todos</option>
                </select>
                <div id="cliente_monitor_paginas"></div>
            </div>
        </footer>
    </section>
</div>
@endsection
