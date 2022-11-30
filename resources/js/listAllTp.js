$(window).ready(function () {
    if (window.location.pathname.match(/listAllTp.*/)) {
        $("#tradespersonList").on("click", ".openmodal", function () {
            let tradespersonId = $(this).attr('data-id');
            if (tradespersonId > 0) {
                $("#tradespersonInfo tbody").empty();
                $.ajax({
                    type: 'GET',
                    url: `/getTradespersonData/${tradespersonId}`,
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