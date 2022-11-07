<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioCreateRequest;
use App\Http\Requests\UsuarioEditRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $usuarios = Usuario::all()->sortBy('id');
        return view('usuario.index');
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioCreateRequest $request) {
        try {
            $usuario = new Usuario($request->all());
            $usuario->save();
            $request->session()->put('usuario', $usuario);
            return redirect('post');
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(
                ['default' => '']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario) {
        return view('usuario.show', ['usuario' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario) {
        return view('usuario.edit', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioEditRequest $request, Usuario $usuario) {
        try {
            $usuario->update($request->all());
            return redirect('usuario');   
        } catch(\Exception $e) {
            return back()->withInput()->withErrors(
                ['default' => '']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario) {
        try {
            $usuario->delete();
            return redirect('usuario');
        } catch(\Exception $e) {
            return back()->withErrors(
                ['default' => '']);
        }
    }
    
    public function login() {
        $usuario = Usuario::where('correo', $_POST['login-correo'])->first();
        if ($usuario != null) {
            session()->put('usuario', $usuario);
            return redirect('post');
        } else {
          return back()->withInput()->withErrors(['login-correo' => 'Email no registrado']);
        }
    }
}
