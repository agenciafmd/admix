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
        overwriteInitial: true,
        showClose: false,
        showUpload: false,
        showCancel: false,
        showBrowse: false,
        uploadAsync: false,
        browseOnZoneClick: true,
        allowedFileExtensions: ["jpg", "jpeg", "png"],
        resizeImage: true,
        resizePreference: 'height',
        uploadUrl: $('meta[name="upload"]').attr('content'),
        deleteUrl: $('meta[name="upload-destroy"]').attr('content'),
        deleteExtraData: function () {
            return {
                _token: $('meta[name="csrf-token"]').attr('content')
            };
        },
        layoutTemplates: {
            fileIcon: '<i class="icon fe-file kv-caption-icon"></i> ',
            main1: "{preview}\n" +
                "<div class='input-group {class}'>\n" +
                "   <div class='input-group-btn input-group-prepend'>\n" +
                "       {browse}\n" +
                "       {upload}\n" +
                "   </div>\n" +
                "   {caption}\n" +
                "</div>",
            actions: '<div class="file-actions">\n' +
                '    <div class="file-footer-buttons">\n' +
                '       {download} ' +
                '       {upload} ' +
                '       {delete} ' +
                '       {zoom} ' +
                '       {other} ' +
                '       <button type="button" class="btn btn-sm btn-kv btn-outline-secondary kv-file-tags" title="Alterar descrição"><i class="icon fe-tag"></i></button>' +
                '    </div>\n' +
                '</div>\n' +
                '{drag}\n' +
                '<div class="clearfix"></div>',
            size: '<span>{sizeText}</span>',

        },
        fileActionSettings: {
            showUpload: false,
            showDrag: false,
            removeIcon: '<i class="icon fe-trash"></i>',
            uploadIcon: '<i class="icon fe-upload"></i>',
            uploadRetryIcon: '<i class="icon fe-repeat"></i>',
            downloadIcon: '<i class="icon fe-download"></i>',
            zoomIcon: '<i class="icon fe-zoom-in"></i>',
            dragIcon: '<span class="btn btn-sm btn-kv btn-outline-secondary"><i class="icon fe-move"></i></span>',
            indicatorNew: '<span class="btn btn-sm btn-kv btn-outline-warning"><i class="icon fe-star"></i></span>',
            indicatorSuccess: '<span class="btn btn-sm btn-kv btn-outline-success"><i class="icon fe-check"></i></span>',
            indicatorError: '<span class="btn btn-sm btn-kv btn-outline-danger"><i class="icon fe-alert-triangle"></i></span>',
            indicatorLoading: '<span class="btn btn-sm btn-kv btn-outline-secondary"><i class="icon fe-spinner fe-loader"></i></span>',
            indicatorPaused: '<i class="icon fe-pause text-info"></i>'
        },
        previewZoomButtonIcons: {
            prev: '<i class="icon fe-caret-left fe-lg"></i>',
            next: '<i class="icon fe-caret-right fe-lg"></i>',
            toggleheader: '<i class="icon fe-fw fe-minimize-2"></i>',
            fullscreen: '<i class="icon fe-fw fe-maximize-2"></i>',
            borderless: '<i class="icon fe-fw fe-external-link"></i>',
            close: '<i class="icon fe-fw fe-x"></i>'
        },
        previewFileIcon: '<i class="icon fe-file"></i>',
        browseIcon: '<i class="icon fe-folder-open"></i>',
        removeIcon: '<i class="icon fe-trash"></i>',
        cancelIcon: '<i class="icon fe-ban"></i>',
        pauseIcon: '<i class="icon fe-pause"></i>',
        uploadIcon: '<i class="icon fe-upload"></i>',
        msgValidationErrorIcon: '<i class="icon fe-exclamation-circle"></i> '
    };
})(window.jQuery);
