@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
<h1>Clientes</h1>
@stop

@section('content')
@include('flash::message')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                <div class="data-tables">
                    <input type="hidden" id="columns" value="user,name,email,contact,roles,action">
                    <input type="hidden" id="baseurldatatable" value="{{ URL::to('clients') }}">
                    <input type="hidden" id="baseurlapi" value="{{ URL::to('clients/') }}">
                    <input type="hidden" id="requestType" value="DELETE">
                    <table class="table table-striped table-bordered" style="width:100%" id="datatable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Criado Por</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Contato</th>
                                <th>Grupo</th>
                                <th width="100px">Ações</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.modal')
@stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('js')
<script src="{{ url('js/datatables/datatable-padrao.js') }}"></script>
    <script src="{{ url('js/datatables/form-delete.js') }}"></script>
@stop
