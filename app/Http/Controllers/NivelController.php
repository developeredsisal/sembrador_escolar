<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mundo;
use App\Models\Nivel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class NivelController extends Controller
{
    public function subir($mundos_id)
    {
        $mundo = Mundo::find($mundos_id);

        return view('subir-nivel', ['mundo' => $mundo]);
    }

    public function mostrarNiveles($id)
    {
        $mundo = Mundo::findOrFail($id);
        $niveles = $mundo->niveles;
        return view('subir-nivel', compact('mundo', 'niveles'));
    }

    public function registrarNivel(Request $request, $id)
    {

        $nivel = new Nivel();

        $nivel->mundo_id = $id;

        $nivel->nombre = $request->input('nombre');
        $nivel->mundo_id = $request->input('mundo_id');
        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $nivel->imagen = $image->getClientOriginalName();
        }

        $nivel->save();

        $image->move(public_path('niveles/' . $nivel->id), $image->getClientOriginalName());

        try {
            return redirect()->route('subir-nivel', ['id' => $nivel->mundo_id])->with('success', 'El nivel se ha creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('subir-nivel', ['id' => $nivel->mundo_id])->with('error', 'Ha habido un error al subir el nivel: ' . $e->getMessage());
        }
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

    public function editarNivel($id_mundo, $id_nivel)
    {
        $mundo = Mundo::find($id_mundo);
        $nivel = Nivel::findOrFail($id_nivel);

        return view('editar-nivel', ['mundo' => $mundo, 'nivel' => $nivel]);
    }

    public function actualizarNivel(Request $request, $id_mundo, $id_nivel)
    {
        $nivel = Nivel::findOrFail($id_nivel);

        $nivel->nombre = $request->input('nombre');
        $nivel->mundo_id = $id_mundo;

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $nivel->imagen = $image->getClientOriginalName();
            $image->move(public_path('niveles/' . $nivel->id), $image->getClientOriginalName());
        }

        $nivel->save();

        return redirect()->route('subir-nivel', ['id' => $id_mundo])->with('success', 'El nivel se ha actualizado exitosamente.');
    }
}