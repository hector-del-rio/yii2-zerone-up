(function ($) {
    'use strict';

    $.fn.zeroneSelect = function () {
        var container = $(this).closest('.zerone-widget-container');
        var preview = container.find('.image-preview');
        var inputRemoved = container.find('.image-removed-input');

        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var result = e.target.result;

                preview.css('background-image', 'url(' + result + ')');
                container.removeClass('empty');

            };

            reader.readAsDataURL(this.files[0]);
            inputRemoved.val('0');
        }
    };

    $.fn.zeroneRemove = function () {
        var container = $(this).closest('.zerone-widget-container');
        var input = container.children('input[type=file]');
        var preview = container.find('.image-preview');
        var inputRemoved = container.find('.image-removed-input');

        inputRemoved.val('1');
        container.addClass('empty');
        preview.css('background-image', '');
        preview.removeAttr('data-url');

        // clear file input
        input.replaceWith(input.clone());
    };

})(window.jQuery);
