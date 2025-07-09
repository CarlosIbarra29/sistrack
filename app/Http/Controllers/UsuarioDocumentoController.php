<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
use App\Models\Usuarios\DocumentacionUsuarios;  

class UsuarioDocumentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listadodocusuarios()
    {
        $data = DocumentacionUsuarios::where('siaf_status', 1)->get();

        return view('usuarios.catalogos-usuarios', compact('data'));
    }


    public function datatable(Request $request)
    {
        $documentos = DocumentacionUsuarios::where('activo', 1)->select('id', 'documento_usuario')->get();

        return DataTables::of($documentos)
            ->addIndexColumn()
            ->addColumn('acciones', function($row){
                return '
                    <button class="btn btn-sm btn-primary editar" data-id="'.$row->id.'" data-nombre="'.$row->documento_usuario.'">Editar</button>
                    <button class="btn btn-sm btn-danger desactivar" data-id="'.$row->id.'">Desactivar</button>
                ';
            })
            ->rawColumns(['acciones'])
            ->make(true);
    }

    public function guardar(Request $request)
    {
        $nuevo = new DocumentacionUsuarios();
        $nuevo->documento_usuario = $request->documento_usuario;
        $nuevo->activo = 1;
        $nuevo->save();

        return response()->json(['success' => true]);
    }

    public function editar(Request $request)
    {
        $documento = DocumentacionUsuarios::find($request->id_documento_usuario);
        $documento->documento_usuario = $request->documento_usuario;
        $documento->save();

        return response()->json(['success' => true]);
    }

    public function desactivar(Request $request)
    {
        $documento = DocumentacionUsuarios::find($request->id);
        $documento->activo = 0;
        $documento->save();

        return response()->json(['success' => true]);
    }

    public function inactivos()
    {
        // inactivos
        return view('catalogos.usuarios.documentos_inactivos');
    }
}
