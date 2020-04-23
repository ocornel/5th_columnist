function systemSearch(term) {
    $("#search_results").html('<span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;Please wait while searching.').addClass("text-info").removeClass('hidden');
    $.ajax({
        type: "GET",
        url: '/search',
        data: {
            'search_text': term,
        },
        success: function (data) {
            $('body').addClass('layout-header-fixed');
            $("#search_results").html("<h3>Results for "+term+"</h3>" + data['drivers'] + data['customers'] + data['vehicles'] + data['towns']).removeClass("text-info").removeClass("text-danger");
        },
        error: function () {
            $("#search_results").html("An Error Occurred.").removeClass("text-info").addClass("text-danger");
        }
    });
}

