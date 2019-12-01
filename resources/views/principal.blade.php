
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="PRESTA CASH - SISTEMA FINANCIERO DE PRESTAMO Y EMPEÑO">
    <meta name="author" content="De Pixel a Web">
    <meta name="keyword" content="SISTEMA FINANCIERO DE PRESTAMO Y EMPEÑO">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}">  
    <title>PRESTA CASH | Sistema Financiero de Préstamo y Empeño</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link href="css/plantilla.css" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!--<link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">-->
    <link rel="shortcut icon" href="{{asset('img/icon-tumi.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
  </head>  

  <body class="fixed sidebar-mini sidebar-mini-expand-feature skin-blue-light">
  <div class="loader"></div>
    <div class="wrapper" id="app">
      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo" @click="menu=0">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img style="width:40px; height:37px;" src="{{asset('img/icon-tumi.png')}}" alt="User"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">PRESTA<b> CASH</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a id="navcop" href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <p class="navbar-text"><span class="label bg-success" style="background: yellow; color: #012D74">AMBIENTE DE PRUEBAS</span></p>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <!-- <comboanio :idanio="idanio" ></comboanio> -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">                  
                  <img src="{{asset('img/yesi.PNG')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs"><span style="color: #C1C1C1; font-size:12px">Hola,</span> Admin </span>            
                
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                 <li class="user-header">  
                    <p style="text-align: left">                      
                      <small><i class="icon fa fa-sitemap"></i> Cargo:  </small>
                      <small><i class="icon fa fa-calendar-check-o"></i> Último Ingreso:  </small>
                      <small><i class="icon fa fa-laptop"></i> IP Último Ingreso: </small>                      
                    </p>                    
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">                   
                    <div class="pull-center" >                      
                      <a href="{{url('/logout')}}" style="color: red"><i class="fa fa-power-off"></i>&nbsp;Cerrar Sessión</a>
																	
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
            
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
         @include('sidebar')
       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
	    <div class="content-wrapper">
          
                @yield('contenido')
                        </div>
                      </div>
                    </div>
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!--Fin-Contenido-->
      <div class="example-screen">
        <footer class="main-footer">
          <div class="pull-right hidden-xs">
            <b>Versión</b> 1.0
          </div>
            <strong>PRESTA CASH - TINGO MARIA 0.3.16.0743
            </strong> Copyright &copy; 2019 Todos los derechos reservados <a target="_blank" href="https://www.facebook.com/depixelaweb/">De pixel @ Web.</a> 
        </footer>
      </div>
      
    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
  
   </body>
</html>
 <script type="text/javascript">
      $(window).load(function() {
          //otro
          $(".loader").fadeOut("slow");
        //  $('.select2').select2();
      });
</script>

<script>
  $('li.menux').click(function(){
      $('li.menux').removeClass("active");
      $(this).addClass("active");
      //para ocultar la barra
     if ((screen.width<=800)&&(screen.height<=1280)) {
      $('#navcop').click();
      }
  });
</script>
<style>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('img/loadx1.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
