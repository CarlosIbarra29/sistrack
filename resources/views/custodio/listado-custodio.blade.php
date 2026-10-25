@extends('layouts.app')

@section('title', 'Inventario de Custodios')

@push('styles')
<link href="{{ asset('css/inventario-custodios.css?v=7.1.1') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/custodios/InventarioCustodios.js?v=2.1.4') }}"></script>
@endpush

@section('content')
@php
    $activos = $data2->where('siaf_status', 1)->count();
    $inactivos = $data2->where('siaf_status', 2)->count();
    $accesos = [
        ['titulo' => 'ALTA DE CUSTODIOS', 'icono' => 'la la-user-plus', 'clase' => 'alta', 'ruta' => route('custodio.agregarcustodio'), 'activo' => true],
        ['titulo' => 'FICHA TÉCNICA', 'icono' => 'la la-id-card', 'clase' => 'ficha', 'ruta' => '#', 'activo' => false],
        ['titulo' => 'SEGUIMIENTO DE DOCTOS.', 'icono' => 'la la-file-text', 'clase' => 'documentos', 'ruta' => '#', 'activo' => false],
        ['titulo' => 'IMPRESIÓN DE CREDENCIAL', 'icono' => 'la la-print', 'clase' => 'credencial', 'ruta' => '#', 'activo' => false],
    ];
@endphp
<div class="custodios-page">
    <header class="custodios-header">
        <div>
            <span class="custodios-eyebrow">ADMINISTRACIÓN DE PERSONAL</span>
            <h1>Inventario de Custodios</h1>
            <p>Gestiona el alta, control y seguimiento de tus custodios en plataforma.</p>
        </div>
        <a class="custodios-btn custodios-btn-outline" href="{{ route('custodio.listadocustodioinactivo') }}">
            <i class="la la-trash-alt"></i> Custodios inactivos
        </a>
    </header>

    
    <section class="custodios-access-grid" aria-label="Accesos de custodios">

        @foreach($accesos as $acceso)
            <article class="custodios-access custodios-access--{{ $acceso['clase'] }}">
                <div class="custodios-access-info">
                    <span class="custodios-access-icon">
                        <i class="{{ $acceso['icono'] }}"></i>
                    </span>
                    <h2>{{ $acceso['titulo'] }}</h2>
                </div>
                @if($acceso['activo'])
                    <a href="{{ $acceso['ruta'] }}" class="custodios-access-link">
                        AÑADIR
                        <i class="la la-angle-right"></i>
                    </a>
                @else
                    <span class="custodios-access-link custodios-access-link-disabled" title="Función pendiente de implementar">
                        PRÓXIMAMENTE
                        <i class="la la-lock"></i>
                    </span>
                @endif
            </article>
        @endforeach
    </section>


    <section class="custodios-summary" aria-label="Resumen de custodios">
        <article class="custodios-stat"><span class="custodios-stat-icon"><i class="la la-users"></i></span><div><span>Total custodios</span><strong>{{ $data2->count() }}</strong></div></article>
        <article class="custodios-stat"><span class="custodios-stat-icon custodios-stat-icon-green"><i class="la la-check-circle"></i></span><div><span>Activos</span><strong>{{ $activos }}</strong></div></article>
        <article class="custodios-stat"><span class="custodios-stat-icon custodios-stat-icon-red"><i class="la la-user-times"></i></span><div><span>Inactivos</span><strong>{{ $inactivos }}</strong></div></article>
    </section>

    <section class="custodios-panel">
        <div class="custodios-panel-heading"><div><span class="custodios-eyebrow">PERSONAL REGISTRADO</span><h2>Listado de custodios <span>{{ $data->count() }}</span></h2></div></div>
        
        <div class="custodios-filters">

            <label class="custodios-filter-search">
                <span>Buscar coincidencia</span>
                <input id="custodios_buscar" type="search" placeholder="Nombre, apellidos, ID, CURP, RFC..." autocomplete="off" />
            </label>

            <label>
                <span>Puesto</span>

                <select id="custodios_puesto">
                    <option value="">Todos los puestos</option>
                    <option value="Custodio">Custodio</option>
                    <option value="Armado">Armado</option>
                    <option value="Segundo">Segundo</option>
                </select>
            </label>

            <button
                type="button"
                class="custodios-btn custodios-btn-outline"
                id="custodios_limpiar"
            >
                <i class="la la-undo"></i>
                Limpiar filtros
            </button>

</div>

        <div class="custodios-table-scroll">
            <table id="tabla_inventario_custodios" class="custodios-table">
                <thead><tr><th>ID</th><th>Nombre completo</th><th>Puesto / tipo</th><th>Base / sucursal</th><th>Estatus</th><th>Acciones</th></tr></thead>
                <tbody>
                    @foreach($data as $unid)
                        <tr>
                            <td><strong class="custodios-id">CUST-{{ str_pad($unid->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                            <td><div class="custodios-person"><span class="custodios-avatar"><i class="la la-user"></i></span><strong>{{ trim($unid->nombre_custodio . ' ' . $unid->ap_paterno . ' ' . $unid->ap_materno) }}</strong></div></td>
                            
                            <td>
                                @switch((int) $unid->tipo_custodio)
                                    @case(1)
                                        Custodio
                                        @break

                                    @case(2)
                                        Armado
                                        @break

                                    @case(3)
                                        Segundo
                                        @break

                                    @default
                                        Sin especificar
                                @endswitch
                            </td>
                            <td>{{ $unid->base ?: 'Sin especificar' }}</td>
                            <td><span class="custodios-status {{ (int)$unid->siaf_status === 1 ? 'custodios-status-active' : 'custodios-status-inactive' }}">{{ (int)$unid->siaf_status === 1 ? 'Activo' : 'Inactivo' }}</span></td>
                            <td><div class="custodios-actions">
                                <a class="custodios-icon-btn" href="{{ route('custodio.editarcustodio', $unid->id) }}" title="Editar custodio" aria-label="Editar custodio"><i class="la la-edit"></i></a>
                                @if((int)$unid->siaf_status === 1)
                                    <button type="button" class="custodios-icon-btn custodios-icon-btn-danger desactivar_custodio" data-id="{{ $unid->id }}" data-nombre="{{ $unid->nombre_custodio }}" title="Desactivar custodio" aria-label="Desactivar custodio"><i class="la la-trash"></i></button>
                                @else
                                    <span class="custodios-muted">Inactivo</span>
                                @endif
                            </div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
<form method="post" id="custodio_delete_form" action="{{ route('custodio.desactivarcustodio') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_delete" value="">
</form>
@endsection
