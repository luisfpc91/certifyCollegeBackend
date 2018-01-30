@extends('layouts.app')

@section('content')
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main in">
        <div class="wrap">
            <!-- CONTENT -->
            <section class="app-content">
                <div class="row">                    
                    <div class="col-md-12 col-lg-8 col-lg-offset-2">   
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title text-center">Editar la pregunta</h2>
                                <span class="clearfix"></span> 
                            </div>
                            <div class="panel-body">
                                <form method="POST" action="{{ route('question_update', ['id' => $data->id]) }}" id="form_edit_question" class="" enctype="multipart/form-data" style="display: inline;">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="name" name="name" class="form-control" placeholder="Pregunta" value="{{$data->name}}" required/>
                                            <div class="input-group-btn" >
                                                <button type="submit" title="Editar" class="btn btn-primary" id="btn_edit_question" form="form_edit_question">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger" type="submit" title="Borrar" form="form_delete_question">
                                                    <i class="fa fa-trash"></i>
                                                </button>  
                                            </div>
                                        </div>        
                                    </div>
                                </form>                                  
                                <form style="display: inline;" action="{{ route('question_delete', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data" class="form-inline btn-delete-modal" id="form_delete_question">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                </form>    
                                <br/>
                                <h4 class="text-center">Respuestas</h4>
                                <ul class="list-group">
                                    @foreach($data->answers as $an)
                                        <li class="list-group-item">
                                            <form action=" {{ route('answer_update', ['id' => $an->id, 'id_q' => $an->id_question]) }} " style="display: inline;" class="" method="POST" enctype="multipart/form-data" id="form_edit_answer_{{$an->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <input id="name" name="name" class="form-control" value="{{ $an->name }}" placeholder="Respuesta" required/>
                                                        <span class="input-group-addon">=</span>
                                                        <input id="value" name="value" class="form-control" value="{{ $an->value }}" placeholder="Valor" required/>
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary " type="submit" form="form_edit_answer_{{$an->id}}">
                                                                <i class="fa fa-pencil" title="Editar"></i>
                                                            </button>
                                                            <button class="btn  btn-danger" type="submit" title="Borrar" form="form_delete_answer_{{$an->id}}" >
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </span>
                                                    </div>    
                                                </div>   
                                            </form>
                                            <form style="display: inline; " action="{{ route('answer_delete', ['id' => $an->id, 'id_q' => $an->id_question]) }}" method="POST" enctype="multipart/form-data" class="form-inline btn-delete-modal" id="form_delete_answer_{{$an->id}}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}   
                                            </form>    
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
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
