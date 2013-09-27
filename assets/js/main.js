jQuery(document).ready(function($) {
    
    console.log(evalSize($));
    
});

function evalSize($) {
    console.log("content height = " + $("#content").height());
    console.log("window innerheight = " + window.innerHeight);
    console.log("foot height = " + $("#footer").height());
    console.log("header height = " + $("#header").height());
    var extras = window.innerHeight - $("#footer").height() - $("#header").height();
    console.log("inner - extras = " + extras);
    var four = window.innerHeight / 25;
    console.log("4% = " + four);
    if ($("#content").height() > extras - (four * 2)) {
        $(".container").css("padding-bottom", "4%");
        return 1;
    } else {
        $("#content").height(extras - (window.innerHeight >>> 2));
        return 0;
    }
}