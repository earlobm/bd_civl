<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Bienvenido
              <small>al Sistema de Préstamo y Empeño</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <div class="card">                            
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <div class="box-body">
                                            <div class="row">
                                                <section id="widget-grid" class="">
                                                    <div class="row">
                                                        <article class="col-sm-12">
                                                                <img width="100%" style="border-radius: 3px;" src="img/LOGO-TUMIFINAL.png">
                                                        </article>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>
         </div>
                </div>
            </div>
		</section>
    </main>
</template>

<script>
    export default {
      props : ['ruta'],
        data (){
            return {
                authUser:1,
                
            }
        },
			paginaActual(){
                this.listado=1;
            },
           
        mounted() {
          
         }
    }
   
</script>



