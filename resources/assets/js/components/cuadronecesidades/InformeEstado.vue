
<template>

    <main class="main">
        <div class="box-header with-border">
            <section class="content-header">
                <h3 class="box-title"><strong> 
                    INFORME Y ESTADO</strong>                            
                </h3>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-calendar"></i>Cuadro de Necesidades</a></li>
                    <li class="active">Informe y estado</li>
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
                        <div class="card">                            
                            <div class="card-body">    
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">                               
                                        <div class="box-body"> 
                                            <template v-if="listado==3">                                           
                                                <div class="row">                                                 
                                                    <div>                                                  
                                                        <div class="form-group" style="margin-bottom: 15px;">
                                                            <label class="col-md-1 control-label">Año Operacional:</label>
                                                            <div class="col-md-2">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon" style="border-top-left-radius: 3px;border-bottom-left-radius: 3px;">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </div>
                                                                    <date-picker v-model="year_txt"  @dp-change="getDependecySelect" :config="options" style="border-top-right-radius: 3px;border-bottom-right-radius: 3px;"></date-picker>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <div class="form-group">                                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-sitemap"></i></span>
                                                                <select v-model="dependency_txt" class="form-control js-example-basic-single" style="border-top-right-radius:3px;border-bottom-right-radius:3px">
																    <option selected="selected" value="" >Seleccione Dependencia</option>
																    <option v-for="dependency in listDependency" :key="dependency.id_dependency" :value="dependency.id_dependency">{{ dependency.name }}</option>
															    </select>
                                                            </div>                      
                                                        </div>                
                                                    </div> -->
                                                    <div class="col-md-7">
                                                        <div class="form-group">                                                            
                                                            <div class="input-group">
                                                                <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-sitemap"></i></span>
                                                                <model-list-select :list="listDependency"
                                                                        v-model="dependency_txt"
                                                                        option-value="id_dependency"
                                                                        option-text="name"
                                                                        placeholder="Seleccione Dependencia" class="form-control">
                                                                </model-list-select >
                                                                <span class="input-group-btn">
                                                                    <button @click="todas" class="btn btn-default" style="border-top-left-radius:3px;border-bottom-left-radius:3px;background:#eee;color: rgb(153,153,153)" type="button"><i class="fa fa-times"></i></button>
                                                                </span>
                                                            </div>                      
                                                        </div>                
                                                    </div>
                                                    
                                                    <div class="col-md-2">
                                                        <div class="btn-group">                                                            
                                                            <button type="button" @click="viewPOI(1, dependency_txt, year_txt, strategic_txt, activity_txt, goal_txt, unit_txt)" class="btn btn-search">
                                                                <i class="fa fa-search"></i>&nbsp;Ver
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>

                                            <template v-if="listadoCab==1">                
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <legend style="font-size:18px;"><i class="fa fa-cubes"></i><strong> CUADRO DE NECESIDADES:</strong>
                                                            <button type="button" @click="addActivity(year_txt)" class="btn btn-refresh" data-toggle="tooltip" title="Agregar Actividad">
                                                                <i class="fa fa-plus" style="font-size: 20px;"></i>
                                                            </button>
                                                            <button type="button" @click="goHome()" class="btn btn-filter" data-toggle="tooltip" title="Buscar Dependencia">
                                                                <i class="fa fa-search" style="font-size: 20px;"></i>
                                                            </button>
                                                            
                                                        </legend> 
                                                    </div>

                                                    <div class="col-md-12">
                                                        <legend style="font-size:16px;"><i class="fa fa-info"></i><strong> Información Básica</strong></legend>
                                                        <label class="col-md-2 control-label">Código:</label>
                                                        <div class="col-md-10">
                                                            <p>{{code}}</p>
                                                        </div>
                                                        <label class="col-md-2 control-label">Dependencia:</label>
                                                        <div class="col-md-10">
                                                            <p>{{name}}</p>
                                                        </div>                                                           
                                                    </div>

                                                    <div class="col-md-12">
                                                        <legend style="font-size:16px;"><i class="fa fa-calendar-check-o"></i><strong> Actividades:</strong>
                                                            <button type="button" @click="onChangeFilter()" class="btn btn-add-min" data-toggle="tooltip" title="Filtros">
                                                                <i class="fa fa-filter"></i>
                                                            </button>
                                                            <button type="button" @click="onChangeRefresh()" class="btn btn-refresh" data-toggle="tooltip" title="Refrescar">
                                                                <i class="fa fa-refresh"></i>
                                                            </button>
                                                        </legend>                                                    
                                                    </div>
                                                </div>
                                                <!-- No ver -->
                                                <transition name="slide-fade">
                                                    <div class="row" v-if="filter">
                                                        <div class="col-md-12">
                                                            <div class="form-horizontal">
                                                                <label class="col-md-2 control-label">Fte. financiamiento</label>
                                                                <div class="col-md-10">
                                                                    <div class="form-group">                                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-sitemap"></i></span>
                                                                            <select v-model="strategic_txt" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px"  @change="onChangeActivityFilter($event.target.value)">
                                                                                <option value="" selected="selected">Seleccione</option>
                                                                                <option v-for="goalFilter in listGoalFilter" :key="goalFilter.id_strategic_goal" :value="goalFilter.id_strategic_goal">{{ goalFilter.name }}</option>
                                                                            </select>
                                                                        </div> 
                                                                    </div> 
                                                                </div> 
                                                            
                                                                <label class="col-md-2 control-label">Actividad</label>
                                                                <div class="col-md-10">
                                                                    <div class="form-group">                                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-calendar-check-o"></i></span>
                                                                            <select v-model="activity_txt" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px" @change="onChangeActivityAllFilter($event.target.value)">
                                                                                <option selected="selected" value="" >Seleccione</option>
                                                                                <option v-for="data in listStrategicActivity" :key="data.id_strategic_activity" :value="data.id_strategic_activity">{{ data.name }}</option>
                                                                            </select>
                                                                        </div> 
                                                                    </div> 
                                                                </div> 
                                                        
                                                                <label class="col-md-2 control-label">Producto</label>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">                                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="border-top-left-radius:3px;border-bottom-left-radius:3px"><i class="fa fa-trophy"></i></span>
                                                                            <select v-model="goal_txt" class="form-control select2" style="border-top-right-radius:3px;border-bottom-right-radius:3px" @change="onChangeActivityAllFilter($event.target.value)">
                                                                                <option selected="selected" value="" >Seleccione</option>
                                                                                <option v-for="goal in listGoalActivity" :key="goal.goal" :value="goal.goal">{{ goal.goal }}</option>
                                                                            </select>
                                                                        </div> 
                                                                    </div> 
                                                                </div>                                                         
                                                                 
                                                            </div>
                                                        </div>
                                                    </div>                                                        
                                                </transition>
                                                <!-- No ver fin-->
                                                <div class="row">                                                        
                                                    <div class="col-md-12" style="text-align: right; margin-bottom:15px">
                                                        <button type="button" @click="importar()" class="btn btn-download"  style="margin-left: .5em;"><i class="fa fa-file-excel-o"></i>&nbsp;Descargar Informe</button>
                                                        <button type="button" @click="agregar()" class="btn btn-download"  style="margin-left: .5em;"><i class="fa fa-file-excel-o"></i>&nbsp;Descargar Articulación MEF</button>
                                                    </div> 
                                                </div>
                                            </template>

                                            <template v-if="listado==4">                                                
                                                <div class="box-body table-responsive no-padding">
                                                    <table  class="table table-hover" style="font-size:12px">
                                                        <thead style="background: #90a4ae;color: #fff;">                                                                                   <tr>
                                                            <tr>   
                                                                <th style="vertical-align: middle;">#</th>
                                                                <th style="vertical-align: middle;">CÓDIGO</th>
                                                                <th style="vertical-align: middle;">PRODUCTO</th>
                                                                <th style="vertical-align: middle;">FUENTE DE FINANCIAMIENTO</th>
                                                                <th style="vertical-align: middle;">PRECIO UNITARIO</th>
                                                                <th style="vertical-align: middle;">CANTIDAD</th>
                                                                <th style="vertical-align: middle;">PRECIO TOTAL</th>
                                                                <th colspan="2" style="text-align: center; vertical-align: middle;">ACCIONES</th>
                                                            </tr> 
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(midata,index) in listInform" :key="index" >
                                                                <td style="vertical-align: middle;">{{(index+1)}}</td>
                                                                <td style="vertical-align: middle;" v-text="midata.code_activity"></td>
                                                                <td style="vertical-align: middle;" v-text="midata.name_activity"></td>
                                                                <td style="vertical-align: middle;" v-text="midata.goal"></td>
                                                                <td style="vertical-align: middle;" v-text="midata.total"></td>                                                                        
                                                                <td style="vertical-align: middle;" v-text="midata.total"></td>                                                                        
                                                                <td style="vertical-align: middle;" v-text="midata.total"></td>                                                                        
                                                                <td style="vertical-align: middle;text-align: center;"> 
                                                                    <button type="button" @click="viewDetails(midata.id_poi_activity)" class="btn btn-view btn-sm">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>
                                                                    <button type="button" @click="editActivity(midata.id_poi_activity, year_txt)" class="btn btn-editar btn-sm">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>   
                                                                    <button title="Eliminar" type="button" @click="deleteActivity(midata.id_poi_activity)" class="btn btn-eliminar btn-sm">
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
                                                                        <a class="page-link" href="#" @click.prevent="changePagination(Number(pagination.current_page) - 1,buscar,cohort,identrenador,fechaInicio,fechaFin,tipoRegistro,sinentrenador,sinparticipante,zona,estado)">Ant</a>
                                                                    </li>
                                                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                                                        <a class="page-link" href="#" @click.prevent="changePagination(page,buscar,cohort,identrenador,fechaInicio,fechaFin,tipoRegistro,sinentrenador,sinparticipante,zona,estado)" v-text="page"></a>
                                                                    </li>
                                                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                                                        <a class="page-link" href="#" @click.prevent="changePagination(Number(pagination.current_page) + 1,buscar,cohort,identrenador,fechaInicio,fechaFin,tipoRegistro,sinentrenador,sinparticipante,zona,estado)">Sig</a>
                                                                    </li>
                                                                </ul>                                                                                       
                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>

                                            <template v-if="listado==5"> 
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="overlay">
                                                            <br>
                                                            <i class="fa fa-spinner fa-spin" style="color:#8bc34a"></i>
                                                            <br>
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

        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalInfo}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #8bc34a">
                        <button type="button" class="close" @click="closeModal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-th-list"></i> Detalle de Actividad</h4>
                    </div>
                    <div class="modal-body">                            
                        <form action="" method="get" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                    <div class="box-body">                                        
                                        <div class="row">
                                            <div class="col-md-4">   
                                                <legend style="font-size:16px;"><i class="fa fa-calendar"></i><strong> Cronograma</strong> <small>a travez de trimestres</small></legend>
                                                <div class="box-body table-responsive no-padding">
                                                        <table  class="table table-hover" style="font-size:12px">
                                                            <thead style="background: #90a4ae;color: #fff;">
                                                                <tr>                                                                
                                                                    <th style="vertical-align: middle;">MES</th>
                                                                    <th style="text-align: center; vertical-align: middle;">PRECIO</th>
                                                                </tr>
                                                                
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="(midata,index) in listMonthPOIActivity" :key="index">                                                                 
                                                                    <td style=" vertical-align: middle;" v-text="midata.name"></td>                                                                   
                                                                    <td style=" text-align: center; vertical-align: middle;" v-text="midata.quanty"></td>                                                                    
                                                                </tr>                                
                                                            </tbody>
                                                        </table>
                                                </div> 
                                            </div> 
                                            <div class="col-md-4">   
                                                <legend style="font-size:16px;"><i class="fa fa-calendar"></i><strong> PEI</strong> <small>Plan Estratégico Institucional</small></legend>
                                                <div class="box box-widget widget-user-2">
                                                    <div class="box-footer no-padding" style="border-radius: 3px;">
                                                        <ul class="nav nav-stacked">
                                                            <li><a href="#"><strong>Obj. estr.:</strong> {{name_goal_lb}}<span class="pull-right badge bg-blue">{{code_goal_lb}}</span></a></li>
                                                            <li><a href="#"><strong>Act. estr.:</strong>  {{name_lb}}<span class="pull-right badge bg-aqua">{{code_lb}}</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div> 
                                            </div> 
                                            <div class="col-md-4">   
                                                <legend style="font-size:16px;"><i class="fa fa-calendar"></i><strong> Otros datos</strong> <small>MEF y unidades</small></legend>
                                                <div class="box box-widget widget-user-2">
                                                    <div class="box-footer no-padding" style="border-radius: 3px;">
                                                        <ul class="nav nav-stacked">
                                                            <li><a href="#"><strong>Act. presup.:</strong> {{name_budget}}<span class="pull-right badge bg-blue">{{code_budget}}</span></a></li>
                                                            <li><a href="#"><strong>Unidad:</strong>  {{name_unity}}<span class="pull-right badge bg-aqua">{{code_unity}}</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModal(1)"><i class="fa fa-times"></i> Cerrar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalAdd}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #8bc34a">
                        <button type="button" class="close" @click="closeModal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-plus"></i> Creando Actividad</h4>
                    </div>

                    <div class="modal-body">  
                        <div class="row">    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <div class="box-body">                                     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Objetivo Estr.</label>
                                                        <div class="col-md-10">
                                                        <select v-model="id_goal" class="form-control select2" style="border-radius: 3px;" @change="onChangeActivity($event.target.value)">
                                                            <option selected="selected" value="" >Seleccione</option>
                                                            <option v-for="goalx in listGoal" :key="goalx.id_strategic_goal" :value="goalx.id_strategic_goal">{{ goalx.name }}</option>
                                                        </select>
                                                        </div> 
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Act. Estratégica</label>
                                                    <div class="col-md-10">
                                                        <select v-model="id_strategic" class="form-control select2" style="border-radius: 3px;">
                                                            <option selected="selected" value="" >Seleccione</option>
                                                            <option v-for="data in listStrategicActivity" :key="data.id_strategic_activity" :value="data.id_strategic_activity">{{ data.name }}</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Act. presupuestal</label>
                                                    <div class="col-md-10">
                                                        <select v-model="id_act_budget" class="form-control select2" style="border-radius: 3px;">
                                                            <option selected="selected" value="" >Seleccione</option>
                                                            <option v-for="data in listActivityBudget" :key="data.id_activity" :value="data.id_activity">{{ data.name }}</option>
                                                        </select>
                                                    </div> 
                                                </div>
                                                <div v-bind:class="errorInputActivity" >
                                                    <label  class="col-md-2 control-label">Actividad</label>
                                                    <div class="col-lg-10 col-md-9">
                                                        <textarea v-model="activity" @keyup="validarData()" class="form-control" rows="3" style="border-radius:3px"></textarea>
                                                        <em for="form:code" class="has-error text-danger" style="display: inline;">{{errors.activity}}</em>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Unidad</label>
                                                        <div class="col-md-10">
                                                        <select v-model="id_unit" class="form-control select2"  style="border-radius: 3px;">
                                                            <option selected="selected" value="" >Seleccione</option>
                                                            <option v-for="data in listUnitPoi" :key="data.id_poi_unity" :value="data.id_poi_unity">{{ data.code+' || '+data.name }}</option>
                                                        </select>
                                                        </div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">
                                                <div class="row">                                                                                                 
                                                    <div class="col-md-8">
                                                        <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Enero</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()"  v-model="january" class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Febrero</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="february" class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Marzo</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="march" class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Abril</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="april"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Mayo</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="may"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Junio</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()"  v-model="june"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Julio</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="july"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Agosto</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="august"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Septiembre</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="setember"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Octubre</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()"  v-model="october"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Noviembre</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input required type="text" @keyup="sumar()" v-model="november"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-lg-6 col-md-6 control-label">Diciembre</label>
                                                                        <div class="col-lg-6 col-md-6">
                                                                            <input type="text" @keyup="sumar()" v-model="december"  class="form-control" style="border-radius:3px">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div  class="form-group" >
                                                            <label class="col-lg-12 text-center">Prioridad</label>
                                                            <div class="col-lg-12 text-center">
                                                                <input  type="text" @keyup="sumar()" v-model="priority"  class="form-control" style="border-radius:3px">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-lg-12 text-center">Total</label>
                                                            <div class="col-lg-12 text-center">
                                                                <span style="font-size:15px" class="label label-success">{{total}}</span>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="closeModal(1)"><i class="fa fa-times"></i> Cerrar</button>
                        <button type="button" @click="savePoiActivity()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;Guardar programa</button>                        
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
     import { ModelListSelect } from 'vue-search-select';
    export default {
        data (){
            return {
                strategic_txt:'',activity_txt:'',goal_txt:'',unit_txt:'',
                listado:3,
                listadoCab:'',
                listProgram:[],
                listYear:[],
                listDependency:[],
                arrayListActivity:[],
                listGoalFilter:[],
                idzona:0,
               
                item: {
                value: '',
                text: ''
                },
               year: ''+ new Date().getFullYear(),
               year_txt:''+ new Date().getFullYear(),
               options: {
                format: 'YYYY',
                useCurrent: false,
                 locale: 'es',
                 showClose: true,
                },
                listProgram:[],listGoalActivity:[],
                arrayZona : [],idzona:0,
                estado_plan:'', estado:'',
                idZona:'',
                //fechas
                pagination : {
					'total' : 0,
					'current_page' : 0,
					'per_page' : 0,
					'last_page' : 0,
					'from' : 0,
					'to' : 0,
                },offset: 3,
                code:'NN',name:'',
                code_lb:'NN', name_lb:'NN',
                code_goal_lb:'NN', name_goal_lb:'NN',
                code_budget:'NN', name_budget:'NN',
                code_unity:'NN', name_unity:'NN',
                id:-1,
                january:0,february:0,march:0,
                april:0,may:0,june:0,july:0,august:0,
                setember:0,october:0,november:0,december:0,
                priority:0,total:0,
                id_goal:'',listGoal:[],id_strategic:'',listStrategicActivity:[],
                id_act_budget:'',listActivityBudget:[],
                activity:'',id_unit:'',listUnitPoi:[],
                id_dependency:'',list_dependency:[],

                errorClase : 0, 
                errors:{},
                errorInputActivity:'form-group',dependency_txt:'',modalInfo:0,modalAdd:0,
                filter:false,listUnit:[], listEje:[],listInform:[],listOnlyDependency:[],
                listMonthPOIActivity:[],code_activity:'', name_activity:'',
                listPeiPOIActivity:[], listOtherPOIActivity:[],
            }
        },
        components: {
            datePicker,moment,ModelListSelect
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
            todas(){
                this.dependency_txt="";
            },
            onChangeRefresh(){
                this.strategic_txt='';
                this.activity_txt=''; this.goal_txt=''; this.unit_txt=''
                let me=this;
                me.viewPOI(1, me.dependency_txt, me.year_txt, me.strategic_txt, me.activity_txt, me.goal_txt, me.unit_txt);   
            },

            changePagination(page,id_dependency, year_init, id_strategic_goal, id_strategic_activity, goal, id_poi_unity){
				let me = this;
				//me.listado=1;
				me.pagination.current_page = page;
				me.viewPOI(me.page, me.dependency_txt, me.year_txt, me.strategic_txt, me.activity_txt, me.goal_txt, me.unit_txt);   
            },

            getDependecySelect(){
                let me=this;
                me.year='';
                var url= 'get_dependency?operation_year=' + this.year_txt;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listDependency = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_goal_strategic?year_init=' + this.year_txt;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listGoalFilter=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            goHome(){
                let me=this;
                me.listado=3; 
                me.listadoCab=0;
            },

            // Ver el detalle de actividades 
            viewDetails(id_poi_activity){
                let me=this;
                me.modalInfo=1;
                var url= 'get_month_poi_activity?id_poi_activity=' + id_poi_activity;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listMonthPOIActivity=respuesta.datax;
                    // for(var i=0;i<me.listMonthPOIActivity.length;i++){
                    //     me.name_type=me.listMonthPOIActivity[i].name;
                    //     me.quanty=me.listMonthPOIActivity[i].quanty;
                    // }
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_pei_poi_activity?id_poi_activity=' + id_poi_activity;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listPeiPOIActivity=respuesta.datax;                    
                    me.code_lb=respuesta.datax[0].code;
                    me.name_lb=respuesta.datax[0].name;
                    me.code_goal_lb=respuesta.datax[0].code_goal;
                    me.name_goal_lb=respuesta.datax[0].name_goal;                   
                   
                    console.log(me.name);
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_other_poi_activity?id_poi_activity=' + id_poi_activity;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listOtherPOIActivity=respuesta.datax; 
                    me.code_budget=respuesta.datax[0].code;
                    me.name_budget=respuesta.datax[0].name;
                    me.code_unity=respuesta.datax[0].code_unity;
                    me.name_unity=respuesta.datax[0].name_unity;                     
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            // Agregar nueva actividad
            addActivity(year){
                let me= this;
                me.modalAdd=1;
                console.log(this.id_dependency);
                var url= '/getDependencyParent?';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listDependency = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_unitpoi';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listUnitPoi=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_goal_strategic?year_init=' + year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listGoal=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_activity?';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listActivityBudget=respuesta.datax;                
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                
            },

            getYear(){
                this.getDependecySelect();
            },

            getUnit(){
                let me=this;              
                var url= 'get_unit';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listUnit=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

  
            onChangeFilter(){
                if(this.filter){
                    this.filter=false;
                }else{
                    this.filter=true;
                }
            },

            listenToChangeEvent(...args) {
                console.log('listen To dp.change event - ', ...args);
            },

            onChangeDependency(year){
             //   alert('Hola');
                let me=this;
                me.year='';
                var url= 'get_dependency?operation_year=' + year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listDependency = respuesta.datax;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            //Sirve para el modal
            onChangeActivity(id_strategic_goal){
                let me=this;
                me.id_strategic_goal='';
                var url= 'get_change_strategic_activity?id_strategic_goal=' + id_strategic_goal;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listStrategicActivity=respuesta.datax;
                    me.id_strategic=respuesta.datax[0].id_strategic_activity;
                    console.log(me.id_strategic);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            onChangeActivityAllFilter(id_strategic_goal){
                let me=this;
                me.viewPOI(1, me.dependency_txt, me.year_txt, me.strategic_txt, me.activity_txt, me.goal_txt, me.unit_txt);                  
            },

            onChangeActivityFilter(id_strategic_goal){
                let me=this;
                //me.strategic_txt='';
                var url= 'get_change_strategic_activity?id_strategic_goal=' + id_strategic_goal;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listStrategicActivity=respuesta.datax;
                   // me.activity_txt=listStrategicActivity[0].id_strategic_activity; 
                    me.viewPOI(1, me.dependency_txt, me.year_txt, me.strategic_txt, me.activity_txt, me.goal_txt, me.unit_txt);   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },


            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.activity="";
                //input
                this.errorInputActivity='form-group has-success';

                if (!this.activity){   this.errors.activity="Ingrese Actividad";
                    this.errorInputActivity='form-group has-error';
                    this.errorClase = 1;
                }
                return this.errorClase;
            },

            paginaActual(){
                this.listado=1;
            },
            
            sumar(){
               this.total=Number(this.january) + Number(this.february)+Number(this.march)+ Number(this.april)+
               + Number(this.may)+Number(this.june)+ Number(this.july)+ Number(this.august)+Number(this.setember)+
               Number(this.october)+ Number(this.november)+Number(this.december)+Number(this.priority);           
            },

            editActivity(id_poi_activity, year){
                let me=this;
                me.modalAdd=1;                               
                var url= 'get_goal_strategic?year_init=' + year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listGoal=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_strategic_activity?year_init=' + year;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listStrategicActivity=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_activity?';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listActivityBudget=respuesta.datax;                
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
                
                var url= 'get_unitpoi';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listUnitPoi=respuesta.datax;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_edit_informe_statu?id_poi_activity='+id_poi_activity;
				axios.get(url).then(function (response) {
					var respuesta= response.data;
                    me.arrayListActivity=respuesta.datax;                 
					for(var i=0;i<me.arrayListActivity.length;i++){
                        me.id_goal=me.arrayListActivity[i].id_strategic_goal;
                        me.id_strategic=me.arrayListActivity[i].id_strategic_activity;
                        me.id_act_budget=me.arrayListActivity[i].id_budget_activity;
                        me.activity=me.arrayListActivity[i].name_activity;
                        me.id_unit=me.arrayListActivity[i].id_poi_unity;
                        me.priority=me.arrayListActivity[i].priority;
                        me.total=me.arrayListActivity[i].total;
                        me.id=me.arrayListActivity[i].id_poi_activity;
                        me.january=me.arrayListActivity[i].january;
                        me.february=me.arrayListActivity[i].february;
                        me.march=me.arrayListActivity[i].march;
                        me.april=me.arrayListActivity[i].april;
                        me.may=me.arrayListActivity[i].may;
                        me.june=me.arrayListActivity[i].june;
                        me.july=me.arrayListActivity[i].july;
                        me.august=me.arrayListActivity[i].august;
                        me.setember=me.arrayListActivity[i].setember;
                        me.october=me.arrayListActivity[i].october;
                        me.november=me.arrayListActivity[i].november;
                        me.december=me.arrayListActivity[i].december;
                    }
				}) 
				.catch(function (error) {
				console.log(error);
                });                
            },

            savePoiActivity(){
                if (this.validarData()){
                    alert(this.item.value);
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
                axios.post('save_poi_activity',{
                    'id_goal':this.id_goal,'id_strategic':this.id_strategic, 
                    'id_act_budget':this.id_act_budget,'activity':this.activity, 
                    'id_unit':this.id_unit,
                    'january':this.january,'february':this.february, 'march':this.march,'april':this.april, 
                    'may':this.may,'june':this.june, 'july':this.july,'august':this.august, 
                    'setember':this.setember,'october':this.october, 'november':this.november,'december':this.december,
                    'priority':this.priority,'total':this.total,'id_dependency':this.id_dependency,
                    'id': this.id                                    
                }).then(function (response) {
                    
                    me.viewPOI(me.page, me.id_dependency, me.year_init, me.id_strategic_goal, me.id_strategic_activity, me.goal, me.id_poi_unity);   
                    me.modalAdd=0;               
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
            deleteActivity(id_poi_activity){
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
                axios.post('delete_poi_activity',{
                    'id_poi_activity': id_poi_activity

                }).then(function (response) {
                   me.viewPOI(me.page, me.id_dependency, me.year_init, me.id_strategic_goal, me.id_strategic_activity, me.goal, me.id_poi_unity);   
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
                me.listado=2;
            },

            viewPOI(page, id_dependency, year_init, id_strategic_goal, id_strategic_activity, goal, id_poi_unity){
                let me=this;
                if(me.dependency_txt==''){ alert('Seleccione Dependencia'); return;}
                me.listado=5;             
                var url= 'get_only_dependecy?page='+ page + '&id_dependency=' + id_dependency;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listOnlyDependency=respuesta.datax;
                    me.code=respuesta.datax[0].code;
                    me.name=respuesta.datax[0].name;
                    me.id_dependency=respuesta.datax[0].id_dependency;
                    
                                      
                })
                .catch(function (error) {
                    console.log(error);
                });
                          
                var url= 'get_informe_statu?id_dependency=' + id_dependency +'&year_init='+ year_init+ '&page=' + page
                +'&id_strategic_goal='+ id_strategic_goal 
                +'&id_strategic_activity=' + id_strategic_activity 
                + '&goal=' + goal + '&id_poi_unity=' + id_poi_unity;
                //strategic_txt activity_txt goal_txt unit_txt
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.pagination= respuesta.pagination;
                    me.listInform=respuesta.datax;
                    me.listadoCab=1;
                    me.listado=4; 
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_unitpoi';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listUnitPoi=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });

                var url= 'get_goal_budget_activity';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listGoalActivity=respuesta.datax;                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            closeModal(){
                let me=this;
                me.modalInfo=0;
                me.modalAdd=0;
            },
            
            volver(){
                let me=this;
                //me.listado=1;
                me.modalInfo=1;

            },
            load_new(){
                let me=this;              
                var url= 'get_program';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.listProgram=respuesta.datax;
                    me.getYear();
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
           
        },
        mounted() {
            this.getYear();
             
        //    this.listar();
        //    this.load_new();
        }
         
    }   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }
 .div-error{
    display: flex;
    justify-content: center;
    }
.text-error{
    color: red !important;
    font-weight: bold;
}

/* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 450px;
    overflow-y: auto;
}
.select2:focus{
    border-radius:3px;
}

.ui.selection.dropdown .menu > .item{
  font-size: 1em;
}

</style>


