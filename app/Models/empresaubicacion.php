<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class empresaubicacion extends Model
{
    //
    protected $fillable = ['id_empresas','id_compania','direccion','detalle','lat','lng','detalle'];

}
