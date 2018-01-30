@extends('layouts.app')

@section('content')
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12 col-lg-11 col-lg-offset-0">
                        <div class="widget p-lg">
                            <h4 class="m-b-lg">Pruebas</h4>
                            <p class="m-b-lg docs">
                                Lista de las pruebas mas recientes.
                            </p>

                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>           
                                    <th>Nombre</th>
                                    <th>Categoría</th>
                                    <th>Precio</th>
                                    <th>Moneda</th>
                                    <th>Email Admin</th>
                                    <th>Url</th>
                                    <th>Preguntas</th>
                                    <th>Demo</th>
                                    <th>Editar</th>
                                    <th>Borrar</th>
                                </tr>
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->id}}</td>                  
                                        <td>{{$d->title}}</td>
                                        <td>{{$d->categorie->name}}</td>
                                        <td>{{$d->amount}}</td>
                                        <td>{{$d->currency}}</td>
                                        <td>{{$d->email}}</td>
                                        <td>{{$d->url_to}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('quiz_detail', ['id' => $d->id]) }}" type="button" title="Preguntas">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </td>                                             
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{ $d->link }}" type="button" title="Ir a la prueba" target="_blank">
                                                <i class="fa fa-external-link"></i>
                                            </a>  
                                        </td>
                                        <td> 
                                            <a class="btn btn-sm btn-primary" href="{{ route('quiz_edit', ['id' => $d->id]) }}" type="button" title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>                                            
                                        </td>
                                        <td>
                                            <form action="{{ route('quiz_delete', ['id' => $d->id]) }}" method="POST" enctype="multipart/form-data" class="btn-delete-modal">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-sm btn-danger" type="submit" title="Borrar" href="">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">
                                {{ $data->links() }}
                            </div>
                        </div><!-- .widget -->
                    </div>
                </div><!-- .row -->
            </section>
        </div>
    </main>
@endsection
