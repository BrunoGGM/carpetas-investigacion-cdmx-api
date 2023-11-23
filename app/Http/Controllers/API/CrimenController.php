<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Crimen;
use Illuminate\Support\Facades\DB;

class CrimenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'mes' => 'nullable|string',
            'delito' => 'nullable|string',
            'categoria' => 'nullable|string',
            'latitud' => 'nullable|string',
            'longitud' => 'nullable|string',
            'radio' => 'nullable|int',
            'total' => 'nullable|int',
        ]);

        $latitudReferencia = $request->latitud ?? 19.350650027091664;
        $longitudReferencia =  $request->longitud ?? -99.06483020304616;
        $umbralDistancia = (int)$request->radio ?? 2;
        $total = (int)$request->total ?? 100;

        $crimenes = Crimen::where('latitud', '!=', 'NA')
            ->where('longitud', '!=', 'NA');

        if ($request->filled('mes')) {
            $crimenes->where('mes_hecho', $request->mes_hecho);
        }

        if ($request->filled('delito')) {
            $crimenes->where('delito', $request->delito);
        }

        if ($request->filled('categoria')) {
            $crimenes->where('categoria', $request->categoria);
        }

        $puntosCercanos = $crimenes->selectRaw(
            '*, (6371 * acos(cos(radians(CAST(? AS NUMERIC))) * cos(radians(CAST(latitud AS NUMERIC))) * cos(radians(CAST(longitud AS NUMERIC)) - radians(CAST(? AS NUMERIC))) + sin(radians(CAST(? AS NUMERIC))) * sin(radians(CAST(latitud AS NUMERIC))))) AS distancia',
            [$latitudReferencia, $longitudReferencia, $latitudReferencia]
        )
            ->groupBy('crimenes.id') // Agrega todas las columnas que no están en funciones de agregación
            ->havingRaw('(6371 * acos(cos(radians(CAST(? AS NUMERIC))) * cos(radians(CAST(latitud AS NUMERIC))) * cos(radians(CAST(longitud AS NUMERIC)) - radians(CAST(? AS NUMERIC))) + sin(radians(CAST(? AS NUMERIC))) * sin(radians(CAST(latitud AS NUMERIC))))) <= ?', [$latitudReferencia, $longitudReferencia, $latitudReferencia, $umbralDistancia])
            ->orderByRaw('(6371 * acos(cos(radians(CAST(? AS NUMERIC))) * cos(radians(CAST(latitud AS NUMERIC))) * cos(radians(CAST(longitud AS NUMERIC)) - radians(CAST(? AS NUMERIC))) + sin(radians(CAST(? AS NUMERIC))) * sin(radians(CAST(latitud AS NUMERIC)))))', [$latitudReferencia, $longitudReferencia, $latitudReferencia])
            ->take($total)
            ->get();


        return response()->json([
            'data' => $puntosCercanos,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
