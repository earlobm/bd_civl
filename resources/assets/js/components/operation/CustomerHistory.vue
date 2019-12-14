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
                    <div v-bind:class="historyCustomerToogle">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Historial de Clientes
                            </h1>
                        
                            <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                            <div class="box-tools pull-right">
                                <span class="label label-success">TOTAL DE REGISTROS: {{pagination.total}}</span>
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
                                                <button type="button" @click="detailCredit(midata)" class="btn btn-emprendar btn-sm" data-toggle="tooltip" title="Historial crediticio">
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

                <!-- Historial de creditos -->
                <div class="col-md-12"  v-if="visible">
                    <div v-bind:class="detailCreditToogle" >
                        <div class="box-header with-border">
                           <button type="button" @click="volver()" class="btn btn-atras btn-sm"><i class="fa fa-arrow-left"></i></button> 
                            
                            <h1 class="box-title"> Historial de Créditos
                            </h1>
                        
                            <div class="box-tools pull-right">
                                <span class="label label-success">TOTAL DE CRÉDITOS: {{pagination.total}}</span>
                                
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Cliente:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="nameCustomer" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Código Crédito:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_doc">
                                                <option selected="selected" value="">Seleccione</option>
                                                <option v-for="datax in array_type_document" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                            </select> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Estado:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Activar:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input   type="checkbox"  >  
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Fecha desembolso:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Plazo:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Periodo:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Tasa de Interés:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Capital:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Interés:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Mora:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nombres">Dias Mora:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                            <input disabled v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                        </div>
                                    </div>
                                </div>
                            
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>  
                                            <th style="vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle;">FECHA</th>
                                            <th style="vertical-align: middle;">MONTO</th>
                                            <th style="vertical-align: middle;">MODALIDAD</th>
                                            <th style="vertical-align: middle;">ELIMINAR</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                                            
                                    </tbody>
                                </table>                                
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

                buscar:'',nameCustomer:'',
                historyCustomerToogle:'box box-primary ',
                historyCustomerIconToogle:'fa fa-minus ',
                detailCreditToogle:'box box-primary collapsed-box',
                detailCreditIconToogle:'fa fa-plus'
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
            volver(){
                this.historyCustomerToogle='box box-primary';
                this.detailCreditToogle='box box-primary collapsed-box';

                this.historyCustomerIconToogle='fa fa-minus ';
                this.detailCreditIconToogle='fa fa-plus';

            },
            detailCredit(midata){

                this.historyCustomerToogle='box box-primary collapsed-box';
                this.detailCreditToogle='box box-primary';

                this.historyCustomerIconToogle='fa fa-plus ';
                this.detailCreditIconToogle='fa fa-minus';

                this.nameCustomer=midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name;

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

