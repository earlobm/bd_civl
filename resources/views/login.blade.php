<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="PRESTA CASH - SISTEMA FINANCIERO DE PRESTAMO Y EMPEÑO">
    <meta name="author" content="De Pixel a Web">
    <meta name="keyword" content="SISTEMA FINANCIERO DE PRESTAMO Y EMPEÑO">

    <title>Ingreso | Sistema de Préstamo</title>

    <link href="css/plantilla.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/icon-tumi.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a>PRESTA<b> CASH</b></a>
        </div>
        <div class="box box-login">
            <div class="box-header with-border">
                <H3 style="text-align:center; margin-top: 0; margin-bottom: 0;font-size: large" href="https://www.unas.edu.pe/UNASPOI/" target="_blank"><b>SISTEMA DE PRÉSTAMO</b> </H3>
            </div>
            <div class="login-box-body">
                <p style="text-align: center; "><img src="{{asset('img/logo-tumi.png')}}" alt="Logo TUMI" style="width:130px; height:130px;"></p>

                <form class="was-validated" method="POST" action="{{ route('login')}}">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                        <span class="glyphicon glyphicon-user form-control-feedback" style="color: #012D74;"></span>    
                        <input style="border-top: none; border-right: none; border-bottom: 1.5px solid #e8eaee; border-left: none; border-image: initial;" type="text" value="{{old('usuario')}}" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                        {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}                        
                    </div>
                    <div class="form-group has-feedback mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                        <span class="glyphicon glyphicon-lock form-control-feedback" style="color: #012D74;"></span>    
                        <input style="border-top: none; border-right: none; border-bottom: 1.5px solid #e8eaee; border-left: none; border-image: initial;" type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
                        {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12" style="float:right; margin-top: 5px">
                            <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 3px">INGRESAR 
                                <span class="glyphicon glyphicon-chevron-right" style="color: write"></span></button>
                        </div>
                        <div class="col-xs-12" style="text-align:center; ">
                        <p data-toggle="modal" data-target="#modal-default" href="#"  style="text-align:center;color:#012D74">¿Has olvidado tu contraseña? Solicita el cambio de contraseña<a href="https://api.whatsapp.com/send?phone=51950645906" target="_blank"><b> aquí.</b></a></p>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Recuperar contraseña</h4>
                        </div>
                        <form method="POST" action="{{ route('restablecer') }}">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="box box-success">

                                    <div class="box-body">
                                        <input name="correo" id="correo" class="form-control" type="text" placeholder="Correo">
                                        <br>
                                        <input name="nick" id="nick" class="form-control" type="text" placeholder="Nick">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .box-header.with-border {
            border-bottom: 1px solid #f4f4f4;
        }
    </style>
    <<script>
        export default {
        $('#show-passwd').on('click', function(e) {
        var current = $(this).attr('action');
        if (current == 'hide') {
        $('#password').attr('type', 'text');
        $('.icon-eye-blocked').attr('class', 'icon-eye');
        $('#show-passwd').attr('action','show');
        }
        if (current == 'show') {
        $('#password').attr('type', 'password');
        $('.icon-eye').attr('class', 'icon-eye-blocked');
        $('#show-passwd').attr('action','hide');
        }
        });
        }
        </script>
</body>

</html>