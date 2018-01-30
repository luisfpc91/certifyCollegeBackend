@extends('layouts.app')

@section('content')
<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-lg-offset-2">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Editar Usuario</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <form method="POST" action="{{ route('user_update', ['id' => $data->id] ) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del usuario..." value="{{ $data->name }}" required/>
                                </div>
                                <div class="form-group">   
                                    <label for="email">E-mail:</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="E-mail del usuario..." value="{{ $data->email }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="level">E-mail:</label>
                                    <select name="level" class="form-control" id="level" required >
                                        @if( $data->level == "admin" )
                                            <option value="{{ $data->level }}" selected>Administrador</option>
                                        @else
                                            <option value="admin" >Administrador</option>
                                        @endif

                                        @if( $data->level == "user" )
                                            <option value="{{ $data->level }}" selected>Usuario</option>
                                        @else
                                            <option value="user">Usuario</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pass">Constraseña:</label>
                                    <input type="password" name="pass" class="form-control" id="pass" placeholder="Constraseña del usuario..." />
                                </div>
                                <div class="form-group">
                                    <label for="pass_confi">Repetir Constraseña:</label>
                                    <input type="password" name="pass_confi" class="form-control" id="pass_confi" placeholder="Repetir Constraseña del usuario..." />
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-md">Editar</button>
                                </div>                                
                            </form>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div><!-- END column -->
            </div><!-- .row -->
        </section>
    </div>
</main>
@endsection
