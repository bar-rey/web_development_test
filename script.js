$(function () {
    $("#depoDate").datepicker();
});

$(function () {
    $(".slider").slider({
        min: 10000,
        max: 3000000,
        step: 1000,
        range: "min",
        animate: "fast",
        stop: function (event, ui) {
            $("#depoSum").val($("#depoSumSlider").slider("value"));
            $("#depoAdditionSum").val($("#depoAdditionSumSlider").slider("value"));
        }
    });
});

function depoChanged() {
    $("#depoSumSlider").slider("value", $("#depoSum").val());
    $("#depoAdditionSumSlider").slider("value", $("#depoAdditionSum").val());
}