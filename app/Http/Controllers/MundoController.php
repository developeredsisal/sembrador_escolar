<?php

namespace App\Http\Controllers;

use App\Models\Mundo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MundoController extends Controller
{
    public function create()
    {
        $grados = DB::table('grado')->select('id', 'nombre')->orderByDesc('id')->get();
        return view('mundo', ['grados' => $grados]);
    }

    public function mundos()
    {
        $mundos = Mundo::join('grado', 'mundos.grado_id', '=', 'grado.id')
            ->select('mundos.id AS id', 'mundos.nombre AS nombre', 'mundos.imagen AS imagen', 'grado.id AS grado_id', 'grado.nombre AS grado_nombre')
            ->orderBy('id')->get();
        return view('mundo', ['mundos' => $mundos]);
    }

    public function registrarMundo(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'grado' => 'required|integer',
            'imagen' => 'required|image'
        ]);

        $mundo = new Mundo();
        $nombre_mundo = $request->input('nombre');
        $mundo->nombre = $nombre_mundo;
        $mundo->grado_id = $request->input('grado');
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $mundo->imagen = $image->getClientOriginalName();
        }
        $mundo->save();

        $image->move(public_path('mundos/' . $mundo->id), $image->getClientOriginalName());

        try {
            return redirect()->route('mundo')->with('success', 'El mundo se ha creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('mundo')->with('error', 'Ha habido un error al crear el mundo: ' . $e->getMessage());
        }
    }

    public function eliminarMundo($id)
    {
        $mundo = Mundo::find($id);

        if ($mundo) {
            $mundo_path = public_path("mundos/{$mundo->id}");

            if (File::exists($mundo_path)) {
                File::deleteDirectory($mundo_path);
            }

            $mundo->delete();

            return redirect()->back()->with('success', 'El mundo se ha eliminado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se ha podido eliminar el mundo.');
        }
    }

    public function editarMundo($id)
    {
        $mundo = Mundo::find($id);
        $grados = DB::table('grado')->select('id', 'nombre')->orderBy('id')->get();

        return view('editar-mundo', compact('mundo', 'grados'));
    }

    public function actualizarMundo(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'sometimes|max:255',
            'grado' => 'sometimes|integer',
            'imagen' => 'sometimes|image'
        ]);

        $mundo = Mundo::find($id);

        if ($request->has('nombre')) {
            $mundo->nombre = $request->input('nombre');
        }

        if ($request->has('grado')) {
            $mundo->grado_id = $request->input('grado');
        }

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $mundo->imagen = $image->getClientOriginalName();
            $image->move(public_path('mundos/' . $mundo->id), $image->getClientOriginalName());
        }

        $mundo->save();

        try {
            return redirect()->route('mundo')->with('success', 'El mundo se ha actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('mundo')->with('error', 'Ha habido un error al actualizar el mundo: ' . $e->getMessage());
        }
    }

// public function mostrarLecturasConActividades()
// {
//     $lecturas = Lectura::with('actividades')
//         ->join('grado', 'lectura.grado_id', '=', 'grado.id')
//         ->select('lectura.id', 'lectura.nombre', 'lectura.imagen', 'grado.nombre as grado_nombre')
//         ->orderBy('id')->get();

//     return view('inicio', compact('lecturas'));
// }

// public function verActividades($id)
// {
//     $lectura = Lectura::findOrFail($id);
//     $actividades = $lectura->actividades;
//     return view('ver-actividades', compact('lectura', 'actividades'));
// }
}