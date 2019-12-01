<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    PRODUCTOS / PROYECTOS</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">MEF</a></li>
                    <li class="active">Productos / Proyectos</li>
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
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-7">
                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                            <input type="text" v-model="buscar" @keyup.enter="listar()" class="form-control" placeholder="Buscar por código o nombre..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                            <span class="input-group-btn">
                                                                <button type="submit"  @click="listar()"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
                                                        <div class="btn-group" style="float:right;margin-left: 10px;">   
                                                            <button type="button" @click="obtenerProgramas()" class="btn btn-add">
                                                                <i class="fa fa-plus"></i>&nbsp;Agregar producto
                                                            </button>  
                                                        </div>
                                                        <div class="btn-group" style="float:right;">                                                            
                                                            <button type="button" @click="importar()" class="btn btn-import">
                                                                <i class="fa fa-upload"></i>&nbsp;Importar 
                                                            </button>
                                                            <button type="button" @click="descargar(buscar)" class="btn btn-download">
                                                            <i class="fa fa-download"></i>&nbsp;Exportar
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
                                                                        
                                                                        <th style="vertical-align: middle;">#</th>
                                                                        <th style="vertical-align: middle;">CODIGO</th>
                                                                        <th style="vertical-align: middle;">NOMBRE</th>
                                                                        <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>

                                                                    <tr v-for="(midata,index) in listProyect" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td style="text-align: center; vertical-align: middle;"> 
                                                                            <button type="button" @click="editar(midata.id_product)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>                                                                                                                   
                                                                        
                                                                            <button type="button" @click="eliminar(midata.id_product)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
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
                                                            <button type="button" @click="guardar()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar programa
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-horizontal" style="margin-top: 15px"> 
                                                            <div v-bind:class="errorInputActivity" >
                                                                <label  class="col-md-1 control-label">Código</label>
                                                                <div class="col-md-11">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-barcode"></i></span>
                                                                        <input v-model="code" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.code}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-bind:class="errorInputActivity2" >
                                                                <label  class="col-md-1 control-label">Nombre</label>
                                                                <div class="col-md-11">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-suitcase"></i></span>
                                                                        <input v-model="name" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-md-1 control-label">Programas Presup.</label>
                                                                <div class="col-md-11">  
                                                                    <ul class="todo-list ui-sortable" v-for="(midata,index) in listProgram" :key="index" style="margin-bottom: 2px;">
                                                                        <li class="">                                                                                
                                                                            <input type="checkbox" value="" v-model="listProgramx[index].check">                                                                               
                                                                            <small class="label label-warning">{{midata.code}}</small>
                                                                            <!-- <span class="checkmark"></span> -->
                                                                            <span class="text">{{midata.name}}</span>
                                                                        </li>
                                                                    </ul>
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
                listProgram : [],listProyect: [],listProgramx:[],
                code:'',name:'',id:-1,
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity2:'form-group',
                buscar:'',
                
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
        created: function(){
            this.init();
        },
        methods : { 
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.code="";
                this.errors.name="";
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity2='form-group has-success';

                if (!this.code) 
                {   this.errors.code="Ingrese codigo";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity2='form-group has-error';
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

            agregar(){
                let me=this;
                me.listado=2;
            },

            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
                me.listar();
            },

            descargar(buscar){
                var url= '/download_product?buscar='+buscar;;
                window.location.href = url;
            },
           
            editar(id_product){
               //return;
                let me=this; 
                me.listado=2;
                me.limpiarlista();
                me.limpiar();
                
                var url= 'get_proyectt?id_product=' + id_product;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProyect=respuesta.datax;
                    for(var i=0;i<me.listProyect.length;i++){
                        me.code=me.listProyect[i].code;
                         me.name=me.listProyect[i].name;
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_product_program?id_product=' + id_product;
                axios.get(url).then(function (response) {
                    me.obtenerProgramas();
                    var respuesta= response.data;
                    var listactual=respuesta.datax;
                    for(var i=0; i < me.listProgramx.length; i++){
                        for(var j=0; j < listactual.length; j++){
                            if(me.listProgramx[i].id_program==listactual[j].id_program){
                                me.listProgramx[i].check=true;   
                                                             
                            }
                        }
                    }
                    
                })
                .catch(function (error) {
                    console.log(error);
                });                
                               
                
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
                axios.post('save_programx',{
                    'code':this.code,'name':this.name, 
                    'id': this.id,
                    'program':this.listProgramx                 
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1; 
                    me.listar();                  
                    swal(
                        'Guardado!',
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
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.code="";
                this.name="";
                this.id=-1;
            },
        
            listar(){
                let me=this;              
                var url= 'get_proyect?buscar='+me.buscar;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProyect=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            limpiarlista(){
                let me=this;
                for(var i=0; i < me.listProgramx.length; i++){
                         me.listProgramx[i].check=false; 
                    }

            },

            obtenerProgramas(){
                let me=this;
                me.limpiarlista();
                var url= 'get_programx';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram = respuesta.datax;
                    me.listado=2;
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
                axios.post('delete_product',{
                    'id_product': id

                }).then(function (response) {
                   me.listado=1;
                   me.listar();
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
            
            init: function() {
            //cargar actividades
                let me=this;  
                me.listProgramx=[];        
                var url= 'get_program';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var lista=respuesta.datax;
                    for(var i=0; i < lista.length; i++){
                       me.listProgramx.push({ check:false,id_program: lista[i].id_program, id_product:''});
                      
                    }
                   
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
.todo-list:hover{
     border-style:dashed;
     /* border: 1px solid red; */
     border-width: 1px;
     border-color:#90a4ae;
}
/* .container .checkmark {
    background-color: #00B1B0;
} */
</style>


