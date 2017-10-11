$('.selectpicker').selectpicker({
    iconBase: 'oi',
    tickIcon: 'oi-check'
});

$( document ).ready(function() {
    $(".card-clickable").click(function () {
        window.location.href = this.id;
    });

    $('#search').click(function() {
        query = $('#search-query').val();

        $.ajax({
            url: '/search',
            data: {
                q: query
            },
            success: function(response) {
                console.log(response)
            }
        });
    });

    $('#delete-item-modal').on('show.bs.modal', function (e) {
        $('#delete-item').attr('action', '/item/' + e.relatedTarget.id);
    });

    $('#delete-entry-modal').on('show.bs.modal', function (e) {
        $('#delete-entry').attr('action', '/entry/' + e.relatedTarget.id);
    });

    /* LIVE MARKDOWN */
    /*$('#mce').change(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: '/lmark',
            data: '# Ich bin Herman',
            success: function(data) {
                $('#mce').val(data);
            }
        });
    })*/
});