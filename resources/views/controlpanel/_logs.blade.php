@extends('adminlte::page')

@section('title', 'Painel de Controle')

@section('content_header')
<h1>Log de Atividades</h1>
@stop

@section('content')
@include('flash::message')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Atividade do Usuário</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Data do Registro</th>
                            <th scope="col">Ação</th>
                            <th scope="col">Descrição / Atributos</th>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                        @php
                        $logDecoded = json_decode($log);
                        @endphp

                        <tr>
                            <td>{{ \Carbon\Carbon::parse($logDecoded->created_at)->format('d-m-Y H:i:s') }} </td>
                            <td>{{ $logDecoded->description }}</td>
                            <td>
                                @if (!empty($logDecoded->properties))
                                @if (array_key_exists('old',$logDecoded->properties))
                                <p>
                                    Dados antigos:
                                </p>
                                <p>
                                    @foreach ($logDecoded->properties->old as $key => $item)
                                    {{ $key }}: {{ $item }}
                                    @endforeach
                                </p>
                                @endif
                                @if (array_key_exists('attributes',$logDecoded->properties))
                                <p>
                                    Dados novos:
                                </p>
                                <p>
                                    @foreach ($logDecoded->properties->attributes as $key => $item)
                                    {{ $key }}: {{ $item }}
                                    @endforeach
                                </p>
                                @endif
                                <hr>
                                @else
                                -
                                @endif
                            </td>
                        <tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
