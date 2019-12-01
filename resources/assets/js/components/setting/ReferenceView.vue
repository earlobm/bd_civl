<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    Referencias</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Referencia</a></li>
                    <li><a href="#">prendas</a></li>
                    <li class="active">Registro</li>
                </ol>
            </section>
            <!--Hola-->
            <div class="box-tools pull-right">
            <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> hola hola-->
            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
            </div>
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
                                                             
                                                                                                                
                                                            <div class="col-md-12 col-sm-12 col-md-12 col-lg-12">
                                                                <div class="btn-group" style="float:right;">
                                                                    <button type="button" @click="guardarReference()" class="btn btn-save">
                                                                        <i class="fa fa-save"></i>&nbsp;Guardar Referencia
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                             <div class="col-md-6">
                                                                <div class="col-md-12">
                                                                    <div v-bind:class="errorInputActivity3">
                                                                                <label for="ap_paterno">Tipo Producto</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-edit"></i></span>
                                                                                    <select  @change="getFamilyProduct($event.target.value)" v-model="id_parent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                        <option selected="selected" value="-1" >Ninguno</option>
                                                                                        <option v-for="datax in arrayTypeProduct" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                    </select>
                                                                                </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div v-bind:class="errorInputActivity3">
                                                                                <label for="ap_paterno">Familia Producto</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-edit"></i></span>
                                                                                    <select   class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                        <option selected="selected" value="-1" >Ninguno</option>
                                                                                        <option v-for="datax in arrayFamilyProduct" :key="datax.id" :value="datax.id">{{ datax.name }},{{ datax.id }}</option>
                                                                                    </select>
                                                                                </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div v-bind:class="errorInputName">
                                                                    <label for="nombres">Nombre:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="name" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div v-bind:class="errorInputMark">
                                                                    <label for="nombres">Marca:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="mark" type="text" class="form-control" placeholder="Marca" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div v-bind:class="errorInputCaracteristic">
                                                                    <label for="nombres">Caracteristica:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="characteristic" type="text" class="form-control" placeholder="Caracteristicas" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputPriceFrom">
                                                                    <label for="nombres">Monto Minimo:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="pricefrom" type="text" class="form-control" placeholder="monto minimo" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputPriceTo">
                                                                    <label for="nombres">Monto Maximo:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="priceto" type="text" class="form-control" placeholder="monto maximo" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
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
                                                                                <th style="vertical-align: middle;">NOMBRE</th>
                                                                                <th style="vertical-align: middle;">MARCA</th>
                                                                                <th style="vertical-align: middle;">CARACTERISTICA</th>
                                                                                <th style="vertical-align: middle;">PRECIO DESDE</th>
                                                                                <th style="vertical-align: middle;">PRECIO HASTA</th>
                                                                                <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                                <tr v-for="(midata,index) in listReference" :key="index" >
                                                                                    <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.mark"></td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.characteristic"></td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.price_from"></td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.price_to"></td>
                                                                                    <td style="vertical-align: middle;text-align: center;"> 
                                                                                        <button type="button" @click="editarReference(midata.id)" class="btn btn-editar btn-sm">
                                                                                            <i class="fa fa-edit"></i>
                                                                                        </button>   
                                                                                        <button title="Eliminar" type="button" @click="eliminarReference(midata.id)" class="btn btn-eliminar btn-sm">
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
                
                arrayZona : [],
                list : [],idParent:'',year:'',
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                
                listado:1,duenio_parcela:'',participante:'',
                //fechas
                fechaInicio: '01/01/2018',
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

                characteristic:'',name:'',id:-1,pricefrom:'',priceto:'',id_parent:-1,mark:'',id_type_dependence:-1,id_dependence:-1,
                errorClase : 0,
                arrayTypeProduct:[],
                arrayFamilyProduct:[],
                listReference:[],
                errors:{},
                errorInputName:'form-group',
                errorInputMark:'form-group',
                errorInputCaracteristic:'form-group',
                errorInputPriceFrom:'form-group',
                errorInputPriceTo:'form-group',
                buscar:'',sex:'',birthdate:'',marital_status:''
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
               
               getTypeProduct(){
                let me=this;  
               //me.listado=0;   
                //dependencia superior
                var url= 'getDependenceParent';
                   axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    // me.list=respuesta.datax;
                     me.arrayTypeProduct=respuesta.datax;
                     //me.pagination= respuesta.pagination; 
                     //me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });

                //para listar las dependencias en la tabla
                //me.listarTabla(1);
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
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.caracteristic="";
                this.errors.name="";
                 this.errors.pricefrom="";
                  this.errors.priceto="";
                  this.errors.mark="";
                //input
                this.errorInputName='form-group has-success';
                this.errorInputCaracteristic='form-group has-success';
                this.errorInputPriceFrom='form-group has-success';
                this.errorInputPriceTo='form-group has-success';
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputName='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.mark) 
                {   this.errors.mark="Ingrese marca";
                    this.errorInputMark='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.characteristic) 
                {   this.errors.characteristic="Ingrese caracteristic";
                    this.errorInputCaracteristic='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.pricefrom) 
                {   this.errors.pricefrom="Precio De";
                    this.errorInputPriceFrom='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.priceto) 
                {   this.errors.priceto="Precio A";
                    this.errorInputPriceTo='form-group has-error';
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
           
            editarReference(id){
                let me=this;
                me.listado=1;
                //me.limpiar();
                var url= 'getEditReference?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id=respuesta.datax[0].id;
                                me.name = respuesta.datax[0].name;
                                me.characteristic = respuesta.datax[0].characteristic;
                                me.mark = respuesta.datax[0].mark;
                                me.pricefrom = respuesta.datax[0].price_from;
                                me.priceto = respuesta.datax[0].price_to;
                                me.id_parent =respuesta.datax[0].id_dependence;
                               // me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
                                me.validarData();
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            guardarReference(){
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
                axios.post('saveReference',{
                    'mark':this.mark,'name':this.name,'characteristic':this.characteristic,
                    'price_from':this.pricefrom,'price_to':this.priceto, 
                    'id': this.id,'id_dependence': this.id_parent,                       
                }).then(function (response) {
                     me.limpiar();
                    me.listado=1; 
                    me.listarReference();
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
            listarReference(){
                let me=this;  
                //me.listado=0;             
                var url= 'getListReference';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listReference=respuesta.datax;
                   // me.listado=2;
                    
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            eliminarReference(id){
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
                    axios.post('delete_Reference',{
                        'id': id

                    }).then(function (response) {
                   me.listado=1;
                    me.listarReference();
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            cobrar(id){
                let me=this;
                me.listado=3;
                 
            },
            agregar(){
                let me=this;
                me.listado=2;
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
               this.errorInputName='form-group';
                this.errorInputCaracteristic='form-group';
                this.errorInputMark='form-group';
                 this.errorInputPriceFrom='form-group';
                  this.errorInputPriceTo='form-group';
                this.errors = {};
                this.errors.name="";
                this.errors.characteristic="";
                this.errors.mark="";
                this.errors.priceto="";
                this.errors.pricefrom="";
                this.id=-1;
                this.id_parent=-1;
            },
            listar(page){
                let me=this;      
                me.listado=0;        
                var url= 'getListCustomer?buscar='+me.buscar+'&page='+page;
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
           this.getTypeProduct();
           this.listarReference();
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

