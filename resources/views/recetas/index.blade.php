@extends('layouts.app')

@section('botones')

<a href="{{route('recetas.create')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-user-plus"></i> Agregar Recetas </a>

<a href="{{route('categorias.create')}}" class="btn btn-primary mr-2 text-white"><i class="fas fa-folder-plus"></i>Agregar Categorias </a>
    
@endsection

@section('content')





<h1 class="text-center mb-5"> Recetas </h1>

    <div class="col-md-12 mx-auto bg-white p-4">
        <table class="table">
            <thead class="bg-primary text-ligth"> 
                <tr> 

                    <th scole="col">Id </th>
                    <th scole="col">Titulo </th>
                    <th scole="col">Categoria </th>
                    <th scole="col">Acciones </th>
                    
                


                </tr>


            </thead>
            <tbody> 

                    

                    

                  @foreach ($usuario as $item)

                    <tr> 

                        <td> {{$item->id}}</td>
                        <td> {{$item->titulo}}</td>
                        <td> {{$item->nombre_categoria}}</td>

                        <td> 

                       

                            
                           <eliminar-recetas
                                receta-id="{{$item->id}}"
                           > 
                            </eliminar-recetas>
                                
                                  
                      
                              


                        

                        <a href="{{route('recetas.edit', $item->id)}}" class="btn btn-warning d-block"><i class="fa fa-edit"></i>editar</a>
                            
                        <a href="{{route('recetas.show', $item->id)}}" class="btn btn-success d-block">  <i class="far fa-eye"></i>Ver </a>
                        </td>
                    
                     </tr>
                        
                    @endforeach
                        
                    
               



                    
            
                    
                
                
                
            <tbody>
            
        
        
        </table>


    </div>

    
@endsection
