function sendNotification(text, icon, type = 'success', position = 'topCenter') {
    new Noty({
        layout: position,
        type: type,
        text: icon + ' ' + text,
        theme: 'relax',
        timeout: 10000,
        animation: {
          open: 'animated fadeInDown',
          close: 'animated fadeOutUp',
        },
    }).show();
}