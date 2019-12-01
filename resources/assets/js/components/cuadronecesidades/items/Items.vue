<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    ITEMS</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-cubes"></i>Cuadro de Necesidades</a></li>
                    <li class="active">Items</li>
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
                        <div class="card">                            
                            <div class="card-body">    
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <div class="box-body">
                                            <template v-if="listado==1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-8">
                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                            <input type="text" v-model="buscar" @keyup.enter="listar()" class="form-control" placeholder="Buscar por código o nombre..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                            <span class="input-group-btn">
                                                            <button type="submit" @click="listar()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>

                                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-4">
                                                        <div class="btn-group" style="float:right; margin-left: 10px;">   
                                                            <button type="button" @click="agregar()" class="btn btn-add">
                                                                <i class="fa fa-plus"></i>&nbsp;Agregar item
                                                            </button>
                                                        </div>
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="importar()" class="btn btn-import">
                                                                <i class="fa fa-upload"></i>&nbsp;Importar
                                                            </button>
                                                            
                                                            <button type="button" @click="descargar(buscar)" class="btn btn-download">
                                                                <i class="fa fa-download"></i>&nbsp;Exportar
                                                            </button> 
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box-body table-responsive no-padding">
                                                            <table  class="table table-hover" style="font-size:12px">
                                                                <thead style="background: #90a4ae;color: #fff;">                                                                                   <tr>
                                                                    <tr> 
                                                                        <th style="vertical-align: middle;">#</th>
                                                                        <th style="vertical-align: middle;">CLASIFICADOR</th>
                                                                        <th style="vertical-align: middle;">CÓDIGO</th>
                                                                        <th style="vertical-align: middle;">NOMBRE</th>
                                                                        <th style="vertical-align: middle;">PRECIO</th>
                                                                        <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(midata,index) in listItem" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code_classifier"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.price"></td>
                                                                        <td style="vertical-align: middle;text-align: center;"> 
                                                                            <button type="button" @click="edit_item(midata.id)" class="btn btn-editar btn-sm">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>    
                                                                            <button title="Eliminar" type="button" @click="delete_item(midata.id)" class="btn btn-eliminar btn-sm">
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
                                                </div>
                                            </template> 
                                            <template v-if="listado==2">
                                                <div class="row">                                                    
                                                    <div class="col-md-12">
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="volver()" class="btn btn-danger">
                                                                <i class="fa fa-arrow-left"></i>&nbsp;Volver a la lista
                                                            </button>
                                                            <button type="button" @click="save_item()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar item
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-horizontal" style="margin-top: 15px">
                                                            <div class="form-group">
                                                                <label  class="col-md-2 control-label">Genérica de Gasto</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-sitemap"></i></span>
                                                                        <select v-model="id_classifier_parent" class="form-control select2" @change="onChangeType($event.target.value)" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Seleccione</option>
                                                                            <option v-for="classifier_parent in arrayClassifier" :key="classifier_parent.id_classifier" :value="classifier_parent.id_classifier">{{ classifier_parent.classifier_parent }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-md-2 control-label">Tipo de item</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-sliders"></i></span>
                                                                        <select v-model="id_classifier_sub" class="form-control select2" @change="onChangeCode($event.target.value)" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >---</option>
                                                                            <option v-for="classifier_sub in arrayClassifierSub" :key="classifier_sub.id_classifier_sub" :value="classifier_sub.id_classifier_sub">{{ classifier_sub.classifier_sub }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>   

                                                            <div v-bind:class="errorInputActivity" >
                                                                <label  class="col-md-2 control-label">Código</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-barcode"></i></span>
                                                                        <input v-model="correlative" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.code}}</em>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            <div v-bind:class="errorInputActivity1" >
                                                                <label  class="col-md-2 control-label">Nombre</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-list-ul"></i></span>
                                                                        <input v-model="name" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div v-bind:class="errorInputActivity2" >
                                                                        <label  class="col-md-4 control-label">Precio</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-dollar"></i></span>
                                                                                <input v-model="price" @keyup="validarData()" class="form-control" placeholder="0" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.precio}}</em>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">                                                                    
                                                                    <div v-bind:class="errorInputActivity3" >
                                                                        <label  class="col-md-4 control-label">Unidad</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-chain"></i></span>
                                                                                <input v-model="uom" @keyup="validarData()" class="form-control" placeholder="ingrese unidad" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.unidad}}</em>
                                                                            </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
</template>

<script>
    //fecha bot
    export default {
        data (){
            return {
                listItem : [], arrayClassifierSub: [], arrayClassifier: [],
                buscar:'',
                id_classifier_parent:'', id_classifier_sub:'',
                correlative:'', name:'', price:'', uom:'', id:-1,
                arrayCodeCorrelative: [], arrayCodeCorrelativex: [],

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
                authUser:1,
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
                code:'',name :'',id:-1,
                precio:'',unidad:'',
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity1:'form-group',  
                errorInputActivity2:'form-group',
                errorInputActivity3:'form-group',
            }
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
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.code="";
                this.errors.name="";
                this.errors.unidad="";
                this.errors.precio="";
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                 this.errorInputActivity3='form-group has-success';

                if (!this.correlative) 
                {   this.errors.code="Ingrese codigo";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.price) 
                {   this.errors.precio="Ingrese precio";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.uom) 
                {   this.errors.unidad="Ingrese unidad";
                    this.errorInputActivity3='form-group has-error';
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
				me.listar(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin);
                
            },
            delete_item(id){
                swal({
                title: '¿Esta seguro de eliminar este Item?',
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
                axios.post('delete_item',{
                    'id': id

                }).then(function (response) {
                   me.listado=1;
                   me.listar();
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
           
            edit_item(id){
                let me=this;
                me.listado=2;
                me.limpiar();
                var  url= 'get_classifier_parent';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayClassifier = respuesta.id_classifier;
                    me.arrayClassifier = respuesta.classifier_parent;
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_classifier_sub_edit';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayClassifierSub = respuesta.classifier_sub_edit;
                })
                .catch(function (error) {
                    console.log(error);
                });

                
                var url= 'get_necessary_item?id='+id;
				axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id_classifier_parent=respuesta.datax[0].id_classifier_parent;
                    me.id_classifier_sub=respuesta.datax[0].id_classifier_sub;
                    me.correlative=respuesta.datax[0].correlative;
                    me.name=respuesta.datax[0].name;
                    me.price=respuesta.datax[0].price;
                    me.uom=respuesta.datax[0].uom;                   
                    
				}) 
				.catch(function (error) {
				console.log(error);
                });
               //return;
               
            },

            agregar(){
                let me=this;
                me.listado=2;

                var  url= 'get_classifier_parent';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayClassifier = respuesta.id_classifier;
                    me.arrayClassifier = respuesta.classifier_parent;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            volver(){
                let me=this;
                me.listado=1;
                me.limpiar();
            },
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity1='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.nomb="";
                this.codig="";
                this.unidad="";
                this.precio="";
                this.id=-1;
            },

            onChangeType(id_classifier_parent){
                let me=this;
                if(me.verentrenador)
                me.identrendor='';
                var url= 'get_classifier_sub?id_classifier=' + id_classifier_parent;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayClassifierSub = respuesta.classifier_sub;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            onChangeCode(id_classifier_sub){
                let me=this;
                var url= 'get_code_correlative?id_classifier=' + id_classifier_sub;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCodeCorrelative=respuesta.datax;
                    me.arrayCodeCorrelativex=respuesta.datay;
                    me.correlative=respuesta.datax[0].code+respuesta.datay[0].code_item;
                    console.log(code);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
        
            listar(){
                let me=this;              
                var url= 'get_item?buscar='+me.buscar;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listItem=respuesta.datax;              
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },

            save_item(){
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
                axios.post('save_necessary_item',{
                    'id':this.id,
                    'id_classifier_parent':this.id_classifier_parent,
                    'id_classifier_sub':this.id_classifier_sub,
                    'correlative':this.correlative,
                    'name':this.name,                    
                    'price': this.price,
                    'uom':this.uom
                    
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1;
                  me.listar(me.year, me.buscar);
                 // me.listar(1,me.micohort);
                 // me.listado=1;
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
           
        },
        mounted() {
            this.listar();
           
         }
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }
</style>


