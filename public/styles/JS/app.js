$(document).ready( function(){
    $("#cliente_celularCliente").mask("(99) 99999-9999");

    $('#cliente_cpf_cnpj').mask('000.000.000-00', {
        onKeyPress : function(cpfcnpj, e, field, options) {
            const masks = ['000.000.000-000', '00.000.000/0000-00'];
            const mask = (cpfcnpj.length > 14) ? masks[1] : masks[0];
            $('#cliente_cpf_cnpj').mask(mask, options);
        }
    });

    $('#cliente_emailCliente').attr('placeholder','SeuEmail@dominio.com' );

})