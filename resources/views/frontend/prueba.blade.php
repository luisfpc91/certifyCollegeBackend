  @extends('frontend.app')

  @section('content')
    <div class="container">  
      <form id="contact" style="margin-top:50px !important;" action="{{ route('results.store') }}" method="POST">
        {{ csrf_field() }}
        <h3 class="text-center">{{ $data->title }}</h3>        
        <h4>{{ $data->description }}</h4>
        <input type="hidden" name="email" value="{{ $data->email }}"/>
        <input type="hidden" name="id_quiz" value="{{ $data->id }}"/>
        <input type="hidden" name="act" value="real" />
        @foreach($data->questions as $q)
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="title_list">{{ $q->name }}</h3>
              <input type="hidden" id="question" name="question[{{$q->id}}]" value="{{ $q->id }}" required/>
            </div>
            <div class="panel-body">                           
              <ul class="list-group">
                @foreach($q->answer as $a)                  
                  <li class="list-group-item">
                    <div class="radio">                      
                      <label>
                        <input type="radio" id="answer" name="answer[{{$q->id}}]" value="{{ $a->id }}" required/>
                        {{ $a->name }}
                      </label>
                    </div>                    
                  </li>
                @endforeach
              </ul>
            </div>
          </div>
        @endforeach 
        <br/>   
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="Enviando...">Enviar</button>
        </fieldset>
      </form>
    </div>
  @endsection    