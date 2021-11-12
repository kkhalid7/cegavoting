$(window).on("load", function () {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "closeDuration": 300,
        "timeOut": 2000,
        "extendedTimeOut": 20,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    if (this.localStorage.getItem('message') != null) {
        toastr.options.onHidden = function () {
            localStorage.removeItem('message');
        }
        toastr.success(this.localStorage.getItem('message'));
    }

});

