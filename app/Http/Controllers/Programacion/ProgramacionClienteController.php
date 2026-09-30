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
        $role = auth()->user()->role;
        
        if($role == 17){
           $user = auth()->user()->id;
        }else{
            $user = User::where('role', 17)->get();
        }


    	return view('programacion.cliente.nuevoservicio', compact('user', 'role'));
    }

    public function guardarserviciocliente(Request $request)
    {

        $role = auth()->user()->role;
        if($role == 17){
           $user = auth()->user()->id;
        }else{
            $user = $request->user_id;
        }

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
            'iduserCreated' => $user,
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

        $cliente = Cliente::where('siaf_status', 1)->get();
        // $tarifario = Tarifario::where('siaf_status', 1)->get();
        $custodio = Custodio::where('siaf_status', 1)->get();
        $estatus_programacion_data = EstatusProgramacion::where('estatus_activo', 1)->where('estatus_pgr', 1)->get();


        if($data->programacion_id == null ){
            $programacion = ""; 
            $acompanantes_pro ="";
        }else{
            $programacion = Programacion::where('id', $data->programacion_id)->first();
            $acompanantes_pro = AcompanantesProgramacion::where('programacion_id', $programacion->id)->get();
        }
        // dd($data);
        return view('programacion.cliente.verservicio', compact('data', 'cliente', 'custodio', 'programacion', 'acompanantes_pro', 'estatus_programacion_data'));
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

    public function addcomplementarservicio(Request $request)
    {



            $clienteId = $request->cliente_id;

            $sinCustodio = ((int) $request->custodio_id === 153);

            $custodioEmergente = ((int) $request->custodio_id === 154);

            if ($sinCustodio) {

                $estatusCustodio = 1;

            } elseif ($custodioEmergente) {

                $estatusCustodio = -1;

            } else {

                $estatusCustodio = 0;
            }

            if ((int) $request->cliente_id === 0) {

                $razonSocial = trim(
                    $request->nuevo_cliente_razon_social
                );

                $nuevoCliente = Cliente::create([
                    'num_list' => $this->folio->getFolioCliente(),
                    'razon_social' => $razonSocial,
                    'nombre_cliente' => $razonSocial,
                    'siaf_status' => 1,
                    'iduserCreated' => auth()->user()->id,
                    'iduserUpdated' => auth()->user()->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                $clienteId = $nuevoCliente->id;
            }

            $data = [

                'folio' => $this->folio->getFolioProgramacion(),
                'cliente_id' => $clienteId,
                'folio_interno' => $request->filled('folio_interno') ? trim($request->folio_interno) : null,
                'custodio_id' => $request->custodio_id,
                'estatus_custodio' => $estatusCustodio,
                // 'tarifario_id' => 1,
                'programacion_estatus_id' =>$request->programacion_id,
                'tipo_servicio' =>$request->tipo_servicio,
                'fecha_servicio' =>$request->fecha_hora,
                'acompanantes' =>$sinCustodio ? 1 : $request->op_custodios,
                'dom_origen' =>$request->dom_origen,
                'dom_destino' =>$request->dom_destino,
                'observaciones' =>$request->observaciones,
                'armado_servicio' =>$request->armado_servicio,
                'op_monitoreo_id' => 1,
                'estatus_viaje_id' => 1,
                'siaf_status' => 1,
                'custodio_emergente' => $custodioEmergente ? trim($request->custodio_emergente) : null,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
                'iduserCreated' =>auth()->user()->id,
                'iduserUpdated' =>auth()->user()->id,
            ];
             // dd($data);
            // Insertamos la programación.
            $id_programacion = Programacion::insertGetId($data);


             // ACOMPAÑANTES
            if (!$sinCustodio &&(int) $request->op_custodios === 0 && !empty($request->id_documento)) {

                $colIdDocumento = $request->id_documento;

                foreach ($colIdDocumento as $indice => $custodioId) {

                    $dataAcompanante = [
                        'programacion_id' =>$id_programacion,
                        'custodio_id' =>$custodioId,
                        'created_at' =>date('Y-m-d H:i:s'),
                        'updated_at' =>date('Y-m-d H:i:s'),
                    ];

                    AcompanantesProgramacion::insert($dataAcompanante);
                }
            }

            // DB::commit();


        $data = [
            'programacion_id' => $id_programacion,
            // 'estatus' => 1,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];  

        Programacioncliente::where('id', $request->id_servicio_cliente)->update($data);


        session()->flash('success', 'La programación se modifico correctamente');
        return redirect()->route('procli.listaservicios');

    }


    public function editarservicio($id_programacion)
    {
        // dd($id_programacion);
        $cliente = Cliente::where('siaf_status', 1)->get();
        // $tarifario = Tarifario::where('siaf_status', 1)->get();
        $custodio = Custodio::where('siaf_status', 1)->get();
        $programacion = Programacion::where('id', $id_programacion)->first();
        $acompanantes_pro = AcompanantesProgramacion::where('programacion_id', $id_programacion)->get();
        $estatus_programacion_data = EstatusProgramacion::where('estatus_activo', 1)->where('estatus_pgr', 1)->get();
        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($custodio as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_custodio. " ".$documento->ap_paterno. " ". $documento->ap_materno.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';


        return view('programacion.cliente.editarservicio', compact('cliente', 'custodio', 'cadenaTipoDocumento', 'programacion', 'acompanantes_pro', 'id_programacion','estatus_programacion_data'));   

    }

    public function editaratendida(Request $request)
    {
        $data = [
            'estatus' => 1,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];  

        Programacioncliente::where('id', $request->id)->update($data);

        session()->flash('success', 'La programación se modifico correctamente');
        return redirect()->route('procli.listaservicios');
    }

}