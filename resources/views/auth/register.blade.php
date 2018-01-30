<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <title>Infinity - Bootstrap Admin Template</title>
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	    <meta name="description" content="Admin, Dashboard, Bootstrap" />
	    <link rel="shortcut icon" sizes="196x196" href="../assets/images/logo2.png">
	
	    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
	    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
	    <link rel="stylesheet" href="assets/css/bootstrap.css">
	    <link rel="stylesheet" href="assets/css/core.css">
	    <link rel="stylesheet" href="assets/css/misc-pages.css">
	    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
	</head>
	<body class="simple-page">
	<div class="simple-page-wrap">
	   <div class="simple-page-logo animated swing">
	        <img src="assets/images/certify_college.png" class=".img-responsive">
	    </div><!-- logo -->
	
	    <div class="simple-page-form animated flipInY" id="signup-form">
	        <h4 class="form-title m-b-xl text-center">Crear una cuenta nueva</h4>
	        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
	            {{ csrf_field() }}
	
	            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
	
	                <div class="col-md-12">
	                    <input id="name" type="text" class="form-control" placeholder="Nombre" name="name" value="{{ old('name') }}" required autofocus>
	
	                    @if ($errors->has('name'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('name') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	
	            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
	                <div class="col-md-12">
	                    <input id="email" type="email" placeholder="Email" class="form-control" name="email" value="{{ old('email') }}" required>
	
	                    @if ($errors->has('email'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	
	            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
	
	                <div class="col-md-12">
	                    <input id="password" type="password" placeholder="Contraseña" class="form-control" name="password" required>
	
	                    @if ($errors->has('password'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('password') }}</strong>
	                        </span>
	                    @endif
	                </div>
	            </div>
	
	            <div class="form-group">
	
	                <div class="col-md-12">
	                    <input id="password-confirm" type="password" placeholder="Repetir contraseña" class="form-control" name="password_confirmation" required>
	                </div>
	            </div>
	
	            <div class="form-group">
	                <div class="col-md-12">
	                    <button type="submit" class="btn btn-primary">
	                        Registrarse
	                    </button>
	                </div>
	            </div>
	        </form>
	    </div><!-- #login-form -->
	
	    <div class="simple-page-footer">
	        <p>
	            <a href="{{ url('/login') }}">Iniciar Sesión</a>
	        </p>
	    </div><!-- .simple-page-footer -->
	
	
	</div><!-- .simple-page-wrap -->
	</body>
</html>
