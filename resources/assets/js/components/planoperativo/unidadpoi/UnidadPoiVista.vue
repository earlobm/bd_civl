<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    UNIDAD POI</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-shopping-cart"></i>Acceso a Mercados</a></li>
                    <li><a href="#">PBG</a></li>
                    <li><a href="#">Emergente</a></li>
                    <li class="active">Estado de Plan</li>
                </ol>
            </section>
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
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-8">
                                                        <div class="input-group input-group-sm" style="margin-bottom: 15px;">
                                                            <input type="text"  class="form-control" placeholder="Buscar por código o nombre...">
                                                            <span class="input-group-btn">
                                                            <button type="submit"  class="btn btn-mostrar btn-flat"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>

                                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="importar()" class="btn btn-import">
                                                                <i class="fa fa-upload"></i>&nbsp;Importar actvidades
                                                            </button>
                                                            <button type="button" @click="agregar()" class="btn btn-add">
                                                                <i class="fa fa-plus"></i>&nbsp;Agregar actividad
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                              <div class="row">
                                                                    <!--Tabla-->
                                                    <div class="col-md-12">
                                                        <div class="box-body table-responsive no-padding">
                                                            <table  class="table table-hover" style="font-size:12px">
                                                                <thead style="background: #90a4ae;color: #fff;">                                                                                   <tr>
                                                                    <tr>  
                                                                        <th style="vertical-align: middle;">#</th>
                                                                        <th style="vertical-align: middle;">CODIGO</th>
                                                                        <th style="vertical-align: middle;">NOMBRE</th>
                                                                        <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(midata,index) in listUnitPoi" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td style="vertical-align: middle;text-align: center;"> 
                                                                            <button type="button" @click="editar(midata.id_poi_unity)" class="btn btn-editar btn-sm">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button> 
                                                                            <button title="Eliminar" type="button" @click="eliminar(midata.id_poi_unity)" class="btn btn-eliminar btn-sm">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button>                                        
                                                                        </td> 
                                                                    </tr>                       
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                                            <nav>
                                                                <ul class="pagination">
                                                                    <li class="page-item" v-if="pagination.current_page > 1">
                                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) - 1,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)">Ant</a>
                                                                    </li>
                                                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)" v-text="page"></a>
                                                                    </li>
                                                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) + 1,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)">Sig</a>
                                                                    </li>
                                                                </ul>                        
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                                </template> 
                                                <template v-if="listado==2">
                                                <div class="row">                                                    
                                                    <div class="col-md-12">
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="volver()" class="btn btn-danger">
                                                                <i class="fa fa-arrow-left"></i>&nbsp;Volver a la lista
                                                            </button>
                                                            <button type="button" @click="guardar()" class="btn btn-add">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar actividad
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                               <div class="col-md-12">
                                                <div class="form-horizontal" style="margin-top: 15px">

                                                   <div class="form-group">
                                                        <div v-bind:class="errorInputActivity" >
                                                            <label  class="col-md-1 control-label">Código</label>
                                                            <div class="col-md-11">
                                                                <input v-model="code" @keyup="validarData()" class="form-control" rows="1" style="border-radius:3px">
                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.code}}</em>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div v-bind:class="errorInputActivity1" >
                                                            <label  class="col-md-1 control-label">NOMBRE</label>
                                                            <div class="col-md-11">
                                                                <input v-model="name" @keyup="validarData()" class="form-control" rows="1" style="border-radius:3px">
                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
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
    </main>
</template>
<script>
    //fecha bot
    export default {
        data (){
            return {
                 clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                arrayZona : [],
                listUnitPoi:[],
                arrayEntrenador : [],
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
                fechaInicio: '01/01/2018',
                authUser:1,
                fechaFin: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                code:'',name:'',id:-1,
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity1:'form-group',    
            }
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

                if (!this.codig) 
                {   this.errors.codig="Ingrese codigo";
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
                var url= 'get_unitpoi?id_poi_unity='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.name=respuesta.datax[0].name;
                    me.code=respuesta.datax[0].code;
                    me.id=respuesta.datax[0].id_poi_unity;
                    
				}) 
				.catch(function (error) {
				console.log(error);
                });
               //return;
               
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
                axios.post('save_UnitPoi',{
                    'code':this.code,'name':this.name, 
                    'id': this.id
                    
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1;
                  me.listar();
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
            agregar(){
                let me=this;
                me.listado=2;
                me.limpiar();
            },
            
            volver(){
                let me=this;
                me.listado=1;
                me.limpiar();
            },
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity1='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.name="";
                this.code="";
                //this.description="";
                this.id=-1;
            },
        
            listar(){
                let me=this;              
                var url= 'get_unitpoi';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listUnitPoi=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        mounted() {
           this.listar();
         }
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }
</style>


