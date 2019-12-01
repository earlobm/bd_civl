<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Empeñados
              <small>Cobranza</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Préstamos</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-edit"></i> Cobranza de Empeños
                            </h1>
                            <template v-if="listado==1">
                                <div class="box-tools pull-right">
                                    <span class="label label-success">TOTAL DE REGISTROS: {{pagination.total}}</span>
                                </div>
                            </template>
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
                                                                            <div class="col-md-12">
                                                                                <div class="input-group" style="margin-bottom: 15px;">
                                                                                    <input type="text"  v-model="buscar" @keyup.enter="listar(1)"  class="form-control" placeholder="Buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                                                    <span class="input-group-btn">
                                                                                        <button type="submit" @click="listar(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                                                    </span>
                                                                                </div>   
                                                                                <h5>TODAS LAS PRENDAS</h5>
                                                                            </div>
                                                                            <div class="col-md-6 col-sm-6 col-xs-12" v-for="(midata,index) in list" :key="index">
                                                                                <div class="info-box">
                                                                                    <span class="info-box-icon bg-green"><i class="fa fa-archive"></i></span>
                                                                                    <div class="info-box-content" style="padding: 0px;
                                                                                    background-color: #f0f0f0de;
                                                                                    border-top-right-radius: 2px;
                                                                                    border-bottom-right-radius: 2px;">
                                                                                        <span class="info-box-number" style="padding-left: 10px;">{{midata.nombres}}</span>
                                                                                        <span class="info-box-text" style="padding-left: 10px;">S/ {{midata.totalamount}} <strong>periodo:</strong> {{midata.fecha}} </span>
                                                                                        <span class="info-box-text" style="padding-left: 10px;"><strong>prenda:</strong> {{midata.guaranty}}</span>
                                                                                        <div class="small-box bg-green"  style="border-radius: 0px 0px 2px; margin-top: 2.1px;background-color: #158400 !important;">
                                                                                            <p align="center">
                                                                                            <a href="#" class="small-box-footer" @click="collect(midata)" style="color: white"><i class="fa fa-dollar" style="color: yellow;"></i> Cobrar</a>
                                                                                            <a href="#" class="small-box-footer" @click="delete_pledge(midata.id)"  style="color: white;margin-left: 15px;"><i class="fa fa-trash" style="color: red; "></i> Eliminar</a>
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </template>
                                                                    
                                                                    <template v-if="listado==3">
                                                                        <div class="row">  
                                                                            <div class="col-md-12">
                                                                                <div  class="form-group">
                                                                                    <label for="nombres">Cliente:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                        <input disabled v-model="name_customer" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <div  class="form-group">
                                                                                    <label for="nombres">Préstamo:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input disabled v-model="capital_customer" type="text" class="form-control" placeholder="200" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div  class="form-group">
                                                                                    <label for="nombres">Interés:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input disabled v-model="interest_customer" type="text" class="form-control" placeholder="20" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div  class="form-group">
                                                                                    <label for="nombres">Fecha Préstamo:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar"></i></span>
                                                                                        <input disabled v-model="date_customer" type="text" class="form-control" placeholder="20" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                            <div class="col-md-4">
                                                                                <div v-bind:class="errorInputActivity">
                                                                                    <label for="ap_paterno">Modo de Pago</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <select v-model="modePayment" v-on:change="modePaymentChange" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="" >Seleccione</option>
                                                                                            <option   value="Liquidacion" >Liquidacion</option>
                                                                                            <option   value="Amortizacion" >Amortizacion</option>
                                                                                            <option  value="Interes" >Interes</option>
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div v-bind:class="errorInputActivity2">
                                                                                    <label for="nombres">Monto a Pagar:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input v-model="amountPayment" type="text" class="form-control" placeholder="$" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                <div v-bind:class="errorInputActivity3">
                                                                                    <label for="ap_paterno">Fecha Modo de Pago:</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                        </div>
                                                                                        <date-picker v-model="dateModePayment" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                    
                                                                                        
                                                                        </div> 
                                                                        <div class="row">
                                                                             <div class="col-md-4">
                                                                                <label for="nombres" hidden>Programar:</label>
                                                                                <div class="checkbox">
                                                                                        <label class="container">
                                                                                            <input  type="checkbox" v-model="program">¿Desea programar proximo pago?
                                                                                            <span class="checkmark"></span>
                                                                                        </label>
                                                                                    </div> 
                                                                            </div> 
                                                                        </div>
                                                                        <div v-if="program" class="row">
                                                                            <div class="col-md-3">
                                                                                <label for="ap_paterno">Nuevo Programa de Pago</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <select v-model="newProgramPayment" v-on:change="calculateTeabyTerm" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="" >Seleccione </option>
                                                                                            <option   value="Diario" >Diario</option>
                                                                                            <option   value="Semanal" >Semanal</option>
                                                                                            <option   value="Quincenal" >Quincenal</option>
                                                                                            <option   value="Mensual" >Mensual</option>
                                                                                        </select> 
                                                                                    </div>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorInputActivity2">
                                                                                    <label for="nombres">Plazo:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input @change="calculateTeabyTerm" @keyup="calculateTeabyTerm" v-model="term" type="number" class="form-control" placeholder="Plazo" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorInputActivity3">
                                                                                    <label for="ap_paterno">Fecha Inicio:</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                        </div>
                                                                                        <date-picker @dp-change="calculateTeabyTerm" v-model="dateInit" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorInputActivity3">
                                                                                    <label for="ap_paterno">Fecha Fin:</label>
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                        </div>
                                                                                        <date-picker v-model="dateEnd" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorInputActivity2">
                                                                                    <label for="nombres">Monto:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input v-model="amount" type="text" class="form-control" placeholder="Monto" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorPorcentage">
                                                                                    <label for="nombres">%:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input v-model="tea" type="text" class="form-control" placeholder="Porcentaje" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorInterest">
                                                                                    <label for="nombres">Interes:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input v-model="interest" type="text" class="form-control" placeholder="Interes" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div v-bind:class="errorInterest">
                                                                                    <label for="nombres">Total a Pagar:</label>
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-chevron-right"></i></span>
                                                                                        <input v-model="totalPayment" type="text" class="form-control" placeholder="Interes" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                                                    
                                                                        </div>  
                                                                        <!-- Tabla           -->
                                                                        <div class="box-body table-responsive no-padding">
                                                                            <table  class="table table-hover" style="font-size:12px">
                                                                                <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                                                                    <tr>
                                                                                        <th style="vertical-align: middle;">#</th>
                                                                                        <th style="vertical-align: middle;">FECHA</th>
                                                                                        <th style="vertical-align: middle;">OPERACIÓN</th>
                                                                                        <th style="vertical-align: middle;">MONTO</th>
                                                                                        <th style="text-align: center; vertical-align: middle;">OPCIONES</th>
                                                                                    </tr> 
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="(midata,index) in listMovementPledge" :key="index" >
                                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                                        <td style="vertical-align: middle;" v-text="midata.date_movement"></td>
                                                                                        <td style="vertical-align: middle;" v-text="midata.operation"></td>
                                                                                        <td style="vertical-align: middle;" v-text="midata.capital"></td>
                                                                                        <td style="text-align: center; vertical-align: middle;">     
                                                                                            <button type="button" @click="printx(midata)" class="btn btn-print btn-sm" data-toggle="tooltip" title="Imprimir">
                                                                                                <i class="fa fa-print"></i>
                                                                                            </button>
                                                                                            <button type="button" @click="eliminar(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
                                                                                                <i class="fa fa-trash"></i>
                                                                                            </button>
                                                                                        </td> 
                                                                                    </tr>    
                                                                                                        
                                                                                </tbody>
                                                                            </table>                            
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
                            <template v-if="listado==1">
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
                            </template>
                            <template v-if="listado==3">
                                <div class="btn-group" style="float:right">
                                    <button type="button" @click="volver()" class="btn btn-danger">
                                        <i class="fa fa-close"></i>&nbsp;CANCELAR
                                    </button>
                                    <button type="button" @click="save()" class="btn btn-primary">
                                        <i class="fa fa-save"></i>&nbsp;GUARDAR PAGO
                                    </button>
                                </div>
                            </template>
                        </div>
                        
                    </div>
                </div>
                <!-- Detalle -->
                <template v-if="listado==3">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h1 class="box-title">
                                </h1>
                            
                                <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                                <div class="box-tools pull-right" style="right: -15px;">
                                    <div class="col-md-12" style="margin-top: 6px;">
                                        <label  class="col-md-8 control-label">Ver más detalles:</label>
                                        <div class="col-md-4" style="margin-top: -10px;">
                                            <div class="checkbox">
                                                <label class="switch" style="width: 62px;height: 18px;">
                                                    <input type="checkbox" v-model="view_detail">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                                <div class="box-body table-responsive no-padding" v-if="view_detail">
                                    <table  class="table table-hover" style="font-size:12px">
                                        <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                            <tr>
                                                <th style="vertical-align: middle;">#</th>
                                                <th style="vertical-align: middle;">FECHA INICIO</th>
                                                <th style="vertical-align: middle;">FECHA FIN</th>
                                                <th style="vertical-align: middle;">OPERACIÓN</th>
                                                <th style="vertical-align: middle;">CARGO</th>
                                                <th style="vertical-align: middle;">ABONO</th>
                                                <th style="vertical-align: middle;">SALDO</th>
                                                <th style="text-align: center; vertical-align: middle;">OPCIÓN</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <tr v-for="(midata,index) in listDetailMovementPledge" :key="index" >
                                                <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                <td style="vertical-align: middle;" v-text="midata.date_init"></td>
                                                <td style="vertical-align: middle;" v-text="midata.date_end"></td>
                                                <td style="vertical-align: middle;" v-text="midata.operation"></td>
                                                <td style="vertical-align: middle;" v-text="midata.charge"></td>
                                                <td style="vertical-align: middle;" v-text="midata.payment"></td>
                                                <td style="vertical-align: middle;" v-text="midata.residue"></td>
                                                <td style="text-align: center; vertical-align: middle;">     
                                                    <button type="button" @click="eliminar(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td> 
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
                
                list : [],idParent:'',year:'',
                arrayDataDetalle : [],
                 empresa:'',term:1,
                listado:1,
                authUser:1,
                fechaFin: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                name:'',id:-1,
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity2:'form-group',
                errorInputActivity3:'form-group',
                errorInputActivity4:'form-group',
                errorInputActivity5:'form-group',
                errorInputActivity6:'form-group',
                errorInputAmount:'form-group',
                errorComboTipoProduco:'form-group',
                buscar:'',name_customer:'',
                modePayment:'',amountPayment:0,
                dateModePayment: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                dateInit: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                dateEnd: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                
                newProgramPayment:'Mensual',amount:'',tea:'',interest:0,totalPayment:'',program:'',
                capital_customer:0,interest_customer:0,date_customer:'',
                errorPorcentage:'form-group',errorInterest:'form-group',
                listDetailMovementPledge:[],id_pledge:0,id_customer:0,residue:0,
                view_detail:0,listMovementPledge:[]
                
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
          
              delete_pledge(idx) {
                swal({
                title: '¿Esta seguro de eliminar?',
                type: 'warning',showCancelButton: true,
                confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                   axios.post('delete_pledge',{
                        'id': idx

                    }).then(function (response) {
                   // me.listado=1;
                    me.listar(1);
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if ( result.dismiss === swal.DismissReason.cancel
                ) {} }) 
               
                
            },
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.name="";
                this.errors.amount="";
                //input
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errorInputActivity3='form-group';
                this.errorInputActivity4='form-group';
                this.errorInputActivity5='form-group';
                this.errorInputActivity6='form-group';
                this.errorInputAmount='form-group';
                this.errorComboTipoProduco='form-group';
                this.errorPorcentage='form-group';
                this.errorInterest='form-group';


                if (!this.modePayment) 
                {  
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.amountPayment) 
                {   
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.dateModePayment) 
                {   
                    this.errorInputActivity3='form-group has-error';
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
            save(){
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
                axios.post('save_payment_pledge',{
                    'id_pledge': this.id_pledge,'id_customer': this.id_customer,
                    'amountPayment':this.amountPayment,'operation':this.modePayment,
                    'residue':Number(this.residue)-Number(this.amountPayment),'interest':0,
                    'dateModePayment' : moment(moment(this.dateModePayment, 'DD/MM/YYYY')).format('YYYY-MM-DD')                        
                }).then(function (response) {
                    
                   //imprimir
                    var url= 'ticket_plegde?capital='+me.amountPayment+'&interest=0&name_customer='+me.name_customer
                            +'&date_movement='+moment(moment(me.dateModePayment, 'DD/MM/YYYY')).format('YYYY-MM-DD')+
                            '&type='+me.modePayment;
                            window.open(url, '_blank');            
                    swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success') ;
                        me.listar(1);
                        me.listado=1;
                           
                }).catch(function (error) {
                    console.log(error);
                });

                } else if (result.dismiss === swal.DismissReason.cancel) { }
                }) 
            },
            modePaymentChange(){
                if(this.modePayment=='Liquidacion'){
                    this.amountPayment=this.residue;
                    //this.amountPayment=Number(this.interest_customer)+Number(this.capital_customer);
                    this.program=0;
                }else if(this.modePayment=='Interes'){
                    this.amountPayment=this.interest_customer;
                }else {
                    this.amountPayment=this.residue;
                    //this.amountPayment=Number(this.interest_customer)+Number(this.capital_customer);
                }
            },
            addDay(day){
                   
                   var fecha=new Date();
                        fecha.setDate(moment(moment(this.dateInit, 'DD/MM/YYYY')).format('DD'));
                        fecha.setMonth(moment(moment(this.dateInit, 'DD/MM/YYYY')).format('MM')-1);
                        fecha.setYear(moment(moment(this.dateInit, 'DD/MM/YYYY')).format('YYYY'));
                   var fechaoriginal = new Date();

                   fechaoriginal.setDate(moment(moment(this.dateInit, 'DD/MM/YYYY')).format('DD'));
                    fechaoriginal.setMonth(moment(moment(this.dateInit, 'DD/MM/YYYY')).format('MM')-1);
                    fechaoriginal.setYear(moment(moment(this.dateInit, 'DD/MM/YYYY')).format('YYYY'));
                    var contador=0;
                    var dayoriginal=day;
                    if(this.newProgramPayment=='Diario'){
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
                   if(this.newProgramPayment=='Semanal'){
                         day=day*7;
                         fechaoriginal.setDate(fechaoriginal.getDate()+day);
                           
                   }
                    if(this.newProgramPayment=='Quincenal'){
                       day=day*15;
                         fechaoriginal.setDate(fechaoriginal.getDate()+day);
                   }
                    if(this.newProgramPayment=='Mensual'){
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

               // this.interest=Number(this.amount)*(Number(this.tea)*Number(this.term))/100;
               // this.interest=Number((this.interest).toFixed(1));
                //this.date_end='01-01-01';
                // var hoy= ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear();
                this.dateEnd=this.addDay(Number(this.term));
               },
            volver(){
                let me=this;
                me.listado=1;
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
           printx(midata){
                let me=this;
                var url= 'ticket_plegde?capital='+midata.capital+'&interest='+midata.interest+'&name_customer='+this.name_customer
                +'&date_movement='+midata.date_movement+'&date_system='+midata.date_system+'&type='+midata.operation;
                window.open(url, '_blank');
              //  window.location.href = url;
            },
            collect(midata){
                let me=this;
                me.listado=3;
                this.name_customer=midata.nombres;
                
                this.capital_customer=midata.capital;
                this.amount=midata.capital;
                this.tea=midata.tea;
                this.interest_customer=midata.interest;
                this.date_customer=midata.fecha;
                this.dateInit=moment(midata.date_end).toDate();
                 this.dateEnd=this.addDay(Number(this.term));

                 this.id_pledge=midata.id;
                 this.id_customer=midata.id_person;
                 //obteniendo los movimientos o pagos
                var url= 'get_movement_pledge?id_pledge='+midata.id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.listMovementPledge=respuesta.datax;
                     
                }).catch(function (error) {
                    console.log(error);
                });
                //obteniendo el detalle de movimiento o historial del empeño
                 url= 'get_detail_movement_pledge?id_pledge='+midata.id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.listDetailMovementPledge=respuesta.datax;
                     for(var i=0;i<me.listDetailMovementPledge.length;i++) 
                        {
                            me.residue=me.listDetailMovementPledge[i].residue;
                        }
                        //alert(me.residue);
                        me.amountPayment=me.residue;
                     
                }).catch(function (error) {
                    console.log(error);
                });
                
            },
            listar(page){
                let me=this;      
                me.listado=0;        
                var url= 'get_list_active_pledge?buscar='+me.buscar+'&page='+page;
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
           
        },
        mounted() {
           this.listar(1);
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

