<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('crimenes', function (Blueprint $table) {
            $table->id();
            $table->string('anio_hecho');
            $table->string('mes_hecho');
            $table->string('fecha_hecho');
            $table->string('hora_hecho');
            $table->string('delito');
            $table->string('categoria');
            $table->string('competencia');
            $table->string('fiscalia');
            $table->string('agencia');
            $table->string('unidad_investigacion');
            $table->string('anio_inicio');
            $table->string('mes_inicio');
            $table->string('fecha_inicio');
            $table->string('hora_inicio');
            $table->string('colonia_catalogo');
            $table->string('colonia_hecho');
            $table->string('alcaldia_hecho');
            $table->string('municipio_hecho');
            $table->string('latitud');
            $table->string('longitud');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crimenes');
    }
};
