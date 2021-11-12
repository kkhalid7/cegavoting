
$('.grid').on('click', '.grid-reset', function () {
    var form = $(this).closest('form');
    form.find('.form-control').val('');
    form.find('select:not(.grids-control-records-per-page)').prop('selectedIndex', 0);
    form.submit();
    $('#totalValue').html((0.00).toFixed(2))
    return false;
});

$('.grid').on('change', 'select', function (e) {
    let className = $(this).attr('class');
    if (className !== 'status') {
        $(this).closest('form').submit();
        return false;
    }
    statusChange(this);
});

$('.grid').on('click', '.pagination li a', function () {
    var grid = $(this).closest('.grid');
    var url = $(this).prop('href');
    submitGridForm(grid, url, null);
    return false;
});

$('.grid').on('click', 'thead th small a[title~="Sort"]', function () {
    var grid = $(this).closest('.grid');
    var url = $(this).prop('href');

    if (url === '')
        return false;

    submitGridForm(grid, url, null);
    return false;
});

$('.grid').on('submit', 'form', function () {
    var data = $(this).serialize();
    var grid = $(this).closest('.grid');
    submitGridForm(grid, "", data);
    return false;
});

function submitGridForm(grid, url, data) {
    $('.cache_form .changed_through_ajax').val('1');
    $('.ajax-loader').show();
    $.ajax(url, {
        type: "GET",
        data: data,
        cache: false,
        success: function (data) {
            grid.html(data);
            $('.ajax-loader').hide();
        },
        error: function (data) {

        }
    });
}

$('.grid').on('change', '.export_checkbox', function () {
    var grid = $(this).closest('.grid');
    var exportButton = grid.find('.excel_export a');
    exportButton.prop('href', exportButton.prop('href').replace('&' + $(this).prop('name') + '=' + $(this).val(), ''));
    exportButton.prop('href', exportButton.prop('href').replace($(this).prop('name') + '=' + $(this).val(), ''));
    if (this.checked)
        exportButton.prop('href', addParameter(exportButton.prop('href'), $(this).prop('name'), $(this).val(), false));
});

$('.grid').on('change', '.select_all_checkbox', function () {
    var checkboxes = $(this).closest('.grid').find('.select-checkbox');
    checkboxes.filter(':checked').trigger('click');
    if (this.checked) {
        checkboxes.trigger('click');
    }
});

function addParameter(url, parameterName, parameterValue, replaceDuplicates) {
    var cl;
    if (url.indexOf('#') > 0) {
        cl = url.indexOf('#');
        urlhash = url.substring(url.indexOf('#'), url.length);
    } else {
        urlhash = '';
        cl = url.length;
    }
    sourceUrl = url.substring(0, cl);

    var urlParts = sourceUrl.split("?");
    var newQueryString = "";

    if (urlParts.length > 1) {
        var parameters = urlParts[1].split("&");
        for (var i = 0;
             (i < parameters.length); i++) {
            var parameterParts = parameters[i].split("=");
            if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
                if (newQueryString === "")
                    newQueryString = "?";
                else
                    newQueryString += "&";
                newQueryString += parameterParts[0] + "=" + (parameterParts[1] ? parameterParts[1] : '');
            }
        }
    }
    if (newQueryString === "")
        newQueryString = "?";

    if (newQueryString !== "" && newQueryString != '?')
        newQueryString += "&";
    newQueryString += parameterName + "=" + (parameterValue ? parameterValue : '');

    return urlParts[0] + newQueryString + urlhash;
}

function showToastErrors(message) {
    toastr.options = {
        closeButton: true,
        debug: false,
        newestOnTop: false,
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
}
