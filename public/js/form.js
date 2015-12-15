$(document).ready(function() {

    $('.wysiwyg').summernote({
        height: 200
    });

    $(".markdown").markdown();

    $(".select2").select2();


    $('.datepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        pickTime: false
    });


    $("#slider").slider({
        range: "min",
        min: 30,
        max: 420,
        slide: function(event, ui) {
            $(".slider-countbox").val(ui.value);
        }
    });


});
