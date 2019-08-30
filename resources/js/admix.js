$(function () {
    /* confirmação dos botões de remover */
    $('.js-delete').on('click', function (event) {
        event.preventDefault();
        $("#deleteModal").modal('show');
        $('#deleteModal .btn-primary').attr('data-target-form', $(this).parent('form').attr('id'));
    });

    $('#deleteModal .btn-primary').on('click', function () {
        $('#' + $(this).attr('data-target-form')).submit();
    });
    /* fim confirmação dos botões de remover */

    /* fake submit baseado em link */
    $('.js-submit').on('click', function (event) {
        event.preventDefault();
        $(this).parent('form').submit();
    });
    /* fim fake submit baseado em link */

    /* adiciona o loading no botão e submete o formulário */
    $('button.js-loading').parents('form').on('submit', function () {
        $('button.js-loading').addClass('btn-loading').attr("disabled", true);
    });
    /* fim adiciona o loading no botão e submete o formulário */

    /* adiciona o loading no botão (a) */
    $('a.js-loading').on('click', function () {
        $(this).addClass('btn-loading').attr("disabled", true);
    });
    /* fim adiciona o loading no botão (a) */

    /* trabalha os checkboxes para ações multiplas */
    $('.js-check-all').on('click', function () {
        $('.js-check').prop('checked', $(this).prop('checked'));
        $.checkDestroy();
    });

    $('.js-check').on('click', function () {
        $.checkDestroy();
    });

    $.checkDestroy = function () {
        if ($('.js-check:checked').length > 0) {
            $('.js-batch').addClass('d-md-block');
        } else {
            $('.js-batch').removeClass('d-md-block');
        }
    };

    $('.js-batch-select').on('change', function () {
        $('.dimmer').addClass('active');
        $('.js-batch-form input[name="id[]"]').remove();
        $('.js-check:checked').each(function (index) {
            $('.js-batch-form').append('<input type="hidden" name="id[]" value="' + $(this).val() + '" />');
        });
        $('.js-batch-form').attr('action', $(this).val()).submit();
    });
    /* fim trabalha os checkboxes para ações multiplas */

    /* trigga o loading na tabela da listagem dos itens */
    $('.js-dimmer').on('click', function () {
        $('.dimmer').addClass('active');
    });
    /* fim trigga o loading na tabela da listagem dos itens */

    /* botão de descrição do upload */
    $(document).on('click', '.kv-file-tags', function () {
        var uuid = $(this).parents('.file-footer-buttons').find('.kv-file-remove').attr('data-key');
        var modal = $("#modalMediaMetaPost");

        $.get($('meta[name="upload-meta"]').attr('content') + "/" + uuid, function (data) {
            modal.find('.modal-body').html(data);
            modal.modal('show');
        });

        modal.find('.btn-primary').off('click').on('click', function () {
            var form = $("#formUploadMetaPost");
            $.post(form.attr('action'), form.serialize()).done(function () {
                modal.modal('hide');

                $.toast({
                    title: 'Atenção',
                    content: 'Item atualizado com sucesso',
                    type: 'success',
                    delay: 3000,
                    pause_on_hover: true
                });
            });
        });

    });
    /* fim botão de descrição do upload */

    /* editor wysiwyg */
    var editor = new MediumEditor('.js-wysiwyg', {
        placeholder: false,
        imageDragging: false,
        // paste: {
        //     forcePlainText: true,
        //     cleanPastedHTML: false,
        //     cleanReplacements: [
        //         [
        //             '/<[^>]*>/ig', ''
        //         ]
        //     ],
        //     cleanTags: [
        //         'meta',
        //         'script',
        //         'style',
        //         'img',
        //         'object',
        //         'iframe',
        //         'p'
        //     ]
        // },
        anchor: {
            placeholderText: 'ex. https://fmd.ag',
            targetCheckbox: true,
            targetCheckboxText: 'abrir em uma nova janela'
        },
        extensions: {
            table: new MediumEditorTable({
                aria: 'tabela',
                contentDefault: '<i class="icon fe-grid"></i>',
            })
        },
        toolbar: {
            // static: false, // deixa a toolbar fixa no topo
            // sticky: false, //
            // updateOnEmptySelection: false, // a toolbar aparece mesmo quando não temos o texto selecionado
            buttons: [
                {
                    name: 'bold',
                    aria: 'negrito',
                },
                {
                    name: 'italic',
                    aria: 'itálico',
                },
                {
                    name: 'underline',
                    aria: 'sublinhado',
                },
                {
                    name: 'strikethrough',
                    aria: 'tachado',
                },
                {
                    name: 'anchor',
                    aria: 'link',
                },
                {
                    name: 'h3',
                    aria: 'cabeçalho tipo 3',
                },
                {
                    name: 'h4',
                    aria: 'cabeçalho tipo 4',
                },
                {
                    name: 'quote',
                    aria: 'citação',
                },
                {
                    name: 'unorderedlist',
                    aria: 'lista',
                    contentDefault: '<i class="icon fe-list"></i>',
                },
                {
                    name: 'orderedlist',
                    aria: 'lista ordenada'
                },
                {
                    name: 'justifyLeft',
                    aria: 'alinhar a esquerda',
                    contentDefault: '<i class="icon fe-align-left"></i>',
                },
                {
                    name: 'justifyCenter',
                    aria: 'centralizar',
                    contentDefault: '<i class="icon fe-align-center"></i>',
                },
                {
                    name: 'justifyRight',
                    aria: 'alinhar a direita',
                    contentDefault: '<i class="icon fe-align-right"></i>',
                },
                {
                    name: 'justifyFull',
                    aria: 'justificar',
                    contentDefault: '<i class="icon fe-align-justify"></i>',
                },
                {
                    name: 'removeFormat',
                    aria: 'remover formatação',
                    contentDefault: '<i class="icon fe-x"></i>',
                },
                'table'
            ]
        }
    });

    editor.subscribe('editableDrop', function (event) {
        var maxFileSize = 50000; //Set to ~10kb bytes for testing

        for (let index = 0; index < event.dataTransfer.files.length; index++) {
            var file = event.dataTransfer.files[index];

            if (file.size > maxFileSize) {
                // console.log('filesize ' + file.size + ' bytes > ' + maxFileSize + ' bytes ; cancel dropping');

                $.toast({
                    title: 'Atenção',
                    content: 'A imagem deve ter no máximo ' + (maxFileSize/1000) + 'kb',
                    type: 'danger',
                    delay: 3000,
                    pause_on_hover: true
                });

                continue;
            }

            // console.log('filesize ' + file.size + ' bytes is < ' + maxFileSize + ' bytes ; continue dropping');

            insertFileAsHtml(file);
        }
    });

    var insertFileAsHtml = function (file) {
        const fileReader = new FileReader();
        fileReader.onload = () => {
            $.post("/admix/medium", {
                _token: $('meta[name="csrf-token"]').attr('content'),
                file: fileReader.result
            }, function (result) {
                if(!result) {
                    $.toast({
                        title: 'Atenção',
                        content: 'Falha no envio da imagem',
                        type: 'danger',
                        delay: 3000,
                        pause_on_hover: true
                    });
                }
                else {
                    const previewElement = document.createElement('img');
                    previewElement.setAttribute('class', 'medium-editor-image')
                    // previewElement.src = fileReader.result;
                    previewElement.src = result;

                    MediumEditor.util.insertHTMLCommand(document, previewElement.outerHTML);
                }
            });
        };

        fileReader.readAsDataURL(file);
    }

    var mediumEditorTableBuilderToolbar = $('.medium-editor-table-builder-toolbar');
    if (mediumEditorTableBuilderToolbar.length > 0) {
        mediumEditorTableBuilderToolbar.find('span')[0].innerHTML = 'Linha';
        $(mediumEditorTableBuilderToolbar.find('button')[0]).attr('title', 'Adicionar uma linha antes');
        $(mediumEditorTableBuilderToolbar.find('button')[0]).find('i').removeClass().addClass('icon fe-arrow-up');
        $(mediumEditorTableBuilderToolbar.find('button')[1]).attr('title', 'Adicionar uma linha depois');
        $(mediumEditorTableBuilderToolbar.find('button')[1]).find('i').removeClass().addClass('icon fe-arrow-down');
        $(mediumEditorTableBuilderToolbar.find('button')[2]).attr('title', 'Remover linha');
        $(mediumEditorTableBuilderToolbar.find('button')[2]).find('i').removeClass().addClass('icon fe-x');

        mediumEditorTableBuilderToolbar.find('span')[1].innerHTML = 'Coluna';
        $(mediumEditorTableBuilderToolbar.find('button')[3]).attr('title', 'Adicionar uma coluna antes');
        $(mediumEditorTableBuilderToolbar.find('button')[3]).find('i').removeClass().addClass('icon fe-arrow-left');
        $(mediumEditorTableBuilderToolbar.find('button')[4]).attr('title', 'Adicionar uma coluna depois');
        $(mediumEditorTableBuilderToolbar.find('button')[4]).find('i').removeClass().addClass('icon fe-arrow-right');
        $(mediumEditorTableBuilderToolbar.find('button')[5]).attr('title', 'Remover coluna');
        $(mediumEditorTableBuilderToolbar.find('button')[5]).find('i').removeClass().addClass('icon fe-x');
        $(mediumEditorTableBuilderToolbar.find('button')[6]).attr('title', 'Remover tabela');
        $(mediumEditorTableBuilderToolbar.find('button')[6]).find('i').removeClass().addClass('icon fe-trash');
    }
    /* fim editor wysiwyg */
});

// window.onload = function(){
//     var editor = new MediumEditor('.js-wysiwyg', {
//         placeholder: false,
//     });
// }

/* validação dos formulários */
(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    $(form).find('button.js-loading').removeClass('btn-loading').attr('disabled', false);
                }
                form.classList.add('was-validated');
            }, false);
        });

        $('.is-invalid').each(function () {
            $(this)[0].setCustomValidity('needs validate');
        })
            .on('focusout', function () {
                $(this).removeClass('is-invalid');
                $(this)[0].setCustomValidity('');
            });
    }, false);
})();
/* fim validação dos formulários */

