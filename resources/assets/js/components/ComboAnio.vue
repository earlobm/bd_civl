<template>
     <li class="dropdown show">
                <a href="#" data-toggle="dropdown" aria-expanded="true" class="dropdown-toggle">
                  <i class="fa fa-cog"></i><b>Año Operacional</b>  <span class="caret"></span>
                </a> 
                <ul role="menu" class="dropdown-menu" style="border-radius: 3px; margin-top: 1.5px;">
                  <li><a @click="mostrar_colum(idanio=2022)" href="#">2022</a></li> 
                  <li><a @click="mostrar_colum(idanio=2021)" href="#">2021</a></li>
                  <li><a href="#">2020</a></li>
                </ul>
              </li>
</template>

<script>
    export default {
        props : ['idanio'],
        mounted() {
            console.log('Component mounted.')
        },
          created: function(){
           // this.idanio=this.idanio;
        },
         methods : { 
            mostrar_colum(val){
                  this.idanio=val;
            }
        }
    }
</script>
