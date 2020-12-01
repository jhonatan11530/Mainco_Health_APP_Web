<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Produccion;
use App\Tarea;
use Validator;
class ProduccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $produccion = Produccion::all();
        return view('produccion.index', compact('produccion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $produccion = Produccion::all();
        return view('produccion.crear', compact('produccion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $produccion = $request->all();
        $validator = Validator::make($produccion, [
            'id',
            'numero_op',
            'cod_producto',
            'descripcion',
            'cantidad',
            'programadas',
            'autorizado'

        ]);
        if ($validator->fails()) {
            
            return back()->withErrors($validator)->withInput();
        } else {
            Produccion::create($produccion);
            return redirect('produccion');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $numero_op
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }


    public function now($id)
    {
        $produccion = Produccion::find($id);
        return view('produccion.nuevo', compact('produccion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $dato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datos = $request->all();
        $produccion = Produccion::find($id);
        $validator = Validator::make($datos,[
        'numero_id',
        'cod_producto',
        'descripcion',
        'cantidad'

        ]);
       
         if ($validator->fails()) {
                 return back()->withErrors($validator)->withInput();
            } else {         
                $produccion->update($datos);
                return redirect('produccion')->with('info','ACTUALIZO LOS DATOS EXITOSAMENTE !');
                }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produccion = Produccion::find($id);
    $produccion->delete();
    return redirect('produccion')->with('warning','LA ORDER DE PRODUCCION FUE BORRADO EXITOSAMENTE !');
    }
}
