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

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProgramacionController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function listadodoprogramacion()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();
        $estatus_monitoreo = MonitoreoProgramacion::get();
        $programcion = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio', 'programacion.programacion_estatus_id', 'programacion.op_monitoreo_id',  'programacion.custodio_id')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->get();


        return view('programacion.listado-programacion', compact('data', 'programcion', 'estatus_monitoreo'));
    }

    public function programaciondatatable(Request $request)
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

    public function nuevaprogramacion()
    {
        $cliente = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();
        $custodio = Custodio::where('siaf_status', 1)->get();


        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($custodio as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_custodio. " ".$documento->ap_paterno. " ". $documento->ap_materno.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';


        return view('programacion.agregar-programacion', compact('cliente', 'tarifario', 'custodio', 'cadenaTipoDocumento'));
    }

    public function obtenertarifas(Request $request)
    {
        $tarifas = Tarifario::where('siaf_status', 1)->where('cliente_id', $request->id)->get();
        $cadena_tarifa = "";
        foreach ($tarifas as $tar) {
            $cadena_tarifa .= '"' . $tar->id . '":"' ."Origen: ". $tar->origen."- Destino: ".$tar->destino . '",';
        }
        $cadena_tarifa = '{' . rtrim($cadena_tarifa, ',') . '}';
        return response()->json(['success' => $cadena_tarifa]);
    }

    public function guardarprogramacion(Request $request)
    {
        $data = [
            'folio' => $this->folio->getFolioProgramacion(),
            'cliente_id' => $request->cliente_id,
            'tarifario_id' => $request->id_tarifa,
            'custodio_id' => $request->custodio_id,
            'programacion_estatus_id' => 1,
            'tipo_servicio' => $request->tipo_servicio,
            'fecha_servicio' => $request->fecha_hora,
            'acompanantes'=> $request->op_custodios,
            'dom_origen' => $request->dom_origen,
            'dom_destino' => $request->dom_destino,
            // 'observaciones' => $request->observaciones,
            'op_monitoreo_id' => $request->op_monitoreo_id,
            'siaf_status' =>1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];

        $id_programacion= Programacion::insertGetId($data);

        $colIdDocumento = $request->id_documento;
        if($request->op_custodios == 0){
            foreach($request->id_documento as $indice => $archivo)
            {
                $data = [
                    'programacion_id' => $id_programacion,
                    'custodio_id' =>$colIdDocumento[$indice],
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s')
                ];

                AcompanantesProgramacion::insert($data);
            }
        }


        session()->flash('success', 'La programación se creo correctamente');
        return redirect()->route('programacion.listadoprogramacion');

    }

    public function editarprogramacion($id_programacion)
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


        return view('programacion.editar-programacion', compact('cliente', 'tarifario', 'custodio', 'cadenaTipoDocumento', 'programacion', 'acompanantes_pro', 'id_programacion'));       
    }

    public function eliminarcustodioprogramacion(Request $request)
    {
        $doc = AcompanantesProgramacion::findOrFail($request->id);
        $estatus = true;
        if ($doc){

            AcompanantesProgramacion::where('id', $request->id)->delete();
        }else{
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);       
    }

    public function modificarprogramacion(Request $request)
    {
        $data = [
            'cliente_id' => $request->cliente_id,
            'tarifario_id' => $request->id_tarifa,
            'custodio_id' => $request->custodio_id,
            'tipo_servicio' => $request->tipo_servicio,
            'fecha_servicio' => $request->fecha_hora,
            'acompanantes'=> $request->op_custodios,
            'dom_origen' => $request->dom_origen,
            'dom_destino' => $request->dom_destino,
            // 'observaciones' => $request->observaciones,
            'op_monitoreo_id' => $request->op_monitoreo_id,
            'siaf_status' =>1,
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserUpdated' =>auth()->user()->id,
        ];

        Programacion::where('id', $request->id_programacion)->update($data);

        $colIdDocumento = $request->id_documento;
        if($request->op_custodios == 0){
            if($request->id_documento){
                foreach($request->id_documento as $indice => $archivo)
                {
                    $data = [
                        'programacion_id' => $request->id_programacion,
                        'custodio_id' =>$colIdDocumento[$indice],
                        'created_at' =>date('Y-m-d H:i:s'),
                        'updated_at' =>date('Y-m-d H:i:s')
                    ];

                    AcompanantesProgramacion::insert($data);
                }
            }
        }


        session()->flash('success', 'La programación se modifico correctamente');
        return redirect()->route('programacion.listadoprogramacion');
    }

    public function deasactivarprogramacion(Request $request)
    {
        $data = [
            'siaf_status' => 2,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];  
        Programacion::where('id', $request->id)->update($data);

        session()->flash('success', 'La programación se desactivo correctamente');
        return redirect()->route('programacion.listadoprogramacion');
    }

    public function programacioninactivas()
    {
        $programacion = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 2)
            ->get();      
        // dd($programacion);
        return view('programacion.listado-programacion-inactivas', compact('programacion'));  
    }

    public function activarprogramacion(Request $request)
    {
        $data = [
            'siaf_status' => 1,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];  
        Programacion::where('id', $request->id)->update($data);

        session()->flash('success', 'La programación se activo correctamente');
        return redirect()->route('programacion.programacioninactivas');        
    }

    public function verprogramacion($id_programacion)
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

        $incidencias = MonitoreoIncidencias::where('programacion_id', $id_programacion)->get();
        $observaciones = ProgramacionObservacion::where('programacion_id', $id_programacion)->get();

        return view('programacion.ver-programacion', compact('cliente', 'tarifario', 'custodio', 'cadenaTipoDocumento', 'programacion', 'acompanantes_pro', 'id_programacion', 'incidencias', 'observaciones'));           
    }

    public function updatemonitoreoajax(Request $request)
    {
        $data = [
            'op_monitoreo_id' =>  $request->id,
            'iduserUpdated' =>auth()->user()->id,
            'updated_at' =>date('Y-m-d H:i:s')
        ];

        Programacion::where('id', $request->id_programacio)->update($data);

        return response()->json(['success']);  
    }

    public function guardarobservacion(Request $request)
    {

            $data = [
                'programacion_id' => $request->id,
                'observacion' => $request->observacion,
                'created_at' =>date('Y-m-d H:i:s'),
                'updated_at' =>date('Y-m-d H:i:s'),
                'iduserCreated' =>auth()->user()->id,
                'iduserUpdated' =>auth()->user()->id,
            ];

            ProgramacionObservacion::insert($data);

            session()->flash('success', 'La observación se creo correctamente');
            return redirect()->route('programacion.listadoprogramacion');
    }

    public function eliminarobservacion(Request $request)
    {

            ProgramacionObservacion::where('id', $request->id)->delete();

            session()->flash('success', 'La observación se elimino correctamente');
            return redirect()->route('programacion.verprogramacion', $request->id_programacion);

    }

    public function editarobservacion(Request $request)
    {

        $data = [
            'observacion' => $request->observacion,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];

        ProgramacionObservacion::where('id', $request->id)->update($data);

            session()->flash('success', 'La observación se edito correctamente');
            return redirect()->route('programacion.verprogramacion', $request->id_programacion);

    }

}