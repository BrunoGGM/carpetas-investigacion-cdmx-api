<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crimen extends Model
{
    use HasFactory;

    protected $table = 'crimenes';

    protected $fillable = [
        'anio_hecho',
        'mes_hecho',
        'fecha_hecho',
        'hora_hecho',
        'delito',
        'categoria',
        'competencia',
        'fiscalia',
        'agencia',
        'unidad_investigacion',
        'anio_inicio',
        'mes_inicio',
        'fecha_inicio',
        'hora_inicio',
        'colonia_catalogo',
        'colonia_hecho',
        'alcaldia_hecho',
        'municipio_hecho',
        'latitud',
        'longitud',
    ];
}
