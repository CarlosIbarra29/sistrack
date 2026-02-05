@extends('layouts.app')

@section('title')
    Catálogo de programación inactivas
@endsection

@push('scripts')
  <script src="{{ asset('js/programacion/CatalogoProgramacion.js') }}"></script>

  <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush


@section('content')
    <div class="d-flex flex-row">

    <!--begin::List-->
    <div class="flex-row-fluid">
        <div class="d-flex flex-column flex-grow-1">

            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-12">

                <!--begin::Card-->
                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                      <span class="card-icon">
                        <i class="flaticon2-file text-warning"></i>
                      </span>
                                <h3 class="card-label">Inventario de programación inactivas</h3>
                            </div>
                            <div class="card-toolbar">

                                <!--begin::Button-->
                                <a href="{{ route('programacion.listadoprogramacion') }}" class="btn btn-light-warning font-weight-bold mr-3 ml-3"><i class="flaticon2-back"></i> Regresar</a>
                                <!--end::Button-->

                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-hover table-checkable" id="kdatatable_programacion_inactivos">
                                <thead>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                  @foreach($programacion as $unid)
                                    <tr>
                                      <td>{{ $unid->id }}</td>
                                      <td>{{ $unid->folio }}</td>
                                      <td>{{ $unid->nombre_cliente }}</td>
                                      <td>{{ $unid->dom_origen }}</td>
                                      <td>{{ $unid->dom_destino }}</td>
                                      <td>{{ $unid->fecha_servicio }}</td>
                                      <td>
                                        @if($unid->tipo_servicio == 0)
                                          <span class="label font-weight-bold  label-outline-danger label-inline" >Foraneo</span>
                                        @else
                                          <span class="label font-weight-bold label-outline-warning label-inline" >Local</span>
                                        @endif
                                      </td>
                                      <td>{{ $unid->estatus_programacion }}</td>

                                      <td class="text-center">
                                        <button class="btn btn-clean btn-icon btn-outline-warning mt-1 activar-programacion" data-id="{{ $unid->id }}" data-nombre="{{ $unid->id }}" data-toggle="tooltip" data-theme="dark" title="Activar programación" ><i class="flaticon2-reply "></i></button>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                  <th>No.</th>
                                  <th>Folio</th>
                                  <th>Cliente</th>
                                  <th>Domicilio origen</th>
                                  <th>Domicilio destino</th>
                                  <th>Fecha y Hora</th>
                                  <th>Tipo de servicio</th>
                                  <th>Estatus</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                                </tfoot>

                            </table>
                            <!--end: Datatable-->

                            <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">

                        </div>
                    </div>
                    <!--end::Card-->
                    <!--end::Card-->
                </div>

            </div>
            <!--end::Row-->
        </div>
    </div>
    <!--end::List-->
</div>

  <form method="post" id="programacion_act_form" action="{{ route('programacion.activarprogramacion') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_delete" value="">
  </form>



@endsection