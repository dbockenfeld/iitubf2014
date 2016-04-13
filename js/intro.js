$(document).ready(function () {
    $("body").on("keyup", ".intro-input input", function () {
        var query = $(this).val();
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: "/intro/ajaxgetquestions",
            data: {
                q: query,
            },
            timeout: 5000,
            cache: false,
            success: function (html) {
                $(".intro-question-list").html(html)
            },
        });
    });
});

