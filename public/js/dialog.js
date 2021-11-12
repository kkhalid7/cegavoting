function dialog(title, message, success, reject) {
    let $dialog = $('#modal-confirmation');
    $dialog.find('.title').html(title);
    $dialog.find('.message').html(message);
    let $buttonSuccess = $dialog.find('.button-success');
    let $buttonReject = $dialog.find('.button-reject');
    $buttonSuccess.on('click', function () {
        $buttonSuccess.off('click');
        $buttonReject.off('click');
        $dialog.modal("hide");
        success();
    });
    $buttonReject.on('click', function () {
        $buttonSuccess.off('click');
        $buttonReject.off('click');
        $dialog.modal("hide");
        if (reject != undefined) {
            reject();
        }
    });
    $dialog.modal();
}
