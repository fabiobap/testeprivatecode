@extends('adminlte::page')

@section('title', 'Painel de Controle')

@section('content_header')
<h1 class="text-center">Gerenciamento de Grupos</h1>
@stop

@section('content')
@include('flash::message')
<div class="row justify-content-center">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Criar Grupos</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('roles.store') }}" method="POST" class="needs-validation" role="form">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="new_role_name">Nome</label>
                        <input type="text" class="form-control @error('new_role_name') is-invalid @enderror"
                            id="new_role_name" name="new_role_name" placeholder="Entre com um novo grupo">
                        @error('new_role_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="permissions_to_roles">Permissões para esse grupo</label>
                        <select name="permissions_to_roles[]" id="permissions_to_roles"
                            class="form-control @error('new_role_name') is-invalid @enderror" multiple>
                            @foreach ($permissions as $permission)
                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        @error('permissions_to_roles')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">Criar Grupo</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Alterar Grupos/Permissões</h3>
            </div>
            <!-- /.card-header -->
            <form action="{{ route('update.usergroup') }}" method="POST" class="needs-validation" role="form">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="role_name">Grupos Existentes</label>
                        <select class="custom-select @error('role_name') is-invalid @enderror" name="role_name"
                            id='role_name' required>
                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}">
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('role_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="user_id">Usuários do sistema</label>
                        <select class="custom-select @error('user_id') is-invalid @enderror" name="user_id" id='user_id'
                            required>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">Atualizar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Grupos do Sistema</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Usuários do grupo</th>
                            <th scope="col">Permissões</th>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->users as $user)
                                    <span>{{ $user->name }}, </span>
                                @endforeach
                            </td>
                            <td>
                                @if (count($role->getAllPermissions()) > 0)
                                @foreach ($role->getAllPermissions() as $permission)
                                <p>{{ $permission->name }}</p>
                                @endforeach
                                @else
                                -
                                @endif
                            </td>
                        <tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
