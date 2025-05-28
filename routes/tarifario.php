<?php
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;


	// T A R I F A R I O
	Route::get('/listado-tarifario', [App\Http\Controllers\Tarifario\TarifarioController::class, 'listadodotarifario'])->name('tarifario.listadotarifario');
	Route::post('/tarifario-datatable', [App\Http\Controllers\Tarifario\TarifarioController::class, 'tarifariolistadodatatable'])->name('tarifario.tarifariolistadodatatable');
	Route::get('/agregar-tarifario', [App\Http\Controllers\Tarifario\TarifarioController::class, 'agregartarifario'])->name('tarifario.agregartarifario');
	Route::post('/guardar-tarifario', [App\Http\Controllers\Tarifario\TarifarioController::class, 'guardartarifario'])->name('tarifario.guardartarifario'); 
	Route::get('/editar-tarifario/{tarifario}', [App\Http\Controllers\Tarifario\TarifarioController::class, 'editartarifario'])->name('tarifario.editartarifario');
	Route::post('/update-tarifario', [App\Http\Controllers\Tarifario\TarifarioController::class, 'updatetarifario'])->name('tarifario.updatetarifario'); 
	Route::post('/desactivar-tarifario', [App\Http\Controllers\Tarifario\TarifarioController::class, 'desactivartarifario'])->name('tarifario.desactivartarifario');
	Route::get('/listado-tarifario-inactivos', [App\Http\Controllers\Tarifario\TarifarioController::class, 'listadotarifarioinactivo'])->name('tarifario.listadotarifarioinactivo');
	Route::post('/activar-tarifario', [App\Http\Controllers\Tarifario\TarifarioController::class, 'activartarifario'])->name('tarifario.activartarifario');
	Route::get('/ver-tarifario/{tarifario}', [App\Http\Controllers\Tarifario\TarifarioController::class, 'vertarifa'])->name('tarifario.vertarifa');