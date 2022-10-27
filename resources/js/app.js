$(document).ready(function () {
    var tradeCount = 1
    $("#addTrade").on("click", function () {
        $("#dynamicAdd").append(`<input type="text" id="trade${++tradeCount}" name="trade" class="form-control" placeholder="Trade${tradeCount}">`);
    })

    $("#removeTrade").on("click", function () {
        if(tradeCount>1){
            $("#dynamicAdd input").last().remove();
            tradeCount--;
        }
    })
});