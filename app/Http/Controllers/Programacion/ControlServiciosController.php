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
use App\Models\Programacion\ControlServicios;

use App\Models\User;
use App\Models\Rol;
use App\Models\RolPermiso;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ControlServiciosController extends Controller
{
    protected $folio;
    public function __construct(Folio $folio)
    {
        $this->middleware('auth');
        $this->folio = $folio;
    }

    public function listcontrolservicios()
    {
        $data = Cliente::where('siaf_status', 1)->get();

        $tarifario = Tarifario::where('siaf_status', 1)->get();

        $estatus_programacion = EstatusProgramacion::where('estatus_activo', 1)
            ->where('estatus_monitoreo', 1)
            ->get();

        $estatus_itinerario = Estatusitinerario::where('activo', 1)
            ->orderBy('id')
            ->get();

        $estadiasListado = DB::table('programacion_estadias')
            ->select('programacion_id',DB::raw('MIN(id) as estadia_id'))
            ->groupBy('programacion_id');



        $monitoreo = Programacion::select('programacion.id','programacion.folio','programacion.folio_interno','programacion.tipo_servicio','programacion.armado_servicio','programacion.custodio_emergente','pe.estatus_programacion','cli.nombre_cliente','programacion.dom_origen','programacion.dom_destino','programacion.fecha_servicio','programacion.programacion_estatus_id','programacion.op_monitoreo_id','programacion.custodio_id','programacion.estatus_custodio','pd.fechahora_llegada_custodio','pd.fechahora_inicio_trayecto','pd.fechahora_llegado_destino','pd.fechahora_finalizacion','pd.estatus_itinerario','ei.descripcion as puntualidad_descripcion','ei.value as puntualidad_causa'
            )
            ->with(['custodio','acompanantesProgramacion.custodio'])
            ->leftJoin('programacion_estatus as pe','pe.id','=','programacion.programacion_estatus_id')
            ->leftJoin('cliente as cli','cli.id','=','programacion.cliente_id')
            ->leftJoinSub($estadiasListado,'pel',function ($join) {$join->on('pel.programacion_id','=','programacion.id');})
            ->leftJoin('programacion_estadias as pd','pd.id','=','pel.estadia_id')
            ->leftJoin('estatus_itinerario as ei','ei.id','=','pd.estatus_itinerario')
            ->where('programacion.siaf_status', 1)

            // Únicamente finalizados
            ->whereIn('programacion.programacion_estatus_id', [6, 7,10])

            // Ordenar por fecha y hora de finalización, de más reciente a más antigua
            ->orderByRaw('pd.fechahora_finalizacion IS NULL ASC')
            ->orderBy('pd.fechahora_finalizacion', 'desc')

            // Orden secundario para registros con la misma fecha
            ->orderBy('programacion.id', 'desc')
            ->get();

        return view('monitoreo.controlservicios.lista-controlservicios', compact('data','monitoreo','estatus_programacion','estatus_itinerario') );
    }

    public function editarcontrolservicios($id_servicio)
    {
    	// dd($id_servicio);
        $estatus_programacion = EstatusProgramacion::where('estatus_activo', 1)
            ->where('estatus_monitoreo', 1)
            ->get();

        $estatus_itinerario = Estatusitinerario::where('activo', 1)
            ->orderBy('id')
            ->get();

        $estadiasListado = DB::table('programacion_estadias')
            ->select('programacion_id',DB::raw('MIN(id) as estadia_id'))
            ->groupBy('programacion_id');

        $monitoreo = Programacion::select('programacion.id','programacion.folio','programacion.folio_interno','programacion.tipo_servicio','programacion.armado_servicio','programacion.custodio_emergente','pe.estatus_programacion','cli.nombre_cliente','programacion.dom_origen','programacion.dom_destino','programacion.fecha_servicio','programacion.programacion_estatus_id','programacion.op_monitoreo_id','programacion.custodio_id','programacion.estatus_custodio','pd.fechahora_llegada_custodio','pd.fechahora_inicio_trayecto','pd.fechahora_llegado_destino','pd.fechahora_finalizacion','pd.estatus_itinerario','ei.descripcion as puntualidad_descripcion','ei.value as puntualidad_causa'
            )
            ->with(['custodio','acompanantesProgramacion.custodio'])
            ->leftJoin('programacion_estatus as pe','pe.id','=','programacion.programacion_estatus_id')
            ->leftJoin('cliente as cli','cli.id','=','programacion.cliente_id')
            ->leftJoinSub($estadiasListado,'pel',function ($join) {$join->on('pel.programacion_id','=','programacion.id');})
            ->leftJoin('programacion_estadias as pd','pd.id','=','pel.estadia_id')
            ->leftJoin('estatus_itinerario as ei','ei.id','=','pd.estatus_itinerario')
            ->where('programacion.id', $id_servicio)

            // Únicamente finalizados
            ->whereIn('programacion.programacion_estatus_id', [6, 7,10])

            // Ordenar por fecha y hora de finalización, de más reciente a más antigua
            ->orderByRaw('pd.fechahora_finalizacion IS NULL ASC')
            ->orderBy('pd.fechahora_finalizacion', 'desc')

            // Orden secundario para registros con la misma fecha
            ->orderBy('programacion.id', 'desc')
            ->get();

            $contolservicios = ControlServicios::where('programacion_id', $id_servicio)->first();
            if($contolservicios == null){
                $op_control = 1;
            }else{
                $op_control = 2;
            }

          return view('monitoreo.controlservicios.editar-controlservicios', compact('monitoreo','estatus_programacion','estatus_itinerario', 'id_servicio', 'contolservicios', 'op_control') );

    }

    public function guardarcontrol(Request $request)
    {
  
        $data = [
            'programacion_id' => $request->id_servicio,
            'estado_admon' => $request->estado_admon,
            'ser_compartido' => $request->ser_compartido,
            'factura_cliente' => $request->factura_cliente,
            'fecha_envio' => $request->fecha_envio,
            'oc_cr' => $request->oc_cr,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'fecha_pago' => $request->fecha_pago,
            'sts' => $request->sts,
            'fac_cu' => $request->fac_cu,
            'fecha_pago_custodio' => $request->fecha_pago_custodio,
            'validado' => $request->validado,
            'hrs_estadia_cu' => $request->hrs_estadia_cu,
            'cosot_hrs_estadia_cu' => $request->cosot_hrs_estadia_cu,
            'km_bit' => $request->km_bit,
            'costo_custodio_dos' => $request->costo_custodio_dos,
            'total_costo' => $request->total_costo,
            'fac_cu_dos' => $request->fac_cu_dos,
            'fecha_pago_cu_dos' => $request->fecha_pago_cu_dos,
            'validado_cu_dos' => $request->validado_cu_dos,
            'observaciones' => $request->observaciones,
            'costo' => $request->costo,
            'total_casetas' => $request->total_casetas,
            'hrs_estadias_bitacora' => $request->hrs_estadias_bitacora,
            'hrs_estadia' => $request->hrs_estadia,
            'km_exced' => $request->km_exced,
            'apoyo' => $request->apoyo,
            'hrs_e_estadia' => $request->hrs_e_estadia,
            'km_exced_dos' => $request->km_exced_doskm_exced_dos,
            'subtotal_cu' => $request->subtotal_cu,
            'iva' => $request->iva,
            'regimen' => $request->regimen,
            'total_factura_custodio' => $request->total_factura_custodio,
            'comprobacion' => $request->comprobacion,
            'costo_servicio_cliente' => $request->costo_servicio_cliente,
            'hrs_estadia_cliente' => $request->hrs_estadia_cliente,
            'total_estadia_cliente' => $request->total_estadia_cliente,
            'validacion_estadia' => $request->validacion_estadia,
            'km_exced_cliente' => $request->km_exced_cliente,
            'km_exced_cliente_precio' => $request->km_exced_cliente_precio,
            'km_exced_cliente_cobro' => $request->km_exced_cliente_cobro,
            'subtotal_cliente' => $request->subtotal_cliente,
            'iva_cliente' => $request->iva_cliente,
            'total_cliente' => $request->total_cliente,
            'created_at' =>date('Y-m-d H:i:s'),
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserCreated' =>auth()->user()->id,
            'iduserUpdated' =>auth()->user()->id,
        ];
        $id_control= ControlServicios::insertGetId($data);


        session()->flash('success', 'La información se añadió correctamente');
        return redirect()->route('controlserv.listcontrolservicios'); 
    }

    public function editcontrol(Request $request)
    {
        // dd($request);
        $data = [
            'estado_admon' => $request->estado_admon,
            'ser_compartido' => $request->ser_compartido,
            'factura_cliente' => $request->factura_cliente,
            'fecha_envio' => $request->fecha_envio,
            'oc_cr' => $request->oc_cr,
            'fecha_vencimiento' => $request->fecha_vencimiento,
            'fecha_pago' => $request->fecha_pago,
            'sts' => $request->sts,
            'fac_cu' => $request->fac_cu,
            'fecha_pago_custodio' => $request->fecha_pago_custodio,
            'validado' => $request->validado,
            'hrs_estadia_cu' => $request->hrs_estadia_cu,
            'cosot_hrs_estadia_cu' => $request->cosot_hrs_estadia_cu,
            'km_bit' => $request->km_bit,
            'costo_custodio_dos' => $request->costo_custodio_dos,
            'total_costo' => $request->total_costo,
            'fac_cu_dos' => $request->fac_cu_dos,
            'fecha_pago_cu_dos' => $request->fecha_pago_cu_dos,
            'validado_cu_dos' => $request->validado_cu_dos,
            'observaciones' => $request->observaciones,
            'costo' => $request->costo,
            'total_casetas' => $request->total_casetas,
            'hrs_estadias_bitacora' => $request->hrs_estadias_bitacora,
            'hrs_estadia' => $request->hrs_estadia,
            'km_exced' => $request->km_exced,
            'apoyo' => $request->apoyo,
            'hrs_e_estadia' => $request->hrs_e_estadia,
            'km_exced_dos' => $request->km_exced_doskm_exced_dos,
            'subtotal_cu' => $request->subtotal_cu,
            'iva' => $request->iva,
            'regimen' => $request->regimen,
            'total_factura_custodio' => $request->total_factura_custodio,
            'comprobacion' => $request->comprobacion,
            'costo_servicio_cliente' => $request->costo_servicio_cliente,
            'hrs_estadia_cliente' => $request->hrs_estadia_cliente,
            'total_estadia_cliente' => $request->total_estadia_cliente,
            'validacion_estadia' => $request->validacion_estadia,
            'km_exced_cliente' => $request->km_exced_cliente,
            'km_exced_cliente_precio' => $request->km_exced_cliente_precio,
            'km_exced_cliente_cobro' => $request->km_exced_cliente_cobro,
            'subtotal_cliente' => $request->subtotal_cliente,
            'iva_cliente' => $request->iva_cliente,
            'total_cliente' => $request->total_cliente,
            'updated_at' =>date('Y-m-d H:i:s'),
            'iduserUpdated' =>auth()->user()->id,
        ];
        ControlServicios::where('id', $request->id_servicio)->update($data);


        session()->flash('success', 'La información se añadió correctamente');
        return redirect()->route('controlserv.listcontrolservicios');        
    }
}