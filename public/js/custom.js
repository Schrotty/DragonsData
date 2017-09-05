$('.selectpicker').selectpicker({
    iconBase: 'glyphicon',
    tickIcon: 'oi-check'
});

$(document).ready(
    tinymce.init({
        selector: 'textarea#mce',
        themes: "modern",
        height:"500px",
        plugins: [
            'link',
            'anchor',
            'autosave',
            'contextmenu',
            'paste',
            'preview'
        ],
        contextmenu: "link image inserttable"
    })
);

$(function() {
    $('.notification').css('color', 'red');
});
