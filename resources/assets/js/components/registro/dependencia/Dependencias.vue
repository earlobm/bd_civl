<template>
<!-- eslint-disable vue/no-use-v-if-with-v-for,vue/no-confusing-v-for-v-if -->
    <main class="main">
        
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    DEPENDENCIA</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-shopping-cart"></i>Acceso a Mercados</a></li>
                    <li><a href="#">PBG</a></li>
                    <li><a href="#">Emergente</a></li>
                    <li class="active">Estado de Plan</li>
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
                                                    <div>                                                  
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-md-1 control-label">Año Operacional:</label>
                                                            <div class="col-md-2">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <date-picker v-model="year"  @dp-change="changeYear" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group" style="margin-bottom: 15px;">
                                                            <input v-model="search" type="text" @keyup.enter="listarTabla(1)" class="form-control" placeholder="Buscar por código o nombre..."  style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                            <span class="input-group-btn">
                                                            <button type="submit" @click="listarTabla(1)"   class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                            </span>
                                                        </div>                                               
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="btn-group" style="float:right;margin-left: 10px;">   
                                                            <button type="button" @click="agregar()" class="btn btn-add">
                                                                <i class="fa fa-plus"></i>&nbsp;Agregar dependencia
                                                            </button>
                                                        </div>
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="importar()" class="btn btn-import">
                                                                <i class="fa fa-upload"></i>&nbsp;Importar
                                                            </button>
                                                            <button type="button" @click="descargar(search)" class="btn btn-download">
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
                                                                        <th style="vertical-align: middle;">CODIGO</th>
                                                                        <th style="vertical-align: middle;">NOMBRE</th>
                                                                        <th style="vertical-align: middle;">TIPO</th>
                                                                        <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    </tr> 
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(midata,index) in arrayDependenceTable" :key="index" >
                                                                        <td style="vertical-align: middle;" >{{(index+1)+((Number(pagination.current_page)-1)*8)}}</td>
                                                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                                                        <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                        <td>
                                                                            <div v-if="midata.type=='Operacional'">
                                                                                <span class="label label-info" style="font-size:11px;">{{midata.type}}</span>
                                                                            </div>
                                                                            <div v-else>
                                                                                <span class="label label-warning" style="font-size:11px;">{{midata.type}}</span>
                                                                            </div>
                                                                        </td>
                                                                        <td style="vertical-align: middle;text-align: center;"> 
                                                                            <button type="button" @click="editar(midata.id_dependency)" class="btn btn-editar btn-sm">
                                                                                <i class="fa fa-pencil"></i>
                                                                            </button>   
                                                                            <button title="Eliminar" type="button" @click="deleteData(midata.id_dependency)" class="btn btn-eliminar btn-sm">
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
                                                            <button type="button" @click="guardar()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar
                                                            </button>
                                                        </div>
                                                    </div>
                                                 </div>
                                                 
                                                 <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-horizontal" style="margin-top: 15px">
                                                            <div>                                                  
                                                                <div class="form-group" style="margin-bottom: 15px;">
                                                                    <label class="col-md-1 control-label">Año Operacional</label>
                                                                    <div class="col-md-2">
                                                                        <div class="input-group">
                                                                            <label class="col-md-1 control-label">{{year}}</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">                                                                    
                                                                <label class="col-md-2 col-lg-1 control-label">Código</label>
                                                                <div class="col-md-3 col-lg-2">
                                                                    <div v-bind:class="errorInputCode" >   
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-barcode"></i></span>
                                                                        <input v-model="code" @keyup="validarData()" class="form-control" style="border-top-right-radius:3px;border-bottom-right-radius:3px"/>
                                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.code}}</em>
                                                                        
                                                                    </div>
                                                                </div>

                                                                <label class="col-md-2 control-label">Dependencia Superior</label>
                                                                <div class="col-md-2">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>
                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Ninguno</option>
                                                                            <option v-for="datax in arrayDependence" :key="datax.id_dependency" :value="datax.id_dependency">{{ datax.name }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 col-lg-3 pull-right">
                                                                    <div class="checkbox">
                                                                        <label class="container">
                                                                            <input type="checkbox" v-model="dependencia_operativa">¿Es una dependencia operativa?
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                        
                                                            <div v-bind:class="errorInputActivity1" >
                                                                <label  class="col-md-1 control-label">Nombre</label>
                                                                <div class="col-md-11">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-sitemap"></i></span>
                                                                        <input v-model="name" @keyup="validarData()" class="form-control" style="border-top-right-radius:3px;border-bottom-right-radius:3px" />
                                                                        <em class="has-error text-danger" style="display: inline;">{{errors.name}}</em>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                            <div class="form-group">
                                                                <label class="control-label col-md-1 col-lg-1">Metas presup.</label>
                                                                    <div  class="col-md-11 col-lg-11">
                                                                        <div v-bind:class="errorComboMeta">
                                                                            <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-trophy"></i></span>
                                                                                <select id="se" v-model="claseActivity" class="form-control select2">
                                                                                    <option selected="selected" value="">Agregue una Meta</option>
                                                                                    <option v-for="datax in arrayActivity" :key="datax.id_activity" :value="datax">{{ datax.name }}</option>
                                                                                </select>
                                                                                <span class="input-group-btn">
                                                                                    <button type="submit" @click="addActivity(claseActivity)"  class="btn btn-mostrar btn-flat" style="border-top-right-radius:3px;border-bottom-right-radius:3px"><i class="fa fa-plus"></i></button>
                                                                                </span>
                                                                        </div>
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <table id="inbox-table" class="table table-hover table-striped table-forum">
                                                                                        <tbody>
                                                                                             <tr v-for="(midata,index) in listActivitySave" :key="index" >

                                                                                                 <td class="text-center" style="width: 40px;"><i class="fa fa-tasks fa-2x text-muted"></i></td>
                                                                                                <td>
                                                                                                    <h4>
                                                                                                        <a href="javascript:void(0)">
                                                                                                            {{midata.name}} - {{midata.functional_sequence_code}}
                                                                                                        </a>
                                                                                                        <small>{{midata.code}}</small>
                                                                                                    </h4>
                                                                                                </td>
                                                                                                <td class="text-center" style="width: 40px;"><a href="javascript:void(0)" class="ui-commandlink ui-widget btn btn-xs btn-danger" v-on:click="deleteActivity(midata)" >
                                                                                                        <i class="fa fa-times"></i></a>
                                                                                                </td>

                                                                                            </tr> 
                                                                                            
                                                                                        </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </div>  
                                                           <!-- <div class="form-group">
                                                                <label  class="col-md-2 control-label">Unidadx</label>
                                                                 <div class="col-md-10">
                                                                    <model-select :options="optionsx"
                                                                    v-model="item"  style="font-size: 1.1rem;"
                                                                    placeholder="select item">
                                                                    </model-select>
                                                                 </div> 
                                                            </div>-->     
                                                        </div> 
                                                    </div>  
                                                </div>
                                            <transition name="slide-fade">
                                                 <div class="row" v-if="dependencia_operativa">
                                                <div class="col-xs-12">
                                                <div class="box">
                                                    <div class="box-header">
                                                    <h3 class="box-title">Techo Presupuestal 2019</h3>

                                                    <div class="box-tools">
                                                        <div class="input-group input-group-sm" style="width: 150px;">

                                                        <div class="input-group-btn">
                                                            <button v-if="verselectfuente" class="btn bg-color-teal txt-color-white btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                AGREGAR FTE <span class="fa fa-plus"></span>
                                                            </button>
                                                            <ul v-if="verselectfuente" class="dropdown-menu" >
                                                                <li v-for="(item,index) in arrayFunding" :key="index" v-show="!listFundingVisible[index].check" >
                                                                    <a href="javascript:void(0)" @click="mostrar_colum(listFundingVisible[index].id,1)">
                                                                            {{item.code}} - {{item.name}}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <!-- /.box-header -->
                                                    <div  class="box-body table-responsive no-padding">
                                                        <table class="table table-condensed table-bordered" cellspacing="0" cellpadding="0" style="  margin-bottom: 0px;">
                                                            <thead>
                                                                <tr style="border:none">
                                                                    <th style="background: #FFFFFF;border: none"></th>
                                                                        <th v-for="(item,index) in arrayFunding" :key="index" v-show="listFundingVisible[index].check"  style="background: #FFFFFF;border: none">{{item.code}}-{{item.name}}
                                                                            <a href="javascript:void(0)" class="ui-commandlink ui-widget btn btn-xs btn-default pull-right" @click="mostrar_colum(listFundingVisible[index].id,2)">
                                                                                <i class="fa fa-times font-xs text-muted" style="font-size: 8px"></i></a>
                                                                        </th>
                                                                    <th v-if="ver_fuente" style="background: #FFFFFF;border: none"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <tr v-for="(itemx,indexx) in arrayClassifier" :key="indexx">
                                                                        <td class="font-xs" data-y="header-0" style="vertical-align: middle; padding: 0px 10px !important; background: rgb(255, 255, 255);"><strong>{{itemx.code}}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{itemx.name}}</td>
                                                                        
                                                                        <td v-for="(item,index) in listFundingVisible" :key="index" v-show="listFundingVisible[index].check"  class="text-center" style="padding: 0px !important;border: none !important;">
                                                                            <input type="text" @keyup="sumar()" v-model="arrayValues[indexx][index]" class="form-control input-xs text-right" style="vertical-align: middle" data-x="0" data-y="0" placeholder="-">
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                    <td v-if="ver_fuente"  class="font-xs text-center"  style="vertical-align: middle">
                                                                            <h3 class="text-muted"> NO SE HA AGREGADO FTES DE FINANCIAMIENTO</h3>
                                                                    </td>
                                                            </tbody>
                                                                <tfoot>
                                                                    <tr v-if="!ver_fuente" >
                                                                        <td class="font-xs text-center"><strong>TOTAL</strong></td>
                                                                        <td v-for="(item,index) in arrayFunding" :key="index" v-show="listFundingVisible[index].check"  class="text-right font-xs" style="padding: 2px 10px !important;font-weight: bold">
                                                                            <label  class="control-label">S/. {{arrayValuesTotal[0][index]}}</label>
                                                                        </td>
                                                                        
                                                                    </tr>
                                                                </tfoot>
                                                        </table>
                                                    </div>

                                                     
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                                </div>
                                            </div>
                                            </transition>

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
    import { ModelSelect } from 'vue-search-select'
    export default {
      
        props : ['idanio'],
        data (){
            return {
               listado:1,estado:'',
                ver_fuente:true,dependencia_operativa:false,
                year: ''+ new Date().getFullYear(),
                fechaInicio: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                options: {
                format: 'YYYY',
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
                code:'',name :'',id:-1, 
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity1:'form-group', 
                errorComboMeta:'input-group input-group-md', 
                errorInputCode:'input-group input-group-md',
                list_strategic_activity:[], 
                idParent:'',arrayDependence:[],
                idActivity:'',arrayActivity:[],
                claseActivity:'',
                listActivitySave:[],
                arrayFunding:[],
                optionsx: [
                { text: 'One', id: 'A' },
                { text: 'Two', id: 'B' },
                { text: 'Three', id: 'C' }
                ],
                item: {
                value: '',
                text: ''
                },
                listFundingVisible:[],
                verselectfuente:true,
                arrayClassifier:[],
                arrayValues:[],
                arrayValuesTotal:[],
                arrayDependenceTable:[],
                listTech:[],
                search:''
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
       created: function(){
            this.init();
        },
        components: {
        ModelSelect, datePicker,moment
        },
        methods : { 
            changeYear(){
                this.listarTabla(1);
            },
            deleteActivity : function (item) {
                this.arrayActivity.push(item);
                let index = this.listActivitySave.indexOf(item)
                this.listActivitySave.splice(index, 1);
            },
            sumar(){
                var totalx=this.arrayFunding.length;
                var limit=0;
                //llenar si tiene datos
                while(limit<totalx){
                    var sum=0;
                    for(var i=0;i<this.arrayValues.length;i++) 
                    {
                        sum=sum+Number(this.arrayValues[i][limit]);
                    }
                    this.arrayValuesTotal[0][limit]=Number(sum);
                    limit=limit+1; 
                } 

            },
            addActivity(val){
                this.validarActivity();
                if(val==""){
                   // alert("Seleccione Meta");
                    return;
                }
                this.listActivitySave.push(val);
                let index = this.arrayActivity.indexOf(val)
                this.arrayActivity.splice(index, 1);
                this.claseActivity='';
            },
            mostrar_colum(val,tipo){
              let me=this;
              if(tipo==1){
                for(var i=0; i < me.listFundingVisible.length; i++){
                        if(me.listFundingVisible[i].id==val){
                            me.listFundingVisible[i].check=true;                  
                        }
                    }
                    this.ver_fuente=false;
                //comprobar si ya estaas agregados todos
                var total=me.listFundingVisible.length;
                var sum=0;
                for(var i=0; i < me.listFundingVisible.length; i++){
                        if(me.listFundingVisible[i].check){
                            sum= Number(sum)+1;           
                        }
                    }
                    if(sum==total)
                    {
                        me.verselectfuente=false;
                    }
              }
              if(tipo==2){
                for(var i=0; i < me.listFundingVisible.length; i++){
                        if(me.listFundingVisible[i].id==val){
                            me.listFundingVisible[i].check=false;                  
                        }
                    }
                //comprobar si todos son falsos como tu :v
                var estado=true;
                for(var i=0; i < me.listFundingVisible.length; i++){
                        if(me.listFundingVisible[i].check){
                            estado=false;                
                        }
                    }
                if(estado)
                this.ver_fuente=true; 
                //comprobar si ya estaas agregados todos
                me.verselectfuente=true;
              }
            },
            validarActivity(){
                this.errors = {};
                this.errorClase=0;
                //input
                this.errorComboMeta='input-group input-group-md has-success';
                if (!this.claseActivity) 
                {   
                    this.errorComboMeta='input-group input-group-md has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.code="";
                this.errors.name="";
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity1='form-group has-success';
                this.errorInputCode='input-group input-group-md has-success';

                if (!this.code) 
                {   this.errors.code="Ingrese codigo";
                    this.errorInputActivity='form-group has-error';
                    this.errorInputCode='input-group input-group-md has-error',
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity1='form-group has-error';
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
				me.listarTabla(page);
            },
           
            editar(id){
                let me=this;
                me.listado=2;
                var url= 'getEditDependency?id='+id;
				axios.get(url).then(function (response) {
                     for(var i=0; i < me.listFundingVisible.length; i++){
                            me.listFundingVisible[i].check=false;  
                     }
                     me.verselectfuente=true;
                    var respuesta= response.data;
                   // me.listActivitySave=respuesta.datax;
                    me.listActivitySave=respuesta.listActivity;
                    me.arrayActivity=respuesta.listActivityCombo;
                    
                    me.code=respuesta.datax[0].code;
                    me.name=respuesta.datax[0].name;
                    me.id=respuesta.datax[0].id_dependency;
                    me.year=""+respuesta.datax[0].operation_year;
                    me.idParent=respuesta.datax[0].id_parent;
                    me.dependencia_operativa=respuesta.datax[0].type=='Operacional'?true:false;
                    //editar las funetes financieras
                    var listFundingx=respuesta.listFunding;
                     for(var i=0; i < listFundingx.length; i++){
                         me.mostrar_colum(listFundingx[i].id_funding_source,1);
                    }
                    me.listTech=respuesta.listTech;
                    me.clean_tech();
                            for(var i=0;i<me.arrayValues.length;i++) 
                            {
                                var cant=me.arrayValues[i];
                                 var osize = 0, key;
                                for (key in cant) {
                                    if (cant.hasOwnProperty(key)) osize++;
                                }
                                osize=osize-1;

                                for (var j=0;j<osize;j++){
                                     for(var k=0; k< me.listTech.length; k++){
                                         if(me.arrayFunding[j].id_funding==me.listTech[k].id_funding_source&&me.arrayValues[i].id_classifier==me.listTech[k].id_classifier)
                                         {
                                           me.arrayValues[i][j]=Number(me.listTech[k].quantity);     
                                           break;    
                                         }
                                      }
                                }
                            }
                    me.sumar();
				}) 
				.catch(function (error) {
				console.log(error);
                });
                  
            },
            deleteData(id){
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
                axios.post('delete_dependency',{
                    'id': id
                }).then(function (response) {
                    me.limpiar();
                   me.listado=1;
                   me.listarTabla(1);
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
            agregar(){
                let me=this;
                me.listActivitySave=[];
                me.clean_tech();
                me.sumar();
                me.limpiar();
                var url= 'get_activity';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     for(var i=0; i < me.listFundingVisible.length; i++){
                            me.listFundingVisible[i].check=false;  
                     }
                     me.verselectfuente=true;
                     me.dependencia_operativa=false;
                    me.arrayActivity=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });

                me.listado=2;
            },
            
            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
            },
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity1='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.name="";
                this.code="";
                this.id=-1;
            },
            clean_tech(){
                let me=this;
                 for(var i=0;i<me.arrayValues.length;i++) 
                            {
                                var cant=me.arrayValues[i];
                                 var osize = 0, key;
                                for (key in cant) {
                                    if (cant.hasOwnProperty(key)) osize++;
                                }
                                osize=osize-1;
                                for (var j=0;j<osize;j++){
                                    me.arrayValues[i][j]=0;  
                                }
                            }
            },
            guardar(){
                if (this.validarData()){
                    return;
                }
                swal({
                title: 'Esta seguro de guardar la información?',
                type: 'warning',
                showCancelButton: true,confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                let me = this;
                axios.post('saveDependencyParent',{
                    'code':this.code,'name':this.name,
                    'id': this.id,'listActivitySave':this.listActivitySave,
                    'year':this.year,'idParent':this.idParent,
                    'dependencia_operativa':this.dependencia_operativa,
                    'listFundingVisible':this.listFundingVisible,
                    'arrayValues':this.arrayValues
                    
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1;
                    me.listarTabla(1);
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
                ) {}
                })
            },
            listarTabla(page){
                let me=this;
                me.listado=0;
                var url= 'getDependencyList?data='+this.search +'&year='+this.year+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.arrayDependenceTable=respuesta.datax;
                        me.pagination= respuesta.pagination; 
                        me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            listar(page){
               let me=this;       
                //dependencia superior
                var url= 'getDependencyParent';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.arrayDependence=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                 url= 'get_funding';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.arrayFunding=respuesta.datax;
                        //
                        //obtenniendo los clasificadores
                            url= 'getClassifierDependency';
                            axios.get(url).then(function (response) {
                                var respuesta= response.data;
                                me.arrayClassifier=respuesta.datax;
                                me.arrayValuesTotal.push({id:-1});
                                for (var j =0;j<me.arrayFunding.length;j++){
                                        me.$set(me.arrayValuesTotal[0], j, 0); 
                                    }

                                for (var i =0;i<me.arrayClassifier.length;i++){
                                    me.arrayValues.push({id_classifier:me.arrayClassifier[i].id_classifier});
                                    for (var j =0;j<me.arrayFunding.length;j++){
                                        me.$set(me.arrayValues[i], j, 0); 
                                    }
                                }
                            })
                            .catch(function (error) {
                                console.log(error);
                            });

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                //para listar las dependencias en la tabla
                me.listarTabla(1);
            },
            init: function() {
            //cargar actividades
                let me=this;  
                me.listFundingVisible=[];        
                var url= 'get_funding';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var lista=respuesta.datax;
                    for(var i=0; i < lista.length; i++){
                       me.listFundingVisible.push({check:false,id: lista[i].id_funding,monto:0});
                    }
                   
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
.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all .5s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active for <2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>
