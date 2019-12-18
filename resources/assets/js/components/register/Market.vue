<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Mercados
              <small>Registro</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
              <li class="active">Mercado</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-plus"></i> Gestión de Mercados
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
                                                                <div class="col-md-6">
                                                                    <div v-bind:class="errorInputActivity1">
                                                                        <label for="dni">Código:</label>
                                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-qrcode"></i></span>
                                                                            <input type="text"  v-model="code" @keyup.enter="list_data(1)"  class="form-control" placeholder="Código">
                                                                            <span class="input-group-btn">
                                                                                <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-random"></i> GENERAR</button>
                                                                            </span>
                                                                        </div>                                               
                                                                    </div>                                               
                                                                </div>    

                                                                <div class="col-md-6">
                                                                    <div v-bind:class="errorInputActivity2">
                                                                        <label for="ap_paterno">Denominación:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                            <input v-model="name" type="text" class="form-control" placeholder="Apellido Paterno" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>  
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edad">Fecha de Creación:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar "></i></span>
                                                                            <date-picker v-model="date_creation" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="estado_civil">Sucursal:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-magic"></i></span>
                                                                            <select v-model="id_branch_office" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <option selected="selected" value="" >Seleccione</option>
                                                                                <option v-for="branch in array_branch" :key="branch.id" :value="branch.id">{{ branch.name }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>  
                                                                
                                                                <div class="col-md-6">
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
                            <button type="button" @click="save_market()" class="btn btn-save" style="float:right; margin-right: 10px;">
                                <i class="fa fa-save"></i>&nbsp;GUARDAR
                            </button>
                            <button type="button" @click="volver()" class="btn btn-danger" style="float:right; margin-right: 10px;">
                                <i class="fa fa-close "></i>&nbsp;CANCELAR
                            </button>                            
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
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Lista de Mercados
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
                            </div>
                        </template>

                        <template v-if="listado==1">
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <input type="text"  v-model="search_market" @keyup.enter="list_data(1)"  class="form-control" placeholder="Buscar por código o denominación del Mercado y/o datos del Personal." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                        <span class="input-group-btn">
                                            <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                        </span>
                                    </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center;">#</th>
                                            <th style="vertical-align: middle; text-align: center;">CÓDIGO</th>
                                            <th style="vertical-align: middle; text-align: center;">ASESOR FINANCIERO</th>
                                            <th style="vertical-align: middle;">MERCADO</th>
                                            <th style="vertical-align: middle; text-align: center;">FECHA DE CREACIÓN</th>
                                            <th style="vertical-align: middle;">SUCURSAL</th>
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in list_market" :key="index" >
                                            <td style="vertical-align: middle; text-align: center;" >{{(index+1)+((Number(pagination.current_page)-1)*8)}}</td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.code"></td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.personal"></td>
                                            <td style="vertical-align: middle;" v-text="midata.name"></td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.date_creation"></td>
                                            <td style="vertical-align: middle;" v-text="midata.name_branch_office"></td>
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
                list_market : [],idParent:'',year:'',
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
            get_branch(){
                let me=this;              
                var url= 'get_combo_branch_office';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_branch=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });               
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
                                me.paternal_last_name = 'EL PERSONAL  YA SE ENCUENTRA REGISTRADO';
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
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.code="";
                this.errors.name="";
                this.errors.number_doc="";
                //input
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                
                 if (!this.code) 
                {   this.errors.code="Ingrese o genere el código";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                 if (!this.name) 
                {   this.errors.name="Ingrese la denominación";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }

                if (!this.number_doc) 
                {   this.errors.number_doc="Ingrese DNI";
                    this.errorInputActivity3='form-group has-error';
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
           
            editData(id){
                let me=this;
                me.listado=1;
                me.limpiar();
                var url= 'edit_market?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.id_person=respuesta.datax[0].id_person;
                    me.number_doc = respuesta.datax[0].number_doc;
                    me.personal = respuesta.datax[0].paternal_last_name+' ' +respuesta.datax[0].maternal_last_name+' ' +respuesta.datax[0].names; 
                    me.code = respuesta.datax[0].code;
                    me.name =respuesta.datax[0].name_mercado;
                    me.id_branch_office =respuesta.datax[0].id_branch_office;
                    me.date_creation =respuesta.datax[0].date_creation;
                    me.validarData();
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            save_market(){
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
                axios.post('save_market',{
                    'id':this.id,
                    'code':this.code,
                    'name':this.name,
                    'date_creation' : moment(moment(this.date_creation, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                    'id_person': this.id_person,
                    'id_branch_office': this.id_branch_office   
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
            save_personal(){
                if (this.validarDataPersonal()){
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
                            axios.post('save_personal',{
                                'id': this.id,
                                'number_doc':this.number_doc_add,'names':this.names,
                                'paternal_last_name':this.paternal_last_name,'maternal_last_name':this.maternal_last_name                     
                            }).then(function (response) {
                                me.limpiar();
                                me.listado=1; 
                                me.list_data(1);    
                                close_modal();            
                                swal(
                                    'Guardado!',
                                    'El registro ha sido guardado con éxito.',
                                    'success'
                                ) 
                            }).catch(function (error) {
                                console.log(error);
                            });
                        }else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ){                        
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
                    axios.post('deleteMercado',{
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
            emprendar(id){
                let me=this;
                me.listado=3;
                 
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
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.number_doc="";
                this.errors.name="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                this.errors.phone="";
                this.errors.address="";
                this.number_doc="";
                this.number_doc_add="";
                this.name="";
                this.names="";
                this.paternal_last_name="";
                this.maternal_last_name="";
                this.phone="";
                this.address="";
                this.id=-1;
            },
            list_data(page){
                let me=this;      
                me.listado=0;        
                var url= 'get_list_market?search_market='+me.search_market+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list_market=respuesta.datax;
                    me.pagination= respuesta.pagination; 
                    me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });            
            },            
        },
        mounted() {
            this.list_data(1);
            this.get_branch();
        }         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

