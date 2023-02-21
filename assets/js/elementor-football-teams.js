jQuery(document).ready(function($) {

    /**
     * Click event for button `Add Logo` on taxonomy `Leagues` page
     * 
     * The click event allows selecting image from WP Media Gallery 
     **/
    $('#league-logo-upload-button').click(function(e) {
        e.preventDefault();

        var image = wp.media({ title: 'Choose Image', multiple: false }).open().on('select', function(e) {
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;
            $('#league-logo').val(image_url);
            $('#img-league-logo').attr("src", image_url);
        });
    });


    /**
     * Click event for button `Remove Logo` and `Add New League` on taxonomy `Leagues` page
     **/
    $('#league-logo-remove-button, input[type="submit"]#submit').click(function(e) {
        e.preventDefault();

        $('#league-logo').val('');
        $('#img-league-logo').attr("src", '');
    });

    /**
     * Click event for button `Add Logo` on post type `Football Teams` page
     * 
     * The click event allows selecting image from WP Media Gallery 
     **/
    $('#logo-upload-button').click(function(e) {
        e.preventDefault();
        var image = wp.media({ title: 'Choose Image', multiple: false }).open().on('select', function(e) {
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;
            $('#logo').val(image_url);
            $('#img-logo').attr("src", image_url);
        });
    });


    /**
     * Click event for button `Remove Logo` on post type `Football Teams` page
     **/
    $('#logo-remove-button').click(function(e) {
        e.preventDefault();
        $('#logo').val('');
        $('#img-logo').attr("src", '');
    });
});