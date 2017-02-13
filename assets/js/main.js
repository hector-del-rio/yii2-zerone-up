(function ($) {
    'use strict';

    $.fn.zeroneSelect = function () {
        var container = $(this).closest('.zerone-up-widget-container');
        var imageContainer = container.find('.zerone-image-container');
        var preview = imageContainer.find('.zerone-image-preview');
        var inputRemoved = container.find('.zerone-up-image-removed-input');

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var result = e.target.result;

                preview.css('background-image', 'url(' + result + ')');
                container.removeClass('empty');
                imageContainer.removeClass('empty');

            };

            reader.readAsDataURL(this.files[0]);
            inputRemoved.val('0');

            container.addClass('modified');
        }
    };

    $.fn.zeroneRemove = function () {
        var container = $(this).closest('.zerone-up-widget-container');
        var imageContainer = container.find('.zerone-image-container');
        var preview = imageContainer.find('.zerone-image-preview');
        var inputRemoved = container.find('.zerone-up-image-removed-input');
        var input = container.children('input[type=file]');

        inputRemoved.val('1');
        container.addClass('empty');
        imageContainer.addClass('empty');
        preview.css('background-image', '');
        preview.removeAttr('data-url');

        // clear file input
        input.replaceWith(input.clone());
    };

})(window.jQuery);
