$(document).on("submit", ".form", function () {
    let $form = $(this);
    let url = $form.prop("action");
    toggleSubmitDisable($form);
    hideFormErrors($form);
    onFormSubmitted($form, url);
    return false;
});

$(document).on('click', '.form-button', function () {
    let $form = $($(this).data('form'));
    if ($form == undefined) {
        $form = $(this).closest('form');
    }
    let url = $(this).data('action');
    if (url == undefined) {
        url = $form.prop('action');
    }
    onFormSubmitted($form, url);
});

function toggleSubmitDisable($form) {
    $btn = $form.find(".btn");
    let isdisabled = (function () {
        return $btn.attr("disabled") != undefined;
    })();
    isdisabled
        ? $btn.removeAttr("disabled").removeClass("disabled")
        : $btn.attr("disabled", "disabled").addClass("disabled");
}

function onFormSubmitted($form, url) {
    let data = $form.serialize();
    let contentType = "application/x-www-form-urlencoded; charset=UTF-8";
    if ($form.hasClass("form-multipart")) {
        data = new FormData($form[0]);
        contentType = false;
    }
    let method = $form.attr("method");
    let request = ajax(url, method, data, contentType);

    request.done(function (response) {
        let message = "Success !!";
        if (response.message != undefined) {
            message = response.message;
        }
        localStorage.setItem("message", message);
        let successFunction = $form.data("success");
        let destination = $form.data("destination");
        if (successFunction != undefined) {
            window[successFunction](response);
        } else {
            goToDestination(destination, response);
        }
    });

    request.fail(function (error) {
        let errorFunction = $form.data("error");
        if (errorFunction != undefined) {
            window[errorFunction](error);
        } else if (error.responseJSON["custom_error"] != undefined) {
            showToastErrors($form, error.responseJSON['custom_error']);
        } else {
            showFormErrors($form, error);
        }
    });
}

function ajax(url, method, data, contentType) {
    return $.ajax({
        url: url,
        data: data,
        type: method,
        processData: false,
        contentType: contentType
    });
}

function hideFormErrors($form) {
    $form.find(".is-invalid").each(function () {
        $(this).removeClass("is-invalid");
    });
    $form.find(".label").each(function () {
        $(this).removeClass("text-danger");
    });
    $form.find(".error").each(function () {
        $(this)
            .addClass("d-none")
            .html("");
    });
}

function showFormErrors($form, error) {
    let errors = error.responseJSON.errors;
    toggleSubmitDisable($form);
    for (key in errors) {
        let $field = $form.find('[id="' + key + '"]');
        $field.addClass("is-invalid");
        let $label = $('label[for="' + $field.attr("id") + '"]');
        $label.addClass("text-danger");
        let $errorMessage = $form.find(".error-" + key);
        $errorMessage = $form.find(".error-" + key);
        if (key.includes('.')) {
            let newKey = key.replace('.', '-');
            $errorMessage = $form.find(".error-" + newKey);
        }
        if (key.includes('[')) {
            let newKey = key.replace('[', '-');
            newKey = newKey.replace(']', '');
            $errorMessage = $form.find(".error-" + newKey);
        }
        $errorMessage.html(errors[key]).removeClass("d-none");
    }
}

function showToastErrors($form, message) {
    console.log(message);
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: true,
        progressBar: true,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "4000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    };
    toastr.error(message);
    toggleSubmitDisable($form);
}

let goToDestination = (destination, response) => {
    let match;
    let path;
    if (destination != undefined) {
        if (destination !== false) {
            let regex = /#(\S+)#/;
            while (match = regex.exec(destination)) {
                path = match[1].split('.');
                let value = response;
                for (let i = 0; i < path.length; i++)
                    value = value[path[i]];
                destination = destination.replace(match[0], value == undefined ? "" : value);
                match = regex.exec(destination);
            }
            window.location = destination;
        }
    } else if ('intended' in response) {
        window.location = response.intended;
    } else {
        window.location.reload();
    }
}
