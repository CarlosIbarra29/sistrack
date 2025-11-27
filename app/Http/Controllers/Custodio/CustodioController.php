<?php

namespace App\Http\Controllers\Custodio;

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
use App\Models\Custodio\DocumentacionCustodio;
use App\Models\Custodio\DocumentacionVehiculoCustodio;
use App\Models\Custodio\FotografiaVehiculoCustodio;
use App\Models\Custodio\VehiculoDocCustodio;
use App\Models\Custodio\CustodioVehiculo;
use App\Models\Custodio\Custodio;
use App\Models\Custodio\CustodioDocumento;
use App\Models\Custodio\CustodioSeleccion;
use App\Models\Custodio\CustodioControlConfianza;
use App\Models\Custodio\DocumentacionArmaCustodio;
use App\Models\Custodio\CustodioArma;
use App\Models\Custodio\FotografiaArmaCustodio;
use App\Models\Custodio\ArmaDocCustodio;
use App\Models\Custodio\CustodioFolio;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CustodioController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function listadocustodio()
    {
        $data = Custodio::where('siaf_status', 1)->get();
        // dd($data);

        return view('custodio.listado-custodio', compact('data'));

    }

    public function pruebasari()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        // dd($data);

        return view('pruebadev.djcocoloco', compact('data'));

    }

    public function pruebasdiego()
    {
        $data = Cliente::where('siaf_status', 1)->get();
        // dd($data);

        return view('pruebadev.diego', compact('data'));

    }

    public function custodiodatatable(Request $request)
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
        $totalRecords = Custodio::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Custodio::select('count(*) as allcount')->where('id', 'like', '%' .$searchValue . '%')->count();

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

        $records = Custodio::select('custodio.id', 'custodio.nombre_custodio', 'custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones',
            'custodio.op_vehiculo', 'custodio.op_arma')
            ->where('custodio.siaf_status', 1)
            ->orderBy($order_column_name, $order_column_dir)
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $valor = "No";   
        // Bandera para varlidar si no hay filtros   $valor = "No";
        foreach ($columnName_arr as $indice => $columna){
            if($columna['data']=='nombre_custodio'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones','custodio.op_vehiculo' , 'custodio.op_arma')
                    ->where('custodio.siaf_status', 1)
                    ->where('custodio.nombre_custodio', 'like', '%' .$valor . '%')
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }

            if($columna['data']=='ap_paterno'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones','custodio.op_vehiculo' , 'custodio.op_arma')
                    ->where('custodio.siaf_status', 1)
                    ->where('custodio.ap_paterno', 'like', '%' .$valor . '%')
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }

            if($columna['data']=='ap_materno'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones','custodio.op_vehiculo' , 'custodio.op_arma')
                    ->where('custodio.siaf_status', 1)
                    ->where('custodio.ap_materno', 'like', '%' .$valor . '%')
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }

            if($columna['data']=='curp'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones','custodio.op_vehiculo' , 'custodio.op_arma')
                    ->where('custodio.siaf_status', 1)
                    ->where('custodio.curp', 'like', '%' .$valor . '%')
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }

            if($columna['data']=='rfc'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones','custodio.op_vehiculo' , 'custodio.op_arma')
                    ->where('custodio.siaf_status', 1)
                    ->where('custodio.rfc', 'like', '%' .$valor . '%')
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }


            if($columna['data']=='correo_electronico'){
                if (!empty($columna['search']['value'])){
                    $valor = trim($columna['search']['value']);

                    $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones','custodio.op_vehiculo' , 'custodio.op_arma')
                    ->where('custodio.siaf_status', 1)
                    ->where('custodio.correo_electronico', 'like', '%' .$valor . '%')
                    ->orderBy($order_column_name, $order_column_dir)
                    ->skip($start)
                    ->take($rowperpage)
                    ->get();
                }
            }
        }

        if($valor == "No"){
            $records = Custodio::select('custodio.id', 'custodio.nombre_custodio','custodio.ap_paterno', 'custodio.ap_materno', 'custodio.numero_telefono', 'custodio.correo_electronico', 'custodio.rfc', 'custodio.curp', 'custodio.base', 'custodio.observaciones',
            'custodio.op_vehiculo', 'custodio.op_arma')
            ->where('custodio.siaf_status', 1)
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
                "nombre_custodio" => strtoupper($record->nombre_custodio),
                "ap_paterno" => strtoupper($record->ap_paterno),
                "ap_materno" => strtoupper($record->ap_materno),
                "curp" => strtoupper($record->curp),
                "rfc" => $record->rfc,
                "numero_telefono" => strtoupper($record->numero_telefono),
                "correo_electronico" => $record->correo_electronico,
                "op_vehiculo" => $record->op_vehiculo,
                "op_arma" => $record->op_arma,
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


    public function agregarcustodio()
    {
        $data= 1;
        $documentos = DocumentacionCustodio::where('siaf_status',1)->get();

        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documentos as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->tipo_documento.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

         $users_custodio = User::where('id_status_delete', 1)->where('op_custodio', 0)->where('role', 16)->get();
         // dd($data);

        return view('custodio.agregar-custodio', compact('data', 'cadenaTipoDocumento', 'users_custodio'));
    }

    public function guardarcustodio(Request $request)
    {
// dd($request);
        $data = [
            'users_custodios' => $request->users_custodios,
            'num_list' => $this->folio->getFolioCustodio(),
            'fecha_ingreso' => $request->fecha_ingreso ? Carbon::createFromFormat('d/m/Y', $request->fecha_ingreso)->format('Y-m-d'):null,
            'ap_paterno' => $request->ape_paterno,
            'ap_materno' => $request->ape_materno,
            'nombre_custodio' => $request->nombre_custodio,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'fecha_nacimiento' =>  $request->fecha_nacimiento ? Carbon::createFromFormat('d/m/Y', $request->fecha_nacimiento)->format('Y-m-d'):null,
            'lugar_nacimiento' => $request->lugar_nacimiento,
            'nacionalidad' => $request->nacionalidad,
            'estado_civil' => $request->estado_civil,
            'curp' => $request->curp,
            'rfc' => $request->rfc,
            'correo_electronico' => $request->mail,
            'base' => $request->base,
            'escolaridad' => $request->escolaridad,
            'numero_telefono' => $request->telefono_custodio,
            'observaciones' => $request->observaciones,
            'dom_calle' => $request->dom_calle,
            'dom_colonia' => $request->dom_colonia,
            'dom_num' => $request->dom_num,
            'dom_municipio' => $request->dom_municipio,
            'dom_estado' => $request->dom_estado,
            'dom_cp' => $request->dom_cp,
            'siaf_status' => 1,
            'op_vehiculo' => 1,
            'op_arma' => 1,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        // dd($data);
        $id_custodio = Custodio::insertGetId($data);

        $data_seleccion = [
            'custodio_id' => $id_custodio,
            'entin_fecha' => $request->entin_fecha ? Carbon::createFromFormat('d/m/Y', $request->entin_fecha)->format('Y-m-d'):null,
            'entin_comentario' => $request->entin_comentario,
            'verdoc_fecha' => $request->verdoc_fecha ? Carbon::createFromFormat('d/m/Y', $request->verdoc_fecha)->format('Y-m-d'):null,
            'verdoc_comentario' => $request->verdoc_comentario,
            'entope_fecha' => $request->entope_fecha ? Carbon::createFromFormat('d/m/Y', $request->entope_fecha)->format('Y-m-d'):null,
            'entope_comentario' => $request->entope_comentario,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        CustodioSeleccion::insert($data_seleccion);

        $data_control_confianza = [
            'custodio_id' => $id_custodio,
            'valdat_fecha' => $request->valdat_fecha ? Carbon::createFromFormat('d/m/Y', $request->valdat_fecha)->format('Y-m-d'):null,
            'valdat_comentario' => $request->valdat_comentario,
            'verref_fecha' => $request->verref_fecha ? Carbon::createFromFormat('d/m/Y', $request->verref_fecha)->format('Y-m-d'):null,
            'verref_comentario' => $request->verref_comentario,
            'verlab_fecha' => $request->verlab_fecha ? Carbon::createFromFormat('d/m/Y', $request->verlab_fecha)->format('Y-m-d'):null,
            'verlab_comentario' => $request->verlab_comentario,
            'anasoc_fecha' => $request->anasoc_fecha ? Carbon::createFromFormat('d/m/Y', $request->anasoc_fecha)->format('Y-m-d'):null,
            'anasoc_comentario' => $request->anasoc_comentario,
            'exafis_fecha' => $request->exafis_fecha ? Carbon::createFromFormat('d/m/Y', $request->exafis_fecha)->format('Y-m-d'):null,
            'exafis_comentario' => $request->exafis_comentario,
            'examed_fecha' => $request->examed_fecha ? Carbon::createFromFormat('d/m/Y', $request->examed_fecha)->format('Y-m-d'):null,
            'examed_comentario' => $request->examed_comentario,
            'exapsi_fecha' => $request->exapsi_fecha ? Carbon::createFromFormat('d/m/Y', $request->exapsi_fecha)->format('Y-m-d'):null,
            'exapsi_comentario' => $request->exapsi_comentario,
            'exatox_fecha' => $request->exatox_fecha ? Carbon::createFromFormat('d/m/Y', $request->exatox_fecha)->format('Y-m-d'):null,
            'exatox_comentario' => $request->exatox_comentario,
            'tesver_fecha' => $request->tesver_fecha ? Carbon::createFromFormat('d/m/Y', $request->tesver_fecha)->format('Y-m-d'):null,
            'tesver_comentario' => $request->tesver_comentario,
            'tesrob_fecha' => $request->tesrob_fecha ? Carbon::createFromFormat('d/m/Y', $request->tesrob_fecha)->format('Y-m-d'):null,
            'tesrob_comentario' => $request->tesrob_comentario,
            'tesnor_fecha' => $request->tesnor_fecha ? Carbon::createFromFormat('d/m/Y', $request->tesnor_fecha)->format('Y-m-d'):null,
            'tesnor_comentario' => $request->tesnor_comentario,
            'tessob_fecha' => $request->tessob_fecha ? Carbon::createFromFormat('d/m/Y', $request->tessob_fecha)->format('Y-m-d'):null,
            'tessob_comentario' => $request->tessob_comentario,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        CustodioControlConfianza::insert($data_control_confianza);


        if($request->hasfile('file_carga')){
            $archivos = $request->file('file_carga');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$id_custodio, $archivo, $archivoNombre);
                $data = [
                    'fotografia_custodio' => $archivoNombre,
                ];

                Custodio::where('id', $id_custodio)->update($data);
            }
        }


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$id_custodio, $archivo, $archivoNombre);
                $data = [
                    'custodio_id' => $id_custodio,
                    'custodio_documentacion_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                CustodioDocumento::insert($data);
            }
        }


        $data_user = [
            'op_custodio' => 1,
        ];
        User::where('id', $request->users_custodios)->update($data_user);
        

        session()->flash('success', 'El custodio se añadió correctamente');
        return redirect()->route('custodio.listadocustodio');    
    }

    public function editarcustodio($custodio_id)
    {

        $custodio = Custodio::where('id', $custodio_id)->first();
        // dd($custodio);
        $custodio_seleccion = CustodioSeleccion::where('custodio_id', $custodio_id)->first();
        // dd($custodio_id);
        $custodio_confianza = CustodioControlConfianza::where('custodio_id', $custodio_id)->first();
        $documento = DocumentacionCustodio::where('siaf_status',1)->get();
        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documento as $doc){
            $cadenaTipoDocumento .= '"'.$doc->id.'":"'.$doc->tipo_documento.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';
        $documentos = CustodioDocumento::where('custodio_id',$custodio_id)->get();
        
        if($custodio->fecha_ingreso == null){ $por_fecha_ingreso = 0; }else{ $por_fecha_ingreso = 1; } 
        if($custodio->nombre_custodio == null){ $por_nombre_custodio = 0; }else{ $por_nombre_custodio = 1; }  
        if($custodio->ap_paterno == null){ $por_ap_paterno = 0; }else{ $por_ap_paterno = 1; } 
        if($custodio->ap_materno == null){ $por_ap_materno = 0; }else{ $por_ap_materno = 1; }  
        if($custodio->edad == null){ $por_edad = 0; }else{ $por_edad = 1; }  
        if($custodio->sexo == null){ $por_sexo = 0; }else{ $por_sexo = 1; }  
        if($custodio->fecha_nacimiento == null){ $por_fecha_nacimiento = 0; }else{ $por_fecha_nacimiento = 1; }    
        if($custodio->lugar_nacimiento == null){ $por_lugar_nacimiento = 0; }else{ $por_lugar_nacimiento = 1; }  
        if($custodio->nacionalidad == null){ $por_nacionalidad = 0; }else{ $por_nacionalidad = 1; }     
        if($custodio->estado_civil == null){ $por_estado_civil = 0; }else{ $por_estado_civil = 1; }  
        if($custodio->numero_telefono == null){ $por_numero_telefono = 0; }else{ $por_numero_telefono = 1; }    
        if($custodio->correo_electronico == null){ $por_correo_electronico = 0; }else{ $por_correo_electronico = 1; }  
        if($custodio->rfc == null){ $por_rfc = 0; }else{ $por_rfc = 1; } 
        if($custodio->curp == null){ $por_curp = 0; }else{ $por_curp = 1; }  
        if($custodio->base == null){ $por_base = 0; }else{ $por_base = 1; }
        if($custodio->escolaridad == null){ $por_escolaridad = 0; }else{ $por_escolaridad = 1; }
        if($custodio->fotografia_custodio == null){ $por_fotografia_custodio = 0; }else{ $por_fotografia_custodio = 1; }     
        $porcentaje_info = $por_fecha_ingreso + $por_nombre_custodio + $por_ap_paterno + $por_ap_materno + $por_edad + $por_sexo + $por_fecha_nacimiento + $por_lugar_nacimiento + $por_nacionalidad + $por_estado_civil + $por_numero_telefono + $por_correo_electronico + $por_rfc + $por_curp + $por_base + $por_escolaridad + $por_fotografia_custodio;

        if($custodio->dom_calle == null){ $por_calle = 0; }else{ $por_calle = 1; }
        if($custodio->dom_colonia == null){ $por_colonia = 0; }else{ $por_colonia = 1; }
        if($custodio->dom_num == null){ $por_num= 0; }else{ $por_num = 1; }
        if($custodio->dom_municipio == null){ $por_municipio = 0; }else{ $por_municipio = 1; }
        if($custodio->dom_estado == null){ $por_estado = 0; }else{ $por_estado = 1; }
        if($custodio->dom_cp == null){ $por_cp = 0; }else{ $por_cp = 1; }
        $porcentaje_domicilio = $por_calle + $por_num + $por_municipio + $por_estado + $por_cp + $por_colonia;

        // dd($custodio_seleccion);
        if($custodio_seleccion->entin_fecha == null){ $por_entin_fecha = 0; }else{ $por_entin_fecha = 1; };
        if($custodio_seleccion->verdoc_fecha == null){ $por_verdoc_fecha = 0; }else{ $por_verdoc_fecha = 1; };
        if($custodio_seleccion->entope_fecha == null){ $por_entope_fecha = 0; }else{ $por_entope_fecha = 1; };
        $porcentaje_seleccion = $por_entin_fecha + $por_verdoc_fecha + $por_entope_fecha;

        if($custodio_confianza->valdat_fecha == null){ $por_valdat_fecha =0; }else{ $por_valdat_fecha =1; };
        if($custodio_confianza->verref_fecha == null){ $por_verref_fecha =0; }else{ $por_verref_fecha =1; };
        if($custodio_confianza->verlab_fecha == null){ $por_verlab_fecha =0; }else{ $por_verlab_fecha =1; };
        if($custodio_confianza->anasoc_fecha == null){ $por_anasoc_fecha =0; }else{ $por_anasoc_fecha =1; };
        if($custodio_confianza->exafis_fecha == null){ $por_exafis_fecha =0; }else{ $por_exafis_fecha =1; };
        if($custodio_confianza->examed_fecha == null){ $por_examed_fecha =0; }else{ $por_examed_fecha =1; };
        if($custodio_confianza->exapsi_fecha == null){ $por_exapsi_fecha =0; }else{ $por_exapsi_fecha =1; };
        if($custodio_confianza->exatox_fecha == null){ $por_exatox_fecha =0; }else{ $por_exatox_fecha =1; };
        if($custodio_confianza->tesver_fecha == null){ $por_tesver_fecha =0; }else{ $por_tesver_fecha =1; };
        if($custodio_confianza->tesrob_fecha == null){ $por_tesrob_fecha =0; }else{ $por_tesrob_fecha =1; };
        if($custodio_confianza->tesnor_fecha == null){ $por_tesnor_fecha =0; }else{ $por_tesnor_fecha =1; };
        if($custodio_confianza->tessob_fecha == null){ $por_tessob_fecha =0; }else{ $por_tessob_fecha =1; };
        $porcentaje_confianza = $por_valdat_fecha + $por_verref_fecha + $por_verlab_fecha + $por_anasoc_fecha + $por_exafis_fecha + $por_examed_fecha + $por_exapsi_fecha + $por_exatox_fecha + $por_tesver_fecha + $por_tesrob_fecha + $por_tesnor_fecha + $por_tessob_fecha;

        return view('custodio.editar-custodio', compact('custodio','cadenaTipoDocumento','documentos', 'custodio_seleccion', 'custodio_confianza', 'porcentaje_domicilio', 'porcentaje_info', 'porcentaje_seleccion', 'porcentaje_confianza'));

    }

    public function updatecustodio(Request $request)
    {
        // dd($request->id_custodio);
        $data = [
            'fecha_ingreso' => $request->fecha_ingreso ? Carbon::createFromFormat('d/m/Y', $request->fecha_ingreso)->format('Y-m-d'):null,
            'ap_paterno' => $request->ape_paterno,
            'ap_materno' => $request->ape_materno,
            'nombre_custodio' => $request->nombre_custodio,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'fecha_nacimiento' =>  $request->fecha_nacimiento ? Carbon::createFromFormat('d/m/Y', $request->fecha_nacimiento)->format('Y-m-d'):null,
            'lugar_nacimiento' => $request->lugar_nacimiento,
            'nacionalidad' => $request->nacionalidad,
            'estado_civil' => $request->estado_civil,
            'curp' => $request->curp,
            'rfc' => $request->rfc,
            'correo_electronico' => $request->mail,
            'base' => $request->base,
            'escolaridad' => $request->escolaridad,
            'numero_telefono' => $request->telefono_custodio,
            'observaciones' => $request->observaciones,
            'dom_calle' => $request->dom_calle,
            'dom_colonia' => $request->dom_colonia,
            'dom_num' => $request->dom_num,
            'dom_municipio' => $request->dom_municipio,
            'dom_estado' => $request->dom_estado,
            'dom_cp' => $request->dom_cp,
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserUpdated' =>auth()->user()->id,
        ];

        Custodio::where('id', $request->id_custodio)->update($data);

        $data_seleccion = [
            'custodio_id' => $request->id_custodio,
            'entin_fecha' => $request->entin_fecha ? Carbon::createFromFormat('d/m/Y', $request->entin_fecha)->format('Y-m-d'):null,
            'entin_comentario' => $request->entin_comentario,
            'verdoc_fecha' => $request->verdoc_fecha ? Carbon::createFromFormat('d/m/Y', $request->verdoc_fecha)->format('Y-m-d'):null,
            'verdoc_comentario' => $request->verdoc_comentario,
            'entope_fecha' => $request->entope_fecha ? Carbon::createFromFormat('d/m/Y', $request->entope_fecha)->format('Y-m-d'):null,
            'entope_comentario' => $request->entope_comentario,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        $custodio_seleccion = CustodioSeleccion::where('custodio_id', $request->id_custodio)->first();
        if($custodio_seleccion == null){
            CustodioSeleccion::insert($data_seleccion);
        }else{
            CustodioSeleccion::where('custodio_id', $request->id_custodio)->update($data_seleccion);
        }


        $data_control_confianza = [
            'custodio_id' => $request->id_custodio,
            'valdat_fecha' => $request->valdat_fecha ? Carbon::createFromFormat('d/m/Y', $request->valdat_fecha)->format('Y-m-d'):null,
            'valdat_comentario' => $request->valdat_comentario,
            'verref_fecha' => $request->verref_fecha ? Carbon::createFromFormat('d/m/Y', $request->verref_fecha)->format('Y-m-d'):null,
            'verref_comentario' => $request->verref_comentario,
            'verlab_fecha' => $request->verlab_fecha ? Carbon::createFromFormat('d/m/Y', $request->verlab_fecha)->format('Y-m-d'):null,
            'verlab_comentario' => $request->verlab_comentario,
            'anasoc_fecha' => $request->anasoc_fecha ? Carbon::createFromFormat('d/m/Y', $request->anasoc_fecha)->format('Y-m-d'):null,
            'anasoc_comentario' => $request->anasoc_comentario,
            'exafis_fecha' => $request->exafis_fecha ? Carbon::createFromFormat('d/m/Y', $request->exafis_fecha)->format('Y-m-d'):null,
            'exafis_comentario' => $request->exafis_comentario,
            'examed_fecha' => $request->examed_fecha ? Carbon::createFromFormat('d/m/Y', $request->examed_fecha)->format('Y-m-d'):null,
            'examed_comentario' => $request->examed_comentario,
            'exapsi_fecha' => $request->exapsi_fecha ? Carbon::createFromFormat('d/m/Y', $request->exapsi_fecha)->format('Y-m-d'):null,
            'exapsi_comentario' => $request->exapsi_comentario,
            'exatox_fecha' => $request->exatox_fecha ? Carbon::createFromFormat('d/m/Y', $request->exatox_fecha)->format('Y-m-d'):null,
            'exatox_comentario' => $request->exatox_comentario,
            'tesver_fecha' => $request->tesver_fecha ? Carbon::createFromFormat('d/m/Y', $request->tesver_fecha)->format('Y-m-d'):null,
            'tesver_comentario' => $request->tesver_comentario,
            'tesrob_fecha' => $request->tesrob_fecha ? Carbon::createFromFormat('d/m/Y', $request->tesrob_fecha)->format('Y-m-d'):null,
            'tesrob_comentario' => $request->tesrob_comentario,
            'tesnor_fecha' => $request->tesnor_fecha ? Carbon::createFromFormat('d/m/Y', $request->tesnor_fecha)->format('Y-m-d'):null,
            'tesnor_comentario' => $request->tesnor_comentario,
            'tessob_fecha' => $request->tessob_fecha ? Carbon::createFromFormat('d/m/Y', $request->tessob_fecha)->format('Y-m-d'):null,
            'tessob_comentario' => $request->tessob_comentario,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];

        $custodio_confianza = CustodioControlConfianza::where('custodio_id', $request->id_custodio)->first();
        if($custodio_confianza == null){
           CustodioControlConfianza::insert($data_control_confianza);
        }else{
            CustodioControlConfianza::where('custodio_id', $request->id_custodio)->update($data_control_confianza);
        }


        if($request->hasfile('file_carga')){
            $archivos = $request->file('file_carga');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$request->id_custodio, $archivo, $archivoNombre);
                $data = [
                    'fotografia_custodio' => $archivoNombre,
                ];

                Custodio::where('id', $request->id_custodio)->update($data);
            }
        }



        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');
            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$request->id_custodio, $archivo, $archivoNombre);
                $data = [
                    'custodio_id' => $request->id_custodio,
                    'custodio_documentacion_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                CustodioDocumento::insert($data);
            }
        }

        session()->flash('success', 'El custodio se actualizó correctamente');
        return redirect()->route('custodio.editarcustodio',$request->id_custodio);       
    }



    public function eliminardocumentocustodio(Request $request)
    {
        $doc = CustodioDocumento::findOrFail($request->id);
        $estatus = true;
        if ($doc){
            Storage::delete('custodio/'.$doc->custodio_id.'/'.$doc->documento);
            CustodioDocumento::where('id', $request->id)->delete();
        }else{
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

    public function agregarvehiculo($custodio_id)
    {
        $custodio = Custodio::where('id', $custodio_id)->first();

        $documentos = DocumentacionVehiculoCustodio::where('siaf_status',1)->get();

        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documentos as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->tipo_documento_vehiculo.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        $vehiculo = CustodioVehiculo::where('custodio_id', $custodio_id)->first();
        $fotografias = FotografiaVehiculoCustodio::where('custodio_id',$custodio_id)->get();
        $docvehiculo = VehiculoDocCustodio::where('custodio_id',$custodio_id)->get();

        return view('custodio.informacion-vehiculo', compact('custodio', 'cadenaTipoDocumento', 'vehiculo', 'fotografias', 'docvehiculo'));
    }

    public function guardarinfovehiculo(Request $request)
    {

        $data = [
            'custodio_id' => $request->custodio_id,
            'vehiculo' => $request->vehiculo,
            'modelo' => $request->modelo,
            'year_unidad' => $request->year_unidad,
            'no_serie' => $request->no_serie,
            'placa' => $request->placa,
            'color' => $request->color,
            'gps' => $request->gps,
            'no_gps' => $request->no_gps,
            'observaciones' => $request->observaciones,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        CustodioVehiculo::insert($data);


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$request->custodio_id, $archivo, $archivoNombre);
                $data = [
                    'custodio_id' => $request->custodio_id,
                    'custodio_documentacion_vehiculo_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                VehiculoDocCustodio::insert($data);
            }
        }

            $colIdDocumento = $request->id_documento;
            if ($request->hasfile('foto')) {
                $archivos = $request->file('foto');
                foreach ($archivos as $indice => $archivo) {
                    $archivoNombre = $archivo->hashName();
                    $mimeType = $archivo->getMimeType();
                    Storage::putFileAs('custodio/' . $request->custodio_id, $archivo, $archivoNombre);
                    $data = [
                        'custodio_id' => $request->custodio_id,
                        'fotografia' => $archivoNombre,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'iduserCreated' => auth()->user()->id,
                        'iduserUpdated' => auth()->user()->id
                    ];
                    FotografiaVehiculoCustodio::insert($data);
                }
            }

        $data = [
            'op_vehiculo' => 2,
        ];

        Custodio::where('id', $request->custodio_id)->update($data);

        session()->flash('success', 'El vehiculo se añadió correctamente');
        return redirect()->route('custodio.listadocustodio');  

    }

    public function editarvehiculo($custodio_id)
    {
        $custodio = Custodio::where('id', $custodio_id)->first();

        $documentos = DocumentacionVehiculoCustodio::where('siaf_status',1)->get();

        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documentos as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->tipo_documento_vehiculo.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        $vehiculo = CustodioVehiculo::where('custodio_id', $custodio_id)->first();
        $fotografias = FotografiaVehiculoCustodio::where('custodio_id',$custodio_id)->get();
        $docvehiculo = VehiculoDocCustodio::where('custodio_id',$custodio_id)->get();

        return view('custodio.editar-informacion-vehiculo', compact('custodio', 'cadenaTipoDocumento', 'vehiculo', 'fotografias', 'docvehiculo'));       
    }

    public function eliminardocumentovehiculo(Request $request)
    {
        $doc = VehiculoDocCustodio::findOrFail($request->id);
        $estatus = true;
        if ($doc) {
            Storage::delete('custodio/' . $doc->custodio_id . '/' . $doc->documento);
            VehiculoDocCustodio::where('id', $request->id)->delete();
        } else {
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);   
    }

    public function eliminarfotografia(Request $request)
    {
        $doc = FotografiaVehiculoCustodio::findOrFail($request->id);
        $estatus = true;
        if ($doc) {
            Storage::delete('custodio/' . $doc->custodio_id . '/' . $doc->fotografia);
            FotografiaVehiculoCustodio::where('id', $request->id)->delete();
        } else {
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

    public function editinfovehiculo(Request $request)
    {
        // dd($request);
        $data = [
            'custodio_id' => $request->custodio_id,
            'vehiculo' => $request->vehiculo,
            'modelo' => $request->modelo,
            'no_serie' => $request->no_serie,
            'placa' => $request->placa,
            'year_unidad' => $request->year_unidad,
            'color' => $request->color,
            'gps' => $request->gps,
            'no_gps' => $request->no_gps,
            'observaciones' => $request->observaciones,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        // dd($data);

        CustodioVehiculo::where('custodio_id', $request->custodio_id)->update($data);


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$request->custodio_id, $archivo, $archivoNombre);
                $data = [
                    'custodio_id' => $request->custodio_id,
                    'custodio_documentacion_vehiculo_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                VehiculoDocCustodio::insert($data);
            }
        }

            $colIdDocumento = $request->id_documento;
            if ($request->hasfile('foto')) {
                $archivos = $request->file('foto');
                foreach ($archivos as $indice => $archivo) {
                    $archivoNombre = $archivo->hashName();
                    $mimeType = $archivo->getMimeType();
                    Storage::putFileAs('custodio/' . $request->custodio_id, $archivo, $archivoNombre);
                    $data = [
                        'custodio_id' => $request->custodio_id,
                        'fotografia' => $archivoNombre,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'iduserCreated' => auth()->user()->id,
                        'iduserUpdated' => auth()->user()->id
                    ];
                    FotografiaVehiculoCustodio::insert($data);
                }
            }

        $data = [
            'op_vehiculo' => 2,
        ];

        Custodio::where('id', $request->custodio_id)->update($data);

        session()->flash('success', 'El vehiculo se edito correctamente');
        return redirect()->route('custodio.editarvehiculo',$request->custodio_id);          
    }


    public function agregararma($custodio_id)
    {
        $custodio = Custodio::where('id', $custodio_id)->first();

        $documentos = DocumentacionArmaCustodio::where('siaf_status',1)->get();

        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documentos as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->tipo_documento_arma.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        $arma = CustodioArma::where('custodio_id', $custodio_id)->first();
        $fotografias = FotografiaArmaCustodio::where('custodio_id',$custodio_id)->get();
        $docarma = ArmaDocCustodio::where('custodio_id',$custodio_id)->get();

        return view('custodio.informacion-arma', compact('custodio', 'cadenaTipoDocumento', 'arma', 'fotografias', 'docarma'));
    }

    public function guardarinfoarma(Request $request)
    {
        $data = [
            'custodio_id' => $request->custodio_id,
            'registro_arma' => $request->registro_arma,
            'vigencia_portacion' => $request->vigencia_portacion ? Carbon::createFromFormat('d/m/Y', $request->vigencia_portacion)->format('Y-m-d'):null,
            'observaciones' => $request->observaciones,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        CustodioArma::insert($data);


        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$request->custodio_id, $archivo, $archivoNombre);
                $data = [
                    'custodio_id' => $request->custodio_id,
                    'custodio_documentacion_arma_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                ArmaDocCustodio::insert($data);
            }
        }

            $colIdDocumento = $request->id_documento;
            if ($request->hasfile('foto')) {
                $archivos = $request->file('foto');
                foreach ($archivos as $indice => $archivo) {
                    $archivoNombre = $archivo->hashName();
                    $mimeType = $archivo->getMimeType();
                    Storage::putFileAs('custodio/' . $request->custodio_id, $archivo, $archivoNombre);
                    $data = [
                        'custodio_id' => $request->custodio_id,
                        'fotografia' => $archivoNombre,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'iduserCreated' => auth()->user()->id,
                        'iduserUpdated' => auth()->user()->id
                    ];
                    FotografiaArmaCustodio::insert($data);
                }
            }

        $data = [
            'op_arma' => 2,
        ];

        Custodio::where('id', $request->custodio_id)->update($data);

        session()->flash('success', 'El arma se añadió correctamente');
        return redirect()->route('custodio.listadocustodio');         
    }


    public function editararma($custodio_id)
    {

        $custodio = Custodio::where('id', $custodio_id)->first();

        $documentos = DocumentacionArmaCustodio::where('siaf_status',1)->get();

        //tipo de documentos en formato json
        $cadenaTipoDocumento = "";
        foreach($documentos as $documento){
            $cadenaTipoDocumento .= '"'.$documento->id.'":"'.$documento->tipo_documento_arma.'",';
        }
        $cadenaTipoDocumento = '{'.rtrim($cadenaTipoDocumento, ',').'}';

        $arma = CustodioArma::where('custodio_id', $custodio_id)->first();
        $fotografias = FotografiaArmaCustodio::where('custodio_id',$custodio_id)->get();
        $docarma = ArmaDocCustodio::where('custodio_id',$custodio_id)->get();

        return view('custodio.editar-informacion-arma', compact('custodio', 'cadenaTipoDocumento', 'arma', 'fotografias', 'docarma'));       
    }

    public function editinfoarma(Request $request)
    {
        
        $data = [
            'custodio_id' => $request->custodio_id,
            'registro_arma' => $request->registro_arma,
            'vigencia_portacion' => $request->vigencia_portacion ? Carbon::createFromFormat('d/m/Y', $request->vigencia_portacion)->format('Y-m-d'):null,
            'observaciones' => $request->observaciones,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];

        CustodioArma::where('custodio_id', $request->custodio_id)->update($data);

        $colIdDocumento = $request->id_documento;
        if($request->hasfile('archivo')){
            $archivos = $request->file('archivo');

            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();
                Storage::putFileAs('custodio/'.$request->custodio_id, $archivo, $archivoNombre);
                $data = [
                    'custodio_id' => $request->custodio_id,
                    'custodio_documentacion_arma_id' =>$colIdDocumento[$indice],
                    'documento' => $archivoNombre,
                    'mime_type' => $mimeType,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'updated_at' =>date('Y-m-d H:i:s'),
                    'iduserCreated' =>auth()->user()->id,
                    'iduserUpdated' =>auth()->user()->id
                ];

                ArmaDocCustodio::insert($data);
            }
        }

            $colIdDocumento = $request->id_documento;
            if ($request->hasfile('foto')) {
                $archivos = $request->file('foto');
                foreach ($archivos as $indice => $archivo) {
                    $archivoNombre = $archivo->hashName();
                    $mimeType = $archivo->getMimeType();
                    Storage::putFileAs('custodio/' . $request->custodio_id, $archivo, $archivoNombre);
                    $data = [
                        'custodio_id' => $request->custodio_id,
                        'fotografia' => $archivoNombre,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'iduserCreated' => auth()->user()->id,
                        'iduserUpdated' => auth()->user()->id
                    ];
                    FotografiaArmaCustodio::insert($data);
                }
            }

        $data = [
            'op_arma' => 2,
        ];

        Custodio::where('id', $request->custodio_id)->update($data);

        session()->flash('success', 'El arma se edito correctamente');
        return redirect()->route('custodio.editararma',$request->custodio_id);           
    }

    public function eliminardocumentoarma(Request $request)
    {
        $doc = ArmaDocCustodio::findOrFail($request->id);
        $estatus = true;
        if ($doc) {
            Storage::delete('custodio/' . $doc->custodio_id . '/' . $doc->documento);
            ArmaDocCustodio::where('id', $request->id)->delete();
        } else {
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);   
    }

    public function eliminarfotografiaarma(Request $request)
    {
        $doc = FotografiaArmaCustodio::findOrFail($request->id);
        $estatus = true;
        if ($doc) {
            Storage::delete('custodio/' . $doc->custodio_id . '/' . $doc->fotografia);
            FotografiaArmaCustodio::where('id', $request->id)->delete();
        } else {
            $estatus = false;
        }

        return response()->json([
            'estatus' => $estatus,
        ]);
    }

    public function vercustodio($custodio_id)
    {

        $custodio = Custodio::where('id', $custodio_id)->first();
        $fotografias = FotografiaVehiculoCustodio::where('custodio_id',$custodio_id)->get();

        $active = FotografiaVehiculoCustodio::where('custodio_id', $custodio_id)->first();

        if ($active == null) {
            $ver = 0;
        } else {
            $ver = $active->id;
        }

        $vehiculo = CustodioVehiculo::where('custodio_id', $custodio_id)->first();

        return view('custodio.ver-custodio', compact('custodio', 'fotografias','active', 'ver', 'vehiculo'));      
    }

    public function desactivarcustodio(Request $request)
    {
        $data = [
            'siaf_status' => 2,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Custodio::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se desactivo correctamente');
        return redirect()->route('custodio.listadocustodio');  
    }

    public function listadocustodioinactivo()
    {
        $data = Custodio::where('siaf_status', 2)->get();   

        return view('custodio.listado-custodio-inactivo', compact('data'));       
    }

    public function activarcustodio(Request $request)
    {
        $data = [
            'siaf_status' => 1,
            'iduserUpdated' => auth()->user()->id,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        Custodio::where('id', $request->id)->update($data);

        session()->flash('success', 'El registro se activo correctamente');
        return redirect()->route('custodio.listadocustodioinactivo'); 
    }

    public function fichatecnica($id_custodio)
    {
        $custodio = Custodio::where('id', $id_custodio)->first();
        $custodio_seleccion = CustodioSeleccion::where('custodio_id', $id_custodio)->first();

        $custodio_confianza = CustodioControlConfianza::where('custodio_id', $id_custodio)->first();

        // return  $pdf = \PDF::loadView("custodio.fichatecnica", compact('custodio', 'custodio_seleccion', 'custodio_confianza'))->stream('custodio.pdf');

        return view('custodio.fichatecnica',  compact('custodio', 'custodio_seleccion', 'custodio_confianza','id_custodio'));

    }

}