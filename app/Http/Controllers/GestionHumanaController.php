<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestion;
use App\Operador;
use Validator;
class GestionHumanaController extends Controller
{
    //

    public function index()
    {
        $gestion = Gestion::all();
        return view('humana.index', compact('gestion'));
    }


    public function create()
    {
        $operador = Operador::all();
        return view('humana.crear', compact('analista','operador'));
    }

    public function store(Request $request)
    {
       
        $gestion = $request->all();
        $validator = Validator::make($gestion, [
            'id',
            'nombre',
            'inicial',
            'final',
            'motivo',
            'tiempo',
            'fecha',
            'observacion',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            Gestion::create($gestion);
            return redirect('humana')->with('success','EL REGISTRO FUE EXITOSAMENTE !');
        }
    }

    public function edit($id)
    {

        $produccion = Gestion::find($id);
        return view('humana.editar', compact('humana'));
    }

    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $produccion = Gestion::find($id);
        $validator = Validator::make($datos,[
            'id',
            'nombre',
            'inicial',
            'final',
            'tiempo',

        ]);
       
         if ($validator->fails()) {
                 return back()->withErrors($validator)->withInput();
            } else {         
                $produccion->update($datos);
                return redirect('produccion')->with('info','ACTUALIZO LOS DATOS EXITOSAMENTE !');
                }
    }

    public function destroy($id)
    {
        $produccion = Gestion::find($id);
    $produccion->delete();
    return redirect('produccion')->with('warning','EL OPERADOR FUE BORRADO EXITOSAMENTE !');
    }
}
