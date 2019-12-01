<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    NUMERO DE CONTRATO / NUMERO DE BOLETA </strong>                            
                </h3>
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
        <!-- left column -->
        <div class="col-md-6">
            
          <!-- general form elements -->
            
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-header with-border">
              <h3 class="box-title">NUMERO DE CONTRATO</h3>
            </div>   
            <div class="row">
               <div class="col-md-10">
                    <div v-bind:class="errornameProductType">
                        <label for="nombres">CONFIGURE:</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                            <input  v-model="nameProductType" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                        </div>
                    </div>
               </div>
               <div class="col-md-2">
                    <div >
                        <label for="nombres">Agregar:</label>
                        <div class="input-group">
                            <button type="submit" @click="addTypeProduct()"  class="btn btn-mostrar btn-flat" style="border-top-right-radius:3px;border-bottom-right-radius:3px"><i class="fa fa-plus"></i></button>
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
                                                                                <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                                
                                                                                <tr v-for="(midata,index) in list" :key="index" >
                                                                                    <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                                    <td style="vertical-align: middle;text-align: center;"> 
                                                                                        <button type="button" @click="editartypeProduct(midata.id)" class="btn btn-editar btn-sm">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </button>   
                                                                                        <button title="Eliminar" type="button" @click="deleteDataTipo(midata.id)" class="btn btn-eliminar btn-sm">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>                                       
                                                                                    </td> 
                                                                                </tr>
                                                                                                   
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                
                                                               
                </div> 
            </div>
          </div>
		 
 
         <div class="col-md-6">
           <!-- general form elements -->
            
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-header with-border">
              <h3 class="box-title">NUMERO DE BOLETA</h3>
            </div>   
            <div class="row">
               <div class="col-md-10">
                    <div v-bind:class="errornameProductType">
                        <label for="nombres">CONFIGURE:</label>
                        <div class="input-group">
                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                            <input  v-model="nameProductType" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                        </div>
                    </div>
               </div>
               <div class="col-md-2">
                    <div >
                        <label for="nombres">Agregar:</label>
                        <div class="input-group">
                            <button type="submit" @click="addTypeProduct()"  class="btn btn-mostrar btn-flat" style="border-top-right-radius:3px;border-bottom-right-radius:3px"><i class="fa fa-plus"></i></button>
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
                                                                                <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                                
                                                                                <tr v-for="(midata,index) in list" :key="index" >
                                                                                    <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                                                                    <td style="vertical-align: middle;" v-text="midata.name"></td>
                                                                                    <td style="vertical-align: middle;text-align: center;"> 
                                                                                        <button type="button" @click="editartypeProduct(midata.id)" class="btn btn-editar btn-sm">
                                                                                            <i class="fa fa-pencil"></i>
                                                                                        </button>   
                                                                                        <button title="Eliminar" type="button" @click="deleteDataTipo(midata.id)" class="btn btn-eliminar btn-sm">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>                                       
                                                                                    </td> 
                                                                                </tr>
                                                                                                   
                                                                        </tbody>
                                                                    </table>
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
    import VueMoment from 'vue-moment';
    import moment from 'moment-timezone';
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
    //fecha bot
    export default {
        data (){
            return {
                
                arrayZona : [],
                list : [],id_parent:-1,year:'',
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
          
                
                listado:1,estado:'',
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
                item: {
                value: '',
                text: ''
                },
                amount:'',nameProductType:'',buscarProductType:'',productFamily:'',name:'',id:-1,paternal_last_name:'',maternal_last_name:'',phone:'',address:'',nro_doc:'',
                errorClase : 0,
                errors:{},
                errornameProductType:'form-group',
                errorInputName:'form-group',
                errorInputActivity3:'form-group',
                errorInputActivity4:'form-group',
                errorInputActivity5:'form-group',
                errorInputActivity6:'form-group',
                errorInputAmount:'form-group',
                errorComboTipoProduco:'form-group',
                 arrayTypeProduct:[],arrayFamilyProduct:[],arrayDependenceTable:[],listTypeProduct:[],
                buscar:'',sex:'',birthdate:'',marital_status:'',id_type_product:-1,
                id_family_product:-1
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
            
            paginaActual(){
                this.listado=1;
            },
            
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.listar(page);
                
            },
           getFamilyProduct(id_parent){
                let me=this;
               // me.listado=0;
                var url= 'getDependenceParent?id_parent='+id_parent;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                       me.listTypeProduct=respuesta.datax;

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            validateTypeProduct(){
                this.errorClase=0;
                this.errors = {};
                //input
                this.errornameProductType='form-group';

                if (!this.nameProductType) 
                {  
                    this.errornameProductType='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            },
            validateFamilyProduct(){
                this.errorClase=0;
                this.errors = {};
                //input
                this.errorInputName='form-group';
                if (!this.name) 
                {  
                    this.errorInputName='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            },
            
            addFamilyProduct(){
                if(this.validateFamilyProduct()){
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
                axios.post('saveDependenceFamily',{
                    'name':this.name, 
                    'id_parent':this.id_parent,
                    'id':this.id_family_product

                }).then(function (response) {
                    
                    me.getFamilyProduct(me.id_parent);
                    me.limpiarFamilyProduct();
                   // me.limpiar();
                   // me.listado=1; 
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

                /*this.list.push(
                {name:this.nameProductType,
                });*/
            },
            editarfamilyProduct(id){
                let me=this;
                me.listado==1
                me.limpiarFamilyProduct();
                var url= 'getEditDependenceFamilyProduct?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id_family_product=respuesta.datax[0].id;
                                me.id_parent=respuesta.datax[0].id_parent;
                                me.name = respuesta.datax[0].name;
                                me.validateFamilyProduct();
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            deleteDataFamily(id){
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
                    axios.post('delete_FamilyProduct',{
                        'id': id
                        //'id_parent':this.id_parent

                    }).then(function (response) {
                    //me.listado=1;
                    //me.listar(1);
                    me.getFamilyProduct(me.id_parent);
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            addTypeProduct(){
                if(this.validateTypeProduct()){
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
                axios.post('saveDependence',{
                    'name':this.nameProductType, 
                    'id': this.id_type_product            
                }).then(function (response) {
                     me.limpiarTypeProduct();
                    me.listado=1; 
                    me.listar(1);                  
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

                /*this.list.push(
                {name:this.nameProductType,
                });*/
            },
            editartypeProduct(id){
                let me=this;
                me.listado==1
                me.limpiarTypeProduct();
                var url= 'getEditDependenceTypeProduct?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id_type_product=respuesta.datax[0].id;
                                me.nameProductType = respuesta.datax[0].name;
                                me.validateTypeProduct();
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            
            deleteDataTipo(id){
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
                    axios.post('delete_typeProduct',{
                        'id': id 

                    }).then(function (response) {
                    me.listado=1;
                    me.listar(1);
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
            limpiarTypeProduct(){
               this.errornameProductType='form-group';
               this.errors = {};
                this.errors.nameProductType="";
                this.nameProductType="";
                this.id_type_product=-1;
            },
            limpiarFamilyProduct(){
               this.errorInputName='form-group';
               this.errors = {};
                this.errors.name="";
                this.name="";
                this.id_parent=-1;
            },
            listar(page){
               let me=this;  
               me.listado=0;   
                //dependencia superior
                var url= 'getDependenceParent';
                   axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.list=respuesta.datax;
                     me.arrayTypeProduct=respuesta.datax;
                     //me.pagination= respuesta.pagination; 
                     me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });

                //para listar las dependencias en la tabla
                //me.listarTabla(1);
            },
           
        },
        mounted() {
           this.listar(1);
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

