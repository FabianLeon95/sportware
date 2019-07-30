function load(teamId) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/players/get/' + teamId,
        type: "GET",
        dataType: "json",
        beforeSend: function () {
            $('.progress').css("visibility", "visible");
        },

        success: function (data) {
            console.log(data);
            $('select[name="kicker"]').empty();

            $.each(data, function (key, value) {
                $('select[name="kicker"]').append('<option value="' + value.id + '">#' + value.shirt_number + ' ' + ((value.user != null) ? value.user.name : '') + '</option>');
            });
            $(document).ready(function () {
                $('#kicker').formSelect();
            });
        },
        complete: function () {
            $('.progress').css("visibility", "hidden");
        }
    });
}

function kickoffYardLine(team, slider) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/kickoff-yardline/' + team.val(),
        type: "GET",
        dataType: "json",
        async: false,
        success: function (data) {
            slider.noUiSlider.set(data);
        }
    });
}