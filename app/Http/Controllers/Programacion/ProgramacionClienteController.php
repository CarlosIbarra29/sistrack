<?php

namespace App\Http\Controllers\Programacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Services\Folio;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente\Cliente;
use App\Models\Custodio\Custodio;
use App\Models\Tarifario\Tarifario;
use App\Models\Programacion\Programacion;
use App\Models\Programacion\AcompanantesProgramacion;
use App\Models\Programacion\EstatusProgramacion;
use App\Models\Programacion\FolioProgramacion;
use App\Models\Programacion\EstadiasProgramacion;
use App\Models\Programacion\MonitoreoProgramacion;
use App\Models\Programacion\MonitoreoIncidencias;
use App\Models\Programacion\ProgramacionObservacion;
use App\Models\Programacion\Programacioncliente;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProgramacionClienteController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function listaservicios()
    {
		return view('programacion.cliente.listaservicios');	
    }

    public function nuevoservicio()
    {
    	return view('programacion.cliente.nuevoservicio');
    }

    public function guardarserviciocliente(Request $request)
    {

        $data = [
            'ubicacion_origen' => $request->ubicacion_origen,
            'direccion_origen' => $request->direccion_origen,
            'ubicacion_destino' => $request->ubicacion_destino,
            'direccion_destino' => $request->direccion_destino,
            'fechahora_servicio' => $request->fechahora_servicio,
            'armada' => $request->armada,
            'linea_transporte' => $request->linea_transporte,
            'nombre_operador' => $request->nombre_operador,
            'placas' => $request->placas,
            'numero_telefono' => $request->numero_telefono,
            'observaciones' => $request->observaciones,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];  

        Programacioncliente::insert($data);

        session()->flash('success', 'El servicio se creo correctamente');
        return redirect()->route('procli.nuevoservicio'); 
    }
}