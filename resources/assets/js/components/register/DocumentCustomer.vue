<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    TIPO DE DOCUMENTO</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registro</a></li>
                    <li class="active">Documento</li>
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
                                                    <template v-if="listado==0">
                                                            <div align="center">
                                                                <img src="img/robot.gif" alt="technoserve" align="middle">
                                                                <p>Cargando...</p>
                                                            </div>
                                                    </template>
                                                    <template v-if="listado==1">
                                                        <div class="row">                                                    
                                                            <div class="col-md-12">
                                                                <div class="btn-group" style="float:right;">
                                                                    
                                                                    <button type="button" @click="save_document()" class="btn btn-save">
                                                                        <i class="fa fa-save"></i>&nbsp;GUARDAR
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">                                                                            
                                                            <div class="col-md-12">
                                                                <legend style="font-size:16px;"><i class="ion ion-edit"></i><strong>&nbsp;DATOS DEL DOCUMENTO</strong></legend>
                                                            </div>   

                                                            <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="ap_paterno">Tipo de Documento:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="name" type="text" class="form-control" placeholder="Apellido Paterno" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>                                                                                                      
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="input-group" style="margin-bottom: 15px;">
                                                                    <input type="text"  v-model="search_market" @keyup.enter="list_data(1)"  class="form-control" placeholder="Buscar tipo de documento." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                                    </span>
                                                                </div>                                               
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="box-body table-responsive no-padding">
                                                                    <table  class="table table-hover" style="font-size:12px">
                                                                        <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                                                            <tr>
                                                                                <th style="vertical-align: middle; text-align: center;">#</th>
                                                                                <th style="vertical-align: middle; text-align: center;">NOMBRE DE DOCUMENTO</th>
                                                                                <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(midata,index) in list_document" :key="index" >
                                                                                <td style="vertical-align: middle; text-align: center;" >{{(index+1)}}</td>
                                                                                <td style="vertical-align: middle; text-align: center;" v-text="midata.name"></td>
                                                                                <td style="text-align: center; vertical-align: middle;">                                                                                    
                                                                                    <button type="button" @click="editar(midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </button>                                                                                                                   
                                                                                
                                                                                    <button type="button" @click="eliminar(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
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
    //fecha bot
    export default {
        data (){
            return {
                array_branch:[],
                arrayZona : [],
                list_document : [],idParent:'',year:'',
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
				me.list_data(page);
                
            },
           
            editar(id){
                let me=this;
                me.listado=2;
               // me.limpiar();
                //me. get_branch();
                var url= 'getEditListDocument?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.name=respuesta.datax[0].name;
                    me.validarData();
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            save_document(){
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
                axios.post('save_Document',{
                    'id':this.id,
                    'name':this.name,
                }).then(function (response) {
                     me.limpiar();
                    me.listado=1; 
                    me.list_data(1);                  
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
                    axios.post('delete_Document',{
                        'id': id

                    }).then(function (response) {
                    me.listado=1;
                    me.list_data(1);
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            add_branch_office(){
                let me=this;
                me.listado=2;
                me.get_branch();
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
            list_data(page){
                let me=this;      
                me.listado=0;        
                var url= 'getlistDocument';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.list_document=respuesta.datax;
                     //me.pagination= respuesta.pagination; 
                     me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        mounted() {
           this.list_data(1);
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

