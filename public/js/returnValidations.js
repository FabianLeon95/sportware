$(function() {
    let fairCatch = $('#fair_catch');
    let touchDown = $('#touch_down');
    let fumble = $('#fumble');
    let penalty = $('#penalty');

    fairCatch.change(function () {
        if ( $(this).is(':checked')) {
            touchDown.prop( "checked", false );
            fumble.prop( "checked", false );
        }
    });

    touchDown.change(function () {
        if ( $(this).is(':checked')) {
            fairCatch.prop( "checked", false );
            fumble.prop( "checked", false );
            penalty.prop( "checked", false );
        }
    });

    fumble.change(function () {
        if ( $(this).is(':checked')) {
            touchDown.prop( "checked", false );
            fairCatch.prop( "checked", false );
        }
    });

    penalty.change(function () {
        if ( $(this).is(':checked')) {
            touchDown.prop( "checked", false );
        }
    });

});