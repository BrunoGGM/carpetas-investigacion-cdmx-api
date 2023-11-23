<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Crimen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Filtros extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Cache::remember('categorias-list', 60 * 60 * 24, function () {
            return Crimen::select('categoria')->where('categoria', '!~', '^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$')
                ->distinct()
                ->orderBy('categoria')
                ->get()
                ->pluck('categoria');
        });

        $delitos =  Cache::remember('delitos-list', 60 * 60 * 24, function () {
            return Crimen::select('delito')
                ->where('delito', '!~', "^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$")
                ->distinct()
                ->orderBy('delito')
                ->get()
                ->pluck('delito');
        });

        return response()->json([
            'categorias' => $categorias,
            'delitos' => $delitos,
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
