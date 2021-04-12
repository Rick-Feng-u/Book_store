window.onload = function() {
    var highlightInput = document.getElementsByClassName("inputHighlight");
    var numNeedToHiLight = highlightInput.length;

    function toggleHighligh() {
        this.classList.toggle("highlight");
    }

    for (var i = 0; i < numNeedToHiLight; i++) {
        highlightInput[i].addEventListener("blur", toggleHighligh);
        highlightInput[i].addEventListener("focus", toggleHighligh);
    }

    document.forms["ContactForm"].onsubmit = function onSubmit(e) {
        var value = document.getElementById("msg").value;
        if (value.length > 150) {
            alert("Word count exceed 150");
            e.preventDefault();
        }
    }
};