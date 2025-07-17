<?php

namespace App\Models\Usuarios;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $siaf_status
 * @property integer $users_id
 * @property integer $users_id1
 * @property string $tipo_documento
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property SiafStatus $siafStatus
 * @property User $user
 */
class DocumentacionUsuario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user_documentos';

    /**
     * @var array
     */
    protected $fillable = ['siaf_status', 'users_id', 'users_id1', 'tipo_documento', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function siafStatus()
    {
        return $this->belongsTo('App\Models\SiafStatus', 'siaf_status');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   public function userCreated()
    {
        return $this->belongsTo('App\Models\User', 'iduserCreated');
    }
    
    public function userUpdated()
    {
        return $this->belongsTo('App\Models\User', 'iduserUpdated');
    }
   }
