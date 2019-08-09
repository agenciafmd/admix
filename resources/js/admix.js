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
    $(document).on('click', '.kv-file-tags', function() {
        var uuid = $(this).parents('.file-footer-buttons').find('.kv-file-remove').attr('data-key');
        var modal = $("#modalMediaMetaPost");

        $.get($('meta[name="upload-meta"]').attr('content') + "/" + uuid, function(data) {
            modal.find('.modal-body').html(data);
            modal.modal('show');
        });

        modal.find('.btn-primary').off('click').on('click', function () {
            var form = $("#formUploadMetaPost");
            $.post(form.attr('action'), form.serialize()).done(function() {
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
    });
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

