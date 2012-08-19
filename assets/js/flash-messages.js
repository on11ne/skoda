/**
 * Created by JetBrains PhpStorm.
 * User: ekimov
 * Date: 8/17/12
 * Time: 1:26 PM
 * To change this template use File | Settings | File Templates.
 */
function error(contents) {

    contents = "<div class='error_box'>" + contents + "</div>";

    jQuery.fancybox(contents, {
        overlay : {
            speedIn  : 0,
            speedOut : 300,
            opacity  : 0.55,
            css      : {
                cursor : 'pointer',
                'background' : '#4ba82e'
            },
            closeClick: true
        },
        minWidth: 300,
        minHeight: 120,
        autoSize: true,
        scrolling: 'no'
    })
}

function success(contents) {

    contents = "<div class='success_box'>" + contents + "</div>";

    jQuery.fancybox(contents, {
        overlay : {
            speedIn  : 0,
            speedOut : 300,
            opacity  : 0.55,
            css      : {
                cursor : 'pointer',
                'background-color' : '#4ba82e'
            },
            closeClick: true
        },
        minWidth: 300,
        minHeight: 120,
        autoSize: true,
        scrolling: 'no'
    })
}

jQuery(function() {

    jQuery('.fancybox').fancybox({
        overlay : {
            speedIn  : 0,
            speedOut : 300,
            opacity  : 0.55,
            css      : {
                cursor : 'pointer',
                'background' : '#4ba82e'
            },
            closeClick: true
        },
        minWidth: 300,
        minHeight: 120,
        autoSize: true,
        scrolling: 'no'
    });

    if(jQuery(".error").length)
        error(jQuery(".error").html());

    if(jQuery(".errorSummary").length)
        error(jQuery(".errorSummary").html());

    if(jQuery(".successSummary").length)
        success(jQuery(".successSummary").html());

    if(jQuery(".success").length)
        success(jQuery(".success").html());
})