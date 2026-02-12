@extends('layouts.app')

@section('title')
    Catálogo de documentos de usuario
@endsection

@push('scripts')
    <script src="{{ asset('js/catalogos/usuarios/CatalogoDocumentosUsuario.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')
    <div class="d-flex flex-row">
        <div class="flex-row-fluid">
            <div class="d-flex flex-column flex-grow-1">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-custom">
                            <div class="card-header">
                                <div class="card-title">
                                    <span class="card-icon">
                                        <i class="flaticon2-file text-warning"></i>
                                    </span>
                                    <h3 class="card-label">Inventario de documentos del usuario</h3>
                                </div>
                                <div class="card-toolbar">
                                    <a class="btn btn-link-warning font-weight-bold mr-2 busqueda" data-toggle="collapse"
                                        href="#collapseExample" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Búsqueda
                                    </a>

                                    <a href="#" class="btn btn-light-warning font-weight-bolder mr-3 ml-3"
                                        data-toggle="modal" data-target="#kt_modal_1">
                                        <i class="la la-plus"></i>Nuevo</a>

                                    <a href="{{ route('usuario.usuariosinactivos') }}"
                                        class="btn btn-light-warning font-weight-bolder mr-3 ml-3">
                                        <i class="far fa-trash-alt"></i>Documentos inactivos</a>

                                    <div class="dropdown dropdown-inline mr-2">
                                        <button type="button"
                                            class="btn btn-light-warning font-weight-bolder dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="svg-icon svg-icon-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24">
                                                    <g fill="none" fill-rule="evenodd">
                                                        <rect width="24" height="24" />
                                                        <path d="M3,16 L5,16 C5.55,16 6,15.55 6,15 C6,14.45 5.55,14 5,14 L3,14
                                                        L3,12 L5,12 C5.55,12 6,11.55 6,11 C6,10.45 5.55,10 5,10 L3,10 L3,8 
                                                        L5,8 C5.55,8 6,7.55 6,7 C6,6.45 5.55,6 5,6 L3,6 L3,4 C3,3.45 
                                                        3.45,3 4,3 L10,3 C10.55,3 11,3.45 11,4 L11,19 C11,19.55 10.55,20 
                                                        10,20 L4,20 C3.45,20 3,19.55 3,19 L3,16 Z" fill="#000" opacity="0.3"/>
                                                        <path d="M16,3 L19,3 C20.1,3 21,3.9 21,5 L21,15.25 C21,15.73 20.82,16.2 
                                                        20.5,16.57 L17.88,19.57 C17.69,19.78 17.38,19.8 17.17,19.62 
                                                        L14.5,16.57 C14.18,16.2 14,15.73 14,15.25 L14,5 C14,3.9 14.9,3 
                                                        16,3 Z" fill="#000"/>
                                                    </g>
                                                </svg>
                                            </span>Exportar
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                            <ul class="navi flex-column navi-hover py-2">
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link" id="export-excel">
                                                        <span class="navi-icon"><i class="la la-file-excel-o"></i></span>
                                                        <span class="navi-text">Excel</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link" id="export-csv">
                                                        <span class="navi-icon"><i class="la la-file-text-o"></i></span>
                                                        <span class="navi-text">CSV</span>
                                                    </a>
                                                </li>
                                                <li class="navi-item">
                                                    <a href="#" class="navi-link" id="export-print">
                                                        <span class="navi-icon"><i class="la la-print"></i></span>
                                                        <span class="navi-text">Imprimir</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <form class="mb-15">
                                            <div class="row mb-6">
                                                <div class="col-lg-6 mb-lg-0 mb-6">
                                                    <label>Documento:</label>
                                                    <input type="text" class="form-control datatable-input"
                                                        data-col-index="1" />
                                                </div>
                                            </div>
                                            <div class="row mt-8">
                                                <div class="col-lg-12">
                                                    <button class="btn btn-primary" id="kt_search">
                                                        <span><i class="la la-search"></i>Buscar</span>
                                                    </button>
                                                    <button class="btn btn-secondary" id="kt_reset">
                                                        <span><i class="la la-close"></i>Limpiar</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <table class="table table-hover table-checkable inventory-table" id="kdatatable_documento">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Documento</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Documento</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                                <input type="hidden" id="catalogodatatable" value="{{ route('usuario.documentosdatatable') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- {{-- MODALS --}} -->

    <div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar documento</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.guardardocumento') }}" method="post" id="form_nuevo">
                        @csrf
                        <div class="form-group">
                            <label>Nombre del documento</label>
                            <input type="text" class="form-control" name="documento_usuario" id="documento_usuario" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="add_documento" class="btn btn-warning">Guardar</button>
                </div>
            </div>
        </div>
    </div>

  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="model_edit_tipodocumento">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Editar documentación</h5>
                  <div class="btn btn-icon btn-sm btn-active-light-danger ms-2" data-bs-dismiss="modal" aria-label="Close">
                      <span class="svg-icon svg-icon-2x"></span>
                  </div>
              </div>

              <div class="modal-body">
                <form action="{{ route('usuario.editardocumento') }}" method="post" id="submit_documento_edit">
                @csrf
                      <div class="row form-group">
                        <div class="col-lg-12 mt-2">
                          <label>Nombre del documento</label>
                          <input type="text" class="form-control" name="documento" id="documento_edit" />
                        </div>

                      </div>

                  <input type="hidden" name="id_documento_edit" id="id_documento_edit" value="">
                </form> 
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn btn-secondary font-weight-bold" data-dismiss="modal">Cancelar</button>
                <button type="button" id="edit_tipodocumento_submit" class="btn btn-warning">Guardar</button>
              </div>
          </div>
      </div>
  </div>

  <form method="post" id="documento_delete_form" action="{{ route('usuario.desactivardoc') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_documento_delete" value="">
  </form>

@endsection