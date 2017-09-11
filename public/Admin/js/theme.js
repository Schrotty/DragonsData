$('.selectpicker').selectpicker({
    iconBase: 'oi',
    tickIcon: 'oi-check'
});

$( document ).ready(function() {
    $(".card-clickabe").click(function () {
        window.location.href = "/item/" + this.id;
    });
});