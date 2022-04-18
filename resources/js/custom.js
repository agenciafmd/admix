$(function () {
    /* select 2 */
    var select2Selector = $('.js-select2');
    if (select2Selector.length > 0) {
        var select2Element = select2Selector.select2({
            language: 'pt-BR',
            width: '100%',
        });
        select2Element.each(function (index) {
            $(this).data('select2').$container.addClass('custom-select');
        });
    }
    /* fim select 2 */

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

    /* select de estado e cidade */
    if ($(".js-state").length > 0) {
        $.getJSON('/json/estados-cidades.json', function (data) {
            var items = [];
            var state = $(".js-state");
            var options = '<option value="">-</option>';
            $.each(data, function (key, val) {
                var selected = '';
                if (val.nome === state.attr('data-selected')) {
                    selected = "selected"
                }
                options += '<option value="' + val.nome + '" ' + selected + '>' + val.nome + '</option>';
            });
            state.html(options);
            state.change(function () {
                var options_cidades = '<option value="">-</option>';
                var str = "";
                $(".js-state option:selected").each(function () {
                    str += $(this).text();
                });

                var city = $(".js-city");
                $.each(data, function (key, val) {
                    if (val.nome === str) {
                        $.each(val.cidades, function (key_city, val_city) {
                            var selected = '';
                            if (val_city === city.attr('data-selected')) {
                                selected = "selected"
                            }
                            options_cidades += '<option value="' + val_city + '" ' + selected + '>' + val_city + '</option>';
                        });
                    }
                });
                city.html(options_cidades);
            }).change();
        });
    }
    /* fim select de estado e cidade */

    /* autocompletar de cep */
    $('.js-zipcode').on('blur', function () {

        var $this = $(this);
        var cep = $this.val().replace('-', '');

        if (cep.length === 8) {
            $.getJSON('https://api.mixd.com.br/cep/' + cep, {},
                function (result) {

                    if (!result) {

                        console.log(result.message || 'Houve um erro desconhecido');
                        return;
                    }

                    var stateInput = $('.js-state');
                    var cityInput = $('.js-city');

                    $('.js-neighborhood').val(result.bairro);
                    $('.js-address').val(result.logradouro);

                    if (stateInput.is('input')) {
                        stateInput.val(result.uf_nome);
                    }

                    if (cityInput.is('input')) {
                        cityInput.val(result.cidade);
                    }

                    if (stateInput.is('select')) {
                        stateInput.val(result.uf_nome);
                        stateInput.trigger('change');
                        cityInput.val(result.cidade);
                    }
                },
            );
        }
    });
    /* fim autocompletar de cep */

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
        paste: {
            forcePlainText: true,
            cleanPastedHTML: false,

            // forcePlainText: false,
            // cleanPastedHTML: true,
            // cleanReplacements: [
            //     [
            //         new RegExp(/(<table[^\>]*) width="[^\"]*"/gi), '<table width="100%" border="1"'
            //     ]
            // ],
            // cleanTags: [
            //     'meta',
            //     'script',
            //     'style',
            //     'img',
            //     'object',
            //     'iframe',
            // ],
            // cleanAttrs: [
            //     'class',
            //     'style',
            //     'dir',
            //     //'width',
            //     'height',
            //     'cellpadding',
            //     'cellspacing',
            //     'valign'
            // ],
            // unwrapTags: [
            //     'p',
            //     'font',
            //     'label',
            //     'span',
            //     'div',
            //     'dl',
            //     'dd',
            //     'sub',
            //     'sup'
            // ]
        },
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
                // {
                //     name: 'h3',
                //     aria: 'cabeçalho tipo 3',
                // },
                // {
                //     name: 'h4',
                //     aria: 'cabeçalho tipo 4',
                // },
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
        var maxFileSize = 150000; //Set to ~10kb bytes for testing

        for (let index = 0; index < event.dataTransfer.files.length; index++) {
            var file = event.dataTransfer.files[index];

            if (file.size > maxFileSize) {
                // console.log('filesize ' + file.size + ' bytes > ' + maxFileSize + ' bytes ; cancel dropping');

                $.toast({
                    title: 'Atenção',
                    content: 'A imagem deve ter no máximo ' + (maxFileSize / 1000) + 'kb',
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
                if (!result) {
                    $.toast({
                        title: 'Atenção',
                        content: 'Falha no envio da imagem',
                        type: 'danger',
                        delay: 3000,
                        pause_on_hover: true
                    });
                } else {
                    const previewElement = document.createElement('img');
                    previewElement.setAttribute('class', 'medium-editor-image')
                    // previewElement.src = fileReader.result;
                    previewElement.src = result;

                    MediumEditor.util.insertHTMLCommand(document, previewElement.outerHTML);
                }
            });
        };

        fileReader.readAsDataURL(file);
    };

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

    /* ativa backdrop do menu mobile*/
    //menu project and filters
    let toggleBackdrop = $('.js-toggle-backdrop');
    let backdropCollapse = $('.backdrop-collapse');

    //add backdrop when have action collapse show.
    toggleBackdrop.on('click', function (e) {

        e.preventDefault();

        if ($('.navbar.collapse').has('show')) {

            showBackdrop();
        }
    });

    function showBackdrop() {

        backdropCollapse
            .fadeIn({
                    duration: 160,
                    easing: 'linear',
                },
            );
    }

    function hideBackdrop() {

        backdropCollapse
            .fadeOut({
                    duration: 160,
                    easing: 'linear',
                },
            );
    }

    //trigger class to remove collapse
    backdropCollapse.on('click', function (e) {

        $('.navbar.collapse').collapse('hide');
        hideBackdrop();
    });
    /* fim ativa backdrop do menu mobile*/
});

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
                    $(form).find('button.js-loading')
                        .removeClass('btn-loading')
                        .attr('disabled', false);

                    guideUserToTheFirstError();

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

/* mascaras */
(function () {
    function inputHandler(masks, max, event) {
        var c = event.target;
        var v = c.value.replace(/\D/g, '');
        var m = c.value.length > max ? 1 : 0;
        VMasker(c).unMask();
        VMasker(c).maskPattern(masks[m]);
        c.value = VMasker.toPattern(v, masks[m]);
    }

    if (document.querySelectorAll('.mask-phone').length > 0) {
        var telMask = ['(99) 9999-99999', '(99) 99999-9999'];
        var tels = document.querySelectorAll('.mask-phone');
        tels.forEach((tel) => {
            VMasker(tel).maskPattern(telMask[0]);
            tel.addEventListener('input', inputHandler.bind(undefined, telMask, 14), false);
        });
    }

    if (document.querySelectorAll('.mask-cpfcnpj').length > 0) {
        var docMask = ['999.999.999-999', '99.999.999/9999-99'];
        var docs = document.querySelectorAll('.mask-cpfcnpj');
        docs.forEach((doc) => {
            VMasker(doc).maskPattern(docMask[0]);
            doc.addEventListener('input', inputHandler.bind(undefined, docMask, 14), false);
        });
    }

    if (document.querySelectorAll('.mask-date').length > 0) {
        VMasker(document.querySelectorAll('.mask-date')).maskPattern('99/99/9999');
    }
    if (document.querySelectorAll('.mask-zipcode').length > 0) {
        VMasker(document.querySelectorAll('.mask-zipcode')).maskPattern('99999-999');
    }

    if (document.querySelectorAll('.mask-cpf').length > 0) {
        VMasker(document.querySelectorAll('.mask-cpf')).maskPattern('999.999.999-99');
    }

    if (document.querySelectorAll('.mask-cnpj').length > 0) {
        VMasker(document.querySelectorAll('.mask-cnpj')).maskPattern('99.999.999/9999-99');
    }

    if (document.querySelectorAll('.mask-hour').length > 0) {
        VMasker(document.querySelectorAll('.mask-hour')).maskPattern('99:99');
    }

    if (document.querySelectorAll('.mask-money').length > 0) {
        VMasker(document.querySelectorAll('.mask-money')).maskMoney({
            precision: 2,
            separator: ',',
            delimiter: '.',
            unit: 'R$',
        });
    }
})();
/* fim mascaras */

/* select2ajax */

/*
* Caso de uso / brain
* {{ Form::bsSelect('Cliente', 'customer_id', (optional($model)->id) ? [$model->customer->id => "#{$model->customer->id} - {$model->customer->name}"] : ['' => '-'], null, [
        'data-ajax--url' => route('admix.api.customers.index'),
        'class' => 'js-select2-ajax',
        'required'
    ]) }}
* */
function initializeSelect2Ajax() {
    var select2Selector = $('.js-select2-ajax');

    select2Selector.each(function (key, item) {
        if (!$(item).hasClass('select2-hidden-accessible')) {
            let select2Element = $(item).select2({
                language: 'pt-BR',
                width: '100%',
                ajax: {
                    data: function (params) {
                        return {
                            filter: {
                                string: params.term,
                            },
                        };
                    },
                },
            });
            select2Element.each(function (index) {
                $(this).data('select2').$container.addClass('custom-select d-block');
                $(this).trigger('change');
            });
        }
    });
}

/* fim select2ajax */

/* scroll para o erro */
function guideUserToTheFirstError() {

    const currentScrollPosition = $(window)
        .scrollTop();
    const invalidInputsSelectors = [
        '.form-control:invalid',
        '.custom-control-input:invalid',
        '.form-control.is-invalid',
        '.custom-control-input.is-invalid',
    ];
    const $invalidInputs = $(invalidInputsSelectors.join(', '));
    // Selects the parent to get input label
    const $firstInvalidInput = $invalidInputs.first()
        .parent();
    const firstInvalidInputOffsetTop = $firstInvalidInput.offset().top;

    if (currentScrollPosition <= firstInvalidInputOffsetTop) {

        return;
    }

    $('html, body')
        .animate({
            scrollTop: $firstInvalidInput.offset().top - 30,
        }, 1000);
}

/* fim scroll para o erro */
