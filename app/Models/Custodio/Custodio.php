<?php

namespace App\Models\Custodio;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $siaf_status
 * @property string $fecha_ingreso
 * @property string $nombre_custodio
 * @property string $ap_paterno
 * @property string $ap_materno
 * @property integer $edad
 * @property integer $sexo
 * @property string $fecha_nacimiento
 * @property string $lugar_nacimiento
 * @property string $nacionalidad
 * @property string $estado_civil
 * @property string $numero_telefono
 * @property string $correo_electronico
 * @property string $rfc
 * @property string $curp
 * @property string $base
 * @property string $escolaridad
 * @property string $fotografia_custodio
 * @property string $observaciones
 * @property integer $op_vehiculo
 * @property integer $op_arma
 * @property string $dom_calle
 * @property string $dom_num
 * @property string $dom_municipio
 * @property string $dom_estado
 * @property string $dom_cp
 * @property integer $iduserCreated
 * @property string $created_at
 * @property integer $iduserUpdated
 * @property string $updated_at
 * @property SiafStatus $siafStatus
 * @property User $user
 * @property User $user
 * @property CustodioDocumento[] $custodioDocumentos
 * @property CustodioDocVehiculo[] $custodioDocVehiculos
 * @property CustodioFotografiaVehiculo[] $custodioFotografiaVehiculos
 * @property CustodioVehiculo[] $custodioVehiculos
 */
class Custodio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'custodio';

    /**
     * @var array
     */
    protected $fillable = ['siaf_status', 'fecha_ingreso', 'nombre_custodio', 'ap_paterno', 'ap_materno', 'edad', 'sexo', 'fecha_nacimiento', 'lugar_nacimiento', 'nacionalidad', 'estado_civil', 'numero_telefono', 'correo_electronico', 'rfc', 'curp', 'base', 'escolaridad', 'fotografia_custodio', 'observaciones', 'op_vehiculo', 'op_arma', 'dom_calle', 'dom_num', 'dom_municipio', 'dom_estado', 'dom_cp', 'dom_colonia' , 'iduserCreated', 'created_at', 'iduserUpdated', 'updated_at'];


    public function siafStatus()
    {
        return $this->belongsTo('App\Models\SiafStatus', 'siaf_status');
    }

    public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
    
    public function custodioDocumentos()
    {
        return $this->hasMany('App\Models\Custodio\CustodioDocumento');
    }

}
