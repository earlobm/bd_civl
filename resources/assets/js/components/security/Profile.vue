<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    Perfil</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">MEF</a></li>
                    <li class="active">Productos / Proyectos</li>
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
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="box-body box-profile">
                                                            <img class="profile-user-img img-responsive img-circle"  alt="User profile picture">

                                                            <h3 class="profile-username text-center">Nina Mcintire</h3>

                                                            <p class="text-muted text-center">Software Engineer</p>

                                                            <ul class="list-group list-group-unbordered">
                                                                <li class="list-group-item">
                                                                <b>Followers</b> <a class="pull-right">1,322</a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                <b>Following</b> <a class="pull-right">543</a>
                                                                </li>
                                                                <li class="list-group-item">
                                                                <b>Friends</b> <a class="pull-right">13,287</a>
                                                                </li>
                                                            </ul>

                                                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
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
    </main>
</template>

<script>
    //fecha bot
    export default {
        data (){
            return {
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                arrayZona : [],
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
                listProgram : [],listProyect: [],listProgramx:[],
                code:'',name:'',id:-1,
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',
                errorInputActivity2:'form-group',
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
        created: function(){
            this.init();
        },
        methods : { 
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.code="";
                this.errors.name="";
                //input
                this.errorInputActivity='form-group has-success';
                this.errorInputActivity2='form-group has-success';

                if (!this.code) 
                {   this.errors.code="Ingrese codigo";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity2='form-group has-error';
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

            agregar(){
                let me=this;
                me.listado=2;
            },

            volver(){
                let me=this;
                me.limpiar();
                me.listado=1;
                me.listar();
            },

            descargar(buscar){
                var url= '/download_product?buscar='+buscar;;
                window.location.href = url;
            },
           
            editar(id_product){
               //return;
                let me=this; 
                me.listado=2;
                me.limpiarlista();
                me.limpiar();
                var url= 'get_proyectt?id_product=' + id_product;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProyect=respuesta.datax;
                    for(var i=0;i<me.listProyect.length;i++){
                        me.code=me.listProyect[i].code;
                         me.name=me.listProyect[i].name;
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_product_program?id_product=' + id_product;
                axios.get(url).then(function (response) {
                    me.obtenerProgramas();
                    var respuesta= response.data;
                    var listactual=respuesta.datax;
                    for(var i=0; i < me.listProgramx.length; i++){
                        for(var j=0; j < listactual.length; j++){
                            if(me.listProgramx[i].id_program==listactual[j].id_program){
                                me.listProgramx[i].check=true;   
                                                             
                            }
                        }
                    }
                    
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
                axios.post('save_programx',{
                    'code':this.code,'name':this.name, 
                    'id': this.id,
                    'program':this.listProgramx                 
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
            limpiar(){
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.code="";
                this.errors.name="";
                this.code="";
                this.name="";
                this.id=-1;
            },
        
            listar(){
                let me=this;              
                var url= 'get_proyect?buscar='+me.buscar;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProyect=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            limpiarlista(){
                let me=this;
                for(var i=0; i < me.listProgramx.length; i++){
                         me.listProgramx[i].check=false; 
                    }

            },

            obtenerProgramas(){
                let me=this;
                me.limpiarlista();
                var url= 'get_programx';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram = respuesta.datax;
                    me.listado=2;
                })
                .catch(function (error) {
                    console.log(error);
                });
                
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
                axios.post('delete_product',{
                    'id_product': id

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
            
            init: function() {
            //cargar actividades
                let me=this;  
                me.listProgramx=[];        
                var url= 'get_program';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var lista=respuesta.datax;
                    for(var i=0; i < lista.length; i++){
                       me.listProgramx.push({ check:false,id_program: lista[i].id_program, id_product:''});
                      
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
.todo-list:hover{
     border-style:dashed;
     /* border: 1px solid red; */
     border-width: 1px;
     border-color:rgb(32, 32, 32);
}
/* .container .checkmark {
    background-color: #00B1B0;
} */
</style>


