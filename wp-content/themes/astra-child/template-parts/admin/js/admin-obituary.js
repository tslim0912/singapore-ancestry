$(document).ready(function() {
    console.log('View Obituary');
    $(document).on('change', '#private-gallery', function() {
        var $this = $(this),
            $parent = $this.parent();
        if ($(this).is(':checked')) {
            $('<div id="password-field"><input type="text" name="gallery_password" class="input-control gallery-password" id="gallery-password"><button type="submit" class="btn btn-theme-yellow" id="submit-private-gallery"><span>Save</span></button></div>').insertAfter('.gallery-display');
        }
        else {
            $('#password-field').remove();
        }
    });
});