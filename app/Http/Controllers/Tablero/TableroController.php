<?php

namespace App\Http\Controllers\Tablero;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use App\Models\Notificaciones\Notificaciones;
// use App\Models\Notificaciones\NotificacionesUsuario;
use App\Models\Programacion\Programacion;
use App\Models\Cliente\Cliente;

use App\Models\Licitacion\LicitacionSegmento;
use App\Models\Licitacion\ProposicionEconomica;
use App\Models\Licitacion\Licitacion;

use App\Models\Programacion\EstatusProgramacion;
use App\Models\Programacion\BitacoraViaje;

class TableroController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function show()
    {
    	// $not = Notificaciones::where('users_permiso', auth()->user()->id)->orderBy('id','ASC')->get();
        $not=1;

        $programcion = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio', 'programacion.programacion_estatus_id', 'programacion.op_monitoreo_id',  'programacion.custodio_id', 'cli.razon_social', 'programacion.estatus_viaje_id')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.siaf_status', 1)
            ->get();

        return view('tablero.show', compact('not', 'programcion'));
    }

    public function vernotconcurso($licitacion)
    {

    	$info = Licitacion::findOrFail($licitacion);
    	$cliente = Cliente::where('id_cliente', $info->cliente)->first();
        $proposicioneconomica = LicitacionSegmento::where("licitacion_id", $licitacion)->get();
        
        $segmento =ProposicionEconomica::select('licitacion_proposicion_economica.id', 'licitacion_proposicion_economica.licitacion_id','licitacion_proposicion_economica.segmento_id',
            'licitacion_proposicion_economica.cantidad', 'licitacion_proposicion_economica.precio_unitario',
            'tv.tipo_vehiculo','sc.carroceria','sm.motor','st.transmision')
            ->leftjoin("segmentos as sg","sg.id","licitacion_proposicion_economica.segmento_id")
            ->leftjoin("segmento_tipo_vehiculo as tv","tv.id","sg.tipo_vehiculo_id")
            ->leftjoin("segmento_carroceria as sc","sc.id","sg.carroceria_id")
            ->leftjoin("segmento_motor as sm","sm.id","sg.motor_id")
            ->leftjoin("segmento_transmision as st","st.id","sg.transmision_id")
            ->where("licitacion_proposicion_economica.licitacion_id",$licitacion)
            ->get();

        return view('tablero.notificacion-concursos', compact('licitacion', 'info', 'proposicioneconomica', 'segmento', 'cliente'));

    }

    public function viajeprogramado($id_programacion)
    {
        
        $programcion = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio', 'programacion.programacion_estatus_id', 'programacion.op_monitoreo_id',  'programacion.custodio_id', 'cli.razon_social', 'programacion.estatus_viaje_id')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.id', $id_programacion)
            ->get();
        
        // $estatus_viaje
        $bitacora_viaje = BitacoraViaje::where("programacion_id", $id_programacion)->get();
        $estatus_viaje = Programacion::where("id", $id_programacion)->first();

        return view('tablero.viaje-custodio', compact('programcion', 'id_programacion', 'bitacora_viaje', 'estatus_viaje'));
    }

    public function evidenciabitacora(Request $request)
    {

        $programcion = Programacion::select('programacion.id','programacion.folio', 'programacion.tipo_servicio', 'pe.estatus_programacion', 'cli.nombre_cliente', 'programacion.dom_origen', 'programacion.dom_destino', 'programacion.fecha_servicio', 'programacion.programacion_estatus_id', 'programacion.op_monitoreo_id',  'programacion.custodio_id', 'cli.razon_social', 'programacion.estatus_viaje_id')
            ->leftjoin("programacion_estatus as pe","pe.id","programacion.programacion_estatus_id")
            ->leftjoin("cliente as cli","cli.id","programacion.cliente_id")
            ->where('programacion.id', $request->id_programacion)
            ->first();

        
        if($request->hasfile('file_carga')){
            $archivos = $request->file('file_carga');
            
            foreach($archivos as $indice => $archivo)
            {
                $archivoNombre = $archivo->hashName();
                $mimeType = $archivo->getMimeType();

                Storage::putFileAs('programacion/'.$request->id_programacion, $archivo, $archivoNombre);
                $data = [
                    'programacion_id' => $request->id_programacion,
                    'imagen' =>$archivoNombre,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'estatus_viaje_id' => $programcion->estatus_viaje_id,
                    'iduserCreated' =>auth()->user()->id,
                ];

                BitacoraViaje::insert($data);
            }
        }

        session()->flash('success', 'La evidencia se guardo correctamente');
        return redirect()->route('tablero.viajeprogramado', $request->id_programacion);  

    }

    public function viajecambiostatus(Request $request)
    {
        if($request->op_estatus == 1){ $estatus = $request->estatus + 1; }else{  $estatus = $request->estatus - 1; }

        $data = [
            'estatus_viaje_id' => $estatus,
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserUpdated' =>auth()->user()->id,
        ];
        Programacion::where('id', $request->id)->update($data);


        session()->flash('success', 'El estatus se modifico correctamente');
        return redirect()->route('tablero.viajeprogramado', $request->id);  

    }

}


