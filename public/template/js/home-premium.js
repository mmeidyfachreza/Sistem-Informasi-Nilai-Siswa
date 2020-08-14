$(function () {

    Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
        theme: 'flat',
        messageDefaults: {
            showCloseButton: true
        }
    }
    Messenger().post({
        message: 'Hai, apa kabar?<br>Selamat datang di website raport SMK 2 Samarinda.',
        type: 'success'
    });
});
