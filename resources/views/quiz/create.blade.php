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
                            <h4 class="widget-title">Nueva Prueba</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <div class="m-b-lg">
                                <small>
                                    A continuacion deberas ingresar los datos para comenzar a crear la prueba.
                                </small>
                            </div>
                            <form method="POST" action="{{ route('quiz_create') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Título:</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Título de la prueba..." required>
                                </div>
                                 <div class="form-group">
                                    <label for="categorie">Categoría:</label>
                                    <select name="id_categorie" class="form-control" id="categorie" placeholder="Categoría de la prueba..." required>
                                        @foreach($data as $d)
                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                        @endforeach       
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción:</label>
                                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Descripción de la prueba..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Precio:</label>
                                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Precio de la prueba..." required />
                                </div>
                                <div class="form-group">
                                    <label for="currency">Moneda:</label>
                                    <select name="currency" class="form-control" id="currency" required>
                                        <option value="MXN">MXN</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email del administrador:</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email del administrador de la prueba..." required>
                                </div>
                                <div class="form-group">
                                    <label for="url_to">URL:</label>
                                    <input type="text" name="url_to" class="form-control url_to" id="url_to" placeholder="Url de la prueba..." required />
                                    <span class="help-block">Ejem: /espanol - <i style="color:red">No puede llevar caracteres especiales, como: acentos, comas, la letra ñ, etc.</i>
                                    </span>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success btn-md">Crear</button>
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

