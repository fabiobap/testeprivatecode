@extends('adminlte::page')

@section('title', 'Painel de Controle')

@section('content_header')
<h1 class="text-center">Configurações do Usuário</h1>
@stop

@section('content')
@include('flash::message')
<div class="row justify-content-center">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trocar senha</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('change.password') }}" method="POST" class="needs-validation" role="form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Entre com uma senha nova">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="password_confirmation">Confirme a senha</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Entre com uma senha nova">
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
