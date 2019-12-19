<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Cobranza Diaria
              <small>Registro de Cobros</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Clientes</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <!-- Lista de Clientes -->
                <div class="col-md-12"  v-if="visible">
                    <div class="box box-primary">
<<<<<<< HEAD
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i>Clientes con préstamos actuales
                            </h1>
                        
                            <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                            <div class="box-tools pull-right">
                                <span class="label label-success">TOTAL DE REGISTROS: {{listCredit.length}}</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                            </div>
                        </div>
=======
>>>>>>> 415d03eae436d9728c4cb358a231349ae9a87bba
                        <template v-if="listado==0">
                            <div align="center">
                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                <!-- <p>Cargando...</p> -->
                            </div>
                        </template>
                        <template v-if="listado==2">
                            <div class="box-body">
                                <div class="box-tools pull-right" style="right: -15px;">
                                    <div class="col-md-12" style="margin-top: 6px;">
                                        <p  class="col-md-8" style="text-align:right"><i class="fa fa-filter"></i> Ver Opciones Avanzadas:</p>
                                        <div class="col-md-4" style="margin-top: -10px;">
                                            <div class="checkbox">
                                                <label class="switch" style="width: 70px; height: 18px;">
                                                    <input type="checkbox" v-model="filter">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div> 
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row" v-if="filter==1">
                                    <div class="col-md-12">
                                        <div class="container-fluid">
                                            <!-- Ejemplo de tabla Listado -->
                                            <div class="card">                            
                                                <div class="card-body">    
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="sexo">Sucursal:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                             
                                                                                <select @change="getMarket($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_branch_office">
                                                                                    <option  value=""  >Todos</option>
                                                                                    <option v-for="miselect in arraySucursal" :selected="miselect.id == id_branch_office" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="sexo">Mercado:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                              
                                                                                <select class="form-control" @change="getEmployee($event.target.value)" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_market_edit">
                                                                                    <option  value="" >Todos</option>
                                                                                    <option v-for="miselect in arrayMercado" :selected="miselect.id == id_market_edit" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="sexo">Promotor:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                              
                                                                                <select class="form-control"  style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_promoter">
                                                                                    <option  value="" >Todos</option>
                                                                                    <option v-for="miselect in arrayEmployee" :selected="miselect.id == id_promoter" :key="miselect.id" :value="miselect.id">{{ miselect.names}} {{ miselect.paternal_last_name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

<<<<<<< HEAD
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="date_register">Fecha:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <date-picker  v-model="date_register" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-10">
                                        <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                            <input type="text"  v-model="search" @keyup.enter="list_data(1)"  class="form-control" placeholder="buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                            <span class="input-group-btn">
                                                <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                            </span>
                                        </div>                                               
                                </div>
                                <div class="col-md-2">
                                        <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                            <span class="input-group-btn">
                                                <button type="submit" @click="downloadDayliCollection(1)"  class="btn btn-block btn-danger" data-toggle="tooltip" title="Descargue en formato PDF" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-file-pdf-o"></i> DESCARGAR</button>
                                            </span>
                                        </div>                                               
                                </div>
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>  
                                            <th style="vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle;">CODIGO</th>
                                            <th style="vertical-align: middle;">N° PRÉSTAMOS</th>
                                            <th style="vertical-align: middle;">NOMBRES</th>
                                            <th style="vertical-align: middle;">F. PRÉSTAMO</th>
                                            <th style="vertical-align: middle;">F. VENCE</th>
                                            <th style="vertical-align: middle;">DIAS X COBRAR</th>
                                            <th style="vertical-align: middle;">MONTO</th>
                                            <th style="vertical-align: middle;">MONTO TOTAL</th>
                                            <th style="vertical-align: middle;">TASA</th>
                                            <th style="vertical-align: middle;">MORA</th>
                                            <th style="vertical-align: middle;">SALDO</th>
                                            <th style="vertical-align: middle;">CUOTA</th>
                                            <th style="vertical-align: middle;">PAGO</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in listCredit" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.code"></td>
                                            <td style="vertical-align: middle;" v-text="midata.nro_prestamo"></td>
                                            <td style="vertical-align: middle;" v-text="midata.nombres"></td>
                                            <td style="vertical-align: middle;" v-text="midata.fecha_prestamo"></td>
                                            <td style="vertical-align: middle;" v-text="midata.fecha_vencimiento"></td>
                                            <td style="vertical-align: middle;" v-text="midata.dias_x_cobrar"></td>
                                            <td style="vertical-align: middle;" v-text="midata.monto"></td>
                                            <td style="vertical-align: middle;" v-text="midata.monto_total"></td>
                                            <td style="vertical-align: middle;" v-text="midata.tasa"></td>
                                            <td style="vertical-align: middle;" >
                                                 <div v-if="midata.mora>0">
                                                    <span class="label label-danger">{{midata.mora}}</span> 
                                                </div>
                                                <div v-else>
                                                    <span >{{midata.mora}}</span> 
                                                </div>
                                            </td>
                                            <td style="vertical-align: middle;" v-text="midata.saldo"></td>
                                            <td style="vertical-align: middle;" v-text="midata.cuota"></td>
                                            <td ><input type="text" style="border: none;border-bottom: 1px solid #ccc;" v-model="midata.pago" placeholder="0.0"></td>

                                        </tr>                       
                                    </tbody>
                                </table> 
                                 <div class="box-footer" >
                                       <div class="btn-group" style="float:right;" >
                                                <button  type="button" @click="save()" class="btn btn-save" data-toggle="tooltip" title="Registrar los pagos">
                                                    <i class="fa fa-save"></i>&nbsp;REGISTRAR
                                                </button>              
                                        </div>
                                </div>  
                                                               
=======
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="date_register">Fecha:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker  v-model="date_register" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group" style="float:right">
                                                                            <label for="date_register" style="visibility:hidden">Fecha:</label>
                                                                            <div class="input-group">
                                                                                <button type="button" @click="list_data(1)" class="btn btn-save" style="float:right; margin-right: 10px;"  data-toggle="tooltip" title="Guardar los pagos">
                                                                                    <i class="fa fa-filter "></i>&nbsp;FILTRAR
                                                                                </button>  
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
>>>>>>> 415d03eae436d9728c4cb358a231349ae9a87bba
                            </div>
                        </template>
                        
                    </div>
                </div>
<<<<<<< HEAD
               

            </div>
            <div class="row">
                <div class="col-md-9">
                Aqui hay tanto contenido que el scrollbar se va hasta China
                </div>
                <div class="col-md-3">
                    <div style="position:fixed;left:79.1%;"> 
                Este debe mantenerse flotando a la derecha de manera fija, asi el scroll llegue al piso.
                    </div>  
                </div>
=======
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i> Lista de Cobranza
                            </h1>
                        
                            <!-- <h1 class="box-title"><i class="fa fa-list"></i> Lista de Clientes</h1> -->
                            <div class="box-tools pull-right">
                                <span class="label label-success">TOTAL DE REGISTROS: {{pagination.total}}</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                            </div>
                        </div>
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
                                        <th style="vertical-align: middle;">#</th>
                                        <th style="vertical-align: middle;">CODIGO</th>
                                        <th style="vertical-align: middle;">N° PRÉSTAMOS</th>
                                        <th style="vertical-align: middle;">NOMBRES</th>
                                        <th style="vertical-align: middle;">F. PRÉSTAMO</th>
                                        <th style="vertical-align: middle;">F. VENCE</th>
                                        <th style="vertical-align: middle;">DIAS X COBRAR</th>
                                        <th style="vertical-align: middle;">MONTO</th>
                                        <th style="vertical-align: middle;">MONTO TOTAL</th>
                                        <th style="vertical-align: middle;">TASA</th>
                                        <th style="vertical-align: middle;">MORA</th>
                                        <th style="vertical-align: middle;">SALDO</th>
                                        <th style="vertical-align: middle;">CUOTA</th>
                                        <th style="vertical-align: middle;">PAGO</th>
                                    </tr> 
                                </thead>
                                <tbody>
                                    <tr v-for="(midata,index) in listCredit" :key="index">
                                        <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                        <td style="vertical-align: middle;" v-text="midata.code"></td>
                                        <td style="vertical-align: middle;" v-text="midata.nro_prestamo"></td>
                                        <td style="vertical-align: middle;" v-text="midata.nombres"></td>
                                        <td style="vertical-align: middle;" v-text="midata.fecha_prestamo"></td>
                                        <td style="vertical-align: middle;" v-text="midata.fecha_vencimiento"></td>
                                        <td style="vertical-align: middle;" v-text="midata.dias_x_cobrar"></td>
                                        <td style="vertical-align: middle;" v-text="midata.monto"></td>
                                        <td style="vertical-align: middle;" v-text="midata.monto_total"></td>
                                        <td style="vertical-align: middle;" v-text="midata.tasa"></td>
                                        <td style="vertical-align: middle;" >
                                            <div v-if="midata.mora>0">
                                                <span class="label label-danger">{{midata.mora}}</span> 
                                            </div>
                                            <div v-else>
                                                <span >{{midata.mora}}</span> 
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle;" v-text="midata.saldo"></td>
                                        <td style="vertical-align: middle;" v-text="midata.cuota"></td>
                                        <td ><input type="text" style="border: none;border-bottom: 1px solid #ccc;" v-model="midata.pago" placeholder="0.0"></td>

                                    </tr>                       
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <button type="button" @click="save()" class="btn btn-save" style="float:right; margin-right: 10px;"  data-toggle="tooltip" title="Guardar los pagos">
                                <i class="fa fa-save "></i>&nbsp;GUARDAR
                            </button>
                            <button type="button" @click="downloadDayliCollection(1)" class="btn btn-danger" style="float:right; margin-right: 10px;">
                                <i class="fa fa-file-pdf-o"></i>&nbsp;DESCARGAR
                            </button>                             
                        </div>
                    </div>
                </div>               
>>>>>>> 415d03eae436d9728c4cb358a231349ae9a87bba
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
                
                visible:1, authUser:'',
                listado:2,
                //fechas
                authUser:1,
                date_register: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',errorInputActivity2:'form-group',
                search:'',
                total:0,
                errorTotalcapital:'form-group',
                midatax:[], listCredit:[],totalNumber:0,

                arraySucursal:[],arrayMercado:[],id_branch_office:'',id_market_edit:'',
                arrayEmployee:[],id_promoter:'',
                filter:1
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
            getEmployee(id){
                let me=this;
               // me.listado=0;
                var url= 'getEmpleado?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayEmployee = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getListBranchOffice(){
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
            getMarket(id){
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
            getPromoter(id){
                let me=this;
               // me.listado=0;
                var url= 'getPromoert?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayMercado = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            sumTotal(){
                      this.totalcapital=0;
                      this.totalInterest=0;
                       for(var i=0;i<this.arrayDetailPledge.length;i++) 
                        {
                            this.totalcapital =  Number(this.totalcapital)+Number(this.arrayDetailPledge[i].capital);
                            this.totalInterest =  Number(this.totalInterest)+Number(this.arrayDetailPledge[i].interest);
                            
                        }
                   
            },  
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.list_data(page);
                
            },
            
            save(val){
               
               // this.visible=0;
                let me = this;
                swal({
                    title: 'Esta seguro de guardar la informacion?',
                    type: 'warning',
                    showCancelButton: true,confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar',confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                    reverseButtons: true
                }).then((result) =>{
                    if (result.value){            
                        //recorriendo la lista
                        for (var i=0;i<me.listCredit.length;i++){

                                var monto = me.listCredit[i].pago;
                                if(monto==null)
                                {
                                   monto = -1; 
                                }else if(monto=='')
                                {
                                   monto = -1;
                                }

                                var idCredito = me.listCredit[i].id;
                                var idpromotor = me.listCredit[i].idpromotor;
                                var idCliente = me.listCredit[i].idcliente;
                                var fecha_vence = me.listCredit[i].fecha_vence;
                                var saldo = me.listCredit[i].saldo;
                                var mora = me.listCredit[i].mora;
                                var cliente = me.listCredit[i].nombres;

                                if (monto >= 0){
                                      me.listado=0;  
                                      axios.post('save_payment',{
                                                'idCredito':idCredito,'monto':monto,
                                                'fecha_vence' :fecha_vence,'cliente':cliente,
                                                'idCliente' :idCliente,'saldo':saldo,
                                                'mora' :mora,'idpromotor':idpromotor,
                                                'fecha_registro' : moment(moment(this.date_register, 'DD/MM/YYYY')).format('YYYY-MM-DD')                             
                                            }).then(function (response) {
                                                me.list_data(1);
                                            }).catch(function (error) {
                                                console.log(error);
                                            });
                                }
                                
                        }
                        //fin de recorrido    
                        
                    }else if(result.dismiss === swal.DismissReason.cancel) {                    
                    }
                }) 
            },
           
            downloadDayliCollection(){    
                if(this.id_promoter==''){alert('Seleccione promotor');return;}     
                var fechax= moment(moment(this.date_register, 'DD/MM/YYYY')).format('YYYY-MM-DD') ;     
                var date_pretty= moment(moment(this.date_register, 'DD/MM/YYYY')).format('DD/MM/YYYY') ;     
                var url= 'downloadDayliCollection?id_promoter='+this.id_promoter+'&date_register='+fechax+'&date_pretty='+date_pretty;
              
                //window.location.href = url;
                window.open(url, '_blank');  
            },
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.id=-1;
            },
            list_data(page){
                let me=this;                      
                me.listado=0; 
                var url= 'getListDailyCollection?search='+me.search+'&id_branch_office='+me.id_branch_office+
                '&market='+me.id_market_edit+'&id_promoter='+me.id_promoter+'&date_now='+
                moment(moment(me.date_register, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listCredit=respuesta.datax;                 
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
      
        mounted() {
            
           this.list_data(1);
           this.getListBranchOffice();
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

.floating-btn {
    position: fixed;
    /* Footer height */
    bottom: 65px;
    cursor: pointer;
    border-radius: 50%;
    z-index: 1000;
}

</style>

