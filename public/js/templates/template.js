$(document).ready(function () {
    //show section conjoint
    $(".template-variable").on('click', function () {
        var parametre = $(this).attr("data-variable");

        var caretPos =document.getElementById("template").selectionStart;
        var caretEnd = document.getElementById("template").selectionEnd;

        var textAreaTxt = $("#template").val();

        var txtToAdd = ' __'+parametre+'__ ';
        $("#template").val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring( caretEnd ) );

        $('#template').focus();
        document.getElementById('template').selectionStart = caretPos + txtToAdd.length;
        document.getElementById('template').selectionEnd = caretPos + txtToAdd.length;
    });


});