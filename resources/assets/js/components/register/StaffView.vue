<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    GESTIÓN DE PROMOTORES</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">Empleado</a></li>
                    <li class="active">Datos</li>
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
                                                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                                                <p>Cargando...</p>
                                                            </div>
                                                    </template>
                                                    <template v-if="listado==1">
                                                        <div class="row">
                                                            <div class="col-xs-11 col-sm-4 col-md-5 col-lg-7">
                                                                <div class="input-group" style="margin-bottom: 15px;">
                                                                    <input type="text"  v-model="buscar" @keyup.enter="listar(1)"  class="form-control" placeholder="Buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" @click="listar(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                                    </span>
                                                                </div>                                               
                                                            </div>
                                                            <div class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                                <div class="btn-group" style="float:right;margin-left: 10px;">   
                                                                    <button type="button" @click="agregar()" class="btn btn-add">
                                                                        <i class="fa fa-plus"></i>&nbsp;Agregar personal
                                                                    </button>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="box-body table-responsive no-padding">
                                                                    <table  class="table table-hover" style="font-size:12px">
                                                                        <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                                                            <tr>
                                                                                <th style="vertical-align: middle;">#</th>
                                                                                <th style="vertical-align: middle;">DNI</th>
                                                                                <th style="vertical-align: middle;">NOMBRE</th>
                                                                                 <th style="vertical-align: middle;">SUCURSAL</th>
                                                                                  <th style="vertical-align: middle;">MERCADO</th>
                                                                                  <th style="vertical-align: middle;">ROL</th>
                                                                                <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(midata,index) in listEmployee" :key="index" >
                                                                                <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                                <td style="vertical-align: middle;" v-text="midata.number_doc"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.name_sucursal"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.name_mercado"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.name_role"></td>
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
                                                                <div class="row"> 
                                                                    <div class="col-sm-5">
                                                                        <div class="dataTables_info" style="padding-top:12px">
                                                                            <i class="fa fa-caret-right"></i><strong> Total de registros : </strong><span class="label label-success">{{pagination.total}}</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                                                            <nav>
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
                                                                            </nav>
                                                                        </div>
                                                                    </div>
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
                                                                    <button type="button" @click="save()" class="btn btn-save">
                                                                        <i class="fa fa-save"></i>&nbsp;Guardar Personal
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                                            
                                                            <div class="col-md-12">
                                                                <legend style="font-size:16px;"><strong> DATOS PERSONALES:</strong></legend>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="sexo">Sucursal:</label>
                                                                    <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                             
                                                                                <select @change="getMercado($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_sucursal_edit">
                                                                                    <option selected="selected" value="" >Seleccione</option>
                                                                                    <option v-for="miselect in arraySucursal" :selected="miselect.id == id_sucursal_edit" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="sexo">Mercado:</label>
                                                                    <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                              
                                                                                <select class="form-control" @change="getEmpleado($event.target.value)" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_mercado_edit">
                                                                                    <option v-for="miselect in arrayMercado" :selected="miselect.id == id_mercado_edit" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="dni">DNI:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                        <input maxlength="8" v-model="number_doc" type="text"  @keyup.enter="get_data_personal()"  class="form-control" placeholder="DNI" >
                                                                        <span class="input-group-btn">
                                                                            <button data-toggle="tooltip" title="Buscar" type="submit" @click="get_data_personal()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                                                        </span>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ap_materno">Personal:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input disabled v-model="personal" type="text" class="form-control"  placeholder="Apellido Materno">  
                                                                        <span class="input-group-btn">
                                                                            <button data-toggle="tooltip" title="Agregar" type="submit" @click="add_person()" class="btn btn-excel btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-plus"></i> AGREGAR</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                     <div class="col-md-3">
                                                                
                                                                    <label for="nombres">Codigo:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="code" type="text" class="form-control" placeholder="Codigo" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="sexo">Rol:</label>
                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;"><i class="fa fa-sitemap"></i></span>
                                                                                        <select v-model="id_role" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="">Seleccione</option>
                                                                                            <option v-for="datax in array_role" :selected="datax.id == id_role" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                            <!-- <option v-for="classifier_sub in arrayClassifierSub" :key="classifier_sub.id_classifier_sub" :value="classifier_sub.id_classifier_sub">{{ classifier_sub.classifier_sub }}</option> -->
                                                                                        </select>
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
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal_add}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #012D74;">
                        <button type="button" class="close" @click="close_modal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-plus"></i> AGREGAR PERSONAL</h4>
                    </div>

                    <div class="modal-body">  
                        <div class="row">    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <div class="box-body">                                     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">DNI:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input maxlength="8" v-model="number_doc_add" type="text" @keyup.enter="get_data_reniec()" class="form-control">
                                                            <span class="input-group-btn">
                                                                <button data-toggle="tooltip" title="Buscar" type="submit" @click="get_data_reniec()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-check"></i> VALIDAR</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Apellido Paterno:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input v-model="paternal_last_name" type="text" @keyup="validarDataPersonal()" class="form-control" style="border-bottom-right-radius:
                                                             3px;border-top-right-radius: 3px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Apellido Materno:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input v-model="maternal_last_name" type="text" @keyup="validarDataPersonal()" class="form-control" style="border-bottom-right-radius: 3px;
                                                            border-top-right-radius: 3px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Nombres:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input maxlength="8" v-model="names" type="text" @keyup="validarDataPersonal()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="close_modal(1)"><i class="fa fa-times"></i> CERRAR</button>
                        <button type="button" @click="save_personal()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;GUARDAR PERSONAL</button>                        
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
                
                listEmployee : [],id_role:-1,year:'',
                datosArraySunat:[],
                authUser:'',code: '',
                listado:1,
                personal:'',
                number_doc_add:'',
                modal_add:0,
                //fechas
                authUser:1,
                date_init: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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

                amount:'',name:'',id:-1,paternal_last_name:'',maternal_last_name:'',phone:'',address:'',nro_doc:'',
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',errorInputActivity2:'form-group',
                errorInputActivity3:'form-group', errorInputActivity4:'form-group',
                errorInputActivity5:'form-group', errorInputActivity6:'form-group',
                errorInputAmount:'form-group',errorComboTipoProduco:'form-group',
                buscar:'',sex:'',birthdate:'',marital_status:'',
                name_customer:'',amount:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_mercado_edit:0,characteristic:'',tea:20,id_warehouse:'',
                id_person:0,id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
                period:'Mensual',arrayDetailPledge:[],licence_plate:'',serie:'',
                errorTotalAmount:'form-group',errorAmount:'form-group',errorTerm:'form-group',
                errorTea:'form-group',errorInterested:'form-group',errorWarehouse:'form-group',
                errorFamilyProduct:'form-group',errorCharacteristic:'form-group',

                arraySucursal:[],arrayMercado:[],array_role:[]
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
            get_data_reniec(){
                //obteniendo datos de RENIEC
                if (this.number_doc_add.length==8){   
                    let me=this;              
                    var url= 'getDatabyNroDocP?nro_doc='+me.number_doc_add;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        if(respuesta.datax.length>0){
                        if(tipo=='reniec'){
                                me.paternal_last_name = respuesta.datax[0];
                                me.names = respuesta.datax[1];
                                me.maternal_last_name = respuesta.datax[2];                            
                            me.validarDataPersonal();
                            }
                            else{
                                me.paternal_last_name = 'Peronal Ya esta Registrado';
                                me.validarDataPersonal();
                            }

                        }
                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
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
            add_person(){     
                let me= this;                  
                me.modal_add=1;
                me.number_doc_add=this.number_doc;                
            },
            close_modal(){
                let me= this;
                me.modal_add=0;
            },
            get_data_personal(){
                //obteniendo datos de la base de datos
                if (this.number_doc.length==8){   
                    let me=this;              
                    var url= 'getDatabyNroDocP?nro_doc='+me.number_doc;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        if(respuesta.datax.length>0){
                            if(tipo=='bd'){
                                    me.id_person=respuesta.datax[0].id;
                                    me.personal = respuesta.datax[0].paternal_last_name+' ' +respuesta.datax[0].maternal_last_name+' ' +respuesta.datax[0].names;                        
                                me.validarData();
                            }
                            else{
                                me.personal = 'Personal No Encontrado!';
                                me.validarData();
                            }
                        }                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            getComboRole(){ // este es el metodo para que jale al combo de user,
                let me=this; 
                //me.listado=0;             
                var url= 'comboRole_list';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_role =respuesta.datax;
                    //me.listado=1;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },
            getLitSucursal(page){
                let me=this;
               // me.listado=0;
                var url= 'getlistSucursal';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arraySucursal = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getMercado(id){
                let me=this;
               // me.listado=0;
                var url= 'getMercado?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMercado = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            addPledge(){
                if(this.validateDataPledge()){
                    return;
                }
                this.arrayDetailPledge.push(
                {guaranty:this.guaranty.name,characteristic: this.characteristic,
                note: this.note,
                date_init:this.date_init,
                date_end:this.date_end,id_warehouse:this.id_warehouse,
                licence_plate:this.licence_plate,serie:this.serie
                ,amount:this.amount,interest:this.interest});
            },
            deletePledge : function (item) {

                swal({
                title: '¿Esta seguro de eliminar?',
                type: 'warning',showCancelButton: true,
                confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true
                }).then((result) => {
                if (result.value) {
                   // this.arrayActivity.push(item);
                    let index = this.arrayDetailPledge.indexOf(item)
                    this.arrayDetailPledge.splice(index, 1);
                } else if ( result.dismiss === swal.DismissReason.cancel
                ) {} }) 

                
            },
            addDay(day){
                   
                   var fecha=new Date();
                        fecha.setDate(moment(moment(this.date_init, 'DD/MM/YYYY')).format('DD'));
                        fecha.setMonth(moment(moment(this.date_init, 'DD/MM/YYYY')).format('MM')-1);
                        fecha.setYear(moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY'));
                   var fechaoriginal = new Date();

                   fechaoriginal.setDate(moment(moment(this.date_init, 'DD/MM/YYYY')).format('DD'));
                    fechaoriginal.setMonth(moment(moment(this.date_init, 'DD/MM/YYYY')).format('MM')-1);
                    fechaoriginal.setYear(moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY'));
                    var contador=0;
                    var dayoriginal=day;
                    if(this.period=='Diario'){
                        //var addTime = i * 86400; //Tiempo en segundos
                        fecha.setSeconds(86400); //Añado el tiempo
                       for(var i=0;i<day;i++) 
                        {
                            if(fecha.getUTCDay()==0){
                                contador++;
                                day++;
                            }
                            fecha.setSeconds(86400);
                        }
                        contador=contador+dayoriginal;
                        fechaoriginal.setSeconds(contador*86400);
                   }
                   if(this.period=='Semanal'){
                         day=day*7;
                         fechaoriginal.setDate(fechaoriginal.getDate()+day);
                           
                   }
                    if(this.period=='Quincenal'){
                       day=day*15;
                         fechaoriginal.setDate(fechaoriginal.getDate()+day);
                   }
                    if(this.period=='Mensual'){
                      fechaoriginal.setMonth(fechaoriginal.getMonth()+day);
                      //comprobando domingo
                         if(fechaoriginal.getUTCDay()==0){
                                fechaoriginal.setSeconds(86400);
                         } 
                   }
                  
                var hoy= ''+fechaoriginal.getDate()+'/'+(Number(fechaoriginal.getMonth())+1)+'/'+fechaoriginal.getFullYear();
                return hoy;
                
               },  
            calculateTeabyTerm(){
                this.interest=Number(this.amount)*(Number(this.tea)*Number(this.term))/100;
                this.interest=Number((this.interest).toFixed(1));
                //this.date_end='01-01-01';
                // var hoy= ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear();
                this.date_end=this.addDay(Number(this.term));
               },
            calculateTeabyInteres(){
                   if(this.period=='Diario'){
                       this.interest=Number(this.amount)*(Number(this.tea)*Number(this.term))/100;
                        this.interest=Number((this.interest).toFixed(1));
                   }
                   if(this.period=='Semanal'){
                       this.interest=Number(this.amount)*(Number(this.tea)*Number(this.term))/100;
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Quincenal'){
                       this.interest= (Number(this.amount)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Mensual'){
                       this.interest= (Number(this.amount)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                       
               },
            calculateTeabyPerioid(){
                   if(this.period=='Diario'){
                       this.tea=0.67;
                       this.interest=Number(this.amount)*(Number(this.tea)*Number(this.term))/100;
                        this.interest=Number((this.interest).toFixed(1));
                   }
                   if(this.period=='Semanal'){
                       this.tea=5;
                       this.interest=Number(this.amount)*(Number(this.tea)*Number(this.term))/100;
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Quincenal'){
                       this.tea=10;
                       this.interest= (Number(this.amount)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Mensual'){
                       this.tea=20;
                       this.interest= (Number(this.amount)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                   this.calculateTeabyTerm();
                       
               },
               getData(){
                     //obteniendo datos de reniec
                if (this.nro_doc.length==8) 
                {   
                    let me=this;              
                    var url= 'getDataCustomerBynro_doc?nro_doc='+me.nro_doc;
                    axios.get(url).then(function (response) {
                         var respuesta= response.data;
                         var tipo=respuesta.tipo;
                          if(respuesta.datax.length>0){
                            if(tipo=='bd'){
                                    me.id=respuesta.datax[0].id;
                                    me.name = respuesta.datax[0].names;
                                    me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                                    me.maternal_last_name = respuesta.datax[0].maternal_last_name;
                                    me.phone = respuesta.datax[0].phone;
                                    me.address =respuesta.datax[0].address;
                                    me.sex =respuesta.datax[0].sex;
                                    me.marital_status =respuesta.datax[0].marital_status;
                                    me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
                                    me.validarData();
                                    }
                                    else{
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.name = respuesta.datax[1];
                                    me.maternal_last_name = respuesta.datax[2];
                                    me.validarData();
                                    }
    
                        }
                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
               },
            validarData(){
                this.errors = {};
                this.errorClase=0;
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                this.errorInputActivity5='form-group has-success';
                this.errorInputActivity6='form-group has-success';
                this.errorInputAmount='form-group has-success';
                this.errorComboTipoProduco='form-group has-success';
                this.errorTotalAmount='form-group has-success';


                if (!this.nro_doc) 
                {  
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {  
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name) 
                {  
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name) 
                {  
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.phone) 
                {   
                    this.errorInputActivity5='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.address) 
                {  
                    this.errorInputActivity6='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            }, 
            validateDataPledge(){
                this.errorClase=0;
                //input
                this.errorAmount='form-group has-success';
                this.errorTerm='form-group has-success';
                this.errorTea='form-group has-success';
                this.errorInterested='form-group has-success';
                this.errorWarehouse='form-group has-success';
                this.errorFamilyProduct='form-group has-success';
                this.errorCharacteristic='form-group has-success';

                if (!this.amount) 
                {  
                    this.errorAmount='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.term) 
                {  
                    this.errorTerm='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.tea) 
                {  
                    this.errorTea='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.interest) 
                {  
                    this.errorInterested='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_warehouse) 
                {  
                    this.errorWarehouse='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.guaranty) 
                {  
                    this.errorFamilyProduct='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.characteristic) 
                {  
                    this.errorCharacteristic='form-group has-error';
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
				me.listar(page);
                
            },
            editar(id){
                let me=this;
                me.listado=2;
                //me.limpiar();
                me.getLitSucursal(1);
                me.getComboRole();
                var url= 'geEdittListaEmpleadoList?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id=respuesta.datax[0].id;
                                me.number_doc = respuesta.datax[0].number_doc;
                                me.id_person=respuesta.datax[0].id_person;
                                //me.id_mercado_edit=respuesta.datax[0].id_market;
                                //me.id_role=respuesta.datax[0].role_id;
                                me.personal = respuesta.datax[0].names+' '+respuesta.datax[0].paternal_last_name+' '+respuesta.datax[0].paternal_last_name;
                                //me.id_mercado_edit=respuesta.datax[0].id_market;
                                me.code = respuesta.datax[0].code;
                                //me.validarData();
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            save(){
                
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
                axios.post('saveEmployee',{
                    'code':this.code,'id_person':this.id_person,'id_market':this.id_mercado_edit,
                    'role_id':this.id_role,
                    'id': this.id,                       
                }).then(function (response) {
                     //me.limpiar();
                    me.listado=1; 
                    //me.listar(1);                  
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
                    axios.post('delete_PersonalEmploye',{
                        'id': id

                    }).then(function (response) {
                    me.listado=1;
                    me.listar(1);
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            pledge(midata){
                let me=this;
                me.listado=3;
                this.name_customer=midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name;

                   var url= 'getDependenceParent';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.arrayTypeProduct=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                     url= 'getWarehouse';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.arrayWarehouse=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            agregar(){
                let me=this;
                me.listado=2;
                this.getLitSucursal(2)
                this.getComboRole();
            },
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            limpiar(){
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.nro_doc="";
                this.errors.name="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                this.errors.phone="";
                this.errors.address="";
                this.nro_doc="";
                this.name="";
                 this.paternal_last_name="";
                this.maternal_last_name="";
                 this.phone="";
                this.address="";
                this.id=-1;
            },
            listar(page){
                let me=this;      
                me.listado=0;        
                var url= 'getListaEmpleadoList';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.listEmployee=respuesta.datax;
                     //me.pagination= respuesta.pagination; 
                     me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        mounted() {
           this.listar(1);
           this.calculateTeabyTerm();
            
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

