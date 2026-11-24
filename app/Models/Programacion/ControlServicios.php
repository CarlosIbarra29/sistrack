<?php


namespace App\Models\Programacion;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $programacion_id
 * @property string $estado_admon
 * @property string $ser_compartido
 * @property string $factura_cliente
 * @property string $fecha_envio
 * @property string $oc_cr
 * @property string $fecha_vencimiento
 * @property string $fecha_pago
 * @property string $sts
 * @property integer $fac_cu
 * @property string $fecha_pago_custodio
 * @property string $validado
 * @property string $hrs_estadia_cu
 * @property string $cosot_hrs_estadia_cu
 * @property string $km_bit
 * @property string $costo_custodio_dos
 * @property string $total_costo
 * @property string $fac_cu_dos
 * @property string $fecha_pago_cu_dos
 * @property string $validado_cu_dos
 * @property string $observaciones
 * @property string $costo
 * @property string $total_casetas
 * @property string $hrs_estadias_bitacora
 * @property string $hrs_estadia
 * @property string $km_exced
 * @property string $apoyo
 * @property string $hrs_e_estadia
 * @property string $km_exced_dos
 * @property string $subtotal_cu
 * @property string $iva
 * @property string $regimen
 * @property string $total_factura_custodio
 * @property string $comprobacion
 * @property string $costo_servicio_cliente
 * @property string $hrs_estadia_cliente
 * @property string $total_estadia_cliente
 * @property string $validacion_estadia
 * @property string $km_exced_cliente
 * @property string $km_exced_cliente_precio
 * @property string $km_exced_cliente_cobro
 * @property string $subtotal_cliente
 * @property string $iva_cliente
 * @property string $total_cliente
 * @property string $created_at
 * @property string $updated_at
 * @property integer $iduserCreated
 * @property integer $iduserUpdated
 * @property User $user
 * @property Programacion $programacion
 * @property User $user
 */
class ControlServicios extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['programacion_id', 'estado_admon', 'ser_compartido', 'factura_cliente', 'fecha_envio', 'oc_cr', 'fecha_vencimiento', 'fecha_pago', 'sts', 'fac_cu', 'fecha_pago_custodio', 'validado', 'hrs_estadia_cu', 'cosot_hrs_estadia_cu', 'km_bit', 'costo_custodio_dos', 'total_costo', 'fac_cu_dos', 'fecha_pago_cu_dos', 'validado_cu_dos', 'observaciones', 'costo', 'total_casetas', 'hrs_estadias_bitacora', 'hrs_estadia', 'km_exced', 'apoyo', 'hrs_e_estadia', 'km_exced_dos', 'subtotal_cu', 'iva', 'regimen', 'total_factura_custodio', 'comprobacion', 'costo_servicio_cliente', 'hrs_estadia_cliente', 'total_estadia_cliente', 'validacion_estadia', 'km_exced_cliente', 'km_exced_cliente_precio', 'km_exced_cliente_cobro', 'subtotal_cliente', 'iva_cliente', 'total_cliente', 'created_at', 'updated_at', 'iduserCreated', 'iduserUpdated'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function programacion()
    {
        return $this->belongsTo('App\Models\Programacion\Programacion');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
}
