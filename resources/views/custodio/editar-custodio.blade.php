@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/custodios/EditarCustodio.js') }}"></script>
@endpush
@section('title')
    Editar custodio
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Editar Custodio</h3>
                </div>
                <!--begin::Form-->
                <input type="hidden" id="documentoEliminarPath" value="{{ route('custodio.eliminardocumentocustodio') }}">


                <form action="{{ route('custodio.updatecustodio') }}" method="post" id="submit_cliente" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_custodio" value="{{ $custodio->id }}">
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <div class="card-body">

                        <ul class="nav nav-tabs nav-tabs-line">
                            <li class="nav-item">
                                @if($porcentaje_info == 0)
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información básica <p><span class="label font-weight-bold label-outline-danger label-inline">0%</span></p></a>
                                @endif
                                
                                @if($porcentaje_info == 17)
                                    <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Información básica <p><span class="label font-weight-bold label-outline-success label-inline">100%</span></p></a>
                                @endif

                                @if($porcentaje_info != 17 && $porcentaje_info != 0)
                                    @php
                                        $mul_inf = $porcentaje_info *100;
                                        $total_info = $mul_inf /17;
                                    @endphp
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_1">Información básica<p><span class="label font-weight-bold label-outline-warning label-inline">{{ round($total_info, 2) }}%</span></p> </a>
                                @endif

                            </li>
                            <li class="nav-item">
                                @if($porcentaje_domicilio == 0)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Domicilio<p><span class="label font-weight-bold label-outline-danger label-inline">0%</span></p> </a>
                                @endif

                                @if($porcentaje_domicilio == 6)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Domicilio<p><span class="label font-weight-bold label-outline-success label-inline">100%</span></p> </a>
                                @endif

                                @if($porcentaje_domicilio != 0 && $porcentaje_domicilio != 6)
                                    @php
                                        // $total_por = $porcentaje_domicilio *10;
                                        $mul_domi = $porcentaje_domicilio *100;
                                        $total_idom = $mul_domi /6;
                                    @endphp
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3">Domicilio<p><span class="label font-weight-bold label-outline-warning label-inline">{{ round($total_idom, 2)}}%</span></p> </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if($porcentaje_seleccion == 0)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Selección <p><span class="label font-weight-bold label-outline-danger label-inline">0%</span></p> </a>
                                @endif

                                @if($porcentaje_seleccion == 3)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Selección<p><span class="label font-weight-bold label-outline-success label-inline">100%</span></p> </a>
                                @endif

                                @if($porcentaje_seleccion != 3 && $porcentaje_seleccion != 0)
                                    @php
                                        $mul_sel = $porcentaje_seleccion *100;
                                        $total_sel = $mul_sel /3;
                                    @endphp
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_4">Selección<p><span class="label font-weight-bold label-outline-warning label-inline">{{ round($total_sel, 2) }}%</span></p> </a>
                                @endif
                            </li>
                            <li class="nav-item">
                                @if($porcentaje_confianza == 0)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Control de confianza <p><span class="label font-weight-bold label-outline-danger label-inline">0%</span></p></a>
                                @endif
                                @if($porcentaje_confianza == 12)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Control de confianza<p><span class="label font-weight-bold label-outline-success label-inline">100%</span></p></a>
                                @endif
                                @if($porcentaje_confianza != 12 && $porcentaje_confianza != 0)
                                    @php
                                        $mul_con = $porcentaje_confianza *100;
                                        $total_scon = $mul_con /12;
                                    @endphp
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_5">Control de confianza<p><span class="label font-weight-bold label-outline-warning label-inline">{{ round($total_scon, 2) }}%</span></p> </a>
                                @endif

                            </li>
                            <li class="nav-item">
                                @if(count($documentos) == 0)
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Documentos personales <p><span class="label font-weight-bold label-outline-danger label-inline">0</span></p></a>
                                @else
                                    <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Documentos personales <p><span class="label font-weight-bold label-outline-success label-inline">{{ count($documentos) }}</span></p></a>
                                @endif
                                
                            </li>
                        </ul>

                        <div class="tab-content mt-5" id="myTabContent">
                            <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">
                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">
                                                <small>Fotografía del custodio</small>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-6">
                                                @if( $custodio->fotografia_custodio == "" || $custodio->fotografia_custodio == null)
                                                    <img src="/img/no_disponible.png" width="190">
                                                @else
                                                    <img src="{{ route('archivo.fotografiaCustodio', ['id'=>$custodio->id]) }}" width="290">
                                                @endif
                                            </div>
                                            <div class="col-lg-6">
                                                <label>Fotografía</label>
                                                <div class='custom-file'>
                                                    <input type='file' class='custom-file-input' id='file_carga' name='file_carga[]' />
                                                    <label class='custom-file-label' for='foto"+contadorFotografia+"'>Selecciona un archivo</label>
                                                </div>
                                                <div class="row mt-2">
                                                    <label>Fecha de ingreso</label>
                                                    <div class="input-group">
                                                        @if($custodio->fecha_ingreso != null || $custodio->fecha_ingreso != "")
                                                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($custodio->fecha_ingreso))}}" name="fecha_ingreso" id="fecha_ingreso" required readonly/>
                                                        @else
                                                            <input type="text" class="form-control" value="" name="fecha_ingreso" id="fecha_ingreso" required readonly/>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Apellido paterno</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->ap_paterno }}" name="ape_paterno" id="ape_paterno" required/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Apellido materno</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->ap_materno }}" name="ape_materno" id="ape_materno" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nombre(s)</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="nombre_custodio" id="nombre_custodio" value="{{ $custodio->nombre_custodio }}" required/>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <label>Edad</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" value="{{ $custodio->edad }}" name="edad" id="edad" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Sexo</label>
                                        <select class="form-control" name="sexo" id="sexo">
                                            <option value="">Selecciona un opción</option>
                                            <option value="1" {{($custodio->sexo == 1) ? 'selected' : ''}}>Masculino</option>
                                            <option value="2" {{($custodio->sexo == 2) ? 'selected' : ''}}>Femenino</option>
                                            <option value="3" {{($custodio->sexo == 3) ? 'selected' : ''}}>Otro</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Fecha de nacimiento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ date('d/m/Y', strtotime($custodio->fecha_nacimiento))}}" name="fecha_nacimiento" id="fecha_nacimiento" required readonly/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Lugar de nacimiento</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->lugar_nacimiento  }}" name="lugar_nacimiento" id="lugar_nacimiento"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nacionalidad</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->nacionalidad }}" name="nacionalidad" id="nacionalidad" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Estado civil</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->estado_civil }}" name="estado_civil" id="estado_civil"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>CURP</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="curp" id="curp"  value="{{ $custodio->curp }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>RFC</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="rfc" id="rfc"  value="{{ $custodio->rfc }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Correo electronico</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="mail" id="mail"  value="{{ $custodio->correo_electronico }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Base</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="base" id="base"  value="{{ $custodio->base }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Escolaridad</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->escolaridad }}" name="escolaridad" id="escolaridad"  />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Número Telefónico</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="telefono_custodio" id="telefono_custodio" value="{{ $custodio->numero_telefono }}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="observaciones" rows="3">{{ $custodio->observaciones }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade mt-10" id="kt_tab_pane_3" role="tabpanel" aria-labelledby="kt_tab_pane_3">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Calle</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->dom_calle }}" name="dom_calle" id="dom_calle"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Núm. Ext. / Int.</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->dom_num }}" name="dom_num" id="dom_num"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Colonia</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control"  value="{{ $custodio->dom_colonia }}" name="dom_colonia" id="dom_colonia"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Municipio/ Delegación</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->dom_municipio }}" name="dom_municipio" id="dom_municipio"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Estado</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->dom_estado }}" name="dom_estado" id="dom_estado"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Código postal</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{ $custodio->dom_cp }}" name="dom_cp" id="dom_cp"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade mt-10" id="kt_tab_pane_4" role="tabpanel" aria-labelledby="kt_tab_pane_4">
                                @if($custodio_seleccion == null)
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Entrevista Inicial</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="entin_fecha" id="entin_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="entin_comentario" id="entin_comentario"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Verificación Documental</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verdoc_fecha" id="verdoc_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verdoc_comentario" id="verdoc_comentario"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Entrevista Operativa / Seguridad </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="entope_fecha" id="entope_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="entope_comentario" id="entope_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Entrevista Inicial</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_seleccion->entin_fecha != null || $custodio_seleccion->entin_fecha != "")
                                                     <input type="text" class="form-control" readonly name="entin_fecha" id="entin_fecha" value="{{ date('d/m/Y', strtotime($custodio_seleccion->entin_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" readonly name="entin_fecha" id="entin_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="entin_comentario" id="entin_comentario" value="{{ $custodio_seleccion->entin_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Verificación Documental</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_seleccion->verdoc_fecha != null || $custodio_seleccion->verdoc_fecha != "")
                                                    <input type="text" class="form-control" readonly name="verdoc_fecha" id="verdoc_fecha" value="{{ date('d/m/Y', strtotime($custodio_seleccion->verdoc_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" readonly name="verdoc_fecha" id="verdoc_fecha"/>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verdoc_comentario" id="verdoc_comentario" value="{{ $custodio_seleccion->verdoc_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Entrevista Operativa / Seguridad </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_seleccion->entope_fecha != null || $custodio_seleccion->entope_fecha != "")
                                                    <input type="text" class="form-control" readonly name="entope_fecha" id="entope_fecha" value="{{ date('d/m/Y', strtotime($custodio_seleccion->entope_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" readonly name="entope_fecha" id="entope_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="entope_comentario" id="entope_comentario" value="{{ $custodio_seleccion->entope_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>


                    {{-- Control de confianza --}}
                            <div class="tab-pane fade mt-10" id="kt_tab_pane_5" role="tabpanel" aria-labelledby="kt_tab_pane_5">  
                                @if($custodio_confianza == null)
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Entrevista de Validación de Datos</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="valdat_fecha" readonly id="valdat_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="valdat_comentario" id="valdat_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Verificación de Referencias Personales</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verref_fecha" readonly id="verref_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verref_comentario" id="verref_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Verificación de Referencias Laborales</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verlab_fecha" readonly id="verlab_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verlab_comentario" id="verlab_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Análisis Socioeconómico Laboral </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="anasoc_fecha" readonly id="anasoc_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="anasoc_comentario" id="anasoc_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Físico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exafis_fecha" readonly id="exafis_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exafis_comentario" id="exafis_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Médico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="examed_fecha" readonly id="examed_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="examed_comentario" id="examed_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Psicológico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exapsi_fecha" readonly id="exapsi_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exapsi_comentario" id="exapsi_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Toxicológico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exatox_fecha" readonly id="exatox_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exatox_comentario" id="exatox_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Veracidad </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesver_fecha" readonly id="tesver_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesver_comentario" id="tesver_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Robo </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesrob_fecha" readonly id="tesrob_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesrob_comentario" id="tesrob_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Normas </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesnor_fecha" readonly id="tesnor_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesnor_comentario" id="tesnor_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Soborno </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tessob_fecha" readonly id="tessob_fecha"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tessob_comentario" id="tessob_comentario"/>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Entrevista de Validación de Datos</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                               @if($custodio_confianza->valdat_fecha != null || $custodio_confianza->valdat_fecha != "")
                                                    <input type="text" class="form-control" readonly name="valdat_fecha" id="valdat_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->valdat_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" readonly name="valdat_fecha" id="valdat_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="valdat_comentario" id="valdat_comentario" value="{{ $custodio_confianza->valdat_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Verificación de Referencias Personales</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->verref_fecha != null || $custodio_confianza->verref_fecha != "")
                                                    <input type="text" class="form-control" readonly name="verref_fecha" id="verref_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->verref_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="verref_fecha" readonly id="verref_fecha"/>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verref_comentario" id="verref_comentario"  value="{{ $custodio_confianza->verref_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Verificación de Referencias Laborales</label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->verlab_fecha != null || $custodio_confianza->verlab_fecha != "")
                                                    <input type="text" class="form-control" readonly name="verlab_fecha" id="verlab_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->verlab_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="verlab_fecha" readonly id="verlab_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="verlab_comentario" id="verlab_comentario" value="{{ $custodio_confianza->verlab_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Análisis Socioeconómico Laboral </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->anasoc_fecha != null || $custodio_confianza->anasoc_fecha != "")
                                                    <input type="text" class="form-control" readonly name="anasoc_fecha" id="anasoc_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->anasoc_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="anasoc_fecha" readonly id="anasoc_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="anasoc_comentario" id="anasoc_comentario" value="{{ $custodio_confianza->anasoc_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Físico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->exafis_fecha != null || $custodio_confianza->exafis_fecha != "")
                                                    <input type="text" class="form-control" readonly name="exafis_fecha" id="exafis_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->exafis_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="exafis_fecha" readonly id="exafis_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exafis_comentario" id="exafis_comentario" value="{{ $custodio_confianza->exafis_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Médico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->examed_fecha != null || $custodio_confianza->examed_fecha != "")
                                                    <input type="text" class="form-control" readonly name="examed_fecha" id="examed_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->examed_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="examed_fecha" readonly id="examed_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="examed_comentario" id="examed_comentario" value="{{ $custodio_confianza->examed_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Psicológico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->exapsi_fecha != null || $custodio_confianza->exapsi_fecha != "")
                                                    <input type="text" class="form-control" readonly name="exapsi_fecha" id="exapsi_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->exapsi_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="exapsi_fecha" readonly id="exapsi_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exapsi_comentario" id="exapsi_comentario" value="{{ $custodio_confianza->exapsi_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Examen Toxicológico </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->exatox_fecha != null || $custodio_confianza->exatox_fecha != "")
                                                    <input type="text" class="form-control" readonly name="exatox_fecha" id="exatox_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->exatox_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="exatox_fecha" readonly id="exatox_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="exatox_comentario" id="exatox_comentario" value="{{ $custodio_confianza->exatox_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Veracidad </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->tesver_fecha != null || $custodio_confianza->tesver_fecha != "")
                                                    <input type="text" class="form-control" readonly name="tesver_fecha" id="tesver_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->tesver_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="tesver_fecha" readonly id="tesver_fecha" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesver_comentario" id="tesver_comentario" value="{{ $custodio_confianza->tesver_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Robo </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->tesrob_fecha != null || $custodio_confianza->tesrob_fecha != "")
                                                    <input type="text" class="form-control" readonly name="tesrob_fecha" id="tesrob_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->tesrob_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="tesrob_fecha" readonly id="tesrob_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesrob_comentario" id="tesrob_comentario" value="{{ $custodio_confianza->tesrob_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Normas </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->tesnor_fecha != null || $custodio_confianza->tesnor_fecha != "")
                                                    <input type="text" class="form-control" readonly name="tesnor_fecha" id="tesnor_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->tesnor_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="tesnor_fecha" readonly id="tesnor_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tesnor_comentario" id="tesnor_comentario" value="{{ $custodio_confianza->tesnor_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-2">
                                            <label>Test de Soborno </label>
                                        </div>
                                        <div class="col-lg-3">
                                            <label>Fecha de aplicación</label>
                                            <div class="input-group">
                                                @if($custodio_confianza->tessob_fecha != null || $custodio_confianza->tessob_fecha != "")
                                                    <input type="text" class="form-control" readonly name="tessob_fecha" id="tessob_fecha" value="{{ date('d/m/Y', strtotime($custodio_confianza->tessob_fecha))}}"/>
                                                @else
                                                    <input type="text" class="form-control" name="tessob_fecha" readonly id="tessob_fecha"/>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <label>Comentarios</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="tessob_comentario" id="tessob_comentario" value="{{ $custodio_confianza->tessob_comentario }}"/>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                    {{-- END Control de confianza --}}


                            <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                <table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentos">
                                    <thead>
                                    <tr>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Tipo de Documento</th>
                                        <th scope="col">Opción</th>
                                    </tr>
                                    </thead>
                                    <tbody id='tbodyDocumentos'>
                                        @foreach($documentos as $documento)
                                            <tr id="trDocumento{{ $documento->id }}">
                                                <td><a href="{{ route('archivo.documentocustodio', ['id'=>$documento->id]) }}" class="link-primary" target="_blank"> {{ $documento->documento }} </a></td>
                                                <td>{{ $documento->custodioDocumentacion->tipo_documento }}</td>
                                                <td>
                                                    <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarDocumento' data-id='{{ $documento->id }}' data-documento='{{ $documento->documento }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
                                                        <i class='flaticon-delete'></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                            <i class="flaticon2-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('custodio.listadocustodio') }}"  class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->



@endsection