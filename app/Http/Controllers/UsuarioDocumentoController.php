<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Models\Usuarios\DocumentacionUsuario;  

class UsuarioDocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadodocusuarios()
    {
        $data = DocumentacionUsuario::where('siaf_status', 1)->get();
        
        return view('usuarios.usuario-catalogodocumentos', compact('data'));
    }


    public function datatable(Request $request)
    {
         $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = DocumentacionUsuario::select('count(*) as allcount')->count();
        $totalRecordswithFilter = DocumentacionUsuario::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();
        // Fetch records
        $records = DocumentacionUsuario::select('user_documentos.id', 'user_documentos.tipo_documento', 'user_documentos.siaf_status')
            ->where('user_documentos.siaf_status', 1)
            ->skip($start)
            ->take($rowperpage);

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='nombre'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);
                    $records = $records->where("user_documentos.tipo_documento", '=' , $valor);
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
                "nombre" => $record->tipo_documento,
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

    public function guardar(Request $request)
    {
         $data = [
            'tipo_documento' => $request->documento_usuario,
            'siaf_status' => 1,
            'iduserCreated' => auth()->user()->id,
            'iduserUpdated' => auth()->user()->id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        DocumentacionUsuario::insert($data);

        session()->flash('success', 'El registro se creo correctamente');
        return redirect()->route('usuario.catalogodocumentos');
    }

    public function editar(Request $request)
    {
        $documento = DocumentacionUsuario::find($request->id_documento_usuario);
        $documento->documento_usuario = $request->documento_usuario;
        $documento->save();

        return response()->json(['success' => true]);
    }

    public function eliminardoc(Request $request)
    {
        $doc = DocumentacionUsuario::findOrFail($request->id);
        $estatus = true;
        if ($doc){
            Storage::delete('user/'.$doc->user_id.'/'.$doc->documento);
            DocumentoCliente::where('id', $request->id)->delete();
        }else{
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

}   