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
use App\Models\Programacion\DatosMonitoreoProgramacion;
use App\Models\Programacion\MonitoreoIncidencias;
use App\Models\Programacion\ProgramacionObservacion;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MonitoreoController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function listadomonitoreo()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();
        $estatus_programacion = EstatusProgramacion::get();

        $monitoreo = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio', 'programacion.programacion_estatus_id', 'programacion.op_monitoreo_id',  'programacion.custodio_id')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->get();


        return view('monitoreo.listado-monitoreo', compact('data', 'monitoreo', 'estatus_programacion'));
    }

    public function monitoreodatatable(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $permisos = RolPermiso::where('role_id', $user->role)->get();
        $permiso_array = array();
        foreach ($permisos as $key => $value) {
            $permiso_array[] = $value->permission_id;
        }

        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Programacion::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Programacion::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();

        /* Getting the first element of the array. */
        $order_arr = $columnIndex_arr[0];

        /* Getting the column index of the column that is being sorted. */
        $order_column_index = $order_arr['column'];

        /* Getting the direction of the sort. */
        $order_dir = $order_arr['dir'];

        /* Getting the column name from the array of columns. */
        $order_column_name = $columnName_arr[$order_column_index]['data'];
        $order_column_dir = $order_dir;

        $order_column_dir = $order_column_dir == 'asc' ? 'asc' : 'desc';


        // Fetch records

        $records = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->orderBy($order_column_name, $order_column_dir)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='name'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
                    ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
                    ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
                    ->where('programacion.siaf_status', 1)
                    ->where("programacion.cliente_id", $valor)
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }
        }

        if($valor == "No"){
            $records = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->orderBy($order_column_name, $order_column_dir)
            ->skip($start)
            ->take($rowperpage)
            ->get();
        }else{
            $totalRecords = count($records);
            $totalRecordswithFilter = count($records);          
        }

        $data_arr = array();
        $pro="";
        foreach($records as $record){

            $data_arr[] = array(
                "id" => $record->id,
                "folio" => $record->folio,
                "tipo_servicio" => $record->tipo_servicio,
                "estatus_programacion" => $record->estatus_programacion,
                "nombre_cliente" => $record->nombre_cliente,
                "dom_origen" => $record->dom_origen,
                "dom_destino" => $record->dom_destino,
                "fecha_servicio" => $record->fecha_servicio,
                'acciones'=>null,
            );
        }

        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response);
    }

    public function moduloestadias($id_programacion)
    {
        
        $programacion = Programacion::where('id', $id_programacion)->first();
        $estadias_info = EstadiasProgramacion::where('programacion_id', $id_programacion)->first();
        if($estadias_info == null) { $op_estadia = 0; }else{ $op_estadia = 1; }
        $estatus_programacion = EstatusProgramacion::get();

        return view('monitoreo.crear-estadias', compact('programacion', 'estadias_info', 'op_estadia', 'estatus_programacion', 'id_programacion'));
    }

    public function guardarestadia(Request $request)
    {

        if($request->op_estadias == 0){
            $data = [
                'programacion_id' => $request->id_programacion,
                'nombre_conductor' => $request->nombre_conductor,
                'linea_transportistas' => $request->linea_transportista,
                'telefono' => $request->telefono,
                'placas' => $request->placas,
                'generales_unidad' => $request->observaciones,
                'fechahora_llegada_custodio' => $request->fechahora_llegada_custodio,
                'fechahora_inicio_trayecto' => $request->fechahora_inicio_trayecto,
                'fechahora_llegado_destino'=> $request->fechahora_llegado_destino,
                'fechahora_finalizacion' => $request->fechahora_finalizacion,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
                'iduserCreated' =>auth()->user()->id,
                'iduserUpdated' =>auth()->user()->id,
            ];

            EstadiasProgramacion::insert($data);

            session()->flash('success', 'La estadia se creo correctamente');
            return redirect()->route('monitoreo.listamonitoreo');

        }else{
            $data = [
                'programacion_id' => $request->id_programacion,
                'nombre_conductor' => $request->nombre_conductor,
                'linea_transportistas' => $request->linea_transportista,
                'telefono' => $request->telefono,
                'placas' => $request->placas,
                'generales_unidad' => $request->observaciones,
                'fechahora_llegada_custodio' => $request->fechahora_llegada_custodio,
                'fechahora_inicio_trayecto' => $request->fechahora_inicio_trayecto,
                'fechahora_llegado_destino'=> $request->fechahora_llegado_destino,
                'fechahora_finalizacion' => $request->fechahora_finalizacion,
                'updated_at' =>date('Y-m-d H:i:s'),
                'iduserUpdated' =>auth()->user()->id,
            ];

            EstadiasProgramacion::where('programacion_id', $request->id_programacion)->update($data);

            session()->flash('success', 'La estadia se modifico correctamente');
            return redirect()->route('monitoreo.listamonitoreo');
        }
    }

    public function infoestatuspro($id_programacion)
    {
        $cliente = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();
        $custodio = Custodio::where('siaf_status', 1)->get();
        $programacion = Programacion::where('id', $id_programacion)->first();
        $acompanantes_pro = AcompanantesProgramacion::where('programacion_id', $id_programacion)->get();
        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($custodio as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_custodio. " ".$documento->ap_paterno. " ". $documento->ap_materno.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';
        $estatus_programacion = EstatusProgramacion::get();

        $incidencias = MonitoreoIncidencias::where('programacion_id', $id_programacion)->get(); 
        $observaciones = ProgramacionObservacion::where('programacion_id', $id_programacion)->get();


        return view('monitoreo.info-proestatus', compact('cliente', 'tarifario', 'custodio', 'cadenaTipoDocumento', 'programacion', 'acompanantes_pro', 'id_programacion', 'estatus_programacion', 'incidencias', 'observaciones')); 
    }

    public function updateestatus(Request $request)
    {
        $data = [
            'programacion_estatus_id' => $request->estatus_id,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];  
        Programacion::where('id', $request->id_programacion)->update($data);

        session()->flash('success', 'El estatus de la programación se modifico correctamente');
        return redirect()->route('monitoreo.listamonitoreo'); 
    }

    public function updateestatusajax(Request $request)
    {
        $data = [
            'programacion_estatus_id' =>  $request->id,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];

        Programacion::where('id', $request->id_programacio)->update($data);

        return response()->json(['success']);
    }

    public function guardarincidencia(Request $request)
    {


            $data = [
                'programacion_id' => $request->id,
                'incidencia' => $request->incidencia,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
                'iduserCreated' =>auth()->user()->id,
                'iduserUpdated' =>auth()->user()->id,
            ];

            MonitoreoIncidencias::insert($data);

            session()->flash('success', 'La incidencia se creo correctamente');
            return redirect()->route('monitoreo.listamonitoreo');

    }


}