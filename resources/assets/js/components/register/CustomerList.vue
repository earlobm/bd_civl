<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Clientes
              <small>Listado</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-cogs"></i> Operaciones</a></li>
              <li>Clientes</li>
              <li class="active">Listar Clientes</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <template v-if="listadox==3">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <template v-if="listadox==3">   
                                <button type="button" @click="volver()" class="btn btn-atras btn-sm"><i class="fa fa-arrow-left"></i></button> 
                            </template>
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
                                        <div class="card">                            
                                            <div class="card-body">    
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                                        <div class="box-body">
                                                            <template v-if="listadox==3">
                                                                <div class="row">  
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Cliente:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input disabled v-model="name_customer" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="date_init">Fecha del Préstamo:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker v-model="date_credit" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="date_init">Inicio de Pago:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker v-model="date_init_payment" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Monto:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="capital" type="number" step="any"  min="1" @keyup="calculateAmount()" @click="calculateAmount()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div><div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Tasa de Interés:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">%</span>
                                                                                <input v-model="interest_rate" type="number"  min="1"  @keyup="calculateInterestRateCash()" @click="calculateInterestRateCash()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres" style="visibility:hidden">Tasa:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="interest_rate_cash" type="number" disabled class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Total:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="total_cash" type="number" disabled class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="type_product">Gastos Adm.:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">%</span>
                                                                                <input v-model="rate_admin" type="number" min="0" class="form-control" @keyup="calculateAmount()" @click="calculateAmount()" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc" style="visibility: hidden">Porcentaje:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="amount_admin" type="number" class="form-control" @keyup="calculateRate()" @click="calculateRate()" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Central de Riesgo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="risk_center" type="number" min="0" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Plazo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-hourglass"></i></span>
                                                                                <input v-model="number_quota" type="number" min="0" pattern="^[0-9]+" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorWarehouse">
                                                                            <label for="ap_paterno">Periodo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-calendar-plus-o"></i></span>
                                                                                <select   v-model="period_credit" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                    <option selected="selected" value="" >Seleccione</option>
                                                                                    <option value="DIARIO">Diario</option>
                                                                                    <option value="MENSUAL">Mensual</option>
                                                                                    <option value="ANUAL">Anual</option>
                                                                                </select>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Días de Gracia:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-life-ring"></i></span>
                                                                                <input v-model="grace_day" type="number" min="0" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div  class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="ap_paterno" style="visibility: hidden">Mora:</label>
                                                                            <div class="checkbox">
                                                                                <label class="container">
                                                                                    <input type="checkbox" v-model="apply_mora">
                                                                                    <strong>Aplicar Mora</strong>
                                                                                    <span class="checkmark"></span>
                                                                                </label>
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
                        <div class="box-footer">
                            <template v-if="listadox==3">
                                <button type="button" @click="saveDetailCredit()" class="btn btn-save-pledge" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Agregar prenda a empeñar">
                                    <i class="fa fa-legal"></i>&nbsp;OTORGAR PRÉSTAMO
                                </button>
                                <button type="button" @click="calculateCreditoDetail()" class="btn btn-new" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Nueva prenda">
                                    <i class="fa fa-calculator"></i>&nbsp;CALCULAR
                                </button>
                            </template>
                        </div>             
                    </div> 
                    
                    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalTicket}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                            <div class="col-md-12">
                                                <div class="sheet letter receipt">
                                                    <div class="content">
                                                        <h3 class="company-name ng-binding">TUMI DE ORO</h3>
                                                        <h4 class="branch-name ng-binding">Tingo María</h4>
                                                        <h5 class="long-date ng-binding">domingo, 20 de octubre de 2019</h5>
                                                        <p class="receipt-header ng-binding ng-hide" ng-show="template.header"></p>
                                                        <hr>
                                                        <div ui-view="" class="ng-scope">
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Contrato No. 1</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Cliente : {{name_customer}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Monto : S/ {{totalcapital}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Fecha de préstamo : {{date_init}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Fecha de vencimiento : {{date_end}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Interés : S/ {{totalInterest}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Periodo : {{period}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Plazo: {{term}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Prendas</div>
                                                                <div class="value">
                                                                    <ul class="item-list">
                                                                        <li v-for="(midata,index) in arrayDetailPledge" :key="index"  class="ng-binding ng-scope" style="">
                                                                            {{midata.guaranty}}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="balance ng-scope" ng-hide="isLoadingDetails">
                                                                <!--<h6 class="query-label">Historial</h6>-->
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="date">Fecha</th>								
                                                                            <th>Monto</th>
                                                                            <th>Interés</th>
                                                                            <th class="text-right">Subtotal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <!-- ngRepeat: operation in vm.operations --><tr ng-repeat="operation in vm.operations" class="ng-scope" style="">
                                                                        <td class="center date ng-binding">19/10/19 12:09</td>
                                                                        <td class="ng-binding">S/ 200</td>
                                                                        <td class="ng-binding">S/ 20</td>
                                                                        <td class="text-right ng-binding">S/ 2</td>
                                                                        </tr><!-- end ngRepeat: operation in vm.operations -->
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="date"></td>
                                                                            <td  ></td>
                                                                            <td><h4>Total</h4></td>
                                                                            <td class="text-right"> <h4 class="ng-binding">S/220</h4> </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <p class="receipt-footer ng-binding ng-hide" ng-show="template.footer"></p>
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
                </template>
                <!-- Lista de Clientes -->
                <div class="col-md-12"  v-if="visible">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Listado de Clientes
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
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
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
                                                <button type="button" @click="pledge(midata)" class="btn btn-emprendar btn-sm" data-toggle="tooltip" title="Otorgar Crédito">
                                                    <i class="fa fa-money"></i>
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
                <template v-if="listadox==3">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h1 class="box-title"><i class="fa fa-list"></i> Cronograma de Pago</h1>
                                <div class="box-tools pull-right">
                                    <span class="label label-success" style="margin-right:10px">TOTAL DE CUOTA: {{total_quota}}</span>
                                    <span class="label label-warning" style="margin-right:10px">TOTAL DE CAPITAL: {{total_amount}}</span>
                                    <span class="label label-danger">TOTAL DE INTERÉS: {{total_interest}}</span>
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
                                            <th style="vertical-align: middle; text-align: center;">FECHA DE VENCIMIENTO</th>
                                            <th style="vertical-align: middle; text-align: center;">CUOTA</th>
                                            <th style="vertical-align: middle; text-align: center;">CAPITAL</th>                                                                                        
                                            <th style="vertical-align: middle; text-align: center;">INTERÉS</th>
                                            <th style="vertical-align: middle; text-align: center;">SALDO PROYECTADO</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in arrayCreditDetail" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.date_expiration"></td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.quota"></td>  
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.capital"></td>  
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.interest"></td>  
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.saldo"></td>  
                                        </tr>                       
                                    </tbody>
                                </table>                                
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
            calculateAmount(){
                let me = this;
                me.total_cash='';
                me.interest_rate_cash='';
                me.amount_admin=(Number(me.capital)* Number(me.rate_admin))/100;
                console.log(me.amount_admin);
                me.interest_rate_cash=(Number(me.capital)*Number(me.interest_rate))/100;
                me.total_cash=Number(me.capital)+ Number(me.interest_rate_cash);
                
            },
            calculateRate(){
                let me = this;
                me.rate_admin="";
                me.rate_admin=(Number(me.amount_admin)* 100)/Number(me.capital);
            },
            calculateInterestRateCash(){
                let me = this;
                me.interest_rate_cash=(Number(me.capital)*Number(me.interest_rate))/100;
                me.total_cash=Number(me.capital)+Number(me.interest_rate_cash);
            },
            generate_code(){
                let me = this;
                me.icon_generate='fa fa-refresh fa-spin';
                var url= '/generate_code';                
                axios.get(url).then(function (response) {
                    var respuesta= response.data; 
                    me.array_code= respuesta.datax;                   
                    for(var i=0;i<me.array_code.length;i++){
                        me.code=me.array_code[i].code; 
                    } 
                    me.icon_generate='fa fa-rotate-right';                	
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            get_type_document(){
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
            get_department(){
                let me=this;
               // me.listado=0;
                var url= 'get_department';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_department=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            get_province(id_department){
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
            get_district(id_province){
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
            calculateCreditoDetail(){
                this.arrayCreditDetail=[];
                var date = new Date(moment(moment(this.date_init_payment, 'DD/MM/YYYY')).format('YYYY-MM-DD'));
                var saldo=Number(this.capital)+(Number(this.capital)* Number(this.interest_rate))/100;
                
                for( var i=0; i<this.number_quota;i++){
                    var date_day= date.getDay();
                    if(date_day==6){
                        date.setDate(date.getDate() + 2);
                    }else{
                        date.setDate(date.getDate() + 1);
                    }
                    var date_expiration=date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                    var date_expiration_detail= date.getFullYear()+'-'+ (date.getMonth()+1) + '-' + date.getDate();
                    var date_expiration_t= date.getFullYear()+'-'+ (date.getMonth()+1) + '-' + date.getDate();

                    var quota=((Number(this.capital) + (Number(this.capital) * Number(this.interest_rate))/100)/Number(this.number_quota)).toFixed(1);
                    var result = quota*(Number(this.number_quota)-1);
                    result = (Number(this.capital) + (Number(this.capital) * Number(this.interest_rate))/100) - result;
                    if(i==1){
                        this.quota=quota;
                        console.log(this.quota);
                    }
                    if(i==(Number(this.number_quota)-1)){
                        quota=result.toFixed(1);
                    }

                    var capital=(Number(this.capital)/Number(this.number_quota)).toFixed(1);
                    var result = capital * (Number(this.number_quota) - 1);
                    result = Number(this.capital) - result;
                    if(i==(Number(this.number_quota)-1)){
                        capital=result.toFixed(1);
                    }

                    var interest=(((Number(this.capital)*Number(this.interest_rate))/100)/Number(this.number_quota)).toFixed(1);
                    var result = interest * (Number(this.number_quota) - 1);
                    result = ((Number(this.capital) * Number(this.interest_rate))/100) - result;
                    if(i==(Number(this.number_quota)-1)){
                        interest=result.toFixed(1);
                    }
                    saldo=saldo-quota;
                    if(i==(Number(this.number_quota)-1)){
                        saldo=0;                        
                    }
                    this.date_ultimate=date_expiration_t;
                    this.arrayCreditDetail.push({
                        id:i+1,
                        date_expiration: date_expiration,
                        date_expiration_detail: date_expiration_detail,
                        quota: quota,
                        capital: capital,
                        interest: interest,
                        saldo: saldo.toFixed(1)
                    });                    
                }
                this.total_quota=this.total_cash;
                this.total_amount=this.capital;
                this.total_interest=this.interest_rate_cash;
            },
            saveDetailCredit(){
                this.calculateCreditoDetail();
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
                        axios.post('save_detail_credit',{     
                            'date_credit': moment(moment(this.date_credit, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'date_init_payment': moment(moment(this.date_init_payment, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'date_expiration': moment(this.date_ultimate).format('YYYY-MM-DD'),
                            'capital':this.capital,
                            'interest':this.interest_rate_cash,
                            'total':this.total_cash,
                            'rate_admin':this.rate_admin,
                            'amount_admin':this.amount_admin,
                            'quota':this.quota,
                            'number_quota':this.number_quota,
                            'period_credit':this.period_credit,
                            'grace_day':this.grace_day,
                            'risk_center':this.risk_center,
                            'apply_mora':this.apply_mora,
                            'id_customer':this.id_customer_credit,
                            'id_promoter':this.id_employee,
                            'array_credit_detail':this.arrayCreditDetail
                        }).then(function (response) {
                                // me.clean_data();                                
                                // me.list_data(1);  
                                // me.icon_save='fa fa-save';
                                swal( 'Guardado!', 'El crédito ha sido otorgado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });                        
                    }else if(result.dismiss === swal.DismissReason.cancel) { 
                    }
                }) 
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
            savePledge() {
                if(this.arrayDetailPledge.length<1){
                    return;
                }
                swal({
                title: '¿Esta seguro?',
                type: 'warning',showCancelButton: true,
                confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true
                }).then((result) => {
                if (result.value) {
                      let me = this;
                        axios.post('save_pledge',{
                            'idcustomerpledge':this.id_customer_credit,
                            'date_init':moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD') ,
                            'date_end':moment(moment(this.date_end, 'DD/MM/YYYY')).format('YYYY-MM-DD') ,
                            'period':this.period,'licence_plate':this.licence_plate,
                            'serie':this.serie,
                            'term': this.term,'tea': this.tea,'interest': this.totalInterest,
                            'capital':this.totalcapital,'total':Number(this.totalcapital)+Number(this.totalInterest),
                            'detail_pledge':this.arrayDetailPledge,
                            'id_warehouse':this.id_warehouse.id               
                        }).then(function (response) {

                             swal(
                                'Guardado!',
                                'El registro ha sido guardado con éxito.',
                                'success'
                                )
                           me.dowloadContract();     

                           var url= 'ticket_plegde?capital='+me.totalcapital+'&interest='+me.totalInterest+'&name_customer='+me.name_customer
                            +'&date_movement='+moment(moment(me.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD')+
                            '&type=Empenio';
                            window.open(url, '_blank');  

                             
                             me.volver();
                             me.list_data(1); 
                        }).catch(function (error) {
                            console.log(error);
                        });

                  //  this.modalTicket=1;
                   
                } else if ( result.dismiss === swal.DismissReason.cancel
                ) {} }) 
                
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
            getFamilyProduct(id_parent){
                let me=this;
               // me.listado=0;
                var url= 'getDependenceParent?id_parent='+id_parent;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.arrayFamilyProduct=respuesta.datax;
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
                    warehouse:this.id_warehouse.name,
                    licence_plate:this.licence_plate,serie:this.serie
                    ,capital:this.capital,interest:this.interest,
                    id_guaranty:this.guaranty.id,id_warehouse:this.id_warehouse.id
                    });
                this.sumTotal();
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
                     this.sumTotal();
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
                this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                this.interest=Number((this.interest).toFixed(1));
                //this.date_end='01-01-01';
                // var hoy= ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear();
                this.date_end=this.addDay(Number(this.term));
               },
            calculateTeabyInteres(){
                   if(this.period=='Diario'){
                       this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                        this.interest=Number((this.interest).toFixed(1));
                   }
                   if(this.period=='Semanal'){
                       this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Quincenal'){
                       this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Mensual'){
                       this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                       
               },
            calculateTeabyPerioid(){
                   if(this.period=='Diario'){
                       this.tea=0.67;
                       this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                        this.interest=Number((this.interest).toFixed(1));
                   }
                   if(this.period=='Semanal'){
                       this.tea=5;
                       this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Quincenal'){
                       this.tea=10;
                       this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                    if(this.period=='Mensual'){
                       this.tea=20;
                       this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                       this.interest=Number((this.interest).toFixed(1));
                   }
                   this.calculateTeabyTerm();
                       
               },
            getData(){
                     //obteniendo datos de reniec
                if (this.nro_doc.length==8){   
                    let me=this;          
                    me.icon_search_dni='fa fa-spinner fa-spin';    
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
                                    me.icon_search_dni='fa fa-search'; 
    
                        }
                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            validarReniec(){
                     //obteniendo datos de reniec
                if (this.nro_doc.length==8) 
                {   
                    let me=this;              
                    var url= 'getDataCustomerBynro_doc?nro_doc='+me.nro_doc;
                    axios.get(url).then(function (response) {
                         var respuesta= response.data;
                         var tipo=respuesta.tipo;
                          if(respuesta.datax.length>0){
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.name = respuesta.datax[1];
                                    me.maternal_last_name = respuesta.datax[2];
    
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
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errorInputActivity3='form-group';
                this.errorInputActivity4='form-group';
                this.errorInputActivity5='form-group';
                this.errorInputActivity6='form-group';
                this.errorInputcapital='form-group';
                this.errorComboTipoProduco='form-group';
                this.errorTotalcapital='form-group';


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
                if (!this.code) 
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
                this.errorcapital='form-group';
                this.errorTerm='form-group';
                this.errorTea='form-group';
                this.errorInterested='form-group';
                this.errorWarehouse='form-group';
                this.errorFamilyProduct='form-group';
                this.errorCharacteristic='form-group';

                if (!this.capital) 
                {  
                    this.errorcapital='form-group has-error';
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
          
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.list_data(page);
                
            },
            edit_data(id){
                let me=this;
                me.listado=2;
                me.clean_data();
                me.get_type_document();
                me.icon_edit='fa fa-spinner fa-spin';
                var url= 'edit_data?id='+id;
                me.id_customer_credit=id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.nro_doc = respuesta.datax[0].number_doc;
                    me.name = respuesta.datax[0].names;
                    me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                    me.maternal_last_name = respuesta.datax[0].maternal_last_name;
                    me.phone = respuesta.datax[0].phone;
                    me.address =respuesta.datax[0].address;
                    me.sex =respuesta.datax[0].sex;
                    me.reference =respuesta.datax[0].reference;
                    me.code =respuesta.datax[0].code;
                    me.email =respuesta.datax[0].email;
                    me.district =respuesta.datax[0].id_district;
                    me.province =respuesta.datax[0].id_province;
                    me.department =respuesta.datax[0].id_department;
                    me.id_type_doc =respuesta.datax[0].id_type_document;
                    me.marital_status =respuesta.datax[0].marital_status;
                    me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
                    me.validarData();         
                    me.icon_edit='fa fa-pencil';       
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            save_data_only_client(){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente  
                this.visible=0;
                let me = this;
                me.icon_save='fa fa-spinner fa-spin';
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
                }).then((result) =>{
                    if (result.value){                
                        axios.post('saveCustomerCredit',{
                            'nro_doc':this.nro_doc,'name':this.name,
                            'paternal_last_name':this.paternal_last_name,
                            'maternal_last_name':this.maternal_last_name,
                            'phone':this.phone,'address':this.address, 
                            'id': this.id,'sex': this.sex,
                            'code': this.code,'id_type_document': this.id_type_doc,
                            'marital_status': this.marital_status,
                            'email': this.email,'reference': this.reference,
                            'id_district': this.district,
                            'birthdate' : moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'id_customer_credit':this.id_customer_credit                    
                        }).then(function (response) {
                                me.clean_data();                                
                                me.list_data(1);  
                                me.visible=1;
                                me.icon_save='fa fa-save';
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });

                    }else if(result.dismiss === swal.DismissReason.cancel) {                    
                    }
                }) 
            },
            save_data(){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente  
                this.visible=0;
                let me = this;
                me.icon_save_pledge='fa fa-spinner fa-spin';
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
                }).then((result) =>{
                    if (result.value){                
                        axios.post('save_customer',{
                            'nro_doc':this.nro_doc,'name':this.name,
                            'paternal_last_name':this.paternal_last_name,
                            'maternal_last_name':this.maternal_last_name,
                            'phone':this.phone,'address':this.address, 
                            'id': this.id,'sex': this.sex,
                            'code': this.code,'id_type_document': this.id_type_doc,
                            'marital_status': this.marital_status,
                            'email': this.email,'reference': this.reference,
                            'id_district': this.district,
                            'birthdate' : moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'idcustomerpledge':this.id_customer_credit                    
                        }).then(function (response) {
                                me.midatax=[];
                                me.midatax.push({id:response.data,names: me.name,paternal_last_name: me.paternal_last_name, maternal_last_name:me.maternal_last_name });
                                me.pledge(me.midatax[0]);
                                me.icon_save_pledge='fa fa-save';
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });

                    }else if(result.dismiss === swal.DismissReason.cancel) {                    
                    }
                }) 
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
            pledge(midata){
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
                this.arrayDetailPledge=[];     
                this.totalcapital=0;
                this.totalInterest=0;     
                this.characteristic="";
                this.serie="";
                this.licence_plate="";
                this.mounted=0;
                this.capital=0;
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
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            get_type_document(){
                let me=this;
                var url= 'getTypeDocument';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },
            get_type_business(){
                var url= 'get_product_program?id_customer=' + id_product;
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

            init: function() {
            //cargar actividades
                let me=this;  
                me.listProgramx=[];        
                var url= 'getTypeDocument';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var lista=respuesta.datax;
                    for(var i=0; i < lista.length; i++){
                       me.listProgramx.push({ check:false,id_type_document: lista[i].id_type_document, id_product:''});
                       console.log(me.listProgramx);
                      
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           
        },
        
        mounted() {
        //    this.lista_add_client();
            this.list_data(1);
            this.calculateAmount(2);
            this.calculateInterestRateCash();
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

