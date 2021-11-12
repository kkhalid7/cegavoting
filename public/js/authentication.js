// Your web app's Firebase configuration
let firebaseConfig = {
    apiKey: "AIzaSyBs0OOVGm05ch7VFmuM_Wh_Gb2IQvQsOnM",
    authDomain: "votingsystem-bab55.firebaseapp.com",
    databaseURL: "https://votingsystem-bab55.firebaseio.com",
    projectId: "votingsystem-bab55",
    storageBucket: "votingsystem-bab55.appspot.com",
    messagingSenderId: "175712763984",
    appId: "1:175712763984:web:c484a3673e0b3dbc9b9155"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
    "getOtp", {
        'size': 'invisible'
    }
);

function submitPhoneNumberAuth(phoneNumber) {
    let appVerifier = window.recaptchaVerifier;
    firebase
        .auth()
        .signInWithPhoneNumber(`+91${phoneNumber}`, appVerifier)
        .then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            $('#loading-button').addClass('d-none');
            $('#otp-input').removeClass('d-none');
            $('#login-input').removeClass('d-none');
            showSuccessNotification('Otp Sent Successfully!');
        })
        .catch(function (error) {
            showErrorNotification('Unexpected Error Occurred!');
        });
}

let getVoterPhone = () => {
    let memberNum = $('#membership-number').val();
    $.ajax({
        url: `/get-voter`,
        type: "POST",
        data: {member_id: memberNum},
        success: function (response) {
            submitPhoneNumberAuth(response.phone);
        },
        error: function (error) {
            showErrorNotification(error.responseJSON.message);
        }
    })
}

$('#getOtp').on('click', function (e) {
    $(this).attr('disabled', "disabled");
    $(this).addClass('d-none');
    $('#loading-button').removeClass('d-none');
    getVoterPhone();
});

$('#sign-in-button').on('click', function (e) {
    submitPhoneNumberAuthCode();
    $(this).addClass('d-none');
    $('#login-loading').removeClass('d-none');
});

function submitPhoneNumberAuthCode() {
    let code = $('#otp').val();
    confirmationResult
        .confirm(code)
        .then(function (result) {
            let user = result.user;
            loginUser(user.phoneNumber);
        })
        .catch(function (error) {
            if (error.code === 'auth/invalid-verification-code') {
                showErrorNotification('Invalid Otp!');
                $('#sign-in-button').removeClass('d-none');
                $('#login-loading').addClass('d-none');
            }
        });
}

let loginUser = (phoneNumber) => {
    let avoid = "+91";
    let phone = phoneNumber.split(avoid).join('');
    $.ajax({
        url: '/login',
        type: "POST",
        data: {phone: phone},
        success: function (response) {
            let message = response.message
            localStorage.setItem("message", message);
            window.location.href = response.url;
        },
        error: function (error) {
            $('#sign-in-button').removeClass('d-none');
            $('#login-loading').addClass('d-none');
            showErrorNotification('Unknown error occurred!');
        }
    });
}

let showSuccessNotification = (message) => {
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
    toastr.success(message);
}

let showErrorNotification = (message) => {
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
}

