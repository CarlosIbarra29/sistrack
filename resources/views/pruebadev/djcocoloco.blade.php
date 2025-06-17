@extends('layouts.app')
@push('scripts')
	{{-- <script src="{{ asset('js/custodios/AgregarCustodio.js') }}"></script> --}}
@endpush
@section('title')
    pruebadev
@endsection
@section('content')



<div class="card card-custom">
	<div class="card-header">
		<div class="card-title">
            <span class="card-icon">
                <i class="flaticon2-chat-1 text-primary"></i>
            </span>
			<h3 class="card-label">
				<span>Estilo diferente</span>

			</h3>
		</div>
        <div class="card-toolbar">
            <a href="#" class="btn btn-sm btn-light-primary font-weight-bold">
                <i class="flaticon2-cube"></i> Settings
            </a>
        </div>
	</div>
	<div class="card-body">
        <div data-scroll="true" data-height="200">
			<span class="estilo">Estilo diferente</span>	
			<table class="table">
			    <thead>
			        <tr>
			            <th scope="col">#</th>
			            <th scope="col">First</th>
			            <th scope="col">Last</th>
			            <th scope="col">Status</th>
			        </tr>
			    </thead>
			    <tbody>
			        <tr>
			            <th scope="row">1</th>
			            <td>Nick</td>
			            <td>Stone</td>
			            <td>
			                <span class="label label-inline label-light-primary font-weight-bold">
			                    Pending
			                </span>
			            </td>
			        </tr>
			        <tr>
			            <th scope="row">2</th>
			            <td>Ana</td>
			            <td>Jacobs</td>
			            <td>
			                <span class="label label-inline label-light-success font-weight-bold">
			                    Approved
			                </span>
			            </td>
			        </tr>
			        <tr>
			            <th scope="row">3</th>
			            <td>Larry</td>
			            <td>Pettis</td>
			            <td>
			                <span class="label label-inline label-light-danger font-weight-bold">
			                    New
			                </span>
			            </td>
			        </tr>
			    </tbody>
			</table>
        </div>
	</div>
    <div class="card-footer d-flex justify-content-between">
        <a href="#" class="btn btn-light-primary font-weight-bold">Manage</a>
        <a href="#" class="btn btn-outline-secondary font-weight-bold">Learn more</a>
	</div>
</div>
@endsection