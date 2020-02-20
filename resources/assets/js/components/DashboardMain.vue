<template>
    <main class="main">
        <section class="content-header">
            <h1>
              BIENVENIDO
              <small>AL SISTEMA MUNICIPAL</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-home"></i> Inicio</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row"><div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <div class="small-box bg-yellow">
                            <div class="inner"><h3>2352</h3> <p>Ciudadanos</p>
                            </div> <div class="icon"><i class="ion ion-person-add"></i>
                            </div> <a href="#/customerlist/5" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a></div></div> 
                            <div class="col-lg-3 col-xs-6"><div class="small-box bg-red">
                                <div class="inner"><h3>1210</h3> <p>Recien Nacidos</p>
                                </div> <div class="icon"><i class="ion ion-pie-graph"></i>
                                </div> <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i></a>
                                </div></div> <div class="col-lg-3 col-xs-6"><div class="small-box bg-aqua">
                                    <div class="inner"><h3> 2109</h3> <p>Matrimonio</p>
                                    </div> <div class="icon"><i class="ion ion-bag"></i>
                                    </div> <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i>
                                    </a>
                                    </div>
                                    </div> 
                                    <div class="col-lg-3 col-xs-6">
                                        <div class="small-box bg-green">
                                            <div class="inner"><h3>124</h3> <p>Difuntos</p>
                                            </div> <div class="icon"><i class="ion ion-stats-bars"></i>
                                            </div> <a href="#" class="small-box-footer">Más Info <i class="fa fa-arrow-circle-right"></i>
                                            </a>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
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
                                                                <img width="100%" style="border-radius: 3px;" src="img/logo-perene-legal.png">
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



