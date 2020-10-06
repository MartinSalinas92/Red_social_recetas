@extends('layouts.app')

@section('botones')


<a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-reply"></i> Volver</a>


    
@endsection

@section('content')

<article class="contenido-recetas">



@foreach ($recetas_show as $item)


            <h1 class="text-center mb-5"> {{$item->titulo}} </h1>

            <div class="imagen-receta">
            
            <img src="/storage/{{$item->imagen}}" class="w-100" >

            
            </div>





            </div class="receta-meta">
                <p> 

                    <span class="font-weigth-hold text-primary">Escrito en la Categoria </span>
                        {{$item->nombre_categoria_show}}
                </p>

                <p> 

                    <span class="font-weigth-hold text-primary">Autor:  </span>
                    {{$item->nombre_usuario_show}}


                </p>
                <p> 
                    <span class="font-weigth-hold text-primary"> Fecha:  </span>
                    

                    @php
                        $fecha=$item->created_at
                    @endphp

                    <fecha-recetas fecha="{{$fecha}}"> </fecha-recetas>


                </p>
            

            <div> 

            <div class="ingredientes">
                <h2 class="my-3 text-primary" > Ingredientes </h2> 

                {!!$item->ingredientes!!}


            </div>
            <div class="preparacion">
                <h2 class="my-3 text-primary" > Preparacion </h2> 

                {!!$item->preparacion!!}


            </div>
                
            @endforeach




        




</article>







    
    
@endsection