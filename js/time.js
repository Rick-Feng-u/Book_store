var var2 = setInterval(servertimer, 1000);

function servertimer() {
    var results = $.get("http://cosc499.ok.ubc.ca/currentTime.php");
    results.done(function(data) {
        console.log(data);
        //Vanilla JS
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