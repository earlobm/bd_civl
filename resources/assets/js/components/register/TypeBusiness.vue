<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Tipo de Negocio
              <small>Registro</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Mantenimiento</a></li>
              <li class="active">Tipo de Negocio</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-plus"></i> Gestión de Tipo de Negocio
                            </h1>
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
                                                                    <div class="row"> 
                                                                        <div class="col-md-12">
                                                                            <div v-bind:class="errorInputActivity2">
                                                                                <label for="ap_paterno">Tipo de Negocio:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-shopping-cart"></i></span>
                                                                                    <input v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
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
                        <div class="box-footer">
                            <button type="button" @click="save_typebusiness()" class="btn btn-save" style="float:right; margin-right: 10px;">
                                <i class="fa fa-save"></i>&nbsp;GUARDAR
                            </button>
                            <button type="button" @click="volver()" class="btn btn-danger" style="float:right; margin-right: 10px;">
                                <i class="fa fa-close "></i>&nbsp;CANCELAR
                            </button>                            
                        </div> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes
                            </h1>
                        
                            <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                            <div class="box-tools pull-right">
                                <span class="label label-success">TOTAL DE REGISTROS: {{pagination.total}}</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                            </div>
                        </div>
                        <template v-if="listado==0">
                            <div align="center">
                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                <!-- <p>Cargando...</p> -->
                            </div>
                        </template>
                        <template v-if="listado==1">
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                        <input type="text"  v-model="search_market" @keyup.enter="ListData(1)"  class="form-control" placeholder="Buscar por código o denominación del Mercado y/o datos del Personal..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                        <span class="input-group-btn">
                                            <button type="submit" @click="ListData(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                        </span>
                                    </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center;">#</th>
                                            <th style="vertical-align: middle; text-align: center;">NOMBRE DE NEGOCIO</th>
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in list_business" :key="index" >
                                            <td style="vertical-align: middle; text-align: center;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.name"></td>
                                            <td style="text-align: center; vertical-align: middle;">                                                                                    
                                                <button type="button" @click="editData(midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </button>                                                                                                                   
                                            
                                                <button type="button" @click="eliminar(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td> 
                                        </tr>                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer">
                                <div class="col-md-6">                                                                                       
                                </div>
                                <div class="col-md-6" style="margin-top: -40px; margin-bottom: -45px;">
                                    <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                        <nav>
                                            <ul class="pagination">
                                                <ul class="pagination">
                                                    <li class="page-item" v-if="pagination.current_page > 1">
                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) - 1)"><i class="fa fa-angle-left" style="color:#189900;cursor: pointer"></i></a>
                                                    </li>
                                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                                    </li>
                                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) + 1)"><i class="fa fa-angle-right" style="color:#189900;cursor: pointer"></i></a>
                                                    </li>
                                                </ul> 
                                            </ul>                        
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </template>
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
    //fecha bot
    export default {
        data (){
            return {
                array_branch:[],
                arrayZona : [],
                list_business : [],idParent:'',year:'',
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                
                listado:1,duenio_parcela:'',participante:'',
                //fechas
                fechaInicio: '01/01/2018',
                authUser:1,
                date_creation: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                options: {
                format: 'DD/MM/YYYY',
                useCurrent: false,
                 locale: 'es',
                 showClose: true,
                },
                pagination : {
					'total' : 0,
					'current_page' : 0,
					'per_page' : 0,
					'last_page' : 0,
					'from' : 0,
					'to' : 0,
                },offset: 3,

                amount:'',name:'',id:-1, personal:'',code:'',
                number_doc:'',
                errorClase : 0,
                errors:{},
                errorInputActivity1:'form-group',
                errorInputActivity2:'form-group',
                errorInputActivity3:'form-group',
                errorInputAmount:'form-group',
                errorComboTipoProduco:'form-group',
                errorTotalAmount:'form-group',
                search_market:'',sex:'',birthdate:'',marital_status:'',
                modal_add:0,  number_doc_add:'', paternal_last_name:'',
                maternal_last_name:'', names:'',
                id_person:'', id_branch_office:'',
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
                this.errors.name="";
                //input
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                
                 
                 if (!this.name) 
                {   this.errors.name="Ingrese la denominación";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
               
                return this.errorClase;
            },     
            validarDataPersonal(){
                this.errors = {};
                this.errorClase=0;
                this.errors.number_doc_add="";
                this.errors.names="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                //input
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                if (!this.number_doc_add){
                    this.errors.number_doc_add="Ingrese el DNI.";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.names){
                    this.errors.names="Ingrese el o los nombres del Personal.";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name){
                    this.errors.paternal_last_name="Ingrese el apellido paterno.";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name){
                    this.errors.maternal_last_name="Ingrese el apellido materno.";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },  
            paginaActual(){
                this.listado=1;
            },
            
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.ListData(page);
                
            },
           
            editData(id){
                let me=this;
                me.listado=1;
                me.limpiar();
                //me.get_branch();
                var url= 'getEditListbusiness?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.name=respuesta.datax[0].name;
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            save_typebusiness(){
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
                axios.post('save_business',{
                    'id':this.id,
                    'name':this.name,
                }).then(function (response) {
                     me.limpiar();
                    me.listado=1; 
                    me.ListData(1);                  
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

            eliminar(id){
                swal({
                title: '¿Esta seguro de eliminar?',
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
                    axios.post('delete_business',{
                        'id': id

                    }).then(function (response) {
                    me.listado=1;
                    me.ListData(1);
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            add_branch_office(){
                let me=this;
                me.listado=2;
               // me.get_branch();
            },
            
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
            },
            limpiar(){
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.name="";
                this.name="";
                this.names="";
                this.id=-1;
            },
            ListData(page){
                let me=this;      
                me.listado=0;        
                var url= 'list_data?search='+me.search_market+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list_business=respuesta.datax;
                    me.pagination= respuesta.pagination; 
                    me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        mounted() {
           this.ListData(1);
        }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

