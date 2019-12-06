<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Clientes
              <small>Registro</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Clientes</li>
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
                                                                        <div v-bind:class="errorInputActivity5">
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
                                                                        <div class="form-group">
                                                                            <label for="estado_civil">Tipo de Documento de Identidad:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_doc">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_document" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputActivity">
                                                                            <label for="dni">N° de Documento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                                <input maxlength="8" v-model="nro_doc" type="text" @keyup="validarData()" @keyup.enter="getData()"  class="form-control">
                                                                                <span class="input-group-btn">
                                                                                    <button data-toggle="tooltip" title="Buscar en RENIEC" type="submit" @click="getData()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_search_dni"></i> BUSCAR</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                            
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputActivity3">
                                                                            <label for="ap_paterno">Apellido Paterno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="paternal_last_name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputActivity4">
                                                                            <label for="ap_materno">Apellido Materno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="maternal_last_name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputActivity2">
                                                                            <label for="nombres">Nombres:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                                <input v-model="phone" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
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
                                                                        <div class="form-group">
                                                                            <label for="type_business">Ocupación:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-briefcase"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_job">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_job" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="type_business">Tipo de Negocio:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-shopping-cart"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_business">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_business" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                        <div v-bind:class="errorInputActivity6">
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
                                                                <!-- Emprender -->
                                                            <template v-if="listadox==3">
                                                                <div class="row">  
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Cliente:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input disabled v-model="name_customer" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="type_product">Tipo de Producto:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-th-large"></i></span>
                                                                                <select  @change="getFamilyProduct($event.target.value)" v-model="id_parent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                    <option selected="selected" value="" >Ninguno</option>
                                                                                    <option v-for="datax in arrayTypeProduct" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Familia del Producto:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-th"></i></span>
                                                                                <select  v-model="guaranty" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                    <option selected="selected" value="" >Ninguno</option>
                                                                                    <option v-for="datax in arrayFamilyProduct" :key="datax.id" :value="datax">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorWarehouse">
                                                                            <label for="ap_paterno">Almacen:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>
                                                                                <select   v-model="id_warehouse" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                    <option selected="selected" value="" >Seleccione</option>
                                                                                    <option v-for="datax in arrayWarehouse" :key="datax.id" :value="datax">{{ datax.name }}</option>
                                                                                </select>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Características:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-list-ul"></i></span>
                                                                                <input v-model="characteristic" type="text" class="form-control" placeholder="Caracteristicas" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="date_init">Fecha de Inicio:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker @dp-change="calculateTeabyTerm" v-model="date_init" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="date_end">Fecha Final:</label>
                                                                            <div class="input-group">
                                                                                <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                </div>
                                                                                <date-picker disabled v-model="date_end" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                     
                                                                </div> 

                                                                <div class="row">  
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Placa:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-cc-jcb"></i></span>
                                                                                <input v-model="licence_plate" type="text" class="form-control" placeholder="SM-1688" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Serie:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-barcode"></i></span>
                                                                                <input v-model="serie" type="text" class="form-control" placeholder="123566532" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Periodo:</label>
                                                                                <div class="input-group">
                                                                                    <div class="col-md-1 ">
                                                                                        <label class="container">Diario
                                                                                        <input v-on:change="calculateTeabyPerioid" v-model="period" type="radio" value="Diario" name="optradio">
                                                                                        <span class="radiochevere"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-1 ">
                                                                                        <label class="container">Semanal
                                                                                        <input v-on:change="calculateTeabyPerioid" v-model="period" type="radio" value="Semanal" name="optradio">
                                                                                        <span class="radiochevere"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <label class="container">Quincenal
                                                                                        <input v-on:change="calculateTeabyPerioid" v-model="period" type="radio" value="Quincenal" name="optradio">
                                                                                        <span class="radiochevere"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <label class="container">Mensual
                                                                                        <input v-on:change="calculateTeabyPerioid" v-model="period" type="radio" value="Mensual" name="optradio">
                                                                                        <span class="radiochevere"></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>                                                             
                                                                    <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorcapital">
                                                                            <label for="nombres">Préstamo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-money"></i></span>
                                                                                <input @keyup="calculateTeabyPerioid" v-model="capital" type="text" class="form-control" placeholder="S/" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorTerm">
                                                                            <label for="nombres">Plazo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-hourglass-start"></i></span>
                                                                                <input @change="calculateTeabyTerm" @keyup="calculateTeabyTerm" v-model="term" type="number" class="form-control" placeholder="1" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorTea">
                                                                            <label for="nombres">TEA %:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar-o"></i></span>
                                                                                <input @keyup="calculateTeabyInteres()" v-model="tea" type="text" class="form-control" placeholder="Porcentaje" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInterested">
                                                                            <label for="nombres">Interés:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-arrow-up"></i></span>
                                                                                <input disabled v-model="interest" type="text" class="form-control" placeholder="Interes" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Observaciones:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-indent"></i></span>
                                                                                <textarea v-model="note" type="text" class="form-control" placeholder="Describa alguna observación que crea conveniente registrarla." style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;text-transform:uppercase;"></textarea>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </div>
                                                            </template>
                                                        </div>
                                                        <div class="box-footer">
                                                            <div class="box-tools pull-right" style="right: -15px;">
                                                                <div class="col-md-12" style="margin-top: 6px;">
                                                                    <label  class="col-md-8 control-label"><i class="fa fa-user-plus"></i> Agregar Aval</label>
                                                                    <div class="col-md-4" style="margin-top: -10px;">
                                                                        <div class="checkbox">
                                                                            <label class="switch" style="width: 62px;height: 18px;">
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
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputActivity5">
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
                                                                        <div class="form-group">
                                                                            <label for="estado_civil">Tipo de Documento de Identidad:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_doc">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_document" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div v-bind:class="errorInputActivity">
                                                                            <label for="dni">N° de Documento:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                                <input maxlength="8" v-model="nro_doc" type="text" @keyup="validarData()" @keyup.enter="getData()"  class="form-control">
                                                                                <span class="input-group-btn">
                                                                                    <button data-toggle="tooltip" title="Buscar en RENIEC" type="submit" @click="getData()" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_search_dni"></i> BUSCAR</button>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                            
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputActivity3">
                                                                            <label for="ap_paterno">Apellido Paterno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="paternal_last_name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputActivity4">
                                                                            <label for="ap_materno">Apellido Materno:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="maternal_last_name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorInputActivity2">
                                                                            <label for="nombres">Nombres:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input v-model="name" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                                <input v-model="phone" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
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
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                        <div class="form-group">
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
                                                                        <div v-bind:class="errorInputActivity6">
                                                                            <label for="celular">Dirección:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-location-arrow"></i></span>
                                                                                <input placeholder="Dirección domiciliaria" v-model="address" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                     
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="celular">Referencias:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-file-o"></i></span>
                                                                                <input placeholder="Referencias de la dirección domiciliaria del cliente." v-model="reference" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="type_business">Ocupación:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-briefcase"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_job">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_job" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="type_business">Tipo de Negocio:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-shopping-cart"></i></span>
                                                                                <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="id_type_business">
                                                                                    <option selected="selected" value="">Seleccione</option>
                                                                                    <option v-for="datax in array_type_business" :key="datax.id" :value="datax.id">{{ datax.name }}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                                                                                                                                                                           
                                                                </div>
                                                            </template>
                                                                <!-- Emprender -->
                                                            <template v-if="listadox==3">
                                                                <div class="row">  
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="nombres">Cliente:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                                <input disabled v-model="name_customer" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="type_product">Gastos Administrativos:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="id_parent" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Porcentaje:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">%</span>
                                                                                <input v-model="id_parent" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Central de Riesgo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="id_parent" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorFamilyProduct">
                                                                            <label for="family_produc">Monto:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                                                <input v-model="id_parent" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
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
                                                                                <date-picker @dp-change="calculateTeabyTerm" v-model="date_init" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Taza:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">%</span>
                                                                                <input v-model="characteristic" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorCharacteristic">
                                                                            <label for="nombres">Plazo:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar-check-o"></i></span>
                                                                                <input v-model="characteristic" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px; text-transform:uppercase;">  
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div v-bind:class="errorWarehouse">
                                                                            <label for="ap_paterno">Almacen:</label>
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-archive"></i></span>
                                                                                <select   v-model="id_warehouse" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                                    <option selected="selected" value="" >Seleccione</option>
                                                                                    <option v-for="datax in arrayWarehouse" :key="datax.id" :value="datax">{{ datax.name }}</option>
                                                                                </select>
                                                                                
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
                        <div class="box-footer">
                            <div class="btn-group" style="float:right">
                                <template v-if="listadox==1">
                                    <button type="button" @click="save_data_only_client()" class="btn btn-save" data-toggle="tooltip" title="Guardar solo cliente">
                                        <i v-bind:class="icon_save"></i>&nbsp;GUARDAR CLIENTE
                                    </button>
                                    <button type="button" @click="save_data()" class="btn btn-save-pledge" data-toggle="tooltip" title="Guardar cliente y empeñar">
                                        <i v-bind:class="icon_save_pledge"></i>&nbsp;GUARDAR / EMPEÑAR
                                    </button>
                                </template>  
                                <template v-if="listadox==3">
                                    <button type="button" @click="addPledge()" class="btn btn-save-pledge" data-toggle="tooltip" title="Agregar prenda a empeñar">
                                        <i class="fa fa-legal"></i>&nbsp;OTORGAR PRÉSTAMO
                                    </button>
                                </template>                           
                            </div>
                            <template v-if="listadox==1">
                                <button type="button" @click="clean_data()" class="btn btn-new" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Nuevo cliente">
                                    <i class="fa fa-certificate"></i>&nbsp;NUEVO CLIENTE
                                </button>
                            </template>
                            <template v-if="listadox==3">
                                <button type="button" @click="clean_data()" class="btn btn-new" style="float:right; margin-right: 10px;" data-toggle="tooltip" title="Nueva prenda">
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
                                                                        <li v-for="(midata,index) in arrayDetailPledge" :key="index"  class="ng-binding ng-scope" style="">
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
                                <h1 class="box-title"><i class="fa fa-list"></i> Lista de Prendas</h1>
                                <div class="box-tools pull-right">
                                    <!-- <span class="label label-success">TOTAL DE REGISTROS:</span> -->
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
                                            <th style="vertical-align: middle;">BIEN DE GARANTÍA</th>
                                            <th style="vertical-align: middle;">CARACTERÍSTICAS</th>
                                            <th style="vertical-align: middle;">ALMACEN</th>                                                                                        
                                            <th style="vertical-align: middle;">PLACA</th>
                                            <th style="vertical-align: middle;">SERIE</th>
                                            <th style="vertical-align: middle;">MONTO</th>
                                            <th style="vertical-align: middle;">INTERES</th>
                                            <th style="vertical-align: middle;">TOTAL</th>
                                            <th style="vertical-align: middle;">OBSERVACIONES</th>
                                            <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr v-for="(midata,index) in arrayDetailPledge" :key="index" >
                                            <td style="vertical-align: middle;" >{{(index+1)}}</td>
                                            <td style="vertical-align: middle;" v-text="midata.guaranty"></td>
                                            <td style="vertical-align: middle;" v-text="midata.characteristic"></td>                                        
                                            <td style="vertical-align: middle;" v-text="midata.warehouse"></td>
                                            <td style="vertical-align: middle;" v-text="midata.licence_plate"></td>
                                            <td style="vertical-align: middle;" v-text="midata.serie"></td>
                                            <td style="vertical-align: middle;" v-text="midata.capital"></td>
                                            <td style="vertical-align: middle;" v-text="midata.interest"></td>
                                            <td style="vertical-align: middle;" v-text="Number(midata.capital)+Number(midata.interest)"></td>
                                            <td style="vertical-align: middle;" v-text="midata.note"></td>
                                            <td style="vertical-align: middle;text-align: center;"> 
                                            
                                                <button title="Eliminar" type="button" @click="deletePledge(midata)" class="btn btn-eliminar btn-sm">
                                                <i class="fa fa-trash"></i>
                                                </button>                                       
                                            </td> 
                                        </tr>                       
                                    </tbody>
                                </table>                                
                            </div>
                            
                            <div class="box-footer">
                                <div class="row">
                                    <div class="col-lg-6 col-xs-9">
                                    </div>
                                    <div class="col-lg-6 col-xs-9">
                                        <h3>Detalle del empeño:</h3>
                                        <div class="table-responsive no-border">
                                            <table class="table">
                                                <tbody>
                                                    <tr id="row_sub_total_ventas">
                                                        <th>Préstamo:</th>
                                                        <td class="text-right">
                                                            <span class="simbolo_moneda">S/.</span>
                                                            <span id="sub_total_ventas">{{totalcapital}}</span>
                                                            <input type="hidden" name="txt_sub_total_ventas" id="txt_sub_total_ventas" value="0">
                                                        </td>
                                                    </tr>
                                                        
                                                    <tr id="row_gravada_documento">                                                        
                                                        <th>Interés:</th>
                                                        <td class="text-right">
                                                            <span class="simbolo_moneda">S/.</span>
                                                            <span id="gravada_documento">{{totalInterest}}</span>
                                                            <input type="hidden" name="txt_gravada_comprobante" id="txt_gravada_comprobante" value="0">
                                                        </td>
                                                    </tr>
                                                    <tr id="row_gravada_documento">                                                        
                                                        <th>Total a cobrar::</th>
                                                        <td class="text-right">
                                                            <span class="simbolo_moneda">S/.</span>
                                                            <span id="gravada_documento">{{Number(totalcapital)+Number(totalInterest)}}</span>
                                                            <input type="hidden" name="txt_gravada_comprobante" id="txt_gravada_comprobante" value="0">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                     
                                        <button type="button" @click="savePledge()" class="btn btn-save" style="width: 100%;">
                                            <i class="fa fa-save"></i>&nbsp;GUARDAR EMPEÑO
                                        </button>
                                    </div>
                                    <br>
                                </div>
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
                
                id_parent:'',visible:1,array_job:[], id_job:'',
                array_type_business:[],id_type_business:'', array_employee:[],
                id_employee:'',
                authUser:'',porcent: 50,
                listadox:1,
                listado:2,
                //fechas
                authUser:1,
                date_init: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
                birthdate: ''+new Date().getDate()+'/'+(Number(new Date().getMonth())+1)+'/'+new Date().getFullYear(),
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
                code:'', name:'',id:-1,paternal_last_name:'',maternal_last_name:'',phone:'',address:'',nro_doc:'',
                id_type_doc:'', email:'', department:'10', province:'92', district:'', reference:'',
                errorClase : 0,
                errors:{},
                errorInputActivity:'form-group',errorInputActivity2:'form-group',
                errorInputActivity3:'form-group', errorInputActivity4:'form-group',
                errorInputActivity5:'form-group', errorInputActivity6:'form-group',
                errorInputcapital:'form-group',errorComboTipoProduco:'form-group',
                buscar:'',sex:'', marital_status:'',
                name_customer:'',capital:0,date_end:'',interest:0,
                term:1,
                total:0,guaranty:'',id_dependence:0,characteristic:'',tea:20,id_warehouse:'',
                id_person:0,id_pledge:0,quantity:1,licence_plate:'',serie:'',note:'',capital:0,
                period:'Mensual',arrayDetailPledge:[],licence_plate:'',
                errorTotalcapital:'form-group',errorcapital:'form-group',errorTerm:'form-group',
                errorTea:'form-group',errorInterested:'form-group',errorWarehouse:'form-group',
                errorFamilyProduct:'form-group',errorCharacteristic:'form-group',

                arrayTypeProduct:[],arrayFamilyProduct:[],arrayWarehouse:[], array_department:[], array_province: [], array_district: [], array_type_document:[],array_code:[],
                totalcapital:0,totalInterest:0,modalTicket:0,idcustomer:-1,array_requirement : [], requirements:[],
                midatax:[], list:[],totalNumber:0, id_customer_credit:-1,
                icon_title:'fa fa-plus', icon_save:'fa fa-save',icon_save_pledge:'fa fa-save', icon_edit:'fa fa-pencil',
                icon_search_dni:'fa fa-search', icon_search_client:'fa fa-search', icon_generate:'fa fa-rotate-right',
                title:'Agregar Cliente', add_aval:0
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
               // me.listado=0;
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
            imprimirElemento(){
                 /* var ventana = window.open('', 'PRINT', 'height=600,width=800');
                    ventana.document.write('<html><head><title>' + document.title + '</title>');
                    ventana.document.write('</head><body >');
                    ventana.document.write("Hola");
                    ventana.document.write('</body></html>');
                    ventana.document.close();
                    ventana.focus();*/
                    window.print();
                   // ventana.close();
                   // return true;
                    //ola
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
                            'idcustomerpledge':this.id_customer_credit,
                            'date_init':moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD') ,
                            'date_end':moment(moment(this.date_end, 'DD/MM/YYYY')).format('YYYY-MM-DD') ,
                            'period':this.period,'licence_plate':this.licence_plate,
                            'serie':this.serie,
                            'term': this.term,'tea': this.tea,'interest': this.totalInterest,
                            'capital':this.totalcapital,'total':Number(this.totalcapital)+Number(this.totalInterest),
                            'detail_pledge':this.arrayDetailPledge,
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

                this.arrayDetailPledge.push(
                    {guaranty:this.guaranty.name,characteristic: this.characteristic,
                    note: this.note,
                    warehouse:this.id_warehouse.name,
                    licence_plate:this.licence_plate,serie:this.serie
                    ,capital:this.capital,interest:this.interest,
                    id_guaranty:this.guaranty.id,id_warehouse:this.id_warehouse.id
                    });
                this.sumTotal();
            },
            deletePledge : function (item) {
                swal({
                title: '¿Esta seguro de eliminar?',
                type: 'warning',showCancelButton: true,
                confirmButtonColor: '#3085d6', cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,reverseButtons: true
                }).then((result) => {
                if (result.value) {
                   // this.arrayActivity.push(item);
                    let index = this.arrayDetailPledge.indexOf(item)
                    this.arrayDetailPledge.splice(index, 1);
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
            getData(){
                     //obteniendo datos de reniec
                if (this.nro_doc.length==8){   
                    let me=this;          
                    me.icon_search_dni='fa fa-spinner fa-spin';    
                    var url= 'getDataCustomerBynro_doc?nro_doc='+me.nro_doc;
                    axios.get(url).then(function (response) {
                         var respuesta= response.data;
                         var tipo=respuesta.tipo;
                          if(respuesta.datax.length>0){
                            if(tipo=='bd'){
                                    me.id=respuesta.datax[0].id;
                                    me.name = respuesta.datax[0].names;
                                    me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                                    me.maternal_last_name = respuesta.datax[0].maternal_last_name;
                                    me.phone = respuesta.datax[0].phone;
                                    me.address =respuesta.datax[0].address;
                                    me.sex =respuesta.datax[0].sex;
                                    me.marital_status =respuesta.datax[0].marital_status;
                                    me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
                                    me.validarData();

                                    }
                                    else{
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.name = respuesta.datax[1];

                                    me.maternal_last_name = respuesta.datax[2];
                                    me.validarData();
                                    }
                                    me.icon_search_dni='fa fa-search'; 
    
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
            validarData(){
                this.errors = {};
                this.errorClase=0;
                //input
                this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errorInputActivity3='form-group';
                this.errorInputActivity4='form-group';
                this.errorInputActivity5='form-group';
                this.errorInputActivity6='form-group';
                this.errorInputcapital='form-group';
                this.errorComboTipoProduco='form-group';
                this.errorTotalcapital='form-group';


                if (!this.nro_doc) 
                {  
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {  
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name) 
                {  
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name) 
                {  
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.code) 
                {  
                    this.errorInputActivity5='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.address) 
                {  
                    this.errorInputActivity6='form-group has-error';
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
            //         me.validarData();         
            //         me.icon_edit='fa fa-pencil';       
            //     })
            //     .catch(function (error) {
            //         console.log(error);
            //     });
                              
            // },
            save_data_only_client(){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente  
                this.visible=0;
                let me = this;
                me.icon_save='fa fa-spinner fa-spin';
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
                }).then((result) =>{
                    if (result.value){                
                        axios.post('saveCustomerCredit',{
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
                            'id_employee':this.id_employee
                        }).then(function (response) {
                                me.clean_data();                                
                                me.list_data(1);  
                                me.visible=1;
                                me.icon_save='fa fa-save';
                                swal( 'Guardado!', 'El registro ha sido guardado con éxito.', 'success' ); 
                        }).catch(function (error) {
                            console.log(error);
                        });

                    }else if(result.dismiss === swal.DismissReason.cancel) {                    
                    }
                }) 
            },
            save_data(){
                //val =1 guardar y empeñar
                //val = 0 solo registrar cliente  
                this.visible=0;
                let me = this;
                me.icon_save_pledge='fa fa-spinner fa-spin';
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
                }).then((result) =>{
                    if (result.value){                
                        axios.post('save_customer',{
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
                            'idcustomerpledge':this.id_customer_credit                    
                        }).then(function (response) {
                                me.midatax=[];
                                me.midatax.push({id:response.data,names: me.name,paternal_last_name: me.paternal_last_name, maternal_last_name:me.maternal_last_name });
                                me.pledge(me.midatax[0]);
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
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
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
            pledge(midata){
                let me=this;
                me.listadox=3;
                this.visible=0;
                this.id_customer_credit=midata.id_customer_credit;
                this.name_customer=midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name;
                this.nro_doc=midata.number_doc;
                var url= 'getDependenceParent';
                axios.get(url).then(function (response){
                    var respuesta= response.data;
                    me.arrayTypeProduct=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });

                url= 'getWarehouse';
                axios.get(url).then(function (response){
                    var respuesta= response.data;
                    me.arrayWarehouse=respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
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
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
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
                this.arrayDetailPledge=[];     
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
                       me.requirements.push({ check:false,id_type_requerement: lista[i].id_type_requerement, name:''});
                       console.log(me.requirements);
                      
                    }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           
        },
        
        mounted() {
            this.listadox=1;
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

