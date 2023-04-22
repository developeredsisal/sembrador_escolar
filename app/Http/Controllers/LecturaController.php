<?php

namespace App\Http\Controllers;

use App\Models\Lectura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class LecturaController extends Controller
{
    public function create()
    {
        $grados = DB::table('grado')->select('id', 'nombre')->orderByDesc('id')->get();
        return view('lectura', ['grados' => $grados]);
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'grado' => 'required|max:32',
            'imagen' => 'required|image'
        ]);

        $lectura = new Lectura();
        $nombre_lectura = $request->input('nombre');
        $lectura->nombre = $nombre_lectura;
        $lectura->grado_id = $request->input('grado');
        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $lectura->imagen = $image->getClientOriginalName();
        }
        $lectura->save();

        $image->move(public_path('lecturas/' . $lectura->id), $image->getClientOriginalName());

        try {
            return redirect()->route('lectura')->with('success', 'La lectura se ha creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('lectura')->with('error', 'Ha habido un error al crear la lectura: ' . $e->getMessage());
        }
    }

    public function eliminar($id)
    {
        $lectura = Lectura::find($id);

        if ($lectura) {
            $lectura_path = public_path("lecturas/{$lectura->id}");

            if (File::exists($lectura_path)) {
                File::deleteDirectory($lectura_path);
            }

            $lectura->delete();

            return redirect()->back()->with('success', 'La lectura se ha eliminado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se ha podido eliminar la lectura.');
        }
    }

    public function editarLectura($id)
    {
        $lectura = Lectura::find($id);
        $grados = DB::table('grado')->select('id', 'nombre')->orderBy('id')->get();

        return view('editar-lectura', compact('lectura', 'grados'));
    }

    public function actualizarLectura(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'sometimes|max:255',
            'grado' => 'sometimes|integer',
            'imagen' => 'sometimes|image|max:1024'
        ]);

        $lectura = Lectura::find($id);

        if ($request->has('nombre')) {
            $lectura->nombre = $request->input('nombre');
        }

        if ($request->has('grado')) {
            $lectura->grado_id = $request->input('grado');
        }

        if ($request->hasFile('imagen')) {
            $image = $request->file('imagen');
            $lectura->imagen = $image->getClientOriginalName();
            $image->move(public_path('lecturas/' . $lectura->id), $image->getClientOriginalName());
        }

        $lectura->save();

        try {
            return redirect()->route('lectura')->with('success', 'La lectura se ha actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('lectura')->with('error', 'Ha habido un error al actualizar la lectura: ' . $e->getMessage());
        }
    }

    public function lecturas()
    {
        $lecturas = Lectura::join('grado', 'lectura.grado_id', '=', 'grado.id')
            ->select('lectura.id AS id', 'lectura.nombre AS nombre', 'lectura.imagen AS imagen', 'grado.id AS grado_id', 'grado.nombre AS grado_nombre')
            ->orderBy('id')->get();
        return view('lectura', ['lecturas' => $lecturas]);
    }

    public function mostrarLecturasConActividades()
    {
        $lecturas = Lectura::with('actividades')
            ->join('grado', 'lectura.grado_id', '=', 'grado.id')
            ->select('lectura.id', 'lectura.nombre', 'lectura.imagen', 'grado.nombre as grado_nombre')
            ->orderBy('id')->get();

        return view('inicio', compact('lecturas'));
    }

    public function verActividades($id)
    {
        $lectura = Lectura::findOrFail($id);
        $actividades = $lectura->actividades;
        return view('ver-actividades', compact('lectura', 'actividades'));
    }
}