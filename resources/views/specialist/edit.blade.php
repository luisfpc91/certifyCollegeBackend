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
                            <h4 class="widget-title">Editar especialista</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <div class="m-b-lg">
                                <small>
                                    A continuación deberas editar los datos.
                                </small>
                            </div>
                            <form method="POST" action="{{ route('update_specialist',['id' => $data->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="name">Nombre:</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Nombre del especialista..." value="{{ $data->name }}" required>
                                </div>
                                 <div class="form-group">
                                    <label for="description">Descripción del perfil:</label>
                                    <textarea id="description" class="form-control" name="description" placeholder="Descripción..." required>{{ $data->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="id_quiz">Prueba en la que actuará como especialista:</label>
                                    <select id="id_quiz" name="id_quiz" class="form-control" >
                                        @foreach($data->prueba as $q)
                                            @if($data->id_quiz == $q->id)
                                                <option value="{{ $q->id }}" selected="selected">{{ $q->title }}</option>
                                            @else
                                                <option value="{{ $q->id }}">{{ $q->title }}</option>
                                            @endif;    
                                        @endforeach;
                                    </select>
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
