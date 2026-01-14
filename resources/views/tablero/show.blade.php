@extends('layouts.app')
@section('title')
    Tablero
@endsection
@push('scripts')
	<script src="{{ asset('js/tablero/Notificaciones.js') }}"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
  <script type="text/javascript">
  var ctx = document.getElementById('myChartpedidos').getContext('2d');
  var myChartpedidos = new Chart(ctx, {
      type: 'bar',
      data: {
          labels:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          datasets: [{
              label: 'Viajes realizados:',
              data: [2, 1, 2, 3, 5, 2, 2, 7, 6, 4, 9],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(160, 255, 97, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(160, 255, 97, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(153, 102, 255, 1)',

              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });
  </script>
@endpush
@section('content')
@php
@endphp

<style type="text/css">
  .oculto{
    display: none;
  }
</style>


<div class="oculto">
  <img  class="brand-logo" width="970" src="{{ asset('img/Completo_contitulo.png') }}" /> 
</div>




<div class="row mt-2">
  <div class="col-lg-9">
    <div class="card card-custom">
      <div class="card-header">
        <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-delivery-truck"></i>
                </span>
          <h3 class="card-label">
            Viajes programados
          </h3>
        </div>

      </div>
      <div class="card-body">
        <table class="table table-hover table-checkable" id="kdatatable_agencias_inactivas">
            <thead>
            <tr>
              {{-- <th>No.</th> --}}
              <th>Domicilio Origen</th>
              <th>Domicilio Destino</th>
              <th>Fecha y hora</th>
              <th>Estatus</th>
              <th class="text-center">Opciones</th>
            </tr>
            </thead>
              @foreach($programcion as $unid)
                <tr>
                   {{-- <td>{{ $unid->id }}</td> --}}
                  <td>{{ $unid->dom_origen }}</td>
                  <td>{{ $unid->dom_destino }}</td>
                  <td>{{ $unid->fecha_servicio }}</td>
                  <td>
                    <span class="label font-weight-bold  label-outline label-inline" style="color: green; border: 1px solid green !important">Programado</span>
                  </td>

                  <td class="text-center">
                    <a href="{{ route('tablero.viajeprogramado', $unid->id) }}"><i class="flaticon-eye"></i></a>
                    <button class="btn btn-sm btn-clean btn-hover-icon-success btn-icon activar-agencia" data-toggle="modal" data-target="#kt_modal_1" data-id="{{ $unid->id }}" data-nombre="{{ $unid->razon_social }}" data-toggle="tooltip" data-theme="dark" title="Ver viaje" ></button>
                  </td>
                </tr>
              @endforeach
            <tbody>

            </tbody>

        </table>
      </div>

    </div>

  </div>


  <div class="col-lg-3">
    <div class="card card-custom">
      <div class="card-header">
        <div class="card-title">
                <span class="card-icon">
                    <i class="flaticon2-chart text-primary"></i>
                </span>
          <h3 class="card-label">
            Mis viajes
          </h3>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12 text-center">
            <img  class="brand-logo" width="120" src="{{ asset('img/grafica.jpg') }}" id="mis_viajes"/>
          </div>
        </div> 
      </div>

    </div>
  </div>

</div>


<div class="row mt-3" id="div_mis_viajes">
  <div class="col-lg-12">
    <div class="card card-custom">
      <div class="card-header">
        <div class="card-title">

          <h3 class="card-label">
            Mis viajes
          </h3>
        </div>

      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-custom">
              <div class="card-header">
                <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-chat-1 text-primary"></i>
                        </span>
                  <h3 class="card-label">
                    <small>Información</small>
                  </h3>
                </div>

              </div>
              <div class="card-body">

                <table class="table">

                    <tbody>
                        <tr>
                            
                            <td>Total de viajes</td>
                            <td><span style="font-size: 19px; font-weight: bold;">43</span></td>

                        </tr>

                    </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="col-lg-8">
            <canvas id="myChartpedidos" style="width: 100px;"></canvas> 
          </div>
        </div>
      </div>

    </div>
  </div>
</div>



{{-- M O D A L S --}}
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm" aria-hidden="true" id="kt_modal_1">
      <div class="modal-dialog  modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Información del viaje</h5>
                  <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                      <span class="svg-icon svg-icon-2x"></span>
                  </div>
              </div>

              <div class="modal-body">
                <form  method="post" id="submit_estatus">
                @csrf
                  <div class="row ">
                    <div class="col-lg-12">
                      <div class="progress">
                          <div class="progress-bar" role="progressbar" style="width: 14%; font-size: 14px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">10%</div>
                      </div>
                    </div>
                  </div>


                    <div class="row">
                      <div class="col-lg-6">
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
                      <div class="col-lg-6">
                        <div class="card card-custom">
                          <div class="card-header">
                            <div class="card-title">
                              <h3 class="card-label">
                                Bitacora
                              </h3>
                            </div>
                          </div>
                          <div class="card-body">
                            ...
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
                                <img  class="brand-logo" width="450" src="{{ asset('img/img_custodio.jpg') }}" /> 
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

                </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn btn-secondary font-weight-bold" data-dismiss="modal"><i class="la la-times"></i>Cerrar</button>
                {{-- <button type="button" id="send_estatus" class="btn btn-success"><i class="la la-plus"></i>Guardar</button> --}}
              </div>
          </div>
      </div>
  </div>

{{--     @if (in_array("110", Session::get('permisos')))

    <div class="d-flex flex-row">

    <div class="flex-row-fluid">
        <div class="d-flex flex-column flex-grow-1">

            <div class="row">
                <div class="col-xl-8">

                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                              <span class="card-icon">
                                <i class="flaticon2-file text-primary"></i>
                              </span>
                              <h3 class="card-label">Tablero</h3>
                            </div>
                        </div>
                        <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-line">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1">Notificaciones <span class="badge badge-square badge-warning"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2">Mensajes</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5" id="myTabContent">
                            <div class="tab-pane fade show active mt-10" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
								<div class="py-5">
								 <div class="table-responsive">
								  <table class="table table-row-dashed table-row-gray-300 gy-7" id="kdatatable_notificaciones">
								   <thead>
								    <tr class="fw-bold fs-6 text-gray-800">
								     <th>No.</th>
								     <th>Modulo</th>
								     <th>Notificación</th>
								     <th>Fecha de notificación</th>
								     <th>Modificó</th>
								     <th>Opción</th>
								    </tr>
								   </thead>
								   <tbody>
	                                  @foreach($not as $unid)
                                    <tr>
                                      <td>{{ $unid->id }}</td>
                                      <td>
                                        @if($unid->modulo_id == 1)
                                            <p>Usuarios</p>
                                        @endif
                                        @if($unid->modulo_id == 2)
                                            <p>Concursos</p>
                                        @endif
                                      </td>
                                      <td>{{ $unid->notificacion }}</td>
                                      <td>{{ $unid->fecha_notificacion }}</td>
                                      <td>{{ $unid->usermodifico->name }}</td>

                                      <td class="text-center">

                                        @if($unid->modulo_id == 2)
                                            <a href="{{ route('tablero.vernotconcurso', $unid->licitaciones_id) }}" class="btn btn-clean btn-icon btn-outline-success mt-1" data-id="{{ $unid->id }}" data-toggle="tooltip" data-theme="dark" title="Ver Notificación" ><i class="flaticon-eye"></i></a>
                                        @endif

                                        
                                      </td>
                                    </tr>
                                  @endforeach
								   </tbody>
								  </table>
								 </div>
								</div>                
                            </div>
                            <div class="tab-pane fade mt-10" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>

                <div class="col-xl-4">

                    <div class="card card-custom">
                        <div class="card-header">
                            <div class="card-title">
                              <span class="card-icon">
                                <i class="flaticon2-file text-primary"></i>
                              </span>
                              <h3 class="card-label"></h3>
                            </div>
                        </div>
                        <div class="card-body">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


    @endif --}}
@endsection

