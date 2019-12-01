<template>
    <main class="main">
        <section class="content-header">
            <h1>
              Prendas
              <small>En Almacen</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Operaciones</a></li>
              <li class="active">Prendas</li>
            </ol>
        </section>

		<section class="content">
            <div class="row">
                <section class="col-lg-12 connectedSortable ui-sortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="nav-tabs-custom">
                        <!-- Tabs within a box -->
                        <ul class="nav nav-tabs ui-sortable-handle">
                            <li v-bind:class="clastab1"  @click="list_only_data_sale(1, '')"><a href="#tab_1" data-toggle="tab"><i class="fa fa-circle" style="color: #189900;"></i> En Venta</a></li>
                            <li v-bind:class="clastab2"  @click="list_only_data_pawned(1, '')"><a href="#tab_2" data-toggle="tab"><i class="fa fa-circle" style="color: #F38F1D;"></i> Empeñados</a></li>
                            <li v-bind:class="clastab3"  @click="list_only_data_defeated(1, '')"><a href="#tab_3" data-toggle="tab"><i class="fa fa-circle" style="color: #d20101;"></i> Vencidos</a></li>
                        </ul>
                        <div class="tab-content">										
                            <div v-bind:class="clastabdetalle1" id="tab_1">
                                <div class="box-body" style="margin-bottom: -12px;">                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group" style="margin-bottom: 20px;margin-top: 10px;">
                                                <input type="text" v-model="buscar" @keyup.enter="list_data_sale(1, buscar)" class="form-control" placeholder="Buscar por código o nombre..."  style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                <span class="input-group-btn">
                                                <button type="submit" @click="pressed_only_data_sale()" v-bind:class="class_button_sale" data-toggle="tooltip" title="Buscar solo en Venta"><i class="fa fa-thumb-tack"></i></button>
                                                <button type="submit" @click="list_data_sale(1, buscar)" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                                </span>
                                            </div>
                                            <h5>TODAS LAS PRENDAS</h5>
                                        </div>
                                        <template v-if="listado==0">
                                            <div align="center">
                                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                                <p>Cargando...</p>
                                            </div>
                                        </template>
                                        <template v-if="listado==1">
                                            <!-- <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_sale==1" v-for="(midata,index) in list_on_data" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>                                                   
                                                    <div class="info-box-content" style="padding: 0px 0px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.suggested_price}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: capitalize;">{{midata.caracteristicas}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18.2px;">
                                                            <a href="#" class="small-box-footer" @click="sales_pledge(midata.id)">Vender producto <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_sale==1" v-for="(midata,index) in list_on_sale" :key="index">
                                                <div class="info-box" >
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.suggested_price}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: capitalize;">{{midata.caracteristicas}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18.2px;">
                                                            <a href="#" class="small-box-footer" @click="sales_pledge(midata.id)">Vender producto <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_pawned==1" v-for="(midata,index) in list_pawned" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_inicial}} Hasta {{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_defeated==1" v-for="(midata,index) in list_defeated" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer" @click="send_to_sales(midata.id)">Enviar a venta <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_sale==0" v-for="(midata,index) in list_on_sale" :key="index">
                                                <div class="info-box" >
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.suggested_price}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: capitalize;">{{midata.caracteristicas}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18.2px;">
                                                            <a href="#" class="small-box-footer" @click="sales_pledge(midata.id)">Vender producto <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    
                                </div>
                            </div>
                            <div v-bind:class="clastabdetalle2" id="tab_2">
                                <div class="box-body" style="margin-bottom: -12px;">                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group" style="margin-bottom: 20px;margin-top: 10px;">
                                                <input type="text" v-model="buscar" @keyup.enter="list_data_pawned(1, buscar)" class="form-control" placeholder="Buscar por código o nombre..."  style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                <span class="input-group-btn">
                                                    <button type="submit" @click="pressed_only_data_pawned()" v-bind:class="class_button_pawned" data-toggle="tooltip" title="Buscar solo en Empeñados"><i class="fa fa-thumb-tack"></i></button>
                                                <button type="submit" @click="list_data_pawned(1, buscar)" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                                </span>
                                            </div>
                                            <h5>TODAS LAS PRENDAS</h5>
                                        </div>
                                        <template v-if="listado==0">
                                            <div align="center">
                                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                                <p>Cargando...</p>
                                            </div>
                                        </template>
                                        <template v-if="listado==1">
                                            <!-- <div class="col-md-4 col-sm-6 col-xs-12"  v-if="list_product_pawned==1" v-for="(midata,index) in list_on_data" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0 px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">Fecha de Empeño: {{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_sale==1" v-for="(midata,index) in list_on_sale" :key="index">
                                                <div class="info-box" >
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.suggested_price}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: capitalize;">{{midata.caracteristicas}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18.2px;">
                                                            <a href="#" class="small-box-footer" @click="sales_pledge(midata.id)">Vender producto <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_pawned==1" v-for="(midata,index) in list_pawned" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_inicial}} Hasta {{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_defeated==1" v-for="(midata,index) in list_defeated" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer" @click="send_to_sales(midata.id)">Enviar a venta <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_pawned==0" v-for="(midata,index) in list_pawned" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_inicial}} Hasta {{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    
                                </div>
                            </div>
                            <div v-bind:class="clastabdetalle3" id="tab_3">
                                <div class="box-body" style="margin-bottom: -12px;">                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group" style="margin-bottom: 20px;margin-top: 10px;">
                                                <input type="text" v-model="buscar" @keyup.enter="list_data_defeated(1, buscar)" class="form-control" placeholder="Buscar por código o nombre..."  style="border-bottom-left-radius: 3px; border-top-left-radius: 3px;">
                                                <span class="input-group-btn">
                                                    <button type="submit" @click="pressed_only_data_defeated()" v-bind:class="class_button_defeated" data-toggle="tooltip" title="Buscar solo en Vencidos"><i class="fa fa-thumb-tack"></i></button>
                                                <button type="submit" @click="list_data_defeated(1, buscar)" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px; border-top-right-radius: 3px;"><i class="fa fa-search"></i> BUSCAR</button>
                                                </span>
                                            </div>
                                            <h5>TODAS LAS PRENDAS</h5>
                                        </div>
                                        <template v-if="listado==0">
                                            <div align="center">
                                                <img src="img/loadx.gif" alt="technoserve" align="middle">
                                                <p>Cargando...</p>
                                            </div>
                                        </template>
                                        <template v-if="listado==1">
                                            <!-- <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_defeated==1" v-for="(midata,index) in list_on_data" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer" @click="send_to_sales(midata.id)">Enviar a venta <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_sale==1" v-for="(midata,index) in list_on_sale" :key="index">
                                                <div class="info-box" >
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.suggested_price}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: capitalize;">{{midata.caracteristicas}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18.2px;">
                                                            <a href="#" class="small-box-footer" @click="sales_pledge(midata.id)">Vender producto <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_pawned==1" v-for="(midata,index) in list_pawned" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_inicial}} Hasta {{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer">Ver detalles <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_defeated==1" v-for="(midata,index) in list_defeated" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer" @click="send_to_sales(midata.id)">Enviar a venta <i class="fa fa-arrow-circle-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12" v-if="list_product_defeated==0" v-for="(midata,index) in list_defeated" :key="index">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-pricetags"></i></span>
                                                    <div class="info-box-content" style="padding: 0px 0px;
                                                            background-color: #f0f0f0de;
                                                            border-top-right-radius: 2px;
                                                            border-bottom-right-radius: 2px;">
                                                        <span class="info-box-text" style="padding-left: 10px;">{{midata.producto}}</span>
                                                        <span class="info-box-number" style="padding-left: 10px;"><small>S/.</small>{{midata.capital}}</span>
                                                        <span class="info-box-text" style="padding-left: 10px;margin: 0 0 -20px; text-transform: none;">{{midata.fecha_final}}</span>
                                                        <div class="small-box bg-aqua"  style="border-radius: 0px 0px 2px; margin-top: 18px;">
                                                            <a href="#" class="small-box-footer" @click="send_to_sales(midata.id)">Enviar a venta <i class="fa fa-arrow-circle-right"></i></a>
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
                    
                </section>
            </div>
		</section>
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal_send}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #012D74;">
                        <button type="button" class="close" @click="close_modal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-exchange"></i> ENVIAR A VENTA</h4>
                    </div>

                    <div class="modal-body">  
                        <div class="row">    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <div class="box-body">                                     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">                                                
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Precio Sugerido:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                S/.
                                                            </span>
                                                            <input v-model="suggested_price" type="text" @keyup="validarPrice()" class="form-control" style="border-bottom-right-radius:
                                                             3px;border-top-right-radius: 3px;">
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
                        <button type="button" class="btn btn-danger" @click="close_modal(1)"><i class="fa fa-times"></i> CANCELAR</button>
                        <button type="button" @click="save_suggested_price()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal_detail_pledge}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #012D74;">
                        <button type="button" class="close" @click="close_modal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-exchange"></i> ENVIAR A VENTA</h4>
                    </div>

                    <div class="modal-body">  
                        <div class="row">    
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> 
                                <div class="box-body">                                     
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-horizontal">                                                
                                                <div class="form-group">
                                                    <label  class="col-md-2 control-label">Precio Sugerido:</label>
                                                    <div class="col-md-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;  color:#1e2172">
                                                                S/.
                                                            </span>
                                                            <input v-model="suggested_price" type="text" @keyup="validarPrice()" class="form-control" style="border-bottom-right-radius:
                                                             3px;border-top-right-radius: 3px;">
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
                        <button type="button" class="btn btn-danger" @click="close_modal(1)"><i class="fa fa-times"></i> CANCELAR</button>
                        <button type="button" @click="save_suggested_price()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal_sales}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background: #012D74;">
                        <button type="button" class="close" @click="close_modal(1)" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                            <h4 class="modal-title" style="color: #FFFFFF"><i class="fa fa-shopping-cart"></i> VENDER PRODUCTO</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="box-body">
                                        <!-- <div class="row">
                                            <div class="col-md-12">
                                                <div class="callout callout-warning">
                                                    <h4>¡Es Importante!</h4> 
                                                    <p>Previo cambio de Entrenador Comunitario o Asesor, debes haberlo registrado como usuario.</p>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="row" style="padding-bottom: 15px;">
                                            <div class="col-md-3">
                                                <label for="codigo" >DNI:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                    <input v-model="nro_doc" type="text"  @keyup.enter="getData()" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                    <span class="input-group-btn">
                                                        <button data-toggle="tooltip" title="Buscar" @click="getData()" type="submit" class="btn btn-search btn-flat" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;"><i v-bind:class="icon_search_dni"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="codigo">Apellido Paterno:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                    <input disabled="disabled" v-model="paternal_last_name" type="text" class="form-control"  style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="codigo">Apellido Materno:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                    <input disabled="disabled" v-model="maternal_last_name" type="text" class="form-control"  style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="codigo">Nombres:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-user"></i></span>
                                                    <input disabled="disabled" v-model="name" type="text" class="form-control"  style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row" style="padding-bottom: 15px;">
                                            <div class="col-md-3">
                                                <label for="codigo">Dirección:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa fa-location-arrow"></i></span>
                                                    <input v-model="address" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="codigo">Código:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-barcode"></i></span>
                                                    <input disabled="disabled" v-model="code_product" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="codigo">Producto:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;"><i class="fa fa-diamond"></i></span>
                                                    <input disabled="disabled" v-model="product" type="text" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="ap_paterno">Precio de Venta:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="border-bottom-left-radius: 3px;border-top-left-radius: 3px;">S/.</span>
                                                    <input type="text" v-model="price_sales" class="form-control" style="border-bottom-right-radius: 3px;border-top-right-radius: 3px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click="close_modal(1)"><i class="fa fa-times"></i> CANCELAR</button>
                        <button type="button" @click="save_final_price()" class="btn btn-save"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>                        
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
                clastab1:'active',clastab2:'',clastab3:'',clastab4:'',
                clastabdetalle1:'tab-pane active',clastabdetalle2:'tab-pane',clastabdetalle3:'tab-pane',clastabdetalle4:'tab-pane',
                list_on_sale: [], list_on_data:  [],
                list_pledge : [],idParent:'',year:'',
                list_pawned : [],
                list_defeated : [], 
                modal_send:0, modal_detail_pledge:0,modal_sales:0,
                datosArraySunat:[],
                buscar : '',idZona:'',authUser:'',datosRepresentante:[],
                zonactual:'x',porcent: 50,empresa:'',
                suggested_price:'',
                listado:1,duenio_parcela:'',participante:'',
                //fechas
                fechaInicio: '01/01/2018',
                authUser:1,
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
                id:-1,
                name:'', address:'',                 
                //date_init:'', 
                state:'', phone:'',
                notes:'',
                errorClase : 0,
                errors:{},
                errorInputActivity1:'form-group',
                errorInputActivity2:'form-group',
                errorInputActivity3:'form-group',
                errorInputActivity4:'form-group',
                errorInputActivity5:'form-group',
                errorInputActivity6:'form-group',
                errorInputAmount:'form-group',
                errorComboTipoProduco:'form-group',
                errorTotalAmount:'form-group',
                search:'',sex:'',birthdate:'',marital_status:'', 
                client:'',address:'',
                nro_doc:'',paternal_last_name:'',maternal_last_name:'', 
                name:'',
                code_product:'',product:'',price_sales:'', 
                class_button_sale:'btn btn-default', button_sale:0,
                class_button_defeated:'btn btn-default', button_defeated:0,
                class_button_pawned:'btn btn-default', button_pawned:0,
                list_product_sale:0, list_product_defeated:0, list_product_pawned:0,
                icon_search_dni:'fa fa-search',
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
                if (this.nro_doc.length==8){   
                    let me=this;
                    me.paternal_last_name="";                  
                    me.maternal_last_name="";                  
                    me.name="";                  
                    me.address="";                  
                    me.icon_search_dni='fa fa-spinner fa-spin';    
                    var url= 'getDatabyNroDocP?nro_doc='+me.nro_doc;
                    axios.get(url).then(function (response) {
                         var respuesta= response.data;
                         var tipo=respuesta.tipo;
                          if(respuesta.datax.length>0){
                            if(tipo=='bd'){
                                    me.id=respuesta.datax[0].id;
                                    me.name = respuesta.datax[0].names;
                                    me.paternal_last_name = respuesta.datax[0].paternal_last_name;
                                    me.maternal_last_name = respuesta.datax[0].maternal_last_name;                                    
                                    me.address =respuesta.datax[0].address;

                                    }
                                    else{
                                    me.paternal_last_name = respuesta.datax[0];
                                    me.name = respuesta.datax[1];
                                    me.maternal_last_name = respuesta.datax[2];
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
            save_final_price(){
                swal({
                title: 'Esta seguro de vender este producto?',
                type: 'warning',
                showCancelButton: true,confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {

                let me = this;
                axios.post('save_final_price',{
                    'final_price':this.price_sales,
                    'id':this.id,
                    'nro_doc':this.nro_doc,
                    'paternal_last_name':this.paternal_last_name,
                    'maternal_last_name':this.maternal_last_name,
                    'name':this.name,
                    'address':this.address
                }).then(function (response) {  
                    me.modal_sales=0;    
                    me.list_only_data_sale(1, me.buscar);
                    swal(
                        'Guardado!',
                        'La venta ha sido realizada con éxito.',
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
            pressed_only_data_sale(){
                if(this.button_sale==1){
                    this.class_button_sale='btn btn-default';
                    this.button_sale=0;
                    console.log(this.button_sale);
                }else{
                    this.class_button_sale='btn btn-default active';
                    this.button_sale=1;
                    console.log(this.button_sale);
                }
                
            },            
            pressed_only_data_pawned(){
                if(this.button_pawned==1){
                    this.class_button_pawned='btn btn-default';
                    this.button_pawned=0;
                    console.log(this.button_pawned);
                }else{
                    this.class_button_pawned='btn btn-default active';
                    this.button_pawned=1;
                    console.log(this.button_pawned);
                }
                
            },
            pressed_only_data_defeated(){
                if(this.button_defeated==1){
                    this.class_button_defeated='btn btn-default';
                    this.button_defeated=0;
                    console.log(this.button_sale);
                }else{
                    this.class_button_defeated='btn btn-default active';
                    this.button_defeated=1;
                    console.log(this.button_defeated);
                }
                
            },
            sales_pledge(id){
                let me= this;                  
                me.modal_sales=1;
                var url= 'getProductSales?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.price_sales=respuesta.datax[0].suggested_price;
                    me.product = respuesta.datax[0].producto+' '+ respuesta.datax[0].caracteristicas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            send_to_sales(id){
                let me= this;                  
                me.modal_send=1;
                var url= 'getSuggestedPrice?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.suggested_price = respuesta.datax[0].suggested_price;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            save_suggested_price(){
                if (this.validarPrice()){
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
                axios.post('save_suggested_price',{
                    'suggested_price':this.suggested_price,
                    'id':this.id
                    
                    
                }).then(function (response) {
                    console.log(this.id);
                    me.suggested_price='';
                    me.list_data(1, me.buscar);     
                    me.clastabdetalle3='tab-pane active';
                    me.clastab3='active';         
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
            close_modal(){
                let me= this;
                me.modal_send=0;
                me.modal_detail_pledge=0;
                me.modal_sales=0;
            },
            validarData(){
                this.errors = {};
                this.errorClase=0;
                this.errors.name="";
                this.errors.address="";
                 this.errors.phone="";
                  this.errors.notes="";
                    this.errors.address="";
                    this.errors.amount="";
                    this.errors.totalAmount="";
                //input
                this.errorInputActivity1='form-group has-success';
                this.errorInputActivity2='form-group has-success';
                this.errorInputActivity3='form-group has-success';
                this.errorInputActivity4='form-group has-success';
                this.errorInputAmount='form-group has-success';
                this.errorComboTipoProduco='form-group has-success';
                this.errorTotalAmount='form-group has-success';


                if (!this.name) 
                {   this.errors.name="Ingrese DNI";
                    this.errorInputActivity1='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.address) 
                {   this.errors.address="Ingrese nombre";
                    this.errorInputActivity2='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.phone) 
                {   this.errors.phone="Ingrese apellido paterno";
                    this.errorInputActivity3='form-group has-error';
                    this.errorClase = 1;
                }
                if (!this.notes) 
                {   this.errors.notes="Ingrese apellido materno";
                    this.errorInputActivity4='form-group has-error';
                    this.errorClase = 1;
                }
                
                /*if (!this.amount) 
                {   this.errors.amount="Ingrese monto";
                    this.errorInputAmount='form-group has-error';
                    this.errorClase = 1;
                }*/
               
                return this.errorClase;
            },   
            validarPrice(){
                this.errors = {};
                this.errorClase=0;
                this.errors.suggested_price="";
                this.errorInputActivity1='form-group has-success';

                if (!this.suggested_price) 
                {   this.errors.suggested_price="Ingrese un precio sugerido";
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
				me.list_data(page);
                
            },
           
            edit_data(id){
                let me=this;
                me.listado=2;
                me.limpiar();
                var url= 'get_branch_office?id='+id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.id=respuesta.datax[0].id;
                    me.name = respuesta.datax[0].name;
                    me.address = respuesta.datax[0].address;
                    me.phone = respuesta.datax[0].phone;
                    me.notes =respuesta.datax[0].notes;
                    me.date_init=moment(respuesta.datax[0].date_init).toDate();
                    me.validarData();
                })
                .catch(function (error) {
                    console.log(error);
                });
                              
            },

            save_data(){
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
                axios.post('save_branch_office',{
                    'name':this.name,
                    'address':this.address,
                    'date_init' : moment(moment(this.date_init, 'DD/MM/YYYY')).format('YYYY-MM-DD'),
                    //'state':this.state,
                    'phone':this.phone,
                    'notes':this.notes,
                    'id':this.id
                    
                }).then(function (response) {
                    me.limpiar();
                    me.listado=1; 
                    me.list_data(1, me.buscar);              
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
            delete_data(id){
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
                    axios.post('delete_branch_office',{
                        'id': id

                    }).then(function (response) {
                    me.listado=1;
                    me.list_data(1, me.buscar);
                    }).catch(function (error) {
                        console.log(error);
                    });

                    }else if (result.dismiss === swal.DismissReason.cancel) {}
                }) 
            },
            emprendar(id){
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
            descargar(search){               
                var url= '/downloadprogram?search='+search;
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

            list_data_sale(page, search){
                let me=this;      
                me.listado=0;   
                if(this.button_sale==1){
                    var url= 'get_list_on_sale?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_on_sale=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });  
                    
                    this.list_product_sale=0;
                    this.list_product_pawned=0;
                    this.list_product_defeated=0;

                }else{
                    // var url= 'get_list_data?search='+search+'&page='+page;
                    // axios.get(url).then(function (response) {
                    //     var respuesta= response.data;
                    //     me.list_on_data=respuesta.datax;
                    //     me.pagination= respuesta.pagination; 
                    //     me.listado=1;
                    // })
                    // .catch(function (error) {
                    //     console.log(error);
                    // });
                    var url= 'get_list_on_sale?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_on_sale=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });  
                    var url= 'get_list_pawned?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_pawned=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    var url= 'get_list_defeated?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_defeated=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });    
                    this.list_product_sale=1;
                    this.list_product_pawned=1;
                    this.list_product_defeated=1;
                }   
            }, 
            
            list_data_pawned(page, search){
                let me=this;      
                me.listado=0;    
                if(this.button_pawned==1){
                    var url= 'get_list_pawned?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_pawned=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.list_product_sale=0;
                    this.list_product_pawned=0;
                    this.list_product_defeated=0;
                }else{
                    // var url= 'get_list_data?search='+search+'&page='+page;
                    // axios.get(url).then(function (response) {
                    //     var respuesta= response.data;
                    //     me.list_on_data=respuesta.datax;
                    //     me.pagination= respuesta.pagination; 
                    //     me.listado=1;
                    // })
                    // .catch(function (error) {
                    //     console.log(error);
                    // });
                    var url= 'get_list_on_sale?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_on_sale=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });  
                    var url= 'get_list_pawned?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_pawned=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    var url= 'get_list_defeated?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_defeated=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });           
                    this.list_product_sale=1;
                    this.list_product_pawned=1;
                    this.list_product_defeated=1;
                }  
            },    
            
            list_data_defeated(page, search){
                let me=this;      
                me.listado=0;     
                if(this.button_defeated==1){
                    var url= 'get_list_defeated?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_defeated=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });    
                    this.list_product_sale=0;
                    this.list_product_pawned=0;
                    this.list_product_defeated=0;
                    
                }else{
                    // var url= 'get_list_data?search='+search+'&page='+page;
                    // axios.get(url).then(function (response) {
                    //     var respuesta= response.data;
                    //     me.list_on_data=respuesta.datax;
                    //     me.pagination= respuesta.pagination; 
                    //     me.listado=1;
                    // })
                    // .catch(function (error) {
                    //     console.log(error);
                    // }); 
                    var url= 'get_list_on_sale?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_on_sale=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });  
                    var url= 'get_list_pawned?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_pawned=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    var url= 'get_list_defeated?search='+search+'&page='+page;
                    axios.get(url).then(function (response) {
                        var respuesta= response.data;
                            me.list_defeated=respuesta.datax;
                            me.pagination= respuesta.pagination; 
                            me.listado=1;
                    })
                    .catch(function (error) {
                        console.log(error);
                    }); 
                    this.list_product_sale=1;
                    this.list_product_pawned=1;
                    this.list_product_defeated=1;
                }   
            }, 

            list_only_data_sale(page, search){
                let me=this;      
                me.listado=0;  
                me.list_product_pawned=0;
                me.list_product_defeated=0;
                var url= 'get_list_on_sale?search='+search+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                        me.list_on_sale=respuesta.datax;
                        me.pagination= respuesta.pagination; 
                        me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });   
            },
            list_only_data_defeated(page, search){
                let me=this;      
                me.listado=0; 
                me.list_product_sale=0;
                me.list_product_pawned=0;
                var url= 'get_list_defeated?search='+search+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                        me.list_defeated=respuesta.datax;
                        me.pagination= respuesta.pagination; 
                        me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });        
            },
            list_only_data_pawned(page, search){
                let me=this;      
                me.listado=0;  
                me.list_product_sale=0;
                me.list_product_defeated=0;
                var url= 'get_list_pawned?search='+search+'&page='+page;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                        me.list_pawned=respuesta.datax;
                        me.pagination= respuesta.pagination; 
                        me.listado=1;
                })
                .catch(function (error) {
                    console.log(error);
                });        
            }      
        },
        mounted() {
           this.list_only_data_sale(1, this.buscar);
         }
         
    }
   
</script>

<style>    
.table-bordered th,
.table-bordered td {
  border: 1px solid rgb(204, 198, 198) !important;
  }

</style>

