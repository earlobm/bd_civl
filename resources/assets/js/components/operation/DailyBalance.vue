<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Operación
              <small>Balance Diario</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Balance</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <!-- Lista de Clientes -->
                <div class="col-md-12"  v-if="visible">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i>Balance
                            </h1>
                        
                            <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                            <div class="box-tools pull-right">
                                <span class="label label-success">TOTAL DE REGISTROS: {{listCredit.length}}</span>
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sexo">Sucursal:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                             
                                            <select @change="getMarket($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_branch_office">
                                                <option  value=""  >Todos</option>
                                                <option v-for="miselect in arraySucursal" :selected="miselect.id == id_branch_office" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sexo">Mercado:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                              
                                            <select class="form-control" @change="getEmployee($event.target.value)" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_market_edit">
                                                 <option  value="" >Todos</option>
                                                <option v-for="miselect in arrayMercado" :selected="miselect.id == id_market_edit" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sexo">Promotor:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                              
                                            <select class="form-control"  style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_promoter">
                                                 <option  value="" >Todos</option>
                                                <option v-for="miselect in arrayEmployee" :selected="miselect.id == id_promoter" :key="miselect.id" :value="miselect.id">{{ miselect.number_doc}} {{ miselect.names}} {{ miselect.paternal_last_name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date_register">Fecha:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <date-picker  v-model="date_register" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-10">
                                        <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                            <input type="text"  v-model="search" @keyup.enter="list_data(1)"  class="form-control" placeholder="Buscar por nombres de promotor..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                            <span class="input-group-btn">
                                                <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                            </span>
                                        </div>                                               
                                </div>
                                <div class="col-md-2">
                                        <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                            <span class="input-group-btn">
                                                <button type="submit" @click="downloadPdf()"  class="btn btn-block btn-danger" data-toggle="tooltip" title="Descargue en formato PDF" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-file-pdf-o"></i> DESCARGAR</button>
                                            </span>
                                        </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>  
                                            <th style="vertical-align: middle;">MERCADO</th>
                                            <th style="vertical-align: middle;">PROMOTOR</th>
                                            <th style="vertical-align: middle;">TOTAL</th>
                                            <th style="vertical-align: middle;">PRESTAMO</th>
                                            <th style="vertical-align: middle;">COBRO</th>
                                            <th style="vertical-align: middle;">GASTOS ADMIN</th>
                                            <th style="vertical-align: middle;">CENTRAL DE RIESGO</th>
                                            <th style="vertical-align: middle;">MORA</th>
                                            <th style="vertical-align: middle;">SOBRANTE</th>
                                            <th style="vertical-align: middle;">FALTANTE</th>
                                            <th style="vertical-align: middle;">ADELANTO FALTANTE</th>
                                            <th style="vertical-align: middle;">T. ENTREGADO</th>
                                            <th style="vertical-align: middle;">PANDERO</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in listCredit" :key="index" >
                                            <td style="vertical-align: middle;" v-text="midata.mercado"></td>
                                            <td style="vertical-align: middle;" v-text="midata.nombres"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_prestamo"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_cobro"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_gasto_admin"></td>
                                            <td style="vertical-align: middle;" v-text="midata.central_riesgo"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_mora"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_sobrante"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_faltante"></td>
                                            <td style="vertical-align: middle;" v-text="midata.adelanto_faltante"></td>
                                            <td style="vertical-align: middle;" v-text="midata.total_entregado"></td>
                                            <td style="vertical-align: middle;" v-text="midata.pandero"></td>

                                        </tr>                       
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
                
                visible:1, authUser:'',
                listado:2,
                //fechas
                authUser:1,
                date_register: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',errorInputActivity2:'form-group',
                search:'',
                total:0,
                errorTotalcapital:'form-group',
                midatax:[], listCredit:[],totalNumber:0,

                arraySucursal:[],arrayMercado:[],id_branch_office:'',id_market_edit:'',
                arrayEmployee:[],id_promoter:''
            }
        },
         components: {
            datePicker,moment
        },
       
        methods : { 
            getEmployee(id){
                let me=this;
               // me.listado=0;
                var url= 'getEmpleado?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayEmployee = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getListBranchOffice(){
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
            getMarket(id){
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
            getPromoter(id){
                let me=this;
               // me.listado=0;
                var url= 'getPromoert?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMercado = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
            downloadPdf(){    
                //if(this.id_promoter==''){alert('Seleccione promotor');return;}     
               let me=this;
               var date_pretty= moment(moment(this.date_register, 'DD/MM/YYYY')).format('DD/MM/YYYY') ;     
                
                var url= 'downloadDayliBalance?search='+me.search+'&id_branch_office='+me.id_branch_office+
                '&market='+me.id_market_edit+'&id_promoter='+me.id_promoter+'&date_now='+
                moment(moment(me.date_register, 'DD/MM/YYYY')).format('YYYY-MM-DD')+'&date_pretty='+date_pretty;
                //window.location.href = url;
                window.open(url, '_blank');  
            },
           
            list_data(page){
                let me=this;                      
                me.listado=0; 
                var url= 'getListDailyBalance?search='+me.search+'&id_branch_office='+me.id_branch_office+
                '&market='+me.id_market_edit+'&id_promoter='+me.id_promoter+'&date_now='+
                moment(moment(me.date_register, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listCredit=respuesta.datax;                 
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
      
        mounted() {
            
           this.list_data(1);
           this.getListBranchOffice();
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

