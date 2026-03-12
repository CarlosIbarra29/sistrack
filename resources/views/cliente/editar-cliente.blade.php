@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('title')
    Editar cliente
@endsection

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-8">
        <h2 class="font-weight-bold">Editar cliente</h2>

        <a href="{{ route('cliente.listadocliente') }}" class="btn btn-warning font-weight-bold">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </div>

    <!-- INPUTS OCULTOS QUE USA EL JS -->
    <input type="hidden" id="documentoEliminarPath" value="{{ route('cliente.eliminardocumentocliente') }}">
    <input type="hidden" id="documentoEliminarOperativo" value="{{ route('cliente.eliminarcontactooperativo') }}">
    <input type="hidden" id="documentoEliminarFacturacion" value="{{ route('cliente.eliminarcontactofacturacion') }}">
    <input type="hidden" id="tipoArchivo" value="{{ $cadenaTipoDocumento }}">
    <input type="hidden" id="tipoArchivo2" value="{{ $cadenatipocliente }}">

    <form action="{{ route('cliente.updatecliente') }}" method="POST" id="submit_cliente" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="cliente_id" value="{{ $data->id }}">

        <div class="card card-custom shadow-sm">

            <!-- TABS -->
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-2x">
                    <li class="nav-item">
                        <a class="nav-link active font-weight-bold" data-toggle="tab" href="#tab_info">
                            Información del cliente
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold" data-toggle="tab" href="#tab_docs">
                            Documentación
                        </a>
                    </li>
                </ul>

                <div class="tab-content mt-8">

                    {{-- ================= INFO CLIENTE ================= --}}
                    <div class="tab-pane fade show active" id="tab_info">

                        {{-- DATOS GENERALES --}}
                        <div class="card card-custom mb-8">
                            <div class="card-header">
                                <h3 class="card-title">Datos generales</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <spam class="titulo-lb" >Razón social</spam>
                                        <input type="text" class="form-control st-input" name="razon_social"
                                               id="razon_social" value="{{ $data->razon_social }}" required>
                                    </div>

                                    <div class="col-lg-4">
                                        <spam class="titulo-lb">Nombre comercial / Cliente</spam>
                                        <input type="text" class="form-control st-input" name="cliente"
                                               id="cliente" value="{{ $data->nombre_cliente }}" required>
                                    </div>

                                    <div class="col-lg-4">
                                        <spam class="titulo-lb">Grupo</spam >
                                        <input type="text" class="form-control st-input" name="grupo"
                                               id="grupo" value="{{ $data->grupo }}">
                                    </div>
                                </div>

                                

                            </div>
                        </div>

                        {{-- INFORMACIÓN TÉCNICA --}}
                        <div class="card card-custom mb-8">
                            <div class="card-header">
                                <h3 class="card-title card-title-custom ">Información técnica</h3>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <spam class="titulo-lb">Días de crédito</spam>
                                        <input type="number" class="form-control st-input"
                                               name="dias_credito" id="dias_credito"
                                               value="{{ $data->dias_credito }}">
                                    </div>

                                    <div class="col-lg-3">
                                        <spam class="titulo-lb">Costo de estadía</spam>
                                        <input type="text" class="form-control st-input"
                                               name="costo_estadia" id="costo_estadia"
                                               value="{{ $data->costo_estadia }}">
                                    </div>

                                    <div class="col-lg-3">
                                        <spam class="titulo-lb">Costo km extraordinario</spam >
                                        <input type="text" class="form-control st-input"
                                               name="costo_km" id="costo_km"
                                               value="{{ $data->costo_km }}">
                                    </div>
                                    <div class="col-lg-3">
                                        <spam class="titulo-lb">Costo por estadía no armada</spam>
                                        <input type="text" class="form-control st-input"
                                               name="costo_estadia_armada" id="costo_estadia_armada"
                                               value="{{ $data->costo_estadia_armada }}">
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                        {{-- CONTACTOS --}}
                        <div class="card card-custom mb-8">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Contactos</h3>   
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-hover mb-0" id="tblDocumentos">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentos">
                                        @foreach($cliente_operativo as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td>{{ $documento->id_tipo_contacto == 1 ? 'Operativo' : 'Facturación y cobranza' }}</td>
                                                <td>{{ $documento->nombre_operativo }}</td>
                                                <td>{{ $documento->email_operativo }}</td>
                                                <td>{{ $documento->telefono_operativo }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-danger hrefEliminarDocumento"
                                                       data-id="{{ $documento->id }}">
                                                        <i class="flaticon-delete"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        <div class=mt-4>
                                <a href="#" class="btn btn-icon btn-outline-warning  btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                    <i class="flaticon2-plus"></i>
                                </a>
                            </div>
                        </div>

                        {{-- OBSERVACIONES --}}
                        <div class="card card-custom">
                            <div class="card-header">
                                <h3 class="card-title">Observaciones</h3>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" name="observaciones"
                                          id="observaciones" rows="3">{{ $data->observaciones }}</textarea>
                            </div>
                        </div>

                    </div>

                    {{-- ================= DOCUMENTOS ================= --}}
                    <div class="tab-pane fade" id="tab_docs">

                        <div class="card card-custom">
                            <div class="card-header d-flex justify-content-between">
                                <h3 class="card-title">Documentación</h3>
                            </div>

                            <div class="card-body p-0">
                                <table class="table table-hover mb-0" id="tblDocumentos2">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Documento</th>
                                            <th>Tipo</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentos2">
                                        @foreach($documentos as $documento)
                                            <tr id="trDocumento2{{ $documento->id }}">
                                                <td>
                                                    <a href="{{ route('archivo.documentoCliente',['id'=>$documento->id]) }}"
                                                       target="_blank" class="font-weight-bold text-primary">
                                                        {{ $documento->clienteTipoDocumento->nombre_documento }}
                                                    </a>
                                                </td>
                                                <td>{{ $documento->clienteTipoDocumento->nombre_documento }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-danger hrefEliminarDocumento2"
                                                       data-id="{{ $documento->id }}">
                                                        <i class="flaticon-delete"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            

                            <div class="row form-group">
                                <div class="col-lg-12 mt-4">
                                    <a href="#" class="btn btn-icon btn-outline-warning btn-sm hrefAgregarOtro2" data-toggle="tooltip" title="Agregar documento">
                                         <i class="flaticon2-plus"></i>
                                    </a>
                                </div>
                               </div>

                            


                    </div>

                </div>
            </div>

            {{-- FOOTER --}}
            <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-12 text-right">
                                <button type="button"  id="btnGuardar" class="btn btn-warning mr-2"><i class="flaticon2-check-mark"></i>Guardar</button>
                                <a href="{{ route('cliente.listadocliente') }}"  class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>

        </div>
    </form>

</div>

@endsection