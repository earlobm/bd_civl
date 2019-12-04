<template>
    <main class="main">
        <section class="content-header">
            <h1>Ingresos
              <small>Ganancias</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li><a href="#"> Caja</a></li>
              <li class="active">Ingresos</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <!-- Edicion -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">                            
                            <h1 class="box-title"><i class="fa fa-edit"></i> Agregar Ingreso                                
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
                                                                <div class="col-md-4">
                                                                    <div v-bind:class="errordescription">
                                                                        <label for="nombres">Descripción:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                            <input  v-model="description" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div v-bind:class="erroramount">
                                                                        <label for="nombres">Monto:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                            <input  v-model="amount" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="estado_civil">Tipo de Ingreso:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-magic"></i></span>
                                                                            <select  @change="getComboIncome($event.target.value)" v-model="id_type_income" class="form-control select2">
                                                                                <option selected="selected" value="" >Seleccione</option>
                                                                                <option v-for="datax in array_income" :key="datax.id" :value="datax.id">{{ datax.names }}</option>
                                                                            </select>
                                                                            <span class="input-group-btn">
                                                                                <button data-toggle="tooltip" title="Agregar nuevo Tipo de Ingreso" type="submit" @click="add_type_income()" class="btn btn-add btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-plus"></i> AGREGAR</button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="edad">Fecha:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar "></i></span>
                                                                            <date-picker v-model="birthdate" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>                                                                               
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="estado_civil">Mercado:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-sitemap"></i></span>
                                                                            <select v-model="market" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <option selected="selected" value="" >Seleccione</option>
                                                                                <option v-for="market in array_market" :key="market.id" :value="market.id">{{market.name}}</option>
                                                                            </select>
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
                            <div class="btn-group" style="float:right">
                                <button type="button" @click="save_data()" class="btn btn-save">
                                    <i class="fa fa-save"></i>&nbsp;GUARDAR INGRESO DIVERSO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lista -->
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title">Lista de Ingresos</h1>
                            <div class="box-tools pull-right">
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
                                        <input type="text" v-model="buscar" @keyup.enter="list_data(buscar)" class="form-control" placeholder="Buscar por código o nombre..."  style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                        <span class="input-group-btn">
                                        <button type="submit" @click="list_data(buscar)" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                        </span>
                                    </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   <tr>
                                        <tr>  
                                            <th style="vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle;">NOMBRE</th>
                                            <th style="vertical-align: middle;">DESCRIPCION</th>
                                            <th style="vertical-align: middle;">MONTO</th>
                                            <th style="vertical-align: middle;">FECHA</th>
                                            <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in listIncome" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.names"></td>
                                            <td style="vertical-align: middle;" v-text="midata.description"></td>
                                            <td style="vertical-align: middle;" v-text="midata.amount"></td>
                                            <td style="vertical-align: middle;" v-text="midata.date"></td>
                                            <td style="vertical-align: middle;text-align: center;"> 
                                                <button type="button" @click="edit_data(midata.id)" class="btn btn-editar btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </button>   
                                                <button title="Eliminar" type="button" @click="eliminarIncome(midata.id)" class="btn btn-eliminar btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>                                      
                                            </td> 
                                        </tr>                       
                                    </tbody>
                                </table>
                            </div>
                            <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) - 1,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)">Ant</a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) + 1,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)">Sig</a>
                                        </li>
                                    </ul>                        
                                </nav>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
		</section>

        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal_add}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #012D74;">
                        <button type="button" class="close" @click="close_modal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-plus"></i> Agregar Tipo de Ingreso</h4>
                    </div>

                    <div class="modal-body">  
                        <div class="row">    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <div class="box-body">                                     
                                    <div class="row">
                                        
                                    <div class="col-md-6">
                                        <div v-bind:class="errornames">
                                            <label for="nombres">Nombre:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                <input  v-model="names" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div v-bind:class="errorcode">
                                            <label for="nombres">Codigo:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                <input  v-model="code" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- <div class="row">  
                                        <div class="col-md-12">
                                            <div class="box-body table-responsive no-padding">
                                                <table  class="table table-hover" style="font-size:12px">
                                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   <tr>
                                                        <tr>  
                                                            <th style="vertical-align: middle;">#</th>
                                                            <th style="vertical-align: middle;">NOMBRE</th>
                                                            <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                        </tr> 
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(midata,index) in listTypeIncome" :key="index" >
                                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                            <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                            <td style="vertical-align: middle;text-align: center;"> 
                                                                <button type="button" @click="edit_type_income(midata.id)" class="btn btn-editar btn-sm">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>   
                                                                <button title="Eliminar" type="button" @click="eliminarTypeIncome(midata.id)" class="btn btn-eliminar btn-sm">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>                                      
                                                            </td> 
                                                        </tr>                       
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                                <nav>
                                                    <ul class="pagination">
                                                        <li class="page-item" v-if="pagination.current_page > 1">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) - 1,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)">Ant</a>
                                                        </li>
                                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)" v-text="page"></a>
                                                        </li>
                                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(Number(pagination.current_page) + 1,identrendor,idZona,empresa,estado, fechaInicio, fechaFin)">Sig</a>
                                                        </li>
                                                    </ul>                        
                                                </nav>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="close_modal(1)"><i class="fa fa-times"></i> CERRAR</button>
                        <button type="button" @click="guardarTypeIncome()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;GUARDAR TIPO DE INGRESO</button>                        
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

    export default {
        data (){
            return {
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                array_market : [], modal_add:0, market:'',
                listStrategicPlan:[],
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                listado:1,duenio_parcela:'',participante:'',
                id_asesor_edit:'',localidad_edit:'',denominacion_edit:'',
                dni_dirigente_edit:'',dirigente_edit:'',
                comentario_edit:'',id_asesoramiento:'',id_pbg:'',estado_as:'',
                estado_plan:'', estado:'',
                //fechas
                
                authUser:1,
                year: ''+ new Date().getFullYear(),
                options: {
                format: 'DD/MM/YYYY',
                useCurrent: false,
                 locale: 'es',
                 showClose: true,
                },
                fechaRegistro:'',verzona:false,puede_editar:false,verentrenador:false,
                pagination : {
					'total' : 0,
					'current_page' : 0,
					'per_page' : 0,
					'last_page' : 0,
					'from' : 0,
					'to' : 0,
                },offset: 3, 
                 datosmapa:'',markers:[],modal:0,
                center: { lat: 45.508, lng: -73.587 },  
                name_type_income:'',id:-1,description:'',amount:'',TypeIncome:'',id_type_income:'',birthdate:'',
                names:'',id:-1,code:'',category:'INGRESO',
                errorClase : 0,
                errors:{},
                //listIncome
                listIncome :[],  
                array_income:[],
                listTypeIncome:[],
                errorInputname_type_income:'form-group',
                errordescription:'form-group',
                erroramount:'form-group',
                buscar:'',
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
            listMarket(){
                let me=this;              
                var url= 'get_combo_market';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_market=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            close_modal(){
                let me= this;
                me.modal_add=0;
            },
            getComboIncome(page){
                let me=this; 
                //me.listado=0;             
                var url= 'comboTypeIncome_list?page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_income=respuesta.datax;                   
                   
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },
            validarDataTypeIncome(){
                this.errors = {};
                this.errorClase=0;
                this.errors.name_type_income="";
                //input
                this.errorInputname_type_income='form-group has-success';
                if (!this.name_type_income) 
                {   this.errors.name_type_income="Ingrese nombre";
                    this.errorInputname_type_income='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            }, 
            validarDataIncome(){
                this.errors = {};
                this.errorClase=0;
                this.errors.description="";
                this.errors.amount="";
                //input
                this.errordescription='form-group has-success';
                this.erroramount='form-group has-success';
                if (!this.description) 
                {   this.errors.description="Ingrese descripcion";
                    this.errordescription='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.amount) 
                {   this.errors.amount="Ingrese monto";
                    this.erroramount='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },

            paginaActual(){
                this.listado=1;
            },
            
            cambiarPagina(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				//me.listar(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin);
                
            },
           
            edit_type_income(id){
                let me=this;
                //me.listado=2;
                me.limpiarTypeIncome();
                // this.nombre= '';
                var url= 'getEditIncomeType?id='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.name_type_income=respuesta.datax[0].name;
                    me.id=respuesta.datax[0].id;
                    
				}) 
				.catch(function (error) {
				console.log(error);
                });
               //return;
               
            },
            edit_data(id){
                let me=this;
                me.listado=1;
                //me.limpiar();
                // this.nombre= '';                
                var url= 'getEditIncome?id='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    //me.name=respuesta.datax[0].name;
                    me.description=respuesta.datax[0].description;
                    me.amount=respuesta.datax[0].amount;
                    me.id=respuesta.datax[0].id;
                    me.birthdate=moment(respuesta.datax[0].date).toDate();
                    me.id_type_income=respuesta.datax[0].account_book_id;
                    me.market=respuesta.datax[0].id_market;
				}) 
				.catch(function (error) {
				console.log(error);
                });
               //return;
               
            },
            guardarTypeIncome(){
                
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
                    axios.post('saveIncomeType',{
                        'names':this.names,
                    'code':this.code,
                    'category':this.category,
                    'id': this.id
                        
                    }).then(function (response) {
                        me.limpiarTypeIncome();
                        
                        me.getComboIncome();
                        swal(
                            '¡Guardado!',
                            'El registro ha sido guardado con éxito.',
                            'success'
                            );
                        me.close_modal(1);
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
            save_data(){
                if (this.validarDataIncome()){
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
                axios.post('saveIncome',{
                    //'name':this.name,
                    'description':this.description,
                    'amount':this.amount,
                    'date':moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                    'account_book_id': this.id_type_income,
                    'id_market': this.market,
                    'id': this.id
                    
                }).then(function (response) {
                   me.limpiarIncome();
                    me.list_data(me.buscar);
                    //me.limpiar();
                    //me.listado=1;
                  //me.listar(me.year, me.buscar);
                 // me.listar(1,me.micohort);
                  
                    swal(
                        '¡Actualizado!',
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

            eliminarTypeIncome(id){
                swal({
                title: '¿Esta seguro de eliminar este asistente?',
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
                axios.post('delete_IncomeType',{
                    'id': id

                }).then(function (response) {
                    me.limpiarTypeIncome();
                   me.listado=2;
                   
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
            
            eliminarIncome(id_type_income){
                swal({
                title: '¿Esta seguro de eliminar este asistente?',
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
                axios.post('delete_Income',{
                    'id': id_type_income

                }).then(function (response) {
                    //me.limpiarIncome();
                   me.listado=1;
                   me.list_data(me.buscar);
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

            descargar(buscar){
                var url= '/download_strategic_plan?buscar='+buscar;;
                window.location.href = url;
            },

            add_type_income(){
                let me=this;
                //me.listado=2;
                me.modal_add=1;
                //listarTypeIncome();
            },
            
            volver(){
                let me=this;
                me.limpiarTypeIncome();
                me.getComboIncome(1);
                me.listado=1;
            },
            limpiarTypeIncome(){
                this.errorInputname_type_income='form-group';
                this.errors = {};
                this.errors.name_type_income=" ";
                this.name_type_income='';
                this.id=-1;
               
            },
            limpiarIncome(){
                this.errordescription='form-group';
                this.erroramount='form-group';
                this.errors = {};
                this.errors.description=" ";
                this.errors.amount=" ";
                this.description=" ";
                this.amount=" ";
                this.id=-1;
                this.market="";
                this.id_type_income="";
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            
            list_data(buscar){
                let me=this;  
                me.listado=0;  
                me.listMarket();           
                var url= 'getListIncome?buscar='+buscar;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listIncome=respuesta.datax;
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
        
            listarTypeIncome(){
                let me=this;  
                //me.listado=0;             
                var url= 'getListIncomeType';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listTypeIncome=respuesta.datax;
                   // me.listado=2;
                    me.limpiarTypeIncome();
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            
           
        },
        mounted() {
           this.list_data(this.buscar);
           this.getComboIncome(1);
           this.listMarket();
           
           //this.get_incomeType();
         }
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }
</style>
