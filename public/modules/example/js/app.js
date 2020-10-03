$(document).ready(function () {
    $('.save').on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('id');
        $.post($(this).attr('href'), {
            id: $('#id_' + id).text(),
            image: $('#image_' + id).attr('src'),
            name: $('#product_name_' + id).text(),
            categories: $('#categories_' + id).text(),
        });
    });
});
