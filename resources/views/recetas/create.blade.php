@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha512-pTg+WiPDTz84G07BAHMkDjq5jbLS/AqY0rU/QdugnfeE0+zu0Kjz++0rrtYNK9gtzEZ33p+S53S2skXAZttrug==" crossorigin="anonymous" />

    
@endsection

@section('botones')

<a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-reply"></i> Volver</a>
    
@endsection




@section('content')


<h1 class="text-center mb-5"> Crear Recetas </h1>






    <div class="row justify-content-center mt-5"> 
        <div class="col-md-8"> 
            <form method="POST" action={{route('recetas.store')}} enctype="multipart/form-data" > 
                @csrf
            <div class="form-group"> 
            
            <label id="titulo"> Ingresa el titulo </label>

                <input 
                input type="text"
                placeholder="Ingresa el titulo"
                class="form-control"
                name="titulo"  
                id="titulo"              
                />

             
                @error('titulo')
                <span class="invalid-feedback d-block" role="alert">
                    
                   <strong>{{$message}} </strong>

                </span>
            @enderror


            </div>
            <div class="form-group"> 

                <label>Categoria </label>

                <select
                name="categoria"
                class="form-control @error('categoria') is-invalid @enderror"
                id="categoria"
                required
                 > 

                    <option >Seleccionar </option>
                    @foreach ($categoria as  $cat)
                        <option value="{{$cat->id}}"
                            {{old('categoria')==$cat->id ? 'selected' : ''}}
                            >{{$cat->nombre}} </option>
                        
                    @endforeach



             </select>

             @error('categoria')
                 <span class="invalid-feedback d-block" role="alert">
                     
                    <strong>{{$message}} </strong>

                 </span>
             @enderror



              </div>

            <div class="form-group mt-4"> 

                <label>ingredientes </label>

                    <input id="ingredientes" name="ingredientes" type="hidden"  value="{{old('ingredientes')}}">

                    <trix-editor input="ingredientes" class="form-control trix-editor"> </trix-editor>

                    @error('ingredientes')
                    <span class="invalid-feedback d-block" role="alert">
                        
                       <strong>{{$message}} </strong>
    
                    </span>
                @enderror



            </div>
            <div class="form-group mt-4"> 

                <label for="preparacion">Preparacion </label>

                    <input id="preparacion" name="preparacion" type="hidden" value="{{old('preparacion')}}">

                    <trix-editor  input="preparacion" class="form-control trix-editor"> </trix-editor>


                    @error('ingredientes')
                    <span class="invalid-feedback d-block" role="alert">
                        
                       <strong>{{$message}} </strong>
    
                    </span>
                @enderror




            </div>
            <div class="form-group">
                <label for="imagen">Imagen </label>

                    <input 
                    type="file"
                    name="imagen"
                    class="form-control  @error('imagen') is-invalid @enderror" 
                    id="imagen"
                    
                    
                    />

                    
             @error('imagen')
             <span class="invalid-feedback d-block" role="alert">
                 
                <strong>{{$message}} </strong>

             </span>
         @enderror

                
             </div>

       

            <div class="form-group"> 

                <input type="submit" class="btn btn-primary" value="Guardar">
            </div>
               


            </form>


        </div>


    </div>

    
@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha512-EkeUJgnk4loe2w6/w2sDdVmrFAj+znkMvAZN6sje3ffEDkxTXDiPq99JpWASW+FyriFah5HqxrXKmMiZr/2iQA==" crossorigin="anonymous" defer></script>
    
@endsection
