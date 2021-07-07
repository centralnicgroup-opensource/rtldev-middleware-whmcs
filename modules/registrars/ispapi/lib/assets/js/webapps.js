$('#waform').off().submit(function (e) {
    const $form = $(this);
    const data = $form.serializeArray().filter((row) => {
        if (!/^((sub)?action|id|modop|a|webapp)$/.test(row.name)) {
            const $el = $form.find('[name="' + row.name + '"]').closest('div.row');
            $el.removeClass('has-error');
            if (row.value !== '') {
                $el.addClass('has-success');
                return true;
            }
            $el.addClass('has-error');
        }
        return false;
    })

    if (!data.length) {
        e.preventDefault();
    }
});