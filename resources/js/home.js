import axios from "axios";

$(window).ready(function () {
    if (window.location.pathname == "/") {
        $("#tradeSelect").select2({
        });

        $("#citySelect").select2({
        });
    }
})