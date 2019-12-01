  <link rel="apple-touch-icon" href="">
  <link rel="shortcut icon" href="">
   
  <aside class="main-sidebar" >
    <div class="slimScrollDiv">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{asset('img/yesi.PNG')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <small>Administrador</small><br>
              <a href="#"><i class="fa fa-circle text-success"></i> En línea</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu"> 
            <li class="header">SISTEMA DE PRÉSTAMOS<div></div></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cogs" style="color: #00A3FF !important;"></i>
                <span>OPERACIONES</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li @click="menu=13"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-users" style="color: #FF5100"></i>Clientes
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li> 

                <li @click="menu=13"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-users" style="color: #FF5100"></i>Historial
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li> 

                <li @click="menu=100"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-users" style="color: #FF5100"></i>Cobranza de prestamos
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li> 

                <li @click="menu=22"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-tags" style="color: #FF5100"></i>Monto por promotor 
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>

                <li @click="menu=22"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-tags" style="color: #FF5100"></i>Balance diario
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>


                <li @click="menu=25"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-sitemap" style="color: #00A5C8 !important;"></i>Resumen del Dia
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>

                <li class="treeview">
                  <a href="#"><i class="fa fa-calculator" style="color: #FFA100"></i>Caja
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li  @click="menu=7"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-sign-in "></i>Ingresos</a>
                    </li>
                    
                    <li  @click="menu=9"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-sign-out"></i>Egresos</a>
                    </li>
                    <li  @click="menu=10"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-balance-scale"></i>Arqueo de caja</a>
                    </li>                    
                  </ul>
                </li>

              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shield" style="color: #FFB400 !important;"></i>
                <span>MANTENIMIENTO</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>               
              <ul class="treeview-menu"> 
                <li @click="menu=15"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-building" style="color: #00AE01 !important;"></i>Sucursal
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>

                <li @click="menu=19"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-home" style="color: #00AE01 !important;"></i>Mercado
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
              
                <li @click="menu=23"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-users" style="color: #00AE01 !important;"></i>Tipo de Negocio
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
                                     
                <li @click="menu=24"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-sitemap" style="color: #00A5C8 !important;"></i>Tipo de Documento
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>

                <li @click="menu=2"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-black-tie" style="color: #FF5100"></i>Promotores
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li> 

                
              </ul>        
            </li>     
            <li class="header">SIG<div></div></li>           
          

            <li class="treeview">
              <a href="#">
                <i class="fa fa-line-chart" style="color: #148B00 !important;"></i>
                <span>REPORTES</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>               
              <ul class="treeview-menu">                        
              <li @click="menu=13" class="menux" class="treeview">
                  <a href="#"><i class="fa  fa-bar-chart" style="color: #3300AF !important;"></i>Monto cobrado
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
                                    
                <li @click="menu=13"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-list-ul" style="color: #A60091 !important;"></i>Prestamos Efectuados
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
              </ul>        
            </li>  
               
            
            <li class="header">ADMINISTRACIÓN<div></div></li>    
            <li class="treeview">
              <a href="#">
                <i class="fa fa-shield" style="color: #FFB400 !important;"></i>
                <span>SEGURIDAD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>               
              <ul class="treeview-menu">                        
                <li @click="menu=16"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-users" style="color: #00AE01 !important;"></i>Usuarios
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
                                     
                <li @click="menu=17"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-sitemap" style="color: #00A5C8 !important;"></i>Roles
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
                                 
                <li @click="menu=18"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-street-view" style="color: #DF2727 !important;"></i>Mi Perfil
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
              </ul>        
            </li>  
          </ul>
        </section>
        <div class="slimScrollBar"></div>
        <div class="slimScrollRail"></div>   
      </div>
        <!-- /.sidebar -->
    </aside>
  