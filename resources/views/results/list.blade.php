@extends('layouts.app')

@section('content')
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
        <div class="wrap">
            <section class="app-content">
                <div class="row">
                    <div class="col-md-12 col-lg-8 col-lg-offset-2">
                        <div class="widget p-lg">
                            <h4 class="m-b-lg">Resultados</h4>
                            <p class="m-b-lg docs">
                                Lista de los resultados mas recientes.
                            </p>

                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Prueba</th>
                                    <th>Email</th>
                                    <th>Puntuación</th>
                                    <th></th>  
                                </tr>
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->id}}</td>
                                        @if($d->quiz)
                                            <td>{{$d->quiz->title}}</td>
                                        @else
                                            <td>{{$d->id_quiz}}</td>
                                        @endif
                                        <td>{{$d->email}}</td>
                                        <td>{{$d->total}}</td>
                                        @if($d->quiz)
                                            <td>
                                                <a class="btn btn-sm btn-info" href="{{ route('test_details', ['id' => $d->id]) }}" type="button" title="Detalles">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        @endif    
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
