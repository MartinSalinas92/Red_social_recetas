<template>
    
 <input type=submit 
 value="eliminar" 
 class="btn btn-danger d-block w-100"
 v-on:click=EliminarRecetas();
 > 

</template>


<script>

export default {
    
    props:['receta-id'],

   /* mounted() {
        console.log('se ha eliminado', this.recetaId);
    },*/

    methods: {
        EliminarRecetas(){
        this.$swal({
            title: 'Estas seguro que deseas eliminar?',
            text: "Una vez eliminada no se puede recuperar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            confirmButtonCancel: 'No'
            }).then((result) => {
            if (result.value) {

                const param = {
                    id:this.recetaId

                }

                //enviar peticion al servidor

                axios.post(`/recetas/${this.recetaId}`,{param, _method:'delete'})
                    .then(respuesta=>{
                        //console.log(respuesta);
                        this.$swal({
                            title: 'RECETA ELIMINADA',
                            text:' Se elimino la receta',
                            icon: 'success'
                             });

                        //ELIMINAR ELEMENTO DEL DOM

                        //console.log(this.$el);

                        this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                    


                

                    })
                    .catch(error=>{
                        console.log(error);
                    })
                



               /* this.$swal({
                    title: 'Deseas eliminar esta receta?',
                    text:' Se elimino la receta',
                    icon: 'success'
                }
                    


                )*/
            }
            })
        }
    },
}
</script>