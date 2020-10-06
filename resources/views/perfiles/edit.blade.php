@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />

    
@endsection



@section('botones')

    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-reply"></i> Volver</a>
    
@endsection


@section('content')

@foreach ($perfiles_edit as $item) 

    <h1 class="text-center mb-5"> Editar perfil de {{$item->nombre}} </h1>

        <div row="justify-content-center mt-5">
           
        <form method="POST" action="{{route('perfiles.update', $item->id)}}" enctype="multipart/form-data"> 
            @method('PUT')
            @csrf
                
            


            

                
            <div class="form-group">
                <label for="">Nombre </label> 

                <input type="hidden" name="id_perfil" id="id_perfil" value={{$item->id}}>

                <input
                    type="text"
                    placeholder="ingrese su nombre" 
                    class="form-control"
                    name="editar_nombre"    
                    id='editar_nombre'
                    value={{$item->nombre}}  
                                
                
                 />

                 @error('editar_nombre')
                 <span class="invalid-feedback d-block" role="alert">
                     
                    <strong>{{$message}} </strong>
 
                 </span>
             @enderror


            </div>
            <div class="form-group">
                <label for="">Sitio Web </label> 

                <input
                    type="text"
                    placeholder="ingrese su url" 
                    class="form-control"
                    name="editar_url"    
                    id='editar_url'
                    value={{$item->url}}  
                                
                
                 />

                 @error('editar_url')
                 <span class="invalid-feedback d-block" role="alert">
                     
                    <strong>{{$message}} </strong>
 
                 </span>
             @enderror


            </div>
            <div class="form-group mt-4"> 

                <label for="biografia">Biografia </label>

                    <input id="editarBiografia" name="editarBiografia" type="hidden" value="{{$item->biografia}}">

                    <trix-editor  input="editarBiografia" class="form-control trix-editor"> </trix-editor>


                    @error('editarBiografia')
                    <span class="invalid-feedback d-block" role="alert">
                        
                       <strong>{{$message}} </strong>
    
                    </span>
                @enderror




            </div>
            <div class="form-group mt-4"> 
                <label for="imagen_perfil"> Imagen </label>
                    <input 
                    type="file" 
                    name="imagen_perfil" 
                    id="imagen_perfil"
                    class="form-control @error('imagen_perfil') is-invalid @enderror"
                    />

                    @if ($item->imagen)
                    <div class="mt-4"> 
                        <p> Imagen Actual </p>
   
                           
                       <img src="/storage/{{$item->imagen}}" style="width: 300px" alt="">
   
                    </div>
                        
                    @endif

                    @error('imagen_perfil')
                    <span class="invalid-feedback d-block" role="alert">
                        
                       <strong>{{$message}} </strong>
    
                    </span>
                @enderror




            </div>


                
            @endforeach


            <div class="form-group mt-4">
                
                <input type="submit" class="btn btn-primary" value="Editar Perfil">



            </div>




            </form>



        </div>


    
@endsection


@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
    
@endsection