@extends('layouts.app')
@push('scripts')
	{{-- <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script> --}}
@endpush
@section('title')
    Información custodio
@endsection
@section('content')

<div class="card card-custom gutter-b">
	<div class="card-header">
		<div class="card-title">
			<h3 class="card-label">
				Información del custodio
			</h3>
		</div>
        <div class="card-toolbar">
				<a type="submit" href="{{ route('custodio.fichatecnica', $custodio->id) }}"   class="btn btn-outline-success">
	   	 			<i class="flaticon2-poll-symbol"></i> Ficha técnica
				</a>
        </div>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-lg-4">
                @if( $custodio->fotografia_custodio == "" || $custodio->fotografia_custodio == null)
                    <img src="/img/no_disponible.png" width="190">
                @else
                    <img src="{{ route('archivo.fotografiaCustodio', ['id'=>$custodio->id]) }}" width="290">
                @endif
			</div>
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-4 form-group">
                        <label>Nombre custodio</label>
                        <p>{{ $custodio->nombre_custodio }}</p>
					</div>
					<div class="col-lg-4 form-group">
                        <label>Correo electronico</label>
                        <p>{{ $custodio->correo_electronico }}</p>	
					</div>
					<div class="col-lg-4 form-group">
                        <label>Telefono</label>
                        <p>{{ $custodio->numero_telefono }}</p>	
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 form-group">
                        <label>CURP</label>
                        <p>{{ $custodio->curp }}</p>
					</div>
					<div class="col-lg-4 form-group">
                        <label>RFC</label>
                        <p>{{ $custodio->rfc }}</p>	
					</div>
					<div class="col-lg-4 form-group">
                        <label>Base</label>
                        <p>{{ $custodio->base }}</p>	
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

@if($custodio->op_vehiculo == 2)
	<div class="card card-custom gutter-b">
		<div class="card-header">
			<div class="card-title">
				<h3 class="card-label">
					Información del vehículo
				</h3>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="row">
						<div class="col-lg-6 form-group">
	                        <label>Nombre custodio</label>
	                        <p>{{ $vehiculo->vehiculo }}</p>
						</div>
						<div class="col-lg-6 form-group">
	                        <label>Correo electronico</label>
	                        <p>{{ $vehiculo->marca }}</p>	
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 form-group">
	                        <label>No. serie</label>
	                        <p>{{ $vehiculo->no_serie }}</p>
						</div>
						<div class="col-lg-6 form-group">
	                        <label>Placa</label>
	                        <p>{{ $vehiculo->placa }}</p>	
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 form-group">
	                        <label>Color</label>
	                        <p>{{ $vehiculo->color }}</p>
						</div>
						<div class="col-lg-6 form-group">
	                        <label>GPS</label>
	                        <p>{{ $vehiculo->no_gps }}</p>	
						</div>
					</div>
					<div  class="col-lg-12 form-group">
						<label>Observaciones</label>
						<p>{{ $vehiculo->observaciones }}</p>	
					</div>
				</div>
		        <div class="col-lg-8">
		            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
		              <div class="carousel-inner">

		                @foreach($fotografias as $documento)
		                <div class="carousel-item {{($ver == $documento->id) ? 'active' : ''}}">
		                  <img class="d-block w-100" src="{{ route('archivo.fotografiavehiculo', ['id'=>$documento->id]) }}" alt="Second slide">
		                </div>
		                @endforeach
		              </div>
		              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
		                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		                <span class="sr-only">Previous</span>
		              </a>
		              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
		                <span class="carousel-control-next-icon" aria-hidden="true"></span>
		                <span class="sr-only">Next</span>
		              </a>
		            </div>
		        </div>
			</div>
		</div>
	</div>
@endif

@endsection