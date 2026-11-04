@extends('layouts.app')

@push('styles') <link rel="stylesheet" href="{{ asset('css/clientes.css?v=1.1.1') }}">
@endpush

@push('scripts') <script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
@endpush

@section('title')
Ver cliente
@endsection

@section('content')

<div class="cliente-edit-page cliente-view-page">

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
            <div class="tab-pane fade show active" id="kt_tab_info">
                <section class="cv-identity">
                    <div class="cv-identity-mark"><i class="flaticon2-user"></i></div>
                    <div class="cv-identity-main">
                        <span class="cv-eyebrow">FICHA DEL CLIENTE</span>
                        <h3>{{ $data->nombre_cliente ?: 'Cliente sin nombre' }}</h3>
                        <div class="cv-identity-meta">
                            <span><i class="flaticon2-building"></i> {{ $data->razon_social ?: 'Sin razón social' }}</span>
                            <span class="cv-group"><i class="flaticon2-group"></i> {{ $data->grupo ?: 'Sin grupo' }}</span>
                        </div>
                    </div>
                    <div class="cv-readonly"><i class="flaticon2-information"></i> Solo consulta</div>
                </section>

                <section class="cv-section">
                    <div class="cv-section-heading">
                        <div><span class="cv-eyebrow">CONFIGURACIÓN DEL SERVICIO</span><h3>Información técnica</h3></div>
                        <i class="flaticon2-settings cv-heading-icon"></i>
                    </div>
                    <div class="cv-metrics">
                        <div class="cv-metric"><span class="cv-metric-label">Días de crédito</span><strong>{{ $data->dias_credito !== null && $data->dias_credito !== '' ? $data->dias_credito : '—' }}</strong><small>Días</small></div>
                        <div class="cv-metric"><span class="cv-metric-label">Costo km extraordinario</span><strong>${{ number_format($data->costo_km, 2) }}</strong><small>Por kilómetro</small></div>
                        <div class="cv-metric"><span class="cv-metric-label">Horas de estadía armada</span><strong>${{ number_format($data->costo_estadia, 2) }}</strong><small>Tarifa registrada</small></div>
                        <div class="cv-metric"><span class="cv-metric-label">Horas de estadía no armada</span><strong>${{ number_format($data->costo_estadia_armada, 2) }}</strong><small>Tarifa registrada</small></div>
                    </div>
                    <div class="cv-service-grid">
                        <div class="cv-service"><div class="cv-service-title"><i class="flaticon2-shield"></i> Servicio con arma</div><strong>${{ number_format($data->servicio_arma, 2) }}</strong></div>
                        <div class="cv-service"><div class="cv-service-title"><i class="flaticon2-check-mark"></i> Servicio sin arma</div><strong>${{ number_format($data->servicio_sin_arma, 2) }}</strong></div>
                    </div>
                </section>

                <section class="cv-section">
                    <div class="cv-section-heading"><div><span class="cv-eyebrow">DIRECTORIO</span><h3>Contactos del cliente</h3></div><span class="cv-count">{{ count($cliente_operativo) }} contactos</span></div>
                    <div class="cv-contact-grid">
                        @forelse($cliente_operativo as $documento)
                            <article class="cv-contact">
                                <div class="cv-contact-top"><div class="cv-contact-avatar"><i class="flaticon2-user"></i></div><div class="cv-contact-title"><strong>{{ $documento->nombre_operativo ?: 'Sin nombre' }}</strong><span class="cliente-type-badge">{{ $documento->id_tipo_contacto == 1 ? 'Operativo' : 'Facturación y cobranza' }}</span></div></div>
                                <div class="cv-contact-detail"><i class="flaticon2-email"></i><span>{{ $documento->email_operativo ?: 'Sin correo registrado' }}</span></div>
                                <div class="cv-contact-detail"><i class="flaticon2-phone"></i><span>{{ $documento->telefono_operativo ?: 'Sin teléfono registrado' }}</span></div>
                            </article>
                        @empty
                            <div class="cv-empty"><i class="flaticon2-user"></i> No hay contactos registrados.</div>
                        @endforelse
                    </div>
                </section>

                <section class="cv-section">
                    <div class="cv-section-heading"><div><span class="cv-eyebrow">NOTAS</span><h3>Observaciones</h3></div><i class="flaticon2-notepad cv-heading-icon"></i></div>
                    <div class="cv-notes">{{ $data->observaciones ?? 'Sin observaciones' }}</div>
                </section>
            </div>

            <div class="tab-pane fade" id="kt_tab_docs">
                <section class="cv-section">
                    <div class="cv-section-heading"><div><span class="cv-eyebrow">EXPEDIENTE</span><h3>Documentación del cliente</h3></div><span class="cv-count">{{ count($documentos) }} documentos</span></div>
                    <div class="cv-doc-grid">
                        @forelse($documentos as $documento)
                            <article class="cv-document">
                                <div class="cv-document-icon"><i class="flaticon2-document"></i></div>
                                <div class="cv-document-info"><strong>{{ $documento->clienteTipoDocumento->nombre_documento }}</strong><span>Documento del cliente</span></div>
                                <a href="{{ route('archivo.documentoCliente', ['id' => $documento->id]) }}" target="_blank" rel="noopener noreferrer" class="cliente-document-link cv-document-open"><i class="flaticon2-file"></i> Ver documento</a>
                            </article>
                        @empty
                            <div class="cv-empty"><i class="flaticon2-document"></i> No hay documentos registrados.</div>
                        @endforelse
                    </div>
                </section>
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