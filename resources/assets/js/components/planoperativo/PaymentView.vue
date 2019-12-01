<template>
    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    PAGOS CLIENTES</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-database"></i>Registros</a></li>
                    <li><a href="#">cliente</a></li>
                    <li class="active">PAGOS</li>
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
                                                            <div class="col-xs-11 col-sm-4 col-md-12 col-lg-7">
                                                                <div class="input-group" style="margin-bottom: 15px;">
                                                                    <input type="text"  v-model="buscar" @keyup.enter="listar(1)"  class="form-control" placeholder="Buscar por dni o nombres..." style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                                    <span class="input-group-btn">
                                                                        <button type="submit" @click="listar(1)"  class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> Buscar</button>
                                                                    </span>
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
                                                                                <th style="vertical-align: middle;">DNIX</th>
                                                                                <th style="vertical-align: middle;">NOMBREX</th>
                                                                                <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(midata,index) in list" :key="index" >
                                                                                <td style="vertical-align: middle;" >{{(index+1)+((Number(pagination.current_page)-1)*8)}}</td>
                                                                                <td style="vertical-align: middle;" v-text="midata.nro_doc"></td>
                                                                                <td style="vertical-align: middle;" v-text="midata.names+' '+midata.paternal_last_name+' '+midata.maternal_last_name"></td>
                                                                                <td style="text-align: center; vertical-align: middle;"> 
                                                                                    
                                                                                    <button type="button" @click="editar(midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </button>                                                                                                                   
                                                                                
                                                                                    <button type="button" @click="eliminar(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </button>

                                                                                    <button type="button" @click="cobrar(midata.id)" class="btn btn-cobrar btn-sm" data-toggle="tooltip" title="Cobrar">
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
                                                                        </ul>                        
                                                                    </nav>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                                <div class="info-box">
                                                                    <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>

                                                                    <div class="info-box-content">
                                                                    <span class="info-box-text">Bookmarks</span>
                                                                    <span class="info-box-number">410</span>
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
                                                                    <button type="button" @click="save()" class="btn btn-save">
                                                                        <i class="fa fa-save"></i>&nbsp;Guardar Pagos
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">   
                                                            <div class="col-md-12">
                                                                <legend style="font-size:16px;"><strong> DATOS PERSONALES:</strong></legend>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity">
                                                                    <label for="dni">DNI:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172"><i class="fa fa-database"></i></span>
                                                                        <input maxlength="8" v-model="nro_doc" type="text" @keyup="validarData()" @keyup.enter="getData()"  class="form-control" placeholder="Ingrese Dni" >
                                                                        <span class="input-group-btn">
                                                                            <button data-toggle="tooltip" title="Validar con RENIEC" type="submit" @click="getData()" class="btn btn-mostrar btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i class="fa fa-check"></i> VALIDAR</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="ap_paterno">Apellido Paterno:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="paternal_last_name" type="text" class="form-control" placeholder="Ingrese el apellido paterno." style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">                                                                            
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity4">
                                                                    <label for="ap_materno">Apellido Materno:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="maternal_last_name" type="text" class="form-control"  placeholder="Ingrese el apellido materno." style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">Nombres:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="name" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="sexo">Sexo:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-transgender"></i></span>
                                                                    <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="sex">
                                                                        <option value="">Seleccione</option>
                                                                        <option value="M">Masculino</option>
                                                                        <option value="F">Femenino</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="edad">Fecha de Nac:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-calendar "></i></span>
                                                                    <date-picker v-model="birthdate" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="estado_civil">Estado Civíl:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                    <select class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;" v-model="marital_status">
                                                                        <option value="">Seleccione</option>
                                                                        <option value="SOLTERO">Soltero (a)</option>
                                                                        <option value="CASADO">Casado (a)</option>
                                                                        <option value="VIUDO">Viudo (a)</option>
                                                                        <option value="SEPARADO">Separado (a)</option>
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity5">
                                                                    <label for="celular">Celular:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-mobile-phone"></i></span>
                                                                    <input placeholder="Ingrese Numero" v-model="phone" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div v-bind:class="errorInputActivity6">
                                                                    <label for="celular">Dirección:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-location-arrow"></i></span>
                                                                    <input placeholder="Ingrese Dirección" v-model="address" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
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
                                                                     <button type="button" @click="descargar()" class="btn btn-download">
                                                                <i class="fa fa-download"></i>&nbsp;Exportar
                                                                </button>
                                                                    <button type="button" @click="guardar()" class="btn btn-save">
                                                                        <i class="fa fa-save"></i>&nbsp;Guardar Pagos
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">  
                                                            <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">Nombres:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="name" type="text" class="form-control" placeholder="Nombres" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="ap_paterno">Tipo Producto a Pagar</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Escoge proucto a pagar</option>
                                                                        </select> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="ap_paterno">Modo de Pago</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Escoge modo de pago</option>
                                                                            <option selected="selected" value="" >Cancelacion</option>
                                                                            <option selected="selected" value="" >Amortizacion</option>
                                                                            <option selected="selected" value="" >Interes</option>
                                                                        </select> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">Monto a Pagar:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="name" type="text" class="form-control" placeholder="$" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="ap_paterno">Fecha Modo de Pago:</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <date-picker v-model="year" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                      
                                                                         
                                                        </div> 
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="ap_paterno">Nuevo Programa de Pago</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <select v-model="idParent" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
                                                                            <option selected="selected" value="" >Escoge </option>
                                                                            <option selected="selected" value="" >Dias</option>
                                                                            <option selected="selected" value="" >Semanal</option>
                                                                            <option selected="selected" value="" >Quincenal</option>
                                                                             <option selected="selected" value="" >Mensual</option>
                                                                        </select> 
                                                                    </div>
                                                                
                                                            </div>
                                                            <div class="col-md-9">
                                                                 <label for="nombres">Programar:</label>
                                                                <div class="checkbox">
                                                                        <label class="container">
                                                                            <input type="checkbox" v-model="dependencia_operativa">¿desea programar proximo pago?
                                                                            <span class="checkmark"></span>
                                                                        </label>
                                                                    </div> 
                                                            </div>  
                                                                
                                                        </div> 

                                                        <div class="row">

                                                            <div class="col-md-2">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="ap_paterno">Fecha Inicio:</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <date-picker v-model="year" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <div v-bind:class="errorInputActivity3">
                                                                    <label for="ap_paterno">Fecha Fin:</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>
                                                                        <date-picker v-model="year" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div v-bind:class="errorInputActivity2">
                                                                    <label for="nombres">Monto:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="name" type="text" class="form-control" placeholder="Monto" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div v-bind:class="errorPorcentage">
                                                                    <label for="nombres">%:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="porcentage" type="text" class="form-control" placeholder="Porcentaje" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div v-bind:class="errorInterest">
                                                                    <label for="nombres">Interes:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="interest" type="text" class="form-control" placeholder="Interes" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div v-bind:class="errorInterest">
                                                                    <label for="nombres">Total a Pagar:</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                                        <input v-model="interest" type="text" class="form-control" placeholder="Interes" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">  
                                                                    </div>
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
                                                                                <th style="vertical-align: middle;">FECHA INICIO</th>
                                                                                <th style="vertical-align: middle;">FECHA FIN</th>
                                                                                <th style="vertical-align: middle;">CAPITAL</th>
                                                                                <th style="vertical-align: middle;">MONTO</th>
                                                                                <th style="vertical-align: middle;">INTERES</th>
                                                                                <th style="vertical-align: middle;">TOTAL</th>
                                                                                <th style="vertical-align: middle;">ESTADO</th>
                                                                                <th style="vertical-align: middle;">ALMACEN</th>
                                                                                <th style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                                            </tr> 
                                                                        </thead>
                                                                        <tbody>
                                                                                
                                                                                <td style="text-align: center; vertical-align: middle;"> 
                                                                                    
                                                                                    <!--<button type="button" @click="editar(midata.id)" class="btn btn-editar btn-sm" data-toggle="tooltip" title="Editar">-->
                                                                                        <!--<i class="fa fa-edit"></i>-->
                                                                                    <!--</button>-->                                                                                                                   
                                                                                
                                                                                    <!--<button type="button" @click="eliminar(midata.id)" class="btn btn-eliminar btn-sm" data-toggle="tooltip" title="Eliminar">-->
                                                                                        <!--<i class="fa fa-trash"></i>-->
                                                                                   <!-- </button>-->
                                                                                </td> 
                                                                                                   
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="dataTables_paginate paging_simple_numbers" style=" float: right !important;">
                                                                    <nav>
                                                                        <ul class="pagination">
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
                                                                        </ul>                        
                                                                    </nav>
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
                list : [],idParent:'',year:'',
                arrayEntrenador : [],
                arrayDataDetalle : [],califica:'',
                arrayCohort:[],datosArrayPbg:[],datosArraySunat:[],
                identrendor : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                
                listado:1,duenio_parcela:'',participante:'',
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

                amount:'',name:'',id:-1,paternal_last_name:'',maternal_last_name:'',phone:'',address:'',nro_doc:'',
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
                buscar:'',sex:'',birthdate:'',marital_status:''
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
                                    me.name = respuesta.datax[2];
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.maternal_last_name = respuesta.datax[1];
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
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.nro_doc="";
                this.errors.name="";
                 this.errors.paternal_last_name="";
                  this.errors.maternal_last_name="";
                   this.errors.phone="";
                    this.errors.address="";
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


                if (!this.nro_doc) 
                {   this.errors.nro_doc="Ingrese DNI";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.name) 
                {   this.errors.name="Ingrese nombre";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.paternal_last_name) 
                {   this.errors.paternal_last_name="Ingrese apellido paterno";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.maternal_last_name) 
                {   this.errors.maternal_last_name="Ingrese apellido materno";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.phone) 
                {   this.errors.phone="Ingrese celular";
                    this.errorInputActivity5='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.address) 
                {   this.errors.address="Ingrese direccion";
                    this.errorInputActivity6='form-group has-error';
                    this.errorClase = 1;
                }
                /*if (!this.amount) 
                {   this.errors.amount="Ingrese monto";
                    this.errorInputAmount='form-group has-error';
                    this.errorClase = 1;
                }*/
               
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
                var url= 'getDataCustomerBynro_doc?id='+id;
                axios.get(url).then(function (response) {
                        var respuesta= response.data;
                                me.id=respuesta.datax[0].id;
                                me.nro_doc = respuesta.datax[0].nro_doc;
                                me.name = respuesta.datax[0].names;
                                me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                                me.maternal_last_name = respuesta.datax[0].maternal_last_name;
                                me.phone = respuesta.datax[0].phone;
                                me.address =respuesta.datax[0].address;
                                me.sex =respuesta.datax[0].sex;
                                me.marital_status =respuesta.datax[0].marital_status;
                                me.birthdate=moment(respuesta.datax[0].birthdate).toDate();
                                me.validarData();
                    
                
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },
            save(){
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
                axios.post('save_customer',{
                    'nro_doc':this.nro_doc,'name':this.name,'paternal_last_name':this.paternal_last_name,'maternal_last_name':this.maternal_last_name,'phone':this.phone,'address':this.address, 
                    'id': this.id,'sex': this.sex,'marital_status': this.marital_status,
                    'birthdate' : moment(moment(this.birthdate, 'DD/MM/YYYY')).format('YYYY-MM-DD')                        
                }).then(function (response) {
                     me.limpiar();
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
        limpiar(){
               this.errorInputActivity='form-group';
                this.errorInputActivity2='form-group';
                this.errors = {};
                this.errors.nro_doc="";
                this.errors.name="";
                this.errors.paternal_last_name="";
                this.errors.maternal_last_name="";
                this.errors.phone="";
                this.errors.address="";
                this.nro_doc="";
                this.name="";
                 this.paternal_last_name="";
                this.maternal_last_name="";
                 this.phone="";
                this.address="";
                this.id=-1;
            },
            listar(page){
                let me=this;      
                me.listado=0;        
                var url= 'getListCustomer?buscar='+me.buscar+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                     me.list=respuesta.datax;
                     me.pagination= respuesta.pagination; 
                     me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });
               
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

