var origin = '';
var loc = null;

function ready() {
    var clipboard = new ClipboardJS('.widget-icon-embed');
    clipboard.on('success', function(e) {
        alert('Shortcode copied to clipboard!');
        e.clearSelection();
    });
}

function openChildWin() {
    var popup = window.open(origin + '/get-widgets?origin=' + loc.origin, '_blank', 'height=400, width=550, status=yes, toolbar=no, menubar=no, location=no,addressbar=no');
    popup.postMessage('start', loc.origin);
}

function receiveMessage(event)
{
    if (event.origin != origin || event.data == '') {
        return;
    }

    document.getElementById('re-widgets-raw').value = event.data;
    document.getElementById('re-widgets-form').submit();
}

function init(loca, orig) {
    origin = orig;
    loc = loca;
}

window.addEventListener('message', receiveMessage);
document.addEventListener('DOMContentLoaded', ready);