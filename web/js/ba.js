let mouseDown = false;
let delta = 0;
$(function () {
    $(document).on('mouseup', function () {
        mouseDown = false;
    });

    $('.photoAfter .circle').on('mouseup', function (e) {
        mouseDown = false;
    });

    $('.photoAfter .circle').on('mousedown', function (e) {
        mouseDown = true;
        delta = $(this).offset().left - e.clientX;
    });

    $('.photo').on('mousemove', function (e) {
        if(mouseDown) {
            $('.circle').offset({
                left: e.clientX+delta
            });
            $('.photoAfter').width($('.circle').position().left+10);
        }
    });
});