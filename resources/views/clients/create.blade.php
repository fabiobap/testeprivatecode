@extends('adminlte::page')

@section('title', 'Cliente')

@section('content_header')
<h1>Cliente</h1>
@stop

@section('content')
@include('flash::message')
<div class="row mx-auto">
    <div class="col-md-12">
        <div class="card card-dark">
            <div class="card-header with-border">
                <h3 class="card-title">Cliente Form</h3>
            </div>
            <form action="{{ route('clients.store') }}" method="POST" class="needs-validation" role="form">
                <div class="card-body">
                    @csrf
                    @include('clients._form')
                    <div class="form-group multiple-form-group" data-max=10>
                        <label>Telefone para contato</label>
                        <div class="form-group input-group">
                            <input type="text" name="phoneNumber[]"
                                class="form-control @error('phoneNumber.*') is-invalid @enderror">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-add">+
                                </button>
                            </span>
                            @error('phoneNumber.*')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Cadastrar</button>
                </div>
            </form>
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
@stop
