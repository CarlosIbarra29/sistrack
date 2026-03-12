@extends('layouts.app')
@section('title')
    Catálogo de tipo de documentos
@endsection

@push('scripts')
  <script src="{{ asset('js/catalogos/CatalogoDocumentosCliente.js') }}"></script> 
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
                                <h3 class="card-label">Inventario de tipo de documentos</h3>
                            </div>
                            <div class="card-toolbar">

                                <!--begin::Button-->

                                  <a href="{{ route('doccliente.catalogoDocumentos') }}" class="btn btn-warning font-weight-bold"><i class="flaticon2-back"></i> Regresar</a>

                                <!--end::Button-->

                            </div>
                        </div>
                        <div class="card-body">
                            <!--begin: Datatable-->
                            <table class="table table-hover table-checkable inventory-table" id="kdatatable_documentos_inactivos">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tipo de documento</th>
                                  <th class="text-center">Opciones</th>
                                </tr>
                                </thead>

                                <tbody>
                                  @foreach($documento as $doc)
                                    <tr>
                                        <td>{{ $doc->id }}</td>
                                        <td>{{ $doc->nombre_documento }}</td>

                                      <td class="text-center">
                                        <a class="btn btn-clean btn-icon btn-outline-warning mt-1 activar-documento" data-id="{{ $doc->id }}" data-nombre="{{ $doc->nombre_documento }}" data-toggle="tooltip" data-theme="dark" title="Activar Tipo de Documento" ><i class="flaticon2-reply "></i></a>
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Tipo de documento</th>
                                  <th class="text-center">Opciones</th>
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

  <form method="post" id="documento_act_form" action="{{ route('doccliente.activartipodocumento') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_documento" value="">
  </form>


@endsection