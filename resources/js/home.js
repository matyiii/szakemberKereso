import axios from "axios";

$(window).ready(function () {
    if (window.location.href == "http://127.0.0.1:8000/") { //localhost:8000/#
        $("#tradeSelect").select2({
        });

        $("#citySelect").select2({
        });

        $("#searchBtn").on("click", function (e) {
            e.preventDefault(); //teszteléshez
            let selectedTrade = $("#tradeSelect").val();
            let selectedCity = $("#citySelect").val();
            console.log(`${selectedCity}, ${selectedTrade}`);
            $.ajax({
                type: "GET",
                url:`/getSearchedData`,
                data:{
                    selectedTrade : 'selectedTrade',
                    selectedCity : 'selectedCity',
                },
                success: function(response){
                    console.log(response);
                }
            })
        });
    }
})