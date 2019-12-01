<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong>
                    GESTIÓN DE USUARIOS</strong>                           
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-shield"></i>Seguridad</a></li>
                    <li class="active">Usuarios</li>
                </ol>
            </section>
            <div class="box-tools pull-right">
                <!--<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>-->
                <!--<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
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
                                                <div class="col-xs-12 col-sm-4 col-md-10 col-lg-8">
                                                    <div class="input-group" style="margin-bottom: 15px;">
                                                        <input type="text" v-model="buscar"  class="form-control" placeholder="Busca por DNI o apellidos y nombres." style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">
                                                        <span class="input-group-btn">
                                                        <button type="submit"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                                        </span>
                                                    </div>                                               
                                                </div>                                               

                                                <div class="col-xs-12 col-sm-8 col-md-2 col-lg-4">
                                                    <div class="btn-group" style="float:right; margin-left: 10px;">   
                                                        <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-add"><i class="fa fa-user-plus"></i>&nbsp;Agregar usuario</button>
                                                    </div>
                                                </div>
                                            </div>     

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="box-body table-responsive no-padding">
                                                        <table  class="table table-hover" style="font-size:12px">
                                                            <thead style="background: #90a4ae;color: #fff;">     
                                                                <tr>
                                                                    <th style="text-align: center; vertical-align: middle;">#</th>
                                                                    <th style="vertical-align: middle;">APELLIDOS Y NOMBRES</th>
                                                                    <th style="text-align: center; vertical-align: middle;">EMAIL</th>
                                                                    <th style="text-align: center; vertical-align: middle;">NICK</th>
                                                                    <th style="text-align: center; vertical-align: middle;">CONTRASEÑA</th>
                                                                    <th style="text-align: center; vertical-align: middle;">CARGO</th>
                                                                    <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                    
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(midata,index) in arrayUser" :key="index">
                                                                   <td style="vertical-align: middle;" >{{(index+1)}}</td>                                              
                                                                    <td style="vertical-align: middle;" v-text="midata.paternal_last_name +' '+midata.maternal_last_name+' '+midata.names"></td>                                                
                                                                    <td style="text-align: center; vertical-align: middle;" v-text="midata.email"></td>
                                                                    <td style="text-align: center; vertical-align: middle;" v-text="midata.nick"></td> 
                                                                    <td style="text-align: center; vertical-align: middle;">****************</td>
                                                                    <td style="text-align: center; vertical-align: middle;" v-text="midata.name"></td>
                                                                    <td style="vertical-align: middle;text-align: center;">
                                                                        <button title="Editar" type="button" @click="editUser(midata.id)"  class="btn btn-editar btn-sm" data-toggle="tooltip">   
                                                                        <i class="fa fa-pencil"></i>
                                                                        </button> 
                                                                         <button title="Eliminar" type="button" @click="eliminarUser(midata.id)" class="btn btn-eliminar btn-sm">
                                                                            <i class="fa fa-trash"></i>
                                                                        </button> 
                                                                    
                                                                    </td>
                                                                </tr>                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            </template>
                                            <template v-if="listado==2">
                                                <div class="row">                                                    
                                                    <div class="col-md-12">
                                                        <div class="btn-group" style="float:right;">
                                                            <button type="button" @click="back_home()" class="btn btn-danger">
                                                                <i class="fa fa-arrow-left"></i>&nbsp;Volver a la lista
                                                            </button>
                                                            <button type="button" @click="save_user()" class="btn btn-save">
                                                                <i class="fa fa-save"></i>&nbsp;Guardar usuario
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="col-md-12">
                                                        <legend style="font-size:16px;"><strong>DATOS PERSONALES:</strong></legend>
                                                    </div>
                                                            <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div v-bind:class="errorInputDni">
                                                                            <label for="dni">DNI:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                                <input maxlength="8" v-model="number_doc" type="text"  @keyup.enter="get_data_user()"  class="form-control" placeholder="DNI" >
                                                                                <span class="input-group-btn">
                                                                                    <button data-toggle="tooltip" title="Buscar" type="submit" @click="get_data_user()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                                                                </span>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div v-bind:class="errorInputPersonal">       
                                                                            <div class="form-group">
                                                                                <label for="ap_materno">Personal:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                    <input disabled v-model="personal" type="text" class="form-control"  placeholder="Apellido Materno">  
                                                                                    <span class="input-group-btn">
                                                                                        <button data-toggle="tooltip" title="Agregar" type="submit" @click="add_person()" class="btn btn-excel btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-plus"></i> AGREGAR</button>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            

                                                            <div v-bind:class="errorInputRole"> 
                                                                        <div class="col-md-6">                                                                    
                                                                            <div class="form-group">
                                                                                <label  class="col-md-4 control-label">Cargo</label>
                                                                                <div class="col-md-8">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;"><i class="fa fa-sitemap"></i></span>
                                                                                        <select v-model="id_role" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                            <option selected="selected" value="">Seleccione</option>
                                                                                            <option v-for="datax in array_role" :selected="datax.id == id_role" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                            <!-- <option v-for="classifier_sub in arrayClassifierSub" :key="classifier_sub.id_classifier_sub" :value="classifier_sub.id_classifier_sub">{{ classifier_sub.classifier_sub }}</option> -->
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    </div>
                                                            
                                                                   <div v-bind:class="errorInputEmail">      
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label  class="col-md-4 control-label">E-mail</label>
                                                                                <div class="col-md-8">
                                                                                    <div class="input-group">
                                                                                        <span class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;"><i class="fa fa-envelope"></i></span>
                                                                                        <input type="text" v-model="email" class="form-control" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label  class="col-md-4 control-label"></label>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label  class="col-md-4 control-label"></label>
                                                                    </div>
                                                                </div> 
                                                                <div v-bind:class="errorInputNick">  
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label  class="col-md-4 control-label">nick</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;"><i class="fa fa-lock"></i></span>
                                                                                <input  v-model="nick" type="text" class="form-control" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                                <div v-bind:class="errorInputPassword">  
                                                                <div class="col-md-6">                                                                    
                                                                    <div class="form-group">
                                                                        <label  class="col-md-4 control-label">Contraseña</label>
                                                                        <div class="col-md-8">
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;"><i class="fa fa-key"></i></span>
                                                                                <input type="password" v-model="password" class="form-control" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;">
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
                    <!-- Fin ejemplo de tabla Listado -->
                    </div>
                </div>
            </div>
        </div>
       <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal_add}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #012D74;">
                        <button type="button" class="close" @click="close_modal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-plus"></i> AGREGAR PERSONAL</h4>
                    </div>

                    <div class="modal-body">  
                        <div class="row">    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <div class="box-body">                                     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">DNI:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input maxlength="8" v-model="number_doc_add" type="text" @keyup.enter="get_data_reniec()" class="form-control">
                                                            <span class="input-group-btn">
                                                                <button data-toggle="tooltip" title="Buscar" type="submit" @click="get_data_reniec()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-check"></i> VALIDAR</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Apellido Paterno:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input v-model="paternal_last_name" type="text" @keyup="validarDataPersonal()" class="form-control" style="border-bottom-right-radius:
                                                             3px;border-top-right-radius: 3px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Apellido Materno:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input v-model="maternal_last_name" type="text" @keyup="validarDataPersonal()" class="form-control" style="border-bottom-right-radius: 3px;
                                                            border-top-right-radius: 3px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Nombres:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                <i class="fa fa-indent"></i>
                                                            </span>
                                                            <input maxlength="8" v-model="names" type="text" @keyup="validarDataPersonal()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="close_modal(1)"><i class="fa fa-times"></i> CERRAR</button>
                        <button type="button" @click="save_personal()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;GUARDAR PERSONAL</button>                        
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
    //import 'babel-polyfill';
	import myUpload from 'vue-image-crop-upload';
    export default {
        data (){
            return {
                listado:1, number_doc:'', personal:'', lastname:'', sex:'',
                phone:'', email:'', charge:'', id_role:-1, 
                nick:'', password:'', 

                id: -1,
                modal_add:0, 
                buscarhistorial:'',
                idrol: -1,idusuariox:'',
                number_doc_add:'', 
                paternal_last_name:'',
                maternal_last_name:'', names:'',
                id_person:'', 
                errorClase : 0,
                errors:{},
                errorInputDni:'form-group',
                errorInputRole:'form-group',
                errorInputPersonal:'form-group',
                errorInputNick:'form-group',
                errorInputPassword:'form-group',
                errorInputEmail:'form-group',
                errorInputAmount:'form-group',
                errorComboTipoProduco:'form-group',
                errorTotalAmount:'form-group',
                
                arrayUser: [],
                array_role : [],arrayHistorial:[],
                modal : 0,modalHistorial:0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                buscar : '',
                fechaInicio: ''+new Date().getDate()+'-'+(Number(new Date().getMonth())+1)+'-'+new Date().getFullYear(),
                fechaFin: ''+new Date().getDate()+'-'+(Number(new Date().getMonth())+1)+'-'+new Date().getFullYear(),
                options: {
                format: 'DD/MM/YYYY',
                useCurrent: false,
                    locale: 'es',
                    showClose: true,
                },

                show: false,
                params: {
                    token: '123456798',
                    name: 'avatar'
                },
                headers: {
                    smail: '*_~'
                },
                imgDataUrl: '',
                en: {
                    hint: 'Click or drag the file here to upload',
                    loading: 'Uploading…',
                    noSupported: 'Browser is not supported, please use IE10+ or other browsers',
                    success: 'Upload success',
                    fail: 'Upload failed',
                    preview: 'Preview',
                    btn: {
                        off: 'Cancel',
                        close: 'Close',
                        back: 'Back',
                        save: 'Save'
                    },
                    error: {
                        onlyImg: 'Image only',
                        outOfSize: 'Image exceeds size limit: ',
                        lowestPx: 'Image\'s size is too low. Expected at least: '
                    }
                }
                
            }
        },
        components: {
            datePicker,moment, 'my-upload': myUpload
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
            toggleShow() {
				this.imgDataUrl='';
                this.params= {
                    token: '1234567989',
                    name: 'avatarx'
                };
                this.headers= {
                    smail: '*_~'
                };
                this.show = !this.show;
			},
            /**
			 * crop success
			 *
			 * [param] imgDataUrl
			 * [param] field
			 */
			cropSuccess(imgDataUrl, field){
				console.log('-------- crop success --------');
				this.imgDataUrl = imgDataUrl;
                
			},
			/**
			 * upload success
			 *
			 * [param] jsonData  server api return data, already json encode
			 * [param] field
			 */
			cropUploadSuccess(jsonData, field){
				console.log('-------- upload success --------');
				console.log(jsonData);
				console.log('field: ' + field);
                
			},
			/**
			 * upload fail
			 *
			 * [param] status    server api return error status, like 500
			 * [param] field
			 */
			cropUploadFail(status, field){
				console.log('-------- upload fail --------');
				console.log(status);
				console.log('field: ' + field);
                this.show=false;
			},
            /*.....................................................*/
            back_home(){
                this.listado=1;
                this.limpiar();
            },
            save_user(){
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
                axios.post('saveUser',{
                    'id':this.id,
                    'email':this.email,
                    'nick':this.nick,
                    'password':this.password,
                    //'date_creation' : moment(moment(this.date_creation, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                    'id_person': this.id_person,
                    'id_role': this.id_role   
                }).then(function (response) {
                     me.limpiar();
                    me.listado=1; 
                    me.listUsuario();
                    //me.list_data(1);                  
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
            get_data_user(){
                //obteniendo datos de la base de datos
                if (this.number_doc.length==8){   
                    let me=this;              
                    var url= 'getDataCustomerBynro_doc?nro_doc='+me.number_doc;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        if(respuesta.datax.length>0){
                            if(tipo=='bd'){
                                    me.id_person=respuesta.datax[0].id;
                                    me.personal = respuesta.datax[0].paternal_last_name+' ' +respuesta.datax[0].maternal_last_name+' ' +respuesta.datax[0].names;                        
                                //me.validarData();
                            }
                            else{
                                me.personal = 'Personal No Encontrado!';
                                //me.validarData();
                            }
                        }                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            get_data_reniec(){
                //obteniendo datos de RENIEC
                if (this.number_doc_add.length==8){   
                    let me=this;              
                    var url= 'getDataCustomerBynro_doc?nro_doc='+me.number_doc_add;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        if(respuesta.datax.length>0){
                        if(tipo=='reniec'){
                                me.paternal_last_name = respuesta.datax[0];
                                me.names = respuesta.datax[1];
                                me.maternal_last_name = respuesta.datax[2];                            
                            me.validarDataPersonal();
                            }
                            else{
                                me.paternal_last_name = 'PERSONAL YA ESTA REGISTRADO!';
                                me.validarDataPersonal();
                            }

                        }
                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            validarDataPersonal(){
                this.errors = {};
                this.errorClase=0;
                this.errors.number_doc_add="";
                this.errors.names="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                //input
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                if (!this.number_doc_add){
                    this.errors.number_doc_add="Ingrese el DNI.";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.names){
                    this.errors.names="Ingrese el o los nombres del Personal.";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name){
                    this.errors.paternal_last_name="Ingrese el apellido paterno.";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name){
                    this.errors.maternal_last_name="Ingrese el apellido materno.";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },
            save_personal(){
                if (this.validarDataPersonal()){
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
                            axios.post('save_personal',{
                                'id': this.id,
                                'number_doc':this.number_doc_add,'names':this.names,
                                'paternal_last_name':this.paternal_last_name,'maternal_last_name':this.maternal_last_name                     
                            }).then(function (response) {
                                //me.limpiar();
                                me.listado=2; 
                                //me.list_data(1);    
                                close_modal(0);            
                                swal(
                                    'Guardado!',
                                    'El registro ha sido guardado con éxito.',
                                    'success'
                                ) 
                            }).catch(function (error) {
                                console.log(error);
                            });
                        }else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ){                        
                    }   
                }) 
            },
            limpiar(){
               this.errorInputDni='form-group';
                this.errorInputEmail='form-group';
                this.errorInputPersonal='form-group';
                this.errorInputPassword='form-group';
                this.errorInputNick='form-group';
                this.errors = {};
                this.errors.email="";
                this.errors.number_doc="";
                this.errors.personal="";
                this.errors.password="";
                this.errors.nick="";
                this.email="";
                this.personal="";
                this.number_doc="";
                this.password="";
                this.nick="";
                this.id=-1;
            },
            add_person(){     
                let me= this;                  
                me.modal_add=1;
                me.number_doc_add=this.number_doc;                
            },
            close_modal(){
                let me= this;
                me.modal_add=0;
            },
            getComboRole(){ // este es el metodo para que jale al combo de user,
                let me=this; 
                //me.listado=0;             
                var url= 'comboRole_list';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_role =respuesta.datax;
                    //me.listado=1;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },
            
            listUsuario(){
                let me=this;
               // me.listado=0;  
                var url= 'getListUser';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayUser = respuesta.datax;
                    //me.listado=1;
                   // me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
            },
            editUser(id){
                let me=this;
                me.listado=2;
                me.getComboRole(); 
                var url= 'getEditUser?id='+id;
				axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.personal=respuesta.datax[0].paternal_last_name+ " "+respuesta.datax[0].maternal_last_name+ " "+respuesta.datax[0].names;
                    me.number_doc=respuesta.datax[0].number_doc;
                    me.email=respuesta.datax[0].email;
                    me.nick=respuesta.datax[0].nick;
                    me.id_person=respuesta.datax[0].id_person;
                    me.id_role=respuesta.datax[0].id_role;
                    me.id=respuesta.datax[0].id
                    
				}) 
				.catch(function (error) {
				console.log(error);
                });               
            },
            eliminarUser(id){
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
                axios.post('delete_User',{
                    'id': id

                }).then(function (response) {
                    //me.limpiarIncome();
                   me.listado=1;
                   me.listUsuario();
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
            

            cambiarPagina(page,buscar){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listUser(page,buscar);
            },
            actualizarUsuario(){
                let me = this;
                axios.put('usuario/actualizar',{
                    'usuario': this.usuario,
                    'email' : this.email,
                    'password': this.password,
                     'nombres': this.nombres,
                    'apellidos': this.apellidos,
                    'celular': this.celular,
                    'sexo': this.sexo,
                    'cargo': this.cargo,
                    'dni': this.dni,
                    'id':this.id  
                }).then(function (response) {
                    me.cerrarModal();
                    me.listUser(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.email="";
                //this.errors.dni="";
                this.errors.personal="";
                //input
                //this.errorInputDni='form-group has-success';
                this.errorInputEmail='form-group has-success';
                this.errorInputPersonal='form-group has-success';
                
                 if (!this.email) 
                {   this.errors.email="Ingrese o genere el Email";
                    this.errorInputEmail='form-group has-error';
                    this.errorClase = 1;
                }

                if (!this.personal) 
                {   this.errors.personal="Ingrese DNI";
                    this.errorInputPersonal='form-group has-error';
                    this.errorClase = 1;
                }
               
               
                return this.errorClase;
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.nombre) this.errorMostrarMsjPersona.push("El nombre de la pesona no puede estar vacío.");
                if (!this.usuario) this.errorMostrarMsjPersona.push("El nombre de usuario no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjPersona.push("La password del usuario no puede estar vacía.");
                if (this.idrol==0) this.errorMostrarMsjPersona.push("Seleccione una Role.");
                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModalhis(){
                this.modalHistorial=0;
            },
            cerrarModal(){
                this.modal=0;
                this.modalHistorial=0;
                this.tituloModal='';
                this.nombre='';
                this.num_documento='';
                this.direccion='';
                this.telefono='';
                this.email='';
                this.usuario='';
                this.password='';
                this.idrol=0;
                this.errorPersona=0;
            },
            descargar(){
                 var fechaIniciox=moment(moment(this.fechaInicio, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                var fechaFinx=moment(moment(this.fechaFin, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                this.modalHistorial=1;  
               let me=this;
                var url= 'getHistorial?idusuario=' + this.idusuariox+'&fechaInicio='+fechaIniciox+'&fechaFin='+fechaFinx+'&buscar='+this.buscarhistorial+'&tipox=descarga';
              window.location.href = url;
            },
            ver(){
                 var fechaIniciox=moment(moment(this.fechaInicio, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                var fechaFinx=moment(moment(this.fechaFin, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                this.modalHistorial=1;  
                
                let me=this;
                var url= 'getHistorial?idusuario=' + this.idusuariox+'&fechaInicio='+fechaIniciox+'&fechaFin='+fechaFinx+'&buscar='+this.buscarhistorial+'&tipox=lista';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayHistorial=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            abrirModalHis(idusuario,usuario){
                this.buscarhistorial="";
                this.idusuariox=idusuario;
                var fechaIniciox=moment(moment(this.fechaInicio, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                var fechaFinx=moment(moment(this.fechaFin, 'DD/MM/YYYY')).format('YYYY-MM-DD');
                this.modalHistorial=1;  
                this.tituloModal='<i class="fa fa-history"></i>'+" Historial de "+usuario;
               let me=this;
                var url= 'getHistorial?idusuario=' + idusuario+'&fechaInicio='+fechaIniciox+'&fechaFin='+fechaFinx+'&tipox=lista';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayHistorial=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            
            abrirModal(modelo, accion, data = []){
            
                this.limpiar();
                switch(modelo){
                    case "persona":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                //this.modal = 1;
                                this.listado = 2;
                                this.tituloModal ='<i class="fa fa-edit"></i>'+" Registro de Usuario";
                                this.nombre= '';
                                this.direccion='';
                                this.telefono='';
                                this.email='';
                                this.usuario='';
                                this.password='';
                                this.idrol=0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                //this.modal=1;
                                this.listado=2;
                                this.tituloModal='<i class="fa fa-refresh"></i>'+" Actualización de datos de Usuario";
                                this.tipoAccion=2;
                                this.id=data['id'];
                                this.nombres = data['nombres'];
                                this.apellidos = data['apellidos'];
                                this.celular = data['celular'];
                                this.usuario = data['nick'];
                                this.dni = data['dni'];
                                this.sexo = data['sexo'];
                                this.cargo = data['id_cargo'];
                                this.password=data['password'];
                                this.email=data['email'];
                                break;
                            }
                        }
                    }
                }
                this.getComboRole();
            },
            desactivarUsuario(id){
               swal({
                title: 'Esta seguro de desactivar este usuario?',
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

                    axios.put('usuario/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
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
            activarUsuario(id){
               swal({
                title: 'Esta seguro de activar este usuario?',
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

                    axios.put('usuario/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listUser(1,'','name');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
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
            //this.getComboRole(1);
            this.listUsuario();
        }
    }
</script>
<style>    
    .modal-content{
    width: 100% !important;
    position: fixed; 
}
.mostrar{
    display: list-item !important;
    opacity: 1 !important;
    position: fixed; 
    background-color: #3c29297a !important;
}
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    .my-custom-scrollbar {
position: relative;
height: 200px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
}
</style>
