<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Lectura;
use App\Models\Mundo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class ActividadController extends Controller
{
    public function subirActividades($idMundo, $idNivel, $idLectura)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);
        $actividades = $lectura->actividades;

        return view('subir-actividad', compact('mundo', 'nivel', 'lectura', 'actividades'));
    }
    public function registrarActividad(Request $request, $idMundo, $idNivel, $idLectura)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);

        $actividad = new Actividad();
        $actividad->nombre = $request->input('nombre');
        $actividad->archivo = "index.html";
        $actividad->lectura_id = $lectura->id;
        $actividad->lectura_id = $request->input('lectura_id');

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $actividad->imagen = $image->getClientOriginalName();
        }

        $actividad->save();

        $image->move(public_path('actividades/' . $actividad->id), $image->getClientOriginalName());

        if ($request->hasFile("archivo")) {
            $archivo = $request->file("archivo");
            if ($_FILES["archivo"]["name"]) {
                $nombre = $_FILES["archivo"]["name"];
                $ruta = $_FILES["archivo"]["tmp_name"];
                $tipo = $_FILES["archivo"]["type"];
                $zip = new ZipArchive();
                if ($zip->open($ruta) === true) {
                    $extraido = $zip->extractTo(public_path('actividades/' . $actividad->id));
                    $zip->close();
                }
            }
        }

        try {
            return redirect()->route('subir-actividad', ['idMundo' => $idMundo, 'idNivel' => $idNivel, 'idLectura' => $idLectura])->with('success', 'La actividad se ha subido exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('subir-actividad', ['idMundo' => $idMundo, 'idNivel' => $idNivel, 'idLectura' => $idLectura])->with('error', 'Ha ocurrido un error al subir la actividad');
        }
    }

    public function eliminarActividad($idMundo, $idNivel, $idLectura, $idActividad)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);
        $actividad = $lectura->actividades()->findOrFail($idActividad);

        if ($actividad) {
            $actividad_path = public_path("actividades/{$actividad->id}");

            if (File::exists($actividad_path)) {
                File::deleteDirectory($actividad_path);
            }

            $actividad->delete();

            return redirect()->back()->with('success', 'La actividad se ha eliminado exitosamente.');
        } else {
            return redirect()->back()->with('error', 'No se ha podido eliminar la actividad.');
        }
    }

    public function editarActividad($idMundo, $idNivel, $idLectura, $idActividad)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);
        $actividad = $lectura->actividades()->findOrFail($idActividad);

        return view('editar-actividad', compact('mundo', 'nivel', 'lectura', 'actividad'));
    }

    public function actualizarActividad(Request $request, $idMundo, $idNivel, $idLectura, $idActividad)
    {
        $mundo = Mundo::findOrFail($idMundo);
        $nivel = $mundo->niveles()->findOrFail($idNivel);
        $lectura = $nivel->lecturas()->findOrFail($idLectura);
        $actividad = $lectura->actividades()->findOrFail($idActividad);

        $actividad->nombre = $request->input('nombre');
        $actividad->archivo = "index.html";
        $actividad->lectura_id = $idLectura;

        if ($request->hasFile("imagen")) {
            $image = $request->file("imagen");
            $actividad->imagen = $image->getClientOriginalName();
            $image->move(public_path('actividades/' . $actividad->id), $image->getClientOriginalName());
        }

        $actividad->save();

        if ($request->hasFile("archivo")) {
            $archivo = $request->file("archivo");
            if ($_FILES["archivo"]["name"]) {
                $nombre = $_FILES["archivo"]["name"];
                $ruta = $_FILES["archivo"]["tmp_name"];
                $tipo = $_FILES["archivo"]["type"];
                $zip = new ZipArchive();
                if ($zip->open($ruta) === true) {
                    $extraido = $zip->extractTo(public_path('actividades/' . $actividad->id));
                    $zip->close();
                }
            }
        }

        try {
            return redirect()->route('subir-actividad', ['idMundo' => $idMundo, 'idNivel' => $idNivel, 'idLectura' => $idLectura, 'idActividad' => $idActividad])->with('success', 'La actividad se ha actualizado corrrectamente');
        } catch (\Exception $e) {
            return redirect()->route('subir-actividad', ['idMundo' => $idMundo, 'idNivel' => $idNivel, 'idLectura' => $idLectura, 'idActividad' => $idActividad])->with('error', 'Ha fallado la actualización de la actividad');
        }
    }

    public function actividad($id)
    {
        $actividad = DB::table('actividad')->where('id', '=', $id)->get()->toArray();
        return view('ver-actividad', ['actividad' => $actividad]);
    }
}