<template>
    <main class="main">
        <section class="content-header">
            <h1>
              CIUDADANO
              <small>Registro</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-cogs"></i> Operaciones</a></li>
              <li>Ciudadano</li>
              <li class="active">Agregar Ciudadano</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="box-tools pull-right">                                
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
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
                                                            <template v-if="listadox==1">                                                   
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputTypeDoc">
                                                                            <label for="estado_civil">Tipo de Documento de Identidad:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-list-alt"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_document">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_document" :key="datax.iddocument" :value="datax.iddocument">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputNroDoc">
                                                                            <label for="dni">N° de Documento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                                <input maxlength="8" v-model="number_doc" type="text" @keyup.enter="getData()"  class="form-control">
                                                                                <span class="input-group-btn">
                                                                                    <button data-toggle="tooltip" title="Buscar en RENIEC" type="submit" @click="getData()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_search_dni"></i> BUSCAR</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputSex">
                                                                            <label for="sexo">Sexo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-transgender"></i></span>
                                                                            <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="sexo">
                                                                                <option selected="selected" value="">Seleccione</option>
                                                                                <option value="M">Masculino</option>
                                                                                <option value="F">Femenino</option>
                                                                            </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                      <div class="col-md-3">
                                                                        <div v-bind:class="errorInputMaritalState">
                                                                            <label for="estado_civil">Estado Civíl:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-heart-o"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="estado_civil">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option value="SOLTERO">Soltero (a)</option>
                                                                                    <option value="CASADO">Casado (a)</option>
                                                                                    <option value="VIUDO">Viudo (a)</option>
                                                                                    <option value="SEPARADO">Separado (a)</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                 
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputPaternal">
                                                                            <label for="ap_paterno">Apellido Paterno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="name_paterno" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputMaternal">
                                                                            <label for="ap_materno">Apellido Materno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="name_materno" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputNames">
                                                                            <label for="nombres">Nombres:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="edad">Fecha de Nacimiento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-birthday-cake "></i></span>
                                                                            <date-picker v-model="fecha_nacimiento" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="celular">Edad:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-mobile-phone"></i></span>
                                                                                <input v-model="edad" type="tel" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputDepartment">
                                                                            <label for="estado_civil">Departamento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                <select @change="getProvince($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="department">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="miselect in array_department" :selected="miselect.id == department" :key="miselect.id" :value="miselect.id">{{ miselect.departamento}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputProvince">
                                                                            <label for="estado_civil">Provincia:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                <select @change="getDistrict($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="province">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="miselect in array_province" :selected="miselect.id == province" :key="miselect.id" :value="miselect.id">{{ miselect.provincia}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputDistrict">
                                                                            <label for="estado_civil">Distrito:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="district">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="miselect in array_district" :selected="miselect.id == district" :key="miselect.id" :value="miselect.id">{{ miselect.distrito}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInpuProfesion">
                                                                            <label for="profesion">Profesion/Oficio:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="profesion_oficio" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                       
                                                                </div> 
                                                            </template>
                                                                <!-- Dar Crédito -->
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
                            
                                <div class="btn-group" style="float:right">
                                    <button type="button" @click="saveDataOnlyCustomer()" class="btn btn-save" data-toggle="tooltip" title="Guardar ciudadano">
                                        <i v-bind:class="icon_save"></i>&nbsp;GUARDAR CIUDADANO
                                    </button>
                                </div>
                                                         
                                <button type="button" @click="clean_data()" class="btn btn-new" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Nuevo cliente">
                                    <i class="fa fa-certificate"></i>&nbsp;NUEVO CIUDADANO
                                </button>
                            
                        </div>             
                    </div> 
                    
                    
                </div>
                <!-- Lista de Prendas-->
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
                id_parent:'',visible:1,
                array_job:[], id_job:'',array_job:[], id_job_aval:'',
                array_type_business:[],array_employee:[],
                id_employee:'',
                authUser:'',porcent: 50,
                listadox:1,
                listado:2,
                //fechas
                authUser:1,
                date_init: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                fecha_nacimiento: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                date_init_payment: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                date_credit: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                birthdate_aval: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                idperson:-1,
                code:'', name:'', name_paterno:'',name_materno:'',profesion_oficio:'',
                edad:'',address:'',number_doc:'', id_type_document:'', email:'',                 
                department:'10', province:'92', district:'', id_type_business:'', 
                reference:'', sexo:'', estado_civil:'',estado:'1',

                code_aval:'', name_aval:'', paternal_last_name_aval:'',maternal_last_name_aval:'',
                phone_aval:'',address_aval:'',nro_doc_aval:'', id_type_doc_aval:'', email_aval:'', 
                department_aval:'10', province_aval:'92', district_aval:'', id_type_business_aval:'', 
                reference_aval:'', sex_aval:'', marital_status_aval:'',
                errorClase : 0,
                errors:{},

                errorInputCode:'form-group',errorInputTypeDoc:'form-group',
                errorInputNroDoc:'form-group',errorInputNames:'form-group',
                errorInputPaternal:'form-group', errorInputMaternal:'form-group',
                errorInputSex:'form-group', 
                errorInputProfesion:'form-group', 
                errorInputMaritalState:'form-group', errorInputAddress:'form-group',
                errorInputJob:'form-group', errorInputTypeBusiness:'form-group',
                errorInputEmployee:'form-group', errorInputDepartment:'form-group',
                errorInputProvince:'form-group', errorInputDistrict:'form-group',

                errorInputTypeDocAval:'form-group',
                errorInputNroDocAval:'form-group',errorInputNamesAval:'form-group',
                errorInputPaternalAval:'form-group', errorInputMaternalAval:'form-group',
                errorInputSexAval:'form-group', 
                errorInputMaritalStateAval:'form-group', errorInputAddressAval:'form-group',
                errorInputJobAval:'form-group', errorInputTypeBusinessAval:'form-group',
                errorInputDepartmentAval:'form-group',
                errorInputProvinceAval:'form-group', errorInputDistrictAval:'form-group',

                errorInputcapital:'form-group',errorComboTipoProduco:'form-group',

                buscar:'',
                name_customer:'',capital:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_dependence:0,characteristic:'',tea:20,id_warehouse:'',
                id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
                period:'Mensual',arrayCreditDetail:[],licence_plate:'',
                errorTotalcapital:'form-group',errorcapital:'form-group',errorTerm:'form-group',
                errorTea:'form-group',errorInterested:'form-group',errorWarehouse:'form-group',
                errorFamilyProduct:'form-group',errorCharacteristic:'form-group',

                arrayFamilyProduct:[], array_department:[], array_province: [], array_district: [], array_type_document:[],array_code:[],
                totalcapital:0,totalInterest:0,modalTicket:0,idcustomer:-1,array_requirement : [],array_requirement_true : [], requirements:[],
                midatax:[], list:[],totalNumber:0, 
                id_customer_credit:-1, id_guarantor:-1,
                icon_title:'fa fa-plus', icon_save:'fa fa-save',
                icon_save_pledge:'fa fa-save', icon_edit:'fa fa-pencil',
                icon_search_dni:'fa fa-search', icon_search_dni_aval:'fa fa-search',
                icon_search_client:'fa fa-search', icon_generate:'fa fa-rotate-right',
                title:'Agregar Cliente', add_aval:0,
                
                capital:500, amount_admin:'', rate_admin:2, risk_center:2,interest_rate:10,
                grace_day:3, apply_mora:1, period_credit:'DIARIO', number_quota:26, 
                date_ultimate:'',total_cash:'', interest_rate_cash:'', quota:'',
                total_quota:'',total_amount:'',total_interest:'',

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
        created: function(){
            this.init();
        },
        methods : {
                     
            getTypeDocument(){
                let me=this;
               // me.listado=0;
                var url= 'get_type_document';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_type_document=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getDepartment(){
                let me=this;
                me.listado=0;
                var url= 'get_department';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_department=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getProvince(id_department){
                let me=this;
               // me.listado=0;
                var url= 'get_province?id='+ id_department;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_province=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getDistrict(id_province){
                let me=this;
               // me.listado=0;
                var url= 'get_district?id='+ id_province;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_district=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getData(){//obteniendo datos de reniec                     
                if (this.number_doc.length==8){   
                    let me=this;              
                    var url= 'get_customer_by_dni?number_doc='+me.number_doc;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        if(respuesta.datax.length>0){
                            if(tipo=='reniec'){
                                me.name_paterno= respuesta.datax[0];
                                me.name = respuesta.datax[1];
                                me.name_materno = respuesta.datax[2];                        
                                me.validarData();
                            }
                            else{
                                me.name_paterno = 'EL PERSONAL  YA SE ENCUENTRA REGISTRADO';
                                me.name = 'EL PERSONAL  YA SE ENCUENTRA REGISTRADO';
                                me.name_materno = 'EL PERSONAL  YA SE ENCUENTRA REGISTRADO';
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
            validateData(){
                this.errors = {};
                this.errorClase=0;
                //input
                this.errorInputCode='form-group';
                this.errorInputTypeDoc='form-group';
                this.errorInputNroDoc='form-group';
                this.errorInputNames='form-group';
                this.errorInputPaternal='form-group';
                this.errorInputMaternal='form-group';
                this.errorInputSex='form-group';
                this.errorInputMaritalState='form-group';                
                this.errorInputAddress='form-group';
                this.errorInputJob='form-group';
                this.errorInputTypeBusiness='form-group';
                this.errorInputEmployee='form-group';
                this.errorInputDepartment='form-group';
                this.errorInputProvince='form-group';
                this.errorInputDistrict='form-group';
                this.errorInputProfesion='form-group';

                
                if (!this.name){  
                    this.errorInputNames='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name_paterno){  
                    this.errorInputPaternal='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name_materno){  
                    this.errorInputMaternal='form-group has-error';
                    this.errorClase = 1;
                }   
                if (!this.sexo){  
                    this.errorInputSex='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.estado_civil){  
                    this.errorInputMaritalState='form-group has-error';
                    this.errorClase = 1;
                } 
                if (!this.department){  
                    this.errorInputDepartment='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.province){  
                    this.errorInputProvince='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.district){  
                    this.errorInputDistrict='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.profesion_oficio){  
                    this.errorInputProfesion='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            },     
          
            //cambiarPagina(page){
				//let me = this;				
				//me.pagination.current_page = page;
                //me.listado=1;
				//me.list_data(page);
                
            //},
            // edit_data(id){
            //     let me=this;
            //     me.listado=2;
            //     me.clean_data();
            //     me.getTypeDocument();
            //     me.icon_edit='fa fa-spinner fa-spin';
            //     var url= 'edit_data?id='+id;
            //     me.id_customer_credit=id;
            //     axios.get(url).then(function (response) {
            //         var respuesta= response.data;
            //         me.id=respuesta.datax[0].id;
            //         me.nro_doc = respuesta.datax[0].number_doc;
            //         me.name = respuesta.datax[0].names;
            //         me.paternal_last_name = respuesta.datax[0].paternal_last_name;
            //         me.maternal_last_name = respuesta.datax[0].maternal_last_name;
            //         me.phone = respuesta.datax[0].phone;
            //         me.address =respuesta.datax[0].address;
            //         me.sex =respuesta.datax[0].sex;
            //         me.reference =respuesta.datax[0].reference;
            //         me.code =respuesta.datax[0].code;
            //         me.email =respuesta.datax[0].email;
            //         me.district =respuesta.datax[0].id_district;
            //         me.province =respuesta.datax[0].id_province;
            //         me.department =respuesta.datax[0].id_department;
            //         me.id_type_doc =respuesta.datax[0].id_type_document;
            //         me.marital_status =respuesta.datax[0].marital_status;
            //         me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
            //         me.validateData();         
            //         me.icon_edit='fa fa-pencil';       
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
                              
            // },
            saveDataOnlyCustomer(){
                let me = this; 
                if (this.validateData()){
                    return;
                }
                me.icon_save='fa fa-spinner fa-spin';                
                swal({
                    title: 'Esta seguro de guardar la informacion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ACEPTAR',
                    cancelButtonText: 'CANCELAR',confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                    reverseButtons: true
                }).then((result) =>{
                    if (result.value){ 
                         //let me = this;               
                        axios.post('saveCiudadano',{
                            'idperson': this.idperson,
                            'number_doc':this.number_doc,'name':this.name,
                            'name_paterno':this.name_paterno,
                            'name_materno':this.name_materno,
                            'estado_civil':this.estado_civil,
                            'profesion_oficio':this.profesion_oficio,
                            'id_district': this.district,
                            'sexo': this.sexo,
                            'edad': this.edad,
                            'id_type_document': this.id_type_document,
                            'fecha_nacimiento' : moment(moment(this.fecha_nacimiento, 'DD/MM/YYYY')).format('YYYY-MM-DD'),

                        }).then(function (response) {
                                me.clean_data();                                
                                // me.list_data(1);  
                                me.icon_save='fa fa-save';
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });                        
                    }else if(result.dismiss === swal.DismissReason.cancel) { 
                        me.icon_save='fa fa-save';
                    }
                }) 
            },
            eliminar(id){
                swal({
                title: '¿Estas seguro de eliminar?',
                text: '¡No podrás revertir esto!',
                type: 'warning',
                showCancelButton: true,
                
                
                confirmButtonText: 'ACEPTAR',
                cancelButtonText: 'CANCELAR',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                    let me = this;
                    axios.post('deleteCustomerCredit',{
                        'id': id

                    }).then(function (response) {
                    me.listado=1;
                    me.list_data(1);
                    swal( 'Eliminado!', 'Su cliente ha sido eliminado.', 'success' ); 
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            clean_data(){
               this.errorInputNroDoc='form-group';
                this.errorInputNames='form-group';
                this.errors = {};
                this.errors.number_doc="";
                this.errors.name="";
                this.errors.name_paterno="";
                this.errors.name_materno="";
                this.errors.edad="";
                this.errors.address="";
                this.number_doc="";
                this.name="";
                this.name_paterno="";
                this.name_materno="";
                this.phone="";
                this.address="";
                this.reference="";
                this.edad="";
                this.id_type_document="";
                this.department="";
                this.province="";
                this.district="";
                this.sex="";
                this.email="";
                this.birthdate="";
                this.id_parent="";
                this.guaranty="";
                this.id_warehouse="";
                this.note="";
                this.idperson=-1;
                
                
            },
           // list_data(page){
            //     let me=this;                      
            //     me.listado=0;
            //     me.getDepartment();
            //     me.getTypeDocument();
            //     var url= 'getListCustomerCredit?buscar='+me.buscar+'&page='+page;
            //     axios.get(url).then(function (response) {
            //         var respuesta= response.data;
            //         me.list=respuesta.datax;
            //         me.pagination= respuesta.pagination;                     
            //         me.listado=2;
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
               
             //},

           
        },
        
        mounted() {
        //    this.lista_add_client();
        //    this.list_data(1);
            this.getDepartment();
            //this.getTypeBusiness();
           // this.getJob();
            //this.getEmployee();
            this.getTypeDocument();
            //this.getTypeRequirement();            
            //this.calculateTeabyTerm();
            this.getProvince(10);
            this.getDistrict(92);
            //this.calculateAmount(2);
            //this.calculateInterestRateCash();
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }


.example-print {
    display: none;
}
@media print {
   .example-screen {
       display: none;
    }
    .example-print {
       display: block;
    }
}
@page {
    margin-top: 2cm;
    margin-bottom: 2cm;
    margin-left: 2cm;
    margin-right: 2cm;
}

</style>

