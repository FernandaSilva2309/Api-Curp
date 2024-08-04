<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curp extends Model
{
    use HasFactory;
    protected $fillable = ['curp', 'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'sexo', 'entidad'];

}
