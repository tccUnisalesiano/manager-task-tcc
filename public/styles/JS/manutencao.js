// mostrar ou não conteúdos
$(document).ready(function (){
    $(".btnDropDownForm").click(function (){
        $(this).siblings(".dropDownForm").toggle("slow");
    });
});


//modal pag Manutenção
/*
var modal = document.getElementById("boxModal");
var btn = document.getElementById("modalBtn");
var span = document.getElementsByClassName("closeModal")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}*/