<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;

	//  C L I E N T E
		Route::get('/listado-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'listadocliente'])->name('cliente.listadocliente');
		Route::post('/clientes-datatable', [App\Http\Controllers\Cliente\ClienteController::class, 'clientelistadodatatable'])->name('cliente.clientelistadodatatable');
		Route::get('/agregar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'agregarcliente'])->name('cliente.agregarcliente');
		Route::post('/guardar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'guardarcliente'])->name('cliente.guardarcliente'); 
		Route::get('/editar-cliente/{cliente}', [App\Http\Controllers\Cliente\ClienteController::class, 'editarcliente'])->name('cliente.editarcliente');
		Route::post('/eliminar-contacto-operativo', [App\Http\Controllers\Cliente\ClienteController::class, 'eliminarcontactooperativo'])->name('cliente.eliminarcontactooperativo');
		Route::post('/eliminar-contacto-facturacion', [App\Http\Controllers\Cliente\ClienteController::class, 'eliminarcontactofacturacion'])->name('cliente.eliminarcontactofacturacion');
		Route::post('/update-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'updatecliente'])->name('cliente.updatecliente'); 
		Route::post('/desactivar-cliente-list', [App\Http\Controllers\Cliente\ClienteController::class, 'desactivarcliente'])->name('cliente.desactivarclientelistado');
		Route::get('/listado-clientes-inactivos', [App\Http\Controllers\Cliente\ClienteController::class, 'listadoclienteinactivo'])->name('cliente.listadoclienteinactivo');
		Route::post('/activar-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'activarcliente'])->name('cliente.activarcliente');
		Route::get('/ver-cliente/{cliente}', [App\Http\Controllers\Cliente\ClienteController::class, 'vercliente'])->name('cliente.vercliente');
		Route::post('/eliminar-documento-cliente', [App\Http\Controllers\Cliente\ClienteController::class, 'eliminardocumentocliente'])->name('cliente.eliminardocumentocliente');

    //Listado de Tipo de Documentos
        Route::get('/catalogo-documentos', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'catalogoDocumentos'])->name('doccliente.catalogoDocumentos');
        Route::post('/documentos-datatable', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'municipiosdatatable'])->name('doccliente.municipiosdatatable');
        Route::post('/guardar-tipo-documento', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'guardartipodocumento'])->name('doccliente.guardartipodocumento');
        Route::post('/editar-tipo-documento', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'editartipoDocumento'])->name('doccliente.editartipoDocumento');
        Route::post('/desactivar-documento', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'eliminartipoDocumento'])->name('doccliente.eliminartipoDocumento');
        Route::get('/catalogo-tipodocumentos-inactivos', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'catalogoetipodocumentosinactivos'])->name('doccliente.tipodocumentosinactivos');
        Route::post('/activar-tipo-documento', [App\Http\Controllers\Cliente\DocumentosClienteController::class, 'activartipodocumento'])->name('doccliente.activartipodocumento');