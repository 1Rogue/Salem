jQuery(document).ready(function($) {
    
    evalSize($);
    
});

function evalSize($) {
    if ($("#content").height() > window.innerHeight - $("#footer").height()) {
        $("#content").css("padding-bottom", "46px");
    } else {
        $("#content").height(window.innerHeight - $("#footer").height() - $("#header").height());
    }
}