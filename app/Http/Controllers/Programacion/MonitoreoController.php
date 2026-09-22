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
use App\Models\Programacion\Estatusitinerario;

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
        $estatus_programacion = EstatusProgramacion::where('estatus_activo', 1)
                    ->where('estatus_monitoreo', 1)
                    ->get();

        $estatus_itinerario = Estatusitinerario::where('activo', 1)
        ->orderBy('id')
        ->get();

        $monitoreo = Programacion::select('programacion.id',
                                            'programacion.folio',
                                            'programacion.folio_interno',
                                            'programacion.tipo_servicio',
                                            'programacion.armado_servicio',
                                            'programacion.custodio_emergente',
                                            'pe.estatus_programacion',
                                            'cli.nombre_cliente',
                                            'programacion.dom_origen',
                                            'programacion.dom_destino',
                                            'programacion.fecha_servicio',
                                            'programacion.programacion_estatus_id',
                                            'programacion.op_monitoreo_id',
                                            'programacion.custodio_id',
                                            'programacion.estatus_custodio',

                                            'pd.fechahora_llegada_custodio',
                                            'pd.fechahora_inicio_trayecto',
                                            'pd.fechahora_llegado_destino',
                                            'pd.fechahora_finalizacion',

                                            'pd.estatus_itinerario',

                                            'ei.descripcion as puntualidad_descripcion',
                                            'ei.value as puntualidad_causa')
            ->with(['custodio','acompanantesProgramacion.custodio'])
            ->leftJoin('programacion_estatus as pe','pe.id','=','programacion.programacion_estatus_id')
            ->leftJoin('cliente as cli','cli.id','=','programacion.cliente_id')
            ->leftJoin('programacion_estadias as pd','pd.programacion_id','=','programacion.id')
            ->leftJoin('estatus_itinerario as ei','ei.id','=','pd.estatus_itinerario')
            ->where('programacion.siaf_status', 1)
            ->where('programacion.programacion_estatus_id', '<>', 7)
            ->orderByDesc('programacion.estatus_custodio')
            ->orderBy('programacion.fecha_servicio', 'asc')
            ->get();


        return view('monitoreo.listado-monitoreo', compact('data', 'monitoreo', 'estatus_programacion','estatus_itinerario'));
    }


    public function listadomonitoreofinalizado()
    {
        $data = Cliente::where('siaf_status', 1)->get();

        $tarifario = Tarifario::where('siaf_status', 1)->get();

        $estatus_programacion = EstatusProgramacion::where('estatus_activo', 1)
            ->where('estatus_monitoreo', 1)
            ->get();

        $estatus_itinerario = Estatusitinerario::where('activo', 1)
            ->orderBy('id')
            ->get();

        $monitoreo = Programacion::select('programacion.id','programacion.folio','programacion.folio_interno','programacion.tipo_servicio','programacion.armado_servicio','programacion.custodio_emergente','pe.estatus_programacion','cli.nombre_cliente','programacion.dom_origen','programacion.dom_destino','programacion.fecha_servicio','programacion.programacion_estatus_id','programacion.op_monitoreo_id','programacion.custodio_id','programacion.estatus_custodio','pd.fechahora_llegada_custodio','pd.fechahora_inicio_trayecto','pd.fechahora_llegado_destino','pd.fechahora_finalizacion','pd.estatus_itinerario','ei.descripcion as puntualidad_descripcion','ei.value as puntualidad_causa'
            )
            ->with(['custodio','acompanantesProgramacion.custodio'])
            ->leftJoin('programacion_estatus as pe','pe.id','=','programacion.programacion_estatus_id')
            ->leftJoin('cliente as cli','cli.id','=','programacion.cliente_id')
            ->leftJoin('programacion_estadias as pd','pd.programacion_id','=','programacion.id')
            ->leftJoin('estatus_itinerario as ei','ei.id','=','pd.estatus_itinerario')
            ->where('programacion.siaf_status', 1)

            // Únicamente finalizados
            ->where('programacion.programacion_estatus_id', 7)

            ->orderBy('programacion.fecha_servicio', 'desc')
            ->get();

        return view(
            'monitoreo.listado-monitoreo-finalizado',
            compact(
                'data',
                'monitoreo',
                'estatus_programacion',
                'estatus_itinerario'
            )
        );
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
        $programacion = Programacion::where('id', $id_programacion)->firstOrFail();
        $estadias_info = EstadiasProgramacion::where('programacion_id',$id_programacion)->first();
        $op_estadia = $estadias_info === null ? 0 : 1;
        $estatus_programacion = EstatusProgramacion::orderBy('estatus_programacion')->get();
        $estatus_itinerario = Estatusitinerario::where('activo', 1)->orderBy('id')->get();

        $clientes = Cliente::where('siaf_status',1)
        ->orderBy('nombre_cliente')
        ->get();

        $custodios = Custodio::where('siaf_status',1)
        ->orderBy('nombre_custodio')
        ->get();

        $acompanantes_ids = AcompanantesProgramacion::where('programacion_id',$id_programacion)
        ->pluck('custodio_id')
        ->map(function ($id) {
            return (int) $id;
        })
        ->toArray();

        return view(
            'monitoreo.crear-estadias',
            compact(
                'programacion',
                'estadias_info',
                'op_estadia',
                'estatus_programacion',
                'clientes',
                'custodios',
                'acompanantes_ids',
                'id_programacion',
                'estatus_itinerario'
            )
        );
    }

    public function guardarestadia(Request $request)
    {
        $request->validate([
            'id_programacion' => 'required|integer',

            'programacion_estatus_id' => 'nullable|integer',
            'custodio_id' => 'nullable|integer',
            'tipo_servicio' => 'nullable|in:0,1',
            'fecha_servicio' => 'nullable|date',

            'dom_origen' => 'nullable|string',
            'dom_destino' => 'nullable|string',

            'armado_servicio' => 'nullable|integer',

            'observaciones_programacion' => 'nullable|string',

            'linea_transportista' => 'nullable|string',
            'nombre_conductor' => 'nullable|string',
            'telefono' => 'nullable',
            'placas' => 'nullable|string',
            'observaciones' => 'nullable|string',

            'fechahora_llegada_custodio' => 'nullable|date',
            'fechahora_inicio_trayecto' => 'nullable|date',
            'fechahora_llegado_destino' => 'nullable|date',
            'fechahora_finalizacion' => 'nullable|date',
            'estatus_itinerario' => 'nullable|integer',

            'acompanantes_ids' => 'nullable|array',
            'acompanantes_ids.*' => 'nullable|integer'
        ]);

        DB::beginTransaction();

        try {

            $programacion = Programacion::where( 'id',$request->id_programacion)->firstOrFail();

            $acompanantesIds = collect($request->input( 'acompanantes_ids',[]))
            ->filter(function ($id) {
                return $id !== null && $id !== '';
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->filter(function ($id) use ($request) {

                if (!$request->filled('custodio_id')) {
                    return true;
                }

                return $id !== (int) $request->custodio_id;

            })
            ->unique()
            ->values();

            $dataProgramacion = [];

            if ($request->filled('programacion_estatus_id')) {
                $dataProgramacion['programacion_estatus_id'] = $request->programacion_estatus_id;
            }


            if ($request->filled('custodio_id')) {
                $dataProgramacion['custodio_id'] = $request->custodio_id;
            }

            if ($request->filled('custodio_id')) {
                $dataProgramacion['custodio_id'] = $request->custodio_id;

                $dataProgramacion['estatus_custodio'] = (int) $request->custodio_id === 153 ? 1 : 0;
            }


            if ($request->has('tipo_servicio') && $request->tipo_servicio !== null && $request->tipo_servicio !== ''
            ) {

                $dataProgramacion['tipo_servicio'] = $request->tipo_servicio;
            }


            if ($request->filled('fecha_servicio')) {

                $dataProgramacion['fecha_servicio'] =
                    Carbon::parse(
                        $request->fecha_servicio
                    )->format('Y-m-d H:i:s');

            }

            if ($request->filled('dom_origen')) {
                $dataProgramacion['dom_origen'] = $request->dom_origen;
            }

            if ($request->filled('dom_destino')) {
                $dataProgramacion['dom_destino'] =$request->dom_destino;
            }

            if ($request->filled('armado_servicio')) {
                $dataProgramacion['armado_servicio'] = $request->armado_servicio;
            }

            if ($request->has('observaciones_programacion')) {
                $dataProgramacion['observaciones'] =  $request->observaciones_programacion;
            }

            if ((int) $request->custodio_id === 153) { 
                $dataProgramacion['acompanantes'] = 1;
            } elseif ($request->has('acompanantes_ids')) { 
                $dataProgramacion['acompanantes'] = $acompanantesIds->isNotEmpty() ? 0 : 1;
            }

            if (!empty($dataProgramacion)) {

                $dataProgramacion['updated_at'] =  date('Y-m-d H:i:s');

                $dataProgramacion['iduserUpdated'] =  auth()->user()->id;

                Programacion::where( 'id', $request->id_programacion)->update( $dataProgramacion );
            }


            if ($request->has('acompanantes_ids') ||(int) $request->custodio_id === 153) {

                AcompanantesProgramacion::where('programacion_id',$request->id_programacion)->delete();

                if ((int) $request->custodio_id !== 153) {

                    foreach ($acompanantesIds as $custodioId) {

                        AcompanantesProgramacion::insert([
                            'programacion_id' =>$request->id_programacion,
                            'custodio_id' =>$custodioId,
                            'created_at' =>date('Y-m-d H:i:s'),
                            'updated_at' =>date('Y-m-d H:i:s')
                        ]);

                    }

                }
            }

            $dataEstadia = [

                'programacion_id' =>$request->id_programacion,
                'nombre_conductor' =>$request->nombre_conductor ?: null,
                'linea_transportistas' =>$request->linea_transportista ?: null,
                'telefono' =>$request->telefono ?: null,
                'placas' =>$request->placas ?: null,
                'generales_unidad' =>$request->observaciones ?: null,
                'fechahora_llegada_custodio' =>$request->fechahora_llegada_custodio ?: null,
                'fechahora_inicio_trayecto' =>$request->fechahora_inicio_trayecto ?: null,
                'fechahora_llegado_destino' =>$request->fechahora_llegado_destino ?: null,
                'fechahora_finalizacion' =>$request->fechahora_finalizacion ?: null,
                'estatus_itinerario' => $request->filled('estatus_itinerario') ? $request->estatus_itinerario : null,
                'updated_at' => date('Y-m-d H:i:s'),
                'iduserUpdated' => auth()->user()->id

            ];


            if ((int) $request->op_estadias === 0) {

                $dataEstadia['created_at'] =date('Y-m-d H:i:s');
                $dataEstadia['iduserCreated'] = auth()->user()->id;

                EstadiasProgramacion::insert( $dataEstadia);
                $mensaje ='La información del servicio se agregó correctamente';


            } else {

                EstadiasProgramacion::where( 'programacion_id', $request->id_programacion )->update($dataEstadia);
                $mensaje = 'La información del servicio se modificó correctamente';

            }


            DB::commit();

            session()->flash('success',$mensaje);

            if ((int) $request->programacion_estatus_id === 7) {

                return redirect()->route(
                    'monitoreo.listamonitoreofinalizado'
                );
            }

            return redirect()->route('monitoreo.listamonitoreo');

        } catch (\Throwable $e) {

    DB::rollBack();

    dd([
        'mensaje' => $e->getMessage(),
        'archivo' => $e->getFile(),
        'linea' => $e->getLine()
    ]);
}
    }

    // public function infoestatuspro($id_programacion)
    // {
    //     $cliente = Cliente::where('siaf_status', 1)->get();
    //     $tarifario = Tarifario::where('siaf_status', 1)->get();
    //     $custodio = Custodio::where('siaf_status', 1)->get();
    //     $programacion = Programacion::where('id', $id_programacion)->first();
    //     $acompanantes_pro = AcompanantesProgramacion::where('programacion_id', $id_programacion)->get();
    //     //tipo de documentos en formato json
    //     $cadenaTipoDocumento = "";
    //     foreach($custodio as $documento){
    //         $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_custodio. " ".$documento->ap_paterno. " ". $documento->ap_materno.'",';
    //     }
    //     $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';
    //     $estatus_programacion = EstatusProgramacion::get();

    //     $incidencias = MonitoreoIncidencias::where('programacion_id', $id_programacion)->get(); 
    //     $observaciones = ProgramacionObservacion::where('programacion_id', $id_programacion)->get();


    //     return view('monitoreo.info-proestatus', compact('cliente', 'tarifario', 'custodio', 'cadenaTipoDocumento', 'programacion', 'acompanantes_pro', 'id_programacion', 'estatus_programacion', 'incidencias', 'observaciones')); 
    // }

    public function infoestatuspro($id_programacion)
    {
        $cliente = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();
        $custodio = Custodio::where('siaf_status', 1)->get();
        $programacion = Programacion::where('id', $id_programacion)->firstOrFail();
        $acompanantes_pro = AcompanantesProgramacion::where('programacion_id',$id_programacion)->get();

        $estadias_info = EstadiasProgramacion::where('programacion_id',$id_programacion)->first();

        $puntualidad_info = null;

        if ($estadias_info &&!empty($estadias_info->estatus_itinerario)) {
            $puntualidad_info = Estatusitinerario::where('id',$estadias_info->estatus_itinerario )->first();
        }


        $cadenaTipoDocumento = "";

        foreach ($custodio as $documento) {

            $cadenaTipoDocumento .=
                '"' .
                $documento->id .
                '":"' .
                $documento->nombre_custodio .
                " " .
                $documento->ap_paterno .
                " " .
                $documento->ap_materno .
                '",';
        }

        $cadenaTipoDocumento ='{' .rtrim($cadenaTipoDocumento, ',') .'}';
        $estatus_programacion = EstatusProgramacion::get();
        $incidencias =MonitoreoIncidencias::where('programacion_id',$id_programacion)->get();
        $observaciones = ProgramacionObservacion::where('programacion_id', $id_programacion)->get();


        return view('monitoreo.info-proestatus', compact('cliente','tarifario','custodio','cadenaTipoDocumento','programacion','acompanantes_pro', 'id_programacion', 'estatus_programacion','incidencias','observaciones','estadias_info','puntualidad_info'));
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
        if ((int) $request->estatus_id === 7) {
            return redirect()->route('monitoreo.listamonitoreofinalizado');
        }
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

    public function updatefechaestadiasajax(Request $request)
    {
        $camposPermitidos = [
            'fechahora_llegada_custodio',
            'fechahora_inicio_trayecto',
            'fechahora_llegado_destino',
            'fechahora_finalizacion'
        ];

        if (!in_array($request->campo, $camposPermitidos)) {

            return response()->json([
                'success' => false,
                'message' => 'Campo no permitido'
            ], 422);
        }

        $estadia = EstadiasProgramacion::where('programacion_id',$request->id_programacion)->first();

        if (!$estadia) {
            $estadia = new EstadiasProgramacion();
            $estadia->programacion_id = $request->id_programacion;
            $estadia->iduserCreated = auth()->user()->id;
            $estadia->created_at = date('Y-m-d H:i:s');
        }

        $estadia->{$request->campo} =
            $request->filled('valor')
                ? $request->valor
                : null;

        $estadia->iduserUpdated = auth()->user()->id;
        $estadia->updated_at = date('Y-m-d H:i:s');
        $estadia->save();

        return response()->json([
            'success' => true
        ]);
    }

    public function updateitinerarioajax(Request $request)
    {
        $estadia = EstadiasProgramacion::where('programacion_id',$request->id_programacion)->first();

        if (!$estadia) {
            $estadia = new EstadiasProgramacion();
            $estadia->programacion_id = $request->id_programacion;
            $estadia->iduserCreated = auth()->user()->id;
            $estadia->created_at = date('Y-m-d H:i:s');
        }

        $estadia->estatus_itinerario = $request->filled('estatus_itinerario') ? $request->estatus_itinerario : null;
        $estadia->iduserUpdated = auth()->user()->id;
        $estadia->updated_at = date('Y-m-d H:i:s');
        $estadia->save();

        return response()->json([
            'success' => true
        ]);
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