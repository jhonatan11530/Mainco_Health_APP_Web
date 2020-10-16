<?php
// Este es el controlador
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Operador;
use App\Analista;
use App\Tarea;
use Validator;

class OperadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operador = Operador::all();
        return view('operador.index', compact('operador'));
    }
   

    public function Control()
    {
        $operador = Operador::all();
        return view('control.control', compact('operador'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarea = Tarea::select('id');
        $analista = Analista::select('id');
        return view('operador.crear', compact('analista','tarea'));
    }
  
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $operador = $request->all();
        $validator = Validator::make($operador, [
            'id',
            'nombre',
            'tarea',
            'inicial',
            'hora_inicial',
            'final',
            'hora_final'

        
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            Operador::create($operador);
            return redirect('operador')->with('success','EL OPERADOR SE CREO EXITOSAMENTE !');
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
     * @param  int  $id,editFecha
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
       
        $operador = Operador::find($id);
  
        return view('operador.editar', compact('operador'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $datos = $request->all();
        $operador = Operador::find($id);
        $validator = Validator::make($datos,[
            'codigo_op',
            'id_analista',
            'nombre',
            'tarea',
            'inicial',
            'hora_inicial',
            'final',
            'hora_final',

        ]);
       
         if ($validator->fails()) {
                 return back()->withErrors($validator)->withInput();
            }else{
                        $operador->update($datos);
                        return redirect('operador')->with('info','ACTUALIZO LOS DATOS EXITOSAMENTE !');
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
     $operador = Operador::find($id);
    $operador->delete();
    return redirect('operador')->with('warning','EL OPERADOR FUE BORRADO EXITOSAMENTE !');
    }
}
