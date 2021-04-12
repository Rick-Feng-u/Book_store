$(document).ready(function() {
    $("button").click(function() {
        var t = $("#search").val();
        $.get("search.php", { search: t })
            .done(function(data) {
                console.log(data);
                $(".content").html(data);
            });
    });
    $(document).on("click", '[categoryName]', function() {
        var c = $(this).attr("categoryName");
        $.get("search.php", { categoryName: c })
            .done(function(data) {
                console.log(data);
                $(".content").html(data);
            });


    });
    $(document).on("click", '[authorID]', function() {
        var a = $(this).attr("authorID");
        $.get("search.php", { authorID: a })
            .done(function(data) {
                console.log(data);
                $(".content").html(data);
            });


    });

});

var var2 = setInterval(servertimer, 1000);

function servertimer() {
    var results = $.get("http://cosc499.ok.ubc.ca/currentTime.php");
    results.done(function(data) {
        console.log(data);
        // Vanilla JS
        //document.getElementById("time_two").innerHTML = data.time;
        //jQuery
        $("#server_timer").html("Current time: " + data);
    });
    results.fail(function(jqXHR) {
        console.log("Error: " + jqXHR.status);
    });
    results.always(function() {
        console.log("done");
    });
}