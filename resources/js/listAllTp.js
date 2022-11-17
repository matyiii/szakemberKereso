$(window).ready(function () {
    if (window.location.pathname == "/listAllTp") {
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