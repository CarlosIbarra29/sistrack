<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;

	// P R O G R A M A C I O N
	Route::get('/listado-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'listadodoprogramacion'])->name('programacion.listadoprogramacion');
	Route::post('/programacion-datatable', [App\Http\Controllers\Programacion\ProgramacionController::class, 'programaciondatatable'])->name('programacion.programaciondatatable');
	Route::get('/nueva-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'nuevaprogramacion'])->name('programacion.nuevaprogramacion');
	Route::post('/obtener-tarifas', [App\Http\Controllers\Programacion\ProgramacionController::class, 'obtenertarifas'])->name('programacion.obtenertarifas');
	Route::post('/guardar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'guardarprogramacion'])->name('programacion.guardarprogramacion'); 
	Route::get('/editar-programacion/{id}', [App\Http\Controllers\Programacion\ProgramacionController::class, 'editarprogramacion'])->name('programacion.editarprogramacion');
	Route::post('/eliminar-custodio-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'eliminarcustodioprogramacion'])->name('programacion.eliminarcustodioprogramacion');
	Route::post('/modificar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'modificarprogramacion'])->name('programacion.modificarprogramacion');
	Route::post('/desactivar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'deasactivarprogramacion'])->name('programacion.deasactivarprogramacion');
	Route::get('/catalogo-programacion-inactivos', [App\Http\Controllers\Programacion\ProgramacionController::class, 'programacioninactivas'])->name('programacion.programacioninactivas');
	Route::post('/activar-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'activarprogramacion'])->name('programacion.activarprogramacion');
	Route::get('/ver-programacion/{id}', [App\Http\Controllers\Programacion\ProgramacionController::class, 'verprogramacion'])->name('programacion.verprogramacion');
	Route::post('/update-monitoreo-ajax', [App\Http\Controllers\Programacion\ProgramacionController::class, 'updatemonitoreoajax'])->name('programacion.updatemonitoreoajax');
	Route::post('/guardar-observacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'guardarobservacion'])->name('programacion.guardarobservacion');
	Route::post('/eliminar-observacion-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'eliminarobservacion'])->name('programacion.eliminarobservacion'); 
	Route::post('/editar-observacion-programacion', [App\Http\Controllers\Programacion\ProgramacionController::class, 'editarobservacion'])->name('programacion.editarobservacion'); 

	// M O N I T O R E O
	Route::get('/listado-monitoreo', [App\Http\Controllers\Programacion\MonitoreoController::class, 'listadomonitoreo'])->name('monitoreo.listamonitoreo');
	Route::post('/monitoreo-datatable', [App\Http\Controllers\Programacion\MonitoreoController::class, 'monitoreodatatable'])->name('monitoreo.monitoreodatatable');	
	Route::get('/modulo-estadias/{id}', [App\Http\Controllers\Programacion\MonitoreoController::class, 'moduloestadias'])->name('monitoreo.moduloestadias');
	Route::post('/guardar-estadia', [App\Http\Controllers\Programacion\MonitoreoController::class, 'guardarestadia'])->name('monitoreo.guardarestadia'); 
	Route::get('/info-estatuspro/{id}', [App\Http\Controllers\Programacion\MonitoreoController::class, 'infoestatuspro'])->name('monitoreo.verprogramacionmon');
	Route::post('/update-estatus', [App\Http\Controllers\Programacion\MonitoreoController::class, 'updateestatus'])->name('monitoreo.updateestatus');
	Route::post('/update-estatus-ajax', [App\Http\Controllers\Programacion\MonitoreoController::class, 'updateestatusajax'])->name('monitoreo.updateestatusajax');
	Route::post('/guardar-incidencia', [App\Http\Controllers\Programacion\MonitoreoController::class, 'guardarincidencia'])->name('monitoreo.guardarincidencia'); 