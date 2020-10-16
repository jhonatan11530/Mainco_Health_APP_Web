<?php
// Este es el controlador
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Roles;
use Validator;
use Hash;
use Auth;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
    
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Roles::all();

        return view('usuarios.crear',compact('rol'));
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = $request->all();
        $validator = Validator::make($usuario, [
            'nomusuario' => 'required|max:50',
            'apeusuario' => 'required|max:50',
            'password' => 'required|max:50',
            'cedula' => 'required|max:150',
            'rol' => 'required',
            'cargo' => 'required'

     
        
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();

        } 
        $usuario['password'] = Hash::make($usuario['password']);
        $usuario['rol'] = $usuario['rol'];
        
        
            Usuario::create($usuario);
            return redirect('usuarios')->with('success','EL USUARIO SE CREO EXITOSAMENTE !');
    
    }

    /**/
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        return view('usuarios.editar', compact('usuario'));
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
        $nuevosDatosUsuario = $request->all();
        $usuario = Usuario::find($id);
        $validator = Validator::make($nuevosDatosUsuario,[
            'nomusuario' => 'required|max:50',
            'apeusuario' => 'required|max:50',
            'password' => 'required|max:50',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();

        }else{
            $nuevosDatosUsuario['password'] = Hash::make($nuevosDatosUsuario['password']);
            $usuario->update($nuevosDatosUsuario);
            return redirect('usuarios')->with('info','ACTUALIZO LOS DATOS EXITOSAMENTE !');
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
        Usuario::find($id)->delete();
        return redirect('usuarios')->with('warning','EL USUARIO FUE BORRADO EXITOSAMENTE !');
    }
}
