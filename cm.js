    function myFunction(msg) {
        document.getElementById("details").innerHTML = msg;
        var x = document.getElementById("details");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }