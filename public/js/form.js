$(document).ready(function() {


    $('.wysiwyg').summernote({
        height: 200
    });

    $(".markdown").markdown();


    $('.datepicker').datetimepicker({
        format: 'DD/MM/YYYY',
        pickTime: false
    });


    $("#slider").slider({
        range: "min",
        min: 0,
        max: 100,
        value: 30,
        slide: function(event, ui) {
            $(".slider-countbox").val(ui.value);
        }
    });


});
