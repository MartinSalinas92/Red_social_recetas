<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;

use App\Receta;

use App\Categoria;

use App\User;

class RecetaController extends Controller


{

    public function __construct(){
       $this->middleware('auth',['except'=>'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $user_id= Auth::user()->id;

       /*$Receta=Receta::all();

       //dd($Receta);
       
    
      $usuario = DB::table('recetas')->where('user_id', '=', $user_id)->get();
     


        return view('recetas.index',compact('usuario'));*/


        $usuario=DB::table('recetas')
                    ->leftJoin('users','users.id', '=','recetas.user_id')
                    ->leftJoin('categorias','categorias.id', '=','recetas.categoria_id')
                    ->select(
                        'recetas.id',
                        'recetas.titulo',
                        'recetas.ingredientes',
                        'recetas.preparacion',
                        'recetas.imagen',
                        'users.name as nombre_usuario',
                        'categorias.nombre as nombre_categoria'
                    
                    
                    )
                    ->where('user_id','=',$user_id)
                    ->get();

        return view('recetas.index', compact('usuario'));
      



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categoria= Categoria::all();
        
        return view('recetas.create')->with('categoria',$categoria);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



         //return dd($request->all());
       // dd( $request->file('imagen') );

        //dd($request['imagen']->store('upload-Recetas','public'));
        

        //VALIDACION
        $receta=$request->validate([

            'titulo'=>'required|max:50',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'imagen'=>'required',
            'categoria'=>'required',

            



        ]);

        //ALAMCENAR IMAGER CARPETA DE SERVIDOR
        $imagen=$request['imagen']->store('upload-Recetas','public');

        //Redimenziones de la imagen
        $img=Image::make(public_path("storage/{$imagen}"))->fit(1000,500);
        $img->save();

        //ALMACENAR EN LA BASE DE DATOS sin utilizar MODELOS
         DB::table('recetas')->insert([

            'titulo'=>$receta['titulo'],
            'ingredientes'=>$receta['ingredientes'],
            'preparacion'=>$receta['preparacion'],
            'imagen'=>$imagen,
            'user_id'=>Auth::user()->id,
            'categoria_id'=>$receta['categoria']



        ]);
      

        return redirect()->route('recetas.index')->with('datos', 'registrado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return dd($id);

       //$recetas_show=Receta::findOrFail($id);

       // dd($recetas_show);

       $recetas_show=DB::table('recetas')
                        ->leftjoin('users','users.id','=','recetas.user_id')
                        ->leftjoin('categorias','categorias.id','=','recetas.categoria_id')
                        ->select(
                            'recetas.id',
                            'recetas.titulo',
                            'recetas.ingredientes',
                            'recetas.preparacion',
                            'recetas.imagen',
                            'recetas.created_at',
                            'users.name as nombre_usuario_show',
                            'categorias.nombre as nombre_categoria_show'
                        )
                        ->where('recetas.id','=',$id)
                        ->get()

       
       ;

       return view('recetas.show', compact('recetas_show') );


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return dd($id);

        $categoria=Categoria::all();

        $receta_edit=Receta::find($id);



        return view('recetas.edit', compact('receta_edit','categoria'));


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
        //$receta_update=$request;

        // return $receta_update;

       
        $request->validate([

            
            'titulo'=>'required|max:50',
            'preparacion'=>'required',
            'ingredientes'=>'required',
            'categoria'=>'required',

         ]);

         
        $receta_update=Receta::find($id);
         $receta_update->titulo= $request->titulo;
         $receta_update->ingredientes=$request->ingredientes;
         $receta_update->preparacion= $request->preparacion;
         $receta_update->categoria_id= $request->categoria;

        

         

        if($request['imagen_update']){

            //ALAMCENAR IMAGER CARPETA DE SERVIDOR
        $imagen_update=$request['imagen_update']->store('upload-Recetas','public');

        //Redimenziones de la imagen
        $img=Image::make(public_path("storage/{$imagen_update}"))->fit(1000,500);
        $img->save();

        $receta_update->imagen= $imagen_update;

        }else{
            $receta_update->imagen=$request['foto_actual'];
        }

        $receta_update->save();

        


         return redirect()->route('recetas.index');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      
        $receta_destroy=Receta::findOrFail($id);
        $receta_destroy->delete();
        return redirect()->route('recetas.index');
    }
}
