@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@include('flash::message')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="position-relative p-3 bg-gray" style="height: 300px">
            <div class="ribbon-wrapper ribbon-lg">
                <div class="ribbon bg-success text-lg">
                    Resumo
                </div>
            </div>
            Basicamente fiz o que foi pedido com alguma adaptação ou outra por falta de entendimento/informação, por se tratar de um teste optei por não perguntar e me virar sozinho.<br/>
            <ul>
            <li>Um Usuário pode criar <strong>N</strong> clientes, que pode ter <strong>N</strong> telefones.</li>
            <small>Pro whatsapp eu apenas utilizei uma API deles mesmo que você só envia o nº do telefone (formatado/com DDI e DDD) e abre o chat se você tiver o contato</small>
            <li>Um Usuario tem log de suas atividades.</li>
            <li>Um Usuário pode trocar a sua própria senha.</li>
            <li><strong>N</strong> Usuarios podem pertencer a <strong>N</strong> grupos e nesses grupos podem ter diferentes permissões para ações.</li>
            <li>Apenas um Usuario 'Super Admin' tem o poder de criar grupos e adicionar pessoas aos grupos/permissões.</li>
            <small>Nesta parte que achei confuso o que estava escrito como "usuario principal" e optei por deixar apenas um 'Super Admin' com esse poder.</small>
            <li>'Super Admin' tem acesso a tudo.</li>
            </ul>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
@stop
