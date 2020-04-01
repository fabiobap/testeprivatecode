function modalDelete(id){
    let modal = $("#modalConfirmaDeletado");
    $("#TituloModalCentralizado").text($(".header-title").text());
    modal.modal('show');
    $("#modal-confirma").remove();
    $("#modal-texto").text('Registro apagado com sucesso!').removeClass('alert-success').removeClass('alert-danger');
    $("#modal-texto").text('Deseja remover esse registro?');

    modal.find('.modal-footer').append('<button id="modal-confirma" onclick="actionDelete(' + id + ')" class="btn btn-danger"><i class="fa fa-check-circle"></i> Sim</button>');

}
function actionDelete(id){

    let url = $('#baseurlapi').val() + '/' + id;
    let requestType = $('#requestType').val();
    var $button = $(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json',
        },
        cache:false,
    });

    $.ajax({
        url: url,
        type: requestType,
        contentType: "json",
        dataType: "JSON",
    })
    .done  (function(data, textStatus, jqXHR)        {
        $("#modal-texto").text('Registro removido com sucesso!').addClass('alert-success');
    })
    .fail  (function(jqXHR, textStatus, errorThrown) {
        var responseText = jQuery.parseJSON(jqXHR.responseText);
        $("#modal-texto").text(responseText.error).addClass('alert-danger');
    })
    .always(function(jqXHROrData, textStatus, jqXHROrErrorThrown)     {
        $('#datatable').DataTable().draw(false);
        $('#datatable').DataTable().ajax.reload();
        $("#modal-confirma").remove();
    });
}
