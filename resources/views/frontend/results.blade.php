  @extends('frontend.app')

  @section('content')
    <div class="container-email">  
      <form id="contact" style="margin-top:50px !important;">
        <h3 class="text-center">{{ $a['title'] }}</h3>        
        <h4>{{ $a['description'] }}</h4>      
          <div class="panel panel-default">
            <div class="panel-body">            
              <h2 class="text-center">Gracias por participar</h2>
              <h4 class="">Está es tu puntuación <strong style="font-size:20px;">"{{$a['total']}}"</strong>. Te enviaremos el resultado a tu correo.</h4>
            </div>  
          </div>
      </form>
    </div>
  @endsection    