<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Infinity - Bootstrap Admin Template</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Admin, Dashboard, Bootstrap" />
        <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo.png">

        <link rel="stylesheet" href="../libs/bower/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="../libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="../libs/bower/animate.css/animate.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" href="../assets/css/core.css">
        <link rel="stylesheet" href="../assets/css/misc-pages.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    </head>
    <body class="simple-page">
        <div class="simple-page-wrap">
            <div class="simple-page-logo animated swing">
                <span>
                    <i class="fa fa-gg" style="color:white;"></i>
                </span>
                <span style="color:white;">
                    Infinity
                </span>
            </div><!-- logo -->
            <div class="simple-page-form animated flipInY" id="login-form">
                <h4 class="form-title m-b-xl text-center">Cambiar contraseña</h4>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}                        

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    Buscar
                                </button>
                                <a class="btn btn-link" href="{{ url('/login') }}">
                                    Iniciar Sesión
                                </a>
                            </div>
                        </div>
                    </form>
                </div>                
            </div>
        </div><!-- .simple-page-wrap -->
    </body>
</html>
                                