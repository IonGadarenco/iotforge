function idnx_validation(format, val) {
    var mask = "731731731731";
    if (val.length !== 13) return false;
    var crc = 0;
    for (var i = 0; i < 12; i++) {
        if (val[i] < '0' || val[i] > '9') return false;
        crc += (val[i] - '0') * (mask[i] - '0');
    }
    if (val[12] < '0' || val[12] > '9') return false;
    if (crc % 10 !== val[12] - '0') return false;

    switch (format) {
        case "idnx":
            return val[0] == '2' || (val[0] == '0' && val[1] == '9') || val[0] === '1';
            break;
        case "idnp":
            return val[0] == '2' || (val[0] == '0' && val[1] == '9');
            break;
        case "idno":
            return val[0] == '1';
            break;
        case "idnv":
            return val[0] == '3';
            break;
    }
    return false;
}

function exportExcel(elementId, fileName = 'List') {
    jQuery("#" + elementId).table2excel({
        exclude: ".noExl",
        filename: fileName,
    });
}

/**
 * Transform JavaScript date to custom format
 * @param d
 * @param format
 * @returns {string}
 */
function dateFormat(d, format = 'Y-m-d H:i:s') {
    var year = d.getFullYear();
    var month = ("0" + (d.getMonth() + 1)).slice(-2);
    var day = ("0" + d.getDate()).slice(-2);

    var hour = ("0" + d.getHours()).slice(-2);
    var min = ("0" + d.getMinutes()).slice(-2);
    var sec = ("0" + d.getSeconds()).slice(-2);

    var dayOfWeek = d.getDay();
    if (!dayOfWeek) dayOfWeek = 7;

    var result = format;

    result = result.replace('w', dayOfWeek);
    result = result.replace('Y', year);
    result = result.replace('m', month);
    result = result.replace('d', day);
    result = result.replace('H', hour);
    result = result.replace('i', min);
    result = result.replace('s', sec);

    return result;
}

/**
 * Open Delete confirm modal and set action attribute
 * @param action
 * @constructor
 */
function DeleteConfirm(action) {
    $('#DeleteModal #delete_url').attr('href', action);
    $('#DeleteModal').modal('show');
}

function DeleteConfirmAJAX(method) {
    $('#DeleteModal').attr('type', 'button');
    $('#DeleteModal').attr('onclick', method);
    $('#DeleteModal').modal('show');
}
//Scriptul cu onclick
function Confirm_Delete_Click(action) {

    $('#delete_url').attr("onclick", action);
    $('#DeleteModal').modal('show');

}

function printDiv(divName) {
    $('.to_print').show();
    $('.to_view').hide();
    $('.md-delete').hide();
    $('#footer_doc').show();

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    printContents += '<style>a:link:after, a:visited:after {content:" (" attr(href) ")";font-size:0 !important;}</style>';
    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    $('.md-delete').show();
    $('#footer_doc').hide();
    $('.to_print').hide();
    $('.to_view').show();
}

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});
