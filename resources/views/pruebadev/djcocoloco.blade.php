@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush

@section('title')
    Agregar cliente
@endsection

@section('content')

<style>
/* ===== ESTILO TABS AGREGAR CLIENTE ===== */
.nav-tabs.nav-tabs-line .nav-link {
    color: #6c757d; /* Gris */
    font-weight: 500;
}

.nav-tabs.nav-tabs-line .nav-link.active,
.nav-tabs.nav-tabs-line .nav-item.show .nav-link {
    color: #FFC107; /* Amarillo warning */
    border-bottom: 2px solid #FFC107;
}

.nav-tabs.nav-tabs-line .nav-link:hover {
    color: #FFB300;
}
</style>

<!--begin::Card-->
<div class="row">
    <div class="col-lg-12">
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Agregar Cliente</h3>
                <div class="card-toolbar">
                    <a href="{{ route('cliente.listadocliente') }}"
                       class="btn btn-sm btn-clean btn-hover-icon-success btn-icon"
                       data-toggle="tooltip" data-theme="dark" title="Salir">
                        <i class="flaticon2-reply"></i>
                    </a>
                </div>
            </div>

            <!--begin::Form-->
            <form action="{{ route('cliente.guardarcliente') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
                @csrf

                <div class="card-body">

                    <!--begin::tabs-->
                    <ul class="nav nav-tabs nav-tabs-line">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">
                                Información del Cliente
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">
                                Documentación
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content mt-5" id="myTabContent">

                        <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1" role="tabpanel">

                            <!-- === AQUÍ CONTINÚA TU CONTENIDO SIN CAMBIOS === -->
                            <!-- (todo lo demás se queda exactamente igual) -->

                        </div>

                        <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel">
                            <!-- CONTENIDO DOCUMENTACIÓN -->
                        </div>

                    </div>

                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="button" id="btnGuardar" class="btn btn-warning mr-2">
                                Guardar
                            </button>
                            <a href="{{ route('cliente.listadocliente') }}" class="btn btn-secondary">
                                Cancelar
                            </a>
                        </div>
                    </div>
                </div>

            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Card-->

@endsection
