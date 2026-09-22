@extends('layouts.app')

@section('title')
    Servicios Finalizados
@endsection

@push('styles')
    <link href="{{ asset('css/estilos_principal.css?v=1.2.3') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/monitoreo/CatalogoMonitoreo.js?v=3.1.1') }}"></script>
@endpush


@section('content')
<div class="monitoreo-page">

    <div class="monitoreo-page-header">

        <div>

		    <span class="monitoreo-eyebrow">
		        MONITOREO OPERATIVO
		    </span>

		    <h2 class="monitoreo-page-title">
		        SERVICIOS FINALIZADOS
		    </h2>

		    <p class="monitoreo-page-subtitle">
		        Consulta de servicios que han concluido su operación.
		    </p>

		</div>

        <div class="monitoreo-header-actions">

		    <a href="{{ route('monitoreo.listamonitoreo') }}"
		       class="monitoreo-btn monitoreo-btn--secondary">

		        <i class="la la-arrow-left"></i>
		        <span>SERVICIOS ACTIVOS</span>

		    </a>

		    <button type="button"
		            id="monitoreo_actualizar"
		            class="monitoreo-btn monitoreo-btn--primary">

		        <i class="la la-refresh"></i>
		        <span>ACTUALIZAR</span>

		    </button>

		    <button type="button"
		            id="monitoreo_exportar"
		            class="monitoreo-btn monitoreo-btn--secondary">

		        <i class="la la-download"></i>
		        <span>EXPORTAR</span>

		    </button>

		    <button type="button"
		            id="monitoreo_imprimir"
		            class="monitoreo-btn monitoreo-btn--secondary">

		        <i class="la la-print"></i>
		        <span>IMPRIMIR</span>

		    </button>

		</div>

    </div>

    <div class="monitoreo-panel">

		<section class="monitoreo-panel monitoreo-filter-panel">

		    <div class="monitoreo-filter-grid">

		        <div class="monitoreo-filter-field monitoreo-filter-field--search">

		            <label class="monitoreo-label" for="monitoreo_buscar">
		                Buscar coincidencia
		            </label>

		            <div class="monitoreo-search">

		                <i class="la la-search"></i>

		                <input type="text"
		                       id="monitoreo_buscar"
		                       class="form-control monitoreo-input"
		                       placeholder="Folio, cliente, origen, destino, custodio..."
		                       autocomplete="off">

		            </div>

		        </div>

		        <div class="monitoreo-filter-actions">

		            <button type="button"
		                    id="monitoreo_limpiar_filtros"
		                    class="monitoreo-btn monitoreo-btn--secondary">

		                <i class="la la-undo"></i>
		                Limpiar filtros

		            </button>

		        </div>

		    </div>

		</section>


        <!-- Table -->
        <div class="monitoreo-table-wrapper">

            <table class="monitoreo-table"
                   id="kdatatable_usuarios2">

                <thead>

                    <tr>

                        <th>Bitácora</th>

                        <th>Folio interno</th>

                        <th>Estatus</th>

                        <th>Cliente</th>

                        <th>Origen</th>

                        <th>Destino</th>

                        <th>Fecha servicio</th>

                        <th>Custodio</th>

                        <th>Acompañantes</th>

                        <th class="monitoreo-col-fecha-operativa">
                            Llegada punto Origen
                        </th>

                        <th class="monitoreo-col-fecha-operativa">
                            Inicio de servicio
                        </th>

                        <th class="monitoreo-col-fecha-operativa">
                            Arribo punto de destino
                        </th>

                        <th class="monitoreo-col-fecha-operativa">
                            Finalización de servicio
                        </th>

                        <th class="monitoreo-col-puntualidad">
                            Puntualidad
                        </th>

                        <th class="monitoreo-col-causa">
                            Causa
                        </th>

                        <th class="monitoreo-col-acciones text-center">
                            Acciones
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @foreach($monitoreo as $unid)

                        <tr data-monitoreo-row
                            data-status-id="{{ $unid->programacion_estatus_id }}">

                            <td>

                                <div class="monitoreo-bitacora-servicio">
                                    <a href="{{ route('monitoreo.verprogramacionmon', $unid->id) }}"class="monitoreo-folio">
                                        {{ $unid->folio }}
                                    </a>

                                    @if((int) $unid->armado_servicio === 1)

                                        <span class="monitoreo-armed-icon"
                                              title="Servicio armado">
                                            🔫
                                        </span>

                                    @endif

                                </div>

                            </td>

                            <td>

                                @if(!empty($unid->folio_interno))

                                    <span class="monitoreo-internal-folio">
                                        {{ $unid->folio_interno }}
                                    </span>

                                @else

                                    <span class="monitoreo-empty">
                                        -
                                    </span>

                                @endif

                            </td>

                            <td>

                                <div class="monitoreo-status-wrapper">

                                    <span class="monitoreo-status-dot monitoreo-status-dot--verde"></span>

                                    <span class="monitoreo-readonly-value">
                                        {{ $unid->estatus_programacion ?: 'Finalizado' }}
                                    </span>

                                </div>

                            </td>

                            <td>

                                <span class="monitoreo-client">
                                    {{ $unid->nombre_cliente ?: '-' }}
                                </span>

                            </td>

                            <td>

                                <span class="monitoreo-route"
                                      title="{{ $unid->dom_origen }}">

                                    {{ $unid->dom_origen ?: '-' }}

                                </span>

                            </td>

                            <td>

                                <span class="monitoreo-route"
                                      title="{{ $unid->dom_destino }}">

                                    {{ $unid->dom_destino ?: '-' }}

                                </span>

                            </td>

                            <td class="monitoreo-date">

                                @if(!empty($unid->fecha_servicio))
                                    {{ date('d/m/Y H:i', strtotime($unid->fecha_servicio)) }}
                                @else
                                    -
                                @endif

                            </td>

                            <td>
                                @if((int) $unid->custodio_id === 153)

                                    <div class="monitoreo-custodio monitoreo-custodio--pending">

                                        <span class="monitoreo-custodio-avatar monitoreo-custodio-avatar--pending">
                                            !
                                        </span>

                                        <div class="monitoreo-custodio-pending-info">

                                            <strong class="monitoreo-custodio-pending-text">
                                                Sin custodio
                                            </strong>

                                            <small>
                                                Pendiente de asignar
                                            </small>

                                        </div>

                                    </div>

                                @elseif((int) $unid->custodio_id === 154)

                                    <div class="monitoreo-custodio monitoreo-custodio--emergente">

                                        <span class="monitoreo-custodio-avatar">
                                            E
                                        </span>

                                        <div class="monitoreo-custodio-emergente-info">

                                            <strong class="monitoreo-custodio-name">

                                                {{ $unid->custodio_emergente ?: 'Custodio emergente' }}

                                            </strong>

                                            <small class="monitoreo-custodio-emergente-label">
                                                Custodio emergente
                                            </small>

                                        </div>

                                    </div>

                                @else

                                    <div class="monitoreo-custodio">

                                        <span class="monitoreo-custodio-avatar">

                                            {{ substr($unid->custodio->nombre_custodio ?? 'S', 0, 1) }}

                                        </span>

                                        <span class="monitoreo-custodio-name">

                                            {{ $unid->custodio->nombre_custodio ?? 'Sin asignar' }}
                                            {{ $unid->custodio->ap_paterno ?? '' }}

                                        </span>

                                    </div>

                                @endif

                            </td>

                            <td class="monitoreo-acompanantes-cell">

                                @if((int) $unid->custodio_id === 153)

                                    <span class="monitoreo-no-acompanante">
                                        No aplica
                                    </span>

                                @elseif( $unid->acompanantesProgramacion && $unid->acompanantesProgramacion->count())

                                    <div class="monitoreo-acompanantes-list">

                                        @foreach($unid->acompanantesProgramacion as $acompanante)

                                            @if($acompanante->custodio)

                                                <div class="monitoreo-acompanante-item">

                                                    <span class="monitoreo-acompanante-avatar">

                                                        {{ substr($acompanante->custodio->nombre_custodio ?? 'C', 0, 1) }}

                                                    </span>

                                                    <span class="monitoreo-acompanante-name">

                                                        {{ $acompanante->custodio->nombre_custodio }}
                                                        {{ $acompanante->custodio->ap_paterno }}

                                                    </span>

                                                </div>

                                            @endif

                                        @endforeach

                                    </div>

                                @else

                                    <span class="monitoreo-no-acompanante">
                                        Sin acompañantes
                                    </span>

                                @endif

                            </td>

                            <td class="monitoreo-date monitoreo-operational-date">

                                @if(!empty($unid->fechahora_llegada_custodio))

                                    {{ date('d/m/Y H:i', strtotime($unid->fechahora_llegada_custodio)) }}

                                @else
                                    -
                                @endif

                            </td>


                            <td class="monitoreo-date monitoreo-operational-date">

                                @if(!empty($unid->fechahora_inicio_trayecto))

                                    {{ date('d/m/Y H:i', strtotime($unid->fechahora_inicio_trayecto)) }}

                                @else
                                    -
                                @endif

                            </td>

                            <td class="monitoreo-date monitoreo-operational-date">

                                @if(!empty($unid->fechahora_llegado_destino))

                                    {{ date('d/m/Y H:i', strtotime($unid->fechahora_llegado_destino)) }}

                                @else
                                    -
                                @endif

                            </td>

                            <td class="monitoreo-date monitoreo-operational-date">

                                @if(!empty($unid->fechahora_finalizacion))

                                    {{ date('d/m/Y H:i', strtotime($unid->fechahora_finalizacion)) }}

                                @else
                                    -
                                @endif

                            </td>

                            <td>

                                <div class="monitoreo-puntualidad-wrapper">

                                    <span class="
                                        monitoreo-puntualidad-dot

                                        @if((int) $unid->estatus_itinerario === 1)
                                            monitoreo-puntualidad-dot--verde

                                        @elseif(!empty($unid->estatus_itinerario))
                                            monitoreo-puntualidad-dot--rojo

                                        @else
                                            monitoreo-puntualidad-dot--gris
                                        @endif
                                    ">
                                    </span>


                                    <span class="monitoreo-readonly-value">

                                        @if(empty($unid->estatus_itinerario))

                                            Sin estatus

                                        @else

                                            {{ $unid->puntualidad_descripcion ?: 'Sin estatus' }}

                                        @endif

                                    </span>

                                </div>

                            </td>

                            <td class="monitoreo-causa">

                                @if(empty($unid->estatus_itinerario) || (int) $unid->estatus_itinerario === 1)
                                    -
                                @else
                                    {{ $unid->puntualidad_causa ?: '-' }}
                                @endif

                            </td>

                            <td>

                                <div class="monitoreo-row-actions">

								    <a href="{{ route('monitoreo.verprogramacionmon', $unid->id) }}"
								       class="monitoreo-action"
								       title="Ver programación">

								        <i class="flaticon-eye"></i>

								    </a>

								    <a href="{{ route('monitoreo.moduloestadias', $unid->id) }}"
								       class="monitoreo-action"
								       title="Generales transportes">

								        <i class="flaticon-presentation-1"></i>

								    </a>

								</div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <div id="monitoreo_sin_resultados" class="monitoreo-empty">
			    <i class="la la-search"></i>
			    <strong>Sin coincidencias</strong>
			    <span>
			        No encontramos servicios finalizados con la búsqueda seleccionada.
			    </span>
			</div>

        </div>

        <div class="monitoreo-table-footer">

		    <div id="monitoreo_info"
		         class="monitoreo-table-info">
		    </div>

		    <div id="monitoreo_paginador"
		         class="monitoreo-pagination">
		    </div>

		</div>

    </div>

</div>

@endsection
