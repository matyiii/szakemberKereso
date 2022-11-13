$(window).ready(function () {
    if (window.location.href == "/addTp") {
        var tradeCount = 1
        $("#addTrade").on("click", function () {
            if (tradeCount != 3) {
                $("#dynamicAdd").append(`<input type="text" id="trade" name="trade${++tradeCount}" class="form-control" placeholder="Trade${tradeCount}">`);
            }
        });

        $("#removeTrade").on("click", function () {
            if (tradeCount > 1) {
                $("#dynamicAdd input").last().remove();
                tradeCount--;
            }
        });

        $("#tradespersonList").on("click", ".openmodal", function () {
            let traderpersonId = $(this).attr('data-id');

            if (traderpersonId > 0) {
                $("#tradespersonInfo tbody").empty();
                console.log("empty");
                $.ajax({
                    type: 'GET',
                    url: `/getTradespersonData/${traderpersonId}`,
                    dataType: 'json',
                    success: function (response) {
                        $("#tradespersonInfo tbody").html(response.html);
                        $('#tradespersonModal').modal('show');
                    }
                });
            }
        });
    }
});

var tradeCount = 1
        $("#addTrade").on("click", function () {
            if (tradeCount != 3) {
                $("#dynamicAdd").append(`<input type="text" id="trade" name="trade${++tradeCount}" class="form-control" placeholder="Trade${tradeCount}">`);
            }
        });

        $("#removeTrade").on("click", function () {
            if (tradeCount > 1) {
                $("#dynamicAdd input").last().remove();
                tradeCount--;
            }
        });

        $("#tradespersonList").on("click", ".openmodal", function () {
            let traderpersonId = $(this).attr('data-id');

            if (traderpersonId > 0) {
                $("#tradespersonInfo tbody").empty();
                console.log("empty");
                $.ajax({
                    type: 'GET',
                    url: `/getTradespersonData/${traderpersonId}`,
                    dataType: 'json',
                    success: function (response) {
                        $("#tradespersonInfo tbody").html(response.html);
                        $('#tradespersonModal').modal('show');
                    }
                });
            }
        });