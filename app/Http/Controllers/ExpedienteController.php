<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\Consulta;

class ExpedienteController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('q');
        
        if (empty($query)) {
            return response()->json([]);
        }

        // Usamos una consulta Eloquent directa para poder buscar tanto por mascota como por dueño
        $resultados = Mascota::where('nombre', 'like', "%{$query}%")
            ->orWhereHas('dueno', function($q) use ($query) {
                $q->where('nombre_completo', 'like', "%{$query}%");
            })
            ->take(5)->get();
        
        $resultados->loadMissing('dueno');

        $data = $resultados->map(function ($mascota) {
            return [
                'id' => $mascota->id,
                'nombre' => $mascota->nombre,
                'dueno_nombre' => $mascota->dueno ? $mascota->dueno->nombre_completo : 'Sin dueño',
            ];
        });

        return response()->json($data);
    }
    public function index()
    {
        return view('modules.veterinario.expedientes.index');
    }

    public function showConsultasVeterinario($id)
    {
        $mascota = Mascota::with(['dueno', 'consultas' => function ($query) {
            $query->orderBy('fecha_consulta', 'desc');
        }, 'consultas.veterinario'])->findOrFail($id);

        return view('modules.veterinario.expedientes.consultas', compact('mascota'));
    }

    public function showDetalleConsultaVeterinario($mascota_id, $consulta_id)
    {
        $consulta = Consulta::with([
            'veterinario',
            'mascota.dueno',
            'mascota.antecedentesAlergias',
            'mascota.antecedentesLesiones',
            'mascota.antecedentesPatologicos',
            'mascota.historialesAlimentacion'
        ])->where('mascota_id', $mascota_id)->findOrFail($consulta_id);

        return view('modules.veterinario.expedientes.show', compact('consulta'));
    }

    public function indexAdmin()
    {
        return view('modules.admin.expedientes.index');
    }

    public function showConsultasAdmin($id)
    {
        $mascota = Mascota::with(['dueno', 'consultas' => function ($query) {
            $query->orderBy('fecha_consulta', 'desc');
        }, 'consultas.veterinario'])->findOrFail($id);

        return view('modules.admin.expedientes.consultas', compact('mascota'));
    }

    public function showDetalleConsultaAdmin($mascota_id, $consulta_id)
    {
        $consulta = Consulta::with([
            'veterinario',
            'mascota.dueno',
            'mascota.antecedentesAlergias',
            'mascota.antecedentesLesiones',
            'mascota.antecedentesPatologicos',
            'mascota.historialesAlimentacion'
        ])->where('mascota_id', $mascota_id)->findOrFail($consulta_id);

        return view('modules.admin.expedientes.show', compact('consulta'));
    }

    public function diagnosticoVeterinario($mascota_id, $consulta_id)
    {
        $consulta = Consulta::with(['mascota'])->where('mascota_id', $mascota_id)->findOrFail($consulta_id);
        return view('modules.veterinario.expedientes.diagnostico', compact('consulta'));
    }

    public function diagnosticoAdmin($mascota_id, $consulta_id)
    {
        $consulta = Consulta::with(['mascota'])->where('mascota_id', $mascota_id)->findOrFail($consulta_id);
        return view('modules.admin.expedientes.diagnostico', compact('consulta'));
    }
}
