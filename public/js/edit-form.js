let new_form = $('#new-form');
$(document).ready(function () {
    let tom_options = {
        plugins: {
            remove_button: {
                title: 'Remove this item',
            }
        },
        persist: false,
        createOnBlur: true,
        create: true,
        maxOptions: 0,           // hides the dropdown list
        highlight: false,        // optional: disables highlighting
        openOnFocus: false,      // don't open dropdown on focus
        render: {
            no_results: function () {
                return ''; // 👈 No message rendered
            }
        }
    }
    $('.repeater').repeater({
        initEmpty: false,
        defaultValues: {
            'name': ''
        },
        show: function () {
            $(this).slideDown();
            $(this).find('.data').each(function () {
                new TomSelect(this, tom_options);
            });
            // Add validation to the new fields
            $(this).find('select[name$="[field_type]"]').rules("add", {
                required: true,
                messages: {
                    required: "Select field type"
                }
            });
            $(this).find('input[name$="[label]"]').rules("add", {
                required: true,
                messages: {
                    required: "Enter label for the field"
                }
            });
            $(this).find('input[name$="[data]"]').rules("add", {
                required: true,
                messages: {
                    required: "Add select options"
                }
            });
        },
        hide: function (deleteElement) {
            const itemCount = $(this).closest('[data-repeater-list]').find('[data-repeater-item]').length;

            if (itemCount > 1) {
                $(this).slideUp(deleteElement);
            } else {
                alert("At least one field must remain.");
            }
        }
    });
    $('.data').each(function () {
        new TomSelect(this, tom_options);
        let type = $(this).closest('.repeater-item').find(':selected').data('type');
        let selectEl = $(this).closest('.repeater-item').find('.data')[0];
        if (selectEl && selectEl.tomselect) {
            let tom = selectEl.tomselect;
            if (type === 'select') {
                tom.enable();
            } else {
                tom.clear();
                tom.disable();
            }
        }
    });
    $(document).on('change', '.field_type', function () {
        let type = $(this).find(':selected').data('type');
        let selectEl = $(this).closest('.repeater-item').find('.data')[0];
        if (selectEl && selectEl.tomselect) {
            let tom = selectEl.tomselect;
            if (type === 'select') {
                tom.enable();
            } else {
                tom.clear();
                tom.disable();
            }
        }
    });
    new_form_validator = new_form.validate({
        rules: {
            title: { required: true }
        },
        messages: {
            title: { required: "Enter a form title" }
        },
        errorPlacement: function (error, element) {
            if (element.hasClass("tomselected")) {
                $(element).parent().append(error);
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $('button[type="submit"]', form).attr('disabled', true);
            $.ajax({
                url: new_form.attr('action'),
                type: 'PUT',
                data: new_form.serialize(), // Serialize form data
                success: function (response) {
                    alert(response.message);
                    location.reload();
                },
                error: function (xhr) {
                    alert('Submission failed!');
                }
            });
        }
    });
    // Manually apply rules to initial fields
    $('select[name$="[field_type]"]').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Select field type"
            }
        });
    });
    $('input[name$="[label]"]').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Enter label for the field"
            }
        });
    });
    $('input[name$="[data]"]').each(function () {
        $(this).rules("add", {
            required: true,
            messages: {
                required: "Add select options"
            }
        });
    });
});