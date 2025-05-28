<?php

namespace App\Http\Controllers\Custodio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Models\Custodio\DocumentacionArmaCustodio;

class DocumentacionArmaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadodocarma()
    {
        $data = DocumentacionArmaCustodio::where('siaf_status', 1)->get();

        return view('custodio.documentacion-arma.listado-documentos-arma', compact('data'));
    }

    public function documentosarmadatatable(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = DocumentacionArmaCustodio::select('count(*) as allcount')->count();
        $totalRecordswithFilter = DocumentacionArmaCustodio::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();
        // Fetch records
        $records = DocumentacionArmaCustodio::select('custodio_documentacion_arma.id', 'custodio_documentacion_arma.tipo_documento_arma', 'custodio_documentacion_arma.siaf_status')
            ->where('custodio_documentacion_arma.siaf_status', 1)
            ->skip($start)
            ->take($rowperpage);

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='nombre'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);
                    $records = $records->where("custodio_documentacion_arma.tipo_documento_arma", '=' , $valor);
                }
            }
        }

        if($valor == "No"){
            $records= $records->get();
        }else{
            $records = $records->get();
            $totalRecords = count($records);
            $totalRecordswithFilter = count($records);          
        }

        $data_arr = array();
        $pro="";
        foreach($records as $record){

            $data_arr[] = array(
                "id" => $record->id,
                "nombre" => $record->tipo_documento_arma,
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

    public function guardardocumentoarma(Request $request)
    {

        $data = [
            'tipo_documento_arma' => $request->documento,
            'siaf_status' => 1,
            'iduserCreated' => auth()->user()->id,
            'iduserUpdated' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionArmaCustodio::insert($data);

        session()->flash('success', 'El registro se creo correctamente');
        return redirect()->route('docarma.listadodocarma');
    }

    public function editardocumentoarma(Request $request)
    {
        $data = [
            'tipo_documento_arma' => $request->documento,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionArmaCustodio::where('id', $request->id_documento)->update($data);

        session()->flash('success', 'El registro modifico correctamente');
        return redirect()->route('docarma.listadodocarma');
    }

    public function desactivardocumentoarma(Request $request)
    {
        $data = [
            'siaf_status' => 2,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionArmaCustodio::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se desactivo correctamente');
        return redirect()->route('docarma.listadodocarma');  
    }

    public function catalogodocarmainactivos()
    {
        $data = DocumentacionArmaCustodio::where('siaf_status', 2)->get();

        return view('custodio.documentacion-arma.listado-documentos-arma-inactivo', compact('data'));   	
    }

    public function activardocumentoarma(Request $request)
    {
        $data = [
            'siaf_status' => 1,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DocumentacionArmaCustodio::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se activo correctamente');
        return redirect()->route('docarma.catalogodocarmainactivos');  
    }

}  