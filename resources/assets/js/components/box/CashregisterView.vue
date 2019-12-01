<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Arqueo de Caja
              <!-- <small>Partida de descargo</small> -->
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li><a href="#"> Caja</a></li>
              <li class="active">Arqueo de Caja</li>
            </ol>
        </section>

         <section class="content">
            <div class="row">
        <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">                            
                            <h1 class="box-title">Agregar Engreso                                
                            </h1>
                            <!--Hola-->
                            <div class="box-tools pull-right">
                            <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> hola hola-->
                            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                            </div>
                        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid">
                        <!-- Ejemplo de tabla Listado -->
                        <div class="card">                            
                            <div class="card-body">    
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <div class="box-body">  
                                            <template v-if="listado==1">
                                                <div class="row">
                                                    <div>                                                  
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-md-1 control-label">FECHA DESDE:</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <date-picker v-model="year2" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>                                                  
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-md-1 control-label">FECHA HASTA:</label>
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <date-picker v-model="year" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                           
                                                    <div class="col-md-1">
                                                        <div class="btn-group" style="float:right; margin-left: 10px;">  
                                                            <button type="button" @click="ver(year)" class="btn btn-add">
                                                                <i class="fa fa-eye"></i>&nbsp;VER.
                                                            </button>
                                                        </div>                                             
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="btn-group" style="float:right; margin-left: 10px;">  
                                                            <button type="button" @click="descargar()" class="btn btn-download">
                                                                <i class="fa fa-download"></i>&nbsp;Exportar
                                                            </button> 
                                                        </div>                                             
                                                    </div>
                                                </div>
                                                 <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            
          <!-- general form elements -->
            
            <!-- /.box-header -->
            <!-- form start -->
               
            <div class="row">
                <div class="box-header with-border">
              <h3 class="box-title">INGRESOS</h3>
            </div> 
               <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">CAJA:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="box" type="text" class="form-control" placeholder="Caja" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
               </div>
               <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">INTERES:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="interes" type="text" class="form-control" placeholder="Interes" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
               </div>
               <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">CAPITAL:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="capital" type="text" class="form-control" placeholder="Capital" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
               </div>
               <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">LIQUIDAR:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="cancelacion" type="text" class="form-control" placeholder="Cancelacion" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
               </div>
               
                
            </div>
            <div class="row">
                <div class="box-header with-border">
              <h3 class="box-title">TABLA</h3>
                </div> 
               <div class="col-md-12">
                                                                <div class="box-body table-responsive no-padding">
                                                                    <table  class="table table-hover" style="font-size:12px">
                                                                        <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                                                            <tr>
                                                                                <th style="vertical-align: middle;">#</th>
                                                                                <th style="vertical-align: middle;">Ingreso</th>
                                                                                <th style="vertical-align: middle;">Monto</th>
                                                                            </tr> 
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                                
                                                               
                </div> 
                <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">TOTAL DE INGRESOS:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="totalingreso" type="text" class="form-control" placeholder="Total de Ingresos" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
               </div>
            </div>
            

        </div>
		 
 
         <div class="col-md-6">
           <!-- general form elements -->
            
            <!-- /.box-header -->
            <!-- form start -->
                
            <div class="row">
                <div class="box-header with-border">
                  <h3 class="box-title">EGRESOS</h3>
                </div>
                 <div class="box-header with-border">
                   <h3 class="box-title">TABLA</h3>
                 </div> 
               <div class="col-md-12">
                                                                <div class="box-body table-responsive no-padding">
                                                                    <table  class="table table-hover" style="font-size:12px">
                                                                        <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                                                            <tr>
                                                                                <th style="vertical-align: middle;">#</th>
                                                                                <th style="vertical-align: middle;">Egreso</th>
                                                                                <th style="vertical-align: middle;">Monto</th>
                                                                            </tr> 
                                                                        </thead>
                                                                    </table>
                                                                </div>
                                                                
                                                               
                </div> 
                <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">TOTAL DE EGRESOS:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="totalegreso" type="text" class="form-control" placeholder="Total de Egresos" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
               </div>
               
               
            </div>
            <div class="row">
            <div>                                                  
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-md-4 control-label">TOTAL (INGRESOS - EGRESOS):</label>
                                                            <div class="col-md-8">
                                                                <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="totalingreso" type="text" class="form-control" placeholder="Total" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                </div>
                                                            </div>
                                                        </div>
            </div>
            </div>
		 </div>
		</div>
                                            </template>
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
    import VueMoment from 'vue-moment';
    import moment from 'moment-timezone';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

    export default {
        data (){
            return {
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',year:'',year2:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                arrayZona : [],
                arraygoal : [],
                arrayactivi : [],
                list_strategic_activity:[],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                listado:1,duenio_parcela:'',participante:'',
                id_asesor_edit:'',localidad_edit:'',denominacion_edit:'',
                dni_dirigente_edit:'',dirigente_edit:'',
                comentario_edit:'',id_asesoramiento:'',id_pbg:'',estado_as:'',
                estado_plan:'', estado:'',
                //fechas
                authUser:1,
                options: {
                format: 'DD/MM/YYYY',
                useCurrent: false,
                 locale: 'es',
                 showClose: true,
                },
                fechaRegistro:'',verzona:false,puede_editar:false,verentrenador:false,
                pagination : {
					'total' : 0,
					'current_page' : 0,
					'per_page' : 0,
					'last_page' : 0,
					'from' : 0,
					'to' : 0,
                },offset: 3,
                datosmapa:'',markers:[],modal:0,
				center: { lat: 45.508, lng: -73.587 }, 
                code:'',name :'',
                idGoal:'',id:-1,
                idActivi:'',   
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity1:'form-group',  
                buscar:'',
            }
        },
        components: {
            datePicker,moment
        },
        computed:{
            isActived: function(){
				return this.pagination.current_page;
			},
			//Calcula los elementos de la paginación
			pagesNumber: function() {
				if(!this.pagination.to) {
					return [];
				}

				var from = this.pagination.current_page - this.offset; 
				if(from < 1) {
					from = 1;
				}

				var to = from + (this.offset * 2); 
				if(to >= this.pagination.last_page){
					to = this.pagination.last_page;
				}  

				var pagesArray = [];
				while(from <= to) {
					pagesArray.push(from);
					from++;
				}
				return pagesArray;             

			}
        },
        methods : { 
                   validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.code="";
                this.errors.name="";
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity1='form-group has-success';

                if (!this.code) 
                {   this.errors.code="Ingrese codigo";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },
            paginaActual(){
                this.listado=1;
            },
            
            cambiarPagina(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.listar(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin);
                
            },
           
            editar(id){
                let me=this;
                me.listado=2;
                 me.limpiar();
                // this.nombre= '';
                var url= 'get_strategic_activity?id_strategic_activity='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.name=respuesta.datax[0].name;
                    me.code=respuesta.datax[0].code;
                    me.id=respuesta.datax[0].id_strategic_activity;
                    me.idGoal=respuesta.datax[0].id_strategic_goal;
                    
				}) 
				.catch(function (error) {
				console.log(error);
                });
               //return;
               
            },
            ver(year){
                let me=this;
                //me.listado=2;           
                me.getGoal(year);
            },
            
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
            },
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity1='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.name="";
                this.code="";
                this.idGoal="";
                this.id=-1;
            },
            getGoal(year){
                let me=this;              
                var url= 'get_goal_strategic?year_init='+year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraygoal=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            getActivi(){
                let me=this;              
                var url= 'get_activity';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayactivi=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            eliminar(id){
                swal({
                title: '¿Esta seguro de eliminar este asistente?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {

                let me = this;
                axios.post('delete_strategicActivity',{
                    'id_strategic_activity': id

                }).then(function (response) {
                    me.limpiar();
                   me.listado=1;
                   me.listar(me.year, me.buscar);
                }).catch(function (error) {
                    console.log(error);
                });

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            guardar(){
                if (this.validarData()){
                    return;
                }
                swal({
                title: 'Esta seguro de guardar la informacion?',
                type: 'warning',
                showCancelButton: true,confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {

                let me = this;
                axios.post('save_strategic_activity',{
                    'code':this.code,'name':this.name,
                    'id': this.id,'idGoal':this.idGoal
                    
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1;
                  me.listar(me.year, me.buscar);
                 // me.listar(1,me.micohort);
                 // me.listado=1;
                    swal(
                        '¡Actualizado!',
                        'El registro ha sido guardado con éxito.',
                        'success'
                        ) 
                }).catch(function (error) {
                    console.log(error);
                });

                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                })
              
            },
             descargar(buscar){               
                var url= '/download_strategic_activity?buscar='+buscar;
                window.location.href = url;
            },
        
            listar(year, buscar){
                let me=this;              
                var url= 'get_strategic_activity?buscar='+me.buscar +'&year_init='+year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list_strategic_activity=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        mounted() {
           //this.getGoal();
            this.getActivi();
           this.listar(this.year, this.buscar);
         }
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }
</style>


