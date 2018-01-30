@extends('layouts.app')

@section('content')
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-lg-offset-2">
                        <div class="widget p-lg">
                            <h4 class="m-b-lg">Categorias</h4>
                            <p class="m-b-lg docs">
                                Lista de las categorias mas recientes.
                            </p>

                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th>                                   
                                        <th>Nombre</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($data as $d)
                                        <tr>
                                            <td>{{$d->id}}</td>      
                                            <td>{{$d->name}}</td>
                                            <td> 
                                                <a class="btn btn-sm btn-primary" href="{{ route('categorie_edit', ['id' => $d->id]) }}" type="button" title="Editar">
                                                    <i class="fa fa-pencil"></i>
                                                </a>  
                                            </td>
                                            <td>
                                                <form action="{{ route('categorie_delete', ['id' => $d->id]) }}" method="POST" enctype="multipart/form-data" class="btn-delete-modal">
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
