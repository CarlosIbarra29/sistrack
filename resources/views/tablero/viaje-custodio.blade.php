@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/tablero/ViajeProgramado.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
@endpush
@section('title')
    Viaje programado
@endsection
@section('content')
<style type="text/css">
    .oculto{
        display: none;
    }
</style>
<!--begin::Card-->
<div class="row">
    <div class="col-lg-12">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <h3 class="card-title">Viaje programdo</h3>
            </div>
            <!--begin::Form-->
       
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12 text-right">
                            @if($estatus_viaje->estatus_viaje_id == 1)
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_camino_punto_origen">En punto de origen</button>
                            @endif

                            @if($estatus_viaje->estatus_viaje_id == 2)
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_punto_origen_op_uno">En camino a punto de origen</button>
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_punto_origen_op_dos">En viaje</button>
                            @endif


                            @if($estatus_viaje->estatus_viaje_id == 3)
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_viaje_op_uno">En punto de origen</button>
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_viaje_op_dos">En punto de destino</button>
                            @endif


                            @if($estatus_viaje->estatus_viaje_id == 4)
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_punto_destino_op_uno">En viaje</button>
                                <button class="btn btn-light-primary font-weight-bold mt-2" id="en_punto_destino_op_dos">En destino</button>
                            @endif


                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                            @if($estatus_viaje->estatus_viaje_id == 1)
                                <h4>En camino a punto de origen</h4>
                            @endif
                            @if($estatus_viaje->estatus_viaje_id == 2)
                                <h4>En punto de origen</h4>
                            @endif
                            @if($estatus_viaje->estatus_viaje_id == 3)
                                <h4>En viaje</h4>
                            @endif
                            @if($estatus_viaje->estatus_viaje_id == 4)
                                <h4>En punto de destino</h4>
                            @endif

                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-lg-12">
                            <div class="progress">
                                @if($estatus_viaje->estatus_viaje_id == 1)
                                    <div class="progress-bar" role="progressbar" style="width: 5%; font-size: 14px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif

                                @if($estatus_viaje->estatus_viaje_id == 2)
                                    <div class="progress-bar" role="progressbar" style="width: 22%; font-size: 14px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif

                                @if($estatus_viaje->estatus_viaje_id == 3)
                                    <div class="progress-bar" role="progressbar" style="width: 42%; font-size: 14px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif

                                @if($estatus_viaje->estatus_viaje_id == 4)
                                    <div class="progress-bar" role="progressbar" style="width: 72%; font-size: 14px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <div class="row">
                                @if($estatus_viaje->estatus_viaje_id == 1)
                                    <div class="col-lg-6 text-center"><button class="btn btn-warning font-weight-bold mt-2">Demorado</button></div>
                                    <div class="col-lg-6 text-center"><button class="btn btn-warning font-weight-bold mt-2">Viaje Cancelado</button></div>
                                @endif

                                @if($estatus_viaje->estatus_viaje_id == 2)
                                    <div class="col-lg-6 text-center"><button class="btn btn-warning font-weight-bold mt-2">Retraso de inicio</button></div>
                                    <div class="col-lg-6 text-center"><button class="btn btn-warning font-weight-bold mt-2">Cambio de operador</button></div>
                                @endif

                                @if($estatus_viaje->estatus_viaje_id == 4)
                                    <div class="col-lg-4 text-center"><button class="btn btn-warning font-weight-bold mt-2">Demora en descarga</button></div>
                                    <div class="col-lg-4 text-center"><button class="btn btn-warning font-weight-bold mt-2">Cambio de destino</button></div>
                                    <div class="col-lg-4 text-center"><button class="btn btn-warning font-weight-bold mt-2">Reinicio viaje</button></div>
                                @endif

                            </div>
                        </div>
                        @if($estatus_viaje->estatus_viaje_id == 3)
                            <div class="row">
                                    
                                        <div class="col-lg-2 text-center"><button class="btn btn-warning font-weight-bold mt-2">Averia / accidente vehiculo transporte</button></div>
                                        <div class="col-lg-2 text-center"><button class="btn btn-warning font-weight-bold mt-2">Averia / accidente vehiculo custodio</button></div>
                                        <div class="col-lg-2 text-center"><button class="btn btn-warning font-weight-bold mt-2">Retén policial / bloqueo</button></div>
                                        <div class="col-lg-2 text-center"><button class="btn btn-warning font-weight-bold mt-2">Parada / pernocta</button></div>
                                        <div class="col-lg-2 text-center"><button class="btn btn-warning font-weight-bold mt-2">Cambio de destino</button></div>
                                        <div class="col-lg-2 text-center"><button class="btn btn-warning font-weight-bold mt-2">Reinicio de viaje</button></div>
                                    
                            </div>
                        @endif

                    </div>

                    <div class="row mt-4">

                      <div class="col-lg-4">
                        <div class="card card-custom">
                          <div class="card-header">
                            <div class="card-title">
                              <h3 class="card-label">
                                Cámara
                              </h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label>Fotografía</label>
                                    <div class='custom-file'>
                                        <form action="{{ route('tablero.evidenciabitacora') }}" method="post" id="submit_evidencia_bitacora"  enctype="multipart/form-data">
                                        @csrf
                                            <input type='file' class='custom-file-input' id='file_carga' name='file_carga[]'/>
                                            <label class='custom-file-label' for='foto"+contadorFotografia+"'>Selecciona un archivo</label>
                                            <input type="hidden" name="latitude" id="latitude" value="">
                                            <input type="hidden" name="longitude" id="longitude" value="">
                                            <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <button type="button" onclick="getLocation()"  id="btnGuardarfoto" class="btn btn-warning mr-2">Guardar</button>
                                    
                                </div>
                            </div>
                          </div>

                        </div>

                      </div>

                      <div class="col-lg-8">
                        <div class="card card-custom">
                          <div class="card-header">
                            <div class="card-title">
                              <h3 class="card-label">
                                Información del viaje
                              </h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <table class="table table-hover table-checkable" id="kdatatable_agencias_inactivas">
                                <thead>
                                <tr>
                                  <th>Cliente</th>
                                  <th>Domicilio Origen</th>
                                  <th>Domicilio Destino</th>
                                  <th>Fecha y hora</th>
                                  <th>Estatus</th>
                                </tr>
                                </thead>
                                  @foreach($programcion as $unid)
                                    <tr>
                                       <td>{{ $unid->razon_social }}</td>
                                      <td>{{ $unid->dom_origen }}</td>
                                      <td>{{ $unid->dom_destino }}</td>
                                      <td>{{ $unid->fecha_servicio }}</td>
                                      <td>
                                        <span class="label font-weight-bold  label-outline label-inline" style="color: green; border: 1px solid green !important">Programado</span>
                                      </td>
                                    </tr>
                                  @endforeach
                                <tbody>

                                </tbody>

                            </table>
                          </div>

                        </div>
                      </div>


                    </div>




                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card card-custom">
                          <div class="card-header">
                            <div class="card-title">
                              <h3 class="card-label">
                                Detralle del vehiculo
                              </h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-6">
                                <img  class="brand-logo" width="430" src="{{ asset('img/img_custodio.jpg') }}" /> 
                              </div>
                              <div class="col-lg-6">

                                <table class="table">

                                    <tbody>
                                        <tr>
                                            <td>Marca</td>
                                            <td><span style="font-size: 15px; font-weight: bold;">Nissan</span></td>
                                        </tr>
                                        <tr>
                                            <td>Modelo</td>
                                            <td><span style="font-size: 15px; font-weight: bold;">Sentra</span></td>
                                        </tr>
                                        <tr>
                                            <td>Año</td>
                                            <td><span style="font-size: 15px; font-weight: bold;">2020</span></td>
                                        </tr>
                                        <tr>
                                            <td>Placas</td>
                                            <td><span style="font-size: 15px; font-weight: bold;">HFC-3345</span></td>
                                        </tr>
                                    </tbody>
                                </table>                                
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-2">
                                <a href="#" class="btn btn-light-success font-weight-bold mt-2">Disponible</a>       
                              </div>
                              <div class="col-lg-2">
                                <a href="#" class="btn btn-light-warning font-weight-bold mt-2">No disponible</a>  
                              </div>
                              <div class="col-lg-2">
                                <a href="#" class="btn btn-light-primary font-weight-bold mt-2">En viaje</a>
                              </div>
                              <div class="col-lg-2">
                                  <a href="#" class="btn btn-light-danger font-weight-bold mt-2">En taller</a> 
                              </div>
                            </div>
                            

                          </div>

                        </div>

                      </div>
                    </div>


                    <div class="row mt-3">
                      <div class="col-lg-12">
                        <div class="card card-custom">
                          <div class="card-header">
                            <div class="card-title">
                              <h3 class="card-label">
                                Bitacora
                              </h3>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-lg-12">
                                <table class="table table-hover" id="bitacora_info">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="oculto">Id</th>
                                            <th>Imagen</th>
                                            <th>Personal</th>
                                            <th>Horario de carga</th>
                                            <th>Estatus</th>
                                            <th>Coordenadas</th>
                                            <th>Mapa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bitacora_viaje as $documento)
                                            <tr>
                                                <td class="oculto">{{ $documento->id }}</td>
                                                <td>
                                                    <a href="{{ route('archivo.bitacoraviaje', ['id'=>$documento->id]) }}"
                                                       class="font-weight-bold text-primary"
                                                       target="_blank">
                                                        {{ $documento->estatusViaje->estatus_viaje }}
                                                    </a>
                                                    
                                                </td>
                                                <td>{{ $documento->userCreated->name }}</td>
                                                <td>{{ $documento->created_at }}</td>
                                                <td>{{ $documento->estatusViaje->estatus_viaje }}</td>
                                                <td>{{ $documento->latitude }}, {{ $documento->longitude }}</td>
                                                <td>  <a
    href="https://www.google.com/maps/dir//{{ $documento->latitude }},{{ $documento->longitude }}/{{ $documento->latitude }},{{ $documento->longitude }}"
    target="_blank"
  >Mapa</a>




                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input type="hidden" id="datatable_i18n" value="{{ asset('/js/datatables/i18n/es-mx.json') }}">
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>       
                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="{{ route('tablero.show') }}"  class="btn btn-secondary">Regresar</a>
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

  <form method="post" id="cambio_estatus" action="{{ route('tablero.viajecambiostatus') }}" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" id="id_programacion" value="{{ $id_programacion }}">
    <input type="hidden" name="estatus" value="{{ $estatus_viaje->estatus_viaje_id  }}">
    <input type="hidden" id="op_estatus" name="op_estatus" value="">
  </form>



@endsection
