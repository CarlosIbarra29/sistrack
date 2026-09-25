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
use App\Models\Notificaciones\Notificaciones;

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
        $role = auth()->user()->role;
        if($role == 17){
    	   $data = Programacioncliente::where('iduserCreated', auth()->user()->id)->get();
        }else{
            $data = Programacioncliente::orderBy('created_at', 'desc')->get();
        }

    
		return view('programacion.cliente.listaservicios', compact('data', 'role') );	
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
            'estatus' => 0,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];  
         // dd($data);
        // Programacioncliente::insert($data);
        $id_programacion = Programacioncliente::insertGetId($data);

        $resumen = $request->direccion_origen. "/ ".$request->direccion_destino. ", Fecha de servicio: ".$request->fechahora_servicio;
        $data_notificacion = [
            'modulo_notificacion' => "Servicio Cliente",
            'resumen' => $resumen,
            'estatus' => 0,
            'op_modulo' => 0,
            'siaf_status_id' => 1,
            'programacion_cliente_id' => $id_programacion,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        Notificaciones::insert($data_notificacion);


        session()->flash('success', 'El servicio se creo correctamente');
        return redirect()->route('procli.nuevoservicio'); 
    }

    public function verservicio($id_servicio)
    {
        $data = Programacioncliente::where('id', $id_servicio)->first();

        return view('programacion.cliente.verservicio', compact('data'));
    }

    public function complementarservicio($id_servicio)
    {
        $data = Programacioncliente::where('id', $id_servicio)->first();
        $custodio = Custodio::where('siaf_status', 1)->get();
        $cliente = Cliente::where('siaf_status', 1)->get();
        $estatus_programacion_data = EstatusProgramacion::where('estatus_activo', 1)
                    ->where('estatus_pgr', 1)
                    ->get();
        $cadenaTipoDocumento = "";
        foreach($custodio as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_custodio. " ".$documento->ap_paterno. " ". $documento->ap_materno.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        return view('programacion.cliente.complementoservicio', compact('data', 'custodio', 'cliente', 'estatus_programacion_data', 'cadenaTipoDocumento'));
    }
}