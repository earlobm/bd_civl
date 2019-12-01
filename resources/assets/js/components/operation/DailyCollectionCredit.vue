<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Cobanza Diaria
              <small>Registre los cobros</small>
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
                        <div class="box-header with-border">
                            <h1 class="box-title"><i class="fa fa-list"></i>Clientes con préstamos actuales
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
                        <template v-if="listado==2">
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sexo">Sucursal:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-signs"></i></span>                                                                             
                                            <select @change="getMarket($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_sucursal_edit">
                                                <option  value=""  >Seleccione</option>
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
                                            <select class="form-control" @change="getEmpleado($event.target.value)" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_market_edit">
                                                <option v-for="miselect in arrayMercado" :selected="miselect.id == id_market_edit" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date_init">Fecha:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <date-picker  v-model="date_init" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-md-12">
                                        <div class="input-group" style="margin-bottom: 10px;margin-top: 10px;">
                                            <input type="text"  v-model="search" @keyup.enter="list_data(1)"  class="form-control" placeholder="buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                            <span class="input-group-btn">
                                                <button type="submit" @click="list_data(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
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
                                        <tr v-for="(midata,index) in list" :key="index" >
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
                                            <td style="vertical-align: middle;" v-text="midata.mora"></td>
                                            <td style="vertical-align: middle;" v-text="midata.saldo"></td>
                                            <td style="vertical-align: middle;" v-text="midata.cuota"></td>
                                            <td ><input type="text" style="border: none;border-bottom: 1px solid #ccc;" v-model="midata.pago" placeholder="0.0"></td>

                                        </tr>                       
                                    </tbody>
                                </table>                                
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
                
                id_parent:'',visible:1,
                authUser:'',porcent: 50,
                listadox:1,
                listado:2,
                //fechas
                authUser:1,
                birthdate: '',
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

                name:'',id:-1,paternal_last_name:'',
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',errorInputActivity2:'form-group',
                search:'',sex:'', marital_status:'',
                name_customer:'',capital:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_dependence:0,characteristic:'',tea:20,id_warehouse:'',
                id_person:0,id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
                period:'Mensual',arrayDetailPledge:[],licence_plate:'',
                errorTotalcapital:'form-group',

                arrayTypeProduct:[],arrayFamilyProduct:[],arrayWarehouse:[],
                totalcapital:0,totalInterest:0,modalTicket:0,idcustomer:-1,
                midatax:[], list:[],totalNumber:0,idcustomerpledge:-1,
                arraySucursal:[],arrayMercado:[],id_sucursal_edit:'',id_market_edit:''
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
            imprimirElemento(){
                    window.print();
            },
            closeModal(){
                let me=this;
                me.modalTicket=0;
            },
            savePledge() {
                if(this.arrayDetailPledge.length<1){
                    return;
                }
                swal({
                title: '¿Esta seguro?',
                type: 'warning',showCancelButton: true,
                confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true
                }).then((result) => {
                if (result.value) {
                      let me = this;
                        axios.post('save_pledge',{
                            'idcustomerpledge':this.idcustomerpledge,
                            'date_init':moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD') ,
                            
                            'id_warehouse':this.id_warehouse.id               
                        }).then(function (response) {

                             swal(
                                'Guardado!',
                                'El registro ha sido guardado con éxito.',
                                'success'
                                )
                           me.dowloadContract();     

                           var url= 'ticket_plegde?capital='+me.totalcapital+'&interest='+me.totalInterest+'&name_customer='+me.name_customer
                            +'&date_movement='+moment(moment(me.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD')+
                            '&type=Empenio';
                            window.open(url, '_blank');  

                             
                             me.volver();
                             me.list_data(1); 
                        }).catch(function (error) {
                            console.log(error);
                        });

                  //  this.modalTicket=1;
                   
                } else if ( result.dismiss === swal.DismissReason.cancel
                ) {} }) 
                
            },
            dowloadContract(){
				  //var entre = document.getElementById("entre");
				  //var nombreentre = entre.options[entre.selectedIndex].text;
                var url= 'dowloadContract?name_customer='+this.name_customer+'&nro_doc='+this.nro_doc+
                '&dateinit='+moment(moment(this.date_init, 'DD/MM/YYYY')).format('DD-MM-YYYY')+
                '&dateend='+moment(moment(this.date_end, 'DD/MM/YYYY')).format('DD-MM-YYYY');
            	window.location.href = url;
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
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.list_data(page);
                
            },
            
            save(val){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente                
                if (this.validarData()){
                    return;
                }
                this.visible=0;
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
                        axios.post('save_customer',{
                            'nro_doc':this.nro_doc,'name':this.name,
                            'birthdate' : moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'idcustomerpledge':this.idcustomerpledge                    
                        }).then(function (response) {
                            if(val==1){
                                me.midatax=[];
                                me.midatax.push({id:response.data,names: me.name,paternal_last_name: me.paternal_last_name, maternal_last_name:me.maternal_last_name });
                                me.pledge(me.midatax[0]);
                            }else{
                                me.limpiar();                                
                                me.list_data(1);  
                                me.visible=1;
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });

                    }else if(result.dismiss === swal.DismissReason.cancel) {                    
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
                    axios.post('delete_customer',{
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
        
            descargar(search){               
                var url= '/downloadprogram?search='+search;
                window.location.href = url;
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
                var url= 'getListDailyCollection?search='+me.search+'&market='+me.id_market_edit+'&date_now='+
                moment(moment(me.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.list=respuesta.datax;                 
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
           
        },
        lista_add_client(){
                let me=this;         
                me.listado=1;
           
        },
        mounted() {
        //    this.lista_add_client();
           this.list_data(1);
           this.listadox=1;
           this.getListBranchOffice();
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }


.example-print {
    display: none;
}
@media print {
   .example-screen {
       display: none;
    }
    .example-print {
       display: block;
    }
}
@page {
    margin-top: 2cm;
    margin-bottom: 2cm;
    margin-left: 2cm;
    margin-right: 2cm;
}

</style>

