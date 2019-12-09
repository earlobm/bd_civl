<template>
    <main class="main">
        <section class="content-header">
            <h1>MONTO DEL DIA
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> MONTO</a></li>
              <li><a href="#"> CAJA</a></li>
              <li class="active">REGISTRO</li>
            </ol>
        </section>
        
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="box-header with-border">                            
                            <h1 class="box-title"><i class="fa fa-edit"></i> Monto del dia por Representante                                
                            </h1>
                        </div>
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
                                                            <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                                                                <div class="input-group" style="margin-bottom: 15px;">
                                                                    <input type="text"  v-model="buscar" @keyup.enter="listar(1)"  class="form-control" placeholder="Buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" @click="listar(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                                    </span>
                                                                </div>                                               
                                                            </div>
                                                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                                                <div class="btn-group" style="float:right;margin-left: 10px;">   
                                                                    <button type="button" @click="agregar()" class="btn btn-add">
                                                                        <i class="fa fa-plus"></i>&nbsp;Agregar Monto del dia
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
                                                                                 <th style="vertical-align: middle;">MONTO ASIGNADO</th>
                                                                                 <th style="vertical-align: middle;">MONTO DEVUELTO</th>
                                                                                 <th style="vertical-align: middle;">FECHA</th>
                                                                                <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(midata,index) in list" :key="index" >
                                                                                <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                                <td style="vertical-align: middle;" v-text="midata.number_doc"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.name_sucursal"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.name_mercado"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.amount_assigned"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.amount_delivered"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.date_register"></td>
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
                                                                        <i class="fa fa-save"></i>&nbsp;Guardar Monto del dia
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                                            
                                                            <div class="col-md-12">
                                                                <legend style="font-size:16px;"><strong> DATOS :</strong></legend>
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
                                                                <div class="form-group">
                                                                    <label for="sexo">Empleados:</label>
                                                                    <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                              
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_empleado_edit">
                                                                                    <option v-for="miselect in arrayEmpleado" :selected="miselect.id == id_empleado_edit" :key="miselect.id" :value="miselect.id">{{ miselect.number_doc}} {{ miselect.names}} {{ miselect.paternal_last_name}}</option>
                                                                                </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div v-bind:class="errorInputActivity5">
                                                                    <label for="nombres">Monto Asignado:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="amountAsing" type="text" class="form-control" placeholder="Monto" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div v-bind:class="errorInputActivity5">
                                                                    <label for="nombres">Monto Devuelto:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="amountDeli" type="text" class="form-control" placeholder="Monto" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label for="edad">Fecha de Registro:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar "></i></span>
                                                                        <date-picker v-model="date_register" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
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
                
                list : [],id_parent:'',year:'',
                listRecibido:[],
                authUser:'',porcent: 50,
                listado:1,
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

                name:'',id_empleado_edit:-1,paternal_last_name:'',maternal_last_name:'',date_register:'',address:'',nro_doc:'',
                errorClase : 0,id:-1,
                errors:{},
                errorInputActivity5:'form-group', errorInputActivity6:'form-group',
                errorInputAmount:'form-group',errorComboTipoProduco:'form-group',
                buscar:'',sex:'',type:'',marital_status:'',
                name_customer:'',amountAsing:0,amountDeli:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_sucursal:0,characteristic:'',tea:20,id_warehouse:'',
                id_person:0,id_sucursal_edit:-1,quantity:1,licence_plate:'',serie:'',note:'',id_mercado_edit:-1,
                period:'Mensual',arrayDetailPledge:[],licence_plate:'',serie:'',
                errorTotalAmount:'form-group',errorAmount:'form-group',errorTerm:'form-group',
                errorTea:'form-group',errorInterested:'form-group',errorWarehouse:'form-group',
                errorFamilyProduct:'form-group',errorCharacteristic:'form-group',

                arrayMercado:[],arraySucursal:[],arrayEmpleado:[]
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
                                    me.id_employee=respuesta.datax[0].id;
                                    me.name = respuesta.datax[0].names;
                                    me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                                    me.maternal_last_name = respuesta.datax[0].maternal_last_name;
                                    me.phone = respuesta.datax[0].phone;
                                    //me.array_mark =respuesta.datax[0].id_market;
                                    //me.array_mark=respuesta.datax[0].id_market;
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
                this.errors.amount="";
                //input
                //this.errorInputActivity5='form-group has-success';


                if (!this.amount) 
                {   
                    this.errors.amount="Ingrese el  monto";
                    //this.errorInputActivity5='form-group has-error';
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
                  me.getLitSucursal(2);
                //me.limpiar();
                var url= 'getEditListAmountDay?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id=respuesta.datax[0].id;
                                me.amountAsing = respuesta.datax[0].amount_assigned;
                                me.amountDeli = respuesta.datax[0].amount_delivered;
                                me.date_register = moment(respuesta.datax[0].date_register).toDate();
                                me.id_empleado_edit = respuesta.datax[0].id_employee;
                                me.id_mercado_edit =respuesta.datax[0].id_market;
                                me.id_sucursal_edit=respuesta.datax[0].id_sucursal;
                                
                                //me.getMercado(id);
                                // me.getEmpleado(id);
                                //me.id_sucursal_edit =respuesta.datax[0].sex;
                               // me.validarData();
                              
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            editarRecibido(id){
                let me=this;
                me.listado=2;
                  me.getLitSucursal(2);
                //me.limpiar();
                var url= 'getEditListAmountDayRecibido?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id=respuesta.datax[0].id;
                                me.amount = respuesta.datax[0].amount;
                                me.date_register = moment(respuesta.datax[0].date_register).toDate();;
                                me.type = respuesta.datax[0].type;
                                me.id_empleado_edit = respuesta.datax[0].id_employee;
                                me.id_mercado_edit =respuesta.datax[0].id_market;
                                me.id_sucursal_edit=respuesta.datax[0].id_sucursal;
                                
                                //me.getMercado(id);
                                // me.getEmpleado(id);
                                //me.id_sucursal_edit =respuesta.datax[0].sex;
                                me.validarData();
                              
                    
                
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
                axios.post('save_Amount',{
                    'amount_assigned':this.amountAsing,'id_employee':this.id_empleado_edit,'id_market':this.id_mercado_edit,
                    'amount_delivered':this.amountDeli, 
                    'id': this.id,
                    'date_register' : moment(moment(this.date_register, 'DD/MM/YYYY')).format('YYYY-MM-DD')                        
                }).then(function (response) {
                     me.limpiar();
                    //me.listado=1; 
                   // me.listar(1);                  
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
            getEmpleado(id){
                let me=this;
               // me.listado=0;
                var url= 'getEmpleado?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayEmpleado = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
                    axios.post('delete_AmountDay',{
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
            eliminarRecibido(id){
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
                    axios.post('delete_AmountDay',{
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
                 this.getLitSucursal(1);
            },
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
                me.listar(1);
                me.listarRecibido(1);
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            limpiar(){
                this.errorInputActivity5='form-group';
                this.errors = {};
                this.errors.amount="";
                this.amount="";
                this.id=-1;
                this.id_empleado_edit=-1;
                this.id_mercado_edit=-1;
                this.id_sucursal_edit=-1;
            },
            listar(page){
                let me=this;      
                me.listado=0;        
                var url= 'getListaEmpleado';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.list=respuesta.datax;
                    // me.pagination= respuesta.pagination; 
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

