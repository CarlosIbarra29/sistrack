@extends('layouts.app')

@push('styles') <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
@endpush

@push('scripts') <script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
@endpush

@section('title')
Ver cliente
@endsection

@section('content')

<div class="cliente-edit-page">

<div class="cliente-page-header">
    <div class="cliente-page-title">
        <div class="cliente-title-kicker">
            ADMINISTRACIÓN / CLIENTES
        </div>
        <h2>
            Ver cliente
        </h2>
        <p>
            Consulta de información y documentación del cliente.
        </p>
    </div>

    <a href="{{ route('cliente.listadocliente') }}"
       class="btn btn-warning font-weight-bold cliente-btn cliente-btn--back">
        <i class="flaticon2-back"></i>
        Regresar
    </a>
</div>

<input type="hidden"
       id="documentoEliminarOperativo"
       value="{{ route('cliente.eliminarcontactooperativo') }}">

<input type="hidden"
       id="documentoEliminarFacturacion"
       value="{{ route('cliente.eliminarcontactofacturacion') }}">

<div class="cliente-main-card">
    <div class="cliente-tabs-header">
        <ul class="nav nav-tabs cliente-tabs">
            <li class="nav-item">
                <a class="nav-link active font-weight-bold"
                   data-toggle="tab"
                   href="#kt_tab_info">
                    <i class="flaticon2-user"></i>
                    Información del cliente
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link font-weight-bold"
                   data-toggle="tab"
                   href="#kt_tab_docs">
                 <i class="flaticon2-document"></i>
                    Documentación
                </a>
            </li>
        </ul>
    </div>

    <div class="cliente-content">
        <div class="tab-content">
            <div class="tab-pane fade show active"
                 id="kt_tab_info">
                <div class="cliente-panel">
                    <div class="cliente-panel-header">
                        <div>
                            <span class="cliente-section-label">
                                INFORMACIÓN GENERAL
                            </span>
                            <h3>
                                Datos generales
                            </h3>
                        </div>
                    </div>


                    <div class="cliente-panel-body">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                <span class="titulo-lb">
                                    Razón social
                                </span>
                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    {{ $data->razon_social }}
                                </div>
                            </div>

                            <div class="col-lg-4">
                               <span class="titulo-lb">
                                    Nombre comercial / Cliente
                                </span>
                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    {{ $data->nombre_cliente }}
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <span class="titulo-lb">
                                    Grupo
                                </span>
                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    {{ $data->grupo ?: 'Sin grupo' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cliente-panel">
                   <div class="cliente-panel-header">
                       <div>
                            <span class="cliente-section-label">
                                CONFIGURACIÓN DEL SERVICIO
                            </span>
                            <h3>
                                Información técnica
                            </h3>
                        </div>
                    </div>

                    <div class="cliente-panel-body">
                        <div class="form-group row">
                            <div class="col-lg-3">
                                <span class="titulo-lb">
                                    Días de crédito
                                </span>
                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    {{ $data->dias_credito }}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <span class="titulo-lb">
                                    Costo km extraordinario
                                </span>

                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    ${{ number_format($data->costo_km, 2) }}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <span class="titulo-lb">
                                    Horas de estadía armada
                                </span>
                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    ${{ number_format($data->costo_estadia, 2) }}
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <span class="titulo-lb">
                                    Horas de estadía no armada
                                </span>
                                <div class="form-control st-input"
                                     style="height:auto; min-height:43px; background-color:#f8f9fa;">
                                    ${{ number_format($data->costo_estadia_armada, 2) }}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <span class="titulo-lb">
                                    Servicio con arma
                                </span>
                                <div class="form-control form-control-lg st-input"
                                     style="height:auto; min-height:48px; background-color:#f8f9fa;">
                                    ${{ number_format($data->servicio_arma, 2) }}
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <span class="titulo-lb">
                                    Servicio sin arma
                                </span>
                                <div class="form-control form-control-lg st-input"
                                     style="height:auto; min-height:48px; background-color:#f8f9fa;">
                                    ${{ number_format($data->servicio_sin_arma, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="cliente-panel">
                    <div class="cliente-panel-header">
                        <div>
                            <span class="cliente-section-label">
                                CONTACTOS
                            </span>
                            <h3>
                                Contactos
                            </h3>
                        </div>
                    </div>


                    <div class="cliente-table-wrapper">
                        <table class="table table-hover mb-0 cliente-table">
                            <thead>
                                <tr>

                                    <th>
                                        Tipo
                                    </th>

                                    <th>
                                        Nombre
                                    </th>

                                    <th>
                                        Email
                                    </th>

                                    <th>
                                        Teléfono
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($cliente_operativo as $documento)
                                   <tr>
                                        <td>
                                            <span class="cliente-type-badge">
                                                {{ $documento->id_tipo_contacto == 1
                                                    ? 'Operativo'
                                                    : 'Facturación y cobranza' }}
                                            </span>
                                        </td>

                                        <td>

                                            {{ $documento->nombre_operativo }}

                                        </td>


                                        <td>

                                            {{ $documento->email_operativo }}

                                        </td>


                                        <td>

                                            {{ $documento->telefono_operativo }}

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="cliente-panel">
                    <div class="cliente-panel-header">
                        <div>
                            <span class="cliente-section-label">
                                NOTAS
                            </span>
                            <h3>
                                Observaciones
                            </h3>
                        </div>
                    </div>


                    <div class="cliente-panel-body">
                        <div class="form-control st-input cliente-textarea"
                             style="height:auto; min-height:90px; background-color:#f8f9fa;">
                            {{ $data->observaciones ?? 'Sin observaciones' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade"
                 id="kt_tab_docs">

                <div class="cliente-panel">
                    <div class="cliente-panel-header">
                        <div>
                            <span class="cliente-section-label">
                                ARCHIVOS
                            </span>

                            <h3>
                                Documentación
                            </h3>
                        </div>
                    </div>


                    <div class="cliente-table-wrapper">
                        <table class="table table-hover mb-0 cliente-table">
                            <thead>
                                <tr>

                                    <th>
                                        Documento
                                    </th>

                                    <th>
                                        Tipo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($documentos as $documento)
                                    <tr>
                                        <td>
                                        <a href="{{ route('archivo.documentoCliente', ['id' => $documento->id]) }}"
                                               target="_blank"
                                               class="cliente-document-link font-weight-bold">

                                                {{ $documento->clienteTipoDocumento->nombre_documento }}
                                            </a>
                                        </td>

                                        <td>
                                            <span class="cliente-type-badge">

                                                {{ $documento->clienteTipoDocumento->nombre_documento }}

                                           </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="cliente-footer">
        <div class="cliente-footer-info">
            <span>
                <i class="flaticon2-information"></i>
                Información del cliente en modo consulta.
            </span>
        </div>


        <div class="cliente-footer-actions">
            <a href="{{ route('cliente.listadocliente') }}"
               class="btn btn-warning cliente-btn cliente-btn--save">
                <i class="flaticon2-back"></i>
                Regresar
            </a>
        </div>
    </div>
</div>
</div>

@endsection