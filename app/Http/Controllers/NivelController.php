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
    public function subir($mundo_id)
    {
        $mundo = Mundo::find($mundo_id);

        return view('nivel', ['mundo' => $mundo]);
    }

    // public function registrarNivel(Request $request, $id)
    // {

    //     $nivel = new Nivel();

    //     $nivel->mundo_id = $id;

    //     $nivel->nombre = $request->input('nombre');
    //     $nivel->mundo_id = $request->input('mundo_id');
    //     if ($request->hasFile("imagen")) {
    //         $image = $request->file("imagen");
    //         $nivel->imagen = $image->getClientOriginalName();
    //     }

    //     $nivel->save();

    //     $image->move(public_path('niveles/' . $nivel->id), $image->getClientOriginalName());

    //     try {
    //         return redirect()->route('subir-nivel', ['id' => $nivel->mundos_id])->with('success', 'El nivel se ha creado exitosamente.');
    //     } catch (\Exception $e) {
    //         return redirect()->route('subir-nivel', ['id' => $nivel->mundos_id])->with('error', 'Ha habido un error al subir el nivel: ' . $e->getMessage());
    //     }
    // }
}