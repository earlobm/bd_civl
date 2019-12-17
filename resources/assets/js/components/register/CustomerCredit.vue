<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Clientes
              <small>Registro</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-cogs"></i> Operaciones</a></li>
              <li>Clientes</li>
              <li class="active">Agregar Clientes</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <template v-if="listadox==3">   
                                <button type="button" @click="volver()" class="btn btn-atras btn-sm"><i class="fa fa-arrow-left"></i></button> 
                            </template>
                            <h1 class="box-title">
                                <template v-if="listadox==1">   
                                    <i v-bind:class="icon_title"></i> {{title}} 
                                </template>
                                                          
                            </h1>
                            <div class="box-tools pull-right">                                
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
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
                                                            <template v-if="listadox==1">                                                   
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputTypeDoc">
                                                                            <label for="estado_civil">Tipo de Documento de Identidad:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-list-alt"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_doc">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_document" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputNroDoc">
                                                                            <label for="dni">N° de Documento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                                <input maxlength="8" v-model="nro_doc" type="text" @keyup.enter="getData()"  class="form-control">
                                                                                <span class="input-group-btn">
                                                                                    <button data-toggle="tooltip" title="Buscar en RENIEC" type="submit" @click="getData()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_search_dni"></i> BUSCAR</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputCode">
                                                                            <label for="dni">Código:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-barcode"></i></span>
                                                                                <input maxlength="8" v-model="code" type="text" class="form-control">
                                                                                <span class="input-group-btn">
                                                                                    <button data-toggle="tooltip" title="Generar Automáticamente" @click="generate_code()" type="submit" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_generate"></i>  GENERAR</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                       
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputPaternal">
                                                                            <label for="ap_paterno">Apellido Paterno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="paternal_last_name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputMaternal">
                                                                            <label for="ap_materno">Apellido Materno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="maternal_last_name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputNames">
                                                                            <label for="nombres">Nombres:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputSex">
                                                                            <label for="sexo">Sexo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-transgender"></i></span>
                                                                            <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="sex">
                                                                                <option selected="selected" value="">Seleccione</option>
                                                                                <option value="M">Masculino</option>
                                                                                <option value="F">Femenino</option>
                                                                            </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="edad">Fecha de Nacimiento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-birthday-cake "></i></span>
                                                                            <date-picker v-model="birthdate" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputMaritalState">
                                                                            <label for="estado_civil">Estado Civíl:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-heart-o"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="marital_status">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option value="SOLTERO">Soltero (a)</option>
                                                                                    <option value="CASADO">Casado (a)</option>
                                                                                    <option value="VIUDO">Viudo (a)</option>
                                                                                    <option value="SEPARADO">Separado (a)</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="celular">Celular:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-mobile-phone"></i></span>
                                                                                <input v-model="phone" type="tel" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="celular">Correo electrónico:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-envelope"></i></span>
                                                                                <input v-model="email" type="email" name="email" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputJob">
                                                                            <label for="type_business">Ocupación:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-briefcase"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_job">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_job" :key="datax.id" :value="datax.id">{{ datax.names }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputTypeBusiness">
                                                                            <label for="type_business">Tipo de Negocio:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-shopping-cart"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_business">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_business" :key="datax.id" :value="datax.id">{{ datax.name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputEmployee">
                                                                            <label for="type_business">Promotor:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-shopping-cart"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_employee">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_employee" :key="datax.id" :value="datax.id">{{ datax.employee }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputDepartment">
                                                                            <label for="estado_civil">Departamento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                <select @change="getProvince($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="department">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="miselect in array_department" :selected="miselect.id == department" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputProvince">
                                                                            <label for="estado_civil">Provincia:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                <select @change="getDistrict($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="province">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="miselect in array_province" :selected="miselect.id == province" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputDistrict">
                                                                            <label for="estado_civil">Distrito:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="district">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="miselect in array_district" :selected="miselect.id == district" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputAddress">
                                                                            <label for="celular">Dirección:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-location-arrow"></i></span>
                                                                                <input placeholder="Dirección domiciliaria" v-model="address" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                     
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="celular">Referencias:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-file-o"></i></span>
                                                                                <textarea placeholder="Referencias de la dirección domiciliaria del cliente." v-model="reference" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>     
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <label>Requisitos:</label>
                                                                    </div>
                                                                    <div  class="col-md-3" v-for="(midata,index) in array_requirement" :key="index">
                                                                        <div class="form-group">
                                                                            <div class="checkbox">
                                                                                <label class="container">
                                                                                    <input type="checkbox" v-model="requirements[index].check">
                                                                                        <strong>{{(index+1)}}</strong>. {{midata.name}}
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                                                                                                                                                     
                                                                </div>
                                                            </template>
                                                                <!-- Dar Crédito -->
                                                            <template v-if="listadox==3">
                                                                <div class="row">  
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Cliente:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input disabled v-model="name_customer" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="date_init">Fecha del Préstamo:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker v-model="date_credit" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="date_init">Inicio de Pago:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker v-model="date_init_payment" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Monto:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="capital" type="number" min="1" step="any" lang="en" @keyup="calculateAmount()" @click="calculateAmount()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div><div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Tasa de Interés:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">%</span>
                                                                                <input v-model="interest_rate" type="number" min="1" @keyup="calculateInterestRateCash()" @click="calculateInterestRateCash()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres" style="visibility:hidden">Tasa:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="interest_rate_cash" type="number" disabled class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Total:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="total_cash" type="number" disabled class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="type_product">Gastos Adm.:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">%</span>
                                                                                <input v-model="rate_admin" type="number" min="0" class="form-control" @keyup="calculateAmount()" @click="calculateAmount()" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc" style="visibility: hidden">Monto gastos adm.:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="amount_admin" type="number" class="form-control" @keyup="calculateRate()" @click="calculateRate()" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Central de Riesgo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="risk_center" type="number" min="0" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Plazo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-hourglass"></i></span>
                                                                                <input v-model="number_quota" type="number" min="0" pattern="^[0-9]+" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorWarehouse">
                                                                            <label for="ap_paterno">Periodo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-calendar-plus-o"></i></span>
                                                                                <select   v-model="period_credit" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                    <option selected="selected" value="" >Seleccione</option>
                                                                                    <option value="DIARIO">Diario</option>
                                                                                    <option value="MENSUAL">Mensual</option>
                                                                                    <option value="ANUAL">Anual</option>
                                                                                </select>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                    
                                                                    <div class="col-md-2">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Días de Gracia:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-life-ring"></i></span>
                                                                                <input v-model="grace_day" type="number" min="0" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div  class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="ap_paterno" style="visibility: hidden">Mora:</label>
                                                                            <div class="checkbox">
                                                                                <label class="container">
                                                                                    <input type="checkbox" v-model="apply_mora">
                                                                                    <strong>Aplicar Mora</strong>
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>  
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <template v-if="listadox==1">
                                                            <div class="box-footer">
                                                                <div class="box-tools pull-right" style="right: -15px;">
                                                                    <div class="col-md-12" style="margin-top: 6px;">
                                                                        <label  class="col-md-8 control-label"><i class="fa fa-user-plus"></i> Agregar Aval</label>
                                                                        <div class="col-md-4" style="margin-top: -10px;">
                                                                            <div class="checkbox">
                                                                                <label class="switch" style="width: 70px;height: 18px;">
                                                                                    <input type="checkbox" v-model="add_aval">
                                                                                    <span class="slider round"></span>
                                                                                </label>
                                                                            </div> 
                                                                        </div> 
                                                                    </div> 
                                                                </div>
                                                            </div>
                                                            <div class="box-body" v-if="add_aval">  
                                                                <template v-if="listadox==1">                                                   
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputTypeDocAval">
                                                                                <label for="estado_civil">Tipo de Documento de Identidad:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-list-alt"></i></span>
                                                                                    <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_doc_aval">
                                                                                        <option selected="selected" value="">Seleccione</option>
                                                                                        <option v-for="datax in array_type_document" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputNroDocAval">
                                                                                <label for="dni">N° de Documento:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                                    <input maxlength="8" v-model="nro_doc_aval" type="text" @keyup.enter="getDataAval()"  class="form-control">
                                                                                    <span class="input-group-btn">
                                                                                        <button data-toggle="tooltip" title="Buscar en RENIEC" type="submit" @click="getDataAval()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_search_dni_aval"></i> BUSCAR</button>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                            
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputPaternalAval">
                                                                                <label for="ap_paterno">Apellido Paterno:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                    <input v-model="paternal_last_name_aval" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputMaternalAval">
                                                                                <label for="ap_materno">Apellido Materno:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                    <input v-model="maternal_last_name_aval" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputNamesAval">
                                                                                <label for="nombres">Nombres:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                    <input v-model="name_aval" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputSexAval">
                                                                                <label for="sexo">Sexo:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-transgender"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="sex_aval">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option value="M">Masculino</option>
                                                                                    <option value="F">Femenino</option>
                                                                                </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="edad">Fecha de Nacimiento:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-birthday-cake "></i></span>
                                                                                <date-picker v-model="birthdate_aval" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputMaritalStateAval">
                                                                                <label for="estado_civil">Estado Civíl:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-heart-o"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="marital_status_aval">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option value="SOLTERO">Soltero (a)</option>
                                                                                    <option value="CASADO">Casado (a)</option>
                                                                                    <option value="VIUDO">Viudo (a)</option>
                                                                                    <option value="SEPARADO">Separado (a)</option>
                                                                                </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="celular">Celular:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-mobile-phone"></i></span>
                                                                                    <input v-model="phone_aval" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="celular">Correo electrónico:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-envelope"></i></span>
                                                                                    <input v-model="email_aval" type="email" name="email" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputJobAval">
                                                                                <label for="type_business">Ocupación:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-briefcase"></i></span>
                                                                                    <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_job_aval">
                                                                                        <option selected="selected" value="">Seleccione</option>
                                                                                        <option v-for="datax in array_job" :key="datax.id" :value="datax.id">{{ datax.names }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputTypeBusinessAval">
                                                                                <label for="type_business">Tipo de Negocio:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-shopping-cart"></i></span>
                                                                                    <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_business_aval">
                                                                                        <option selected="selected" value="">Seleccione</option>
                                                                                        <option v-for="datax in array_type_business" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div> 
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputDepartmentAval">
                                                                                <label for="estado_civil">Departamento:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                    <select @change="getProvince($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="department_aval">
                                                                                        <option selected="selected" value="">Seleccione</option>
                                                                                        <option v-for="miselect in array_department" :selected="miselect.id == department_aval" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputProvinceAval">
                                                                                <label for="estado_civil">Provincia:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                    <select @change="getDistrict($event.target.value)" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="province_aval">
                                                                                        <option selected="selected" value="">Seleccione</option>
                                                                                        <option v-for="miselect in array_province" :selected="miselect.id == province_aval" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputDistrictAval">
                                                                                <label for="estado_civil">Distrito:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-map-marker"></i></span>
                                                                                    <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="district_aval">
                                                                                        <option selected="selected" value="">Seleccione</option>
                                                                                        <option v-for="miselect in array_district" :selected="miselect.id == district_aval" :key="miselect.id" :value="miselect.id">{{ miselect.name}}</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div v-bind:class="errorInputAddressAval">
                                                                                <label for="celular">Dirección:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-location-arrow"></i></span>
                                                                                    <input placeholder="Dirección domiciliaria" v-model="address_aval" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                     
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="celular">Referencias:</label>
                                                                                <div class="input-group">
                                                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-file-o"></i></span>
                                                                                    <textarea placeholder="Referencias de la dirección domiciliaria del cliente." v-model="reference_aval" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>                                                                                                                                                                                                          
                                                                    </div>
                                                                </template>
                                                                
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
                        <div class="box-footer">                            
                            <template v-if="listadox==1">
                                <div class="btn-group" style="float:right">
                                    <button type="button" @click="saveDataOnlyCustomer()" class="btn btn-save" data-toggle="tooltip" title="Guardar solo cliente">
                                        <i v-bind:class="icon_save"></i>&nbsp;GUARDAR CLIENTE
                                    </button>
                                    <button type="button" @click="saveData()" class="btn btn-save-pledge" data-toggle="tooltip" title="Guardar cliente y otorgar crédito">
                                        <i v-bind:class="icon_save_pledge"></i>&nbsp;GUARDAR / OTORGAR CRÉDITO
                                    </button>
                                </div>
                                                         
                                <button type="button" @click="clean_data()" class="btn btn-new" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Nuevo cliente">
                                    <i class="fa fa-certificate"></i>&nbsp;NUEVO CLIENTE
                                </button>
                            </template>
                            <template v-if="listadox==3">
                                <button type="button" @click="saveDetailCredit()" class="btn btn-save-pledge" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Agregar prenda a empeñar">
                                    <i class="fa fa-legal"></i>&nbsp;OTORGAR PRÉSTAMO
                                </button>
                                <button type="button" @click="calculateCreditoDetail()" class="btn btn-new" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Nueva prenda">
                                    <i class="fa fa-calculator"></i>&nbsp;CALCULAR
                                </button>
                            </template>
                        </div>             
                    </div> 
                    
                    <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalTicket}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                            <div class="col-md-12">
                                                <div class="sheet letter receipt">
                                                    <div class="content">
                                                        <h3 class="company-name ng-binding">TUMI DE ORO</h3>
                                                        <h4 class="branch-name ng-binding">Tingo María</h4>
                                                        <h5 class="long-date ng-binding">domingo, 20 de octubre de 2019</h5>
                                                        <p class="receipt-header ng-binding ng-hide" ng-show="template.header"></p>
                                                        <hr>
                                                        <div ui-view="" class="ng-scope">
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Contrato No. 1</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Cliente : {{name_customer}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Monto : S/ {{totalcapital}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Fecha de préstamo : {{date_init}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Fecha de vencimiento : {{date_end}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Interés : S/ {{totalInterest}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Periodo : {{period}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Plazo: {{term}}</div>
                                                            </div>
                                                            <div class="info-group ng-scope">
                                                                <div class="field">Prendas</div>
                                                                <div class="value">
                                                                    <ul class="item-list">
                                                                        <li v-for="(midata,index) in arrayCreditDetail" :key="index"  class="ng-binding ng-scope" style="">
                                                                            {{midata.guaranty}}
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <div class="balance ng-scope" ng-hide="isLoadingDetails">
                                                                <!--<h6 class="query-label">Historial</h6>-->
                                                                <table class="table table-condensed">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="date">Fecha</th>								
                                                                            <th>Monto</th>
                                                                            <th>Interés</th>
                                                                            <th class="text-right">Subtotal</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <!-- ngRepeat: operation in vm.operations --><tr ng-repeat="operation in vm.operations" class="ng-scope" style="">
                                                                        <td class="center date ng-binding">19/10/19 12:09</td>
                                                                        <td class="ng-binding">S/ 200</td>
                                                                        <td class="ng-binding">S/ 20</td>
                                                                        <td class="text-right ng-binding">S/ 2</td>
                                                                        </tr><!-- end ngRepeat: operation in vm.operations -->
                                                                    </tbody>
                                                                    <tfoot>
                                                                        <tr>
                                                                            <td class="date"></td>
                                                                            <td  ></td>
                                                                            <td><h4>Total</h4></td>
                                                                            <td class="text-right"> <h4 class="ng-binding">S/220</h4> </td>
                                                                        </tr>
                                                                    </tfoot>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <p class="receipt-footer ng-binding ng-hide" ng-show="template.footer"></p>
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
                <!-- Lista de Prendas-->
                <template v-if="listadox==3">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h1 class="box-title"><i class="fa fa-list"></i> Cronograma de Pago</h1>
                                <div class="box-tools pull-right">
                                    <span class="label label-success" style="margin-right:10px">TOTAL DE CUOTA: {{total_quota}}</span>
                                    <span class="label label-warning" style="margin-right:10px">TOTAL DE CAPITAL: {{total_amount}}</span>
                                    <span class="label label-danger">TOTAL DE INTERÉS: {{total_interest}}</span>
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                                </div>
                            </div>
                                
                            <div class="box-body table-responsive no-padding">
                                <table  class="table table-hover" style="font-size:12px">
                                    <thead style="background: rgb(32, 32, 32);color: #fff;">                                                                                   
                                        <tr>  
                                            <th style="vertical-align: middle;">#</th>
                                            <th style="vertical-align: middle; text-align: center;">FECHA DE VENCIMIENTO</th>
                                            <th style="vertical-align: middle; text-align: center;">CUOTA</th>
                                            <th style="vertical-align: middle; text-align: center;">CAPITAL</th>                                                                                        
                                            <th style="vertical-align: middle; text-align: center;">INTERÉS</th>
                                            <th style="vertical-align: middle; text-align: center;">SALDO PROYECTADO</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in arrayCreditDetail" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.date_expiration"></td>
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.quota"></td>  
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.capital"></td>  
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.interest"></td>  
                                            <td style="vertical-align: middle; text-align: center;" v-text="midata.saldo"></td>  
                                        </tr>                       
                                    </tbody>
                                </table>                                
                            </div>                            
                        </div>
                    </div>
                </template>
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
                array_job:[], id_job:'',array_job:[], id_job_aval:'',
                array_type_business:[],array_employee:[],
                id_employee:'',
                authUser:'',porcent: 50,
                listadox:1,
                listado:2,
                //fechas
                authUser:1,
                date_init: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                birthdate: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                date_init_payment: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                date_credit: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                birthdate_aval: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                code:'', name:'', paternal_last_name:'',maternal_last_name:'',
                phone:'',address:'',nro_doc:'', id_type_doc:'', email:'',                 
                department:'10', province:'92', district:'', id_type_business:'', 
                reference:'', sex:'', marital_status:'',

                code_aval:'', name_aval:'', paternal_last_name_aval:'',maternal_last_name_aval:'',
                phone_aval:'',address_aval:'',nro_doc_aval:'', id_type_doc_aval:'', email_aval:'', 
                department_aval:'10', province_aval:'92', district_aval:'', id_type_business_aval:'', 
                reference_aval:'', sex_aval:'', marital_status_aval:'',
                errorClase : 0,
                errors:{},

                errorInputCode:'form-group',errorInputTypeDoc:'form-group',
                errorInputNroDoc:'form-group',errorInputNames:'form-group',
                errorInputPaternal:'form-group', errorInputMaternal:'form-group',
                errorInputSex:'form-group', 
                errorInputMaritalState:'form-group', errorInputAddress:'form-group',
                errorInputJob:'form-group', errorInputTypeBusiness:'form-group',
                errorInputEmployee:'form-group', errorInputDepartment:'form-group',
                errorInputProvince:'form-group', errorInputDistrict:'form-group',

                errorInputTypeDocAval:'form-group',
                errorInputNroDocAval:'form-group',errorInputNamesAval:'form-group',
                errorInputPaternalAval:'form-group', errorInputMaternalAval:'form-group',
                errorInputSexAval:'form-group', 
                errorInputMaritalStateAval:'form-group', errorInputAddressAval:'form-group',
                errorInputJobAval:'form-group', errorInputTypeBusinessAval:'form-group',
                errorInputDepartmentAval:'form-group',
                errorInputProvinceAval:'form-group', errorInputDistrictAval:'form-group',

                errorInputcapital:'form-group',errorComboTipoProduco:'form-group',

                buscar:'',
                name_customer:'',capital:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_dependence:0,characteristic:'',tea:20,id_warehouse:'',
                id_person:0,id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
                period:'Mensual',arrayCreditDetail:[],licence_plate:'',
                errorTotalcapital:'form-group',errorcapital:'form-group',errorTerm:'form-group',
                errorTea:'form-group',errorInterested:'form-group',errorWarehouse:'form-group',
                errorFamilyProduct:'form-group',errorCharacteristic:'form-group',

                arrayFamilyProduct:[], array_department:[], array_province: [], array_district: [], array_type_document:[],array_code:[],
                totalcapital:0,totalInterest:0,modalTicket:0,idcustomer:-1,array_requirement : [],array_requirement_true : [], requirements:[],
                midatax:[], list:[],totalNumber:0, 
                id_customer_credit:-1, id_guarantor:-1,
                icon_title:'fa fa-plus', icon_save:'fa fa-save',
                icon_save_pledge:'fa fa-save', icon_edit:'fa fa-pencil',
                icon_search_dni:'fa fa-search', icon_search_dni_aval:'fa fa-search',
                icon_search_client:'fa fa-search', icon_generate:'fa fa-rotate-right',
                title:'Agregar Cliente', add_aval:0,
                capital:500, amount_admin:'', rate_admin:2, risk_center:2,interest_rate:10,
                grace_day:3, apply_mora:1, period_credit:'DIARIO', number_quota:26, 
                date_ultimate:'',total_cash:'', interest_rate_cash:'', quota:'',
                total_quota:'',total_amount:'',total_interest:'',

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
        created: function(){
            this.init();
        },
        methods : {
            
            print(id){
                var url='download_detail_credit?id='+id;
                //window.location.href = url;
                window.open(url, '_blank');  
            },
            calculateAmount(){
                let me = this;
                me.total_cash='';
                me.interest_rate_cash='';
                me.amount_admin=(Number(me.capital)* Number(me.rate_admin))/100;
                me.interest_rate_cash=(Number(me.capital)*Number(me.interest_rate))/100;
                me.total_cash=Number(me.capital)+ Number(me.interest_rate_cash);
                
            },
            calculateRate(){
                let me = this;
                me.rate_admin="";
                me.rate_admin=(Number(me.amount_admin)* 100)/Number(me.capital);
            },
            calculateInterestRateCash(){
                let me = this;
                me.interest_rate_cash=(Number(me.capital)*Number(me.interest_rate))/100;
                me.total_cash=Number(me.capital)+Number(me.interest_rate_cash);
            },
            generate_code(){
                let me = this;
                me.icon_generate='fa fa-refresh fa-spin';
                var url= '/generate_code';                
                axios.get(url).then(function (response) {
                    var respuesta= response.data; 
                    me.array_code= respuesta.datax;                   
                    for(var i=0;i<me.array_code.length;i++){
                        me.code=me.array_code[i].code; 
                    } 
                    me.icon_generate='fa fa-rotate-right';                	
                })
                .catch(function (error) {
                    console.log(error);
                });
            },            
            getTypeDocument(){
                let me=this;
               // me.listado=0;
                var url= 'get_type_document';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_type_document=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getTypeBusiness(){
                let me=this;
               // me.listado=0;
                var url= 'get_type_business';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_type_business=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getDepartment(){
                let me=this;
                me.listado=0;
                var url= 'get_department';
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_department=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getProvince(id_department){
                let me=this;
               // me.listado=0;
                var url= 'get_province?id='+ id_department;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_province=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            getDistrict(id_province){
                let me=this;
               // me.listado=0;
                var url= 'get_district?id='+ id_province;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        me.array_district=respuesta.datax;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            calculateCreditoDetail(){
                this.arrayCreditDetail=[];
                var date = new Date(moment(moment(this.date_init_payment, 'DD/MM/YYYY')).format('YYYY-MM-DD'));
                var saldo=Number(this.capital)+(Number(this.capital)* Number(this.interest_rate))/100;
                
                for( var i=0; i<this.number_quota;i++){
                    var date_day= date.getDay();
                    if(date_day==6){
                        date.setDate(date.getDate() + 2);
                    }else{
                        date.setDate(date.getDate() + 1);
                    }
                    var date_expiration=date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
                    var date_expiration_detail= date.getFullYear()+'-'+ (date.getMonth()+1) + '-' + date.getDate();
                    var date_expiration_t= date.getFullYear()+'-'+ (date.getMonth()+1) + '-' + date.getDate();

                    var quota=((Number(this.capital) + (Number(this.capital) * Number(this.interest_rate))/100)/Number(this.number_quota)).toFixed(1);
                    var result = quota*(Number(this.number_quota)-1);
                    result = (Number(this.capital) + (Number(this.capital) * Number(this.interest_rate))/100) - result;
                    if(i==1){
                        this.quota=quota;
                        console.log(this.quota);
                    }
                    if(i==(Number(this.number_quota)-1)){
                        quota=result.toFixed(1);
                    }

                    var capital=(Number(this.capital)/Number(this.number_quota)).toFixed(1);
                    var result = capital * (Number(this.number_quota) - 1);
                    result = Number(this.capital) - result;
                    if(i==(Number(this.number_quota)-1)){
                        capital=result.toFixed(1);
                    }

                    var interest=(((Number(this.capital)*Number(this.interest_rate))/100)/Number(this.number_quota)).toFixed(1);
                    var result = interest * (Number(this.number_quota) - 1);
                    result = ((Number(this.capital) * Number(this.interest_rate))/100) - result;
                    if(i==(Number(this.number_quota)-1)){
                        interest=result.toFixed(1);
                    }
                    saldo=saldo-quota;
                    if(i==(Number(this.number_quota)-1)){
                        saldo=0;                        
                    }
                    this.date_ultimate=date_expiration_t;
                    this.arrayCreditDetail.push({
                        id:i+1,
                        date_expiration: date_expiration,
                        date_expiration_detail: date_expiration_detail,
                        quota: quota,
                        capital: capital,
                        interest: interest,
                        saldo: saldo.toFixed(1)
                    });                    
                }
                this.total_quota=this.total_cash;
                this.total_amount=this.capital;
                this.total_interest=this.interest_rate_cash;
            },
            closeModal(){
                let me=this;
                me.modalTicket=0;
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
                for(var i=0;i<this.arrayCreditDetail.length;i++){
                    this.totalcapital =  Number(this.totalcapital)+Number(this.arrayCreditDetail[i].capital);
                    this.totalInterest =  Number(this.totalInterest)+Number(this.arrayCreditDetail[i].interest);
                }  
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
            addPledge(){
                if(this.validateDataPledge()){
                    return;
                }
                this.arrayCreditDetail.push(
                    {guaranty:this.guaranty.name,characteristic: this.characteristic,
                    note: this.note,
                    warehouse:this.id_warehouse.name,
                    licence_plate:this.licence_plate,serie:this.serie
                    ,capital:this.capital,interest:this.interest,
                    id_guaranty:this.guaranty.id,id_warehouse:this.id_warehouse.id
                    });
                this.sumTotal();
            },
            saveDetailCredit(){
                let me =this;
                this.calculateCreditoDetail();
                swal({
                    title: 'Esta seguro de guardar la informacion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ACEPTAR',
                    cancelButtonText: 'CANCELAR',confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                    reverseButtons: true
                }).then((result) =>{
                    if (result.value){                
                        axios.post('save_detail_credit',{     
                            'date_credit': moment(moment(this.date_credit, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'date_init_payment': moment(moment(this.date_init_payment, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'date_expiration': moment(this.date_ultimate).format('YYYY-MM-DD'),
                            'capital':this.capital,
                            'interest':this.interest_rate_cash,
                            'total':this.total_cash,
                            'rate_admin':this.rate_admin,
                            'amount_admin':this.amount_admin,
                            'quota':this.quota,
                            'number_quota':this.number_quota,
                            'period_credit':this.period_credit,
                            'grace_day':this.grace_day,
                            'risk_center':this.risk_center,
                            'apply_mora':this.apply_mora,
                            'id_customer':this.id_customer_credit,
                            'id_promoter':this.id_employee,
                            'array_credit_detail':this.arrayCreditDetail
                        }).then(function (response) {
                                me.print(response.data);
                                // me.clean_data();                                
                                // me.list_data(1);  
                                // me.icon_save='fa fa-save';
                                swal( 'Guardado!', 'El crédito ha sido otorgado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });                        
                    }else if(result.dismiss === swal.DismissReason.cancel) { 
                    }
                }) 
            },
            deletePledge : function (item) {
                swal({
                title: '¿Esta seguro de eliminar?',
                type: 'warning',showCancelButton: true,
                 
                confirmButtonText: 'ACEPTAR',cancelButtonText: 'CANCELAR',
                confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true
                }).then((result) => {
                if (result.value) {
                   // this.arrayActivity.push(item);
                    let index = this.arrayCreditDetail.indexOf(item)
                    this.arrayCreditDetail.splice(index, 1);
                     this.sumTotal();
                } else if ( result.dismiss === swal.DismissReason.cancel
                ) {} }) 
               
                
            },
            addDay(day){
                   
                   var fecha=new Date();
                        fecha.setDate(moment(moment(this.date_init, 'DD/MM/YYYY')).format('DD'));
                        fecha.setMonth(moment(moment(this.date_init, 'DD/MM/YYYY')).format('MM')-1);
                        fecha.setYear(moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY'));
                   var fechaoriginal = new Date();

                   fechaoriginal.setDate(moment(moment(this.date_init, 'DD/MM/YYYY')).format('DD'));
                    fechaoriginal.setMonth(moment(moment(this.date_init, 'DD/MM/YYYY')).format('MM')-1);
                    fechaoriginal.setYear(moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY'));
                    var contador=0;
                    var dayoriginal=day;
                    if(this.period=='Diario'){
                        //var addTime = i * 86400; //Tiempo en segundos
                        fecha.setSeconds(86400); //Añado el tiempo
                       for(var i=0;i<day;i++) 
                        {
                            if(fecha.getUTCDay()==0){
                                contador++;
                                day++;
                            }
                            fecha.setSeconds(86400);
                        }
                        contador=contador+dayoriginal;
                        fechaoriginal.setSeconds(contador*86400);
                   }
                   if(this.period=='Semanal'){
                         day=day*7;
                         fechaoriginal.setDate(fechaoriginal.getDate()+day);
                           
                   }
                    if(this.period=='Quincenal'){
                       day=day*15;
                         fechaoriginal.setDate(fechaoriginal.getDate()+day);
                   }
                    if(this.period=='Mensual'){
                      fechaoriginal.setMonth(fechaoriginal.getMonth()+day);
                      //comprobando domingo
                         if(fechaoriginal.getUTCDay()==0){
                                fechaoriginal.setSeconds(86400);
                         } 
                   }
                  
                var hoy= ''+fechaoriginal.getDate()+'/'+(Number(fechaoriginal.getMonth())+1)+'/'+fechaoriginal.getFullYear();
                return hoy;
                
            },  
            calculateTeabyTerm(){
                this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                this.interest=Number((this.interest).toFixed(1));
                //this.date_end='01-01-01';
                // var hoy= ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear();
                this.date_end=this.addDay(Number(this.term));
            },
            calculateTeabyInteres(){
                if(this.period=='Diario'){
                    this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                    this.interest=Number((this.interest).toFixed(1));
                }
                if(this.period=='Semanal'){
                    this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                    this.interest=Number((this.interest).toFixed(1));
                }
                if(this.period=='Quincenal'){
                    this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                    this.interest=Number((this.interest).toFixed(1));
                }
                if(this.period=='Mensual'){
                    this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                    this.interest=Number((this.interest).toFixed(1));
                }
                    
            },
            calculateTeabyPerioid(){
                if(this.period=='Diario'){
                    this.tea=0.67;
                    this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                        this.interest=Number((this.interest).toFixed(1));
                }
                if(this.period=='Semanal'){
                    this.tea=5;
                    this.interest=Number(this.capital)*(Number(this.tea)*Number(this.term))/100;
                    this.interest=Number((this.interest).toFixed(1));
                }
                    if(this.period=='Quincenal'){
                    this.tea=10;
                    this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                    this.interest=Number((this.interest).toFixed(1));
                }
                    if(this.period=='Mensual'){
                    this.tea=20;
                    this.interest= (Number(this.capital)*(Number(this.tea)*Number(this.term))/100);
                    this.interest=Number((this.interest).toFixed(1));
                }
                this.calculateTeabyTerm();
                    
            },
            getData(){//obteniendo datos de reniec                     
                if (this.nro_doc.length==8){   
                    let me=this;          
                    me.icon_search_dni='fa fa-spinner fa-spin';    
                    var url= 'get_customer_by_dni?nro_doc='+me.nro_doc;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        var aval=respuesta.aval;
                        if(respuesta.datax.length>0){
                            if(tipo=='bd'){
                                me.id=respuesta.datax[0].id;
                                me.id_guarantor=respuesta.datax[0].id_guarantor;
                                me.id_customer_credit=respuesta.datax[0].id_customer_credit;
                                me.code = respuesta.datax[0].code;
                                me.name = respuesta.datax[0].names;
                                me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                                me.maternal_last_name = respuesta.datax[0].maternal_last_name;
                                me.phone = respuesta.datax[0].phone;
                                me.address =respuesta.datax[0].address;
                                me.reference =respuesta.datax[0].reference;
                                me.sex =respuesta.datax[0].sex;
                                me.email =respuesta.datax[0].email;
                                me.department =respuesta.datax[0].id_department;
                                me.province =respuesta.datax[0].id_province;
                                me.district =respuesta.datax[0].id_district;
                                me.id_job =respuesta.datax[0].id_job;
                                me.id_employee =respuesta.datax[0].id_promoter;
                                me.id_type_business =respuesta.datax[0].id_type_business;
                                me.id_type_doc =respuesta.datax[0].id_type_document;
                                me.marital_status =respuesta.datax[0].marital_status;
                                me.birthdate=moment(respuesta.datax[0].birthdate).toDate();                               

                                me.nro_doc_aval = respuesta.datax[0].number_doc_aval;                                
                                me.name_aval = respuesta.datax[0].names_aval;                                
                                me.paternal_last_name_aval = respuesta.datax[0].paternal_last_name_aval;                                
                                me.maternal_last_name_aval = respuesta.datax[0].maternal_last_name_aval;
                                me.phone_aval = respuesta.datax[0].phone_aval;                                
                                me.address_aval =respuesta.datax[0].address_aval;
                                me.reference_aval =respuesta.datax[0].reference_aval;
                                me.sex_aval =respuesta.datax[0].sex_aval;
                                me.email_aval =respuesta.datax[0].email_aval;
                                me.department_aval =respuesta.datax[0].id_department_aval;
                                me.province_aval =respuesta.datax[0].id_province_aval;
                                me.district_aval =respuesta.datax[0].id_district_aval;
                                me.id_job_aval =respuesta.datax[0].id_job_aval;
                                me.id_type_business_aval =respuesta.datax[0].id_type_business_aval;
                                me.id_type_doc_aval =respuesta.datax[0].id_type_document_aval;
                                me.marital_status_aval =respuesta.datax[0].marital_status_aval;
                                me.birthdate_aval=moment(respuesta.datax[0].birthdate_aval).toDate();

                                me.array_requirement_true=respuesta.requirements_data;
                                //para los requisitos
                                for (var x=0;x<me.requirements.length;x++){
                                    for (var y=0;y<me.array_requirement_true.length;y++){
                                        if(me.requirements[x].id_type_requerement==me.array_requirement_true[y].id_type_document){
                                            me.requirements[x].check=true;    
                                        }
                                    } 
                                }
                            }else{
                                me.paternal_last_name = respuesta.datax[0];
                                me.maternal_last_name = respuesta.datax[2];
                                me.name = respuesta.datax[1];
                            }
                            me.icon_search_dni='fa fa-search';
                        }
                        
                        if(aval=='si'){
                            me.add_aval=1;
                            console.log(aval);
                                
                        }else{
                            me.add_aval=0;    
                            console.log(aval);                            
                        }   
                        
                        
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            getDataAval(){//obteniendo datos de reniec                     
                if (this.nro_doc_aval.length==8){   
                    let me=this;          
                    me.icon_search_dni_aval='fa fa-spinner fa-spin';    
                    var url= 'get_aval_by_dni?nro_doc_aval='+me.nro_doc_aval;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                        var tipo=respuesta.tipo;
                        if(respuesta.datax.length>0){
                            if(tipo=='person'){
                                console.log('algo aqui'+ respuesta.datax[0].id_guarantor);
                                me.id_guarantor=respuesta.datax[0].id_guarantor;
                                me.id_type_doc_aval =respuesta.datax[0].id_type_document_aval;
                                me.nro_doc_aval = respuesta.datax[0].number_doc_aval;                                
                                me.name_aval = respuesta.datax[0].names_aval;                                
                                me.paternal_last_name_aval = respuesta.datax[0].paternal_last_name_aval;                                
                                me.maternal_last_name_aval = respuesta.datax[0].maternal_last_name_aval;
                                me.phone_aval = respuesta.datax[0].phone_aval;                                
                                me.address_aval =respuesta.datax[0].address_aval;
                                me.reference_aval =respuesta.datax[0].reference_aval;
                                me.sex_aval =respuesta.datax[0].sex_aval;
                                me.email_aval =respuesta.datax[0].email_aval;
                                me.department_aval =respuesta.datax[0].id_department_aval;
                                me.province_aval =respuesta.datax[0].id_province_aval;
                                me.district_aval =respuesta.datax[0].id_district_aval;
                                me.id_job_aval =respuesta.datax[0].id_job_aval;
                                me.id_type_business_aval =respuesta.datax[0].id_type_business_aval;                                
                                me.marital_status_aval =respuesta.datax[0].marital_status_aval;
                                me.birthdate_aval=moment(respuesta.datax[0].birthdate_aval).toDate();
                            }else if(tipo=='bd'){
                                alert ('Esta persona ya es un garante.');
                            }
                            else{
                                me.paternal_last_name_aval = respuesta.datax[0];
                                me.name_aval = respuesta.datax[1];
                                me.maternal_last_name_aval = respuesta.datax[2];    
                            }
                            me.icon_search_dni_aval='fa fa-search';     
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            validarReniec(){
                     //obteniendo datos de reniec
                if (this.nro_doc.length==8) 
                {   
                    let me=this;              
                    var url= 'getDataCustomerBynro_doc?nro_doc='+me.nro_doc;
                    axios.get(url).then(function (response) {
                         var respuesta= response.data;
                         var tipo=respuesta.tipo;
                          if(respuesta.datax.length>0){
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.name = respuesta.datax[1];
                                    me.maternal_last_name = respuesta.datax[2];
    
                        }
                    
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    //obtener datos
                    
                }
            },
            validateData(){
                this.errors = {};
                this.errorClase=0;
                //input
                this.errorInputCode='form-group';
                this.errorInputTypeDoc='form-group';
                this.errorInputNroDoc='form-group';
                this.errorInputNames='form-group';
                this.errorInputPaternal='form-group';
                this.errorInputMaternal='form-group';
                this.errorInputSex='form-group';
                this.errorInputMaritalState='form-group';                
                this.errorInputAddress='form-group';
                this.errorInputJob='form-group';
                this.errorInputTypeBusiness='form-group';
                this.errorInputEmployee='form-group';
                this.errorInputDepartment='form-group';
                this.errorInputProvince='form-group';
                this.errorInputDistrict='form-group';

                if (!this.code){  
                    this.errorInputCode='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_type_doc){  
                    this.errorInputTypeDoc='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.nro_doc){  
                    this.errorInputNroDoc='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name){  
                    this.errorInputNames='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name){  
                    this.errorInputPaternal='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name){  
                    this.errorInputMaternal='form-group has-error';
                    this.errorClase = 1;
                }   
                if (!this.sex){  
                    this.errorInputSex='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.marital_status){  
                    this.errorInputMaritalState='form-group has-error';
                    this.errorClase = 1;
                }        
                if (!this.address){  
                    this.errorInputAddress='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_job){  
                    this.errorInputJob='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_type_business){  
                    this.errorInputTypeBusiness='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_employee){  
                    this.errorInputEmployee='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.department){  
                    this.errorInputDepartment='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.province){  
                    this.errorInputProvince='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.district){  
                    this.errorInputDistrict='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            }, 
            validateDataAval(){
                this.errors = {};
                this.errorClase=0;
                this.errorInputTypeDocAval='form-group';
                this.errorInputNroDocAval='form-group';
                this.errorInputNamesAval='form-group';
                this.errorInputPaternalAval='form-group';
                this.errorInputMaternalAval='form-group';
                this.errorInputSexAval='form-group';
                this.errorInputMaritalStateAval='form-group';                
                this.errorInputAddressAval='form-group';
                this.errorInputJobAval='form-group';
                this.errorInputTypeBusinessAval='form-group';
                this.errorInputDepartmentAval='form-group';
                this.errorInputProvinceAval='form-group';
                this.errorInputDistrictAval='form-group';

                if (!this.id_type_doc_aval){  
                    this.errorInputTypeDocAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.nro_doc_aval){  
                    this.errorInputNroDocAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name_aval){  
                    this.errorInputNamesAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name_aval){  
                    this.errorInputPaternalAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name_aval){  
                    this.errorInputMaternalAval='form-group has-error';
                    this.errorClase = 1;
                }   
                if (!this.sex_aval){  
                    this.errorInputSexAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.marital_status_aval){  
                    this.errorInputMaritalStateAval='form-group has-error';
                    this.errorClase = 1;
                }        
                if (!this.address_aval){  
                    this.errorInputAddressAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_job_aval){  
                    this.errorInputJobAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_type_business_aval){  
                    this.errorInputTypeBusinessAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.department_aval){  
                    this.errorInputDepartmentAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.province_aval){  
                    this.errorInputProvinceAval='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.district_aval){  
                    this.errorInputDistrictAval='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            }, 
            validateDataPledge(){
                this.errorClase=0;
                //input
                this.errorcapital='form-group';
                this.errorTerm='form-group';
                this.errorTea='form-group';
                this.errorInterested='form-group';
                this.errorWarehouse='form-group';
                this.errorFamilyProduct='form-group';
                this.errorCharacteristic='form-group';

                if (!this.capital) 
                {  
                    this.errorcapital='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.term) 
                {  
                    this.errorTerm='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.tea) 
                {  
                    this.errorTea='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.interest) 
                {  
                    this.errorInterested='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.id_warehouse) 
                {  
                    this.errorWarehouse='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.guaranty) 
                {  
                    this.errorFamilyProduct='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.characteristic) 
                {  
                    this.errorCharacteristic='form-group has-error';
                    this.errorClase = 1;
                }
                
                return this.errorClase;
            },      
          
            cambiarPagina(page){
				let me = this;				
				me.pagination.current_page = page;
                //me.listado=1;
				me.list_data(page);
                
            },
            // edit_data(id){
            //     let me=this;
            //     me.listado=2;
            //     me.clean_data();
            //     me.getTypeDocument();
            //     me.icon_edit='fa fa-spinner fa-spin';
            //     var url= 'edit_data?id='+id;
            //     me.id_customer_credit=id;
            //     axios.get(url).then(function (response) {
            //         var respuesta= response.data;
            //         me.id=respuesta.datax[0].id;
            //         me.nro_doc = respuesta.datax[0].number_doc;
            //         me.name = respuesta.datax[0].names;
            //         me.paternal_last_name = respuesta.datax[0].paternal_last_name;
            //         me.maternal_last_name = respuesta.datax[0].maternal_last_name;
            //         me.phone = respuesta.datax[0].phone;
            //         me.address =respuesta.datax[0].address;
            //         me.sex =respuesta.datax[0].sex;
            //         me.reference =respuesta.datax[0].reference;
            //         me.code =respuesta.datax[0].code;
            //         me.email =respuesta.datax[0].email;
            //         me.district =respuesta.datax[0].id_district;
            //         me.province =respuesta.datax[0].id_province;
            //         me.department =respuesta.datax[0].id_department;
            //         me.id_type_doc =respuesta.datax[0].id_type_document;
            //         me.marital_status =respuesta.datax[0].marital_status;
            //         me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
            //         me.validateData();         
            //         me.icon_edit='fa fa-pencil';       
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
                              
            // },
            saveDataOnlyCustomer(){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente
                let me = this;
                if(this.add_aval==1){
                    if (this.validateDataAval()){
                        return;
                    }
                }
                if (this.validateData()){
                    return;
                }
                me.icon_save='fa fa-spinner fa-spin';                
                swal({
                    title: 'Esta seguro de guardar la informacion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'ACEPTAR',
                    cancelButtonText: 'CANCELAR',confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                    reverseButtons: true
                }).then((result) =>{
                    if (result.value){                
                        axios.post('save_customer_credit',{
                            'nro_doc':this.nro_doc,'name':this.name,
                            'paternal_last_name':this.paternal_last_name,
                            'maternal_last_name':this.maternal_last_name,
                            'phone':this.phone,'address':this.address, 
                            'id': this.id,'sex': this.sex,
                            'code': this.code,'id_type_document': this.id_type_doc,
                            'marital_status': this.marital_status,
                            'email': this.email,'reference': this.reference,
                            'id_district': this.district,
                            'birthdate' : moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'id_customer_credit':this.id_customer_credit,
                            'id_job':this.id_job, 'id_type_business':this.id_type_business,
                            'id_employee':this.id_employee,

                            'nro_doc_aval':this.nro_doc_aval,'name_aval':this.name_aval,
                            'paternal_last_name_aval':this.paternal_last_name_aval,
                            'maternal_last_name_aval':this.maternal_last_name_aval,
                            'phone_aval':this.phone_aval,'address_aval':this.address_aval, 
                            'id_guarantor': this.id_guarantor,'sex_aval': this.sex_aval,
                            'id_type_document_aval': this.id_type_doc_aval,
                            'marital_status_aval': this.marital_status_aval,
                            'email_aval': this.email_aval,'reference_aval': this.reference_aval,
                            'id_district_aval': this.district_aval,
                            'birthdate_aval' : moment(moment(this.birthdate_aval, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'id_job_aval':this.id_job_aval, 'id_type_business_aval':this.id_type_business_aval,                            
                            'requirements':this.requirements
                        }).then(function (response) {
                                me.clean_data();                                
                                // me.list_data(1);  
                                me.icon_save='fa fa-save';
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });                        
                    }else if(result.dismiss === swal.DismissReason.cancel) { 
                    }
                }) 
            },
            saveData(){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente  
                this.visible=0;
                let me = this;
                me.icon_save_pledge='fa fa-spinner fa-spin';
                if (this.validateData()){
                    return;
                }
                
                swal({
                    title: 'Esta seguro de guardar la informacion?',
                    type: 'warning',
                    showCancelButton: true,
                   confirmButtonText: 'ACEPTAR',
                    cancelButtonText: 'CANCELAR',confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                    reverseButtons: true
                }).then((result) =>{
                    if (result.value){                
                        axios.post('save_customer_credit',{
                            'nro_doc':this.nro_doc,'name':this.name,
                            'paternal_last_name':this.paternal_last_name,
                            'maternal_last_name':this.maternal_last_name,
                            'phone':this.phone,'address':this.address, 
                            'id': this.id,'sex': this.sex,
                            'code': this.code,'id_type_document': this.id_type_doc,
                            'marital_status': this.marital_status,
                            'email': this.email,'reference': this.reference,
                            'id_district': this.district,
                            'birthdate' : moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'id_customer_credit':this.id_customer_credit,
                            'id_job':this.id_job, 'id_type_business':this.id_type_business,
                            'id_employee':this.id_employee,

                            'nro_doc_aval':this.nro_doc_aval,'name_aval':this.name_aval,
                            'paternal_last_name_aval':this.paternal_last_name_aval,
                            'maternal_last_name_aval':this.maternal_last_name_aval,
                            'phone_aval':this.phone_aval,'address_aval':this.address_aval, 
                            'id_guarantor': this.id_guarantor,'sex_aval': this.sex_aval,
                            'id_type_document_aval': this.id_type_doc_aval,
                            'marital_status_aval': this.marital_status_aval,
                            'email_aval': this.email_aval,'reference_aval': this.reference_aval,
                            'id_district_aval': this.district_aval,
                            'birthdate_aval' : moment(moment(this.birthdate_aval, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                            'id_job_aval':this.id_job_aval, 'id_type_business_aval':this.id_type_business_aval,                            
                            'requirements':this.requirements                    
                        }).then(function (response) {
                                me.midatax=[];                             
                                me.midatax.push({id:response.data, names: me.name, paternal_last_name: me.paternal_last_name, maternal_last_name:me.maternal_last_name});       
                                me.give_credit(me.midatax[0]);
                                me.icon_save_pledge='fa fa-save';
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });

                    }else if(result.dismiss === swal.DismissReason.cancel) {                    
                    }
                }) 
            },
            eliminar(id){
                swal({
                title: '¿Estas seguro de eliminar?',
                text: '¡No podrás revertir esto!',
                type: 'warning',
                showCancelButton: true,
                
                
                confirmButtonText: 'ACEPTAR',
                cancelButtonText: 'CANCELAR',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                    let me = this;
                    axios.post('deleteCustomerCredit',{
                        'id': id

                    }).then(function (response) {
                    me.listado=1;
                    me.list_data(1);
                    swal( 'Eliminado!', 'Su cliente ha sido eliminado.', 'success' ); 
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            give_credit(midata){
                let me=this;
                me.listadox=3;
                this.visible=0;
                this.id_customer_credit=midata.id;
                this.name_customer=midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name;
                this.nro_doc=midata.number_doc;
            },
            addCustomer(){
                let me=this;
                me.listado=2;
            },
            volver(){
                let me=this;
                me.clean_data();
                me.listadox=1;
                me.listado=2;
                me.visible=1;
                me.list_data(1);
            },
            descargar(buscar){               
                var url= '/downloadprogram?buscar='+buscar;
                window.location.href = url;
            },
            clean_data(){
               this.errorInputNroDoc='form-group';
                this.errorInputNames='form-group';
                this.errors = {};
                this.errors.nro_doc="";
                this.errors.name="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                this.errors.code="";
                this.errors.address="";
                this.nro_doc="";
                this.name="";
                this.paternal_last_name="";
                this.maternal_last_name="";
                this.phone="";
                this.address="";
                this.reference="";
                this.code="";
                this.id_type_doc="";
                this.department="";
                this.province="";
                this.district="";
                this.sex="";
                this.email="";
                this.birthdate="";
                this.id_parent="";
                this.guaranty="";
                this.id_warehouse="";
                this.note="";
                this.id=-1;
                
                this.idcustomer=0,
                this.period="Mensual";
                this.licence_plate="";
                this.serie="";
                this.term=1;
                this.tea=10,
                this.totalcapital=0; 
                this.arrayCreditDetail=[];     
                this.totalcapital=0;
                this.totalInterest=0;     
                this.characteristic="";
                this.serie="";
                this.licence_plate="";
                this.mounted=0;
                this.capital=0;
                this.term=1;
                this.interest=0;
                
            },
            // list_data(page){
            //     let me=this;                      
            //     me.listado=0;
            //     me.getDepartment();
            //     me.getTypeDocument();
            //     var url= 'getListCustomerCredit?buscar='+me.buscar+'&page='+page;
            //     axios.get(url).then(function (response) {
            //         var respuesta= response.data;
            //         me.list=respuesta.datax;
            //         me.pagination= respuesta.pagination;                     
            //         me.listado=2;
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
               
            // },
            getTypeRequirement(){
                let me=this;
                var url= 'get_type_requirement';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_requirement = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },
            getJob(){
                let me=this;
                var url= 'get_job';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_job = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },
            getEmployee(){
                let me=this;
                var url= 'get_employee';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.array_employee = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },

            init: function() {
            //cargar actividades
                let me=this;  
                me.requirements=[];        
                var url= 'get_type_requirement';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var lista=respuesta.datax;
                    for(var i=0; i < lista.length; i++){
                       me.requirements.push({ check:false,id_type_requerement: lista[i].id_type_requerement});
                       console.log(me.requirements);
                      
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           
        },
        
        mounted() {
            this.listadox=3;
        //    this.lista_add_client();
        //    this.list_data(1);
            this.getDepartment();
            this.getTypeBusiness();
            this.getJob();
            this.getEmployee();
            this.getTypeDocument();
            this.getTypeRequirement();            
            this.calculateTeabyTerm();
            this.getProvince(10);
            this.getDistrict(92);
            this.calculateAmount(2);
            this.calculateInterestRateCash();
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

