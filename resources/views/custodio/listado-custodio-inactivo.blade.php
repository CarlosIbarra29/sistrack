@extends('layouts.app')

@section('title', 'Custodios inactivos')

@push('styles')
<link href="{{ asset('css/inventario-custodios.css?v=7.1.1') }}" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/custodios/InventarioCustodios.js?v=2.1.4') }}"></script>
@endpush

@section('content')
<div class="custodios-page custodios-page-inactive">
    <header class="custodios-header">
    
        <div>
            <span class="custodios-eyebrow">ADMINISTRACIÓN DE PERSONAL</span>
            <h1>Custodios inactivos</h1>
            <p>Consulta el historial y reactiva custodios cuando corresponda.</p>
        </div>
        
        <a href="{{ route('custodio.listadocustodio') }}" class="custodios-btn custodios-btn-outline"><i class="la la-arrow-left"></i> Regresar</a>
    
    </header>

    <section class="custodios-panel">
        <div class="custodios-panel-heading">
        
            <div>
                <span class="custodios-eyebrow">HISTORIAL DE CUSTODIOS</span>
                <h2>Inventario de custodios inactivos <span>{{ $data->count() }}</span></h2>
            </div>
            <small><i class="la la-info-circle"></i> Utiliza la acción para reactivar un custodio</small>

        </div>
        
        <div class="custodios-table-scroll">
            <table class="custodios-table" id="kdatatable_custodios_inactivos">
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>CURP</th>
                        <th>RFC</th>
                        <th>Teléfono</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($data as $unid)
                        <tr>

                            <td><strong class="custodios-id">CUST-{{ str_pad($unid->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                        
                            <td><strong>{{ $unid->nombre_custodio }}</strong></td>
                            
                            <td>{{ $unid->ap_paterno }}</td>
                            
                            <td>{{ $unid->ap_materno }}</td>
                            
                            <td>{{ $unid->curp ?: '—' }}</td>
                            
                            <td>{{ $unid->rfc ?: '—' }}</td>
                            
                            <td>{{ $unid->numero_telefono ?: '—' }}</td>
                        
                            
                            <td>
                                <button type="button" class="custodios-icon-btn custodios-icon-btn-activate activar-custodio" data-id="{{ $unid->id }}" data-nombre="{{ $unid->nombre_custodio }}" title="Activar custodio" aria-label="Activar custodio"><i class="la la-reply"></i></button>
                            </td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>


<form method="post" id="custodio_act_form" action="{{ route('custodio.activarcustodio') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_delete" value="">
</form>
@endsection
