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
            'preview',
            'advlist'
        ],
        contextmenu: "link image inserttable numlist bullist"
    })
);

$(document).ready(function(){
    $.extend( $.fn.dataTable.defaults, {
        ordering:  false,
        pageLength: 5,
        lengthMenu: [ [5, 10, 25, -1], [5, 10, 25, "All"] ]
        //dom: 'rt<"bottom"fp><"clear">'
    } );

    oTable=$('table').dataTable( {
        bFilter: true,
        bSearchable:false,
        bInfo:false,
        fnDrawCallback:function(){
            var pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_paginate');
            pagination.toggle(this.api().page.info().pages > 1);

            pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_length');
            pagination.toggle(this.api().page.info().pages > 1);

            pagination = $(this).closest('.dataTables_wrapper').find('.dataTables_filter');
            pagination.toggle(this.api().page.info().pages > 1);
        }
    });
});
