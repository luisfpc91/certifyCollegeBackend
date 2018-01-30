@extends('frontend.app')
    
  @section('content')
    <div class="container-email">  
      <form id="contact" action="{{ route('practica2', ['id' => $id, 'p' => 'p']) }}" method="POST">
        {{ csrf_field() }}
        <h3 style="text-align: center;">Sistema de Pruebas</h3>
        <h4 class="text-center" style="font-size: 25px;">{{$title}}</h4>
        <fieldset>
          <input placeholder="Ingrese su E-mail" name="email" type="email" tabindex="1" required autofocus />
        </fieldset>
        <br/>
        <fieldset>
          <button name="submit" type="submit" id="contact-submit" data-submit="Enviando...">Enviar</button>
        </fieldset>
      </form>
    </div>
  @endsection  