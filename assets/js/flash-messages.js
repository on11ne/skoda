/**
 * Created by JetBrains PhpStorm.
 * User: ekimov
 * Date: 8/17/12
 * Time: 1:26 PM
 * To change this template use File | Settings | File Templates.
 */
function error(contents) {

    contents = "<div class='error'>" + contents + "</div>";

    jQuery.fancybox(contents, {
        opacity: true,
        overlayOpacity: 0,
        padding: 0,
        width: 550,
        height: 187,
        autoDimensions: false
    })
}

function success(contents) {

    contents = "<div class='success'>" + contents + "</div>";

    jQuery.fancybox(contents, {
        opacity: true,
        overlayOpacity: 0,
        padding: 0,
        width: 550,
        height: 60,
        autoDimensions: false
    })
}

jQuery(function() {
    if(jQuery(".errorSummary").length)
        error(jQuery(".errorSummary").html());

    if(jQuery(".successSummary").length)
        success(jQuery(".successSummary").html());

    if(jQuery(".error").length)
        success(jQuery(".error").html());

    if(jQuery(".success").length)
        success(jQuery(".success").html());
})