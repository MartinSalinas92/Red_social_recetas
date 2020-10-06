@extends('layouts.app')

@section('botones')

<a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-reply"></i> Volver</a>
    
@endsection




@section('content')


<h1 class="text-center mb-5"> Crear Categoria </h1>






    <div class="row justify-content-center mt-5"> 
        <div class="col-md-8"> 
            <form method="POST" action={{route('categorias.store')}}> 
                @csrf
            <div class="form-group"> 
            
            <label id="titulo"> Ingresa el Nombre </label>

                <input 
                input type="text"
                placeholder="Ingresa el nombre"
                class="form-control"
                name="nombre"  
                id="nombre_categoria"              
                />

                @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }} </li>
                          
                      @endforeach
                  </ul>
              
              
                </div>
                  
              @endif


            

             


            </div>

            <div class="form-group"> 

                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
               


            </form>


        </div>


    </div>

    
@endsection
