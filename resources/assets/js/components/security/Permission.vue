<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    Permisos</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">SEGURITY</a></li>
                    <li class="active">PERMISOS</li>
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
                                                   
                                                    <div class="col-md-10">
                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                            <input type="text" v-model="buscar" @keyup.enter="listar(year, buscar)" class="form-control" placeholder="Buscar por código o nombre..."  style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                            <span class="input-group-btn">
                                                            <button type="submit" @click="listar(year, buscar)" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="btn-group" style="float:right;margin-left: 10px;">
                                                            <button type="button" @click="guardarRol()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar Rol
                                                            </button>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div v-bind:class="errorname">
                                                                    <label for="nombres">nombre:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input  v-model="name" type="text" class="form-control" placeholder="nombre" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                    </div>
                                                     <div class="col-md-6">
                                                        <div v-bind:class="errordescripcion">
                                                                    <label for="nombres">descripcion:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input  v-model="descripcion" type="text" class="form-control" placeholder="descripcion" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                    </div>
                                                </div>
                                                
                                                        <div class="row">  
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="nombres">SELECCIONE:</label>
                                                                        <div class="input-group">
                                                                        <div class="col-md-4">
                                                                            <label for="nombres">ELIMINAR:</label>
                                                                            <div class="checkbox">
                                                                                    <label class="container">
                                                                                        <input type="checkbox" v-model="eliminar">
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </div> 
                                                                        </div> 
                                                                        <div class="col-md-4">
                                                                            <label for="nombres">EDITAR:</label>
                                                                            <div class="checkbox">
                                                                                    <label class="container">
                                                                                        <input type="checkbox" v-model="editar">
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </div> 
                                                                        </div> 
                                                                        <div class="col-md-4">
                                                                            <label for="nombres">AGREGAR:</label>
                                                                            <div class="checkbox">
                                                                                    <label class="container">
                                                                                        <input type="checkbox" v-model="agregar">
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </div> 
                                                                        </div> 
                                                                            
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                              <div class="row"> 
                                                                 <!--Tabla-->
                                                    <div class="col-md-12">
                                                        <div>
                                                        <div class="box-body table-responsive no-padding">
                                                            <table  class="table table-hover" style="font-size:12px">
                                                                <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   <tr>
                                                                       <tr>  
                                                                        <th style="vertical-align: middle;">#</th>
                                                                        <th style="vertical-align: middle;">CARGO</th>
                                                                        <th style="vertical-align: middle;">DESCRIPCION</th>
                                                                        <th style="vertical-align: middle;">EDITAR</th>
                                                                        <th style="vertical-align: middle;">ELIMINAR</th>
                                                                        <th style="vertical-align: middle;">AGREGAR</th>
                                                                        <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>
                                                                     <tr v-for="(midata,index) in listRol" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.descripcion"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.edit"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.delete_role"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.add_role"></td>
                                                                        <td style="vertical-align: middle;text-align: center;"> 
                                                                            <button title="Rol Permiso" type="button" @click="rolPermiso(midata.id)" class="btn btn-eliminar btn-sm">
                                                                                <i class="fa fa-expeditedssl"></i>
                                                                            </button>
                                                                            <button type="button" @click="editarRol(midata.id)" class="btn btn-editar btn-sm">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>   
                                                                            <button title="Eliminar" type="button" @click="eliminarRol(midata.id)" class="btn btn-eliminar btn-sm">
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
    import VueMoment from 'vue-moment';
    import moment from 'moment-timezone';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

    export default {
        data (){
            return {
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                arrayZona : [],
                listStrategicPlan:[],
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
                
                authUser:1,
                year: ''+ new Date().getFullYear(),
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
                eliminar:'1',agregar:'1',id:-1,descripcion:'',editar:'1',name:'',adit:'',
                errorClase : 0,
                errors:{},
                listRol :[],
                errorname:'form-group',
                errordescripcion:'form-group',
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
            
            validarDataRol(){
                this.errors = {};
                this.errorClase=0;
                this.errors.name="";
                this.errors.descripcion="";
                //input
                this.errorname='form-group has-success';
                 this.errordescripcion='form-group has-success';
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorname='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.descripcion) 
                {   this.errors.descripcion="Ingrese descripcion";
                    this.errordescripcion='form-group has-error';
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
				//me.listar(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin);
                
            },
           
            editarRol(id){
                let me=this;
                //me.listado=2;
               // me.limpiarRol();
                // this.nombre= '';
                var url= 'getEditRol?id='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.name=respuesta.datax[0].name;
                    me.descripcion=respuesta.datax[0].descripcion;
                    me.eliminar=respuesta.datax[0].delete_role;
                    me.editar=respuesta.datax[0].edit;
                    me.agregar=respuesta.datax[0].add_role;
                    me.id=respuesta.datax[0].id;
                    
				}) 
				.catch(function (error) {
				console.log(error);
                });
               //return;
               
            },
            guardarRol(){
                if (this.validarDataRol()){
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
                axios.post('saveRole',{
                    'name':this.name,
                    'descripcion':this.descripcion,
                    'edit':this.editar,
                    'delete_role':this.eliminar,
                    'add_role':this.agregar,
                    'id': this.id
                    
                }).then(function (response) {
                    me.limpiarRol();
                    me.listarRol();
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

            eliminarTypeEgress(id){
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
                axios.post('delete_EgressType',{
                    'id': id

                }).then(function (response) {
                    me.limpiarTypeEgress();
                   me.listado=2;
                   me.listarTypeEgress();
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
                var url= '/download_strategic_plan?buscar='+buscar;;
                window.location.href = url;
            },

            agregar(){
                let me=this;
                me.listado=2;
                //listarTypeIncome();
            },
            
            volver(){
                let me=this;
                me.limpiarTypeEgress();
                me.getComboEgress(1);
                me.listado=1;
            },
            limpiarRol(){
                this.errordescripcion='form-group';
                this.errorname='form-group';
                this.errors = {};
                this.errors.descripcion=" ";
                this.errors.name=" ";
                this.descripcion=" ";
                this.name=" ";
                this.eliminar=" ";
                this.agregar=" ";
                this.editar=" ";
                this.id=-1;
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            
             listarRol(){
                let me=this;  
                //me.listado=0;             
                var url= 'getListRol';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listRol=respuesta.datax;
                   // me.listado=2;
                    
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
        
            listar(year,buscar){
                let me=this;              
                var url= 'get_strategicplan?buscar='+me.buscar +'&year_init='+year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listStrategicPlan=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        mounted() {
           this.listar(this.year, this.buscar);
           this.listarRol();
           this.getComboEgress(1);
           this.listarEgress();
         }
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }
</style>
