@extends('layouts.app')
@push('scripts')
  <script src="{{ asset('js/catalogos/CatalogoNotificaciones.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
  Listado de Notificaciones
@endsection
@section('content')


<div class="w-100 p-5" style="background-color: #0b0f19; color: #ffffff; font-family: 'Poppins', sans-serif; min-height: 100vh;">

    
    <div class="mb-4 select-none">
        <h2 class="fw-bold text-white m-0" style="font-size: 1.8rem;">Listado de Notificaciones</h2>
        {{-- <p class="text-muted m-0" style="font-size: 0.9rem;">Gestiona el alta, control y seguimiento de las cuentas y clientes de la plataforma.</p> --}}
    </div>

    

    <div class="row g-4">
        
        
        <div class="col-xl-12 col-lg-12">
            

            <div class="p-4 rounded-3 shadow-sm" style="background-color: #111625; border: 1px solid #1e293b;">


                <div class="table-responsive">
                    <table class="table align-middle text-white" id="kdatatable_notificaciones" style="--bs-table-bg: transparent; font-size: 0.85rem;">
                        <thead>
                            <tr class="text-muted fw-bold text-uppercase border-bottom border-secondary select-none" style="font-size: 0.75rem; border-color: #1e293b !important;">
                                <th style="width: 30%;">Modulo<i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 30%;">Resumen<i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 30%;">Estatus <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">FECHA Y HORA DE NOTIFICACIÓN <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 13%;">USUARIO <i class="fas fa-sort text-muted ms-1" style="font-size: 0.65rem;"></i></th>
                                <th style="width: 12%;" class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody class="border-0">

                            @php $num = 1; @endphp
                            @foreach($notificaciones as $unid)
                                <tr class="border-bottom border-dark" style="border-color: #171e30 !important;">

                                    <td class="text-white-50">{{ $unid->modulo_notificacion  }} </td>
                                    <td class="text-white-50">{{ $unid->resumen  }} </td>
                                    <td class="text-white-50">
                                        @if($unid->estatus == 0)
                                            <span class="label font-weight-bold label-outline-warning label-inline"> Sin visualizar</span>
                                        @endif

                                        @if($unid->estatus == 1)
                                            <span class="label font-weight-bold label-outline-success label-inline"> Atendida</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge px-2 py-1 fw-semibold select-none" style="background-color: #171e30; color: #38bdf8; font-size: 0.75rem;">
                                            {{ $unid->created_at }}
                                        </span>
                                    </td>

                                    <td class="text-white-50">{{ $unid->userCreated->name  }}  </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            {{-- 0 = Modulo de servicios cliente --}}
                                            @if($unid->op_modulo == 0)
                                                <a href="{{ route('notificaciones.vernotificacionservcliente', $unid->id) }}" class="text-decoration-none text-muted px-1" title="Ver Notificación" data-toggle="tooltip" data-theme="dark" data-placement="top">
                                                    <i class="far fa-eye text-white" style="font-size: 1rem;"></i>
                                                </a>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                                @php $num ++; @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                </div>

                
            </div>

        </div>

        
    </div>
</div>


<form method="post" id="cliente_delete_form" action="{{ route('cliente.desactivarclientelistado') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_cliente_delete" value="">
</form>



@endsection