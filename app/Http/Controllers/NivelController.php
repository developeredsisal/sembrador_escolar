<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mundo;
use App\Models\Nivel;
use Illuminate\Support\Facades\File;
use ZipArchive;

class NivelController extends Controller
{
    public function subirNiveles($idMundo)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $niveles = $mundo->niveles;
        return view('subir-nivel', compact('mundo', 'niveles'));
    }

    public function registrarNivel(Request $request, $idMundo)
    {
        $nivel = new Nivel();

        $nivel->nombre = $request->input('nombre');
        $nivel->mundo_id = $idMundo;

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $nivel->imagen = $image->getClientOriginalName();
        }
        $nivel->save();

        $image->move(public_path('niveles/' . $nivel->id), $image->getClientOriginalName());

        try {
            return redirect()->route('subir-nivel', ['idMundo' => $idMundo])->with('success', 'El nivel se ha creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('subir-nivel', ['idMundo' => $idMundo])->with('error', 'Ha habido un error al subir el nivel: ' . $e->getMessage());
        }
    }
    public function editarNivel($idMundo, $idNivel)
    {
        $mundo = Mundo::find($idMundo);
        $nivel = Nivel::findOrFail($idNivel);
        
        return view('editar-nivel', ['mundo' => $mundo, 'nivel' => $nivel]);
    }
    public function actualizarNivel(Request $request, $idMundo, $idNivel)
    {
        $request->validate([
            'nombre' => 'sometimes|max:255',
            'imagen' => 'sometimes|image'
        ]);
        
        $nivel = Nivel::findOrFail($idNivel);
        
        $nivel->nombre = $request->input('nombre');
        $nivel->mundo_id = $idMundo;
        
        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $nivel->imagen = $image->getClientOriginalName();
            $image->move(public_path('niveles/' . $nivel->id), $image->getClientOriginalName());
        }
        $nivel->save();
        
        
        return redirect()->route('subir-nivel', ['idMundo' => $idMundo])->with('success', 'El nivel se ha actualizado exitosamente.');
    }
    public function eliminarNivel($id)
    {
        $nivel = Nivel::find($id);

        if ($nivel) {
            $nivel_path = public_path("niveles/{$nivel->id}");

            if (File::exists($nivel_path)) {
                File::deleteDirectory($nivel_path);
            }

            $nivel->delete();

            return redirect()->back()->with('success', 'El nivel se ha eliminado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se ha podido eliminar el nivel.');
        }
    }
}