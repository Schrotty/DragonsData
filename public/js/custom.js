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

$(document).ready(function(){
    $.extend( $.fn.dataTable.defaults, {
        searching: false,
        ordering:  false,
        pageLength: 5,
        dom: 'rt<"bottom"fp><"clear">'
    } );

    oTable=$('table').dataTable( {
        bFilter: false,
        bSearchable:false,
        bInfo:false,
        fnDrawCallback:function(){
            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
            pagination.toggle(this.api().page.info().pages > 1);
        }
    });
});
