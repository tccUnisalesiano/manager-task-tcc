$(document).ready(function (){
    $.ajax({
        type: 'POST',
        url: 'tratamentodados/projetos',
        dataType: 'JSON',
        success: function(response) {
            console.log(response);

            response.response.forEach((resp) => {
                $("#tblDetalhes").append
                (`<tr class="filtroProj">
                        <td> ${resp.id} </td>
                        <td> ${resp.nome} </td>
                        <td> ${resp.data_inicial} </td>
                        <td> ${resp.data_entrega_final} </td>
                        <td> ${resp.situacao} </td>
                    </tr>`);
            });
        }, complete: function(resp) {
            console.log(resp);
        }
    })
});

$('#tblDetalhes').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('id') // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('New message to ' + recipient)
    modal.find('.modal-body input').val(recipient)
})