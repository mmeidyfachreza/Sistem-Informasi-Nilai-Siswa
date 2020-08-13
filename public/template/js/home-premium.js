$(function () {

    Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
        theme: 'flat',
        messageDefaults: {
            showCloseButton: true
        }
    }
    Messenger().post({
        message: 'Hai, apa kabar?<br>Selamat datang di SIKESWA V2.',
        type: 'success'
    });
});
