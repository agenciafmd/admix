/*!
 * bootstrap-fileinput v5.0.2
 * http://plugins.krajee.com/file-input
 *
 * Font Awesome icon theme configuration for bootstrap-fileinput. Requires font awesome assets to be loaded.
 *
 * Author: Kartik Visweswaran
 * Copyright: 2014 - 2019, Kartik Visweswaran, Krajee.com
 *
 * Licensed under the BSD-3-Clause
 * https://github.com/kartik-v/bootstrap-fileinput/blob/master/LICENSE.md
 */
(function ($) {
    "use strict";

    $.fn.fileinputThemes.fe = {
        fileActionSettings: {
            removeIcon: '<i class="fe fe-trash"></i>',
            uploadIcon: '<i class="fe fe-upload"></i>',
            uploadRetryIcon: '<i class="fe fe-repeat"></i>',
            downloadIcon: '<i class="fe fe-download"></i>',
            zoomIcon: '<i class="fe fe-zoom-in"></i>',
            dragIcon: '<i class="fe fe-arrows"></i>',
            indicatorNew: '<i class="fe fe-plus-circle text-warning"></i>',
            indicatorSuccess: '<i class="fe fe-check-circle text-success"></i>',
            indicatorError: '<i class="fe fe-exclamation-circle text-danger"></i>',
            indicatorLoading: '<i class="fe fe-hourglass text-muted"></i>'
        },
        layoutTemplates: {
            fileIcon: '<i class="fe fe-file kv-caption-icon"></i> '
        },
        previewZoomButtonIcons: {
            prev: '<i class="fe fe-caret-left fe-lg"></i>',
            next: '<i class="fe fe-caret-right fe-lg"></i>',
            toggleheader: '<i class="fe fe-fw fe-minimize-2"></i>',
            fullscreen: '<i class="fe fe-fw fe-maximize-2"></i>',
            borderless: '<i class="fe fe-fw fe-external-link"></i>',
            close: '<i class="fe fe-fw fe-x"></i>'
        },
        previewFileIcon: '<i class="fe fe-file"></i>',
        browseIcon: '<i class="fe fe-folder-open"></i>',
        removeIcon: '<i class="fe fe-trash"></i>',
        cancelIcon: '<i class="fe fe-ban"></i>',
        pauseIcon: '<i class="fe fe-pause"></i>',
        uploadIcon: '<i class="fe fe-upload"></i>',
        msgValidationErrorIcon: '<i class="fe fe-exclamation-circle"></i> '
    };
})(window.jQuery);
