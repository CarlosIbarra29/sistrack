@extends('layouts.app')
@push('scripts')
    <script src="{{ asset('js/tablero/ViajeProgramado.js') }}"></script>
    <script type="text/javascript"></script>
    {{-- <script src="jquery-3.2.1.min.js"></script> --}}

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
                        <div class="col-lg-12">
                            <h4>En camino a punto de origen</h4>
                        </div>
                    </div>


                    <div class="row ">
                        <div class="col-lg-12">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 14%; font-size: 14px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">10%</div>
                            </div>
                        </div>
                    </div>



                    <div class="row mt-4">
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
                                        <input type='file' class='custom-file-input' id='file_carga' name='file_carga[]'/>
                                        <label class='custom-file-label' for='foto"+contadorFotografia+"'>Selecciona un archivo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <button type="button"  id="btnGuardarfoto" class="btn btn-warning mr-2">Guardar</button>
                                    <button onclick="getLocation()">Try It</button>
                                </div>
                            </div>
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
                              <div class="col-lg-4">

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

                              <div class="col-lg-2">
                                <a href="#" class="btn btn-light-success font-weight-bold mt-2">Disponible</a>
                                <a href="#" class="btn btn-light-warning font-weight-bold mt-2">No disponible</a>   
                                <a href="#" class="btn btn-light-primary font-weight-bold mt-2">En viaje</a>       
                                <a href="#" class="btn btn-light-danger font-weight-bold mt-2">En taller</a>              
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

@endsection
