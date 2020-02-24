<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Ciudadanos
              <small>Listado</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-cogs"></i> Operaciones</a></li>
              <li>Ciudadanos</li>
              <li class="active">Listar Ciudadanos</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                
                <!-- Lista de Clientes -->
                <div class="col-md-12"  v-if="visible">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Listado de Ciudadanos
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
                                <img src="img/robot.gif" alt="muniperene" align="middle">
                                <!-- <p>Cargando...</p> -->
                            </div>
                        </template>
                        <template v-if="listado==1">
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-12">
                                        <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                            <input type="text"  v-model="buscar" @keyup.enter="list_data(1)"  class="form-control" placeholder="Buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                            <span class="input-group-btn">
                                                <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i v-bind:class="icon_search_client"></i> BUSCAR</button>
                                            </span>
                                        </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>  
                                            <th style="vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle;">DNI</th>
                                            <th style="vertical-align: middle;">NOMBRE</th>
                                            <th style="vertical-align: middle;">FECHA_NACIMIENTO</th>
                                            <th style="vertical-align: middle;">ESTADO_CIVIL</th>
                                            <th style="vertical-align: middle;">EDAD</th>
                                            <th style="vertical-align: middle;">PROFESION_OFICIO</th>
                                            <th style="vertical-align: middle;">DEPARTAMENTO</th>
                                            <th style="vertical-align: middle;">PROVINCIA</th>
                                            <th style="vertical-align: middle;">DISTRITO</th>
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in list" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)+((Number(pagination.current_page)-1)*10)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.number_doc"></td>
                                            <td style="vertical-align: middle;" v-text="midata.name+' '+midata.name_paterno+' '+midata.name_materno"></td>
                                            <td style="vertical-align: middle;" v-text="midata.fecha_nacimiento"></td>
                                            <td style="vertical-align: middle;" v-text="midata.estado_civil"></td>
                                            <td style="vertical-align: middle;" v-text="midata.edad"></td>
                                            <td style="vertical-align: middle;" v-text="midata.profesion_oficio"></td>
                                            <td style="vertical-align: middle;" v-text="midata.departamentos"></td>
                                            <td style="vertical-align: middle;" v-text="midata.provincias"></td>
                                             <td style="vertical-align: middle;" v-text="midata.distritos"></td>
                                            <td style="text-align: center; vertical-align: middle;"> 
                                                <button type="button" @click="editData(midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </button>                                                                                                           
                                            
                                                <button type="button" @click="eliminar(midata.id_customer_credit)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar Cliente">
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
                                    <div class="col-md-6" style="margin-top: -20px; margin-bottom: -25px;">
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
                        </template>
                        
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
                birthdate: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                id:-1,
                code:'', name:'', paternal_last_name:'',maternal_last_name:'',
                phone:'',address:'',nro_doc:'', id_type_doc:'', email:'',                 
                department:'10', province:'92', district:'', id_type_business:'', 
                reference:'', sex:'', marital_status:'',

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
                id_person:0,id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
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
            
            print_schedule_credit(id){
                var url='download_detail_credit?id='+id;
                //window.location.href = url;
                window.open(url, '_blank');  
            },
            imprimirElemento(){
                 /* var ventana = window.open('', 'PRINT', 'height=600,width=800');
                    ventana.document.write('<html><head><title>' + document.title + '</title>');
                    ventana.document.write('</head><body >');
                    ventana.document.write("Hola");
                    ventana.document.write('</body></html>');
                    ventana.document.close();
                    ventana.focus();*/
                    window.print();
                   // ventana.close();
                   // return true;
                    //ola
            },
            closeModal(){
                let me=this;
                me.modalTicket=0;
            },
            dowloadContract(){
				  //var entre = document.getElementById("entre");
				  //var nombreentre = entre.options[entre.selectedIndex].text;
                var url= 'dowloadContract?name_customer='+this.name_customer+'&nro_doc='+this.nro_doc+
                '&dateinit='+moment(moment(this.date_init, 'DD/MM/YYYY')).format('DD-MM-YYYY')+
                '&dateend='+moment(moment(this.date_end, 'DD/MM/YYYY')).format('DD-MM-YYYY');
            	window.location.href = url;
			 },     
          
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.list_data(page);
                
            },
            eliminar(id){
                swal({
                title: '¿Estas seguro de eliminar?',
                text: '¡No podrás revertir esto!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
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
            giveCredit(midata){
                let me=this;
                me.listadox=3;
                this.visible=0;
                this.id_customer_credit=midata.id_customer_credit;
                this.name_customer=midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name;
                this.nro_doc=midata.number_doc;
                
            },
            addCustomer(){
                let me=this;
                me.listado=2;
            },
            volver(){
                let me=this;
                me.clean_data();
                me.listadox=1;
                me.listado=2;
                me.visible=1;
                me.list_data(1);
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            clean_data(){
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.nro_doc="";
                this.errors.name="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                this.errors.code="";
                this.errors.address="";
                this.nro_doc="";
                this.name="";
                this.paternal_last_name="";
                this.maternal_last_name="";
                this.phone="";
                this.address="";
                this.reference="";
                this.code="";
                this.id_type_doc="";
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
                this.id=-1;
                
                this.idcustomer=0,
                this.period="Mensual";
                this.licence_plate="";
                this.serie="";
                this.term=1;
                this.tea=10,
                this.totalcapital=0;    
                this.arrayCreditDetail=[];   
                this.totalInterest=0;     
                this.characteristic="";
                this.serie="";
                this.licence_plate="";
                this.mounted=0;

                this.capital=500;
                this.grace_day=3;
                this.amount_admin="", 
                this.rate_admin=2,
                this.risk_center=2,
                this.interest_rate=10,
                this.apply_mora=1,
                this.period_credit="DIARIO",
                this.number_quota=26,
                this.term=1;
                this.interest=0;
                
            },
            list_data(page){
                let me=this;                      
                me.listado=0;
                var url= 'getListCustomerCredit?buscar='+me.buscar+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list=respuesta.datax;
                    me.pagination= respuesta.pagination;                     
                    me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },

            init: function() {
            },
           
        },
        
        mounted() {
        //    this.lista_add_client();
            this.list_data(1);
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

