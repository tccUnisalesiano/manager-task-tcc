$(document).ready(function (){
    $(".btnDropDownForm").click(function (){
        if($(".dropDownForm").is(":visible")){
            $(this).siblings(".dropDownForm").hide("slow");
        } if($(".dropDownForm").is(":hidden")){
            $(this).siblings(".dropDownForm").show("slow");
        }
    });
});