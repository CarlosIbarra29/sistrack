<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;


	// D O C U M E N T A C I O N   C U S T O D I O
		Route::get('/listado-documentacion', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'listadodoccustodio'])->name('doccustodio.listadodoccustodio');
		Route::post('/documentos-datatable', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'documentoscustodiodatatable'])->name('doccustodio.documentosdatatable');
		Route::post('/guardar-documento', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'guardardocumento'])->name('doccustodio.guardardocumento');
		Route::post('/editar-documento', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'editardocumento'])->name('doccustodio.editardocumento');
		Route::post('/desactivar-documento', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'desactivardocumento'])->name('doccustodio.desactivardocumento');
		Route::get('/catalogo-documento-inactivos', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'catalogodocinactivos'])->name('doccustodio.catalogodocinactivos');
		Route::post('/activar-documento', [App\Http\Controllers\Custodio\DocumentacionCustodioController::class, 'activardocumento'])->name('doccustodio.activardocumento');

	// D O C U M E N T A C I O N   V E H I C U L O   C U S T O D I O
		Route::get('/listado-doc-vehiculo', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'listadodocvehiculo'])->name('docvehiculo.listadodocvehiculo');
		Route::post('/documentosvehiculo-datatable', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'documentosvehiculodatatable'])->name('docvehiculo.vehiculodatatable');
		Route::post('/guardar-documento-vehiculo', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'guardardocumentovehiculo'])->name('docvehiculo.guardardocumentovehiculo');
		Route::post('/editar-documento-vehiculo', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'editardocumentovehiculo'])->name('docvehiculo.editardocumentovehiculo');
		Route::post('/desactivar-documento-vehiculo', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'desactivardocumentovehiculo'])->name('docvehiculo.desactivardocumentovehiculo');
		Route::get('/catalogo-documentovehiculos-inactivos', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'catalogodocvehiculoinactivos'])->name('docvehiculo.catalogodocvehiculoinactivos');
		Route::post('/activar-documento-vehiculo', [App\Http\Controllers\Custodio\DocumentacionVehiculoController::class, 'activardocumentovehiculo'])->name('docvehiculo.activardocumentovehiculo');

	// D O C U M E N T A C I O N   A R M A   C U S T O D I O
		Route::get('/listado-doc-arma', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'listadodocarma'])->name('docarma.listadodocarma');
		Route::post('/documentosarma-datatable', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'documentosarmadatatable'])->name('docarma.armadatatable');
		Route::post('/guardar-documento-arma', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'guardardocumentoarma'])->name('docarma.guardardocumentoarma');
		Route::post('/editar-documento-arma', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'editardocumentoarma'])->name('docarma.editardocumentoarma');
		Route::post('/desactivar-documento-arma', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'desactivardocumentoarma'])->name('docarma.desactivardocumentoarma');
		Route::get('/catalogo-documentoarma-inactivos', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'catalogodocarmainactivos'])->name('docarma.catalogodocarmainactivos');
		Route::post('/activar-documento-arma', [App\Http\Controllers\Custodio\DocumentacionArmaController::class, 'activardocumentoarma'])->name('docarma.activardocumentoarma');


	// L I S T A D O  D E  C U S T O D I O S
		Route::get('/listado-custodios', [App\Http\Controllers\Custodio\CustodioController::class, 'listadocustodio'])->name('custodio.listadocustodio');
		Route::post('/custodio-datatable', [App\Http\Controllers\Custodio\CustodioController::class, 'custodiodatatable'])->name('custodio.custodiodatatable');
		Route::get('/agregar-custodio', [App\Http\Controllers\Custodio\CustodioController::class, 'agregarcustodio'])->name('custodio.agregarcustodio');
		Route::post('/guardar-custodio', [App\Http\Controllers\Custodio\CustodioController::class, 'guardarcustodio'])->name('custodio.guardarcustodio');
		Route::get('/editar-custodio/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'editarcustodio'])->name('custodio.editarcustodio');
		Route::post('/eliminar-documento-custodio', [App\Http\Controllers\Custodio\CustodioController::class, 'eliminardocumentocustodio'])->name('custodio.eliminardocumentocustodio');
		Route::post('/guardar-edicion-custodio', [App\Http\Controllers\Custodio\CustodioController::class, 'updatecustodio'])->name('custodio.updatecustodio');
		Route::get('/agregar-informacion-vehiculo/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'agregarvehiculo'])->name('custodio.agregarvehiculo');
		Route::post('/guardar-info-vehiculo', [App\Http\Controllers\Custodio\CustodioController::class, 'guardarinfovehiculo'])->name('custodio.guardarinfovehiculo');
		Route::get('/editar-informacion-vehiculo/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'editarvehiculo'])->name('custodio.editarvehiculo');
		Route::post('/eliminar-documento-vehiculo', [App\Http\Controllers\Custodio\CustodioController::class, 'eliminardocumentovehiculo'])->name('custodio.eliminardocumentovehiculo');
		Route::post('/eliminar-fotografia-vehiculo', [App\Http\Controllers\Custodio\CustodioController::class, 'eliminarfotografia'])->name('custodio.eliminarfotografia');
		Route::post('/editar-info-vehiculo', [App\Http\Controllers\Custodio\CustodioController::class, 'editinfovehiculo'])->name('custodio.editinfovehiculo');
		Route::get('/ver-custodio/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'vercustodio'])->name('custodio.vercustodio');
		Route::post('/desactivar-custodio', [App\Http\Controllers\Custodio\CustodioController::class, 'desactivarcustodio'])->name('custodio.desactivarcustodio');
		Route::get('/listado-custodio-inactivos', [App\Http\Controllers\Custodio\CustodioController::class, 'listadocustodioinactivo'])->name('custodio.listadocustodioinactivo');
		Route::post('/activar-custodio', [App\Http\Controllers\Custodio\CustodioController::class, 'activarcustodio'])->name('custodio.activarcustodio');
		Route::get('/fichatecnica-custodio/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'fichatecnica'])->name('custodio.fichatecnica');
		Route::get('/agregar-informacion-arma/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'agregararma'])->name('custodio.agregararma');
		Route::post('/guardar-info-arma', [App\Http\Controllers\Custodio\CustodioController::class, 'guardarinfoarma'])->name('custodio.guardarinfoarma');
		Route::get('/editar-informacion-arma/{custodio}', [App\Http\Controllers\Custodio\CustodioController::class, 'editararma'])->name('custodio.editararma');
		Route::post('/editar-info-arma', [App\Http\Controllers\Custodio\CustodioController::class, 'editinfoarma'])->name('custodio.editinfoarma');
		Route::post('/eliminar-documento-arma', [App\Http\Controllers\Custodio\CustodioController::class, 'eliminardocumentoarma'])->name('custodio.eliminardocumentoarma');
		Route::post('/eliminar-fotografia-arma', [App\Http\Controllers\Custodio\CustodioController::class, 'eliminarfotografiaarma'])->name('custodio.eliminarfotografiaarma');
