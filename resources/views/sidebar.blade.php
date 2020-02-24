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
            <li class="header">SISTEMA MUNICIPAL<div></div></li>
            <li class="treeview active">
              <a href="#">
                <i class="fa fa-cogs" style="color: #00A3FF !important;"></i>
                <span>REGISTRO CIVIL</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">                 
                <li class="treeview">
                  <a href="#"><i class="fa fa-users" style="color: #FFA100"></i>Ciudadanos
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li  @click="menu=13"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-plus "></i>Añadir Ciudadano</a>
                    </li>
                    
                    <li  @click="menu=26"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-list"></i>Listar Ciudadano</a>
                    </li>                 
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#"><i class="fa  fa-odnoklassniki" style="color: #DF2727"></i>Recien Nacidos
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li  @click="menu=27"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-plus "></i>Añadir Recien Nacidos</a>
                    </li>
                    
                    <li  @click="menu=26"  class="menux" class="treeview">
                      <a href="#" ><i class="fa fa-list"></i>Listar Recien Nacidos</a>
                    </li>                 
                  </ul>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-line-chart" style="color: #148B00 !important;"></i>
                <span>REPORTES</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>               
              <ul class="treeview-menu">                        
              <li @click="menu=13" class="menux" class="treeview">
                  <a href="#"><i class="fa  fa-bar-chart" style="color: #3300AF !important;"></i>ADTIVIDADES COMPLEMEN
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
                                    
                <li @click="menu=13"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-list-ul" style="color: #A60091 !important;"></i>ADTIVIDADES COMPLEMEN
                      <!-- <i class="fa fa-angle-left pull-right"></i> -->
                  </a>
                </li>
              </ul>        
            </li>  
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit" style="color: #FFB400 !important;"></i>
                <span>CONFIGURACION</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>               
              <ul class="treeview-menu"> 
                
                                     
                <li @click="menu=24"  class="menux" class="treeview">
                  <a href="#"><i class="fa fa-sitemap" style="color: #00A5C8 !important;"></i>Tipo de Documento
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
  