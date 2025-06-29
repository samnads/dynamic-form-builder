let public_form = $('#public-form');
$(document).ready(function () {
    public_form_validator = public_form.validate({
        rules: {
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('button[type="submit"]', form).attr('disabled', true);
            $.ajax({
                url: public_form.attr('action'),
                type: 'POST',
                data: public_form.serialize(), // Serialize form data
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