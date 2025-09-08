<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Services\Folio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Services\Money;
use App\Models\Cliente\Cliente;
use App\Models\Cliente\ClienteContactoFacturacion;
use App\Models\Cliente\ClienteContactoOperativo;
use App\Models\Cliente\TipoDocumentoC;
use App\Models\Cliente\DocumentoCliente;
use App\Models\Cliente\TipoContactoCliente;
use App\Models\Cliente\ClienteFolio;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ClienteController extends Controller
{
    protected $folio;
    protected $money_format;
    
    public function __construct(Folio $folio, Money $money_format)
    {
        $this->middleware('auth');
        $this->folio = $folio;
        $this->money_format = $money_format;
    }

    public function listadocliente()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        // dd($data);

        return view('cliente.listado-cliente', compact('data'));
    }

    public function clientelistadodatatable(Request $request)
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
        $totalRecords = Cliente::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Cliente::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();

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

        $records = Cliente::select('cliente.id', 'cliente.razon_social', 'cliente.nombre_cliente', 'cliente.grupo', 'cliente.dias_credito', 'cliente.costo_estadia', 'cliente.costo_km', 'cliente.observaciones', 'cliente.num_list')
            ->where('cliente.siaf_status', 1)
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

                    $records = Cliente::select('cliente.id', 'cliente.razon_social', 'cliente.nombre_cliente', 'cliente.grupo', 'cliente.dias_credito', 'cliente.costo_estadia', 'cliente.costo_km', 'cliente.observaciones', 'cliente.num_list')
                    ->where('cliente.siaf_status', 1)
                    ->where("cliente.nombre_cliente", '=' , $valor)
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }
        }

        if($valor == "No"){
            $records = Cliente::select('cliente.id', 'cliente.razon_social', 'cliente.nombre_cliente', 'cliente.grupo', 'cliente.dias_credito', 'cliente.costo_estadia', 'cliente.costo_km', 'cliente.observaciones', 'cliente.num_list')
            ->where('cliente.siaf_status', 1)
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
                "razon_social" => $record->razon_social,
                "nombre_cliente" => $record->nombre_cliente,
                "grupo" => $record->grupo,
                "permisos" => $permiso_array,
                "num_list" => $record->num_list,
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

    public function agregarcliente()
    {
        $data= 1;

        $documentos = TipoDocumentoC::where('siaf_status_id',1)->get();
        // dd($documentos);
        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documentos as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->nombre_documento.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        $tipocliente = TipoContactoCliente::get();

        //tipo de documentos en formato json
        $cadenatipocliente = "";
        foreach($tipocliente as $documento){
            $cadenatipocliente .= '"'.$documento->id.'":"'.$documento->tipo_contacto.'",';
        }
        $cadenatipocliente = '{'.rtrim($cadenatipocliente, ',').'}';


        return view('cliente.agregar-cliente', compact('data','cadenaTipoDocumento', 'cadenatipocliente'));
    }

    public function guardarcliente(Request $request)
    {


        $data = [
            'num_list' => $this->folio->getFolioCliente(),
            'razon_social' => $request->razon_social,
            'nombre_cliente'  => $request->cliente,
            'grupo'  => $request->grupo,
            'dias_credito'  => $request->dias_credito,
            'costo_estadia' => $request->costo_estadia ? $this->money_format->clearFormat($request->costo_estadia):null,
            'costo_km' => $request->costo_km ? $this->money_format->clearFormat($request->costo_km):null,
            'costo_estadia_armada' => $request->costo_estadia_armada ? $this->money_format->clearFormat($request->costo_estadia_armada):null,
            'observaciones' => $request->observaciones,
            'siaf_status' => 1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        $id_cliente = Cliente::insertGetId($data);
        // dd($request);

        $colIdDocumento = $request->id_tipocontacto;
        if($request->nombre){
            for($i = 1; $i <= count($request->nombre); $i++){
                $data = [
                    'cliente_id' => $id_cliente,
                    'id_tipo_contacto' =>$colIdDocumento[$i],
                    'nombre_operativo' =>$request->nombre[$i],
                    'telefono_operativo' =>$request->telefono[$i],
                    'email_operativo' =>$request->email[$i],
                    'siaf_status' => 1,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' => auth()->user()->id,
                    'iduserUpdated' => auth()->user()->id,
                ];

                ClienteContactoOperativo::insert($data);
            }
        }

        // if($request->nombre_fac){
        //     for($f = 1; $f <= count($request->nombre_fac); $f++){
                
        //         $data = [
        //             'cliente_id' => $id_cliente,
        //             'nombre_contacto' =>$request->nombre_fac[$f],
        //             'telefono_contacto' =>$request->telefono_fac[$f],
        //             'email_contacto' =>$request->email_fac[$f],
        //             'siaf_status' => 1,
        //             'created_at' =>date('Y-m-d H:i:s'),
        //             'updated_at' =>date('Y-m-d H:i:s'),
        //             'iduserCreated' => auth()->user()->id,
        //             'iduserUpdated' => auth()->user()->id,
        //         ];
        //         ClienteContactoFacturacion::insert($data);
        //     }
        // }


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');
            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('cliente/'.$id_cliente, $archivo, $archivoNombre);
                $data = [
                    'cliente_id' => $id_cliente,
                    'cliente_tipo_documento_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                DocumentoCliente::insert($data);
            }
        }


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');
            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('cliente/'.$id_cliente, $archivo, $archivoNombre);
                $data = [
                    'cliente_id' => $id_cliente,
                    'cliente_tipo_documento_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                DocumentoCliente::insert($data);
            }
        }


        session()->flash('success', 'El cliente se añadió correctamente');
        return redirect()->route('cliente.listadocliente');  

    }

    public function editarcliente($cliente_id)
    {
        $data = Cliente::where('id', $cliente_id)->first();
        $cliente_operativo = ClienteContactoOperativo::where('cliente_id', $cliente_id)->get();
        $cliente_fac = ClienteContactoFacturacion::where('cliente_id', $cliente_id)->get();
        

        $documento = TipoDocumentoC::where('siaf_status_id',1)->get();
        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documento as $doc){
            $cadenaTipoDocumento .= '"'.$doc->id.'":"'.$doc->nombre_documento.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        $documentos = DocumentoCliente::where('cliente_id',$cliente_id)->get();

        $tipocliente = TipoContactoCliente::get();

        //tipo de documentos en formato json
        $cadenatipocliente = "";
        foreach($tipocliente as $documento){
            $cadenatipocliente .= '"'.$documento->id.'":"'.$documento->tipo_contacto.'",';
        }
        $cadenatipocliente = '{'.rtrim($cadenatipocliente, ',').'}';

        return view('cliente.editar-cliente', compact('data', 'cliente_id', 'cliente_operativo', 'cliente_fac', 'cadenaTipoDocumento', 'documentos', 'cadenatipocliente'));      
    }

    public function eliminarcontactooperativo(Request $request)
    {
        $doc = ClienteContactoOperativo::findOrFail($request->id);
        $estatus = true;
        if ($doc){
            ClienteContactoOperativo::where('id', $request->id)->delete();
        }else{
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

    public function eliminarcontactofacturacion(Request $request)
    {
        $doc = ClienteContactoFacturacion::findOrFail($request->id);
        $estatus = true;
        if ($doc){
            ClienteContactoFacturacion::where('id', $request->id)->delete();
        }else{
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

    public function updatecliente(Request $request)
    {
        // dd($request);
        $data = [
            'razon_social' => $request->razon_social,
            'nombre_cliente'  => $request->cliente,
            'grupo'  => $request->grupo,
            'dias_credito'  => $request->dias_credito,
            'costo_estadia' => $request->costo_estadia ? $this->money_format->clearFormat($request->costo_estadia):null,
            'costo_km' => $request->costo_km ? $this->money_format->clearFormat($request->costo_km):null,
            'costo_estadia_armada' => $request->costo_estadia_armada ? $this->money_format->clearFormat($request->costo_estadia_armada):null,
            'observaciones' => $request->observaciones,
            'siaf_status' => 1,
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserUpdated' =>auth()->user()->id,
        ];
        Cliente::where('id', $request->cliente_id)->update($data);
        // dd($request);

        $colIdDocumento = $request->id_tipocontacto;
        if($request->nombre){
            for($i = 1; $i <= count($request->nombre); $i++){
                $data = [
                    'cliente_id' => $request->cliente_id,
                    'id_tipo_contacto' =>$colIdDocumento[$i],
                    'nombre_operativo' =>$request->nombre[$i],
                    'telefono_operativo' =>$request->telefono[$i],
                    'email_operativo' =>$request->email[$i],
                    'siaf_status' => 1,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' => auth()->user()->id,
                    'iduserUpdated' => auth()->user()->id,
                ];

                ClienteContactoOperativo::insert($data);
            }
        }

        if($request->nombre_fac){
            for($f = 1; $f <= count($request->nombre_fac); $f++){
                
                $data = [
                    'cliente_id' => $request->cliente_id,
                    'nombre_contacto' =>$request->nombre_fac[$f],
                    'telefono_contacto' =>$request->telefono_fac[$f],
                    'email_contacto' =>$request->email_fac[$f],
                    'siaf_status' => 1,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' => auth()->user()->id,
                    'iduserUpdated' => auth()->user()->id,
                ];
                ClienteContactoFacturacion::insert($data);
            }
        }


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');
            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('cliente/'.$request->cliente_id, $archivo, $archivoNombre);
                $data = [
                    'cliente_id' => $request->cliente_id,
                    'cliente_tipo_documento_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                DocumentoCliente::insert($data);
            }
        }


        session()->flash('success', 'El cliente se añadió correctamente');
        return redirect()->route('cliente.listadocliente'); 
    }

    public function desactivarcliente(Request $request)
    {
        $data = [
            'siaf_status' => 2,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Cliente::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se desactivo correctamente');
        return redirect()->route('cliente.listadocliente');  
    }

    public function listadoclienteinactivo()
    {
        $data = Cliente::where('siaf_status', 2)->get();

        return view('cliente.listado-cliente-inactivo', compact('data'));       
    }

    public function activarcliente(Request $request)
    {
        $data = [
            'siaf_status' => 1,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Cliente::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se activo correctamente');
        return redirect()->route('cliente.listadoclienteinactivo'); 
    }

    public function vercliente($cliente_id)
    {
        $data = Cliente::where('id', $cliente_id)->first();
        $cliente_operativo = ClienteContactoOperativo::where('cliente_id', $cliente_id)->get();
        $cliente_fac = ClienteContactoFacturacion::where('cliente_id', $cliente_id)->get();
        $documentos = DocumentoCliente::where('cliente_id',$cliente_id)->get();
        
        return view('cliente.ver-cliente', compact('data', 'cliente_id', 'cliente_operativo', 'cliente_fac', 'documentos'));         
    }

    public function eliminardocumentocliente(Request $request)
    {
        $doc = DocumentoCliente::findOrFail($request->id);
        $estatus = true;
        if ($doc){
            Storage::delete('cliente/'.$doc->cliente_id.'/'.$doc->documento);
            DocumentoCliente::where('id', $request->id)->delete();
        }else{
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

}