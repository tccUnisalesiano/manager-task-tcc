$(function() {
    $( ".calendario" ).datepicker({
        dateFormat: 'dd-mm-yy'
    });
});

$(document).ready(() =>{
    document.getElementsByClassName('calendario').value = new Date().format('dd-mm-yy');
});