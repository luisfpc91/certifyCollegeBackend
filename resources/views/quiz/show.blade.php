@extends('layouts.app')

@section('content')
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main in">
        <div class="wrap">
            <!-- CONTENT -->
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-lg-offset-2">
                        <h2 style="display: inline">{{$title}}</h2>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('quiz_edit', ['id' => $id]) }}" type="button" title="Editar">
                                <i class="fa fa-pencil"></i>
                            </a> 
                            <span>
                                <form style="display: inline" action="{{ route('quiz_delete', ['id' => $id]) }}" method="POST" enctype="multipart/form-data" class="btn-delete-modal">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-sm btn-danger" type="submit" title="Borrar" >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </span>                           
                        </div>  
                        <h4>{{$categorie->name}}</h4>                      
                        <h4 class="text-justify">{{$description}}</h4>
                        <span class="clearfix"></span>
                        <hr>
                        <div class="panel-group accordion" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="widget">
                                <div class="widget-body">
                                    <form method="POST" action="{{ route('question_create') }}" >
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" value="{{$id}}" name="id_quiz">
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Pregunta" required/>
                                                <span class="input-group-btn">
                                                     <button type="submit" class="btn btn-success">Agregar</button>
                                                </span>      
                                            </div>                                           
                                        </div>
                                    </form>
                                </div><!-- .widget-body -->
                            </div>
                            <hr>
                            @foreach($questions as $a)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading-1">
                                        <a class="accordion-toggle" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$a->id}}" aria-expanded="true" aria-controls="collapse-1">
                                            <h4 class="panel-title">{{$a->name}}</h4>
                                            <i class="fa acc-switch"></i>
                                        </a>
                                    </div>
                                    <div id="collapse_{{$a->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-1">
                                        <div class="panel-body">       
                                            <span class="pull-right"> 
                                                <a class="btn btn-sm btn-primary " href="{{ route('question_edit', ['id' => $a->id]) }}" type="button" title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form style="display: inline" action="{{ route('question_delete', ['id' => $a->id]) }}" method="POST" enctype="multipart/form-data" class="btn-delete-modal">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-sm btn-danger" type="submit" title="Borrar" href="">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>               
                                            </span>
                                            <span class="clearfix"></span>
                                            <br/> 
                                            <div class="list-group">
                                                @foreach($a->answer as $qa)
                                                    <a href="javascript:void(0)" class="list-group-item">{{$qa->name}} = {{$qa->value}} puntos</a>
                                                @endforeach
                                            </div>
                                            <hr/>
                                            <form method="POST" action="{{ route('answer_create') }}" class="">
                                                {{ csrf_field() }}
                                                <div class="form-group ">
                                                    <input type="hidden" value="{{$id}}" name="id_quiz">
                                                    <input type="hidden" value="{{$a->id}}" name="id_question">
                                                    <p class="text-justify">Colocale mayor <strong>puntaje</strong> a la respuesta que consideres la <strong>correcta</strong></p>
                                                    <div class="input-group">
                                                        <input type="text" name="name" class="form-control " id="name" placeholder="Respuesta" required>
                                                        <span class="input-group-addon"></span>
                                                        <input type="text" name="value" class="form-control " id="value" placeholder="Valor" required>
                                                        <span class="input-group-btn">
                                                            <button type="submit" class="btn btn-success ">Agregar</button>
                                                        </span>
                                                    </div>    
                                                </div>  
                                            </form>              
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="form-group text-center">
                            <a class="btn btn-info" href="{{ route('quiz_list') }}">
                                Volver
                            </a>
                        </div>                       
                    </div><!-- END column -->
                </div>
            </section><!-- .app-content -->
        </div><!-- .wrap -->
        <!-- APP FOOTER -->
        <div class="wrap p-t-0">
            <footer class="app-footer">
                <div class="clearfix">
                    <ul class="footer-menu pull-right">
                        <li><a href="javascript:void(0)">Careers</a></li>
                        <li><a href="javascript:void(0)">Privacy Policy</a></li>
                        <li><a href="javascript:void(0)">Feedback <i class="fa fa-angle-up m-l-md"></i></a></li>
                    </ul>
                    <div class="copyright pull-left">Copyright RaThemes 2016 ©</div>
                </div>
            </footer>
        </div>
        <!-- /#app-footer -->
    </main>
@endsection
