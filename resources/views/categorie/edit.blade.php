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
                            <h4 class="widget-title">Editar Categoría</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <div class="m-b-lg">
                                <small>
                                    A continuacion deberas ingresar los datos de la categoría.
                                </small>
                            </div>
                            <form method="POST" action="{{ route('categorie_update',['id' => $id]) }}">
                                {{ csrf_field() }}                                
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="title">Nombre:</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $name }}" placeholder="Nombre de la categoría..." required>
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
