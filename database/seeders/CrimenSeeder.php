<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CrimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        try {
            // Especifica la ruta del archivo CSV
            $csvFile = base_path('database/seeders/csv/carpetasFGJ_2023.csv');

            // Lee el archivo CSV
            $csvData = array_map('str_getcsv', file($csvFile));

            // Elimina la primera fila (encabezados)
            array_shift($csvData);

            // Elimina registros con valores nulos
            $cleanedData = array_filter($csvData, function ($row) {
                return !in_array(null, $row);
            });

            // Divide los datos limpios en bloques de 5000 registros
            $chunks = array_chunk($cleanedData, 5000);

            // Inserta en bloques
            foreach ($chunks as $chunk) {
                // Mapea y ajusta las fechas y horas
                $formattedData = array_map(function ($row) {
                    return [
                        'anio_hecho' => $row[0] ?? 'NA',
                        'mes_hecho' => $row[1] ?? 'NA',
                        'fecha_hecho' => $row[2] ?? 'NA',
                        'hora_hecho' => $row[3] ?? 'NA',
                        'delito' => $row[4] ?? 'NA',
                        'categoria' => $row[5] ?? 'NA',
                        'competencia' => $row[6] ?? 'NA',
                        'fiscalia' => $row[7] ?? 'NA',
                        'agencia' => $row[8] ?? 'NA',
                        'unidad_investigacion' => $row[9] ?? 'NA',
                        'anio_inicio' => $row[10] ?? 'NA',
                        'mes_inicio' => $row[11] ?? 'NA',
                        'fecha_inicio' => $row[12] ?? 'NA',
                        'hora_inicio' => $row[13] ?? 'NA',
                        'colonia_catalogo' => $row[14] ?? 'NA',
                        'colonia_hecho' => $row[15] ?? 'NA',
                        'alcaldia_hecho' => $row[16] ?? 'NA',
                        'municipio_hecho' => $row[17] ?? 'NA',
                        'latitud' => $row[18] ?? 'NA',
                        'longitud' => $row[19] ?? 'NA',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }, $chunk);

                // Inserta en la base de datos de manera masiva
                DB::table('crimenes')->insert($formattedData);
            }
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error seeding CrimenSeeder: ' . $e->getMessage());
        }
    }

}
