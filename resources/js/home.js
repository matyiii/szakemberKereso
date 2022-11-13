import axios from "axios";

$(window).ready(function () {
    if (window.location.href == "http://127.0.0.1:8000/") { //localhost:8000/#
        $("#tradeSelect").select2({
        });

        $("#citySelect").select2({
        });

        $("#searchBtn").on("click",function(){
            let selectedTrade =  $("#tradeSelect").val();
            let selectedCity = $("#citySelect").val();
            $.ajax({
                type:"POST",
                /* TODO */
            })
        });
    }
})