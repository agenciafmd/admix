/**
 * @author Script47 (https://github.com/Script47/Toast)
 * @description Toast - A Bootstrap 4.2+ jQuery plugin for the toast component
 * @version 0.7.1 - CUSTOM
 **/
(function ($) {
    var TOAST_CONTAINER_HTML = '<div id="toast-container" aria-live="polite" aria-atomic="true"></div>';
    var TOAST_WRAPPER_HTML = '<div id="toast-wrapper"></div>';

    $.toast = function (opts) {
        if (!$('#toast-container').length) {
            $('body').prepend(TOAST_CONTAINER_HTML);
            $('#toast-container').append(TOAST_WRAPPER_HTML);

            $('body').on('hidden.bs.toast', '.toast-alert', function () {
                $(this).remove();
            });
        }

        var id = 'toast-' + ($('.toast').length + 1),
            html = '',
            title = opts.title || 'Notice!',
            content = opts.content || '',
            type = opts.type || 'info',
            delay = opts.delay || -1,
            pause_on_hover = opts.pause_on_hover || false,
            pause = false,
            delay_or_autohide = '';

        if (pause_on_hover !== false) {
            var hide_timestamp = Math.floor(Date.now() / 1000) + (delay / 1000);

            delay_or_autohide = 'data-autohide="false"';
            pause_on_hover = 'data-hide-timestamp="' + hide_timestamp + '"';
        } else {
            if (delay === -1) {
                delay_or_autohide = 'data-autohide="false"';
            } else {
                delay_or_autohide = 'data-delay="' + delay + '"';
            }
        }

        html = '<div id="' + id + '" class="alert alert-' + type + ' alert-dismissible toast-alert" role="alert" aria-live="assertive" aria-atomic="true" ' + delay_or_autohide + ' ' + pause_on_hover + '>';
        html += '<h4>';

        html += '<strong class="mr-auto">' + title + '</strong>';
        html += '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';
        html += '<span aria-hidden="true">×</span>';
        html += '</button>';
        html += '</h4>';

        if (content !== '') {
            html += content
        }

        html += '</div>';

        $('#toast-wrapper').append(html);
        $('#toast-wrapper .toast-alert:last').toast('show');

        if (pause_on_hover !== false) {
            setTimeout(function () {
                if (!pause) {
                    $('#' + id).toast('hide');
                }
            }, delay);

            $(document).on('mouseover', '#' + id, function () {
                pause = true;
            });

            $(document).on('mouseleave', '#' + id, function () {
                var current = Math.floor(Date.now() / 1000),
                    future = parseInt($(this).data('hide-timestamp'));

                pause = false;

                if (current >= future) {
                    $(this).toast('hide');
                }
            });
        }
    }
}(jQuery));