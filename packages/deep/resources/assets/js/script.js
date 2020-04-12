$(function () {
    // @see https://codepen.io/desandro/pen/eRRQVo
    var $grid = $('.grid').masonry({
        itemSelector: 'none',
        columnWidth: '.grid-sizer',
        gutter: '.gutter-sizer',
        percentPosition: true,
        stagger: 30,
        visibleStyle: {transform: 'translateY(0)', opacity: 1},
        hiddenStyle: {transform: 'translateY(100px)', opacity: 0},
    });

    $grid.imagesLoaded( function() {
        $grid.removeClass('unloaded');
        $grid.masonry( 'option', { itemSelector: '.grid-item' });
        var $items = $grid.find('.grid-item');
        $grid.masonry( 'appended', $items );
    });

    var msnry = $grid.data('masonry');

    $grid.infiniteScroll({
        path: '.pagination li.active + li a',
        append: '.grid-item',
        outlayer: msnry,
        history: false,
        status: '.page-load-status',
    });

    // Show modal
    $('#btn-new-post').click(function (event) {
        $('#new-post').modal({
            fadeDuration: 250,
            fadeDelay: 0.80
        });
        return false;
    });

    // Add new post
    $('#new-post').submit(function (e) {
        $(this).children('button[type=submit]').attr('disabled', true);
        e.preventDefault();
        let form = $(this);
        let url = form.attr('action');
        $.ajax({
            type: 'POST',
            url: url,
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                toastr.success('Successfully posted!');
                setTimeout(() => { location.reload()}, 2000);
            },
            error: function (data, errorThrown) {
                let errors = data.responseJSON.errors;
                let errorsHtml = '';
                $.each(errors, function (key, value) {
                    errorsHtml += '<li>' + value[0] + '</li>';
                });
                toastr.error(errorsHtml, 'Error ' + data.status + ': ' + errorThrown);
            }
        }).done(() => {
            $(this).children('button[type=submit]').attr('disabled', false);
        });
    });

    // Trigger changing select box 'type'
    $('select[name=type]').on('change', function (e) {
        $('.media-input').css('display', 'none');
        $('.media-' + this.value).css('display', 'block');
    });

    // Get latest post from Tumblr
    $('#latest').on('click', function (e) {
        $(this).attr('disabled', true);
        $('.loader').css('display', 'inline-block');
        e.preventDefault();
        $.ajax({
            type: 'GET',
            url: '/latest',
            success: function (data) {
                toastr.success(data.message);
            },
        }).done(() => {
            $(this).attr('disabled', false);
            $('.loader').css('display', 'none');
        });
    });
});
