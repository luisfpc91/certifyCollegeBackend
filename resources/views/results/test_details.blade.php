@extends('layouts.app')

@section('content')
  <main id="app-main" class="app-main">
      <div class="wrap">
          <section class="app-content">
              <div class="row">
                  <div class="col-md-12 col-lg-8 col-lg-offset-2">
                      <div class="widget p-lg">
                          <h3 class="">{{ $data->quiz->title }}</h3>        
                          <h4>{{ $data->quiz->description }}</h4>
                          <br/>
                          <h4>Participarte: <strong>{{ $data->email }}</strong> - Puntuación de la prueba: <strong>{{ $data->total }}</strong>
                            
                          <p>
                            <br/>
                            *El simbolo <i class="fa fa-check" style="color:green;"></i> marca las respuestas hechas por el usuario.<br/>
                            *Las respuestas correctas de cada pregunta, son las que tienen el mayor puntaje.
                          </p>
                          </h4>
                          <br/>
                          @foreach($data->questions as $q)
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                <h3 class="title_list">{{ $q->name }}</h3>
                              </div>
                              <div class="panel-body">  
                                <ul class="list-group">
                                  @foreach($q->answer as $a)                
                                    <li class="list-group-item">
                                      <div class="form-group" >       
                                        @if($a->check)
                                          <span > 
                                            <i class="fa fa-check" style="color:green;"></i>
                                            {{ $a->name }} = <strong>{{ $a->value }} puntos</strong>
                                          </span>
                                        @else
                                          <span>
                                            <i class="fa fa-circle-thin"></i>
                                              {{ $a->name }} = <strong>{{ $a->value }} puntos</strong>
                                          </span>
                                        @endif  
                                      </div>                    
                                    </li>
                                  @endforeach
                                </ul>
                              </div>
                            </div>
                          @endforeach 
                          <br/>
                          <div class="form-group text-center">
                            <a class="btn btn-info" href="{{ route('results.index') }}">
                              Volver
                            </a>                            
                          </div>
                      </div><!-- .widget -->
                  </div>
              </div><!-- .row -->
          </section>
      </div>
  </main>
@endsection    