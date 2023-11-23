<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Crimen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CrimenHeatMapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hm =  Cache::remember('crimenes-heatmap', 60 * 60 * 24, function () {
            return Crimen::groupBy('alcaldia_hecho')
                  ->selectRaw('count(*) as count, alcaldia_hecho')
                  ->get();
        });

        return response()->json([
            'data' => $hm,
            'total' => $hm->sum('count'),
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
