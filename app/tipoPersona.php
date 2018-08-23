<?php

namespace colegioShaddai;

use Illuminate\Database\Eloquent\Model;

class tipoPersona extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion',
    ];
}
