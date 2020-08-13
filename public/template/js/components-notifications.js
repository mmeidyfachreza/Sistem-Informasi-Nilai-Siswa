$(function () {

    Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-top  messenger-on-right',
        theme: 'flat',
        messageDefaults: {
            showCloseButton: true
        }
    }

    $('#demoMessage').on('click', function () {
        Messenger().post({
            message: 'How are you?',
            type: 'success'
        });
    });

    $('#demoMessage2').on('click', function () {
        Messenger().post({
            message: 'There was an explosion while processing your request.',
            type: 'error',
            showCloseButton: true
        });
    });

    $('#demoMessage3').on('click', function () {
        Messenger().post({
            message: 'No unusual activity around. Carry on.',
            type: 'info',
            showCloseButton: true
        });
    });


    $('#demoMessage4').on('click', function () {
        i = 0;

        Messenger().run({
            errorMessage: 'Error destroying alien planet',
            successMessage: 'Alien planet destroyed!',
            action: function (opts) {
                if (++i < 2) {
                    return opts.error({
                        status: 500,
                        readyState: 0,
                        responseText: 0
                    });
                } else {
                    return opts.success();
                }
            }
        });
    });

    $('#demoMessage5').on('click', function () {
        msg = Messenger().post({
            message: "I'm sorry Hal, I just can't do that.",
            actions: {
                retry: {
                    label: 'retry now',
                    phrase: 'Retrying TIME',
                    auto: true,
                    delay: 10,
                    action: function () {}
                },
                cancel: {
                    action: function () {
                        return msg.cancel();
                    }
                }
            }
        });
    });
});