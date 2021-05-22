require('./bootstrap');

$(document).ready(function () {
    const form = $('form');
    form.trigger("reset");

    const file = $('input#csv');

    let custom_fields = {};
    let headers = [];

    file.change(function (e) {
        $('.attributes').html('');
        const csv = e.target.files[0];

        if (!csv) return notifyAboutError('File not found!');

        const reader = new FileReader();
        reader.readAsText(csv, "UTF-8");
        reader.onload = function (evt) {
            const result = Papa.parse(evt.target.result);
            if (result.errors.length > 0) {
                form.trigger("reset");
                return notifyAboutError(`Error while reading file: ${result.errors[0].message}`);
            }
            if (result.data.length > 1 && result.data[0]) {
                headers = result.data[0];
                showMapFields(result.data[0]);
            }
            else
                return notifyAboutError('No headers found');
        }
        reader.onerror = function (evt) {
            form.trigger("reset");
            custom_fields = {};
            $('.hidden-fields').hide();
            return notifyAboutError('Error while reading file');
        }
    });

    $('.add-custom-field').click(function (e) {
       e.preventDefault();
       addCustomField();
    });

    $('.hidden-fields').on('click', '.rm-custom-field', function (e) {
        e.preventDefault();
        removeCustomField($(this).attr('block'));
    });

    function showMapFields(headers) {
        $('.hidden-fields').show();
        $('select').html(drawSelectOptions(headers));
    }

    function notifyAboutError(error = false) {
        $('.err-notification').css({opacity: 1});
        $('.err-msg').html(error);
        const tmoutId = setTimeout(() => {
            $('.err-notification').css({
                opacity: 0,
                transition: 'opacity 1s linear'
            });
            clearTimeout(tmoutId);
        }, 4000);
    }

    function drawSelectOptions(headers) {
        let html = `<option selected value="">Choose option</option>`;

        for (const item of headers) {
            html += `<option value="${item}">${item}</option>`;
        }

        return html;
    }

    function addCustomField() {
        const custom_fields_number = Object.keys(custom_fields).length;
        const default_fields_number = $('.default-fields').length;

        if (headers.length <= (custom_fields_number + default_fields_number))
            return notifyAboutError(`You have only ${headers.length} fields in your file!`);

        const now = Date.now();
        const new_selector = `custom-${now}`
        const html = `
            <div class="row ${new_selector}">
                <div class="col-6 col-sm-6">
                    <div class="input-group">
                        <input name="attrs[]" minlength="2" maxlength="128" type="text"
                               class="form-control" placeholder="Attribute name"
                               pattern="[a-zA-Z0-9-',\\s]+"
                               required
                        >
                    </div>
                </div>
                <div class="col-4 col-sm-4">
                    <select class="form-select form-select-sm" required name="attrs_vals[]" aria-label=".form-select-sm example">
                    </select>
                </div>
                <div class="col-2 col-sm-2">
                    <a href="#" class="btn btn-danger rm-custom-field" block="${new_selector}">
                        Delete
                    </a>
                </div>
                <div class="w-100 d-none d-md-block"></div>
            </div>
        `;
        $('.hidden-fields .attributes').append(html);
        $(`.${new_selector} select`).html(drawSelectOptions(headers));
        custom_fields[new_selector] = true;
    }

    function removeCustomField(class_name) {
        $(`.${class_name}`).remove();
        delete custom_fields[class_name];
    }
});
