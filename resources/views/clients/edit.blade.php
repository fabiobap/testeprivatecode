@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
<h1>Dados do Cliente {{ $client->name }}</h1>
@stop

@section('content')
@include('flash::message')
<div class="row">
    <div class="col-md-6">
        <div class="card card-dark">
            <div class="card-header with-border">
                <h3 class="card-title">Cliente Form</h3>
            </div>
            <form action="{{ route('clients.update', ['client' => $client->id]) }}" method="POST"
                class="needs-validation" role="form">
                <div class="card-body">
                    @csrf
                    @method('PUT')
                    @include('clients._form')
                    <div class="form-group multiple-form-group" data-max=10>
                        <label>Novos telefones para contato</label>
                        <div class="form-group input-group">
                            <input type="text" name="phoneNumber[]" class="form-control">
                            <span class="input-group-btn"><button type="button" class="btn btn-default btn-add">+
                                </button></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Atualizar</button>
                </div>
            </form>
        </div>
        <hr>
    </div>
    <div class="col-md-6">
        <div class="card card-dark">
            <div class="card-header with-border">
                <h3 class="card-title">Contato</h3>
            </div>
            <div class="card-body">
                <label>Telefones:</label>
                @foreach ($client->phones as $phone)
                <form action="{{ route('phones.update', ['phone' => $phone->id]) }}" method="POST"
                    class="needs-validation" role="form">
                    @csrf
                    @method('PUT')
                    <div class="form-group multiple-form-group">
                        <div class="form-group input-group">
                            <input type="text" name="oldPhoneNumber" value="{{ $phone->phoneNumber }}"
                                class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-dark" type="submit">
                                    <i class="fas fa-edit"></i></button>
                                <a class="btn btn-danger" style="color: #fff;"
                                    onclick="event.preventDefault();document.getElementById('delete-phone{{$phone->id}}').submit();">
                                    <i class="fas fa-trash"></i></a>
                            </span>
                        </div>
                    </div>
                </form>
                <form action="{{ route('phones.destroy', ['phone'=>$phone->id]) }}" method="post"
                    id="delete-phone{{$phone->id}}" style="display:none">
                    @csrf
                    @method('DELETE')
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    (function ($) {
    $(function () {

    var addFormGroup = function (event) {
    event.preventDefault();

    var $formGroup = $(this).closest('.form-group');
    var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
    var $formGroupClone = $formGroup.clone();

    $(this)
    .toggleClass('btn-default btn-add btn-danger btn-remove')
    .html('–');

    $formGroupClone.find('input').val('');
    $formGroupClone.insertAfter($formGroup);

    var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
    if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
        $lastFormGroupLast.find('.btn-add').attr('disabled', true); } }; var removeFormGroup=function (event) {
        event.preventDefault(); var $formGroup=$(this).closest('.form-group'); var
        $multipleFormGroup=$formGroup.closest('.multiple-form-group'); var
        $lastFormGroupLast=$multipleFormGroup.find('.form-group:last'); if ($multipleFormGroup.data('max')>=
        countFormGroup($multipleFormGroup)) {
        $lastFormGroupLast.find('.btn-add').attr('disabled', false);
        }

        $formGroup.remove();
        };

        var countFormGroup = function ($form) {
        return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);

        });
    })(jQuery);
</script>
<script>
</script>
@stop
