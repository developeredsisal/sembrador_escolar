<?php

namespace App\Http\Controllers;

use App\Models\Mundo;
use App\Models\Grado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MundoController extends Controller
{
    public function create()
    {
        $grados = Grado::select('id', 'nombre')->orderByDesc('id')->get();
        return view('mundo', ['grados' => $grados]);
    }

    public function mundos()
    {
        $mundo = Mundo::with('grado')
            ->orderBy('id')
            ->get();
        return view('mundo', compact('mundo'));
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
}