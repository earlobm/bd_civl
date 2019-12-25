<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Resumen Diario
              <small>Detalle</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Resumen Diario</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">              
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">                        
                            <div class="row">
                                <div class="box-tools pull-right" style="right: -15px;">
                                    <div class="col-md-12" style="margin-top: 6px;">
                                        <p  class="col-md-8" style="text-align:right"><i class="fa fa-filter"></i> Ver Filtros:</p>
                                        <div class="col-md-4" style="margin-top: -10px;">
                                            <div class="checkbox">
                                                <label class="switch" style="width: 92px; height: 18px;">
                                                    <input type="checkbox" v-model="filter">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row" v-if="filter==1">
                                    <div class="col-md-12">
                                        <div class="container-fluid">                           
                                            <div class="row">
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
                                                            <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_mercado_edit">
                                                                <option selected="selected" value="" >Seleccione</option>
                                                                <option v-for="miselect in arrayMercado"  @click="getResumenDia" :selected="miselect.id == id_mercado_edit" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="edad">Fecha:</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar "></i></span>
                                                            <date-picker v-model="date_creation" @dp-change="getResumenDia" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
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
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Detalle
                            </h1>                        
                            <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                            <template v-if="listado==1">
                                <div class="box-tools pull-right">
                                    <span class="label label-success">TOTAL DE REGISTROS: {{list_resumenday.length}}</span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                </div>
                            </template>
                        </div>
                        <template v-if="listado==0">
                            <div align="center">
                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                <!-- <p>Cargando...</p> -->
                            </div>
                        </template>
                        <template v-if="listado==1">
                            <div class="box-body table-responsive no-padding">
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: #90a4ae;color: #fff;">                                                                                   
                                        <tr>
                                            <th style="vertical-align: middle; text-align: center;">#</th>
                                            <th style="vertical-align: middle; text-align: center;">PROMOTORES</th>
                                            <th style="vertical-align: middle;">SUCURSAL</th>
                                            <th style="vertical-align: middle;">MERCADO</th>
                                            <th style="vertical-align: middle; text-align: center;">TOTAL ENTREGADO</th>
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in list_resumenday" :key="index" >
                                            <td style="vertical-align: middle; text-align: center;" >{{(index+1)}}</td>                                                
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name"></td>
                                            <td style="vertical-align: middle;" v-text="midata.name_sucursal"></td>
                                            <td style="vertical-align: middle;" v-text="midata.name_mercado"></td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.amount_delivered"></td>
                                            <td style="text-align: center; vertical-align: middle;">                                                                                    
                                                <button type="button" @click="operation(midata.id_employee, date_creation,midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Ver detalles...">
                                                    <i class="fa fa-clipboard"></i>
                                                </button>      
                                            </td> 
                                        </tr>                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer">
                            </div>                           
                        </template> 
                        <template v-if="listado==2">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="container-fluid">                           
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box box-widget widget-user" style="margin-top:15px">
                                                        <div class="widget-user-header bg-aqua-active">
                                                            <h3 class="widget-user-username">{{promoter}}</h3>
                                                            <h5 class="widget-user-desc">Promotor</h5>
                                                        </div>
                                                        <div class="widget-user-image">
                                                            <img class="img-circle" src="/img/user1-128x128.jpg" alt="User Avatar">
                                                        </div>
                                                        <div class="box-footer">
                                                            <div class="row">
                                                                <div class="col-sm-3 border-right">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{name_branch}}</h5>
                                                                        <span class="description-text">SUCURSAL</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 border-right">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{name_market}}</h5>
                                                                        <span class="description-text">MERCADO</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3 border-right">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{date_register}}</h5>
                                                                        <span class="description-text">FECHA</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="description-block">
                                                                        <h5 class="description-header">{{amount_delivered}}</h5>
                                                                        <span class="description-text">TOTAL ENTREGADO</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                <div class="box-body table-responsive no-padding">
                                                    <table  class="table table-hover" style="font-size:12px">
                                                        <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                                            <tr>  
                                                                <th colspan="7" style="vertical-align: middle;">CAJA</th>
                                                                <th width="20%" style="vertical-align: middle; text-align: right;">TOTAL</th>
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6" style="vertical-align: middle; text-align: right;background: #fff; color: rgb(32, 32, 32);" >MONTO DEL DÍA</th>
                                                                <th colspan="2" width="20%" style="vertical-align: middle; text-align: right;background: #fff; color: rgb(32, 32, 32);" >{{amount_assigned}}</th> 
                                                            </tr>
                                                        </thead>
                                                    </table> 
                                                    <table  class="table table-hover" style="font-size:12px">
                                                        <thead style="background: rgb(32, 32, 32);color: #fff;">
                                                            <tr>  
                                                                <th colspan="8" style="vertical-align: middle;">COBRANZA</th>
                                                            </tr>
                                                            <tr>  
                                                                <th style="vertical-align: middle;text-align: center; background: #fff; color: rgb(32, 32, 32);">#</th>
                                                                <th style="vertical-align: middle;text-align: center; background: #fff; color: rgb(32, 32, 32);">CÓDIGO</th>
                                                                <th colspan="2" style="vertical-align: middle; background: #fff; color: rgb(32, 32, 32);">CLIENTE</th>
                                                                <th style="vertical-align: middle; text-align: right; background: #fff; color: rgb(32, 32, 32);">MONTO COBRADO</th>
                                                                <th style="vertical-align: middle; text-align: right; background: #fff; color: rgb(32, 32, 32);">MORA</th>
                                                                <th colspan="2" width="20%" style="vertical-align: middle; background: #fff; color: rgb(32, 32, 32);"></th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody>    
                                                            <tr v-for="(midata,index) in list_customer_credit_day" :key="index" >
                                                                <td style="vertical-align: middle;text-align: center;" >{{(index+1)}}</td>
                                                                <td style="vertical-align: middle; text-align: center;" v-text="midata.code"></td>
                                                                <td colspan="2" style="vertical-align: middle;" v-text="midata.customer"></td>  
                                                                <td width="10%" style="vertical-align: middle; text-align: right;" v-text="midata.capital"></td>  
                                                                <td width="10%" style="vertical-align: middle; text-align: right;" v-text="midata.mora"></td>  
                                                                <td colspan="2" width="20%" style="vertical-align: middle; text-align: center;"></td>  
                                                            </tr>                     
                                                        </tbody>
                                                        <thead >
                                                            <tr>
                                                                <th colspan="4" style="vertical-align: middle; text-align: right; background: #fff; color: rgb(32, 32, 32);" >Totales</th>
                                                                <th width="10%" style="vertical-align: middle; text-align: right;" >{{total_capital}}</th>
                                                                <th width="10%" style="vertical-align: middle; text-align: right;" >{{total_mora}}</th> 
                                                                <th colspan="2" width="20%" style="vertical-align: middle; text-align: right;" ></th> 
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6" style="vertical-align: middle; text-align: right; background: #fff; color: rgb(32, 32, 32);" >TOTAL DE COBRANZA</th>
                                                                <th colspan="2" width="20%" style="vertical-align: middle; text-align: right;" >{{total_capital}}</th> 
                                                            </tr>
                                                            <tr>
                                                                <th colspan="6" style="vertical-align: middle; text-align: right; background: #fff; color: rgb(32, 32, 32);" >TOTAL DE MORA</th>
                                                                <th colspan="2" width="20%" style="vertical-align: middle; text-align: right;" >{{total_mora}}</th> 
                                                            </tr>
                                                        </thead>
                                                    </table>                            
                                                </div>
                                                </div>
                                            </div>
                                        </div>
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
                arrayMercado : [],idParent:'',year:'',
                arraySucursal:[],
                list_resumenday : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                
                listado:1,duenio_parcela:'',participante:'',
                //fechas
                fechaInicio: '01/01/2018',
                authUser:1,
                //date_creation: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                date_creation: ''+new Date().getFullYear()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getDate(),
                //date_register: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                options: {
                //format: 'DD/MM/YYYY',
                format: 'YYYY/MM/DD',
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
                id_mercado_edit:'',
                id_sucursal_edit:'',
                filter:1,visible:1, 
                promoter:'',amount_delivered:'',name_branch:'',name_market:'',date_register:'',
                list_summary_day:[],amount_assigned:'',
                list_customer_credit_day:[],total_mora:'', total_capital:'',
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
            
            getLitSucursal(page){
                let me=this;
               //me.listado=0;
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
            getResumenDia(){
                let me=this;               
                if(me.id_mercado_edit==""){
                    alert('SELECIONE SUCURSAL Y MERCADO');

                }else{
                    me.listado=0
                    var url= 'getResumenDayFecha?id='+me.id_mercado_edit+'&date_register='+me.date_creation;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.list_resumenday = respuesta.datax;
                        me.listado=1
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
                
            },
            //getResumenDia
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
            
            operation(id_employee, date_creation, id){
                let me=this;
                me.filter=0;
                me.listado=0;
                // me.limpiar();
                // me. get_branch();
                var url= 'get_summary_day?id_employee='+id_employee +'&date_register='+ me.date_creation +'&id='+ id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.promoter=respuesta.datax[0].promoter;
                    me.name_branch=respuesta.datax[0].name_branch;
                    me.name_market=respuesta.datax[0].name_market;
                    me.amount_delivered=respuesta.datax[0].amount_delivered;
                    me.amount_assigned=respuesta.datax[0].amount_assigned;
                    me.date_register=respuesta.datax[0].date_register;
                    me.list_customer_credit_day=respuesta.dataz;

                    me.total_capital=respuesta.total_cobranza[0].total_capital;
                    me.total_mora=respuesta.total_cobranza[0].total_mora;
                    me.listado=2;
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
                var url= 'getListaResumenDay?page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list_resumenday=respuesta.datax;
                    //me.pagination= respuesta.pagination; 
                    me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });            
            },
            
        },
        mounted() {
            this.getLitSucursal(1);
           this.list_data(1);
            
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

