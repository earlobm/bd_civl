<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Sucursales
              <small>Registro</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Administración</a></li>
              <li class="active">Sucursal</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-plus"></i> Gestión de Sucursales
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
                                                                <div class="col-md-6">
                                                                    <div v-bind:class="errorInputActivity1">
                                                                        <label for="ap_paterno">Denominación:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-building"></i></span>
                                                                            <input v-model="name" type="text" class="form-control" placeholder="Denominación de la sucursal" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div v-bind:class="errorInputActivity2">
                                                                        <label for="ap_materno">Dirección:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>
                                                                            <input v-model="address" type="text" class="form-control"  placeholder="Dirección física" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="edad">Inicio de Labores:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar "></i></span>
                                                                        <date-picker v-model="date_init" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div v-bind:class="errorInputActivity3">
                                                                        <label for="celular">Teléfono / Celular:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-mobile-phone"></i></span>
                                                                        <input placeholder="Teléfono o celular" v-model="phone" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div v-bind:class="errorInputActivity4">
                                                                        <label for="celular">Información Adicional:</label>
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-edit"></i></span>
                                                                        <textarea placeholder="Ingrese información adicional que cree necesario recordar." v-model="notes" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"></textarea> 
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
                            <button type="button" @click="save_data()" class="btn btn-save" style="float:right; margin-right: 10px;">
                                <i class="fa fa-save"></i>&nbsp;GUARDAR
                            </button>
                            <button type="button" @click="volver()" class="btn btn-danger" style="float:right; margin-right: 10px;">
                                <i class="fa fa-close "></i>&nbsp;CANCELAR
                            </button>                            
                        </div> 
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes
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
                        <template v-if="listado==1">
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                        <input type="text"  v-model="search" @keyup.enter="list_data(1)"  class="form-control" placeholder="Buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                        <span class="input-group-btn">
                                            <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                        </span>
                                    </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>
                                            <th style="text-align: center;vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle;">DENOMINACIÓN</th>
                                            <th style="text-align: center;vertical-align: middle;">FECHA DE INICIO</th>
                                            <th style="vertical-align: middle;">DIRECCIÓN</th>
                                            <th style="text-align: center;vertical-align: middle;">TELF. / CELULAR</th>                                                                                
                                            <th style="text-align: center;vertical-align: middle;">ESTADO</th>                                                                                
                                            <th style="vertical-align: middle;">INFO. ADICIONAL</th>                                                                                
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in array_list" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)+((Number(pagination.current_page)-1)*8)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.name"></td>
                                            <td style="text-align: center;vertical-align: middle;" v-text="midata.date_init"></td>
                                            <td style="vertical-align: middle;" v-text="midata.address"></td>                                                                                
                                            <td style="text-align: center;vertical-align: middle;" v-text="midata.phone"></td>
                                            <td style="text-align: center;vertical-align: middle;" >
                                                <div v-if="midata.state=='1'">
                                                    <span class="label label-success" style="font-size:11px;">ACTIVO</span>
                                                </div>
                                                <div v-else>
                                                    <span class="label label-danger" style="font-size:11px;">INACTIVO</span>
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;" v-text="midata.notes"></td>
                                            <td style="text-align: center; vertical-align: middle;"> 
                                                
                                                <button type="button" @click="editData(midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </button>                                                                                                                   
                                            
                                                <button type="button" @click="delete_data(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
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
                                <div class="col-md-6" style="margin-top: -40px; margin-bottom: -45px;">
                                    <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                        <nav>
                                            <ul class="pagination">
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
                                            </ul>                        
                                        </nav>
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
                
                arrayZona : [],
                array_list : [],idParent:'',year:'',
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                
                listado:1,duenio_parcela:'',participante:'',
                //fechas
                fechaInicio: '01/01/2018',
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
                id:-1,
                name:'', address:'',                 
                //date_init:'', 
                state:'', phone:'',
                notes:'',
                errorClase : 0,
                errors:{},
                errorInputActivity1:'form-group',
                errorInputActivity2:'form-group',
                errorInputActivity3:'form-group',
                errorInputActivity4:'form-group',
                errorInputActivity5:'form-group',
                errorInputActivity6:'form-group',
                errorInputAmount:'form-group',
                errorComboTipoProduco:'form-group',
                errorTotalAmount:'form-group',
                search:'',sex:'',birthdate:'',marital_status:''
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
                                    me.name = respuesta.datax[2];
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.maternal_last_name = respuesta.datax[1];
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
                this.errors.name="";
                this.errors.address="";
                 this.errors.phone="";
                  this.errors.notes="";
                    this.errors.address="";
                    this.errors.amount="";
                    this.errors.totalAmount="";
                //input
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                this.errorInputAmount='form-group has-success';
                this.errorComboTipoProduco='form-group has-success';
                this.errorTotalAmount='form-group has-success';


                if (!this.name) 
                {   this.errors.name="Ingrese DNI";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.address) 
                {   this.errors.address="Ingrese nombre";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.phone) 
                {   this.errors.phone="Ingrese apellido paterno";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.notes) 
                {   this.errors.notes="Ingrese apellido materno";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                
                /*if (!this.amount) 
                {   this.errors.amount="Ingrese monto";
                    this.errorInputAmount='form-group has-error';
                    this.errorClase = 1;
                }*/
               
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
           
            editData(id){
                let me=this;
                me.listado=1;
                me.limpiar();
                var url= 'get_branch_office?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.name = respuesta.datax[0].name;
                    me.address = respuesta.datax[0].address;
                    me.phone = respuesta.datax[0].phone;
                    me.notes =respuesta.datax[0].notes;
                    me.date_init=moment(respuesta.datax[0].date_init).toDate();
                    me.validarData();
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },

            save_data(){
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
                axios.post('save_branch_office',{
                    'name':this.name,
                    'address':this.address,
                    'date_init' : moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                    //'state':this.state,
                    'phone':this.phone,
                    'notes':this.notes,
                    'id':this.id
                    
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
            delete_data(id){
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
                    axios.post('delete_branch_office',{
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
            
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
            },
            
            limpiar(){
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.nro_doc="";
                this.errors.name="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                this.errors.phone="";
                this.errors.address="";
                this.nro_doc="";
                this.name="";
                 this.paternal_last_name="";
                this.maternal_last_name="";
                 this.phone="";
                this.address="";
                this.id=-1;
            },

            list_data(page){
                let me=this;      
                me.listado=0;        
                var url= 'get_list_branch_office?search='+me.search+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.array_list=respuesta.datax;
                     me.pagination= respuesta.pagination; 
                     me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },           
        },
        mounted() {
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

