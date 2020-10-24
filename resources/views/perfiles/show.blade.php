@extends('layouts.app')


@section('botones')
    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-reply"></i> Volver </a>
@endsection

@section('content')



<div class="container">
    @foreach ($perfiles as $perfil)

    

    <div class="row">
        <div class="col-md-5"> 

            

            <img src="/storage/{{$perfil->imagen}}" class="w-100" >
                
         

      




        </div>
        <div class="col-md-7"> 
            <h2 class="text-center mb-2 text-primary">{{$perfil->name}} </h2>
             <a href="{{$perfil->url}}"  target="_blank">Sitio Web </a>

             <div class="biografia">

                {!! $perfil->biografia  !!}


             </div>



        </div>


    </div>



</div>
        
    @endforeach
{{$recetas}}
    
@endsection