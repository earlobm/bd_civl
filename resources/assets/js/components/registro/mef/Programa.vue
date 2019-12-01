<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    CLIENTES</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">cliente</a></li>
                    <li class="active">Datos</li>
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
                                                    <div class="col-xs-11 col-sm-4 col-md-5 col-lg-7">
                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                            <input type="text"  v-model="buscar" @keyup.enter="listar()"  class="form-control" placeholder="Buscar por código o nombre..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                            <span class="input-group-btn">
                                                                <button type="submit" @click="listar()"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-7 col-lg-5">
                                                        <div class="btn-group" style="float:right;margin-left: 10px;">   
                                                            <button type="button" @click="agregar()" class="btn btn-add">
                                                                <i class="fa fa-plus"></i>&nbsp;Agregar cliente
                                                            </button>
                                                        </div>
                                                        
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="box-body table-responsive no-padding">
                                                            <table  class="table table-hover" style="font-size:12px">
                                                                <thead style="background: #90a4ae;color: #fff;">                                                                                   
                                                                    <tr>
                                                                        <th style="vertical-align: middle;">#</th>
                                                                        <th style="vertical-align: middle;">DNI</th>
                                                                        <th style="vertical-align: middle;">NOMBRE</th>
                                                                        <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(midata,index) in listProgram" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td style="text-align: center; vertical-align: middle;"> 
                                                                            
                                                                            <button type="button" @click="editar(midata.id_program)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                                                <i class="fa fa-edit"></i>
                                                                            </button>                                                                                                                   
                                                                        
                                                                            <button type="button" @click="eliminar(midata.id_program)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
                                                                                <i class="fa fa-trash"></i>
                                                                            </button>

                                                                            <button type="button" @click="emprendar(midata.id_program)" class="btn btn-emprendar btn-sm" data-toggle="tooltip" title="Emprendar">
                                                                                <i class="fa fa-money"></i>
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
                                                                <i class="fa fa-save"></i>&nbsp;Guardar Cliente
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-horizontal" style="margin-top: 15px">                                                            
                                                            <div v-bind:class="errorInputActivity" >
                                                                <label  class="col-md-2 control-label">DNI</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-barcode"></i></span>
                                                                        <input v-model="code" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.code}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div v-bind:class="errorInputActivity2" >
                                                                <label  class="col-md-2 control-label">Nombre</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="name" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>  

                                                            <div v-bind:class="errorInputActivity3" >
                                                                <label  class="col-md-2 control-label">Apellido P.</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="paterno" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.paterno}}</em>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            <div v-bind:class="errorInputActivity4" >
                                                                <label  class="col-md-2 control-label">Apellido M.</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="materno" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.materno}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div v-bind:class="errorInputActivity5" >
                                                                <label  class="col-md-2 control-label">Telefono</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="telefono" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.telefono}}</em>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div v-bind:class="errorInputActivity6" >
                                                                <label  class="col-md-2 control-label">Direccion</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="direccion" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.direccion}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                        </div> 
                                                    </div>     
                                                </div>
                                            </template>

                                            <template v-if="listado==3">
                                                <div class="row">                                                    
                                                    <div class="col-md-12">
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="volver()" class="btn btn-danger">
                                                                <i class="fa fa-arrow-left"></i>&nbsp;Volver a la lista
                                                            </button>
                                                            <button type="button" @click="guardar()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar Prenda
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                               
                                                <div class="row">                
                                                    <div class="col-md-12">
                                                        <div class="form-horizontal" style="margin-top: 15px"> 
                                                            <div class="form-group"> 
                                                                <div v-bind:class="errorInputAmount" >
                                                                <label  class="col-md-2 col-lg-1 control-label">Monto</label>
                                                                <div class="col-md-3 col-lg-2">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="amount" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.amount}}</em>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2  col-lg-2 pull-right">
                                                                    <div class="checkbox">
                                                                        <label class="container">
                                                                            <input type="checkbox" v-model="dependencia_operativa">Diario
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                                <div class="col-md-2 col-lg-2 pull-right">
                                                                    <div class="checkbox">
                                                                        <label class="container">
                                                                            <input type="checkbox" v-model="dependencia_operativa">Semanal
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                                <div class="col-md-2 col-lg-2 pull-right">
                                                                    <div class="checkbox">
                                                                        <label class="container">
                                                                            <input type="checkbox" v-model="dependencia_operativa">Quincenal
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                                <div class="col-md-2 col-lg-2 pull-right">
                                                                    <div class="checkbox">
                                                                        <label class="container">
                                                                            <input type="checkbox" v-model="dependencia_operativa">Mensual
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                            </div>  
                                                        </div>
                                                        <div class="row">
                                                                                <label class="control-label col-md-1 ">TIPO PRODUCTO.</label>
                                                                                <div  class="col-md-2 ">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>
                                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="" >Ninguno</option>
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                                                    <label class="control-label col-md-1 ">FAMILIA PRODUCTO.</label>
                                                                                <div  class="col-md-2 col-lg-2 ">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>
                                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="" >Ninguno</option>
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                                                    <label class="col-md-1 control-label">Fecha Inicio:</label>
                                                                                    <div class="col-md-2">
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                                <i class="fa fa-calendar"></i>
                                                                                            </div>
                                                                                            <date-picker v-model="year" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                
                                                                                    <label class="col-md-1  control-label">Fecha Fin:</label>
                                                                                    <div class="col-md-2 pull-right">
                                                                                        <div class="input-group">
                                                                                            <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                                <i class="fa fa-calendar"></i>
                                                                                            </div>
                                                                                            <date-picker v-model="year" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                        </div>
                                                    <div class="row">
                                                        <label class="control-label col-md-1 ">Almacen.</label>
                                                                                <div  class="col-md-2 ">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>
                                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="" >Ninguno</option>
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                    </div>                            
                                                            <div v-bind:class="errorInputActivity2" >
                                                                <label  class="col-md-2 control-label">Nombre</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="name" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>  

                                                            <div v-bind:class="errorInputActivity3" >
                                                                <label  class="col-md-2 control-label">Apellido P.</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="paterno" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.paterno}}</em>
                                                                    </div>
                                                                </div>
                                                            </div> 

                                                            <div v-bind:class="errorInputActivity4" >
                                                                <label  class="col-md-2 control-label">Apellido M.</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="materno" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.materno}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div v-bind:class="errorInputActivity5" >
                                                                <label  class="col-md-2 control-label">Telefono</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="telefono" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.telefono}}</em>
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                            <div v-bind:class="errorInputActivity6" >
                                                                <label  class="col-md-2 control-label">Direccion</label>
                                                                <div class="col-md-10">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-puzzle-piece"></i></span>
                                                                        <input v-model="direccion" @keyup="validarData()" class="form-control" rows="1" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.direccion}}</em>
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
    import VueMoment from 'vue-moment';
    import moment from 'moment-timezone';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    export default {
        data (){
            return {
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                arrayZona : [],
                listProgram : [],
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                
                listado:1,duenio_parcela:'',participante:'',
                //fechas
                authUser:1,
                 year: ''+ new Date().getFullYear(),
                options: {
                format: 'YYYY',
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

                amount:'',name:'',id:-1,paterno:'',materno:'',telefono:'',direccion:'',code:'',
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
                buscar:''
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
                 this.errors.paterno="";
                  this.errors.materno="";
                   this.errors.telefono="";
                    this.errors.direccion="";
                    this.errors.amount="";
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                this.errorInputActivity5='form-group has-success';
                this.errorInputActivity6='form-group has-success';
                this.errorInputAmount='form-group has-success';
                this.errorComboTipoProduco='form-group has-success';


                if (!this.code) 
                {   this.errors.code="Ingrese dni";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paterno) 
                {   this.errors.paterno="Ingrese apellido paterno";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.materno) 
                {   this.errors.materno="Ingrese apellido materno";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.telefono) 
                {   this.errors.telefono="Ingrese telefono";
                    this.errorInputActivity5='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.direccion) 
                {   this.errors.direccion="Ingrese direccion";
                    this.errorInputActivity6='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.amount) 
                {   this.errors.amount="Ingrese monto";
                    this.errorInputAmount='form-group has-error';
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
                me.limpiar();
                // this.nombre= '';
                var url= 'get_program?id_program='+id;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.name=respuesta.datax[0].name;
                    me.code=respuesta.datax[0].code;
                    me.paterno=respuesta.datax[0].paterno;
                    me.materno=respuesta.datax[0].materno;
                    me.telefono=respuesta.datax[0].telefono;
                    me.direccion=respuesta.datax[0].direccion;

                    me.id=respuesta.datax[0].id_program;
                    
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
                axios.post('save_program',{
                    'code':this.code,'name':this.name,'paterno':this.paterno,'materno':this.materno,'telefono':this.telefono,'direccion':this.direccion, 
                    'id': this.id                    
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
                axios.post('delete_program',{
                    'id_program': id

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
            emprendar(id){
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
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.errors.paterno="";
                this.errors.materno="";
                this.errors.telefono="";
                this.errors.direccion="";
                this.code="";
                this.name="";
                 this.paterno="";
                this.materno="";
                 this.telefono="";
                this.direccion="";
                this.id=-1;
            },
            listar(){
                let me=this;              
                var url= 'get_program?buscar='+me.buscar;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram=respuesta.datax;
                   
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


