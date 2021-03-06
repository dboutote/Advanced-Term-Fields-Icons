( function ($) {
    'use strict';

	// Quick Edit form
    $('#the-list').on('click', '.editinline', function () {
        var tr_id = $(this).parents('tr').attr('id');
        var meta_value = $('td.' + l10n_ATF_Icons.custom_column_name + ' i', '#' + tr_id).attr('data-' + l10n_ATF_Icons.data_type);

        $(':input[name="' + l10n_ATF_Icons.meta_key + '"]', '.inline-edit-row').val(meta_value);
    });

	// Edit Tag page
    $('.icon-utils #term-icon').on('change', function () {
        var dashicon_chosen = $(this).val();
        $('#atf-icon-meta-wrap i.term-icon').removeClass(function (index, css) {
            return (css.match(/\bdashicons-\S+/g) || []).join(' ');
        }).attr('data-icon', dashicon_chosen).addClass(dashicon_chosen);
    });

})(jQuery);