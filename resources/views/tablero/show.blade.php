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


        
<div class="row mb-6">
    <div class="col-lg-12">
        <div class="org-header-card">
            <div class="org-content-wrapper">
                <div class="org-icon-main">
                    <i class="fas fa-sitemap"></i>
                </div>
                <div class="org-text-info">
                    <h2 class="org-title">Estructura Organizacional</h2>
                    <p class="org-description">Visualiza la estructura de las direcciones y sus áreas.</p>
                </div>
            </div>
            <!-- Decoración gráfica derecha -->
            <div class="org-visual-decor d-none d-md-block">
                <i class="fas fa-users-cog"></i>
            </div>
        </div>
    </div>
</div>


<div class="row">
    
    <div class="col-lg-6">
        <div class="dir-card-container">
            <div class="dir-card-header">
                <div class="d-flex align-items-center">
                    <div class="dir-icon-badge"><i class="fas fa-shield-alt"></i></div>
                    <h4 class="dir-label">DIRECCIÓN DE OPERACIONES</h4>
                </div>
                <div class="areas-badge">5 ÁREAS <i class="fas fa-chevron-down ml-1"></i></div>
            </div>
            
            <ul class="dir-menu-list">
                <li>
                    <a href="{{ route('programacion.listadoprogramacion') }}">
                        <i class="far fa-calendar-alt gold-icon"></i>
                        <span>Programación</span>
                        <i class="fas fa-chevron-right arrow-nav"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('monitoreo.listamonitoreo') }}">
                        <i class="fas fa-desktop gold-icon"></i>
                        <span>Monitoreo</span>
                        <i class="fas fa-chevron-right arrow-nav"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-map-marked-alt gold-icon"></i>
                        <span>Análisis de rutas</span>
                        <i class="fas fa-chevron-right arrow-nav"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-search-plus gold-icon"></i>
                        <span>Investigación de Incidentes</span>
                        <i class="fas fa-chevron-right arrow-nav"></i>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-tools gold-icon"></i>
                        <span>Mantenimiento</span>
                        <i class="fas fa-chevron-right arrow-nav"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    
    <div class="col-lg-6">
        <div class="dir-card-container">
            <div class="dir-card-header">
                <div class="d-flex align-items-center">
                    <div class="dir-icon-badge"><i class="fas fa-city"></i></div>
                    <h4 class="dir-label">DIRECCIÓN DE ADMINISTRACIÓN</h4>
                </div>
                <div class="areas-badge">11 ÁREAS <i class="fas fa-chevron-down ml-1"></i></div>
            </div>
            <!-- Se repite la misma estructura de <ul> que la anterior -->
            <ul class="dir-menu-list">
                <li><a href="#"><i class="fas fa-clipboard-check gold-icon"></i><span>Control de Servicios</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-user-edit gold-icon"></i><span>Admon de personal</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                 <li><a href="#"><i class="fas fa-search-plus gold-icon"></i><span>Reclutamiento y selección</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-user-friends gold-icon"></i><span>Capacitación y desarrollo</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-shopping-cart gold-icon"></i><span>Compras</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-bullhorn gold-icon"></i><span>Comercialización</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-file-invoice-dollar gold-icon"></i><span>Cuentas por Pagar</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-file-invoice gold-icon"></i><span>Facturación y Cobranza</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-comment-dots gold-icon"></i><span>Comunicación.</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-award gold-icon"></i><span>Gestión de calidad</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-dollar-sign gold-icon"></i><span>Finanzas</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <li><a href="#"><i class="fas fa-balance-scale gold-icon"></i><span>Legal</span><i class="fas fa-chevron-right arrow-nav"></i></a></li>
                <!-- ... agregar los demás campos del diseño ... -->
            </ul>
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

