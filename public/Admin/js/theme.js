$('.selectpicker').selectpicker({
    iconBase: 'glyphicon',
    tickIcon: 'oi-check'
});

$( document ).ready(function() {
    $(".card-clickabe").click(function () {
        window.location.href = "/item/" + this.id;
    });
});