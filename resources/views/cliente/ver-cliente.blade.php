@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
@endpush
@section('title')
    Ver cliente
@endsection
@section('content')

<div class="container-fluid">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h2 class="font-weight-bold mb-1">Ver cliente</h2>
            
        </div>

        <a href="{{ route('cliente.listadocliente') }}" class="btn btn-warning font-weight-bold">
            <i class="flaticon2-back"></i> Regresar
        </a>
    </div>

    <input type="hidden" id="documentoEliminarOperativo" value="{{ route('cliente.eliminarcontactooperativo') }}">
    <input type="hidden" id="documentoEliminarFacturacion" value="{{ route('cliente.eliminarcontactofacturacion') }}">

    <!-- Card principal -->
    <div class="card card-custom shadow-sm">
        <div class="card-body">

            <input type="hidden" name="cliente_id" value="{{ $data->id }}">

            <!-- Tabs -->
            <ul class="nav nav-tabs nav-tabs-line mb-6">
                <li class="nav-item">
                    <a class="nav-link active font-weight-bold" data-toggle="tab" href="#kt_tab_info">
                        Información del cliente
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold" data-toggle="tab" href="#kt_tab_docs">
                        Documentación
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <!-- TAB INFO -->
                <div class="tab-pane fade show active" id="kt_tab_info">

                    <!-- Datos generales -->
                    <div class="row mb-6">
                        <div class="col-lg-6">
                            <label class="text-muted">Razón social</label>
                            <div class="font-weight-bold text-dark">
                                {{ $data->razon_social }}
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <label class="text-muted">Nombre comercial / Cliente</label>
                            <div class="font-weight-bold text-dark">
                                {{ $data->nombre_cliente }}
                            </div>
                        </div>
                    </div>

                    <div class="row mb-8">
                        <div class="col-lg-6">
                            <label class="text-muted">Grupo</label>
                            <div>
                                <span class="label label-inline label-light-primary font-weight-bold">
                                    {{ $data->grupo }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Información técnica -->
                    <div class="card card-custom bg-light mb-8">
                        <div class="card-header border-0">
                            <h4 class="card-title mb-0">Información técnica</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 mb-4">
                                    <label class="text-muted">Días de crédito</label>
                                    <div class="font-weight-bold">
                                        {{ $data->dias_credito }}
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-4">
                                    <label class="text-muted">Costo de estadía</label>
                                    <div class="font-weight-bold">
                                        ${{ number_format($data->costo_estadia, 2) }}
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-4">
                                    <label class="text-muted">Costo km extraordinario</label>
                                    <div class="font-weight-bold">
                                        ${{ number_format($data->costo_km, 2) }}
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-4">
                                    <label class="text-muted">Costo por estadía no armada</label>
                                    <div class="font-weight-bold">
                                        ${{ number_format($data->costo_estadia_armada, 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card card-custom mb-8">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Contactos</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Tipo contacto</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cliente_operativo as $documento)
                                            <tr>
                                                <td>
                                                    @if($documento->id_tipo_contacto == 1)
                                                        <span class="badge badge-light-info">Operativo</span>
                                                    @else
                                                        <span class="badge badge-light-warning">Facturación y cobranza</span>
                                                    @endif
                                                </td>
                                                <td>{{ $documento->nombre_operativo }}</td>
                                                <td>{{ $documento->email_operativo }}</td>
                                                <td>{{ $documento->telefono_operativo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mb-6">
                        <label class="text-muted">Observaciones</label>
                        <div class="border rounded p-4 bg-light">
                            {{ $data->observaciones ?? 'Sin observaciones' }}
                        </div>
                    </div>

                </div>

               
                <div class="tab-pane fade" id="kt_tab_docs">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Documento</th>
                                    <th>Tipo de documento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documentos as $documento)
                                    <tr>
                                        <td>
                                            <a href="{{ route('archivo.documentoCliente', ['id'=>$documento->id]) }}"
                                               class="font-weight-bold text-primary"
                                               target="_blank">
                                                {{ $documento->clienteTipoDocumento->nombre_documento }}
                                            </a>
                                        </td>
                                        <td>{{ $documento->clienteTipoDocumento->nombre_documento }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
