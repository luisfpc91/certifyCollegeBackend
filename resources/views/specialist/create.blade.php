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
                            <h4 class="widget-title">Nuevo Especialista</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <div class="m-b-lg">
                                <small>
                                    A continuacion deberas ingresar los datos para crear el nuevo especialista.
                                </small>
                            </div>
                            <form method="POST" action="{{ route('create_specialist') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Nombre y apellido:</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del especialista..." required>
                                </div>
                                 <div class="form-group">
                                    <label for="description">Descripción del perfil:</label>
                                    <textarea id="description" class="form-control" name="description" placeholder="Descripción..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_quiz">Prueba en la que actuará como especialista:</label>
                                    <select id="id_quiz" name="id_quiz" class="form-control">
                                        @foreach($data as $q) 
                                            <option value="{{ $q->id }}">{{ $q->title }}</option>
                                        @endforeach;
                                    </select>
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

