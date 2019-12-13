<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Clientes
              <small>Historial</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Clientes</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <!-- Lista de Clientes -->
                <div class="col-md-12"  v-if="visible">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Historial de Clientes
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
                        <template v-if="listado==2">
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
                                            <th style="vertical-align: middle;">DIRECCIÓN</th>
                                            <th style="vertical-align: middle;">CELULAR</th>
                                            <th style="text-align: center; vertical-align: middle;">HISTORIAL</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in list" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)+((Number(pagination.current_page)-1)*8)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.number_doc"></td>
                                            <td style="vertical-align: middle;" v-text="midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name"></td>
                                            <td style="vertical-align: middle;" v-text="midata.address"></td>
                                            <td style="vertical-align: middle;" v-text="midata.phone"></td>
                                            <td style="text-align: center; vertical-align: middle;"> 
                                                <button type="button" @click="pledge(midata)" class="btn btn-emprendar btn-sm" data-toggle="tooltip" title="Historial crediticio">
                                                    <i class="fa fa-line-chart"></i>
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
                <template v-if="listadox==3">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h1 class="box-title"><i class="fa fa-list"></i> Lista de Prendas</h1>
                                <div class="box-tools pull-right">
                                    <!-- <span class="label label-success">TOTAL DE REGISTROS:</span> -->
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                </div>
                            </div>
                                
                            <div class="box-body table-responsive no-padding">
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>  
                                            <th style="vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle;">BIEN DE GARANTÍA</th>
                                            <th style="vertical-align: middle;">CARACTERÍSTICAS</th>
                                            <th style="vertical-align: middle;">ALMACEN</th>                                                                                        
                                            <th style="vertical-align: middle;">PLACA</th>
                                            <th style="vertical-align: middle;">SERIE</th>
                                            <th style="vertical-align: middle;">MONTO</th>
                                            <th style="vertical-align: middle;">INTERES</th>
                                            <th style="vertical-align: middle;">TOTAL</th>
                                            <th style="vertical-align: middle;">OBSERVACIONES</th>
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in arrayDetailPledge" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.guaranty"></td>
                                            <td style="vertical-align: middle;" v-text="midata.characteristic"></td>                                        
                                            <td style="vertical-align: middle;" v-text="midata.warehouse"></td>
                                            <td style="vertical-align: middle;" v-text="midata.licence_plate"></td>
                                            <td style="vertical-align: middle;" v-text="midata.serie"></td>
                                            <td style="vertical-align: middle;" v-text="midata.capital"></td>
                                            <td style="vertical-align: middle;" v-text="midata.interest"></td>
                                            <td style="vertical-align: middle;" v-text="Number(midata.capital)+Number(midata.interest)"></td>
                                            <td style="vertical-align: middle;" v-text="midata.note"></td>
                                            <td style="vertical-align: middle;text-align: center;"> 
                                            
                                                <button title="Eliminar" type="button" @click="deletePledge(midata)" class="btn btn-eliminar btn-sm">
                                                <i class="fa fa-trash"></i>
                                                </button>                                       
                                            </td> 
                                        </tr>                       
                                    </tbody>
                                </table>                                
                            </div>
                            
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-xs-9">
                                    </div>
                                    <div class="col-lg-6 col-xs-9">
                                        <h3>Detalle del empeño:</h3>
                                        <div class="table-responsive no-border">
                                            <table class="table">
                                                <tbody>
                                                    <tr id="row_sub_total_ventas">
                                                        <th>Préstamo:</th>
                                                        <td class="text-right">
                                                            <span class="simbolo_moneda">S/.</span>
                                                            <span id="sub_total_ventas">{{totalcapital}}</span>
                                                            <input type="hidden" name="txt_sub_total_ventas" id="txt_sub_total_ventas" value="0">
                                                        </td>
                                                    </tr>
                                                        
                                                    <tr id="row_gravada_documento">                                                        
                                                        <th>Interés:</th>
                                                        <td class="text-right">
                                                            <span class="simbolo_moneda">S/.</span>
                                                            <span id="gravada_documento">{{totalInterest}}</span>
                                                            <input type="hidden" name="txt_gravada_comprobante" id="txt_gravada_comprobante" value="0">
                                                        </td>
                                                    </tr>
                                                    <tr id="row_gravada_documento">                                                        
                                                        <th>Total a cobrar::</th>
                                                        <td class="text-right">
                                                            <span class="simbolo_moneda">S/.</span>
                                                            <span id="gravada_documento">{{Number(totalcapital)+Number(totalInterest)}}</span>
                                                            <input type="hidden" name="txt_gravada_comprobante" id="txt_gravada_comprobante" value="0">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                     
                                        <button type="button" @click="savePledge()" class="btn btn-save" style="width: 100%;">
                                            <i class="fa fa-save"></i>&nbsp;GUARDAR EMPEÑO
                                        </button>
                                    </div>
                                    <br>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </template>
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
                authUser:'',porcent: 50,
                listadox:1,
                listado:2,
                //fechas
                authUser:1,
                birthdate: '',
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
                code:'', name:'',id:-1,paternal_last_name:'',maternal_last_name:'',phone:'',address:'',nro_doc:'',
                id_type_doc:'', email:'', department:'10', province:'92', district:'', reference:'',
                errorClase : 0,
               
                buscar:'',sex:'', marital_status:'',
                name_customer:'',capital:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_dependence:0,characteristic:'',tea:20,id_warehouse:'',
                id_person:0,id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
                period:'Mensual',arrayDetailPledge:[],licence_plate:'',
               

                arrayTypeProduct:[],arrayFamilyProduct:[],arrayWarehouse:[], array_department:[], array_province: [], array_district: [], array_type_document:[],array_code:[],
                totalcapital:0,totalInterest:0,modalTicket:0,idcustomer:-1,listProgram : [],listProgramx:[],
                midatax:[], list:[],totalNumber:0, id_customer_credit:-1,
                icon_title:'fa fa-plus', icon_save:'fa fa-save',icon_save_pledge:'fa fa-save', icon_edit:'fa fa-pencil',
                icon_search_dni:'fa fa-search', icon_search_client:'fa fa-search', icon_generate:'fa fa-rotate-right',
                title:'Agregar Cliente', add_aval:0
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
            sumTotal(){
                      this.totalcapital=0;
                      this.totalInterest=0;
                       for(var i=0;i<this.arrayDetailPledge.length;i++) 
                        {
                            this.totalcapital =  Number(this.totalcapital)+Number(this.arrayDetailPledge[i].capital);
                            this.totalInterest =  Number(this.totalInterest)+Number(this.arrayDetailPledge[i].interest);
                            
                        }
                   
            },  
           
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.list_data(page);
                
            },
            pledge(midata){

                alert('implementando...');
                return;
                let me=this;
                me.listadox=3;
                this.visible=0;
                this.id_customer_credit=midata.id_customer_credit;
                this.name_customer=midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name;
                this.nro_doc=midata.number_doc;
                var url= 'getDependenceParent';
                axios.get(url).then(function (response){
                    var respuesta= response.data;
                    me.arrayTypeProduct=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });

                url= 'getWarehouse';
                axios.get(url).then(function (response){
                    var respuesta= response.data;
                    me.arrayWarehouse=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                this.errors.address="";
                this.nro_doc="";
            },
            list_data(page){
                let me=this;                      
                me.listado=0;
                var url= 'getListCustomerCredit?buscar='+me.buscar+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list=respuesta.datax;
                    me.pagination= respuesta.pagination;                     
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           

        },
        
        mounted() {
           this.list_data(1);
           this.listadox=1;
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

