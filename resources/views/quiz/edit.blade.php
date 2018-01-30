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
                            <h4 class="widget-title">Editar prueba</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                            <div class="m-b-lg">
                                <small>
                                    A continuación deberas editar los datos de la prueba.
                                </small>
                            </div>
                            <form method="POST" action="{{ route('quiz_update', ['id' => $data->id] ) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label for="title">Título:</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Título de la prueba..." value="{{ $data->title }}" required/>
                                </div>
                                <div class="form-group">
                                    <label for="categorie">Categoría:</label>
                                    <select name="id_categorie" class="form-control" id="categorie" placeholder="Categoría de la prueba..." required>
                                        @foreach($data->categories as $d)
                                            @if($data->categorie->id == $d->id)
                                                <option value="{{$d->id}}" selected>
                                                    {{$d->name}}
                                                </option>
                                            @else
                                                <option value="{{$d->id}}" >
                                                    {{$d->name}}
                                                </option>
                                            @endif
                                                    
                                        @endforeach       
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción:</label>
                                    <textarea type="text" name="description" class="form-control" id="description" placeholder="Descripción de la prueba..." >{{ $data->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Precio:</label>
                                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Precio de la prueba..." value="{{$data->amount}}" required />
                                </div>
                                <div class="form-group">
                                    <label for="currency">Moneda:</label>
                                    <select name="currency" class="form-control" id="currency" required>
                                        @if($data->currency == "MXN")
                                            <option value="{{$data->currency}}" selected>
                                                {{$data->currency}}
                                            </option>
                                        @else
                                            <option value="MXN">MXN</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email del administrador:</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email del administrador de la prueba..." value="{{ $data->email }}" required />
                                </div>
                                <div class="form-group">
                                    <label for="url_to">URL:</label>
                                    <input type="text" name="url_to" class="form-control" id="url_to" placeholder="Url de la prueba..." value="{{ $data->url_to }}" required />
                                    <span class="help-block">Ejem: /espanol - <i style="color:red">No puede llevar caracteres especiales, como: acentos, comas, la letra ñ, etc.</i>
                                    </span>
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
