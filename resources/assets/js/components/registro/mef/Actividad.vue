<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    ACTIVIDADES</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">MEF</a></li>
                    <li class="active">Actividades</li>
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
                                            <template v-if="listado==1">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-7">
                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                            <input type="text" v-model="buscar" @keyup.enter="listar()" class="form-control" placeholder="Buscar por código o nombre..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                            <span class="input-group-btn">
                                                            <button type="submit"  @click="listar()"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>

                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
                                                        <div class="btn-group" style="float:right;margin-left: 10px;">   
                                                            <button type="button" @click="agregar()" class="btn btn-add">
                                                                <i class="fa fa-plus"></i>&nbsp;Agregar actividad
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
                                                                <thead style="background: #90a4ae;color: #fff;">                                                                                 <tr>
                                                                    <tr>   
                                                                        <th style="vertical-align: middle;">#</th>
                                                                        <th style="vertical-align: middle;">CODIGO</th>
                                                                        <th style="vertical-align: middle;">NOMBRE</th>
                                                                        <th style="vertical-align: middle;">SEC. FUNC.</th>
                                                                        <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(midata,index) in listActivity" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.functional_sequence_code"></td>
                                                                        <td style="vertical-align: middle;text-align: center;"> 
                                                                            <button type="button" @click="editar(midata.id_activity)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>                                                                                                                   
                                                                        
                                                                            <button type="button" @click="eliminar(midata.id_activity)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
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
                                                            <button type="button" @click="guardar()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar actividad
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-horizontal" style="margin-top: 15px">
                                                            <div v-bind:class="errorInputActivity" >
                                                                <label  class="col-md-2 control-label">Código</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-barcode"></i></span>
                                                                        <input v-model="code" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.code}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-bind:class="errorInputActivity2" >
                                                                <label  class="col-md-2 control-label">Sec. Func.</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-th-large"></i></span>
                                                                        <input v-model="sec" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.sec}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-bind:class="errorInputActivity3" >
                                                                <label  class="col-md-2 control-label">Nombre</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-calendar-check-o"></i></span>
                                                                        <input v-model="name" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group">
                                                                <label  class="col-md-2 control-label">Programa Presupuesto</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>                                                                        
                                                                        <select v-model="idProgram" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Seleccione</option>
                                                                            <option v-for="program in listProgram" :key="program.id_program" :value="program.id_program">{{ program.name }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            
                                                            <div class="form-group">
                                                                <label  class="col-md-2 control-label">Producto / Proyecto</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-suitcase"></i></span>                                                                        
                                                                        <select v-model="idProduct" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Seleccione</option>
                                                                            <option v-for="product in listProyect" :key="product.id_product" :value="product.id_product">{{ product.name }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">                                                                    
                                                                    <div v-bind:class="errorInputActivity4" >
                                                                        <label  class="col-md-4 control-label">Función</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>                                                                        
                                                                                <input v-model="funcion" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.funcion}}</em>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div v-bind:class="errorInputActivity5" >
                                                                        <label  class="col-md-4 control-label">Grupo Función</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-object-group"></i></span>                                                                        
                                                                                <input v-model="group" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.group}}</em>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                 </div>
                                                                <div class="col-md-6">                                                                   
                                                                    <div v-bind:class="errorInputActivity6" >
                                                                        <label  class="col-md-4 control-label">Div. Funcional</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-i-cursor"></i></span>                                                                        
                                                                                <input v-model="div" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.div}}</em>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                
                                                                    <div v-bind:class="errorInputActivity7" >
                                                                        <label  class="col-md-4 control-label">Finalidad</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-trophy"></i></span>                                                                        
                                                                                <input v-model="fin" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.fin}}</em>
                                                                            </div>
                                                                        </div> 
                                                                    </div> 
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label  class="col-md-2 control-label">Unidad de Medida</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-tags"></i></span>                                                                        
                                                                        <select v-model="idUnit" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Seleccione</option>
                                                                            <option v-for="unid in listUnid" :key="unid.id_unit" :value="unid.id_unit">{{ unid.name }}</option>
                                                                        </select>
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
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                arrayZona : [],listProyect: [],listProgram: [],listUnid:[],
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
                fechaInicio: '01/01/2018',
                authUser:1,
                fechaFin: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                code:'',sec:'',name:'',idProgram:'',idProduct:'',funcion:'',
                group:'',div:'',fin:'',idUnit:'',id_activity:-1,listActivity:[],
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity2:'form-group',
                errorInputActivity3:'form-group',
                errorInputActivity4:'form-group',
                errorInputActivity5:'form-group',
                errorInputActivity6:'form-group',
                errorInputActivity7:'form-group',
                buscar:'',
                
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
                this.errors.sec="";
                this.errors.funcion="";
                this.errors.group="";
                this.errors.div="";
                this.errors.fin="";

                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                this.errorInputActivity5='form-group has-success';
                this.errorInputActivity6='form-group has-success';
                this.errorInputActivity7='form-group has-success';

                if (!this.code) 
                {   this.errors.code="Ingrese codigo";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.sec) 
                {   this.errors.sec="Ingrese Sec. Func";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese Nombre";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.funcion) 
                {   this.errors.funcion="Ingrese Funcion";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.group) 
                {   this.errors.group="Ingrese Grupo Funcion";
                    this.errorInputActivity5='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.div) 
                {   this.errors.div="Ingrese Div Funcional";
                    this.errorInputActivity6='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.fin) 
                {   this.errors.fin="Ingrese Finalidad";
                    this.errorInputActivity7='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },
            paginaActual(){
                this.listado=1;
            },
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
                //me.listar();
            },
            cambiarPagina(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.listar(page,identrendor,idZona,empresa,estado, fechaInicio, fechaFin);
                
            },
           
            editar(id){
                let me=this;
                me.listado=2;
                me.limpiar();
                var url= 'get_proyect';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProyect=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_program';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                
                var url= 'get_unit';
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.listUnid=respuesta.datax;
                    
				}) 
				.catch(function (error) {
				console.log(error);
                }); 
                
                // this.nombre= '';
                var url= 'get_activity?id_activity='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.name=respuesta.datax[0].name;
                    me.code=respuesta.datax[0].code;
                    me.sec=respuesta.datax[0].functional_sequence_code;
                    me.idProgram=respuesta.datax[0].id_budget_program;
                    me.idProduct=respuesta.datax[0].id_budget_product;
                    me.funcion=respuesta.datax[0].function;
                    me.group=respuesta.datax[0].functional_group;
                    me.div=respuesta.datax[0].functional_division;
                    me.fin=respuesta.datax[0].goal;
                    me.idUnit=respuesta.datax[0].id_uom;
                    me.id_activity=respuesta.datax[0].id_activity;    
                                    
				}) 
				.catch(function (error) {
				console.log(error);
                }); 
               
            },
            guardar(){
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
                axios.post('save_actividadx',{
                    'code':this.code,'name':this.name,             
                    'sec':this.sec,'idProgram':this.idProgram,             
                    'idProduct':this.idProduct,'funcion':this.funcion,             
                    'group':this.group,'div':this.div,             
                    'fin':this.fin,'idUnit':this.idUnit,
                    'id_activity': this.id_activity     
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1; 
                    me.listar();                  
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
            eliminar(id){
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
                axios.post('delete_activity',{
                    'id_activity': id

                }).then(function (response) {
                    me.limpiar();
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
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errorInputActivity3='form-group';
                this.errorInputActivity4='form-group';
                this.errorInputActivity5='form-group';
                this.errorInputActivity6='form-group';
                 this.errorInputActivity7='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.errors.sec="";
                this.errors.funcion="";
                this.errors.group="";
                this.errors.div="";
                this.errors.fin="";
                this.code="";
                this.name="";
                this.sec="";
                this.funcion="";
                this.group="";
                this.div="";
                this.fin="";
                this.idProgram="";
                this.idProduct="";
                this.idUnit="";
                this.id=-1;
            },
            listar(){
                let me=this;              
                var url= 'get_activity?buscar='+me.buscar;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listActivity=respuesta.datax;               
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            descargar(buscar){
                var url= '/download_activity?buscar='+buscar;;
                window.location.href = url;
            },
            agregar(){
                let me=this;
                me.limpiar();
                me.listado=2;

                var url= 'get_proyect';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProyect=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_program';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                
                var url= 'get_unit';
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.listUnid=respuesta.datax;
                    
				}) 
				.catch(function (error) {
				console.log(error);
                }); 
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


