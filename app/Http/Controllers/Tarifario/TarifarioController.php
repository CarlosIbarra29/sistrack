<?php

namespace App\Http\Controllers\Tarifario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Models\Cliente\Cliente;
use App\Models\Custodio\Custodio;
use App\Models\Tarifario\Tarifario;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TarifarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadodotarifario()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();

        return view('tarifario.listado-tarifario', compact('data'));
    }

    public function tarifariolistadodatatable(Request $request)
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
        $totalRecords = Tarifario::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Tarifario::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();

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

        $records = Tarifario::select('tarifario.id', 'tarifario.cliente_id', 'es.nombre_cliente','tarifario.origen', 'tarifario.destino', 'tarifario.kms', 'tarifario.ppkm_sis', 'tarifario.ppkm_cust', 'tarifario.caseta')
        	->leftjoin("cliente as es","es.id","tarifario.cliente_id")
            ->where('tarifario.siaf_status', 1)
            ->orderBy($order_column_name, $order_column_dir)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='nombre_cliente'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Tarifario::select('tarifario.id', 'tarifario.cliente_id', 'es.nombre_cliente',  'tarifario.origen', 'tarifario.destino', 'tarifario.kms', 'tarifario.ppkm_sis', 'tarifario.ppkm_cust', 'tarifario.caseta')
                    ->leftjoin("cliente as es","es.id","tarifario.cliente_id")
                    ->where('tarifario.siaf_status', 1)
                    ->where("tarifario.cliente_id", '=' , $valor)
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }
        }

        if($valor == "No"){

        $records = Tarifario::select('tarifario.id', 'tarifario.cliente_id', 'es.nombre_cliente','tarifario.origen', 'tarifario.destino', 'tarifario.kms', 'tarifario.ppkm_sis', 'tarifario.ppkm_cust', 'tarifario.caseta')
        	->leftjoin("cliente as es","es.id","tarifario.cliente_id")
            ->where('tarifario.siaf_status', 1)
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
                "nombre_cliente" => $record->nombre_cliente,
                "origen" => $record->origen,
                "destino" => $record->destino,
                "kms" => $record->kms,
                "ppkm_sis" => $record->ppkm_sis,
                "ppkm_cust" => $record->ppkm_cust,
                "caseta" => $record->caseta,
                "permisos" => $permiso_array,
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


    public function agregartarifario()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('siaf_status', 1)->get();

        return view('tarifario.agregar-tarifario', compact('data'));    	
    }


    public function guardartarifario(Request $request)
    {
    	$total_sis = $request->kms * $request->ppkm_sis; // Total cliente
    	$total_cust = $request->kms * $request->ppkm_cust; // Total custodio
    	$subtotal = $request->caseta + $total_cust; //Subtotal
    	$ganancia = $total_sis - $total_cust - $request->caseta; //Ganancia
    	$porcentaje_custodio_suma = ($request->caseta + $total_cust) * 100;
    	$porcentaje_custodio = $porcentaje_custodio_suma / $total_sis; // Porcentaje custodio
    	$porcentaje_sisprotec = 100 - $porcentaje_custodio;
    	
        $data = [
            'cliente_id' => $request->cliente_id,
            'origen'  => $request->origen,
            'destino' => $request->destino,
            'kms' => $request->kms,
            'ppkm_sis' => $request->ppkm_sis,
            'ppkm_cust' => $request->ppkm_cust,
            'caseta' => $request->caseta,

            'monto_cliente'=> $total_sis,
            'monto_custodio'=> $total_cust,
            'subtotal'=> $subtotal,
            'ganancia'=> $ganancia,
            'porcentaje_custodio'=> $porcentaje_custodio,
            'porcentaje_sisprotec'=> $porcentaje_sisprotec,
            'total'=> 100,
            'observaciones' => $request->observaciones,
            'siaf_status' => 1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        Tarifario::insert($data);

        session()->flash('success', 'La tarifa se añadió correctamente');
        return redirect()->route('tarifario.listadotarifario');  
    }

    public function editartarifario($id_tarifario)
    {
   
        $data = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('id', $id_tarifario)->first();

        return view('tarifario.editar-tarifario', compact('data', 'tarifario'));

    }

    public function updatetarifario(Request $request)
    {
    	$total_sis = $request->kms * $request->ppkm_sis; // Total cliente
    	$total_cust = $request->kms * $request->ppkm_cust; // Total custodio
    	$subtotal = $request->caseta + $total_cust; //Subtotal
    	$ganancia = $total_sis - $total_cust - $request->caseta; //Ganancia
    	$porcentaje_custodio_suma = ($request->caseta + $total_cust) * 100;
    	$porcentaje_custodio = $porcentaje_custodio_suma / $total_sis; // Porcentaje custodio
    	$porcentaje_sisprotec = 100 - $porcentaje_custodio;
    	
        $data = [
            'cliente_id' => $request->cliente_id,
            'origen'  => $request->origen,
            'destino' => $request->destino,
            'kms' => $request->kms,
            'ppkm_sis' => $request->ppkm_sis,
            'ppkm_cust' => $request->ppkm_cust,
            'caseta' => $request->caseta,
            'monto_cliente'=> $total_sis,
            'monto_custodio'=> $total_cust,
            'subtotal'=> $subtotal,
            'ganancia'=> $ganancia,
            'porcentaje_custodio'=> $porcentaje_custodio,
            'porcentaje_sisprotec'=> $porcentaje_sisprotec,
            'total'=> 100,
            'observaciones' => $request->observaciones,
            'siaf_status' => 1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        Tarifario::where('id', $request->id_tarifario)->update($data);;

        session()->flash('success', 'La tarifa se modifico correctamente');
        return redirect()->route('tarifario.listadotarifario');  
    }

    public function desactivartarifario(Request $request)
    {

        $data = [
            'siaf_status' => 2,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Tarifario::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se desactivo correctamente');
        return redirect()->route('tarifario.listadotarifario');   

    }

    public function listadotarifarioinactivo()
    {
        $tarifario = Tarifario::where('siaf_status', 2)->get();

        return view('tarifario.listado-tarifario-inactivo', compact('tarifario'));   	
    }

    public function activartarifario(Request $request)
    {
        $data = [
            'siaf_status' => 1,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Tarifario::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se activo correctamente');
        return redirect()->route('tarifario.listadotarifarioinactivo'); 
    }

    public function vertarifa($id_tarifa)
    {
        $data = Cliente::where('siaf_status', 1)->get();
        $tarifario = Tarifario::where('id', $id_tarifa)->first();

        return view('tarifario.ver-tarifario', compact('data', 'tarifario'));    	
    }

}