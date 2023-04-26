<?php

namespace App\Http\Controllers;

use App\Models\Mundo;
use App\Models\Lectura;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class LecturaController extends Controller
{
    public function subirLecturas($idMundo, $idNivel)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lecturas = $nivel->lecturas;

        return view('subir-lectura', compact('mundo', 'nivel', 'lecturas'));
    }
    public function mostrarLecturas($idMundo, $idNivel)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lecturas = $nivel->lecturas;

        return view('subir-lectura', compact('mundo', 'nivel', 'lecturas'));
    }
    public function registrarLectura(Request $request, $idMundo, $idNivel)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);

        $lectura = new Lectura();
        $lectura->nombre = $request->input('nombre');
        $lectura->nivel_id = $nivel->id;

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $lectura->imagen = $image->getClientOriginalName();
        }

        $lectura->save();

        $image->move(public_path('lecturas/' . $lectura->id), $image->getClientOriginalName());

        try {
            return redirect()->route('subir-lectura', ['idMundo' => $idMundo, 'idNivel' => $idNivel])->with('success', 'La lectura se ha subido exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('subir-lectura', ['idMundo' => $idMundo, 'idNivel' => $idNivel])->with('error', 'Ha habido un error al subir la lectura: ' . $e->getMessage());
        }
    }
    public function editarLectura($idMundo, $idNivel, $idLectura)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);

        return view('editar-lectura', compact('mundo', 'nivel', 'lectura'));
    }
    public function actualizarLectura(Request $request, $idMundo, $idNivel, $idLectura)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);

        $lectura->nombre = $request->input('nombre');

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $lectura->imagen = $image->getClientOriginalName();
            $image->move(public_path('lecturas/' . $lectura->id), $image->getClientOriginalName());
        }

        $lectura->save();

        try {
            return redirect()->route('subir-lectura', ['idMundo' => $idMundo, 'idNivel' => $idNivel])->with('success', 'La lectura se ha actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('subir-lectura', ['idMundo' => $idMundo, 'idNivel' => $idNivel])->with('error', 'Ha habido un error al actualizar la lectura: ' . $e->getMessage());
        }
    }
    public function eliminarLectura($idMundo, $idNivel, $idLectura)
    {
        try {
            $mundo = Mundo::findOrFail($idMundo);
            $nivel = $mundo->niveles()->findOrFail($idNivel);
            $lectura = $nivel->lecturas()->findOrFail($idLectura);

            if (!empty($lectura->imagen)) {
                $rutaImagen = public_path('lecturas/' . $lectura->id . '/' . $lectura->imagen);
                if (file_exists($rutaImagen)) {
                    unlink($rutaImagen);
                }
            }

            $lectura->delete();

            return redirect()->route('subir-lectura', ['idMundo' => $idMundo, 'idNivel' => $idNivel])->with('success', 'La lectura se ha eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('subir-lectura', ['idMundo' => $idMundo, 'idNivel' => $idNivel])->with('error', 'Ha habido un error al eliminar la lectura: ' . $e->getMessage());
        }
    }
}