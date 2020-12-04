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
            prev: '<i class="icon fa-chevron-left fe-lg"></i>',
            next: '<i class="icon fe-chevron-right fe-lg"></i>',
            toggleheader: '<i class="icon fe-fw fe-minimize-2"></i>',
            fullscreen: '<i class="icon fe-fw fe-maximize-2"></i>',
            borderless: '<i class="icon fe-fw fe-external-link"></i>',
            close: '<i class="icon fe-fw fe-x"></i>'
        },
        browseIcon: '<i class="icon fe-folder-open"></i>',
        removeIcon: '<i class="icon fe-trash"></i>',
        cancelIcon: '<i class="icon fe-ban"></i>',
        pauseIcon: '<i class="icon fe-pause"></i>',
        uploadIcon: '<i class="icon fe-upload"></i>',
        msgValidationErrorIcon: '<i class="icon fe-exclamation-circle"></i> ',
        preferIconicPreview: false,
        previewFileIcon: '<i class="icon fe-file"></i>',
        // previewFileIconSettings: {
        //     'doc': '<i class="fa fa-file-word-o"></i>',
        //     'xls': '<i class="fa fa-file-excel-o"></i>',
        //     'ppt': '<i class="fa fa-file-powerpoint-o"></i>',
        //     'pdf': '<i class="fa fa-file-pdf-o"></i>',
        //     'zip': '<i class="fa fa-file-archive-o"></i>',
        //     'htm': '<i class="fa fa-file-code-o"></i>',
        //     'txt': '<i class="fa fa-file-text-o"></i>',
        //     'mov': '<i class="fa fa-file-movie-o"></i>',
        //     'mp3': '<i class="fa fa-file-audio-o"></i>',
        //     'jpg': '<i class="fa fa-file-photo-o"></i>',
        //     'gif': '<i class="fa fa-file-photo-o"></i>',
        //     'png': '<i class="fa fa-file-photo-o"></i>'
        // },
        previewFileExtSettings: {
            'doc': function (ext) {
                return ext.match(/(doc|docx)$/i);
            },
            'xls': function (ext) {
                return ext.match(/(xls|xlsx)$/i);
            },
            'ppt': function (ext) {
                return ext.match(/(ppt|pptx)$/i);
            },
            'zip': function (ext) {
                return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
            },
            'htm': function (ext) {
                return ext.match(/(htm|html)$/i);
            },
            'txt': function (ext) {
                return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
            },
            'mov': function (ext) {
                return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
            },
            'mp3': function (ext) {
                return ext.match(/(mp3|wav)$/i);
            },
            'jpg': function (ext) {
                return ext.match(/(jpg|jpeg)$/i);
            }
        }
    };
})(window.jQuery);
