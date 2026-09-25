<?php  
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Http;


		// Listado de Notificaciones
		Route::get('/catalogo-notificaciones', [App\Http\Controllers\NotificacionesController::class, 'catalogonotificaciones'])->name('notificaciones.catalogonotificaciones');
		Route::get('/ver-notificacion/{id}', [App\Http\Controllers\NotificacionesController::class, 'vernotificacionservcliente'])->name('notificaciones.vernotificacionservcliente');
		Route::post('/marcar-leido', [App\Http\Controllers\NotificacionesController::class, 'marcarleidosercliente'])->name('notificaciones.marcarleidosercliente');