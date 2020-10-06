<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use App\Perfil;
use Illuminate\Http\Request;
use App\User;


class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)

    {

            $user_id= Auth::user()->id;
            $perfiles=DB::table('perfils')
                    ->leftJoin('users', 'users.id' ,"=", 'perfils.user_id')
                    ->select(
                    'users.id',
                    'users.name',
                    'users.url',
                    'perfils.biografia',
                    'perfils.imagen')
                    ->where('user_id','=', $user_id)
                    ->get();

            return view('perfiles.show',compact('perfiles'));




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        $user_id= Auth::user()->id;
            $perfiles_edit=DB::table('perfils')
                    ->leftJoin('users', 'users.id' ,"=", 'perfils.user_id')
                    ->select(
                    'users.id',
                    'users.name as nombre',
                    'users.url',
                    'perfils.id as id_perfil',
                    'perfils.biografia',
                    'perfils.imagen')
                    ->where('user_id','=', $user_id)
                    ->get();

            return view('perfiles.edit',compact('perfiles_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {
     

        //validar
        $perfiles=request()->validate([
         
            'editar_nombre'=>'required',
            'editar_url'=>'required',
            'editarBiografia'=>'required',
            'imagen_perfil'=>'required'

        ]);

        //return dd($perfiles['imagen_perfil']);

        //$imagen=$request->all();

       
        if($perfiles['imagen_perfil']){

            //ALAMCENAR IMAGER CARPETA DE SERVIDOR
        $imagen_perfil=$perfiles['imagen_perfil']->store('upload-Perfiles','public');

        //Redimenziones de la imagen
        $img=Image::make(public_path("storage/{$imagen_perfil}"))->fit(1000,500);
        $img->save();


        $datos = array('imagen' => $imagen_perfil );

        }

    

        
        $id_usuario=$request['id_perfil'];



        $editaUsuario=DB::table('users')
                   -> where('id',$id_usuario)
                   ->update([

                        'name'=>$perfiles['editar_nombre'],
                        'url'=>$perfiles['editar_url']

                   ]);

        
        $editrPerfil=DB::table('perfils')
                    ->where('user_id',$id_usuario)
                    ->update([

                        'biografia'=>$perfiles['editarBiografia'],
                        'imagen'=>$datos

                    ]);

        
            return view('perfiles.show');

      



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
