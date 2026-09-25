<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Folio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Models\Notificaciones\Notificaciones;
use App\Models\Programacion\Programacioncliente;

class NotificacionesController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio) {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function catalogonotificaciones()
    {

    	$notificaciones = Notificaciones::where('siaf_status_id', 1)->get();

        return view('notificaciones.listado-notificaciones', compact('notificaciones')); 
    }

    public function vernotificacionservcliente($id_notificacion)
    {
    	$notificaciones = Notificaciones::where('id', $id_notificacion)->first();
    	$data = Programacioncliente::where('id', $notificaciones->programacion_cliente_id)->first();

    	return view('notificaciones.not-serviciocliente', compact('notificaciones', 'data')); 

    }

    public function marcarleidosercliente(Request $request)
    {
        $data = [
            'estatus' => 1,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];  

        Notificaciones::where('id', $request->id)->update($data);

        session()->flash('success', 'La notificación se marco como leída correctamente');
    	return redirect()->route('notificaciones.vernotificacionservcliente', $request->id);
    }
}