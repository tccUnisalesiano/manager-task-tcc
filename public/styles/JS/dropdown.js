$(document).ready(function (){
    $(".btnDropDownForm").click(function (){
        $(this).siblings(".dropDownForm").toggle("slow");
    });
});
