@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/clientes.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Editar cliente
@endsection
@section('content')

<div class="cliente-edit-page">
        <div class="cliente-page-header">
        <div class="cliente-page-title">
            <div class="cliente-title-kicker">
                ADMINISTRACIÓN / CLIENTES
            </div>
            <h2>
                Editar cliente
            </h2>
            <p>
                Actualización de información y documentación del cliente.
            </p>
        </div>
        <a href="{{ route('cliente.listadocliente') }}"
           class="btn btn-warning font-weight-bold cliente-btn cliente-btn--back">
            <i class="flaticon2-back"></i>
            Regresar
        </a>
    </div>

    <input type="hidden"
           id="documentoEliminarPath"
           value="{{ route('cliente.eliminardocumentocliente') }}">

    <input type="hidden"
           id="documentoEliminarOperativo"
           value="{{ route('cliente.eliminarcontactooperativo') }}">

    <input type="hidden"
           id="documentoEliminarFacturacion"
           value="{{ route('cliente.eliminarcontactofacturacion') }}">

    <input type="hidden"
           id="tipoArchivo"
           value="{{ $cadenaTipoDocumento }}">

    <input type="hidden"
           id="tipoArchivo2"
           value="{{ $cadenatipocliente }}">

    <form action="{{ route('cliente.updatecliente') }}"
          method="POST"
          id="submit_cliente"
          enctype="multipart/form-data">
        @csrf

        <input type="hidden"
               name="cliente_id"
               value="{{ $data->id }}">


        <div class="cliente-main-card">

            <div class="cliente-tabs-header">
                <ul class="nav nav-tabs cliente-tabs">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold"
                           data-toggle="tab"
                           href="#tab_info">
                            <i class="flaticon2-user"></i>
                            Información del cliente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold"
                           data-toggle="tab"
                           href="#tab_docs">
                            <i class="flaticon2-document"></i>
                            Documentación
                        </a>
                    </li>
                </ul>
            </div>

            <div class="cliente-content">
                <div class="tab-content">
                    <div class="tab-pane fade show active"
                         id="tab_info">

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
                                        <input type="text"
                                               class="form-control st-input"
                                               name="razon_social"
                                               id="razon_social"
                                               value="{{ $data->razon_social }}"
                                               required>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="titulo-lb">
                                            Nombre comercial / Cliente
                                        </span>
                                        <input type="text"
                                               class="form-control st-input"
                                               name="cliente"
                                               id="cliente"
                                               value="{{ $data->nombre_cliente }}"
                                               required>
                                    </div>

                                    <div class="col-lg-4">
                                        <span class="titulo-lb">
                                            Grupo
                                        </span>
                                        <input type="text"
                                               class="form-control st-input"
                                               name="grupo"
                                               id="grupo"
                                               value="{{ $data->grupo }}">
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
                                        <input type="number"
                                               class="form-control st-input"
                                               name="dias_credito"
                                               id="dias_credito"
                                               value="{{ $data->dias_credito }}">
                                    </div>

                                    <div class="col-lg-3">
                                        <span class="titulo-lb">
                                            Costo km extraordinario
                                        </span>
                                        <input type="text"
                                               class="form-control st-input"
                                               name="costo_km"
                                               id="costo_km"
                                               value="{{ $data->costo_km }}">
                                    </div>

                                    <div class="col-lg-3">
                                        <span class="titulo-lb">
                                            Horas de estadía armada
                                        </span>

                                        <input type="text"
                                               class="form-control st-input"
                                               name="costo_estadia"
                                               id="costo_estadia"
                                               value="{{ $data->costo_estadia }}">
                                    </div>

                                    <div class="col-lg-3">
                                        <span class="titulo-lb">
                                            Horas de estadía no armada
                                        </span>
                                        <input type="text"
                                               class="form-control st-input"
                                               name="costo_estadia_armada"
                                               id="costo_estadia_armada"
                                               value="{{ $data->costo_estadia_armada }}">
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="titulo-lb">
                                            Servicio con arma
                                        </span>
                                        <input type="text"
                                               class="form-control form-control-lg st-input"
                                               name="servicio_arma"
                                               id="servicio_arma"
                                               value="{{ $data->servicio_arma }}">
                                    </div>

                                    <div class="col-lg-6">
                                        <span class="titulo-lb">
                                            Servicio sin arma
                                        </span>
                                        <input type="text"
                                               class="form-control form-control-lg st-input"
                                               name="servicio_sin_arma"
                                               id="servicio_sin_arma"
                                               value="{{ $data->servicio_sin_arma }}">
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

                                <a href="#"
                                   class="btn btn-icon btn-outline-warning btn-sm hrefAgregarOtro cliente-add-btn"
                                   data-toggle="tooltip"
                                   data-theme="dark"
                                   title="Agregar archivo">
                                    <i class="flaticon2-plus"></i>
                                    <span>
                                        Agregar contacto
                                    </span>
                                </a>
                            </div>

                            <div class="cliente-table-wrapper">
                                <table class="table table-hover mb-0 cliente-table"
                                       id="tblDocumentos">
                                    <thead>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th class="cliente-action-column">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="tbodyDocumentos">
                                        @foreach($cliente_operativo as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td>
                                                    <span class="cliente-type-badge">
                                                        {{ $documento->id_tipo_contacto == 1 ? 'Operativo' : 'Facturación y cobranza' }}
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

                                                <td class="cliente-action-column">
                                                    <a href="#"
                                                       class="btn btn-sm btn-outline-danger hrefEliminarDocumento cliente-delete-btn"
                                                       data-id="{{ $documento->id }}">
                                                        <i class="flaticon-delete"></i>
                                                    </a>
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
                                <textarea class="form-control st-input cliente-textarea"
                                          name="observaciones"
                                          id="observaciones"
                                          rows="3">{{ $data->observaciones }}</textarea>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade"
                         id="tab_docs">
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


                                <a href="#"
                                   class="btn btn-icon btn-outline-warning btn-sm hrefAgregarOtro2 cliente-add-btn"
                                   data-toggle="tooltip"
                                   title="Agregar documento">
                                    <i class="flaticon2-plus"></i>
                                    <span>
                                        Agregar documento
                                    </span>
                                </a>
                            </div>


                            <div class="cliente-table-wrapper">
                                <table class="table table-hover mb-0 cliente-table"
                                       id="tblDocumentos2">
                                    <thead>
                                        <tr>
                                            <th>
                                                Documento
                                            </th>

                                            <th>
                                                Tipo
                                            </th>

                                            <th class="cliente-action-column">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody id="tbodyDocumentos2">
                                     @foreach($documentos as $documento)
                                            <tr id="trDocumento2{{ $documento->id }}">
                                                <td>
                                                    <a href="{{ route('archivo.documentoCliente',['id'=>$documento->id]) }}"
                                                       target="_blank"
                                                       class="cliente-document-link font-weight-bold">
                                                        {{ $documento->clienteTipoDocumento->nombre_documento }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $documento->clienteTipoDocumento->nombre_documento }}
                                                </td>

                                                <td class="cliente-action-column">
                                                    <a href="#"
                                                       class="btn btn-sm btn-outline-danger hrefEliminarDocumento2 cliente-delete-btn"
                                                       data-id="{{ $documento->id }}">
                                                        <i class="flaticon-delete"></i>
                                                    </a>
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
                        Verifica la información antes de guardar.
                    </span>
                </div>

                <div class="cliente-footer-actions">
                    <button type="button"
                            id="btnGuardar"
                            class="btn btn-warning mr-2 cliente-btn cliente-btn--save">
                        <i class="flaticon2-check-mark"></i>
                       Guardar
                    </button>
                    <a href="{{ route('cliente.listadocliente') }}"
                       class="btn btn-secondary cliente-btn cliente-btn--cancel">
                        Cancelar
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection